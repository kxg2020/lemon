<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $table = 'posts';

    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }
}
