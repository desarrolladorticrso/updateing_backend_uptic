<?php

namespace App\Http\Controllers;

use App\Exports\InventoryMachineExport;
use App\Models\InventarioMaquina;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class InventarioMaquinaController extends Controller
{
    public function index(Request $request)
    {
        $datas=InventarioMaquina::withTrashed()
            ->orderBy('id','DESC')
            ->join('asesores','asesores.id','=','inventario_maquinas.asesor_id')
            ->join('lideres','lideres.id','=','inventario_maquinas.lider_id')
            ->join('lineas_moviles','lineas_moviles.id','=','inventario_maquinas.nro_linea_id')
            ->join('puntos_oficinas','puntos_oficinas.id','=','inventario_maquinas.punto_oficina_id')
            ->where(function ($query) use($request){
                if ($request['search']) {
                    $query->where('lineas_moviles.linea',$request->search)
                    ->orWhere('lineas_moviles.serial',$request->search);
                }
            })
            ->filters($request->all())
            ->select([
                'inventario_maquinas.id as id',
                'inventario_maquinas.deleted_at',
                'lineas_moviles.linea as linea',
                'asesores.name as nombre_asesor',
                'asesores.documento as documento_asesor',
                'lideres.numero_documento as documento_lider',
                'lideres.name as nombre_lider',
                'puntos_oficinas.name as puntos_oficinas',
            ])
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
            'imei'=>'required|string|max:30|min:8',
            'apn_id'=>'required|exists:apns,id',
            'lider_id'=>'required|exists:lideres,id',
            'asesor_id'=>'required|exists:asesores,id',
            'tecnico_id'=>'required|exists:users,id',
            'activo_fijo'=>'required|max:30|min:4',
            'nro_linea_id'=>'required|exists:lineas_moviles,id',
            'mantenimiento'=>'required|in:si,no',
            'serial_maquina'=>'required|max:30|min:4',
            'punto_oficina_id'=>'required|exists:puntos_oficinas,id',
            'modelo_maquina_id'=>'required|exists:modelos_maquinas,id',
            'version_maquina_id'=>'required|exists:version_maquinas,id',
            'operador_simcard_id'=>'required|exists:operador_simcards,id',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion.',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            InventarioMaquina::create($request->all());

            return response()->json([
                'message'=>'Inventario de maquina agregado.',
                'errors'=>null
            ],201);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al intentar agregar el inventario de la maquina.',
                'errors'=>$th
            ],500);
        }
    }

    public function show(InventarioMaquina $inventario_maquina)
    {
        return response()->json([
            'message'=>'Inventario maquina obtenido.',
            'datas'=>$inventario_maquina,
            'errors'=>null
        ],200);
    }

    public function update(InventarioMaquina $inventario_maquina, Request $request)
    {
        $validation=Validator::make($request->all(),[
            'imei'=>'required|string|max:30|min:8',
            'apn_id'=>'required|exists:apns,id',
            'lider_id'=>'required|exists:lideres,id',
            'asesor_id'=>'required|exists:asesores,id',
            'tecnico_id'=>'required|exists:users,id',
            'activo_fijo'=>'required|max:30|min:4',
            'nro_linea_id'=>'required|exists:lineas_moviles,id',
            'mantenimiento'=>'required|in:si,no',
            'serial_maquina'=>'required|max:30|min:4',
            'punto_oficina_id'=>'required|exists:puntos_oficinas,id',
            'modelo_maquina_id'=>'required|exists:modelos_maquinas,id',
            'version_maquina_id'=>'required|exists:version_maquinas,id',
            'operador_simcard_id'=>'required|exists:operador_simcards,id',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            $inventario_maquina->imei=$request->imei;
            $inventario_maquina->apn_id=$request->apn_id;
            $inventario_maquina->lider_id=$request->lider_id;
            $inventario_maquina->asesor_id=$request->asesor_id;
            $inventario_maquina->tecnico_id=$request->tecnico_id;
            $inventario_maquina->activo_fijo=$request->activo_fijo;
            $inventario_maquina->nro_linea_id=$request->nro_linea_id;
            $inventario_maquina->mantenimiento=$request->mantenimiento;
            $inventario_maquina->serial_maquina=$request->serial_maquina;
            $inventario_maquina->punto_oficina_id=$request->punto_oficina_id;
            $inventario_maquina->modelo_maquina_id=$request->modelo_maquina_id;
            $inventario_maquina->version_maquina_id=$request->version_maquina_id;
            $inventario_maquina->operador_simcard_id=$request->operador_simcard_id;
            $inventario_maquina->save();

            return response()->json([
                'message'=>'Inventario de maquina actualizado.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de actualizar el inventario de maquina.',
                'error'=>null
            ],500);
        }
    }

    public function destroy(InventarioMaquina $inventario_maquina)
    {
        try {
            $inventario_maquina->delete();

            return response()->json([
                'message'=>'Inventario de maquina inhabilitada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de inhabilitar el inventario de maquina.',
                'errors'=>null
            ],500);
        }
    }
    public function restore($inventario_maquina)
    {
        try {
            InventarioMaquina::withTrashed()->where('id',$inventario_maquina)->restore();

            return response()->json([
                'message'=>'Inventario de maquina restablecido.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al intentar de restablecer el inventario de maquina.',
                'errors'=>null
            ],500);
        }
    }

    public function forceDestroy($inventario_maquina)
    {
        try {
            InventarioMaquina::withTrashed()->where('id',$inventario_maquina)->forceDelete();

            return response()->json([
                'message'=>'Inventario de maquina eliminado.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de eliminar la inventario de maquina.',
                'errors'=>null
            ],500);
        }
    }

    public function export(Request $request)
    {
        return Excel::download(new InventoryMachineExport($request),'inventario-de-maquinas.xlsx');
    }

    public function countInventory()
    {
        $datas=InventarioMaquina::select(DB::raw("count(id) as count"))

            ->take(12)
            ->get();

        return response()->json([
                'message'=>'Datos obtenidos.',
                'datas'=>$datas
            ],200);

    }
}
