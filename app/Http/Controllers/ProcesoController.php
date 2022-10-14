<?php

namespace App\Http\Controllers;

use App\Models\Proceso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProcesoController extends Controller
{
    public function index(Request $request)
    {
        $datas=Proceso::withTrashed()
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
        $datas=Proceso::orderBy('name')
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
            'name'=>'required|string|max:20|min:3|unique:procesos,name',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion.',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            Proceso::create([
                'name'=>$request->name,
            ]);

            return response()->json([
                'message'=>'Proceso creado.',
                'errors'=>null
            ],201);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al intentar agregar el proceso.',
                'errors'=>null
            ],500);
        }
    }

    public function show(Proceso $proceso)
    {
        return response()->json([
            'message'=>'Proceso obtenido.',
            'datas'=>$proceso,
            'errors'=>null
        ],200);
    }

    public function update(Proceso $proceso, Request $request)
    {
        $validation=Validator::make($request->all(),[
            'name'=>'required|string|max:20|min:3|unique:procesos,name,'.$proceso->id,
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            $proceso->name=$request->name;
            $proceso->save();

            return response()->json([
                'message'=>'Procesos actualizado.',
                'errors'=>null
            ],202);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de actualizar el proceso.',
                'error'=>null
            ],500);
        }
    }

    public function destroy(Proceso $proceso)
    {
        try {
            $proceso->delete();

            return response()->json([
                'message'=>'Proceso inhabilitada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de inhabilitar el proceso.',
                'errors'=>null
            ],500);
        }
    }
    public function restore($proceso)
    {
        try {
            Proceso::withTrashed()->where('id',$proceso)->restore();

            return response()->json([
                'message'=>'Proceso restablecido.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al intentar de restablecer el proceso.',
                'errors'=>null
            ],500);
        }
    }

    public function forceDestroy($proceso)
    {
        try {
            Proceso::withTrashed()->where('id',$proceso)->forceDelete();

            return response()->json([
                'message'=>'Proceso eliminado.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de eliminar el proceso.',
                'errors'=>null
            ],500);
        }
    }
}
