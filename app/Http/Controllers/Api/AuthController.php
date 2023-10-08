<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function __construct()
    {
        // login e register não passará pela proteção da API
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login(Request $request): JsonResponse
    {
        $validator = \Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json($validator->error(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if(!$token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Não autenticado'], Response::HTTP_UNAUTHORIZED);
        }

        return $this->respondWithToken($token);
    }

    public function register(Request $request): JsonResponse
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), Response::HTTP_BAD_REQUEST);
        }

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json([
            'message' => 'Usuário registrado com sucesso',
            'user' => $user,
            'token' => $token,
        ], Response::HTTP_OK);
    }

    public function getaccount(): JsonResponse
    {
        return response()->json(auth()->user());
    }


    public function logout(): JsonResponse
    {
        auth()->logout();

        return response()->json(['message' => 'Deslogado com sucesso']);
    }
    public function refresh(): JsonResponse
    {
        return $this->respondWithToken(auth()->refresh());
    }

    private function respondWithToken($token): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
