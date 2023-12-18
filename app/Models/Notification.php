<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    public function reads(){

        return $this->hasMany(Read::class);
        
    }
    
    public function getDateAttribute() {

        return $this->created_at->format('m月d日');

    }
}
