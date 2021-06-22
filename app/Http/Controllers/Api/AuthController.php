<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

	

        public function register(Request $request)
        {
               $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
            ]);

            if($validator->fails()){
                    return response()->json($validator->errors()->toJson(), 400);
            }

            $user = User::create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password')),
            ]);

			$token = JWTAuth::attempt(['email'=>$user->email, 'password'=>$user->password]);
            return response()->json(compact('user','token'),201);
        }




	 public function login(Request $request)
    	{
    		
    		$validator = Validator::make($request->all(), [
                
                'email' => 'required|string|email',
                'password' => 'required|string|min:6',
            ]);

            if($validator->fails()){
                    return response()->json($validator->errors()->toJson(), 400);
            }
        
            $credentials = $request->only('email', 'password');
           

            try {
                if (!$token = JWTAuth::attempt($credentials)) {
                    return response()->json(['error' => 'invalid_credentials'], 400);
                }
            } catch (JWTException $e) {
                return response()->json(['error' => 'could_not_create_token'], 500);
            }

            $user = User::where('email', $credentials['email'])->first();
            return response()->json(compact('user', 'token'));
    }

     



public function logout() {

        $token = request()->header('Authorization');
       
            JWTAuth::parseToken()->invalidate($token);

            return response()->json([
                
                'message' => "Logout"
            ]);
       
    }

}
