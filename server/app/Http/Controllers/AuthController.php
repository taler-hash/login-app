<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthServices;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\LogoutRequest;

class AuthController extends Controller
{
    public function register(CreateUserRequest $request, AuthServices $as) {
        $as->HandleCreateUser($request);

        return response()->json(['status' => 200, 'message' => 'success']);
    }

    public function login(LoginRequest $request, AuthServices $as) {
        $credential = $as->HandleLoginUser($request);

        return response()->json(['message' => 'success', 'credentials' => $credential->getCredentials()]);
    }

    public function authenticate(AuthServices $as) {
        $credential = $as->HandleGetUser();

        return response()->json(['message' => 'Authenticated', 'credentials' => $credential->getCredentials()]);
    }

    public function logout(LogoutRequest $request, AuthServices $as) {
        $as->HandleLogoutUser($request);

        return response()->json(['status' => 200,'message' => 'success']);
    }
}
