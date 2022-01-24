<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'category_id', 'content', 'title', 'image'
    ];

    public function categories(){
        // 投稿は1つのカテゴリーに属する
        return $this->belongsTo(\App\Models\Categories::class, 'category_id');
    }

    public function user(){
        // 投稿は1つのユーザに属する
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    // 投稿はたくさんのコメントを持つ
    public function comments(){
        return $this->hasMany(\App\Models\Comment::class, 'post_id', 'id');
      }

    //   タグ付け
    // public function tags()
    // {
    //     return $this->belongsToMany(\App\Models\Tag::class);
    // }
}
