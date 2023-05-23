<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Admin\User;
use App\Models\Master\SchoolId;
use Validator;
use Auth;
// use Illuminate\Support\Facades\Redis;

/*=================================================== User API ==============================================================
Created By : Lakshmi kumari 
Created On : 03-Apr-2023 
Code Status : Open 
*/

class UserController extends Controller
{  
    //Register API Start
    /* Version - 1 : Registeration form for Super Admin */
    public function register(Request $req) { 
        try {
            $validator = Validator::make($req->all(), [
                'name' => 'required|string|max:30',
                'email' => 'required|email|unique:users|max:100',
                'password' => 'required|string|max:30'
            ]);            
            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json([
                    'error' => $errors
                ], 400);
            }
            if ($validator->passes()) {
                $mObject = new User();
                $data = $mObject->insertData($req);
               // $data1 = ["name" => $req->name, "email" =>$req->email, "password" =>$req->password, "UserId"=>$data->$genUserID];
                $mDeviceId = $req->deviceId ?? "";
                $getResponseTime = responseTime();        
                return responseMsgs(true, "Records added successfully", $data, "API_ID_1","", $getResponseTime, "post", $mDeviceId);
            }
        } catch (Exception $e) {
            return responseMsgs(false, $e->getMessage(), "", "API_ID_1","", "", "post", $mDeviceId);
        }                 
    }
    //Register API End

    //Login API Start
    /* Version - 1 : Login of a user with sanctum token */
    public function login(Request $req) {         
        try{
            $validator = Validator::make($req->all(), [
                'email' => 'required|email',
                'password' => 'required'
            ]);
            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json([
                    'error' => $errors
                ], 400);
            }
            if ($validator->passes()) {
                $email = User::where('email', $req->email)->first();
                $mDeviceId = $req->deviceId ?? ""; 
                if (!$email) {
                    $msg = "Oops! Given email does not exist";
                    return responseMsg(false, $msg, "");
                }

                // check if user deleted
                if ($email->is_deleted == 1) {
                    $msg = "Cant logged in!! You Have Been Suspended or Deleted !";
                    return responseMsg(false, $msg, "");
                } 

                //check if users email is not empty
                if ($email!="") {  $user = $email; } 

                //check if user and password is exist            
                if($user && Hash::check($req->password, $user->password)){
                    $token = $email->createToken('auth_token')->plainTextToken; 
                    $email->remember_token = $token;
                    $email->save();
                    $data1 = ['email'=>$req->email,'token'=>$token,'token_type' => 'Bearer'];
                }
                return responseMsgsT(true, "Login successfully", $data1, "API_ID_2","", "186ms", "post", $mDeviceId,$token);
            }
        } catch (Exception $e) {
            return responseMsgsT(false, $e->getMessage(), "", "API_ID_2","", "", "post", $mDeviceId,$token);
        }      
    }
    //Login API End

    //View Profile API Start  
    /* Version - 1 : view authenticated users profile */  
    public function profile(Request $req) {
        try {
            $userProfile = new User();
            $data  = $userProfile->viewProfile($req);
            $mDeviceId = $req->deviceId ?? "";
            return responseMsgs(true, "View profile", $data, "API_ID_5","", "146ms", "post", $mDeviceId);
        } catch (Exception $e) {
            return responseMsgs(false, $e->getMessage(), $data, "API_ID_5","", "", "post", $mDeviceId);
        }
    }
    //View Profile API End

    //Edit Profile API Start  
    /* Version - 1 : edit authenticated users profile */  
    public function editProfile(Request $req) {
        try {
            $mObject = new User();
            $data = $mObject->updateProfile($req);
            $mDeviceId = $req->deviceId ?? "";
            return responseMsgs(true, "Records updated successfully", $data, "API_ID_6","", "213ms", "get", $mDeviceId);
        } catch (Exception $e) {
            return responseMsgs(false, $e->getMessage(), $data, "API_ID_6","", "", "get", $mDeviceId);
        }
    }
    //Edit Profile API End   
    
    //Delete Profile API Start    
    public function deleteProfile(Request $req){
        //Description: delete of authenticate user's profile using sanctum token
        try {
            $mObject = new User();
            $data = $mObject->deleteData($req);
            $mDeviceId = $req->deviceId ?? "";
            return responseMsgs(true, "Records deleted successfully", $data, "API_ID_9","", "173ms", "post", $mDeviceId);
        } catch (Exception $e) {
            return responseMsgs(false, $e->getMessage(), $data, "API_ID_9","", "", "post", $mDeviceId);
        } 

        // $id = $request->id;        
        // if(User::where('id',$id)->exists()){
        //     $user = User::findorFail($id);
        //     $user->delete();

        //     $status = 'Sucess';
        //     $message = 'Profile deleted successfully';
        //     $data = $user;
        //     $api = 'API_ID_9';
        //     $responseTime = '';
        //     $epoch = '';
        //     $action = 'post';
        //     $metaData = [
        //         'API'=>$api,
        //         'response_time'=>$responseTime,
        //         'epoch'=>$epoch,
        //         'action'=>$action
        //     ];            
        //     return responseMsg($status,$message,$data,$metaData);

        // }
            
    }    
    //Delete Profile API End

    //Change Password API Start   
    public function changePassword(Request $req){
        //Description: Change password of authenticate user's using sanctum token

        try {
            $mObject = new User();
            $data = $mObject->updatePassword($req);
            $mDeviceId = $req->deviceId ?? "";
            return responseMsgs(true, "Records updated successfully", $data, "API_ID_8","", "213ms", "post", $mDeviceId);
        } catch (Exception $e) {
            return responseMsgs(false, $e->getMessage(), $data, "API_ID_8","", "", "post", $mDeviceId);
        } 

        // try{
        //     $request->validate([
        //         'password' => 'required|confirmed'
        //     ]);
        //     $user = auth()->user();
        //     if($user!=""){ 
        //         $user->password = Hash::make($request->password);
        //         $user->save();

        //         $status = 'Sucess';
        //         $message = 'Password changed successfully';
        //         $data = $user;
        //         $api = 'API_ID_8';
        //         $responseTime = '';
        //         $epoch = '';
        //         $action = 'post';
        //         $metaData = [
        //             'API'=>$api,
        //             'response_time'=>$responseTime,
        //             'epoch'=>$epoch,
        //             'action'=>$action
        //         ];            
        //         return responseMsg($status,$message,$data,$metaData);
        //         // return response()->json([
        //         //     'code'=>'201',
        //         //     'status'=>'success',
        //         //     'API'=>'API_ID_8',
        //         //     'message'=>'Password changed successfully'
        //         // ]);
        //     }
        //     // return response()->json([
        //     //     'code'=>'401',
        //     //     'status'=>'Fail',
        //     //     'message'=>'Unauthorized!'
        //     // ]); 
        // }catch(\Exception $e) {
        //     return response()->json([
        //         'code'=>'500',
        //         'status'=>'Fail',
        //         'message'=>$e->getMessage()
        //     ]);
        // } 
    }    
    //Change Password API End

    //Logout API Start    
    public function logout(){
        try {
            $id = auth()->user()->id;
            $user = User::where('id', $id)->first();
            $user->remember_token = null;
            $user->save();

            $user->tokens()->delete();
            $mDeviceId = $req->deviceId ?? "";
            return responseMsgs(true, "Logged out successfully", "", "API_ID_133","", "213ms", "post", $mDeviceId);
        } catch (Exception $e) {
            return responseMsgs()->json($e, 400);
        }

        //Description: Logout from user's profile using sanctum token
        /*
            $user = auth()->user();
            if($user!=""){
                $user->tokens()->delete();

                $status = 'Sucess';
                $message = 'Logged out successfully';
                $data = $user;
                $api = 'API_ID_7';
                $responseTime = '';
                $epoch = '';
                $action = 'post';
                $metaData = [
                    'API'=>$api,
                    'response_time'=>$responseTime,
                    'epoch'=>$epoch,
                    'action'=>$action
                ];            
                return responseMsg($status,$message,$data,$metaData);

            }
        */
           
        
    }
    //Logout API End
}

//================================================= End User API ===========================================================
