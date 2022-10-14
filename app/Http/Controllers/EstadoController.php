<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EstadoController extends Controller
{
    public function index(Request $request)
    {
        $datas=Estado::withTrashed()
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
        $datas=Estado::orderBy('name')
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
            'name'=>'required|string|max:60|min:3|unique:estados,name',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            Estado::create([
                'name'=>$request->name,
            ]);

            return response()->json([
                'message'=>'Estado creado.',
                'errors'=>null
            ],201);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al intentar agregar el estado.',
                'errors'=>null
            ],500);
        }
    }

    public function show(Estado $estado)
    {
        return response()->json([
            'message'=>'Estado obtenido.',
            'datas'=>$estado,
            'errors'=>null
        ],200);
    }

    public function update(Estado $estado, Request $request)
    {
        $validation=Validator::make($request->all(),[
            'name'=>'required|string|max:60|min:3|unique:estados,name,'.$estado->id,
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            $estado->name=$request->name;
            $estado->save();

            return response()->json([
                'message'=>'Estado actualizado.',
                'errors'=>null
            ],202);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de actualizar el estado.',
                'error'=>null
            ],500);
        }
    }

    public function destroy(Estado $estado)
    {
        try {
            $estado->delete();

            return response()->json([
                'message'=>'Estado inhabilitada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de inhabilitar el estado.',
                'errors'=>null
            ],500);
        }
    }
    public function restore($estado)
    {
        try {
            Estado::withTrashed()->where('id',$estado)->restore();

            return response()->json([
                'message'=>'Estado restablecido.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al intentar de restablecer el estado.',
                'errors'=>null
            ],500);
        }
    }

    public function forceDestroy($estado)
    {
        try {
            Estado::withTrashed()->where('id',$estado)->forceDelete();

            return response()->json([
                'message'=>'Estado eliminado.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de eliminar el estado.',
                'errors'=>null
            ],500);
        }
    }
}
