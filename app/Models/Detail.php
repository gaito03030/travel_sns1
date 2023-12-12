<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;

    //タイムスタンプの無効
    public $timestamps = false;

    protected $guarded = [
        'id',
        'post_id'
    ];

    public function post()
    {
        return $this->belongsTo('App\Post');
    }
}
