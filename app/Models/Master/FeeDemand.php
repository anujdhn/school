<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeDemand extends Model
{
    use HasFactory;
    protected $guarded=[];

    /**
    * | Add Records
    */
   public function store(array $req){
    FeeDemand::create($req);
   }

    /**
    * | Read Records by ID
    */
   public function readFeeDemandById($feeDemand)
   {
       return FeeDemand::where('student_id', $feeDemand) //student_id, class_fee_master_id
           ->where('status', 1)
           ->get();
   }
}
