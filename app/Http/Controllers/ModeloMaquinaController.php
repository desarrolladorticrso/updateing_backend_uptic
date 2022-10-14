<?php

namespace App\Http\Controllers;

use App\Models\ModeloMaquina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ModeloMaquinaController extends Controller
{
    public function index(Request $request)
    {
        $datas=ModeloMaquina::withTrashed()
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
        $datas=ModeloMaquina::orderBy('name')
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
            'name'=>'required|string|max:20|min:3|unique:modelos_maquinas,name',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion.',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            ModeloMaquina::create([
                'name'=>$request->name,
            ]);

            return response()->json([
                'message'=>'Modelo maquinas creado.',
                'errors'=>null
            ],201);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al intentar agregar el modelo de la maquina.',
                'errors'=>null
            ],500);
        }
    }

    public function show(ModeloMaquina $modelo_maquina)
    {
        return response()->json([
            'message'=>'Modelo de la maquina obtenido.',
            'datas'=>$modelo_maquina,
            'errors'=>null
        ],200);
    }

    public function update(ModeloMaquina $modelo_maquina, Request $request)
    {
        $validation=Validator::make($request->all(),[
            'name'=>'required|string|max:20|min:3|unique:modelos_maquinas,name,'.$modelo_maquina->id,
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            $modelo_maquina->name=$request->name;
            $modelo_maquina->save();

            return response()->json([
                'message'=>'Modelo de la maquina actualizado.',
                'errors'=>null
            ],202);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de actualizar el modelo de la maquina.',
                'error'=>null
            ],500);
        }
    }

    public function destroy(ModeloMaquina $modelo_maquina)
    {
        try {
            $modelo_maquina->delete();

            return response()->json([
                'message'=>'Modelo de la maquina inhabilitada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de inhabilitar el modelo de la maquina.',
                'errors'=>null
            ],500);
        }
    }
    public function restore($modelo_maquina)
    {
        try {
            ModeloMaquina::withTrashed()->where('id',$modelo_maquina)->restore();

            return response()->json([
                'message'=>'Modelo de maquina restablecido.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al intentar de restablecer el modelo de la maquina.',
                'errors'=>null
            ],500);
        }
    }

    public function forceDestroy($modelo_maquina)
    {
        try {
            ModeloMaquina::withTrashed()->where('id',$modelo_maquina)->forceDelete();

            return response()->json([
                'message'=>'Modelo de maquina eliminado.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de eliminar el modelo de la maquina.',
                'errors'=>null
            ],500);
        }
    }
}
