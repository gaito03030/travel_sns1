<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Post;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'icon_url',
        'company_flg',
        'bio',
        'web_url',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    /** user が　bookmark をしているか確認するメソッド */
    public function is_bookmark($postId)
    {
        return $this->bookmarks()->where('post_id', $postId)->exists();
    }

    public function bookmark_posts()
    {
        return $this->belongsToMany(Post::class, 'bookmarks', 'user_id', 'post_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /** user が　like をしているか確認するメソッド */
    public function is_like($postId)
    {
        return $this->likes()->where('post_id', $postId)->exists();
    }

    public function like_posts()
    {
        return $this->belongsToMany(Post::class, 'likes', 'user_id', 'post_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    /** 未読の通知があるか確認 */
    public function notifications_unread()
    {
        return $this->notifications()->where('read_flg', 0)->exists();
    }

    public function setting()
    {
        return $this->belongsTo(Setting::class);
    }


    //フォローしている企業を一覧表示
    public function followedCompanies()
    {
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'followed_user_id');
    }

    //企業をフォローしている人を表示
    public function follower_users(){
        return $this->belongsToMany(User::class,'follows','followed_user_id','user_id');
    }

    // ブックマークの総数表示
    public function bookmark_total()
    {
        $posts = $this->posts();
        $post_bookmark = $posts->withCount('bookmark_users')->where('status','=','1')->pluck('bookmark_users_count')->all();
        $return = array_sum($post_bookmark);
        return $return;
    }
}
