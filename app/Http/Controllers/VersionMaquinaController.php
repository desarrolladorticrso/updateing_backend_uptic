<?php

namespace App\Http\Controllers;

use App\Models\VersionMaquina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VersionMaquinaController extends Controller
{
    public function index(Request $request)
    {
        $datas=VersionMaquina::withTrashed()
            ->orderBy('id','DESC')
            ->filters($request->only('search'))
            ->paginate();

        return response()->json([
            'message'=>'Datos obtenidos',
            'datas'=>$datas,
            'errors'=>null
        ],200);
    }

    public function all()
    {
        $datas=VersionMaquina::orderBy('name')
            ->get();

        return response()->json([
            'message'=>'Datos obtenidos',
            'datas'=>$datas,
            'errors'=>null
        ],200);
    }

    public function store(Request $request)
    {
        $validation=Validator::make($request->all(),[
            'name'=>'required|string|max:60|min:3|unique:version_maquinas,name',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            VersionMaquina::create([
                'name'=>$request->name,
            ]);

            return response()->json([
                'message'=>'Version del maquina creada.',
                'errors'=>null
            ],201);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al intentar agregar la version de la maquina.',
                'errors'=>null
            ],500);
        }
    }

    public function show(VersionMaquina $version_maquina)
    {
        return response()->json([
            'message'=>'Version de la maquina obtenida',
            'datas'=>$version_maquina,
            'errors'=>null
        ],200);
    }

    public function update(VersionMaquina $version_maquina, Request $request)
    {
        $validation=Validator::make($request->all(),[
            'name'=>'required|string|max:60|min:3|unique:version_maquinas,name,'.$version_maquina->id,
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            $version_maquina->name=$request->name;
            $version_maquina->save();

            return response()->json([
                'message'=>'Version de la maquina actualizada.',
                'errors'=>null
            ],202);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de actualizar la version de la maquina.',
                'error'=>null
            ],500);
        }
    }

    public function destroy(VersionMaquina $version_maquina)
    {
        try {
            $version_maquina->delete();

            return response()->json([
                'message'=>'Version de la maquina inhabilitada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de inhabilitar la version de la maquina.',
                'errors'=>null
            ],500);
        }
    }
    public function restore($version_maquina)
    {
        try {
            VersionMaquina::withTrashed()->where('id',$version_maquina)->restore();

            return response()->json([
                'message'=>'Version de la maquina restablecida.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al intentar de restablecer la version de la maquina.',
                'errors'=>null
            ],500);
        }
    }

    public function forceDestroy($version_maquina)
    {
        try {
            VersionMaquina::withTrashed()->where('id',$version_maquina)->forceDelete();

            return response()->json([
                'message'=>'Version de la maquina eliminada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de eliminar la version de la maquina.',
                'errors'=>null
            ],500);
        }
    }
}
