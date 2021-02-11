<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * Class Project
 * @package App
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property int $order_number
 * @property boolean $show
 * @property Category $category
 * @property Resource[] $resources
 */
class Project extends Model
{
    use HasTranslations;

    public $translatable = ['description'];

    protected $fillable = [
        'title',
        'slug',
        'description',
        'order_number',
        'show',
    ];

    public function category() {
        return $this->belongsTo('App\Category');
    }

    public function resources() {
        return $this->belongsToMany('App\Resource')
            ->withPivot('resource_order')
            ->withTimestamps()
            ->orderByRaw('ISNULL(pivot_resource_order), pivot_resource_order asc');
    }
}
