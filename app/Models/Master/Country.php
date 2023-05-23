<?php

namespace App\Models\Master;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Country extends Model
{
    use HasFactory;
    protected $fillable = [
		'country_name'
    ];

    //insert
    public function insertData($req) {      
        $mObject = new Country();
        $insert = [
          $mObject->country_name   = Str::ucfirst($req['country_name'])
        ];
        $mObject->save($insert);
        return $mObject;
      }
      
      //view all 
      public static function list() {
        $viewAll = Country::select('id','country_name')
        ->orderBy('country_name','asc')
        ->where('is_deleted','=',0)
        ->get(); 
        return $viewAll;
      }

      //view by id
      public function listById($req) {
        $data = Country::where('id', $req->id)
        ->where('is_deleted','=',0)
        ->first();
          return $data;     
      }   

      //update
      public function updateData($req) {
        $data = Country::find($req->id);
        if (!$data)
              throw new Exception("Record Not Found!");
        $edit = [
          'country_name' => Str::ucfirst($req->country_name)
        ];
        $data->update($edit);
        return $data;        
      }
  
      //delete 
      public function deleteData($req) {
        $data = Country::find($req->id);
        $data->is_deleted = "1";
        $data->save();
        return $data; 
      }
  
      //truncate
      public function truncateData() {
        $data = Country::truncate();
        return $data;        
      }  
  

}
