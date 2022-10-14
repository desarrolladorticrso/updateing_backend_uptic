<?php

namespace App\Http\Controllers;

use App\Exports\ValidacionAntenasExport;
use App\Models\ValidacionAntena;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ValidacionAntenaController extends Controller
{
    public function index(Request $request)
    {
        $datas=ValidacionAntena::with([
                'tecnico',
                'poblacion',
                'operador_satelital',
            ])
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
            'poblacion_id'=>'required|exists:poblacions,id',
            'operador_satelital_id'=>'required|exists:operador_satelitals,id',
            'nivel_senial_actual'=>'required',
            'tecnico_id'=>'required|exists:users,id',
            'observacion'=>'required',
            'id_antena'=>'required',
            'tiene_router'=>'required',
            'vpn_id'=>'required|exists:vpns,id',
            'prom_ping_hacia_vpn'=>'required',
            'capacidad_datos'=>'required',
            'ping_prom_tiemp_env_giro'=>'required',
            'ping_prom_tiemp_vent_chance'=>'required',
            'cant_equipos_oficina'=>'required',
            'cant_equipos_betplay'=>'required',
            'ping_prom_tiemp_pag_giro'=>'required',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'errors'=>$validate->errors()
            ],422);
        }

        if (!$validate->fails()) {
            try {
                $user=ValidacionAntena::create($request->all());

                return response()->json([
                    'message'=>"Validación de antenas registrado exitosamente.",
                    'datas'=>$user
                ],201);

            } catch (\Throwable $th) {
                return response()->json([
                    'message'=>"Ha surgido un error al tratar de agregar la validacion de antena.",
                    'datas'=>$th
                ],500);
            }
        }
    }

    public function show(ValidacionAntena $ValidacionAntena)
    {
        return response()->json([
            'message'=>'Datos obtenido.',
            'datas'=>$ValidacionAntena,
            'errors'=>null
        ],200);
    }

    public function update(ValidacionAntena $ValidacionAntena, Request $request)
    {
        $validate=Validator::make($request->all(),[
            'poblacion_id'=>'required|exists:poblacions,id',
            'operador_satelital_id'=>'required|exists:operador_satelitals,id',
            'nivel_senial_actual'=>'required',
            'tecnico_id'=>'required|exists:users,id',
            'observacion'=>'required',
            'id_antena'=>'required',
            'tiene_router'=>'required',
            'vpn_id'=>'required|exists:vpns,id',
            'prom_ping_hacia_vpn'=>'required',
            'capacidad_datos'=>'required',
            'ping_prom_tiemp_env_giro'=>'required',
            'ping_prom_tiemp_vent_chance'=>'required',
            'cant_equipos_oficina'=>'required',
            'cant_equipos_betplay'=>'required',
            'ping_prom_tiemp_pag_giro'=>'required',
        ]);


        if ($validate->fails()) {
            return response()->json([
                'message'=>'Error de validacion',
                'errors'=>$validate->errors()
            ],422);
        }

        try {
            $ValidacionAntena->poblacion_id=$request->poblacion_id;
            $ValidacionAntena->operador_satelital_id=$request->operador_satelital_id;
            $ValidacionAntena->nivel_senial_actual=$request->nivel_senial_actual;
            $ValidacionAntena->tecnico_id=$request->tecnico_id;
            $ValidacionAntena->observacion=$request->observacion;
            $ValidacionAntena->id_antena=$request->id_antena;
            $ValidacionAntena->tiene_router=$request->tiene_router;
            $ValidacionAntena->vpn_id=$request->vpn_id;
            $ValidacionAntena->prom_ping_hacia_vpn=$request->prom_ping_hacia_vpn;
            $ValidacionAntena->capacidad_datos=$request->capacidad_datos;
            $ValidacionAntena->ping_prom_tiemp_env_giro=$request->ping_prom_tiemp_env_giro;
            $ValidacionAntena->ping_prom_tiemp_vent_chance=$request->ping_prom_tiemp_vent_chance;
            $ValidacionAntena->cant_equipos_oficina=$request->cant_equipos_oficina;
            $ValidacionAntena->cant_equipos_betplay=$request->cant_equipos_betplay;
            $ValidacionAntena->ping_prom_tiemp_pag_giro=$request->ping_prom_tiemp_pag_giro;
            $ValidacionAntena->save();

            return response()->json([
                'message'=>'Validacion de antena actualizado.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de actualizar la validacion de antena.',
                'errors'=>null
            ],500);
        }
    }

    public function destroy(ValidacionAntena $ValidacionAntena)
    {
        try {
            $ValidacionAntena->delete();

            return response()->json([
                'message'=>'Validacion de antena inhabilitado.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de inhabilitar la validacion de antena.',
                'errors'=>null
            ],500);
        }
    }

    public function restore($ValidacionAntena)
    {
        try {
            ValidacionAntena::withTrashed()->where('id',$ValidacionAntena)->restore();

            return response()->json([
                'message'=>'Validacion de antena restablecido.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de restablecer la validacion de antena.',
                'errors'=>null
            ],500);
        }
    }

    public function forceDestroy($ValidacionAntena)
    {
        try {
            ValidacionAntena::withTrashed()->where('id',$ValidacionAntena)->forceDelete();

            return response()->json([
                'message'=>'Validacion de antena eliminado.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de eliminar la validacion de antena.',
                'errors'=>$th
            ],500);
        }
    }

    public function export(Request $request)
    {
        return Excel::download(new ValidacionAntenasExport($request),'inventario-de-validacion-de-antenas.xlsx');
    }
}
