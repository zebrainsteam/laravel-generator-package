<?php

declare(strict_types=1);

namespace Zebrainsteam\LaravelGeneratorPackage\Builder\Components;

use Zebrainsteam\LaravelGeneratorPackage\Builder\Package;
use Zebrainsteam\LaravelGeneratorPackage\Configuration;
use Zebrainsteam\LaravelGeneratorPackage\Contracts\FieldInterface;

class Migration
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
        $fieldsCode = '';
        $this->package = $package;
        $fields = $this->package->getFields();
        foreach ($fields as $field) {
            $fieldsCode .= $this->generationField($field);
        }
        $code = str_replace([
            '%FIELDS%',
            '%TABLE%',
            '%MODEL%',
        ], [
            $fieldsCode,
            $this->package->getTable(),
            $this->package->getModel(),
        ], $this->migrate);
        $nameFileMigration = date('Y_m_d_His') . '_create_' . $this->package->getTable() . '_table.php';
        file_put_contents($this->package->getPath('database/migrations/' . $nameFileMigration), $code);
        return true;
    }

    /**
     * @param FieldInterface $field
     * @return string
     */
    public function generationField(FieldInterface $field): string
    {
        $code = "\n\t\t\t\$table->" . $field->getType() . '(\'' . $field->getColumn() . '\')';
        $code .= ($field->isNullable() ? '->nullable()' : '') . ($field->isUnique() ? '->unique()' : '');
        if (!is_null($field->getReferencesTable())) {
            $code .= '->references(\'' . $field->getReferencesField() . '\')->on(\'' . $field->getReferencesTable() . '\')';
        }
        if (!is_null($field->getDefault()) || $field->isNullable()) {
            $default = is_null($field->getDefault()) && $field->isNullable() ? 'null' : "'" . $field->getDefault() . "'";
            $code .= '->default(' . $default . ')';
        }
        $code .= ';';
        $code .= $field->isIndex() ? "\n\t\t\t" . '$table->index(\'' . $field->getColumn() . '\');' : '';
        return $code;
    }

    /**
     * PHP code migration
     *
     * @var string
     */
    public string $migrate = <<<'EOD'
<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create%MODEL%Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('%TABLE%', function (Blueprint $table) {
            $table->id(); %FIELDS%
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('%TABLE%');
    }
}
EOD;

}
