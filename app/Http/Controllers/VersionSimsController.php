<?php

namespace App\Http\Controllers;

use App\Models\VersionSims;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VersionSimsController extends Controller
{
    public function index(Request $request)
    {
        $datas=VersionSims::withTrashed()
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
        $datas=VersionSims::orderBy('name')
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
            'name'=>'required|string|max:60|min:3|unique:version_del_sims,name',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            VersionSims::create([
                'name'=>$request->name,
            ]);

            return response()->json([
                'message'=>'Version del sims creada.',
                'errors'=>null
            ],201);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al intentar agregar la version del sims.',
                'errors'=>null
            ],500);
        }
    }

    public function show(VersionSims $version_sim)
    {
        return response()->json([
            'message'=>'Version del sims obtenida',
            'datas'=>$version_sim,
            'errors'=>null
        ],200);
    }

    public function update(VersionSims $version_sim, Request $request)
    {
        $validation=Validator::make($request->all(),[
            'name'=>'required|string|max:60|min:3|unique:version_del_sims,name,'.$version_sim->id,
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            $version_sim->name=$request->name;
            $version_sim->save();

            return response()->json([
                'message'=>'Version del sims actualizada.',
                'errors'=>null
            ],202);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de actualizar la version del sims.',
                'error'=>null
            ],500);
        }
    }

    public function destroy(VersionSims $version_sim)
    {
        try {
            $version_sim->delete();

            return response()->json([
                'message'=>'Version del sims inhabilitada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de inhabilitar la version del sims.',
                'errors'=>null
            ],500);
        }
    }
    public function restore($version_sim)
    {
        try {
            VersionSims::withTrashed()->where('id',$version_sim)->restore();

            return response()->json([
                'message'=>'Version del sims restablecida.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al intentar de restablecer la version del sims.',
                'errors'=>null
            ],500);
        }
    }

    public function forceDestroy($version_sim)
    {
        try {
            VersionSims::withTrashed()->where('id',$version_sim)->forceDelete();

            return response()->json([
                'message'=>'Version del sims eliminada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de eliminar la version del sims.',
                'errors'=>null
            ],500);
        }
    }
}
