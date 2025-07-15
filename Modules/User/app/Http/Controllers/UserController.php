<?php

namespace Modules\User\Http\Controllers;

use App\Classes\ApiResponse;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Modules\User\Classes\ResponseMessages;
use Modules\User\Http\Requests\RegisterUserRequest;
use Modules\User\Models\User;
use Modules\User\Enums\RoleEnum;

class UserController extends Controller
{
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

    public function register(RegisterUserRequest $request,ApiResponse $response)
    {
        try {

            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone_number' => $request->phone_number,
                'role' => RoleEnum::COACH
            ]);

            return $response->successResponse(ResponseMessages::REGISTER_SUCCESS,$user, 201);


        } catch (\Throwable $e) {

            Log::critical('Error on the user register: ' . $e->getMessage().' in : '.$e->getFile().' on line : '.$e->getLine());

            return $response->errorResponse(ResponseMessages::ERROR_REGISTER, 500);
        }
    }
}
