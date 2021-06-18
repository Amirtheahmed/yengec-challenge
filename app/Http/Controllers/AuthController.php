<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequestValidator;
use App\Http\Requests\RegisterRequestValidator;
use App\Models\User;
use Dotenv\Exception\ValidationException;
use http\Env\Response;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{

    /**
     * Regıstration controller
     * @param RegisterRequestValidator $validator
     * @return JsonResponse
     */
    public function register(RegisterRequestValidator $validator) : JsonResponse
    {
        // Request Validation
            $validatedRequest = $validator->validated();

        //Register the user
        $user = User::create([
                 'name' => $validatedRequest["name"],
                 'email' => $validatedRequest["email"],
                 'password' => bcrypt($validatedRequest["password"])
        ]);

        //return token if successful
        $token = $user->createToken('LaravelAuthApp')->accessToken;

        return response()->json(['token' => $token], 200);
    }

    public function login(LoginRequestValidator $validator): JsonResponse
    {
        // Request Validation
        try{
            $validatedRequest = $validator->validated();
        } catch (ValidationException $exception){
            throw $exception;
        }

        $data = [
            'email' => $validatedRequest["email"],
            'password' => $validatedRequest["password"]
        ];

        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
}
