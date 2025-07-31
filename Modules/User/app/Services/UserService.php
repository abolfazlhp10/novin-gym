<?php
namespace Modules\User\Services;

use App\Contracts\SmsServiceInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Modules\User\Enums\RoleEnum;
use Modules\User\Http\Requests\LoginUserRequest;
use Modules\User\Http\Requests\RegisterUserRequest;
use Modules\User\Models\Gym;
use Modules\User\Models\Otp;
use Modules\User\Models\User;

class UserService
{
    protected $smsService;

    public function __construct(SmsServiceInterface $smsService)
    {
        $this->smsService = $smsService;
    }

    public function register(RegisterUserRequest $request): User | bool
    {
        DB::beginTransaction();

        try {

            $user = $this->createUser($request);

            $user->assignRole(RoleEnum::COACH->value);

            $this->createGym($request, $user->id);

            DB::commit();

            return $user->load(['gym']);

        } catch (\Throwable $e) {
            DB::rollBack();
            logError('critical', 'Error on the user register : ', $e);
            return false;
        }
    }

    public function sendOtp(LoginUserRequest $request)
    {
        $otp_code = $this->createOtp($request);

        $response = $this->smsService->sendOtp($request->phone_number, $otp_code);

        return $response;

    }

    public function login(LoginUserRequest $request): bool | User
    {
        if(! $this->isOtpValid($request))
        {
            return false;
        }

        $user = User::firstWhere('phone_number',$request->phone_number);

        $this->authenticateUser($user);

        return $user;
     
    }

    protected function createUser(RegisterUserRequest $request): User
    {
        return User::create([
            'first_name'   => $request->first_name,
            'last_name'    => $request->last_name,
            'phone_number' => $request->phone_number,
        ]);
    }

    protected function createGym(RegisterUserRequest $request, $user_id): void
    {
        Gym::create([
            'name'    => $request->gym_name,
            'user_id' => $user_id,
        ]);
    }

    private function createOtp($request)
    {
        $otp_code = mt_rand(10000, 99999);

        Otp::create([
            'phone_number'    => $request->phone_number,
            'otp_code'        => $otp_code,
            'expiration_time' => Carbon::now()->addMinutes(2),
        ]);

        return $otp_code;

    }

    private function isOtpValid($request)
    {
        if(config('services.sms.driver')=='testing' && config('services.sms.testing.otp_code') == $request->otp_code){
            return true;
        }

        $otp = Otp::where('phone_number', $request->phone_number)->where('otp_code', $request->otp_code)->where('expiration_time', '>', Carbon::now()->subMinutes(2))->first();

        if (! $otp) {
            return false;
        }

        $otp->delete();

        return true;
    }

    private function authenticateUser($user)
    {
        Auth::login($user);

        $token = $user->createToken('novingym')->plainTextToken;

        Cookie::queue('auth_token', $token, 60 * 24, null, null, true, true);
        
        // this is add only for testing
        $user->token = $token;
        
    }

}
