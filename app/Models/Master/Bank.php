<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Bank extends Model
{
    use HasFactory;
    protected $fillable = [
		'bank_name'
    ];

    //insert
    public function insertData($req) {      
        $mObject = new Bank();
        $insert = [
          $mObject->bank_name   = Str::ucfirst($req['bank_name'])
        ];
        $mObject->save($insert);
        return $mObject;
      }
      
      //view all 
      public static function list() {
        $viewAll = Bank::select('id','bank_name')
        ->orderBy('bank_name','asc')
        ->where('is_deleted','=',0)
        ->get(); 
        return $viewAll;
      }

      //view by id
      public function listById($req) {
        $data = Bank::where('id', $req->id)
        ->where('is_deleted','=',0)
        ->first();
        
        return $data;     
      }   

      //update
      public function updateData($req) {
        $data = Bank::find($req->id);
        if (!$data)
              throw new Exception("Record Not Found!");
        $edit = [
          'bank_name' => Str::ucfirst($req->bank_name)
        ];
        $data->update($edit);
        return $data;        
      }
  
      //delete 
      public function deleteData($req) {
        $data = Bank::find($req->id);
        $data->is_deleted = "1";
        $data->save();
        return $data; 
      }
  
      //truncate
      public function truncateData() {
        $data = Bank::truncate();
        return $data;        
      }
}
