<?php

namespace App\Http\Controllers;

use App\Contracts\IGenerateOTPService;
use App\Contracts\ISendEmailService;
use App\Mail\forgotPassOTP;
use App\Models\email_verifications;
use App\Models\Treasuries;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    protected $sendEmail;
    protected $generateOTP;

    public function __construct(ISendEmailService $sendEmail, IGenerateOTPService $generateOTP) {
        $this->sendEmail = $sendEmail;
        $this->generateOTP = $generateOTP;
    }


    public function forgotPasswordPost(Request $request) {
        if($request->processType == "sendOTP") {
            $otp = $this->generateOTP->generate(6);
            $this->sendEmail->send(new forgotPassOTP($otp), $request->email);

            $emailVerification = new email_verifications;
            $emailVerification->email = $request->email;
            $emailVerification->otp = $otp;

            $emailVerification->save();

            return response()->json([
                'status' => 200,
                'message' => 'OTP has been Sent to your email.'
            ]);
        }
        else if($request->processType == "verifyOTP") {
            $verification = email_verifications::where('otp', $request->otp)->first();

            if(!$verification) {
                return response()->json([
                    'status' => 400,
                    'message' => 'Wrong OTP'
                ]);
            }

            else {
                $currentTime = Carbon::now();
                $time = $verification->created_at;
    
                // Calculate the time difference in seconds
                $timeDifference = $currentTime->diffInSeconds($time);
    
                // Check if the time difference is less than 5 minutes (300 seconds)
                if ($timeDifference <= 300) {
                    return response()->json([
                        'status' => 200,
                        'message' => 'success'
                    ]);
                } else {
                    return response()->json([
                        'status' => 401,
                        'message' => 'OTP Expired'
                    ]);
                }
            
            }
        }
        elseif($request->processType == "changePassword") {
            $accountant = Treasuries::where('email', $request->email)->first();
            $accountant->password = $request->password;

            if($accountant->save()) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Password Successfully Changed Please login again.'
                ]); 
            }
            else {
                return response()->json([
                    'status' => 400,
                    'message' => 'error'
                ]);
            }
        }
        
    }
}
