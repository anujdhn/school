<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeDefinition extends Model
{
    use HasFactory;
    protected $guarded=[];

    /**
    * | Add Records
    */
   public function store(array $req){
    FeeDefinition::create($req);
   }

    /**
    * | Read Records by ID
    */
   public function readFeeDefinitionById($feeDemand)
   {
       return FeeDefinition::where('class_id', $feeDemand) //class_id
           ->where('status', 1)
           ->get();
   }
}
