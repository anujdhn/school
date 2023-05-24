<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassFeeMaster extends Model
{
    use HasFactory;
    protected $guarded=[];

    /**
    * | Add Records
    */
   public function store(array $req){
    ClassFeeMaster::create($req);
   }

    /**
    * | Read Records by ID
    */
   public function readClassFeeMasterById($classFeeMaster)
   {
       return ClassFeeMaster::where('class_id', $classFeeMaster) //class_id, fee_head_id
           ->where('status', 1)
           ->get();
   }
}
