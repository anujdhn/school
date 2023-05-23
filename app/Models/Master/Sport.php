<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Sport extends Model
{
    use HasFactory;
    protected $fillable = [
		'sport_name'
    ];

    //insert
    public function insertData($req) {      
      $mObject = new Sport();
      $insert = [
        $mObject->sport_name   = Str::lower($req['sport_name'])
      ];
      $mObject->save($insert);
      return $mObject;
    }
    
    //view all 
    public static function list() {
      $viewAll = Sport::select('id','sport_name')
      ->where('is_deleted',0)
      ->orderBy('sport_name','asc')
      ->get();     
      return $viewAll;
    }

    //view by id
    public function listById($req) {
      $data = Sport::where('id', $req->id)
            ->first();
        return $data;     
    }   

    //update
    public function updateData($req) {
      $data = Sport::find($req->id);
      if (!$data)
            throw new Exception("Record Not Found!");
      $edit = [
        'sport_name' => $req->sport_name
      ];
      $data->update($edit);
      return $data;        
    }

    //delete 
    public function deleteData($req) {
      $data = Sport::find($req->id);
      $data->is_deleted = "1";
      $data->save();
      return $data; 
    }

    //truncate
    public function truncateData() {
      $data = Sport::truncate();
      return $data;        
    }
}
