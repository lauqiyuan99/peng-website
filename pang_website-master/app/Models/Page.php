<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'url',
        'ranking',
        'parent_id',
        'description',
        'is_publish',
        'year',
    ];

    /**
    * Relationship:
    * A page belongs to many page_contents
    */
    public function page_content() {
        return $this->hasMany('App\Models\Page_Content');
    }

    public function child() {
        return $this->hasMany('App\Models\Page', 'parent_id');
    }

    public function parent() {
        return $this->belongsTo('App\Models\Page', 'parent_id');
    }
}
