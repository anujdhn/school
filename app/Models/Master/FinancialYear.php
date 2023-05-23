<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class FinancialYear extends Model
{
    use HasFactory;
    protected $fillable = [
		'fy_name'
    ];

    //insert
    public function insertData($req) {      
      $mObject = new FinancialYear();
      $insert = [
        $mObject->fy_name   = Str::lower($req['fy_name'])
      ];
      $mObject->save($insert);
      return $mObject;
    }
    
    //view all 
    public static function list() {
      $viewAll = FinancialYear::select('id','fy_name')
      ->where('is_deleted',0)
      ->orderBy('id','desc')
      ->get();     
      return $viewAll;
    }

    //view by id
    public function listById($req) {
      $data = FinancialYear::where('id', $req->id)
            ->first();
        return $data;     
    }   

    //update
    public function updateData($req) {
      $data = FinancialYear::find($req->id);
      if (!$data)
            throw new Exception("Record Not Found!");
      $edit = [
        'fy_name' => $req->fy_name
      ];
      $data->update($edit);
      return $data;        
    }

    //delete 
    public function deleteData($req) {
      $data = FinancialYear::find($req->id);
      $data->is_deleted = "1";
      $data->save();
      return $data; 
    }

    //truncate
    public function truncateData() {
      $data = FinancialYear::truncate();
      return $data;        
    }
}
