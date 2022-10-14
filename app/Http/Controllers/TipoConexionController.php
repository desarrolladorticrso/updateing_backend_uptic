<?php

namespace App\Http\Controllers;

use App\Models\TipoConexion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TipoConexionController extends Controller
{
    public function index(Request $request)
    {
        $datas=TipoConexion::withTrashed()
            ->orderBy('name')
            ->filters($request->only('search'))
            ->paginate();

        return response()->json([
            'message'=>"Datos obtenidos",
            'datas'=>$datas
        ],200);
    }

    public function all()
    {
        $datas=TipoConexion::orderBy('name')
            ->get();

        return response()->json([
            'message'=>"Datos obtenidos",
            'datas'=>$datas
        ],200);
    }

    public function store(Request $request)
    {
        $validate=Validator::make($request->all(),[
            'name'=>'required|string|max:50|min:3|unique:tipo_conexions,name',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'errors'=>$validate->errors()
            ],422);
        }

        if (!$validate->fails()) {
            try {
                $user=TipoConexion::create([
                    'name'=>$request->name,
                ]);

                return response()->json([
                    'message'=>"Tipo de condexion registrado exitosamente.",
                    'datas'=>$user
                ],201);

            } catch (\Throwable $th) {
                return response()->json([
                    'message'=>"Ha surgido un error al tratar de agregar el tipo de conexion.",
                    'datas'=>null
                ],500);
            }
        }
    }

    public function show(TipoConexion $tipo_conexion)
    {
        return response()->json([
            'message'=>'Tipo de conexion obtenido.',
            'datas'=>$tipo_conexion,
            'errors'=>null
        ],200);
    }

    public function update(TipoConexion $tipo_conexion, Request $request)
    {
        $validation=Validator::make($request->all(),[
            'name'=>'required|string|max:50|min:3|unique:tipo_conexions,name,'.$tipo_conexion->id,
        ]);


        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            $tipo_conexion->name=$request->name;
            $tipo_conexion->save();

            return response()->json([
                'message'=>'Tipo de conexion actualizado.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de actualizar el tipo de conexion.',
                'errors'=>null
            ],500);
        }
    }

    public function destroy(TipoConexion $tipo_conexion)
    {
        try {
            $tipo_conexion->delete();

            return response()->json([
                'message'=>'Tipo de conexion inhabilitada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de inhabilitar el tipo de conexion.',
                'errors'=>null
            ],500);
        }
    }

    public function restore($tipo_conexion)
    {
        try {
            TipoConexion::withTrashed()->where('id', $tipo_conexion)->restore();

            return response()->json([
                'message'=>'Tipo de conexion restablecido.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de restablecer el tipo de conexion.',
                'errors'=>null
            ],500);
        }
    }

    public function forceDestroy($tipo_conexion)
    {
        try {
            TipoConexion::withTrashed()->where('id',$tipo_conexion)->forceDelete();

            return response()->json([
                'message'=>'Tipo de conexion eliminada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de eliminar el tipo de conexion.',
                'errors'=>$th
            ],500);
        }
    }
}
