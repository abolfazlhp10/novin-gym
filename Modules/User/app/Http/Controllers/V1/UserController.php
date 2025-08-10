<?php

namespace Modules\User\Http\Controllers\V1;

use App\Classes\ApiResponse;
use App\Exceptions\SmsSendingFailedException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\JsonResponse;
use Modules\User\Classes\V1\ResponseMessages;
use Modules\User\Exceptions\InvalidOtpException;
use Modules\User\Exceptions\RegistrationFailedException;
use Modules\User\Http\Requests\V1\LoginUserRequest;
use Modules\User\Http\Requests\V1\OtpRequest;
use Modules\User\Http\Requests\V1\RegisterUserRequest;
use Modules\User\Services\V1\UserService;
use Modules\User\Transformers\V1\UserResource;
use Throwable;

class UserController extends Controller
{
    public function __construct(private UserService $userService) {}

    public function register(RegisterUserRequest $request, ApiResponse $response): JsonResponse
    {
        try {

            $user = $this->userService->register($request->validated());

            return $response->successResponse(ResponseMessages::REGISTER_SUCCESS, new UserResource($user), 201);
        } catch (RegistrationFailedException $e) {
            return $response->errorResponse(ResponseMessages::ERROR_REGISTER, 500);
        }
    }

    public function sendOtp(OtpRequest $request, ApiResponse $response)
    {

        try {
            $result = $this->userService->sendOtp($request->validated());

            if ($result) {
                return $response->successResponse(ResponseMessages::OTP_SEND_SUCCESS, [], 200);
            }
        } catch (SmsSendingFailedException $e) {
            logError('critical', 'SMS Gateway Error', $e);
            return $response->errorResponse(ResponseMessages::OTP_SEND_FAILURE, 500);
        } catch (RequestException $e) {
            logError('critical', 'SMS Service Network Error', $e);
            return $response->errorResponse(ResponseMessages::OTP_SEND_FAILURE, 500);
        } catch (Throwable $th) {
            logError('critical', 'SMS sending failed', $th);
            return $response->errorResponse(ResponseMessages::OTP_SEND_FAILURE, 500);
        }
    }

    public function login(LoginUserRequest $request, ApiResponse $response): JsonResponse
    {
        try {

            $user = $this->userService->login($request->validated());

            return $response->successResponse(ResponseMessages::LOGIN_SUCCESS, new UserResource($user), 200);
        } catch (InvalidOtpException $e) {
            return $response->errorResponse(ResponseMessages::OTP_IS_FALSE, 422);
        }
    }
}
