<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function item(){
        return $this->belongsTo(Item::class,'item_id');
    }
    public function type(){
        return $this->belongsTo(Type::class,'type_id');
    }
    public function stage(){
        return $this->belongsTo(Stage::class,'stage_id');
    }
}
