<?php

namespace App\Http\Controllers;

use App\Exports\RecepcionCentralExport;
use App\Models\RecepcionCentral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class RecepcionCentralController extends Controller
{
    public function index(Request $request)
    {
        $datas=RecepcionCentral::withTrashed()
            ->with('transportadora','proceso')
            ->orderBy('id','DESC')
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
            'fecha_recibido'=>'required',
            'nombre_quien_recibio'=>'required|string|max:40|min:3',
            'numero_guia'=>'required|string|max:20|min:4|unique:recepcion_central,numero_guia',
            'transportadora_id'=>'required|exists:transportadoras,id',
            'fecha_entrega'=>'required|max:20',
            'proceso_id'=>'required|exists:procesos,id',
            'nombre_recibe'=>'required|string|max:40|min:3',
            'observacion'=>'nullable|string|max:250|min:4',
            'valor_paquete'=>'nullable|max:250|min:4',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion.',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            RecepcionCentral::create($request->all());

            return response()->json([
                'message'=>'Recepcion cental creada.',
                'errors'=>null
            ],201);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al intentar agregar el Recepcion central.',
                'errors'=>null
            ],500);
        }
    }

    public function show(RecepcionCentral $recepcion_central)
    {
        return $recepcion_central;

        return response()->json([
            'message'=>'Recepcion cental.',
            'datas'=>$recepcion_central,
            'errors'=>null
        ],200);
    }

    public function update(RecepcionCentral $recepcion_central, Request $request)
    {
        $validation=Validator::make($request->all(),[
            'fecha_recibido'=>'required',
            'nombre_quien_recibio'=>'required|string|max:40|min:3',
            'numero_guia'=>'required|string|max:20|min:4|unique:recepcion_central,numero_guia,'.$recepcion_central->id,
            'transportadora_id'=>'required|exists:transportadoras,id',
            'fecha_entrega'=>'required|max:20',
            'proceso_id'=>'required|exists:procesos,id',
            'nombre_recibe'=>'required|string|max:40|min:3',
            'observacion'=>'nullable|string|max:250',
            'valor_paquete'=>'nullable|max:250',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion.',
                'errors'=>$validation->errors()
            ],422);
        }

        try {

            $recepcion_central->fecha_recibido=$request->fecha_recibido;
            $recepcion_central->nombre_quien_recibio=$request->nombre_quien_recibio;
            $recepcion_central->numero_guia=$request->numero_guia;
            $recepcion_central->transportadora_id=$request->transportadora_id;
            $recepcion_central->fecha_entrega=$request->fecha_entrega;
            $recepcion_central->proceso_id=$request->proceso_id;
            $recepcion_central->nombre_recibe=$request->nombre_recibe;
            $recepcion_central->observacion=$request->observacion;
            $recepcion_central->valor_paquete=$request->valor_paquete;
            $recepcion_central->estado_paquete=$request->estado_paquete;
            $recepcion_central->save();

            return response()->json([
                'message'=>'Recepcion central actualizada.',
                'errors'=>null
            ],202);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de actualizar la recepcion central.',
                'error'=>null
            ],500);
        }
    }

    public function destroy(RecepcionCentral $recepcion_central)
    {
        try {
            $recepcion_central->delete();

            return response()->json([
                'message'=>'Recepcion central inhabilitada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de inhabilitar la recepcion central.',
                'errors'=>null
            ],500);
        }
    }
    public function restore($recepcion_central)
    {
        try {
            RecepcionCentral::withTrashed()->where('id',$recepcion_central)->restore();

            return response()->json([
                'message'=>'Recepcion central restablecida.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al intentar de restablecer el recepcion central.',
                'errors'=>null
            ],500);
        }
    }

    public function forceDestroy($recepcion_central)
    {
        try {
            RecepcionCentral::withTrashed()->where('id',$recepcion_central)->forceDelete();

            return response()->json([
                'message'=>'Recepcion central eliminada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de eliminar el recepcion central.',
                'errors'=>null
            ],500);
        }
    }

    public function export(Request $request)
    {
        return Excel::download(new RecepcionCentralExport($request),'inventario_de_recepcion_central.xlsx');
    }
}
