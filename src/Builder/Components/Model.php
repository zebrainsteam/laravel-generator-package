<?php

declare(strict_types=1);

namespace Zebrainsteam\LaravelGeneratorPackage\Builder\Components;

use Zebrainsteam\LaravelGeneratorPackage\Builder\Package;
use Zebrainsteam\LaravelGeneratorPackage\Configuration;
use Zebrainsteam\LaravelGeneratorPackage\Contracts\FieldInterface;

class Model
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
        $fillable = '';
        $hidden = '';
        $casts = "\n\t\t'id' => 'integer',";
        $rules = '';
        $functions = '';
        $fields = $this->package->getFields();
        foreach ($fields as $field) {
            $fillable .= "\n\t\t'" . $field->getColumn() . "',";
            $hidden .= $field->isHidden() ? "\n\t\t'" . $field->getColumn() . "'," : '';
            $casts .= "\n\t\t'" . $field->getColumn() . "' => '" . $field->getCast() . "',";
            $rules .= $this->getRules($field);
            $functions .= $this->getFunction($field);
        }
        $code = str_replace([
            '%PACKAGE_NAMESPACE%',
            '%MODEL%',
            '%TABLE%',
            '%FILLABLE%',
            '%HIDDEN%',
            '%CASTS%',
            '%RULES%',
            '%FUNCTIONS%',
        ], [
            $this->package->getNamespace(),
            $this->package->getModel(),
            $this->package->getTable(),
            $fillable,
            $hidden,
            $casts,
            $rules,
            $functions,
        ], $this->model);
        $nameFileModel = $this->package->getModel() . '.php';
        file_put_contents($this->package->getPath('src/Models/' . $nameFileModel), $code);
        return true;
    }

    /**
     * @param FieldInterface $field
     * @return string
     */
    public function getFunction(FieldInterface $field): string
    {
        if (!is_null($field->getReferencesField())) {
            $code = str_replace([
                '%MODEL%',
                '%TABLE%',
                '%FIELD%',
                '%MANY%',
                '%FIELD_LOCAL%',
            ], [
                $field->getReferencesModel(),
                $field->getReferencesTable(),
                $field->getReferencesField(),
                $field->getReferencesHas(),
                $field->getColumn(),
            ], $this->function);
            return $code;
        }
        return '';
    }

    /**
     * @param FieldInterface $field
     * @return string
     */
    public function getRules(FieldInterface $field): string
    {
        $rule = [];
        if ($field->isRequired()) {
            $rule[] = 'required';
        }
        if (!is_null($field->getMax())) {
            $rule[] = 'max:' . $field->getMax();
        }
        if (!is_null($field->getMin())) {
            $rule[] = 'min:' . $field->getMin();
        }
        if (in_array($field->getType(), ['integer', 'float', 'bigInteger'])) {
            $rule[] = 'numeric';
        }
        $rules = implode('|', $rule);
        if (mb_strlen($rules) > 0) {
            return "\n\t\t'" . $field->getColumn() . "' => '" . $rules . "',";
        }
        return '';
    }

    /**
     * PHP code model
     *
     * @var string
     */
    public string $model = <<<'EOD'
<?php

declare(strict_types=1);

namespace %PACKAGE_NAMESPACE%\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class %MODEL% extends Model
{
    use HasFactory;

    protected $table = '%TABLE%';

    /**
     * @var array
     */
    protected $fillable = [ %FILLABLE%
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [ %HIDDEN%
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [ %CASTS%
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [ %RULES%
    ];
    %FUNCTIONS%
}
EOD;

    public string $function = <<<'EOD'

    /**
     * @return \Illuminate\Database\Eloquent\Relations\%MANY%
     */
    public function adsFave()
    {
        return $this->%MANY%('%MODEL%', '%FIELD%', '%FIELD_LOCAL%');
    }
EOD;


}
