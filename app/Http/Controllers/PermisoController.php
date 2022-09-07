<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PermisoController extends Controller
{
    public function index(Request $request)
    {
        $datas=Permiso::filters($request->only('search'))
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
            'description'=>'nullable|string|max:300|min:8',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion',
                'error'=>$validation->errors()
            ],422);
        }

        try {

            $permiso=Permiso::create([
                'name'=>$request->name,
                'slug'=>'',
                'description'=>$request->full_acces
            ]);

            if ($request->full_acces=='si') {
                $permiso->permissions()->sync([]);
            }
            if ($request->full_acces=='no') {
                $permiso->permissions()->sync($request->permissions);
            }

            return response()->json([
                'message'=>'Permiso creado.',
                'error'=>null
            ],201);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Error interno',
                'error'=>null
            ],500);
        }
    }

    public function show(permiso $permiso)
    {
        return response()->json([
            'message'=>'permiso obtenido',
            'datas'=>$permiso,
            'errors'=>null
        ],200);
    }

    public function update(Permiso $permiso, Request $request)
    {
        $validation=Validator::make($request->all(),[
            'name'=>'required|string|max:20|min:3|unique:permisoes,name,'.$permiso->id
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion',
                'error'=>$validation->errors()
            ],422);
        }

        try {
            $permiso->name=$request->name;
            $permiso->save();

            return response()->json([
                'message'=>'Permiso actualizado.',
                'error'=>null
            ],202);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Error interno',
                'error'=>null
            ],500);
        }
    }

    public function destroy(Permiso $permiso)
    {
        try {
            $permiso->delete();

            return response()->json([
                'message'=>'Permiso inhabilitado.',
                'error'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Error interno',
                'error'=>null
            ],500);
        }
    }

    public function forceDestroy($permiso)
    {
        try {
            Permiso::withTrashed()->where('id',$permiso)->forceDelete();

            return response()->json([
                'message'=>'permiso eliminado.',
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
