<?php

namespace App\Models\FeeStructure;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeHeadType extends Model
{
    use HasFactory;
    // protected $table = 'fee_head_types';
    protected $guarded=[];

    public function store(array $req){
      FeeHeadType::create($req);
    }

    // public function view(array $req){
    //   FeeHeadType::create($req);
    // }

    // //insert
    // public function insertData($req) {      
    //     $mObject = new FeeHeadType();
    //     $feeHeadType = Str::ucFirst($req->feeHeadType);
    //     $isAnnual = $req->isAnnual;
    //     $isOptional = $req->isOptional;
    //     $isLateFineApplicable = $req->isLateFineApplicable;
    //     $academicYear = $req->academicYear;
    //     $ip = getClientIpAddress();
    //     $createdBy = 'Admin';
    //     $schoolId = 'DAV_Ranchi_834001';

    //     $insert = [
    //       $mObject->fee_head_type = $feeHeadType,          
    //       $mObject->is_annual   = $isAnnual,
    //       $mObject->is_optional   = $isOptional,
    //       $mObject->is_latefee_applicable   = $isLateFineApplicable, 
    //       $mObject->school_id   = $schoolId,
    //       $mObject->academic_year   =  $academicYear,
    //       $mObject->created_by = $createdBy,
    //       $mObject->ip_address = $ip
    //     ]; 
    //     // print_r($insert);die;
    //     $checkExist = FeeHeadType::where([['fee_head_type','=',$feeHeadType],['is_deleted','=','0']])->count(); 
    //     $checkDeleted = FeeHeadType::where([['fee_head_type','=',$feeHeadType],['is_deleted','=','1']])->count();
    //     // print_r($checkDeleted); die; 
    //     if($checkExist > 0){
    //       throw new Exception("Fee head type name is already existing!");
    //     }
    //     if($checkDeleted >= 0){
    //         $mObject->save($insert);
    //     } 
    //     return $mObject;
    //   }
      
    //   //view all 
    //   public static function list() {
    //     $getArr = array();
    //     $viewAll = FeeHeadType::select(DB::raw("*,
    //     (CASE 
    //     WHEN is_deleted = '0' THEN 'Active' 
    //     WHEN is_deleted = '1' THEN 'Not Active'
    //     END) AS status, 
    //     TO_CHAR(created_at::date,'dd-mm-yyyy') as date,
    //     TO_CHAR(created_at,'HH12:MI:SS AM') as time
    //     "))
    //     ->where('is_deleted',0)
    //     ->orderBy('fee_head_type')
    //     ->get();

    //     // print_r($viewAll);die;

    //     foreach ($viewAll as $value) {
    //       $dataArr['Id'] = $value->id;
    //       $dataArr['feeHeadType'] = $value->fee_head_type;
    //       $dataArr['isAnnual'] = $value->is_annual;
    //       $dataArr['isOptional'] = $value->is_optional;
    //       $dataArr['isLateFineApplicable'] = $value->is_latefee_applicable;
    //       $dataArr['academicYear'] = $value->academic_year;
    //       $dataArr['date'] = $value->date;
    //       $dataArr['time'] = $value->time;
    //       $dataArr['status'] = $value->status;
    //       $getArr[]=$dataArr; 
    //     }
    //     // return $viewAll;
    //     return $getArr;
    //   }
  
    //   //view by id
    //   public function listById($req) {
    //     $id = $req->Id; 
    //     $getArr = array();
    //     $viewById = FeeHeadType::select(DB::raw("*,
    //     (CASE 
    //     WHEN is_deleted = '0' THEN 'Active' 
    //     WHEN is_deleted = '1' THEN 'Not Active'
    //     END) AS status, 
    //     TO_CHAR(created_at::date,'dd-mm-yyyy') as date,
    //     TO_CHAR(created_at,'HH12:MI:SS AM') as time
    //     "))
    //     ->where('is_deleted',0)
    //     ->where('id',$id)
    //     ->orderBy('fee_head_type')
    //     ->first();
        
    //     $dataArr['Id'] = $viewById->id;
    //     $dataArr['feeHeadType'] = $viewById->fee_head_type;
    //     $dataArr['isAnnual'] = $viewById->is_annual;
    //     $dataArr['isOptional'] = $viewById->is_optional;
    //     $dataArr['isLateFineApplicable'] = $viewById->is_latefee_applicable;
    //     $dataArr['academicYear'] = $viewById->academic_year;
    //     $dataArr['date'] = $viewById->date;
    //     $dataArr['time'] = $viewById->time;
    //     $dataArr['status'] = $viewById->status;
    //     $getArr[]=$dataArr; 
        
    //     return $getArr;            
    //   }   
  
    //   //update
    //   public function updateData($req) {
    //     $id = $req->Id; 
    //     $data = FeeHeadType::find($id);
    //     $getVersion  = $data->version_no;
    //     $editVersion =  number_format($getVersion + 1) ;  
    //     $feeHeadType = Str::ucFirst($req->feeHeadType);
    //     $isAnnual = $req->isAnnual;
    //     $isOptional = $req->isOptional;
    //     $isLateFineApplicable = $req->isLateFineApplicable;
    //     $academicYear = $req->academicYear;
    //     $schoolId = 'DAV_Ranchi_834001';

    //     if (!$data)
    //           throw new Exception("Records Not Found!");
    //     $edit = [
    //       'fee_head_type' => $feeHeadType,
    //       'is_annual' => $isAnnual,
    //       'is_optional' => $isOptional,
    //       'is_latefee_applicable' => $isLateFineApplicable,
    //       'academic_year' => $academicYear,
    //       'updated_at' => Carbon::now(),
    //       'version_no' => $editVersion
    //     ];

    //     //validation 
    //     $checkExist = FeeHeadType::where([
    //         ['fee_head_type','=',$feeHeadType],
    //         ['is_annual','=',$isAnnual],
    //         ['is_optional','=',$isOptional],
    //         ['is_latefee_applicable','=',$isLateFineApplicable],
    //         ['academic_year','=',$academicYear],
    //         ['school_id','=',$schoolId],
    //         ['is_deleted','=','0']
    //     ])->count(); 
    //     if($checkExist > 0){
    //       throw new Exception("Fee Head type name is already existing!");
    //     }
    //     if(FeeHeadType::where('id',$id)->exists()){
    //       $data->update($edit);
    //     }      
        
    //     // $data->update($edit);
    //     // return $edit;        
    //   }
  
    //   //delete 
    //   public function deleteData($req) {
    //     $id = $req->Id;
    //     $data = FeeHeadType::find($id);
    //     if ((!$data)||($data->is_deleted == "1"))
    //         throw new Exception("Records Not Found!");
    //     $data->is_deleted = "1";
    //     $data->save();
    //     return $data; 
    //   }
}
