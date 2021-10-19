<?php

namespace App\Http\Controllers\Api\V1\Passengers\Auth;

use Carbon\Carbon;
use App\Models\Verify;
use App\Models\passenger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Passengers\PassengerResource;
use App\Http\Requests\Api\Passengers\Auth\LoginRequest;
use App\Http\Requests\Api\Passengers\Auth\VerifyRequest;
use App\Http\Requests\Api\Passengers\Auth\RegisterRequest;
use App\Http\Requests\Api\Passengers\Auth\ChangePasswordRequest;

class AuthController extends Controller
{
   /**
     * Register new user
     * @param  RegisterRequest $request
     * @return mixed
     */
    public function register(RegisterRequest $request)
    {
        $passenger = Passenger::create([
            'code' =>  generateRandomCode('PRV'),
            'full_name' => $request->full_name,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'country_code' => $request->country_code,
            'city_id' => $request->city_id,
            'country_id' => $request->country_id,
            'nationality_id' => $request->nationality_id,
            'avatar' => $request->avatar,
            'birthday' => $request->birthday,
            'gender' => $request->gender,
            'password' => bcrypt($request->password),
            'country_of_residence' => $request->country_of_residence,
            'device_token' => $request->device_token,
            'status' => false,
        ]);

        $token =  $passenger->createToken('Token-Login')->accessToken;

        $passenger->update([
            'remember_token' => $token
        ]);
        $passenger->userToken()->create([
            'token' => $token,
            'device_id' => '$request->device_id',
            'device_type' => '$request->device_type',
        ]);
        $this->sendCode($request->mobile, $passenger->id, 'register');

        return $this->successStatus(__("send code to your number - 4444"));
    }
    /**
     * Login
     * @param  LoginRequest $request
     * @return mixed
     */
    public function login(LoginRequest $request)
    {
       $passenger = Passenger::whereMobile($request->mobile)->first();

       if(!$passenger)return $this->errorStatus(__('Unauthorized'));
        
        if (!$passenger->mobile_verified_at) {
            return $this->errorStatus(__('not verified'));
        }
        $token = $passenger->createToken('Token-Login')->accessToken;

        $passenger->update([
            'remember_token' => $token,
            'device_token' => $request->device_token,
        ]);
        
        $data = DB::table('oauth_access_tokens')->where('user_id',$passenger->id)->get();
        if($data){
           DB::table('oauth_access_tokens')->where('user_id',$passenger->id)->delete();
          }
        
        return $this->respondWithItem(new PassengerResource($passenger));
    }


    /**
     * Send Code Use SMS 
     * @param  LoginRequest $request
     * @return mixed
     */
    public function sendCode($mobile, $user_id, $type)
    {
        $verificationCode = 4444;
        //$verificationCode = mt_rand(1000, 9999);
        Verify::create([
            'user_id' => $user_id,
            'mobile' => $mobile,
            'verification_code' => $verificationCode,
            'type' => $type,
            'verification_expiry_minutes' => Carbon::now()->addMinute(5),
        ]);
        $mobile = (int)$mobile;
        $message = "Your verification code is: {$verificationCode}";

        // SMS 
       // $senderFactory = new SenderFactory();
       // $senderFactory->initialize('sms', $mobile, $message);

        return $this->successStatus(__('Send SMS Successfully Please Check Your Phone ' . $verificationCode));
    }

    /**
     * Send Code Use SMS 
     * @param  LoginRequest $request
     * @return mixed
     */
    public function verifyChangePassword(ChangePasswordRequest $request)
    {
        $passenger = Passenger::where('mobile', $request->mobile)->first();
        $this->sendCode($request->mobile, $passenger->id, 'change-password');

        return $this->successStatus(__('Send SMS Successfully Please Check Your Phone'));
    }
    /**
     * change Password 
     * @param  LoginRequest $request
     * @return mixed
     */
    public function changePassword(Request $request)
    {
        $passenger = Passenger::where('mobile', $request->mobile)->first();
        $passenger->update(['password' => bcrypt($request->new_password)]);

        return $this->respondWithItem(new PassengerResource($passenger));
    }
    /**
     * Check Passengers 
     * @param  VerifyRequest $request
     * @return mixed
     */
    public function check(VerifyRequest $request)
    {
        $passenger = Passenger::whereMobile($request->mobile)->first();

        //check if provider has verification code
        $verify = Verify::whereMobile($request->mobile)->latest()->first();

        if (empty($verify->verification_code)) {
            return $this->errorStatus(__('Verification code is missing'));
        }

        if ($verify->verification_code != $request->verification_code) {
            return $this->errorStatus(__('Verification code is wrong'));
        }

        if (Carbon::parse($verify->verification_expiry_minutes)->lte(Carbon::now())) {
            return $this->errorStatus(__('Verification code is expired'));
        }

        $verify->delete();

        // if ($request->type == 'change-password') {
        //     return $this->successStatus(__('Verification code is valid'));
        // }

        $passenger->update(['mobile_verified_at' => now()]);


        return $this->respondWithItem(new PassengerResource($passenger));
    }

    /**
     * Logout Passenger
     * @return mixed
     */
    public function logout()
    {
        Auth::user()->token()->revoke();

        return $this->successStatus(__('successfully logout'));
    }
}
