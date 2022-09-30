<?php namespace Logingrupa\BibleBuilder\Models;

use Model;
use October\Rain\Database\Traits\Validation;
use Kharanenka\Scope\ActiveField;
use Lovata\Toolbox\Traits\Helpers\TraitCached;

/**
 * Class Verse
 * @package Logingrupa\BibleBuilder\Models
 *
 * @mixin \October\Rain\Database\Builder
 * @mixin \Eloquent
 *
 * @property integer $id
 * @property string $name
 * @property string $code
 * @property string $external_id
 * @property \October\Rain\Argon\Argon $created_at
 * @property \October\Rain\Argon\Argon $updated_at
 */
class Verse extends Model
{
    use Validation;
    use ActiveField;
    use TraitCached;

    /** @var string */
    public $table = 'verses';
    /** @var array */
    public $implement = [
        '@RainLab.Translate.Behaviors.TranslatableModel',
    ];
    /** @var array */
    public $translatable = [
        'name',
            ];
    /** @var array */
    public $attributeNames = [
        'name' => 'lovata.toolbox::lang.field.name',
    ];
    /** @var array */
    public $rules = [
        'name' => 'required',
    ];
    /** @var array */
    public $slugs = [];
    /** @var array */
    public $jsonable = [];
    /** @var array */
    public $fillable = [
        'name',
        'code',
        'external_id',
    ];
    /** @var array */
    public $cached = [
        'id',
        'name',
        'code',
        'external_id',
    ];
    /** @var array */
    public $dates = [
        'created_at',
        'updated_at',
    ];
    /** @var array */
    public $casts = [];
    /** @var array */
    public $visible = [];
    /** @var array */
    public $hidden = [];
    /** @var array */
    public $hasOne = [
        'chapter' => [
            \Logingrupa\BibleBuilder\Models\Verse::class,
            'table'    => 'verses',
            'key'      => 'chapter'
        ]
    ];
    /** @var array */
    public $hasMany = [];
    /** @var array */
    public $belongsTo = [
        'book' => [
            \Logingrupa\BibleBuilder\Models\Book::class,
            'table'    => 'books',
            'key'      => 'book_number'
        ]
    ];
    /** @var array */
    public $belongsToMany = [];
    /** @var array */
    public $morphTo = [];
    /** @var array */
    public $morphOne = [];
    /** @var array */
    public $morphMany = [];
    /** @var array */
    public $attachOne = [];
    /** @var array */
    public $attachMany = [];
}
