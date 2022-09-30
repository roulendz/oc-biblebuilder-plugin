<?php namespace Logingrupa\BibleBuilder\Models;

use Model;
use October\Rain\Database\Traits\Validation;
use Kharanenka\Scope\NameField;
use Kharanenka\Scope\CodeField;
use Lovata\Toolbox\Traits\Helpers\TraitCached;

/**
 * Class Chapter
 * @package Logingrupa\BibleBuilder\Models
 *
 * @mixin \October\Rain\Database\Builder
 * @mixin \Eloquent
 *
 * @property integer $id
 * @property string $name
 * @property string $code
 * @property \October\Rain\Argon\Argon $created_at
 * @property \October\Rain\Argon\Argon $updated_at
 */
class Chapter extends Model
{
    use Validation;
    use NameField;
    use CodeField;
    use TraitCached;

    /** @var string */
    public $table = 'verses';
    protected $primaryKey = 'id';
    public $incrementing = false;
    /** @var array */
    public $implement = [
        '@RainLab.Translate.Behaviors.TranslatableModel',
    ];
    /** @var array */
    public $translatable = [
        'text',
            ];
    /** @var array */
    public $attributeNames = [
        'text' => 'lovata.toolbox::lang.field.name',
    ];
    /** @var array */
    public $rules = [
        'text' => 'required',
    ];
    /** @var array */
    public $slugs = [];
    /** @var array */
    public $jsonable = [];
    /** @var array */
    public $fillable = [
        'book_number',
        'text',
        'chapter',
        'verse',
    ];
    /** @var array */
    public $cached = [
        'book_number',
        'text',
        'chapter',
        'verse',
    ];
    /** @var array */
    public $dates = [
    ];
    /** @var array */
    public $casts = [];
    /** @var array */
    public $visible = [];
    /** @var array */
    public $hidden = [];
    /** @var array */
    public $hasOne = [
        'book' => [
            \Logingrupa\BibleBuilder\Models\Book::class,
            'table'    => 'books',
            'key'      => 'book_number',
            'otherKey' => 'book_number'
        ]
    ];
    /** @var array */
    public $hasMany = [
        'verses' => [
            \Logingrupa\BibleBuilder\Models\Verse::class,
            'table'    => 'verses',
            'key'      => 'chapter'
        ]
    ];
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

    /**
     * Scope a query to only include active users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
    public function scopeCurrentBook($query, $model)
    {
        $query->where('book_number', 20);
    
    }

    public function scopeGroupChapters($query)
    {
        $query->groupBy('chapter');
    }

    
    // protected $with = ['verses'];
 
    // /**
    //  * Get all chapters for books.
    //  * public function hasMany($related, $primaryKey = null, $localKey = null, $relationName = null)
    //  */
    // public function verses()
    // {
    //     return $this->hasMany(Verse::class, 'chapter', 'verses');
    // }
}
