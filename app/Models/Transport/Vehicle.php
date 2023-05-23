<?php

namespace App\Models\Transport;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_no',
        'vehicle_model',
        'year_made',
        'engine_no',
        'max_seating_capacity',
        'registration_no',
        'chassis_no',
        'vehicle_photo',
        'tax_paid_date',
        'tax_expiry_date',
        'pollution_control_date',
        'pollution_expiry_date',
        'fitness_date',
        'fitness_expiry_date',
        'gprs',
        
        
    ];

    //insert
    public function insertData($req) { 
        $user_created_by = 'admin';
        $school_id = '789';
        $vehiclePhoto = "";
        $file_name = "";
        $ip = getClientIpAddress();
        $mObject = new Vehicle();     
        // if ($req->hasFile('vehiclePhoto')) {
        //   $vehiclePhoto = $req->file('vehiclePhoto');
        //   $file_extension = $vehiclePhoto->getClientOriginalExtension(); 

        //   $image_name = $req->vehicleNo.'_vehicle'.'.'.$file_extension;
        //   //$path = public_path('transport/vehicles/'.$school_id);
        //   $path = public_path('school/vehicles/'.$school_id);
        //   $move = $vehiclePhoto->move($path, $image_name);
        // }

        if($req->vehiclePhoto!=""){
          $vehiclePhoto = $req->vehiclePhoto;
          $file_name = $vehiclePhoto->getClientOriginalName();
          $path = public_path('school/vehicles/'.$school_id);
          // $path = $baseUrl.'/school/employees/'.$emp_no;
          $move = $req->file('vehiclePhoto')->move($path,$file_name);         
        } 
        
        $mObject->vehicle_no = $req['vehicleNo'];
        $mObject->vehicle_model = $req['vehicleModel'];
        $mObject->year_made = $req['yearMade'];
        $mObject->engine_no = $req['engineNo'];
        $mObject->max_seating_capacity = $req['maxSeatingCapacity'];
        $mObject->registration_no = $req['registrationNo'];
        $mObject->vehicle_photo = $file_name;
        $mObject->chassis_no = $req['chassisNo'];
        $mObject->tax_paid_date = $req['taxPaidDate'];
        $mObject->pollution_control_date = $req['pollutionControlDate'];
        $mObject->pollution_expiry_date = $req['pollutionExpiryDate'];
        $mObject->fitness_date = $req['fitnessDate'];
        $mObject->fitness_expiry_date = $req['fitnessExpiryDate'];
        $mObject->gprs = $req['gprs'];        
        $mObject->ip_address = $ip;
        $mObject->school_id = $school_id;
        $mObject->created_by = $user_created_by;
        $mObject->academic_year = $req['adacemicYear'];
        $mObject->save();
        return $mObject;
      }
      
      //view all 
      public static function list() {
        $viewAll = Vehicle::select(

            'vehicle_no',
            'max_seating_capacity',
            'gprs',

        )->where('is_deleted', '=',0)
        ->orderBy('id','asc')->get();    
        return $viewAll;

      }
  
      //view by id
      public function listById($req) {
        $data = Vehicle::select(
            'id',
            'vehicle_no',
            'vehicle_model',
            'year_made',
            'engine_no',
            'max_seating_capacity',
            'registration_no',
            'chassis_no',
            'vehicle_photo',
            'tax_paid_date',
            'tax_expiry_date',
            'pollution_control_date',
            'pollution_expiry_date',
            'fitness_date',
            'fitness_expiry_date',
            'gprs',
        )
        ->where('id', $req->id)
        ->get();
        return $data;     
      }   
  
      //update
      public function updateData($req) {
        $data = Vehicle::find($req->id);
        if (!$data)
          throw new Exception("Record Not Found!");

        if ($req->hasFile('vehiclePhoto')) {
          $vehiclePhoto = $req->file('vehiclePhoto');
          $file_extension = $vehiclePhoto->getClientOriginalExtension();

          $image_name = $req->vehicleNo.'_vehicle'.'.'.$file_extension;
          // $path = public_path('transport/vehicles/'.$data->school_id);
          $path = public_path('school/vehicles/'.$school_id);
          $move = $vehiclePhoto->move($path, $image_name);
        }
        $edit = [
            $data->vehicle_no = $req->vehicleNo,
            $data->vehicle_model = $req->vehicleModel,
            $data->year_made = $req->yearMade,
            $data->engine_no = $req->engineNo,
            $data->max_seating_capacity = $req->maxSeatingCapacity,
            $data->registration_no = $req->registrationNo,
            $data->chassis_no = $req->chassisNo,
            $data->tax_paid_date = $req->taxPaidDate,
            $data->tax_expiry_date = $req->taxExpiryDate,
            $data->pollution_control_date = $req->pollutionControlDate,
            $data->pollution_expiry_date = $req->pollutionExpiryDate,
            $data->fitness_date = $req->fitnessDate,
            $data->fitness_expiry_date = $req->fitnessExpiryDate,
            $data->gprs = $req->gprs,
            $data->vehicle_photo = $image_name,
            $data->academic_year = $req->academicYear,
        ];
        $data->update($edit);
        return $data;        
      }
  
      //delete 
      public function deleteData($req) {
        $data = Vehicle::where('is_deleted',0)->find($req->id);
        $data->is_deleted = "1";
        $data->save();
        return $data; 
      }
  
      //truncate
      public function truncateData() {
        $data = Vehicle::truncate();
        return $data;        
      } 



}
