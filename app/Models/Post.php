<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'main_img_url',
        'status',
        'pref_id',
        'description',
    ];

    protected $guarded = [
        'id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function pref(){
        return $this->belongsTo(Pref::class);
    }

    public function details(){
        return $this->hasMany(Detail::class);
    }
    public function spots(){
        return $this->hasMany(Spot::class);
    }

    public function comments(){
        return $this->hasmany(Comment::class);
    }

    public function bookmark_posts()
    {
        return $this->belongsToMany(Post::class, 'bookmarks', 'user_id', 'post_id');
    }
}
