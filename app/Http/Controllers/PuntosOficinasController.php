<?php

namespace App\Http\Controllers;

use App\Models\PuntosOficinas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PuntosOficinasController extends Controller
{
    public function index(Request $request)
    {
        $datas=PuntosOficinas::withTrashed()
            ->orderBy('id','DESC')
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
        $datas=PuntosOficinas::orderBy('name')
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
            'name'=>'required|string|max:60|min:3|unique:puntos_oficinas,name',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion.',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            PuntosOficinas::create([
                'name'=>$request->name,
            ]);

            return response()->json([
                'message'=>'Punto de oficina creado.',
                'errors'=>null
            ],201);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al intentar agregar punto de oficina.',
                'errors'=>null
            ],500);
        }
    }

    public function show(PuntosOficinas $punto_oficina)
    {
        return response()->json([
            'message'=>'Punto oficina obtenido.',
            'datas'=>$punto_oficina,
            'errors'=>null
        ],200);
    }

    public function update(PuntosOficinas $punto_oficina, Request $request)
    {
        $validation=Validator::make($request->all(),[
            'name'=>'required|string|max:60|min:3|unique:puntos_oficinas,name,'.$punto_oficina->id,
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            $punto_oficina->name=$request->name;
            $punto_oficina->save();

            return response()->json([
                'message'=>'Punto oficina actualizado.',
                'errors'=>null
            ],202);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de actualizar el punto oficina.',
                'error'=>null
            ],500);
        }
    }

    public function destroy(PuntosOficinas $punto_oficina)
    {
        try {
            $punto_oficina->delete();

            return response()->json([
                'message'=>'Punto oficina inhabilitada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de inhabilitar el punto de oficina.',
                'errors'=>null
            ],500);
        }
    }
    public function restore($estado)
    {
        try {
            PuntosOficinas::withTrashed()->where('id',$estado)->restore();

            return response()->json([
                'message'=>'Punto oficina restablecido.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al intentar de restablecer el punto de oficina.',
                'errors'=>null
            ],500);
        }
    }

    public function forceDestroy($punto_oficina)
    {
        try {
            PuntosOficinas::withTrashed()->where('id',$punto_oficina)->forceDelete();

            return response()->json([
                'message'=>'Punto de oficina eliminado.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de eliminar el punto de oficina.',
                'errors'=>null
            ],500);
        }
    }
}
