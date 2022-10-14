<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RolController extends Controller
{
    public function index(Request $request)
    {
        try {
            $datas=Rol::withTrashed()
                ->filters($request->only('search'))
                ->paginate();

            return response()->json([
                'message'=>'Datos obtenidos',
                'datas'=>$datas,
                'errors'=>null
            ],200);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Surgío un error al obtener los datos.',
                'errors'=>null
            ],500);
        }
    }

    public function all()
    {
        try {
            $datas=Rol::orderBy('name')
                ->get();

            return response()->json([
                'message'=>'Datos obtenidos',
                'datas'=>$datas,
                'errors'=>null
            ],200);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Surgío un error al obtener los datos.',
                'errors'=>null
            ],500);
        }
    }


    public function store(Request $request)
    {
        $validation=Validator::make($request->all(),[
            'name'=>'required|string|max:20|min:3|unique:roles,name',
            'full_acces'=>'required|in:si,no',
            'permissions'=>'nullable|array',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion',
                'errors'=>$validation->errors()
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
                'errors'=>null
            ],201);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Error interno',
                'errors'=>null
            ],500);
        }
    }

    public function show(Rol $role)
    {
        $datos=Rol::with('permissions')->where('id',$role->id)->first();


        return response()->json([
            'message'=>'Rol obtenido',
            'datas'=>$datos,
            'errors'=>null
        ],200);
    }

    public function update(Rol $role, Request $request)
    {
        $validation=Validator::make($request->all(),[
            'name'=>'required|string|max:20|min:3|unique:roles,name,'.$role->id,
            'full_acces'=>'required|in:si,no',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            $role->name=$request->name;
            $role->full_acces=$request->full_acces;
            $role->save();

            if ($request->full_acces=='si') {
                $role->permissions()->sync([]);
            }
            if ($request->full_acces=='no') {
                $role->permissions()->sync($request->permissions);
            }

            return response()->json([
                'message'=>'Rol actualizado.',
                'errors'=>null
            ],202);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Error interno',
                'errors'=>null
            ],500);
        }
    }

    public function destroy(Rol $role)
    {
        try {
            $role->delete();

            return response()->json([
                'message'=>'Rol inhabilitado.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Error interno',
                'errors'=>null
            ],500);
        }
    }

    public function restore($role)
    {
        try {
            Rol::withTrashed()->where('id',$role)->restore();

            return response()->json([
                'message'=>'Rol restablecido.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Error interno',
                'errors'=>null
            ],500);
        }
    }

    public function forceDestroy($role)
    {
        try {
            Rol::withTrashed()->where('id',$role)->forceDelete();

            return response()->json([
                'message'=>'Rol eliminado.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Error interno',
                'errors'=>$th
            ],500);
        }
    }
}
