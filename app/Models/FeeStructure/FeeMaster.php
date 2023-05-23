<?php

namespace App\Models\FeeStructure;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeMaster extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_id',
        'school_id',
        'fee_head_id',
        'fee_head_amount',
        'academic_year',
    ];

    //insert
    public function insertFeeMasterData($req) {      
        $mObject = new FeeMaster();
        $insert = [
        $mObject->school_id = $req['school_id'],
        $mObject->class_id = $req['class_id'],
        $mObject->fee_head_id = $req['fee_head_id'],
        $mObject->fee_head_amount = $req['fee_head_amount'],
        $mObject->academic_year = $req['academic_year']

        ];
        $mObject->save($insert);
        return $mObject;
    }

    //view all 
    public static function list() {
        $viewAll = FeeMaster::select('id','school_id','class_id','fee_head_id','fee_head_amount','academic_year')
        ->where('is_deleted', '=', 0)
        ->orderBy('id','asc')->get();    
        return $viewAll;
    }

    //view by id
    public function listById($req) {
        $data = FeeMaster::where('id', $req->id)
        ->where('is_deleted', '=', 0)
        ->first();
        return $data;     
    }   

    //update
    public function updateFeeMasterData($req) {
        $data = FeeMaster::find($req->id);
        if (!$data)
                throw new Exception("Record Not Found!");
        $edit = [
            'school_id' => $req->school_id,
            'class_id' => $req->class_id,
            'fee_head_id' => $req->fee_head_id,
            'fee_head_amount' => $req->fee_head_amount,
            'academic_year' => $req->academic_year
        ];
        $data->update($edit);
        return $data;        
    }

        //delete 
    public function deleteFeeMasterData($req) {
        $data = FeeMaster::where('is_deleted',0)->find($req->id);
        $data->is_deleted = "1";
        $data->save();
        return $data; 
    }

    //truncate
    public function truncateData() {
        $data = FeeMaster::truncate();
        return $data;        
    }  
}
