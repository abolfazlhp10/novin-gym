<?php

namespace Modules\User\Http\Controllers;

use App\Classes\ApiResponse;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Modules\User\Classes\ResponseMessages;
use Modules\User\Http\Requests\RegisterUserRequest;
use Modules\User\Models\User;
use Modules\User\Enums\RoleEnum;
use Modules\User\Services\UserService;

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
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}

    public function register(RegisterUserRequest $request, ApiResponse $response): JsonResponse
    {
        $user = $this->userService->register($request);

        if (! $user) {
            return $response->errorResponse(ResponseMessages::ERROR_REGISTER, 500);
        } 

        return $response->successResponse(ResponseMessages::REGISTER_SUCCESS, $user, 201);
    }
}
