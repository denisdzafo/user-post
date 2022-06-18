<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\RegisterRequest;
use App\Http\Repository\UserRepository;
use Tymon\JWTAuth\JWT;
use Tymon\JWTAuth\Facades\JWTAuth as JWTAuth;


class AuthController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(RegisterRequest $request)
    {
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;

        if($this->userRepository->registerUser($name, $email, $password))
            return response()->json(['status' => 'success'], 200);

        return response()->json(['status' => 'error'], 502);    
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if ($token = JWTAuth::attempt($credentials)) {
            $userId = $this->userRepository->getUserIdByEmail($request->get( 'email') );
            return response()->json(['status' => 'success', 'token' => $token, 'user_id'=> $userId], 200)->header('Authorization', $token);
        }
        return response()->json(['error' => 'login_error'], 401);
    }

    public function logout()
    {
        Auth::guard('api')->logout();
        return response()->json([
            'status' => 'success',
            'msg' => 'Logged out Successfully.'
        ], 200);
    }


    public function refresh()
    {
        if ($token =  JWTAuth::refresh()) {
            return response()
                ->json(['status' => 'successs'], 200)
                ->header('Authorization', $token);
        }
        return response()->json(['error' => 'refresh_token_error'], 401);
    }
}
