<?php

namespace Modules\User\Services\V1;

use App\Contracts\SmsServiceInterface;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Modules\User\Enums\V1\RoleEnum;
use Illuminate\Support\Facades\Hash;
use Modules\User\Exceptions\InvalidOtpException;
use Modules\User\Exceptions\InvalidPasswordException;
use Modules\User\Exceptions\RegistrationFailedException;
use Modules\User\Models\V1\Gym;
use Modules\User\Models\V1\Otp;
use Modules\User\Models\V1\User;

class UserService
{
    public function __construct(private SmsServiceInterface $smsService) {}

    public function register(array $validated_data): User
    {
        DB::beginTransaction();

        try {

            $user = $this->createUser($validated_data);

            $user->assignRole(RoleEnum::COACH->value);

            $this->createGym($validated_data, $user->id);

            DB::commit();

            return $user->load(['gym']);
        } catch (\Throwable $e) {
            DB::rollBack();
            logError('critical', 'Error on the user register : ', $e);
            throw new RegistrationFailedException('Registration failed');
        }
    }

    public function sendOtp(array $validated_data): bool
    {
        $phone_number = $validated_data['phone_number'];

        $otp_code = $this->createOtp($phone_number);

        $response = $this->smsService->sendOtp($phone_number, $otp_code);

        return $response;
    }

    public function login(array $validated_data): User
    {
        $phone_number = $validated_data['phone_number'];
        $otp_code = $validated_data['otp_code'];

        if (! $this->isOtpValid($phone_number, $otp_code)) {
            throw new InvalidOtpException('the otp code is incorrect or expired');
        }

        $user = User::with('gym')->firstWhere('phone_number', $phone_number);

        $this->authenticateUser($user);

        return $user;
    }

    public function loginWithPassword(array $validated_data): User
    {
        $user = User::where('phone_number', $validated_data['phone_number'])->first();

        if (!$user || !Hash::check($validated_data['password'], $user->password)) {
            throw new InvalidPasswordException('Invalid phone number or password');
        }

        $user->load('gym');

        $this->authenticateUser($user);

        return $user;
    }

    private function createUser(array $data): User
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'phone_number' => $data['phone_number'],
            'password'     => $data['password'],
        ]);
    }

    private function createGym(array $data, $user_id): void
    {
        if (Arr::has($data, 'logo')) {
            $path = Storage::disk('public')->put('gyms/logos', $data['logo']);

            $data['logo'] = $path;
        }

        Gym::create([
            'name' => $data['gym_name'],
            'user_id' => $user_id,
            'logo' => $data['logo'] ?? null,
            'address' => $data['address'] ?? null,
        ]);
    }

    private function createOtp(string $phone_number): int
    {
        $otp_code = random_int(10000, 99999);

        Otp::create([
            'phone_number' => $phone_number,
            'otp_code' => $otp_code,
            'expiration_time' => Carbon::now()->addMinutes(2),
        ]);

        return $otp_code;
    }

    private function isOtpValid(string $phone_number, int $otp_code): bool
    {

        if (app()->isLocal() && $otp_code == '12345') {
            return true;
        }

        $otp = Otp::where('phone_number', $phone_number)
            ->where('otp_code', $otp_code)
            ->where('expiration_time', '>', now())
            ->first();

        if (! $otp) {
            return false;
        }

        $otp->delete();

        return true;
    }

    private function authenticateUser($user): void
    {
        Auth::login($user);

        $token = $user->createToken('novingym')->plainTextToken;

        //i should check what is this for 
        Cookie::queue('auth_token', $token, 60 * 24, null, null, true, true);

        // this is add only for testing
        $user->token = $token;
    }
}
