<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Employe;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(Request $request)
    {
        // $tokenInput  = $request->input('token');
        // $employe = Employe::where('api_token', $tokenInput)->first();
        // if(!$employe){
        //     return response()->json([
        //         'message' => 'Something went wrong'
        //     ]);
        // }
        // return response()->json([
        //     'employe' => $employe
        // ]);

        try {
            $user = Auth::guard('api')->user();
            $employe = Employe::where('api_token', $user->api_token)->first();
            return response()->json([
                'employe' => $employe
            ]);
        } catch (Exception $ex) {
            return response()->noContent(401);
        }
    }

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
