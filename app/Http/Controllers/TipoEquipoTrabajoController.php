<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoEquipoTrabajo;
use Illuminate\Support\Facades\Validator;

class TipoEquipoTrabajoController extends Controller
{
    public function index(Request $request)
    {
        $datas=TipoEquipoTrabajo::withTrashed()
            ->orderBy('name')
            ->filters($request->only('search'))
            ->paginate();

        return response()->json([
            'message'=>"Datos obtenidos",
            'datas'=>$datas
        ],200);
    }

    public function all()
    {
        $datas=TipoEquipoTrabajo::orderBy('name')
            ->get();

        return response()->json([
            'message'=>"Datos obtenidos",
            'datas'=>$datas
        ],200);
    }

    public function store(Request $request)
    {
        $validate=Validator::make($request->all(),[
            'name'=>'required|string|max:50|min:3|unique:tipo_equipo_trabajos,name',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'errors'=>$validate->errors()
            ],422);
        }

        if (!$validate->fails()) {
            try {
                $user=TipoEquipoTrabajo::create([
                    'name'=>$request->name,
                ]);

                return response()->json([
                    'message'=>"Tipo equipo de trabajo  registrada exitosamente.",
                    'datas'=>$user
                ],201);

            } catch (\Throwable $th) {
                return response()->json([
                    'message'=>"Ha surgido un error al tratar de agregar el tipo equipo de trabajo.",
                    'datas'=>null
                ],500);
            }
        }
    }

    public function show(TipoEquipoTrabajo $tipo_equipo_trabajo)
    {
        return response()->json([
            'message'=>'Tipo equipo de trabajo obtenido.',
            'datas'=>$tipo_equipo_trabajo,
            'errors'=>null
        ],200);
    }

    public function update(TipoEquipoTrabajo $tipo_equipo_trabajo, Request $request)
    {
        $validation=Validator::make($request->all(),[
            'name'=>'required|string|max:50|min:3|unique:tipo_equipo_trabajos,name,'.$tipo_equipo_trabajo->id,
        ]);


        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            $tipo_equipo_trabajo->name=$request->name;
            $tipo_equipo_trabajo->save();

            return response()->json([
                'message'=>'Tipo equipo de trabajo actualizado.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de actualizar el tipo equipo de trabajo.',
                'errors'=>null
            ],500);
        }
    }

    public function destroy(TipoEquipoTrabajo $tipo_equipo_trabajo)
    {
        try {
            $tipo_equipo_trabajo->delete();

            return response()->json([
                'message'=>'Tipo equipo de trabajo inhabilitada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de inhabilitar el tipo equipo de trabajo.',
                'errors'=>null
            ],500);
        }
    }

    public function restore($tipo_equipo_trabajo)
    {
        try {
            TipoEquipoTrabajo::withTrashed()->where('id', $tipo_equipo_trabajo)->restore();

            return response()->json([
                'message'=>'Tipo equipo de trabajo restablecido.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de restablecer el tipo equipo de trabajo.',
                'errors'=>null
            ],500);
        }
    }

    public function forceDestroy($tipo_equipo_trabajo)
    {
        try {
            TipoEquipoTrabajo::withTrashed()->where('id',$tipo_equipo_trabajo)->forceDelete();

            return response()->json([
                'message'=>'Tipo equipo de trabajo eliminada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de eliminar el tipo equipo de trabajo.',
                'errors'=>$th
            ],500);
        }
    }
}
