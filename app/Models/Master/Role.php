<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Role extends Model
{
    use HasFactory;
    protected $fillable = [
		'role_name'
    ];

    //insert
    public function insertData($req) {      
      $mObject = new Role();
      $insert = [
        $mObject->role_name   = Str::lower($req['role_name'])
      ];
      $mObject->save($insert);
      return $mObject;
    }
    
    //view all 
    public static function list() {
      $viewAll = Role::select('id','role_name')
      ->where('is_deleted',0)
      ->orderBy('role_name','asc')
      ->get();     
      return $viewAll;
    }

    //view by id
    public function listById($req) {
      $data = Role::where('id', $req->id)
            ->first();
        return $data;     
    }   

    //update
    public function updateData($req) {
      $data = Role::find($req->id);
      if (!$data)
            throw new Exception("Record Not Found!");
      $edit = [
        'role_name' => $req->role_name
      ];
      $data->update($edit);
      return $data;        
    }

    //delete 
    public function deleteData($req) {
      $data = Role::find($req->id);
      $data->is_deleted = "1";
      $data->save();
      return $data; 
    }

    //truncate
    public function truncateData() {
      $data = Role::truncate();
      return $data;        
    }
}
