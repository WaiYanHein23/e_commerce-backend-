<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //register user
    public function register(){

        $validator=Validator::make(request()->all(),
        [
            "name"=>['required','min:4','max:30'],
            "email"=>['required','email'],
            "password"=>['required','min:6','max:12'],
        ]);

        if($validator->fails()){
            return response()->json([
                'error'=>$validator->errors()
            ],422);
        }

        $exitEmail=User::where('email',request('email'))->first();

        if($exitEmail){
            return response()->json([
                "message"=>"Email already exists",
                "error"=>$validator->errors()
            ],422);
        }

        $user=User::create(
            [
                "name"=>request('name'),
                "email"=>request('email'),
                "password"=>Hash::make(request('password'))
            ]
        );

        $token=$user->createToken('user_token')->plainTextToken;


        return response()->json([
            'message'=>'Register successful',
            'id'=>$user->id,
            'token'=>$token
        ]);



    }
    //user login
    public function login(){
        $validator=Validator::make(request()->all(),[
            'email'=>['required','email'],
            'password'=>['required'],
        ]
        );

        if($validator->fails()){
            return response()->json([
                'message'=>'unprocessable',
                'error'=>$validator->errors()
            ],422);
        }

        $exitUser=User::where('email',request('email'))->first();

        if(!$exitUser){
            return response()->json([
                'message'=>'Email does not exists',
                'error'=>$validator->errors(),
            ],422);
        }

        $checkPass=Hash::check(request('password'), $exitUser->password);

        if(!$checkPass){
            return response()->json([
                'message'=>'Password is not correct',
                'error'=>$validator->errors(),
            ],422);
        }

        $token=$exitUser->createToken('token')->plainTextToken;

        return response()->json([
            'message'=>'Login successful',
            'user'=>$exitUser,
            'token'=>$token
        ]);
    }

    //profile user
    public function profile(User $user){

        return response()->json([
            "message"=>"Successful",
            'user'=>Auth::user()
        ]);
    }

    //user logout
    public function logout(){

        $user=User::where('id',request()->user()->id)->first();

        $user->tokens()->delete();

        return response()->json([
            'message'=>'Logout successful'
        ]);

    }
}
