<?php

namespace App\Models\Master;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $fillable = [
		'country_id',
        'state_id',
        'district_name',
    ];

    //insert
    public function insertData($req) {      
        $mObject = new District();
        $insert = [
            $mObject->country_id = $req['country_id'],
            $mObject->state_id = $req['state_id'],
            $mObject->district_name   = $req['district_name'],
        ];
        $mObject->save($insert);
        return $mObject;
      }
      
      //view all 
      public static function list() {
        $viewAll=District::select(
          'countries.country_name',
          'states.state_name',  
          'districts.id',
          'districts.district_name',         
        )
        ->join('countries', 'countries.id', '=', 'districts.country_id') 
        ->join('states', 'states.id', '=', 'districts.state_id')
        ->where('districts.is_deleted',0)
        ->orderBy('districts.district_name','asc')       
        ->get();
        return $viewAll;
      }
  
      //view by id
      public function listById($req) {
        $data = District::where('id', $req->id)
        ->where('is_deleted','=',0)
        ->first();
          return $data;     
      }   
  
      //update
      public function updateData($req) {
        $data = District::find($req->id);
        if (!$data)
              throw new Exception("Record Not Found!");
        $edit = [
            'country_id' => $req->country_id,
            'state_id' => $req->state_id,
            'district_name' => $req->district_name,
        ];
        $data->update($edit);
        return $data;        
      }
  
      //delete 
      public function deleteData($req) {
        $data = District::find($req->id);
        $data->is_deleted = "1";
        $data->save();
        return $data; 
      }
  
      //truncate
      public function truncateData() {
        $data = District::truncate();
        return $data;        
      }  
  
}
