<?php

namespace App\Http\Controllers\Api\V1\Captains\Auth;

use Carbon\Carbon;
use App\Models\Verify;
use App\Models\Captain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Captains\CaptainResource;
use App\Http\Requests\Api\Captains\Auth\LoginRequest;
use App\Http\Requests\Api\Captains\Auth\VerifyRequest;
use App\Http\Requests\Api\Captains\Auth\RegisterRequest;
use App\Http\Requests\Api\Captains\Auth\ChangePasswordRequest;

class AuthController extends Controller
{
    /**
     * Register new user
     * @param  RegisterRequest $request
     * @return mixed
     */
    public function register(RegisterRequest $request)
    {
        $request['code'] = generateRandomCode('CPT');
        $request['password'] = bcrypt($request->password);

        $captain = Captain::create($request->all());

        $token =  $captain->createToken('Token-Login')->accessToken;

        $captain->update([
            'remember_token' => $token
        ]);
        $captain->userToken()->create([
            'token' => $token,
            'device_id' => '$request->device_id',
            'device_type' => '$request->device_type',
        ]);
        $this->sendCode($request->mobile, $captain->id, 'register');

        return $this->successStatus(__("send code to your number - 4444"));
    }
    /**
     * Login
     * @param  LoginRequest $request
     * @return mixed
     */
    public function login(LoginRequest $request)
    {
        $captain = Captain::whereMobile($request->mobile)->first();

        if (!$captain) return $this->errorStatus(__('Unauthorized'));

        if (!$captain->mobile_verified_at) {
            return $this->errorStatus(__('not verified'));
        }
        $token = $captain->createToken('Token-Login')->accessToken;

        $captain->update([
            'remember_token' => $token,
            'device_token' => $request->device_token,
        ]);

        $captain->userToken()->update([
            'token' => $token,
            'device_id' => '$request->device_id',
            'device_type' => '$request->device_type',
        ]);
/*
        $data = DB::table('oauth_access_tokens')->where('user_id', $captain->id)->get();
        if ($data) {
            DB::table('oauth_access_tokens')->where('user_id', $captain->id)->delete();
        }
*/
        return $this->respondWithItem(new CaptainResource($captain));
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
        $captain = Captain::where('mobile', $request->mobile)->first();
        $this->sendCode($request->mobile, $captain->id, 'change-password');

        return $this->successStatus(__('Send SMS Successfully Please Check Your Phone'));
    }
    /**
     * change Password 
     * @param  LoginRequest $request
     * @return mixed
     */
    public function changePassword(Request $request)
    {
        $captain = Captain::where('mobile', $request->mobile)->first();
        $captain->update(['password' => bcrypt($request->new_password)]);

        return $this->respondWithItem(new CaptainResource($captain));
    }
    /**
     * Check Captains 
     * @param  VerifyRequest $request
     * @return mixed
     */
    public function check(VerifyRequest $request)
    {
        $captain = Captain::whereMobile($request->mobile)->first();

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

        $captain->update(['mobile_verified_at' => now()]);

        return $this->respondWithItem(new CaptainResource($captain));
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
