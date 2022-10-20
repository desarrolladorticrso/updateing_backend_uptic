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

    public function index(Request $request)
    {
        $datas=User::withTrashed()
            ->with('role')
            ->orderBy('name')
            ->where('id','!=',auth()->user()->id)
            ->filters($request->all())
            ->paginate();

        return response()->json([
            'message'=>"Datos obtenidos",
            'datas'=>$datas
        ],200);
    }

    public function all()
    {
        $datas=User::orderBy('name')
            ->get();

        return response()->json([
            'message'=>"Datos obtenidos",
            'datas'=>$datas
        ],200);
    }

    public function updatePassword($id ,Request $request)
    {
        $user=User::where('id',$id)->first();

        $validation=Validator::make($request->all(),[
            'current_password'=>'required',
            'password_confirmation'=>'required',
            'password'=>'required|confirmed|string|max:60|min:8',

        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion',
                'errors'=>$validation->errors()
            ],422);
        }

        if (!Hash::check($request->current_password,Auth::user()->password)) {
            throw  ValidationException::withMessages([
                'current_password'=>'La contraseña no coincide con la de nuestros registros.'
            ]);
        }

        $user->password=Hash::make($request->password);
        $verifited=$user->save();

        if ($verifited) {
            return response()->json([
                'message'=>"Contraseña actualizada exitosamente.",
                'data'=>$user
            ],201);
        }
        if (!$verifited) {
            return response()->json([
                'message'=>"No se pudo actualizar tu contraseña.",
                'data'=>null
            ],500);
        }
    }

    public function updatePrifle($id ,Request $request)
    {
        $user=User::where('id',$id)->first();

        $validation=Validator::make($request->all(),[
            'name'=>'required|string',
            'email'=>'required|email|unique:users,email,'.$user->id,
            'number_document'=>'required|string|max:12|min:8|unique:users,number_document,'.$user->id,
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            $user->name=$request->name;
            $user->email=$request->email;
            $user->number_document=$request->number_document;
            $verifited=$user->save();

            if ($verifited) {
                return response()->json([
                    'message'=>"Perfil actualizado exitosamente.",
                    'data'=>$user
                ],201);
            }
            if (!$verifited) {
                return response()->json([
                    'message'=>"No se pudo actualizar tu perfil.",
                    'data'=>null
                ],500);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>"Ha surgido un error inesperado al tratar de aptualizar tu perfil.",
                'data'=>null
            ],500);
        }
    }

    public function store(Request $request)
    {
        $validate=Validator::make($request->all(),[
            'name'=>'required|string',
            'password'=>'required|string|max:40|min:8|confirmed',
            'email'=>'required|email|unique:users,email',
            'number_document'=>'required|string|max:12|min:8',
            'role_id'=>'required|exists:roles,id'
        ]);

        if ($validate->fails()) {
            return response()->json([
                'errors'=>$validate->errors()
            ],422);
        }

        if (!$validate->fails()) {
            try {
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

            } catch (\Throwable $th) {
                return response()->json([
                    'message'=>"Ha surgido un error al tratar de agregar el usuario.",
                    'datas'=>null
                ],500);
            }
        }
    }

    public function show(User $user)
    {
        $datos=User::with('role')->where('id',$user->id)->first();


        return response()->json([
            'message'=>'Usuario obtenido.',
            'datas'=>$datos,
            'errors'=>null
        ],200);
    }

    public function update(User $user, Request $request)
    {
        $validation=Validator::make($request->all(),[
            'name'=>'required|string',
            'role_id'=>'required|numeric|exists:roles,id',
            'email'=>'required|email|unique:users,email,'.$user->id,
            'number_document'=>'required|string|max:12|min:8|unique:users,number_document,'.$user->id,
        ]);

        if ($request->password) {
            $validation=Validator::make($request->all(),[
                'password'=>'required|string|max:40|min:8|confirmed',
            ]);
        }

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            $user->name=$request->name;
            $user->email=$request->email;
            $user->role_id=$request->role_id;
            if ($request->password) {
                $user->password=Hash::make($request->password);
            }
            $user->number_document=$request->number_document;
            $user->save();

            return response()->json([
                'message'=>'Usuario actualizado.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de actualizar el usuario.',
                'errors'=>null
            ],500);
        }
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();

            return response()->json([
                'message'=>'Usuario inhabilitado.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de inhabilitar el usuario.',
                'errors'=>null
            ],500);
        }
    }

    public function restore($user)
    {
        try {
            User::withTrashed()->where('id',$user)->restore();

            return response()->json([
                'message'=>'Usuario restablecido.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de restablecer el usuario.',
                'errors'=>null
            ],500);
        }
    }

    public function forceDestroy($user)
    {
        try {
            User::withTrashed()->where('id',$user)->forceDelete();

            return response()->json([
                'message'=>'Usuario eliminado.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de eliminar el usuario.',
                'errors'=>$th
            ],500);
        }
    }





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
            $rol=Rol::with('permissions')->where('id',$user->role_id)->first();
            return response()->json([
                'token'=>$user->createToken($request->email)->plainTextToken,
                'type'=>'Bearer',
                'user'=>$user,
                'role'=>$rol
            ], 200);
        }
    }

    public function logout(){
        Auth::user()->tokens()->delete();
    }
}
