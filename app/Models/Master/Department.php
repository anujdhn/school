<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use DB;
use Exception;

class Department extends Model
{
    use HasFactory;
    protected $fillable = [
        'department_name',
        'abbreviation_name'
    ];

    //insert
    public function insertData($req) {      
      $mObject = new Department();
      $ip = getClientIpAddress();
      $departmentName = Str::ucfirst($req->departmentName);
      $abbreviationName = Str::ucfirst($req->abbreviationName);
      $createdBy = 'Admin';
      $schoolId = '123';
      $academicYear = '2022-2023';
      $insert = [
        $mObject->department_name   = $departmentName,
        $mObject->abbreviation_name   = $abbreviationName,
        $mObject->created_by = $createdBy,
        $mObject->school_id = $schoolId,
        $mObject->academic_year = $academicYear,
        $mObject->ip_address = $ip
      ];
      $checkExist = Department::where([['department_name','=',$departmentName],['is_deleted','=','0']])->count(); 
      $checkDeleted = Department::where([['department_name','=',$departmentName],['is_deleted','=','1']])->count();
      // print_r($checkDeleted); die; 
      if($checkExist > 0){
        throw new Exception("Department name is already existing!");
      }
      if($checkDeleted >= 0){
          $mObject->save($insert);
      } 
      // $mObject->save($insert);
      return $mObject;
    }   
      
    //view all 
    public static function list() {
    // $viewAll = Department::select('id','department_name','abbreviation_name','created_by')
    $viewAll = Department::select(DB::raw("
      id, department_name,abbreviation_name,
      (CASE 
      WHEN is_deleted = '0' THEN 'Active' 
      WHEN is_deleted = '1' THEN 'Not Active'
      END) AS status, 
      TO_CHAR(created_at::date,'dd-mm-yyyy') as date,
      TO_CHAR(created_at,'HH12:MI:SS AM') as time
      "))
    ->where('is_deleted',0)
    ->orderBy('department_name','asc')
    ->get();       
      return $viewAll;
    }
  
      //view by id
      public function listById($req) {
        $data = Department::where('id', $req->id)
              ->first();
          return $data;     
      }   
  
      //update
      public function updateData($req) {
        $data = Department::find($req->id);
        $getVersion  = $data->version_no; 
        $incVersion =  number_format($getVersion + 1) ;
        $id = $req->id;
        $departmentName = Str::ucfirst($req->departmentName);
        $abbreviationName = Str::ucfirst($req->abbreviationName);
        if (!$data)
              throw new Exception("Records Not Found!");
        $edit = [
          'department_name' => $departmentName,
          'abbreviation_name' => $abbreviationName,
          'updated_at' => Carbon::now(),
          'version_no' => $incVersion
        ];       
        //validation 
        $checkExist = Department::where([['department_name','=',$departmentName],['is_deleted','=','0']])->count(); 
        if($checkExist > 0){
          throw new Exception("Department name is already existing!");
        }
        if(Department::where('id',$id)->exists()){
          $data->update($edit);
        }
        return $edit;        
      }
      // public function updateData($req) {
      //   $data = Department::find($req->id);
      //   if (!$data)
      //         throw new Exception("Record Not Found!");
      //   $edit = [
      //     'department_name' => $req->department_name,
      //     'abbreviation_name' => $req->abbreviation_name
      //   ];
      //   $data->update($edit);
      //   return $data;        
      // }
  
      //delete 
      public function deleteData($req) {
        $data = Department::find($req->id);
        $data->is_deleted = "1";
        $data->save();
        return $data; 
      }
  
      //truncate
      public function truncateData() {
        $data = Department::truncate();
        return $data;        
      }
}
