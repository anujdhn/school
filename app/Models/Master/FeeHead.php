<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class FeeHead extends Model
{
    use HasFactory;
    protected $guarded=[];

    /**
    * | Add Records
    */
   public function store(array $req){
     FeeHead::create($req);
   }

    /**
    * | Read Records by ID
    */
   public function readFeeHeadById($FeeHead)
   {
       return FeeHead::where('fee_head', $FeeHead)
           ->where('status', 1)
           ->get();
   }

   public function showById($id){
    return DB::table('fee_heads as fh')
    ->select('ft.fee_head_type', 'fh.fee_head', 'fh.description', 'fh.academic_year', 'fh.status')
    ->join('fee_head_types as ft', 'ft.id', '=', 'fh.fee_head_type_id') 
    ->where('fh.id',$id)       
    ->first();
   }

   public function retrieveAll(){
    return DB::table('fee_heads as fh')
    ->select('ft.fee_head_type', 'fh.fee_head', 'fh.description', 'fh.academic_year', 'fh.status')
    ->join('fee_head_types as ft', 'ft.id', '=', 'fh.fee_head_type_id')
    ->get();
   }
}
