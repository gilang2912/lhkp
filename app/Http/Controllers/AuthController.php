<?php

namespace App\Http\Controllers;

use App\Helpers\LogActions;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'nip' => 'required|string|max:19',
            'password' => 'required|string'
        ]);

        $credentials = $request->only('nip', 'password');

        if (!$token = auth()->setTTL((60 * 24))->attempt($credentials)) {
            return response()->json([
                'status' => false,
                'message' => 'NIP atau password yang anda masukkan tidak vaild.'
            ], 422);
        }

        LogActions::store('Login ke aplikasi');
        return $this->responseWithToken($token);
    }

    public function me()
    {
        return new UserResource(auth()->user());
    }

    public function logout()
    {
        LogActions::store('Logout dari aplikasi');
        auth()->logout();

        return response()->json([], 204);
    }

    public function responseWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'type' => 'Bearer',
            'data' =>  auth()->user(),
            'expired_in' => auth()->factory()->getTTL()
        ]);
    }
}
