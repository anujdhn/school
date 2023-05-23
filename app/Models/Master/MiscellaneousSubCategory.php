<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Master\MiscellaneousCategory;
use Illuminate\Support\Collection;
use Illuminate\Support\Carbon;
use Exception;
use DB;


class MiscellaneousSubCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'misc_category_id',
        'misc_sub_category_name'
    ];

    //Function for insert data
    public function insertData($req) {      
    $mObject = new MiscellaneousSubCategory();
    $misc_category_id = $req->misc_category_id;
    $misc_sub_category_name = Str::ucFirst($req->misc_sub_category_name);
    // $misc_sub_category_name = Str::of($req->misc_sub_category_name)->title();
    $insert = [
        $mObject->misc_category_id          = $misc_category_id,
        $mObject->misc_sub_category_name    = $misc_sub_category_name
    ];
    // print_r($insert);die;

    //validation 
    $checkExist = MiscellaneousSubCategory::where([['misc_sub_category_name','=',$misc_sub_category_name],['is_deleted','=','0']])->count(); 
    $checkDeleted = MiscellaneousSubCategory::where([['misc_sub_category_name','=',$misc_sub_category_name],['is_deleted','=','1']])->count();
    // print_r($checkDeleted); die; 
    if($checkExist > 0){
    throw new Exception("Misc. sub name is already existing!");
    }
    if($checkDeleted >= 0){
        $mObject->save($insert);
    } 
    return $mObject;

    //validation
    // $checkExist = MiscellaneousSubCategory::where([      
    //     'misc_sub_category_name'=>$misc_sub_category_name]
    // ->exist());

    // $checkDeleted = MiscellaneousSubCategory::where([      
    //     'misc_sub_category_name'=>$misc_sub_category_name,
    //     'is_deleted'=>$isDeleted]
    // ->exist());

    // if($checkExist){
    //    throw new Exception("Duplicate Records!");
    // }
    // if($checkDeleted){
    //     $mObject->save($insert);
    //     //throw new Exception("Duplicate Records!");
    // }

    // $mObject->save($insert);
    return $mObject;
    }

    //view all 
    public static function list() {
        //added convert date in query
        // $viewAll=MiscellaneousSubCategory::select(
        //     'miscellaneous_sub_categories.id',
        //     'miscellaneous_sub_categories.misc_category_id',
        //     'miscellaneous_categories.misc_category_name',
        //     'miscellaneous_sub_categories.misc_sub_category_name',
        //     'miscellaneous_sub_categories.created_at')
        // ->join('miscellaneous_categories', 'miscellaneous_categories.id', '=', 'miscellaneous_sub_categories.misc_category_id') 
        // ->where('miscellaneous_sub_categories.is_deleted',0)
        // ->orderBy('miscellaneous_categories.misc_category_name','asc')       
        // ->get();
        // return $viewAll;
        
        //start new query with date time conversion
        $viewAll = MiscellaneousSubCategory::select(DB::raw("    
        miscellaneous_sub_categories.misc_category_id, 
        miscellaneous_categories.misc_category_name, 
        miscellaneous_sub_categories.id,
        miscellaneous_sub_categories.misc_sub_category_name,    
        miscellaneous_sub_categories.is_deleted as status,
        (CASE 
        WHEN miscellaneous_sub_categories.is_deleted = '0' THEN 'Active' 
        WHEN miscellaneous_sub_categories.is_deleted = '1' THEN 'Not Active'
        END) AS status,
        TO_CHAR(miscellaneous_sub_categories.created_at::date,'dd-mm-yyyy') as date,
        TO_CHAR(miscellaneous_sub_categories.created_at,'HH12:MI:SS AM') as time
        "))
        ->join('miscellaneous_categories', 
        'miscellaneous_categories.id', '=', 'miscellaneous_sub_categories.misc_category_id') 
        ->where('miscellaneous_sub_categories.is_deleted',0)
        ->orderBy('miscellaneous_categories.misc_category_name','asc')       
        ->get();
        return $viewAll;


        // '(CASE 
        // WHEN miscellaneous_sub_categories.is_deleted = "0" THEN "Not Active" 
        // WHEN miscellaneous_sub_categories.is_deleted = "1" THEN "Active" 
        // ELSE "SuperAdmin" 
        // END) AS status'
    }

    //get sub cat data for show all list and call it in just above
    // public function subCatAllList($catId){
    //     $getCatArr1 = array();
    //     $getSubCatList = MiscellaneousSubCategory::select('id','misc_category_id','misc_sub_category_name')
    //     ->orderBy('misc_sub_category_name')
    //     ->where('misc_category_id',$catId)
    //     ->where('is_deleted',0)
    //     ->get();
    //     foreach ($getSubCatList as $subCatList) {

    //         $subCatArr1['sub_category_id'] = $subCatList->id;
    //         // $subCatArr1['misc_category_id'] = $subCatList->misc_category_id;
    //         $subCatArr1['sub_category_name'] = $subCatList->misc_sub_category_name;
    //         $getCatArr1[]=$subCatArr1;
    //     }
    //     return $getCatArr1;
    // }


    //view by id
    public function listById($req) {
    // $data = MiscellaneousSubCategory::where('id', $req->id)
    // ->first();

    $data=MiscellaneousSubCategory::select(
        'miscellaneous_sub_categories.id',
        'miscellaneous_sub_categories.misc_category_id',
        'miscellaneous_categories.misc_category_name',
        'miscellaneous_sub_categories.misc_sub_category_name')
    ->join('miscellaneous_categories', 'miscellaneous_categories.id', '=', 'miscellaneous_sub_categories.misc_category_id') 
    ->where(['miscellaneous_sub_categories.is_deleted'=>0, 'miscellaneous_sub_categories.id'=>$req->id])
    ->orderBy('miscellaneous_sub_categories.id','asc')       
    ->get();
    return $data;     
    } 

    //commenting due to prashant needs
    // //view by name
    // public function listByName($req) {
    // $getData = MiscellaneousCategory::where('misc_category_name', $req->misc_category_name)->first();
    // $getCategory =  $getData->misc_category_name;
    // $getCategoryId =  $getData->id;

    // $data1=MiscellaneousSubCategory::select(
    //     'miscellaneous_sub_categories.misc_category_id',
    //     'miscellaneous_categories.misc_category_name',
    //     'miscellaneous_sub_categories.id',
    //     'miscellaneous_sub_categories.misc_sub_category_name')
    // //$data1=MiscellaneousSubCategory::select('miscellaneous_sub_categories.id','miscellaneous_sub_categories.misc_sub_category_name')
    // ->join('miscellaneous_categories', 'miscellaneous_categories.id', '=', 'miscellaneous_sub_categories.misc_category_id') 
    // ->where(['miscellaneous_sub_categories.is_deleted'=>0, 'miscellaneous_sub_categories.misc_category_id'=>$getCategoryId])
    // ->orderBy('miscellaneous_sub_categories.id','asc')       
    // ->get();
    // $data = [$getCategory, $data1];
    // return $data;     
    // }  

    //view by name : according to prashant needs
    public function listByName() {        
        // $getSubData=MiscellaneousSubCategory::select(
        // 'miscellaneous_sub_categories.misc_category_id',
        // 'miscellaneous_categories.misc_category_name',
        // 'miscellaneous_sub_categories.id',
        // 'miscellaneous_sub_categories.misc_sub_category_name')
        // ->join(
        // 'miscellaneous_categories', 
        // 'miscellaneous_categories.id', '=', 'miscellaneous_sub_categories.misc_category_id') 
        // ->where(['miscellaneous_sub_categories.is_deleted'=>0])
        // ->orderBy('miscellaneous_sub_categories.id','asc')              
        // ->get()
        // ->groupBy('miscellaneous_sub_categories.misc_category_id') ;
        // return $getSubData;  
        
        // $getCatArr = array();
        // $getCatList = MiscellaneousCategory::select('id','misc_category_name','created_at')
        // ->orderBy('misc_category_name')
        // ->get();
        // $catArray = array();

        // foreach ($getCatList as $catList) {
        //     $catArray['category_id'] = $catList->id;
        //     $catArray['category_name'] = $catList->misc_category_name;
        //     $catArray['sub_category_name'] = $this->subCatList($catList->id);
        //     $getCatArr[]=$catArray;
        // }
        
        // $getCatArr = collect($getCatList)->map(function($value)
        // {
        //      $returnValue['category_id'] = $value['id'];
        //      $ref = Str::upper($value['misc_category_name']);
        //      $returnValue['thd'] = $value['misc_category_name'];
        //      $returnValue[$ref] = $this->subCatList($value['id']);
        //      return $returnValue;
        // });
        
        //return $getCatArr;

        $getCatArr = array();
        $getCatList = MiscellaneousCategory::select('id','misc_category_name')
        ->orderBy('misc_category_name')
        ->get();
        $catArray = array();
        foreach ($getCatList as $catList) {
            $catArray['category_id'] = $catList->id;
            $catArray['category_name'] = $catList->misc_category_name;
            $catArray['sub_category_list'] = $this->subCatList($catList->id);
            $getCatArr[]=$catArray;
        }
        return $getCatArr;
    }
    
    //get sub cat data and call it in just above
    public function subCatList($catId){
        $getCatArr = array();
        $getSubCatList = MiscellaneousSubCategory::select('id','misc_category_id','misc_sub_category_name')
        ->orderBy('misc_sub_category_name')
        ->where('misc_category_id',$catId)
        ->where('is_deleted',0)
        ->get();
        foreach ($getSubCatList as $subCatList) {
            $subCatArr1['sub_category_id'] = $subCatList->id;
            // $subCatArr1['misc_category_id'] = $subCatList->misc_category_id;
            $subCatArr1['sub_category_name'] = $subCatList->misc_sub_category_name;
            $getCatArr[]=$subCatArr1;
        }
        return $getCatArr;
    }    

    //update
    public function updateData($req) {
        $data = MiscellaneousSubCategory::find($req->id);
        if (!$data)
            throw new Exception("Record Not Found!");

        $id = $req->id;
        $miscSubName = $req->misc_sub_category_name;
        $getMiscSubCatId = MiscellaneousSubCategory::select('id','misc_category_id','misc_sub_category_name')
        ->where(['id'=>$id],['is_deleted'=>0])
        ->first();
        $miscCatId = $getMiscSubCatId->misc_category_id;
        // print_r($getMiscSubCatId);die;
        
        $edit = [
            'misc_sub_category_name'   => Str::ucFirst($miscSubName),
            'updated_at' => Carbon::now(),
            'version_no' => $incVersion
        ];
        // $data->update($edit);
        // return $data; 
    
        //validation 
        // $checkExist = MiscellaneousSubCategory::where([['misc_sub_category_name','=',$misc_sub_category_name],['is_deleted','=','0']])->count(); 
        $checkExist = MiscellaneousSubCategory::where(['misc_category_id'=> $miscCatId],['misc_sub_category_name'=>$miscSubName],['is_deleted'=>'0'])->count(); 
        if($checkExist > 0){
            throw new Exception("Misc. sub name is already existing!");
        }
        if(MiscellaneousSubCategory::where('id',$id)->exists()){
            $data->update($edit);
        } 
        return $data; 
    }

    //delete 
    public function deleteData($req) {
    $data = MiscellaneousSubCategory::find($req->id);
    $data->is_deleted = "1";
    $data->save();
    return $data; 
    }

    //truncate
    public function truncateData() {
    $data = MiscellaneousSubCategory::truncate();
    return $data;        
    }
}
