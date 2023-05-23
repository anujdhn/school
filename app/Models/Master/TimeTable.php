<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TimeTable extends Model
{
    use HasFactory;
    protected $fillable = [
		'time_tbl_name'
    ];

    //insert
    public function insertData($req) {      
      $mObject = new TimeTable();
      $insert = [
        $mObject->time_tbl_name   = Str::lower($req['time_tbl_name'])
      ];
      $mObject->save($insert);
      return $mObject;
    }
    
    //view all 
    public static function list() {
      $viewAll = TimeTable::select('id','time_tbl_name')
      ->where('is_deleted',0)
      ->orderBy('id','desc')
      ->get();     
      return $viewAll;
    }

    //view by id
    public function listById($req) {
      $data = TimeTable::where('id', $req->id)
            ->first();
        return $data;     
    }   

    //update
    public function updateData($req) {
      $data = TimeTable::find($req->id);
      if (!$data)
            throw new Exception("Record Not Found!");
      $edit = [
        'time_tbl_name' => $req->time_tbl_name
      ];
      $data->update($edit);
      return $data;        
    }

    //delete 
    public function deleteData($req) {
      $data = TimeTable::find($req->id);
      $data->is_deleted = "1";
      $data->save();
      return $data; 
    }

    //truncate
    public function truncateData() {
      $data = TimeTable::truncate();
      return $data;        
    }
}
