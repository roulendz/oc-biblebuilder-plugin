<?php namespace Logingrupa\BibleBuilder\Models;

use Model;
use October\Rain\Database\Traits\Validation;
use Kharanenka\Scope\ActiveField;
use Kharanenka\Scope\ExternalIDField;
use Lovata\Toolbox\Traits\Helpers\TraitCached;

/**
 * Class Book
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
class Book extends Model
{
    use Validation;
    use ActiveField;
    use TraitCached;

    /** @var string */
    public $table = 'books';
    protected $primaryKey = 'book_number';
    /** @var array */
    public $implement = [
        '@RainLab.Translate.Behaviors.TranslatableModel',
    ];

    // /**
    //  * The relationships that should always be loaded.
    //  *
    //  * @var array
    //  */
    // protected $with = ['chapters'];
 
    // /**
    //  * Get all chapters for books.
    //  */
    // public function chapters()
    // {
    //     return $this->hasMany(Chapter::class, 'book_number')->currentBook($query, $model);
    // }

    /** @var array */
    public $translatable = [
            ];
    /** @var array */
    public $attributeNames = [
        'long_name' => 'lovata.toolbox::lang.field.name',
    ];
    /** @var array */
    public $rules = [
        'short_name' => 'required',
    ];
    /** @var array */
    public $slugs = [];
    /** @var array */
    public $jsonable = [];
    /** @var array */
    public $fillable = [
        'active',
        'book_number',
        'short_name',
        'long_name',
    ];
    /** @var array */
    public $cached = [
        'active',
        'book_number',
        'short_name',
        'long_name',
    ];
    /** @var array */
    public $dates = [
        // 'created_at',
        // 'updated_at',
    ];
    /** @var array */
    public $casts = [];
    /** @var array */
    public $visible = [];
    /** @var array */
    public $hidden = ['book_color'];
    /** @var array */
    public $hasOne = [];
    /** @var array */
    public $hasMany = [
        'chapters' => [
            \Logingrupa\BibleBuilder\Models\Chapter::class,
            'table'    => 'verses',
            'key'      => 'book_number',
        ],
        'verses' => [
            \Logingrupa\BibleBuilder\Models\Verse::class,
            'table'    => 'verses',
            'key'      => 'verse',
        ]
    ];
    /** @var array */
    public $belongsTo = [];
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

    /**
     * Get the user's first name.
     *
     * @param  string  $value
     * @return string
     */
    public static function bookChapters($query)
    {
        // return $query->where('book_number', '=', 20);
    }

}
