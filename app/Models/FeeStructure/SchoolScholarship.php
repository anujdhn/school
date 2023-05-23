<?php

namespace App\Models\FeeStructure;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolScholarship extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'class_id',
        'fee_head_id',
        'discount_amount',
        'academic_year'
    ];
    
    //insert
    public function insertScholarshipData($req) {      
        $mObject = new SchoolScholarship();
        $insert = [
          $mObject->school_id = $req['school_id'],
          $mObject->class_id = $req['class_id'],
          $mObject->fee_head_id = $req['fee_head_id'],
          $mObject->discount_amount = $req['discount_amount'],
          $mObject->academic_year = $req['academic_year']
  
        ];
        $mObject->save($insert);
        return $mObject;
      }

    //view all 
    public static function list() {
        $viewAll = SchoolScholarship::select('id','school_id','class_id','fee_head_id','discount_amount','academic_year')
        ->where('is_deleted', '=', 0)
        ->orderBy('id','desc')->get();    
        return $viewAll;
      }

    //view by id
    public function listById($req) {
        $data = SchoolScholarship::where('id', $req->id)
              ->first();
          return $data;     
    }  
      
    //update
    public function updateScholarshipData($req) {
        $data = SchoolScholarship::find($req->id);
        if (!$data)
              throw new Exception("Record Not Found!");
        $edit = [
          'school_id' => $req->school_id,
          'class_id' => $req->class_id,
          'fee_head_id' => $req->fee_head_id,
          'discount_amount' => $req->discount_amount,
          'academic_year' => $req->academic_year
        ];
        $data->update($edit);
        return $data;        
    }

    //delete 
    public function deleteScholarshipData($req) {
        $data = SchoolScholarship::find($req->id);
        $data->is_deleted = "1";
        $data->save();
        return $data; 
    }

    //truncate
    public function truncateData() {
        $data = SchoolScholarship::truncate();
        return $data;        
    } 
}
