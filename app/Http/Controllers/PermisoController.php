<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PermisoController extends Controller
{
    public function index(Request $request)
    {
        $datas=Permiso::withTrashed()
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
            'name'=>'required|string|max:20|min:3|unique:permisos,name',
            'slug'=>'required|unique:permisos,slug',
            'description'=>'required|string|max:300|min:8',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            Permiso::create([
                'name'=>$request->name,
                'slug'=>$request->slug,
                'description'=>$request->description
            ]);

            return response()->json([
                'message'=>'Permiso creado.',
                'errors'=>null
            ],201);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al intentar agregar el permiso.',
                'errors'=>null
            ],500);
        }
    }

    public function show(permiso $permission)
    {
        return response()->json([
            'message'=>'permiso obtenido',
            'datas'=>$permission,
            'errors'=>null
        ],200);
    }

    public function update(Permiso $permission, Request $request)
    {
        $validation=Validator::make($request->all(),[
            'name'=>'required|string|max:20|min:3|unique:permisos,name,'.$permission->id,
            'slug'=>'required|string|max:20|min:3|unique:permisos,slug,'.$permission->id,
            'description'=>'required|string|max:700|min:3'
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            $permission->name=$request->name;
            $permission->slug=$request->slug;
            $permission->description=$request->description;
            $permission->save();

            return response()->json([
                'message'=>'Permiso actualizado.',
                'errors'=>null
            ],202);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de actualizar el permiso.',
                'error'=>null
            ],500);
        }
    }

    public function destroy(Permiso $permission)
    {
        try {
            $permission->delete();

            return response()->json([
                'message'=>'Permiso inhabilitado.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de inhabilitar el permiso.',
                'errors'=>null
            ],500);
        }
    }
    public function restore($permission)
    {
        try {
            Permiso::withTrashed()->where('id',$permission)->restore();

            return response()->json([
                'message'=>'Permiso restablecido.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al intentar de restablecer el permiso.',
                'errors'=>null
            ],500);
        }
    }

    public function forceDestroy($permission)
    {
        try {
            Permiso::withTrashed()->where('id',$permission)->forceDelete();

            return response()->json([
                'message'=>'permiso eliminado.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de eliminar el permiso.',
                'errors'=>null
            ],500);
        }
    }
}
