<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequestValidator;
use App\Http\Requests\RegisterRequestValidator;
use App\Models\User;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    /**
     * Kayıt controller
     *
     * @param RegisterRequestValidator $validator
     * @return JsonResponse
     */
    public function register(RegisterRequestValidator $validator): JsonResponse
    {
        //İstek doğrulama
        $validatedRequest = $validator->validated();

        //kullanıcı kaydet
        $user = User::create([
                 'name' => $validatedRequest["name"],
                 'email' => $validatedRequest["email"],
                 'password' => bcrypt($validatedRequest["password"])
        ]);

        //Başarılı olursa token gönster
        $token = $user->createToken('LaravelAuthApp')->accessToken;

        return response()->json(['token' => $token], 200);
    }

    /**
     * Giriş Controller
     *
     * @param LoginRequestValidator $validator
     * @return JsonResponse
     */
    public function login(LoginRequestValidator $validator): JsonResponse
    {
        //İstek doğrulama
        try{
            $validatedRequest = $validator->validated();
        } catch (ValidationException $exception){
            throw $exception;
        }

        $data = [
            'email' => $validatedRequest["email"],
            'password' => $validatedRequest["password"],
        ];

        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
            return response()->json(['token' => $token], 200);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
