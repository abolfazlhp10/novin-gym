<?php
namespace Modules\User\Http\Controllers\V1;

use App\Classes\ApiResponse;
use App\Exceptions\SmsSendingFailedException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\User\Classes\V1\ResponseMessages;
use Modules\User\Http\Requests\V1\LoginUserRequest;
use Modules\User\Http\Requests\V1\RegisterUserRequest;
use Modules\User\Services\V1\UserService;
use Modules\User\Transformers\V1\UserResource;
use Throwable;

class UserController extends Controller
{

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user::index');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('user::show');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {}

    public function register(RegisterUserRequest $request, ApiResponse $response): JsonResponse
    {
        $user = $this->userService->register($request);

        if (! $user) {
            return $response->errorResponse(ResponseMessages::ERROR_REGISTER, 500);
        }

        return $response->successResponse(ResponseMessages::REGISTER_SUCCESS, new UserResource($user), 201);
    }

    public function sendOtp(LoginUserRequest $request, ApiResponse $response)
    {

        try {
            $result = $this->userService->sendOtp($request);

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

    public function login(LoginUserRequest $request, ApiResponse $response)
    {
        $user = $this->userService->login($request);

        if (! $user) {
            return $response->errorResponse(ResponseMessages::OTP_IS_FALSE, 422);
        }

        return $response->successResponse(ResponseMessages::LOGIN_SUCCESS,new UserResource($user),200);

    }
}
