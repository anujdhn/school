<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

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
     * | Get Discount Group Maps
     */
    public function getClassFeeMasterGroupMaps($req)
    {
        return ClassFeeMaster::where('class_id', $req->classId)
            ->where('fee_head_id', $req->feeHeadId)
            ->where('status', 1)
            ->get();
    }   
 
    public function getGroupMapById($id){
        return DB::table('class_fee_masters as a')
        ->select('a.*','b.fee_head','c.class_name')
        ->join('fee_heads as b', 'b.id', '=', 'a.fee_head_id')
        ->join('class_tables as c', 'c.id', '=', 'a.class_id') 
        ->where('a.id',$id)       
        ->first();
    }

    public function retrieveAll(){
        return DB::table('class_fee_masters as a')
        ->select('a.*','b.fee_head','c.class_name')
        ->join('fee_heads as b', 'b.id', '=', 'a.fee_head_id')
        ->join('class_tables as c', 'c.id', '=', 'a.class_id') 
        ->orderByDesc('a.id')
        ->get();
    } 
    
}
