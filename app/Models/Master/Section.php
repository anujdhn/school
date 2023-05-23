<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use DB;
use Exception;

class Section extends Model
{
    use HasFactory;
    protected $fillable = [
		'section_name'
    ];

    //insert
    public function insertData($req) {      
      $mObject = new Section();
      $ip = getClientIpAddress();
      $sectionName = Str::upper($req->sectionName);
      $user_created_by = 'Admin';
      $insert = [
        $mObject->section_name   = Str::upper($req['sectionName']),
        $mObject->created_by = $user_created_by,
        $mObject->ip_address = $ip
      ];
      $checkExist = Section::where([['section_name','=',$sectionName],['is_deleted','=','0']])->count(); 
      $checkDeleted = Section::where([['section_name','=',$sectionName],['is_deleted','=','1']])->count();
      // print_r($checkDeleted); die; 
      if($checkExist > 0){
        throw new Exception("Section name  is already existing!");
      }
      if($checkDeleted >= 0){
          $mObject->save($insert);
      } 
      // $mObject->save($insert);
      return $mObject;
    }
    
    //view all 
    public static function list() {
      // $viewAll = Section::select('id','section_name')
      $viewAll = Section::select(DB::raw("
      id, section_name,
      (CASE 
      WHEN is_deleted = '0' THEN 'Active' 
      WHEN is_deleted = '1' THEN 'Not Active'
      END) AS status, 
      TO_CHAR(created_at::date,'dd-mm-yyyy') as date,
      TO_CHAR(created_at,'HH12:MI:SS AM') as time
      "))
      ->where('is_deleted',0)
      ->orderBy('section_name','asc')
      ->get();   
      return $viewAll;
    }

    //view by id
    public function listById($req) {
      $data = Section::where('id', $req->id)
            ->first();
        return $data;     
    }   

    //update
    public function updateData($req) {
      $data = Section::find($req->id);
      $getVersion  = $data->version_no; 
      $incVersion =  number_format($getVersion + 1) ;
      $id = $req->id;
      $sectionName = str::upper($req->sectionName);
      if (!$data)
            throw new Exception("Records Not Found!");
      $edit = [
        'section_name' => str::upper($req->sectionName),
        'updated_at' => Carbon::now(),
        'version_no' => $incVersion
      ];
      $checkExist = Section::where([['section_name','=',$sectionName],['is_deleted','=','0']])->count(); 
      if($checkExist > 0){
        throw new Exception("Section name is already existing!");
      }      
      if(Section::where('id',$id)->exists()){
        $data->update($edit);
      }
      return $edit;        
    }
    // public function updateData($req) {
    //   $data = Section::find($req->id);
    //   if (!$data)
    //         throw new Exception("Record Not Found!");
    //   $edit = [
    //     'section_name' => $req->section_name
    //   ];
    //   $data->update($edit);
    //   return $data;        
    // }

    //delete 
    public function deleteData($req) {
      $data = Section::find($req->id);
      if ((!$data)||($data->is_deleted == "1"))
          throw new Exception("Records Not Found!");
      $data->is_deleted = "1";
      $data->save();
      return $data; 
    }

    //truncate
    public function truncateData() {
      $data = Section::truncate();
      return $data;        
    } 
}
