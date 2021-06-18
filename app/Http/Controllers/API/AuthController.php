<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Telegram\Bot\Laravel\Facades\Telegram;
use Seshac\Otp\Otp;


class AuthController extends Controller
{
    protected $chat_id;
    protected $token;
    public function __construct()
    {
        $this->middleware('auth:api')->except(['login','register']);
    }

    public function fetch(Request $request)
    {
        return ResponseFormatter::success($request->user(), 'Data profile user berhasil diambil');
    }

    public function login(Request $request)
    {
        try {

            $username = $request->input('username');
            $password = $request->input('password');

            $request->validate([
                'email' => 'email',
                'username' => 'string',
                'password' => 'required|string',
                'remember_me' => 'boolean'
            ]);

            $field = filter_var($username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

            if (Auth::attempt([$field => $username, 'password' => $password])) {
                $user = $request->user();
                $tokenResult = $user->createToken('myApp');
                $accessToken = $tokenResult->token;
                $expired =  $accessToken->expires_at = Carbon::now()->addDays(1);
                $accessToken->save();

                return ResponseFormatter::success([
                    'success'=> true,
                    'access_token' =>
                    $tokenResult->accessToken,
                    'expires_at' => Carbon::parse(
                        $expired
                    )->toDateTimeString(),
                    'user' => $user,
                ], 'Authenticated');
            } else {
                return ResponseFormatter::error([
                    'success' => false,
                    'message' => 'Unauthorized',
                ], 'Authentication Failed', 401);
                
            }
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error,
            ], 'Authentication Failed', 500);
        }
        
    }

    public function logout(Request $request)
    {
        $u = $request->user()->token()->revoke();
        if ($u) {
            return ResponseFormatter::success($u, 'Token Revoked');
        } else {
            return ResponseFormatter::error([
                'message' => 'Unauthorized',
            ], 'Failed', 401);
        }
    }
}
