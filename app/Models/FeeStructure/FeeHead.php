<?php

namespace App\Models\FeeStructure;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use App\Http\Traits\CustomTraits;
use Illuminate\Support\Carbon;
use DB;
use Exception;

class FeeHead extends Model
{
    use HasFactory;
    protected $fillable = [
        // 'school_id',
        'fee_head_name',
        'fee_head_c_name',
        'fee_code',
        'fee_description',
        'academic_year'
    ];

    //insert
    public function insertData($req) {      
        $mObject = new FeeHead();
        $feeHeadName = Str::ucFirst($req->feeHeadName);
        $feeCode = $req->feeCode;
        $feeDescription = Str::squish($req->feeDescription);
        $academicYear = $req->academicYear;
        $ip = getClientIpAddress();
        $createdBy = 'Admin';
        $schoolId = '123';
        $insert = [
          $mObject->school_id = $schoolId,          
          $mObject->fee_head_name   = $feeHeadName,
          $mObject->fee_head_c_name   = Str::remove(' ', $feeHeadName),
          $mObject->fee_code   = $feeCode, 
          $mObject->fee_description   = $feeDescription,
          $mObject->academic_year   =  $academicYear,
          $mObject->created_by = $createdBy,
          $mObject->ip_address = $ip
        ]; 
        // print_r($insert);die;
        $checkExist = FeeHead::where([['fee_head_name','=',$feeHeadName],['is_deleted','=','0']])->count(); 
        $checkDeleted = FeeHead::where([['fee_head_name','=',$feeHeadName],['is_deleted','=','1']])->count();
        // print_r($checkDeleted); die; 
        if($checkExist > 0){
          throw new Exception("Fee head name is already existing!");
        }
        if($checkDeleted >= 0){
            $mObject->save($insert);
        } 
        return $mObject;
      }
      
      //view all 
      public static function list() {
        // $viewAll = FeeHead::select('id','class_name')
        $getArr = array();
        $viewAll = FeeHead::select(DB::raw("
        id, fee_head_name,fee_head_c_name,fee_code,fee_description,academic_year,created_by,
        (CASE 
        WHEN is_deleted = '0' THEN 'Active' 
        WHEN is_deleted = '1' THEN 'Not Active'
        END) AS status, 
        TO_CHAR(created_at::date,'dd-mm-yyyy') as date,
        TO_CHAR(created_at,'HH12:MI:SS AM') as time
        "))
        ->where('is_deleted',0)
        ->orderBy('fee_head_name','asc')
        ->get();

        foreach ($viewAll as $value) {
          $dataArr['id'] = $value->id;
          $dataArr['feeHeadName'] = $value->fee_head_name;
          $dataArr['feeHeadCName'] = $value->fee_head_c_name;
          $dataArr['feeCode'] = $value->fee_code;
          $dataArr['feeDescription'] = $value->fee_description;
          $dataArr['academicYear'] = $value->academic_year;
          $dataArr['date'] = $value->date;
          $dataArr['time'] = $value->time;
          $dataArr['status'] = $value->status;
          $getArr[]=$dataArr; 
        }
           
        // return $viewAll;
        return $getArr;
      }
  
      //view by id
      public function listById($req) {
        $data = FeeHead::where('id', $req->id)
              ->first();
          return $data;     
      }   
  
      //update
      public function updateData($req) {
        $data = FeeHead::find($req->id);
        // $getVersion  = $data->version_no; 
        // $incVersion =  number_format($getVersion + 1) ;
        $id = $req->id;
        $feeHeadName = str::ucFirst($req->feeHeadName);
        $feeCode = $req->feeCode;
        $feeDescription = Str::squish($req->feeDescription);
        $academicYear = $req->academicYear;
        if (!$data)
              throw new Exception("Records Not Found!");
        $edit = [
          'fee_head_name' => $feeHeadName,
          'fee_head_c_name' => Str::remove(' ', $feeHeadName),
          'fee_code' => $feeCode,
          'fee_description' => $feeDescription,
          'academic_year' => $academicYear,
          'updated_at' => Carbon::now(),
          'version_no' => '1'
        ];
        // //validation 
        // $checkExist = FeeHead::where([['fee_head_name','=',$feeHeadName],['is_deleted','=','0']])->count(); 
        // if($checkExist > 0){
        //   throw new Exception("Fee Head name is already existing!");
        // }
        // if(FeeHead::where('id',$id)->exists()){
        //   $data->update($edit);
        // }      
        $data->update($edit);
        return $edit;        
      }
  
      //delete 
      public function deleteData($req) {
        $data = FeeHead::find($req->id);
        if ((!$data)||($data->is_deleted == "1"))
            throw new Exception("Records Not Found!");
        $data->is_deleted = "1";
        $data->save();
        return $data; 
      }
  
      //truncate
      public function truncateData() {
        $data = FeeHead::truncate();
        return $data;        
        } 

    // //insert
    // public function insertFeeHeadData($req) {      
    // $mObject = new FeeHead();
    // $insert = [
    //     $mObject->school_id = $req['school_id'],
    //     $mObject->fee_head_name = Str::ucfirst($req['fee_head_name']),
    //     $mObject->fee_code = $req['fee_code'],
    //     $mObject->fee_description = $req['fee_description'],
    //     $mObject->academic_year = $req['academic_year']
    // ];
    // $mObject->save($insert);
    // return $mObject;
    // }

    // //view all 
    // public static function list() {
    //     $viewAll = FeeHead::select('id','school_id','fee_head_name','fee_code','fee_description','academic_year')
    //     ->where('is_deleted', '=', 0)
    //     ->orderBy('id','desc')->get();    
    //     return $viewAll;
    // }

    // //view by id
    // public function listById($req) {
    //     $data = FeeHead::where('id', $req->id)
    //         ->first();
    //     return $data;     
    // }   

    // //update
    // public function updateFeeHeadData($req) {
    //     $data = FeeHead::find($req->id);
    //     if (!$data)
    //         throw new Exception("Record Not Found!");
    //     $edit = [
    //     'school_id' => $req->school_id,
    //     'fee_head_name' => Str::ucfirst($req->fee_head_name),
    //     'fee_code' => $req->fee_code,
    //     'fee_description' => $req->fee_description,
    //     'academic_year' => $req->academic_year
    //     ];
    //     $data->update($edit);
    //     return $data;        
    // }

    // //delete 
    // public function deleteFeeHeadData($req) {
    //     $data = FeeHead::find($req->id);
    //     $data->is_deleted = "1";
    //     $data->save();
    //     return $data; 
    // }

    // //truncate
    // public function truncateData() {
    //     $data = FeeHead::truncate();
    //     return $data;        
    // }  
}
