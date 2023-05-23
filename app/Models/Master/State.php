<?php

namespace App\Models\Master;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class State extends Model
{
    use HasFactory;

    protected $fillable = [
		'country_id',
        'state_name',
    ];

    //insert
    public function insertData($req) {      
        $mObject = new State();
        $insert = [
            $mObject->country_id = $req['country_id'],
            $mObject->state_name   = Str::ucfirst($req['state_name'])
        ];
        $mObject->save($insert);
        return $mObject;
      }
      
      //view all 
      public static function list() {
        $viewAll=State::select(
          'countries.country_name',
          'states.id',
          'states.state_name',        
        )
        ->join('countries', 'countries.id', '=', 'states.country_id') 
        ->where('states.is_deleted',0)
        ->orderBy('states.state_name','asc')       
        ->get();
        return $viewAll;
      }
  
      //view by id
      public function listById($req) {
        $data = State::select(
          'countries.country_name',
          'states.id',
          'states.state_name',        
        )
        ->join('countries', 'countries.id', '=', 'states.country_id')        
        ->where(['states.is_deleted'=>0, 'states.id'=>$req->id])  
        ->orderBy('states.state_name','asc')  
        ->get();    
        return $data;
        // $data = State::where('id', $req->id)
        //       ->first();
        //   return $data;     
      }   
  
      //update
      public function updateData($req) {
        $data = State::find($req->id);
        if (!$data)
              throw new Exception("Record Not Found!");
        $edit = [
            'country_id' => $req->country_id,
            'state_name' => Str::ucfirst($req->state_name)
        ];
        $data->update($edit);
        return $data;        
      }
  
      //delete 
      public function deleteData($req) {
        $data = State::find($req->id);
        $data->is_deleted = "1";
        $data->save();
        return $data; 
      }
  
      //truncate
      public function truncateData() {
        $data = State::truncate();
        return $data;        
      }  
  
}
