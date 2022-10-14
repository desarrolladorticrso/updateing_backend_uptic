<?php

namespace App\Http\Controllers;

use App\Exports\ActualizacionPosslimExport;
use App\Models\ActualizacionPosslim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ActualizacionPosslimController extends Controller
{
    public function index(Request $request)
    {
        $datas=ActualizacionPosslim::with('tecnico','punto_oficina','version_posslim','version_sims')
            ->withTrashed()
            ->orderBy('id','DESC')
            ->filters($request->only('search'))
            ->paginate();

        return response()->json([
            'message'=>"Datos obtenidos",
            'datas'=>$datas
        ],200);
    }

    public function store(Request $request)
    {
        $validate=Validator::make($request->all(),[
            'tecnico_id'=>'required|exists:users,id',
            'punto_oficina_id'=>'required|exists:puntos_oficinas,id',
            'version_posslim_id'=>'required|exists:version_posslims,id',
            'version_del_sims_id'=>'required|exists:version_del_sims,id',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'errors'=>$validate->errors()
            ],422);
        }

        if (!$validate->fails()) {
            try {
                $user=ActualizacionPosslim::create($request->all());

                return response()->json([
                    'message'=>"Actaulizacion del posslim registrado exitosamente.",
                    'datas'=>$user
                ],201);

            } catch (\Throwable $th) {
                return response()->json([
                    'message'=>"Ha surgido un error al tratar de agregar la actaulizacion del posslim.",
                    'datas'=>null
                ],500);
            }
        }
    }

    public function show(ActualizacionPosslim $actualizacionPosslim)
    {
        return response()->json([
            'message'=>'Datos obtenido.',
            'datas'=>$actualizacionPosslim,
            'errors'=>null
        ],200);
    }

    public function update(ActualizacionPosslim $actualizacionPosslim, Request $request)
    {
        $validate=Validator::make($request->all(),[
            'tecnico_id'=>'required|exists:users,id',
            'punto_oficina_id'=>'required|exists:puntos_oficinas,id',
            'version_posslim_id'=>'required|exists:version_posslims,id',
            'version_del_sims_id'=>'required|exists:version_del_sims,id',
        ]);


        if ($validate->fails()) {
            return response()->json([
                'message'=>'Error de validacion',
                'errors'=>$validate->errors()
            ],422);
        }

        try {
            $actualizacionPosslim->tecnico_id=$request->tecnico_id;
            $actualizacionPosslim->punto_oficina_id=$request->punto_oficina_id;
            $actualizacionPosslim->version_posslim_id=$request->version_posslim_id;
            $actualizacionPosslim->version_del_sims_id=$request->version_del_sims_id;
            $actualizacionPosslim->save();

            return response()->json([
                'message'=>'Actualizacion del posslim actualizado.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de actualizar la actualizacion del posslim.',
                'errors'=>null
            ],500);
        }
    }

    public function destroy(ActualizacionPosslim $actualizacionPosslim)
    {
        try {
            $actualizacionPosslim->delete();

            return response()->json([
                'message'=>'Actualizacion del posslim inhabilitado.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de inhabilitar la actualizacion del posslim.',
                'errors'=>null
            ],500);
        }
    }

    public function restore($actualizacionPosslim)
    {
        try {
            ActualizacionPosslim::withTrashed()->where('id',$actualizacionPosslim)->restore();

            return response()->json([
                'message'=>'Actualizacion del posslim restablecido.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de restablecer la actualizacion del posslim.',
                'errors'=>null
            ],500);
        }
    }

    public function forceDestroy($actualizacionPosslim)
    {
        try {
            ActualizacionPosslim::withTrashed()->where('id',$actualizacionPosslim)->forceDelete();

            return response()->json([
                'message'=>'Actualizacion del posslim eliminado.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de eliminar la actualizacion del posslim.',
                'errors'=>$th
            ],500);
        }
    }

    public function export(Request $request)
    {
        return Excel::download(new ActualizacionPosslimExport($request),'actualizacion-del-posslim.xlsx');
    }
}
