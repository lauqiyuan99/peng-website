<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page_Content extends Model
{
    use HasFactory;
    protected $table = 'page_contents';

    protected $fillable = [
        'media_type',
        'media_path',
        'description',
        'is_publish',
        'page_id',
    ];

    public function page() {
        return $this->belongsToMany('App\Models\Page');
    }
}
