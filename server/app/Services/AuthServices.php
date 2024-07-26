<?php

namespace App\Services;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\LogoutRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthServices {
    
    private $Credentials;

    /**
     * HandleCreateUser
     * Create new user with hashed password
     * @param  CreateUserRequest $request
     * @return void
     */
    public function HandleCreateUser(CreateUserRequest $request): void {
        $fields = $request->all();
        $fields['password'] = Hash::make($fields['password']);

        User::create($fields);
    }

    public function HandleLoginUser(LoginRequest $request): mixed {
        $email = $request->email;
        $password = $request->password;
        $user = User::firstWhere('email', $email);
        $validated = Hash::check($password, $user->password);

        if($validated) {
            $this->Credentials = [
                'data' => $user,
                'token' => $user->createToken('api_token')->plainTextToken];

        } else {
            ValidationException::withMessages(['message' => 'Error Validating']);
        }

        return $this;
    }

    public function HandleGetUser(): mixed {

        $this->Credentials = [
            'data' => auth('sanctum')->user(),
        ];

        return $this;
    }

    public function getCredentials(): array {
        return $this->Credentials;
    }

    public function HandleLogoutUser(LogoutRequest $request): void {
        User::find($request->id)->tokens()->delete();
    }
}