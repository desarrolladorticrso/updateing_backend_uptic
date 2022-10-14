<?php

namespace App\Http\Controllers;

use App\Models\VersionPosslim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VersionPosslimController extends Controller
{
    public function index(Request $request)
    {
        $datas=VersionPosslim::withTrashed()
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
        $datas=VersionPosslim::orderBy('name')
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
            'name'=>'required|string|max:60|min:3|unique:version_posslims,name',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            VersionPosslim::create([
                'name'=>$request->name,
            ]);

            return response()->json([
                'message'=>'Version del posslim creada.',
                'errors'=>null
            ],201);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al intentar agregar la version del posslim.',
                'errors'=>null
            ],500);
        }
    }

    public function show(VersionPosslim $version_posslim)
    {
        return response()->json([
            'message'=>'Version posslim obtenida',
            'datas'=>$version_posslim,
            'errors'=>null
        ],200);
    }

    public function update(VersionPosslim $version_posslim, Request $request)
    {
        $validation=Validator::make($request->all(),[
            'name'=>'required|string|max:60|min:3|unique:version_posslims,name,'.$version_posslim->id,
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            $version_posslim->name=$request->name;
            $version_posslim->save();

            return response()->json([
                'message'=>'Version del posslim actualizada.',
                'errors'=>null
            ],202);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de actualizar la version del posslim.',
                'error'=>null
            ],500);
        }
    }

    public function destroy(VersionPosslim $version_posslim)
    {
        try {
            $version_posslim->delete();

            return response()->json([
                'message'=>'Version del posslim inhabilitada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de inhabilitar la version del posslim.',
                'errors'=>null
            ],500);
        }
    }
    public function restore($version_posslim)
    {
        try {
            VersionPosslim::withTrashed()->where('id',$version_posslim)->restore();

            return response()->json([
                'message'=>'Version del posslim restablecida.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al intentar de restablecer la version del posslim.',
                'errors'=>null
            ],500);
        }
    }

    public function forceDestroy($version_posslim)
    {
        try {
            VersionPosslim::withTrashed()->where('id',$version_posslim)->forceDelete();

            return response()->json([
                'message'=>'Version del posslim eliminada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de eliminar la version del posslim.',
                'errors'=>null
            ],500);
        }
    }
}
