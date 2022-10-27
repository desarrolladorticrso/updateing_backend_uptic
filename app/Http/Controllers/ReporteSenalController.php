<?php

namespace App\Http\Controllers;

use App\Exports\ReporteSenalExport;
use App\Models\ReporteSenal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ReporteSenalController extends Controller
{
    public function index(Request $request)
    {
        $datas=ReporteSenal::withTrashed()
            ->with('poblacion','tecnico','operador_tecnologico')
            ->orderBy('id','DESC')
            ->filters($request->all())
            ->paginate();

        return response()->json([
            'message'=>"Datos obtenidos",
            'datas'=>$datas
        ],200);
    }

    public function store(Request $request)
    {
        $validate=Validator::make($request->all(),[
            'poblacion_id'=>'required|numeric|exists:poblacions,id',
            'operador_tecnologico_id'=>'required|numeric|exists:poblacions,id',
            'numero_linea'=>'required|string|max:2000|min:7',
            'numero_incidente'=>'required|string|max:20|min:6|unique:reporte_senials,numero_incidente',
            'observacion'=>'required|string|max:2000|min:6',
            'tecnico_id'=>'required|numeric|exists:users,id',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'errors'=>$validate->errors()
            ],422);
        }

        if (!$validate->fails()) {
            try {
                $reporte_señal=ReporteSenal::create([
                    'poblacion_id'=>$request->poblacion_id,
                    'operador_tecnologico_id'=>$request->operador_tecnologico_id,
                    'numero_linea'=>$request->numero_linea,
                    'numero_incidente'=>$request->numero_incidente,
                    'observacion'=>$request->observacion,
                    'tecnico_id'=>$request->tecnico_id,
                ]);

                return response()->json([
                    'message'=>"Reporte de señal registrado exitosamente.",
                    'datas'=>$reporte_señal
                ],201);

            } catch (\Throwable $th) {
                return response()->json([
                    'message'=>"Ha surgido un error al tratar de agregar el reporte de señal.".$th,
                    'datas'=>null
                ],500);
            }
        }
    }

    public function show(ReporteSenal $reporte_señal)
    {
        return response()->json([
            'message'=>'Reporte de señal obtenido.',
            'datas'=>$reporte_señal,
            'errors'=>null
        ],200);
    }

    public function update(ReporteSenal $reporte_señal, Request $request)
    {
        $validation=Validator::make($request->all(),[
            'poblacion_id'=>'required|numeric|exists:poblacions,id',
            'operador_tecnologico_id'=>'required|numeric|exists:poblacions,id',
            'numero_linea'=>'required|string|max:2000|min:7',
            'numero_incidente'=>'required|string|max:20|min:6|unique:reporte_senials,numero_incidente,'.$reporte_señal->id,
            'observacion'=>'required|string|max:2000|min:6',
            'tecnico_id'=>'required|numeric|exists:users,id',
        ]);


        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            $reporte_señal->poblacion_id=$request->poblacion_id;
            $reporte_señal->operador_tecnologico_id=$request->operador_tecnologico_id;
            $reporte_señal->numero_linea=$request->numero_linea;
            $reporte_señal->numero_incidente=$request->numero_incidente;
            $reporte_señal->observacion=$request->observacion;
            $reporte_señal->tecnico_id=$request->tecnico_id;
            $reporte_señal->save();

            return response()->json([
                'message'=>'Reporte señal actualizado.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de actualizar el reporte de señal.',
                'errors'=>null
            ],500);
        }
    }

    public function destroy(ReporteSenal $reporte_señal)
    {
        try {
            $reporte_señal->delete();

            return response()->json([
                'message'=>'Reporte de señal inhabilitada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de inhabilitar el reporte de señal.',
                'errors'=>null
            ],500);
        }
    }

    public function restore($reporte_señal)
    {
        try {
            ReporteSenal::withTrashed()->where('id', $reporte_señal)->restore();

            return response()->json([
                'message'=>'Reporte de señal restablecido.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de restablecer el reporte de señal.',
                'errors'=>null
            ],500);
        }
    }

    public function forceDestroy($reporte_señal)
    {
        try {
            ReporteSenal::withTrashed()->where('id',$reporte_señal)->forceDelete();

            return response()->json([
                'message'=>'Reporte de señal eliminado.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de eliminar el reporte de señal.',
                'errors'=>$th
            ],500);
        }
    }

    public function export(Request $request)
    {
        return Excel::download(new ReporteSenalExport($request),'inventario-de-reporte-de-señal.xlsx');
    }
}
