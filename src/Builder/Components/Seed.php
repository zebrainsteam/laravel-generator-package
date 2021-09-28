<?php

declare(strict_types=1);

namespace Zebrainsteam\LaravelGeneratorPackage\Builder\Components;

use Zebrainsteam\LaravelGeneratorPackage\Builder\Package;
use Zebrainsteam\LaravelGeneratorPackage\Configuration;

class Seed
{
    /**
     * @var Configuration
     */
    private Configuration $config;

    /**
     * @var Package
     */
    private Package $package;

    /**
     * FileGenerator constructor.
     * @param Configuration $config
     */
    public function __construct(Configuration $config)
    {
        $this->config = $config;
    }

    /**
     * @param Package $package
     * @return bool
     */
    public function make(Package $package): bool
    {
        $this->package = $package;

        if (!$this->package->getGeneratorSeed()) {
            return false;
        }

        $fields = '';
        $fieldsAll = $this->package->getFields();
        foreach ($fieldsAll as $field) {
            $fields .= "\n\t\t\t'" . $field->getColumn() . "' => '',";
        }
        $code = str_replace([
            '%PACKAGE_NAMESPACE%',
            '%MODEL%',
            '%FIELDS%',
        ], [
            $this->package->getNamespace(),
            $this->package->getModel(),
            $fields,
        ], $this->template);
        file_put_contents($this->package->getPath('database/Seeders/DatabaseSeeder.php'), $code);
        return true;
    }

    /**
     * PHP code model
     *
     * @var string
     */
    public string $template = <<<'EOD'
<?php

declare(strict_types=1);

namespace %PACKAGE_NAMESPACE%\DataBase\Seeders;

use Illuminate\Database\Seeder;
use %PACKAGE_NAMESPACE%\Models\%MODEL%;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        %MODEL%::create([ %FIELDS%
        ]);

        %MODEL%::factory(10)->create();
    }
}
EOD;

}
