<?php

namespace App\Http\Controllers;

use App\Models\OperadorTecnologico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OperadorTecnologicoController extends Controller
{
    public function index(Request $request)
    {
        $datas=OperadorTecnologico::withTrashed()
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
        $datas=OperadorTecnologico::orderBy('name')->get();

        return response()->json([
            'message'=>'Datos obtenidos',
            'datas'=>$datas,
            'errors'=>null
        ],200);
    }

    public function store(Request $request)
    {
        $validation=Validator::make($request->all(),[
            'name'=>'required|string|max:20|min:3|unique:operador_tecnologicos,name',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion.',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            OperadorTecnologico::create([
                'name'=>$request->name,
            ]);

            return response()->json([
                'message'=>'Operador tecnologico creado.',
                'errors'=>null
            ],201);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al intentar agregar el operador tecnologico.',
                'errors'=>null
            ],500);
        }
    }

    public function show(OperadorTecnologico $operador_tecnologico)
    {
        return response()->json([
            'message'=>'Operador tecnologico obtenido.',
            'datas'=>$operador_tecnologico,
            'errors'=>null
        ],200);
    }

    public function update(OperadorTecnologico $operador_tecnologico, Request $request)
    {
        $validation=Validator::make($request->all(),[
            'name'=>'required|string|max:20|min:3|unique:operador_tecnologicos,name,'.$operador_tecnologico->id,
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            $operador_tecnologico->name=$request->name;
            $operador_tecnologico->save();

            return response()->json([
                'message'=>'Operador tecnologico actualizado.',
                'errors'=>null
            ],202);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de actualizar el operador tecnologico.',
                'error'=>null
            ],500);
        }
    }

    public function destroy(OperadorTecnologico $operador_tecnologico)
    {
        try {
            $operador_tecnologico->delete();

            return response()->json([
                'message'=>'Operador tecnologico inhabilitada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de inhabilitar el operador tecnologico.',
                'errors'=>null
            ],500);
        }
    }
    public function restore($operador_tecnologico)
    {
        try {
            OperadorTecnologico::withTrashed()->where('id',$operador_tecnologico)->restore();

            return response()->json([
                'message'=>'Operador tecnologico restablecido.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al intentar de restablecer el operador tecnologico.',
                'errors'=>null
            ],500);
        }
    }

    public function forceDestroy($operador_tecnologico)
    {
        try {
            OperadorTecnologico::withTrashed()->where('id',$operador_tecnologico)->forceDelete();

            return response()->json([
                'message'=>'Operador tecnologico eliminado.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de eliminar el operador tecnologico.',
                'errors'=>null
            ],500);
        }
    }
}
