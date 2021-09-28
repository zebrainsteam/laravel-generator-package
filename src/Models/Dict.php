<?php

declare(strict_types=1);

namespace Zebrainsteam\LaravelGeneratorPackage\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dict extends Model
{
    use HasFactory;

    protected $table = 'lgp_dict';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
    ];

    /**
     * List option for dict
     *
     * @return hasMany
     */
    public function options(): hasMany
    {
        return $this->hasMany(DictOption::class, 'dict_id', 'id');
    }
}
