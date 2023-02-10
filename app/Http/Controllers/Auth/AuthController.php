<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeRequest;
use App\Models\Employe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $body = $request->only('username', 'password');

        if (!Auth::attempt($body)) {
            return response()->json([
                'message' => 'Something goes wrong'
            ]);
        }


        $user = Auth::user();
        $token = $user->createToken();

        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }

    public function logout(Request $request)
    {
        $user = Auth::guard('api')->user();

        if ($user) {
            $user->api_token = null;
            $user->save();

            return response()->json([
                'message' => 'Logout success',
                'user' => $user
            ]);
        }

        return response()->json([
            'message' => 'Logout failed',
            'user'  => $user
        ]);
    }
}
