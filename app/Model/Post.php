<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Post extends Model
{

    use Searchable;

    //
    protected $table = 'posts';

    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * 获取模型的索引数据数组
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $post = $this->toArray();
        $array = [
            'id' => $post['id'],
            'slug' => $post['slug'],
            'title' =>  $post['title'],
            'content' => strip_tags($post['content']),
        ];
        return $array;
    }
}
