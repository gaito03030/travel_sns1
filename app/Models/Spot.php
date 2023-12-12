<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spot extends Model
{
    //タイムスタンプの無効
    public $timestamps = false;

    protected $guarded = [
        'id',
        'post_id'
    ];

    use HasFactory;
}
