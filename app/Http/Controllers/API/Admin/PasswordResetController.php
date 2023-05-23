<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; //for password encryption
use Illuminate\Support\Facades\Mail; //for mail
use Illuminate\Mail\Message; //for send message via email
use Carbon\Carbon; //for email
use Illuminate\Support\Str; //generate random token
use App\Models\Admin\PasswordReset;
use App\Models\Admin\User;


/*================================================ Password Reset API =======================================================
Created By : Lakshmi kumari 
Created On : 10-Apr-2023 
Code Status : Open 
*/
class PasswordResetController extends Controller
{  
    //Email Send API Start
    public function sendResetPasswordEmail(Request $request) {
        //Description: Sending passeord reset link to email
        try{
            $email = $request->email;
            $request->validate([
                'email'=>'required|email',
            ]);

            //Check user's email exist or not
            $user = User::where('email', $email)->first();
            if(!$user){
                return response()->json([
                    'message'=>'Email not exist',
                    'status'=>'failed'
                ]);
            }
            
            //Generate token
            $token = Str::random(60);

            //Saving data to present reset table
            PasswordReset::create([
                'email'=>$email,
                'token'=>$token,
                'created_at'=>Carbon::now()
            ]);
            // dump("http://127.0.0.1:8000/api/resetPassword".$token);

            //Send email with password reset view
            Mail::send('reset',['token'=>$token], function(Message $message) use($email){
                $message->subject('Reset your password');
                $message->to($email);
            });

            return response()->json([
                'message'=>'Password reset email sent... check your email',
                'status'=>'success',
                'API'=>'API_ID_3'
            ]);
        }catch(\Exception $e){
            return response()->json([
                'code'=>'500',
                'status'=>'Fail',
                'message'=>$e->getMessage()
            ]);
        }
    }
    //Email Send API End

    //Reset Password API Start
    public function resetPassword(Request $request, $token) {
        try{
            //Delete token older than 1 minute
            $formatted = Carbon::now()->subMinutes(1)->toDateTimeString();
            PasswordReset::where('created_at', '<=', $formatted)->delete();

            $request->validate([
                'password'=>'required|confirmed',
            ]);
            $passwordReset = PasswordReset::where('token', $token)->first();
            if(!passwordReset){
                return response()->json([
                    'code'=>'400',
                    'message'=>'Token is invalid or expired',
                    'status'=>'failed'
                ]);
                $user = User::where('email', $passwordReset->email)->first();
                $user->password = Hash::make($request->password);
                $user->save;

                //delete the token after resetting password
                PasswordReset::where('email', $user->email)->delete();
                return response()->json([
                    'code'=>'200',
                    'message'=>'Password reset successfully',
                    'status'=>'success',
                    'API'=>'API_ID_4'
                ]);
            }
        }catch(\Exception $e){
            return response()->json([
                'code'=>'500',
                'status'=>'Fail',
                'message'=>$e->getMessage()
            ]);
        }
    }
    //Email Send API End
}
//=============================================== End Password Reset =======================================================
