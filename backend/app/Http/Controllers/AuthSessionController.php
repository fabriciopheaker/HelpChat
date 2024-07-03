<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Repository\UserRepository;
use Illuminate\Http\JsonResponse;

class AuthSessionController extends Controller
{
    private $repositoryUser;

    public function __construct(UserRepository $userRepository)
    {
        $this->repositoryUser = $userRepository;
    }


    public function register(UserRegisterRequest $request): JsonResponse
    {
        $repository = $this->repositoryUser->createUser($request);
        if (!$repository) {
            return response()->json(['status' => 'error', 'message' => 'Error ao Cadastrar Usuario'], 200);
        }
        return response()->json(['status' => 'success', 'message' => 'Cadastro realizado com sucesso'], 200);
    }

    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            $token = $user->createToken('token-' . $user->name)->plainTextToken;
            return response()->json(['token_id' => $token]);
        }

        throw ValidationException::withMessages([
            'email' => ['As credenciais fornecidas estão incorretas.'],
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();
        return response()->json(['status' => 'success', 'message' => 'Desconectado com sucesso']);
    }
}
