<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; 
use App\Models\Master\MiscellaneousSubCategory;
use Illuminate\Support\Collection;
use Illuminate\Support\Carbon;
use DB;

class MiscellaneousCategory extends Model
{
    use HasFactory;

    protected $fillable = [
		'misc_category_name'
    ];

    //insert 
    public function insertData($req) {      
      $mObject = new MiscellaneousCategory();
      // Str::camel('student_first_name');
      $insert = [
        $mObject->misc_category_name      = Str::lower($req['misc_category_name'])
      ];
      $mObject->save($insert);
      return $mObject;
    }
    
    //view all 
    public static function list() {
      $data = array();
      $viewAll = MiscellaneousCategory::select(DB::raw("
      id, misc_category_name,
      (CASE 
      WHEN is_deleted = '0' THEN 'Active' 
      WHEN is_deleted = '1' THEN 'Not Active'
      END) AS status, 
      TO_CHAR(created_at::date,'dd-mm-yyyy') as date,
      TO_CHAR(created_at,'HH12:MI:SS AM') as time
      "))
      ->where('is_deleted',0)
      ->orderBy('misc_category_name','asc')
      ->get(); 

      //HH12:MI:SS : hour of day (01-12)
      //HH12:MI:SS : hour of day (00-23)

      // DB::raw("(DATE_FORMAT(created_at,'%Y-%m'))")
      // FORMAT ('created_at','YYYY-MM-DD') AS PerDate
      // date_format(created_at,'%d-%m-%Y')
      
      // $getDate = getFormattedDate($viewAll->created_at, 'd-m-Y');
      // $viewAll['created_at'] = $getDate;
      // foreach($viewAll as $v){
      //   $data['misc_category_name'] = $v->misc_category_name;

      // }
    //  return $s;
      // echo $newDate = $viewAll->created_at->format('d-m-Y');
      //   echo $dateS = $viewAll->created_at;
      // // $formattedDate = date($format, strtotime($date)); 
      // $getDate=date('d-m-Y', strtotime($date));
      // $viewAll['created_at'] = $getDate;
      // $data = [$viewAll , $getDate];
      return $viewAll;
    }

    //view by id
    public function listById($req) {
      $data = MiscellaneousCategory::where('id', $req->id)
            ->first();
        return $data;     
    }  
    
    //update
    public function updateData($req) {
      $data = MiscellaneousCategory::find($req->id);
      if (!$data)
            throw new Exception("Record Not Found!");
      $edit = [
        'misc_category_name'      => $req->misc_category_name
      ];
      $data->update($edit);
      return $data;        
    }

    //delete 
    public function deleteData($req) {
      $id = $req->id;
      $data = MiscellaneousCategory::find($id);
      if (!$data)
            throw new Exception("Record Not Found!");
      $data->is_deleted = "1";
      $data->save();

      //$data1 = MiscellaneousSubCategory::find('misc_category_id',$id);
      $data1 = MiscellaneousSubCategory::where('misc_category_id', $id)->get();
      // $data1 = DB::update('update miscellaneous_sub_categories set is_deleted = "1" where misc_category_id = $id');
      if (!$data1)
            throw new Exception("Record Not Found!");
            // $data1->is_deleted = "1";
            // $data1->save();

      foreach ($data1 as $d) { 
        $d->is_deleted = "1";
        $d->save();
      }
      
      
      return $data; 
    }

    //truncate
    public function truncateData() {
      $data = MiscellaneousCategory::truncate();
      return $data;        
    }
}
