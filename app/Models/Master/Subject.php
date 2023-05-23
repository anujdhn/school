<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Subject extends Model
{
    use HasFactory;
    
    protected $fillable = [
		'subject_name'
    ];

    //insert
    public function insertData($req) {      
      $mObject = new Subject();
      $insert = [
        $mObject->subject_name   = Str::lower($req['subject_name'])
      ];
      $mObject->save($insert);
      return $mObject;
    }
    
    //view all 
    public static function list() {
      $viewAll = Subject::select('id','subject_name')
      ->where('is_deleted',0)
      ->orderBy('subject_name','asc')
      ->get();     
      return $viewAll;
    }

    //view by id
    public function listById($req) {
      $data = Subject::where('id', $req->id)
            ->first();
        return $data;     
    }   

    //update
    public function updateData($req) {
      $data = Subject::find($req->id);
      if (!$data)
            throw new Exception("Record Not Found!");
      $edit = [
        'subject_name' => $req->subject_name
      ];
      $data->update($edit);
      return $data;        
    }

    //delete 
    public function deleteData($req) {
      $data = Subject::find($req->id);
      $data->is_deleted = "1";
      $data->save();
      return $data; 
    }

    //truncate
    public function truncateData() {
      $data = Subject::truncate();
      return $data;        
    } 
}
