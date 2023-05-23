<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Semester extends Model
{
    use HasFactory;
    protected $fillable = [
        'semester_name'
    ];

    //insert
    public function insertData($req) {      
        $mObject = new Semester();
        $insert = [
          $mObject->semester_name   = Str::lower($req['semester_name'])
        ];
        $mObject->save($insert);
        return $mObject;
      }
      
      //view all 
      public static function list() {
        $viewAll = Semester::select('id','semester_name')
        ->where('is_deleted',0)
        ->orderBy('semester_name','asc')
        ->get();     
        return $viewAll;
      }
  
      //view by id
      public function listById($req) {
        $data = Semester::where('id', $req->id)
              ->first();
          return $data;     
      }   
  
      //update
      public function updateData($req) {
        $data = Semester::find($req->id);
        if (!$data)
              throw new Exception("Record Not Found!");
        $edit = [
          'semester_name' => $req->semester_name
        ];
        $data->update($edit);
        return $data;        
      }
  
      //delete 
      public function deleteData($req) {
        $data = Semester::find($req->id);
        $data->is_deleted = "1";
        $data->save();
        return $data; 
      }
  
      //truncate
      public function truncateData() {
        $data = Semester::truncate();
        return $data;        
      }
}
