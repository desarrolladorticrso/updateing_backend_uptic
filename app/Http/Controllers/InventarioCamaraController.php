<?php

namespace App\Http\Controllers;

use App\Exports\InventarioCamarasExport;
use App\Models\InventarioCamara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class InventarioCamaraController extends Controller
{
    public function index(Request $request)
    {
        $datas=InventarioCamara::withTrashed()
            ->with('centro_costo','punto_oficina','marca_dvr','tecnico','estado')
            ->orderBy('id','DESC')
            ->filters($request->all())
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
            'ip'=>'required|ipv4',
            'url'=>'required|url',
            'user_sj'=>'required|max:60|min:3',
            'user_admin'=>'required|max:60|min:3',
            'password_sj'=>'required|max:60|min:3',
            'puerto_http'=>'required|numeric',
            'ancho_banda'=>'required|max:60|min:3',
            'observacion'=>'required|max:200|min:3',
            'user_soporte'=>'required|max:60|min:3',
            'tecnico_id'=>'required|exists:users,id',
            'marca_dvr_id'=>'required|exists:marcas_dvrs,id',
            'password_admin'=>'required|max:60|min:3',
            'centro_costo_id'=>'required|exists:centros_costos,id',
            'puerto_servidor'=>'required|numeric',
            'password_soporte'=>'required|max:60|min:3',
            'punto_oficina_id'=>'required|exists:puntos_oficinas,id',
            'cantidad_camaras'=>'required|numeric',
            'estado_camaras_id'=>'required|exists:estados,id',
            'nro_camaras_activas'=>'required|numeric',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion.',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            InventarioCamara::create($request->all());

            return response()->json([
                'message'=>'Inventario de camara agregado.',
                'errors'=>null
            ],201);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al intentar agregar el inventario de la camara.',
                'errors'=>$th
            ],500);
        }
    }

    public function show(InventarioCamara $inventario_camara)
    {
        return response()->json([
            'message'=>'Inventario camara obtenido.',
            'datas'=>$inventario_camara,
            'errors'=>null
        ],200);
    }

    public function update(InventarioCamara $inventario_camara, Request $request)
    {
        $validation=Validator::make($request->all(),[
            'ip'=>'required|ipv4',
            'url'=>'required|url',
            'puerto_http'=>'required|numeric',
            'user_sj'=>'required|max:60|min:3',
            'puerto_servidor'=>'required|numeric',
            'user_admin'=>'required|max:60|min:3',
            'password_sj'=>'required|max:60|min:3',
            'cantidad_camaras'=>'required|numeric',
            'ancho_banda'=>'required|max:60|min:3',
            'observacion'=>'required|max:200|min:3',
            'user_soporte'=>'required|max:60|min:3',
            'tecnico_id'=>'required|exists:users,id',
            'nro_camaras_activas'=>'required|numeric',
            'password_admin'=>'required|max:60|min:3',
            'password_soporte'=>'required|max:60|min:3',
            'marca_dvr_id'=>'required|exists:marcas_dvrs,id',
            'estado_camaras_id'=>'required|exists:estados,id',
            'centro_costo_id'=>'required|exists:centros_costos,id',
            'punto_oficina_id'=>'required|exists:puntos_oficinas,id',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            $inventario_camara->ip=$request->ip;
            $inventario_camara->url=$request->url;
            $inventario_camara->user_sj=$request->user_sj;
            $inventario_camara->user_admin=$request->user_admin;
            $inventario_camara->tecnico_id=$request->tecnico_id;
            $inventario_camara->password_sj=$request->password_sj;
            $inventario_camara->puerto_http=$request->puerto_http;
            $inventario_camara->ancho_banda=$request->ancho_banda;
            $inventario_camara->observacion=$request->observacion;
            $inventario_camara->user_soporte=$request->user_soporte;
            $inventario_camara->marca_dvr_id=$request->marca_dvr_id;
            $inventario_camara->password_admin=$request->password_admin;
            $inventario_camara->centro_costo_id=$request->centro_costo_id;
            $inventario_camara->puerto_servidor=$request->puerto_servidor;
            $inventario_camara->password_soporte=$request->password_soporte;
            $inventario_camara->punto_oficina_id=$request->punto_oficina_id;
            $inventario_camara->cantidad_camaras=$request->cantidad_camaras;
            $inventario_camara->estado_camaras_id=$request->estado_camaras_id;
            $inventario_camara->nro_camaras_activas=$request->nro_camaras_activas;
            $inventario_camara->save();

            return response()->json([
                'message'=>'Inventario de camara actualizado.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de actualizar el inventario de camara.',
                'error'=>$th
            ],500);
        }
    }

    public function destroy(InventarioCamara $inventario_camara)
    {
        try {
            $inventario_camara->delete();

            return response()->json([
                'message'=>'Inventario de camara inhabilitada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de inhabilitar el inventario de camara.',
                'errors'=>null
            ],500);
        }
    }
    public function restore($inventario_camara)
    {
        try {
            InventarioCamara::withTrashed()->where('id',$inventario_camara)->restore();

            return response()->json([
                'message'=>'Inventario de camara restablecido.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al intentar de restablecer el inventario de camara.',
                'errors'=>null
            ],500);
        }
    }

    public function forceDestroy($inventario_camara)
    {
        try {
            InventarioCamara::withTrashed()->where('id',$inventario_camara)->forceDelete();

            return response()->json([
                'message'=>'Inventario de camara eliminado.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de eliminar la inventario de camara.',
                'errors'=>null
            ],500);
        }
    }

    public function export(Request $request)
    {
        return Excel::download(new InventarioCamarasExport($request),'inventario-de-camaras.xlsx');
    }
}
