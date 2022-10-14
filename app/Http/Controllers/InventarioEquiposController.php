<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InventarioEquipos;
use Illuminate\Support\Facades\Validator;

class InventarioEquiposController extends Controller
{
    public function index(Request $request)
    {
        $datas=InventarioEquipos::withTrashed()
            ->with([
                'asesor',
                'lider',
                'punto_oficina',
                'tipo_equipo_trabajo',
                'marca_equipo',
                'tipo_sistema_operativo',
                'memoria_ram',
                'disco_duro',
                'marca_monitor',
                'marca_teclado',
                'marca_impresora',
                'tipo_conexion',
                'tecnico',
                'tipo_servicio',
            ])
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
            'asesor_id'                     => 'required|numeric|exists:asesores,id',
            'lider_id'                      => 'required|numeric|exists:lideres,id',
            'punto_oficina_id'              => 'required|numeric|exists:puntos_oficinas,id',
            'tipo_equipo_trabajo_id'        => 'required|numeric|exists:tipo_equipo_trabajos,id',
            'marca_equipo_id'               => 'required|numeric|exists:marca_equipos,id',
            'tipo_sistema_operativo_id'     => 'required|numeric|exists:sistema_operativos,id',
            'memoria_ram_id'                => 'required|numeric|exists:memoria_r_a_m_s,id',
            'disco_duro_id'                 => 'required|numeric|exists:disco_duros,id',
            'estado_equipo_trabajo_id'      => 'required|numeric|exists:asesores,id',
            'marca_mouse_id'                => 'required|numeric|exists:asesores,id',
            'tipo_conexion_id'              => 'required|numeric|exists:tipo_conexions,id'
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion.',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            InventarioEquipos::create($request->all());

            return response()->json([
                'message'=>'Inventario de equipo agregado.',
                'errors'=>null
            ],201);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al intentar agregar el inventario de la equipo.',
                'errors'=>null
            ],500);
        }
    }

    public function show(InventarioEquipos $inventario_equipo)
    {
        return response()->json([
            'message'=>'Inventario equipo obtenido.',
            'datas'=>$inventario_equipo,
            'errors'=>null
        ],200);
    }

    public function update(InventarioEquipos $inventario_equipo, Request $request)
    {
        $validation=Validator::make($request->all(),[
            'asesor_id'                     => 'required|numeric|exists:asesores,id',
            'lider_id'                      => 'required|numeric|exists:lideres,id',
            'punto_oficina_id'              => 'required|numeric|exists:puntos_oficinas,id',
            'tipo_equipo_trabajo_id'        => 'required|numeric|exists:tipo_equipo_trabajos,id',
            'marca_equipo_id'               => 'required|numeric|exists:marca_equipos,id',
            'tipo_sistema_operativo_id'     => 'required|numeric|exists:sistema_operativos,id',
            'memoria_ram_id'                => 'required|numeric|exists:memoria_r_a_m_s,id',
            'disco_duro_id'                 => 'required|numeric|exists:disco_duros,id',
            'estado_equipo_trabajo_id'      => 'required|numeric|exists:asesores,id',
            'marca_mouse_id'                => 'required|numeric|exists:asesores,id',
            'tipo_conexion_id'              => 'required|numeric|exists:tipo_conexions,id'
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
                $inventario_equipo->asesor_id                      = $request->asesor_id;
                $inventario_equipo->lider_id                       = $request->lider_id;
                $inventario_equipo->punto_oficina_id               = $request->punto_oficina_id;
                $inventario_equipo->tipo_equipo_trabajo_id         = $request->tipo_equipo_trabajo_id;
                $inventario_equipo->marca_equipo_id                = $request->marca_equipo_id;
                $inventario_equipo->tipo_sistema_operativo_id      = $request->tipo_sistema_operativo_id;
                $inventario_equipo->memoria_ram_id                 = $request->memoria_ram_id;
                $inventario_equipo->disco_duro_id                  = $request->disco_duro_id;
                $inventario_equipo->activo_fijo_equipo             = $request->activo_fijo_equipo;
                $inventario_equipo->serial_equipo                  = $request->serial_equipo;
                $inventario_equipo->estado_equipo_trabajo_id       = $request->estado_equipo_trabajo_id;
                $inventario_equipo->tiene_monitor                  = $request->tiene_monitor;
                $inventario_equipo->marca_monitor_id               = $request->marca_monitor_id;
                $inventario_equipo->activo_fijo_monitor            = $request->activo_fijo_monitor;
                $inventario_equipo->modelo_monitor                 = $request->modelo_monitor;
                $inventario_equipo->serial_monitor                 = $request->serial_monitor;
                $inventario_equipo->estado_monitor_id              = $request->estado_monitor_id;
                $inventario_equipo->marca_teclado_id               = $request->marca_teclado_id;
                $inventario_equipo->modelo_teclado                 = $request->modelo_teclado;
                $inventario_equipo->activo_fijo_teclado            = $request->activo_fijo_teclado;
                $inventario_equipo->serial_teclado                 = $request->serial_teclado;
                $inventario_equipo->estado_teclado_id              = $request->estado_teclado_id;
                $inventario_equipo->marca_mouse_id                 = $request->marca_mouse_id;
                $inventario_equipo->modelo_mouse                   = $request->modelo_mouse;
                $inventario_equipo->activo_fijo_mouse              = $request->activo_fijo_mouse;
                $inventario_equipo->serial_mouse                   = $request->serial_mouse;
                $inventario_equipo->estado_mouse_id                = $request->estado_mouse_id;
                $inventario_equipo->marca_impresora_id             = $request->marca_impresora_id;
                $inventario_equipo->modelo_impresora               = $request->modelo_impresora;
                $inventario_equipo->activo_fijo_impresora          = $request->activo_fijo_impresora;
                $inventario_equipo->serial_impresora               = $request->serial_impresora;
                $inventario_equipo->estado_impresora_id            = $request->estado_impresora_id;
                $inventario_equipo->activo_fijo_lector_biometrico  = $request->activo_fijo_lector_biometrico;
                $inventario_equipo->serial_lector_biometrico       = $request->serial_lector_biometrico;
                $inventario_equipo->tiene_lector_barra             = $request->tiene_lector_barra;
                $inventario_equipo->activo_lector_barra            = $request->activo_lector_barra;
                $inventario_equipo->serial_lector_barra            = $request->serial_lector_barra;
                $inventario_equipo->tipo_conexion_id               = $request->tipo_conexion_id;
                $inventario_equipo->tecnico_id                     = $request->tecnico_id;
                $inventario_equipo->tipo_servicio_id               = $request->tipo_servicio_id;
                $inventario_equipo->ip_equipo                      = $request->ip_equipo;
                $inventario_equipo->mac_equipo                     = $request->mac_equipo;
                $inventario_equipo->tiene_sid                      = $request->tiene_sid;
                $inventario_equipo->serial_sid                     = $request->serial_sid;
                $inventario_equipo->activo_fijo_sid                = $request->activo_fijo_sid;
                $inventario_equipo->save();

            return response()->json([
                'message'=>'Inventario de equipo actualizado.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de actualizar el inventario de equipo.',
                'error'=>null
            ],500);
        }
    }

    public function destroy(InventarioEquipos $inventario_equipo)
    {
        try {
            $inventario_equipo->delete();

            return response()->json([
                'message'=>'Inventario de equipo inhabilitada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de inhabilitar el inventario de equipo.',
                'errors'=>null
            ],500);
        }
    }
    public function restore($inventario_equipo)
    {
        try {
            InventarioEquipos::withTrashed()->where('id',$inventario_equipo)->restore();

            return response()->json([
                'message'=>'Inventario de equipo restablecido.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al intentar de restablecer el inventario de equipo.',
                'errors'=>null
            ],500);
        }
    }

    public function forceDestroy($inventario_equipo)
    {
        try {
            InventarioEquipos::withTrashed()->where('id',$inventario_equipo)->forceDelete();

            return response()->json([
                'message'=>'Inventario de equipo eliminado.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de eliminar la inventario de equipo.',
                'errors'=>null
            ],500);
        }
    }
}
