<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Salutation extends Model
{
    use HasFactory;
    protected $fillable = [
		'salutation_name'
    ];

    //insert
    public function insertData($req) {      
      $mObject = new Salutation();
      $insert = [
        $mObject->salutation_name   = Str::lower($req['salutation_name'])
      ];
      $mObject->save($insert);
      return $mObject;
    }
    
    //view all 
    public static function list() {
      $viewAll = Salutation::select('id','salutation_name')
      ->where('is_deleted',0)
      ->orderBy('salutation_name','asc')
      ->get();     
      return $viewAll;
    }

    //view by id
    public function listById($req) {
      $data = Salutation::where('id', $req->id)
            ->first();
        return $data;     
    }   

    //update
    public function updateData($req) {
      $data = Salutation::find($req->id);
      if (!$data)
            throw new Exception("Record Not Found!");
      $edit = [
        'salutation_name' => $req->salutation_name
      ];
      $data->update($edit);
      return $data;        
    }

    //delete 
    public function deleteData($req) {
      $data = Salutation::find($req->id);
      $data->is_deleted = "1";
      $data->save();
      return $data; 
    }

    //truncate
    public function truncateData() {
      $data = Salutation::truncate();
      return $data;        
    }
}
