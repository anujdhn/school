<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TeachingTitle extends Model
{
    use HasFactory;

    protected $fillable = [
		'teaching_title_name'
    ];

    //insert
    public function insertData($req) {      
      $mObject = new TeachingTitle();
      $insert = [
        $mObject->teaching_title_name   = Str::lower($req['teaching_title_name'])
      ];
      $mObject->save($insert);
      return $mObject;
    }
    
    //view all 
    public static function list() {
      $viewAll = TeachingTitle::select('id','teaching_title_name')
      ->where('is_deleted',0)
      ->orderBy('teaching_title_name','asc')
      ->get();     
      return $viewAll;
    }

    //view by id
    public function listById($req) {
      $data = TeachingTitle::where('id', $req->id)
            ->first();
        return $data;     
    }   

    //update
    public function updateData($req) {
      $data = TeachingTitle::find($req->id);
      if (!$data)
            throw new Exception("Record Not Found!");
      $edit = [
        'teaching_title_name' => $req->teaching_title_name
      ];
      $data->update($edit);
      return $data;        
    }

    //delete 
    public function deleteData($req) {
      $data = TeachingTitle::find($req->id);
      $data->is_deleted = "1";
      $data->save();
      return $data; 
    }

    //truncate
    public function truncateData() {
      $data = TeachingTitle::truncate();
      return $data;        
    }
}
