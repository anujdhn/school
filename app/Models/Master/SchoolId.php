<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class SchoolId extends Model
{

/* commentted by : Lakshmi
Commented On: 14-Apr-2023
Description: commented due to adding some more fields

  use HasFactory;
    protected $fillable = [
		'school_id'
    ];
*/

  use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
		'school_id',
    'school_name',
    'mobile_no',
    'email',
    'password',
    'country',
    'state',
    'city',
    'address',
    'pincode',
    'is_active'
    ];


    //insert
    public function insertData($req) {      
      $mObject = new SchoolId();
      $insert = [
        $mObject->school_id     = $req['school_id'],
        $mObject->school_name   = Str::lower($req['school_name']),
        $mObject->mobile_no     = $req['mobile_no'],
        $mObject->email         = Str::lower($req['email']),
        $mObject->password      = $req['password'],
        $mObject->country       = $req['country'],
        $mObject->state         = $req['state'],
        $mObject->city          = $req['city'],
        $mObject->address       = $req['address'],
        $mObject->pincode       = $req['pincode']
      ];
      $mObject->save($insert);
      return $mObject;
    }
    
    //view all 
    public static function list() {
      $viewAll = SchoolId::select('id','school_name')
      ->where('is_deleted',0)
      ->orderBy('id','desc')
      ->get();     
      return $viewAll;
    }

    //view by id
    public function listById($req) {
      $data = SchoolId::where('id', $req->id)
            ->first();
        return $data;     
    }   

    //update
    public function updateData($req) {
      $data = SchoolId::find($req->id);
      if (!$data)
            throw new Exception("Record Not Found!");
      $edit = [
        'school_name' => $req->school_name
      ];
      $data->update($edit);
      return $data;        
    }

    //delete 
    public function deleteData($req) {
      $data = SchoolId::find($req->id);
      $data->is_deleted = "1";
      $data->save();
      return $data; 
    }

    //truncate
    public function truncateData() {
      $data = SchoolId::truncate();
      return $data;        
    }


}