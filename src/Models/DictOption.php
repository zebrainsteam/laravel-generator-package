<?php

declare(strict_types=1);

namespace Zebrainsteam\LaravelGeneratorPackage\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DictOption extends Model
{
    use HasFactory;

    protected $table = 'lgp_dict_option';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'json',
        'dict_id',
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
        'json' => AsArrayObject::class,
        'dict_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'dict_id' => 'required',
    ];

    /**
     * Get dict for option
     *
     * @return BelongsTo
     */
    public function dict(): BelongsTo
    {
        return $this->belongsTo(Dict::class, 'id', 'dict_id');
    }
}
