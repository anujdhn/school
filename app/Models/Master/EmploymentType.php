<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class EmploymentType extends Model
{
    use HasFactory;

    protected $fillable = [
        'emp_type_name'
    ];

    //insert
    public function insertData($req) {      
        $mObject = new EmploymentType();
        $created_by = 'admin';
        $insert = [
          $mObject->emp_type_name   = Str::lower($req['emp_type_name'])     
        ];
        $mObject->save($insert);
        return $mObject;
      }
      
      //view all 
      public static function list() {
      $viewAll = EmploymentType::select('id','emp_type_name')
      ->where('is_deleted',0)
      ->orderBy('emp_type_name','asc')
      ->get();       
        return $viewAll;
      }
  
      //view by id
      public function listById($req) {
        $data = EmploymentType::where('id', $req->id)
              ->first();
          return $data;     
      }   
  
      //update
      public function updateData($req) {
        $data = EmploymentType::find($req->id);
        if (!$data)
              throw new Exception("Record Not Found!");
        $edit = [
          'emp_type_name' => $req->emp_type_name
        ];
        $data->update($edit);
        return $data;        
      }
  
      //delete 
      public function deleteData($req) {
        $data = EmploymentType::find($req->id);
        $data->is_deleted = "1";
        $data->save();
        return $data; 
      }
  
      //truncate
      public function truncateData() {
        $data = EmploymentType::truncate();
        return $data;        
      }
}
