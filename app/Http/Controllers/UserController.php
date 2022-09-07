<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $validate=Validator::make($request->all(),[
            'email'=>'required|email',
            'password'=>'required|string'
        ]);

        if ($validate->fails()) {
            return response()->json([
                'errors'=>$validate->errors()
            ],422);
        }

        if (!$validate->fails()) {

            if (!Auth::attempt($request->only('email','password'))) {
                throw  ValidationException::withMessages([
                    'email'=>'Tus credenciales no concuerdan con nuestros registros.'
                ]);
            }

            $user = User::where('email', $request->email)->first();
            $rol=Rol::with('permissions')->where('id',$user->role)->first();
            return response()->json([
                'token'=>$user->createToken($request->email)->plainTextToken,
                'type'=>'Bearer',
                'user'=>$user,
                'rol'=>$rol
            ], 200);
        }
    }

    public function register(Request $request)
    {
        $validate=Validator::make($request->all(),[
            'name'=>'required|string',
            'password'=>'required|string|max:40|min:8',
            'email'=>'required|email|unique:users,email',
            'number_document'=>'required|string|max:12|min:8',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'errors'=>$validate->errors()
            ],422);
        }

        if (!$validate->fails()) {
            $user=User::create([
                'role_id'=>1,
                'name'=>$request->name,
                'email'=>$request->email,
                'number_document'=>$request->document,
                'password'=>Hash::make($request->password),
            ]);

            return response()->json([
                'message'=>"Usuario registrado exitosamente.",
                'data'=>$user
            ],201);
        }
    }
    public function logout(){
        Auth::user()->tokens()->delete();
    }
}
