<?php

namespace App\Http\Controllers;

use App\Models\LineaMovile;
use Illuminate\Http\Request;
use App\Exports\LinesMovilesExport;
use App\Models\InventarioMaquina;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class LineaMovileController extends Controller
{
    public function index(Request $request)
    {
        $datas=LineaMovile::withTrashed()
            ->with('operador_simcard','inventario_maquinas')
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
        $datas=LineaMovile::orderBy('linea')
            ->select([
                'id',
                'linea',
            ])
            ->get();

        return response()->json([
            'message'=>'Datos obtenidos',
            'datas'=>$datas,
            'errors'=>null
        ],200);
    }

    public function store(Request $request)
    {
        $validate=Validator::make($request->all(),[
            'linea'=>'required|string|max:12|min:10|unique:lineas_moviles,linea',
            'serial'=>'required|string|max:30|min:10|unique:lineas_moviles,serial',
            'plan'=>'nullable|max:500|min:10',
            'caracteristicas_servicio'=>'required|max:500',
            'operador_id'=>'required|exists:operador_simcards,id',
            'estado_linea_id'=>'required|exists:estados,id'
        ]);

        if ($request->operador_id==3) {
            $validate=Validator::make($request->all(),[
                'linea'=>'required|string|max:12|min:10|unique:lineas_moviles,linea',
                'serial'=>'required|string|max:30|min:10|unique:lineas_moviles,serial',
                'plan'=>'nullable|max:500|min:10',
                'caracteristicas_servicio'=>'required|max:500',
                'operador_id'=>'required|exists:operador_simcards,id',
                'ip'=>'required',
                'usuario'=>'required|unique:lineas_moviles,usuario',
                'password'=>'required',
                'cargo_basico'=>'required',
                'codigo_cliente'=>'required',
            ]);
        }

        if ($validate->fails()) {
            return response()->json([
                'message'=>'Error de validacion.',
                'errors'=>$validate->errors()
            ],422);
        }

        try {
            LineaMovile::create($request->all());

            return response()->json([
                'message'=>'Linea movil agregada.',
                'errors'=>null
            ],201);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al intentar agregar la linea movil.',
                'errors'=>null
            ],500);
        }
    }

    public function show(LineaMovile $linea_movil)
    {
        return response()->json([
            'message'=>'Linea movil obtenida.',
            'datas'=>$linea_movil,
            'errors'=>null
        ],200);
    }

    public function update(LineaMovile $linea_movil, Request $request)
    {
        $validate=Validator::make($request->all(),[
            'linea'=>'required|string|max:12|min:10|unique:lineas_moviles,linea,'.$linea_movil->id,
            'serial'=>'required|string|max:30|min:10|unique:lineas_moviles,serial,'.$linea_movil->id,
            'plan'=>'nullable|max:500|min:10',
            'caracteristicas_servicio'=>'required|max:500',
            'operador_id'=>'required|exists:operador_simcards,id',
            'estado_linea_id'=>'required|exists:estados,id'
        ]);

        if ($request->operador_id==3) {
            $validate=Validator::make($request->all(),[
                'linea'=>'required|string|max:12|min:10|unique:lineas_moviles,linea,'.$linea_movil->id,
                'serial'=>'required|string|max:30|min:10|unique:lineas_moviles,serial,'.$linea_movil->id,
                'plan'=>'nullable|max:500|min:10',
                'caracteristicas_servicio'=>'required|max:500',
                'operador_id'=>'required|exists:operador_simcards,id',
                'ip'=>'required',
                'usuario'=>'required|unique:lineas_moviles,usuario,'.$linea_movil->id,
                'password'=>'required',
                'cargo_basico'=>'required',
                'codigo_cliente'=>'required',
            ]);
        }

        if ($validate->fails()) {
            return response()->json([
                'message'=>'Error de validacion',
                'errors'=>$validate->errors()
            ],422);
        }

        try {

            $linea_movil->ip=$request->ip;
            $linea_movil->plan=$request->plan;
            $linea_movil->linea=$request->linea;
            $linea_movil->serial=$request->serial;
            $linea_movil->usuario=$request->usuario;
            $linea_movil->password=$request->password;
            $linea_movil->operador_id=$request->operador_id;
            $linea_movil->cargo_basico=$request->cargo_basico;
            $linea_movil->codigo_cliente=$request->codigo_cliente;
            $linea_movil->estado_linea_id=$request->estado_linea_id;
            $linea_movil->caracteristicas_servicio=$request->caracteristicas_servicio;
            $linea_movil->save();

            return response()->json([
                'message'=>'Linea movil actualizada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de actualizar la linea movil.',
                'error'=>null
            ],500);
        }
    }

    public function destroy(LineaMovile $linea_movil)
    {
        try {
            $linea_movil->delete();

            return response()->json([
                'message'=>'Linea movil inhabilitada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de inhabilitar la linea movil.',
                'errors'=>null
            ],500);
        }
    }
    public function restore($linea_movil)
    {
        try {
            LineaMovile::withTrashed()->where('id',$linea_movil)->restore();

            return response()->json([
                'message'=>'Linea movil restablecida.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al intentar de restablecer la linea movil.',
                'errors'=>null
            ],500);
        }
    }

    public function forceDestroy($linea_movil)
    {
        try {
            LineaMovile::withTrashed()->where('id',$linea_movil)->forceDelete();

            return response()->json([
                'message'=>'Linea movil eliminada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de eliminar la linea movil.',
                'errors'=>null
            ],500);
        }
    }

    public function export(Request $request)
    {
        return Excel::download(new LinesMovilesExport($request), 'lineas-moviles.xlsx');
    }

    public function relacionar(Request $request)
    {
        $validate=Validator::make($request->all(),[
            'linea'=>'required|exists:lineas_moviles,id',
            'serial'=>'required|string|max:30|min:3',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'message'=>'Error de validacion.',
                'errors'=>$validate->errors()
            ],422);
        }

        try {
            $inventory=DB::table('inventario_maquinas')
                ->where('serial_maquina',$request->serial)
                ->orWhere('activo_fijo',$request->serial)
                ->update([
                    'nro_linea_id'=>$request->linea
                ]);

            if ($inventory) {
                return response()->json([
                    'message'=>'Se ha referenciado correctamente la linea.',
                    'errors'=>null
                ],201);
            }
            return response()->json([
                'message'=>'No se encontraron registros de maquinas con el serial o activo ingresado.',
                'errors'=>null
            ],404);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al intentar de referenciar la linea a la.',
                'errors'=>$th
            ],500);
        }
    }

    public function report()
    {
        $datas=DB::table('operador_simcards')
            ->select(DB::raw('count(lineas_moviles.id) as number, name'))
            ->join('lineas_moviles','lineas_moviles.operador_id','=','operador_simcards.id')
            ->groupBy('name')
            ->get();

        return response()->json([
                'message'=>'Datos obtenidos.',
                'datas'=>$datas
            ],200);

    }
}
