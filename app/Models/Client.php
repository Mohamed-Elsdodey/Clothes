<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function city(){
        return $this->belongsTo(Area::class,'city_id');
    }
    public function governorate(){
        return $this->belongsTo(Area::class,'governorate_id');
    }
}
