<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RolController extends Controller
{
    public function index(Request $request)
    {
        $datas=Rol::withTrashed()
            ->filters($request->only('search'))
            ->paginate();

        return response()->json([
            'message'=>'Datos obtenidos',
            'datas'=>$datas,
            'errors'=>null
        ],200);
    }

    public function store(Request $request)
    {
        $validation=Validator::make($request->all(),[
            'name'=>'required|string|max:20|min:3|unique:roles,name',
            'full_acces'=>'required|in:si,no',
            'permission'=>'nullable|array',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion',
                'error'=>$validation->errors()
            ],422);
        }

        try {

            $rol=Rol::create([
                'name'=>$request->name,
                'full_acces'=>$request->full_acces
            ]);

            if ($request->full_acces=='si') {
                $rol->permissions()->sync([]);
            }
            if ($request->full_acces=='no') {
                $rol->permissions()->sync($request->permissions);
            }

            return response()->json([
                'message'=>'Rol creado.',
                'error'=>null
            ],201);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Error interno',
                'error'=>null
            ],500);
        }
    }

    public function show(Rol $role)
    {
        return response()->json([
            'message'=>'Rol obtenido',
            'datas'=>$role,
            'errors'=>null
        ],200);
    }

    public function update(Rol $role, Request $request)
    {
        $validation=Validator::make($request->all(),[
            'name'=>'required|string|max:20|min:3|unique:roles,name,'.$role->id
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion',
                'error'=>$validation->errors()
            ],422);
        }

        try {
            $role->name=$request->name;
            $role->save();

            return response()->json([
                'message'=>'Rol actualizado.',
                'error'=>null
            ],202);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Error interno',
                'error'=>null
            ],500);
        }
    }

    public function destroy(Rol $role)
    {
        try {
            $role->delete();

            return response()->json([
                'message'=>'Rol inhabilitado.',
                'error'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Error interno',
                'error'=>null
            ],500);
        }
    }

    public function forceDestroy($role)
    {
        try {
            Rol::withTrashed()->where('id',$role)->forceDelete();

            return response()->json([
                'message'=>'Rol eliminado.',
                'error'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Error interno',
                'error'=>null
            ],500);
        }
    }
}
