<?php

namespace App\Http\Controllers;

use App\Models\TipoLineaGprs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TipoLineaGprsController extends Controller
{
    public function index(Request $request)
    {
        $datas=TipoLineaGprs::withTrashed()
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
        $datas=TipoLineaGprs::orderBy('name')
            ->get();

        return response()->json([
            'message'=>"Datos obtenidos",
            'datas'=>$datas
        ],200);
    }

    public function store(Request $request)
    {
        $validate=Validator::make($request->all(),[
            'name'=>'required|string|max:50|min:3|unique:tipo_linea_gprs,name',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'errors'=>$validate->errors()
            ],422);
        }

        if (!$validate->fails()) {
            try {
                $user=TipoLineaGprs::create([
                    'name'=>$request->name,
                ]);

                return response()->json([
                    'message'=>"Tipo de linea gprs registrada exitosamente.",
                    'datas'=>$user
                ],201);

            } catch (\Throwable $th) {
                return response()->json([
                    'message'=>"Ha surgido un error al tratar de agregar tipo de linea gprs.",
                    'datas'=>null
                ],500);
            }
        }
    }

    public function show(TipoLineaGprs $tipo_linea_gprs)
    {
        return response()->json([
            'message'=>'Tipo de linea gprs obtenido.',
            'datas'=>$tipo_linea_gprs,
            'errors'=>null
        ],200);
    }

    public function update(TipoLineaGprs $tipo_linea_gprs, Request $request)
    {
        $validation=Validator::make($request->all(),[
            'name'=>'required|string|max:50|min:3|unique:tipo_linea_gprs,name,'.$tipo_linea_gprs->id,
        ]);


        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            $tipo_linea_gprs->name=$request->name;
            $tipo_linea_gprs->save();

            return response()->json([
                'message'=>'Tipo linea gprs actualizado.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de actualizar el tipo de linea gprs.',
                'errors'=>null
            ],500);
        }
    }

    public function destroy(TipoLineaGprs $tipo_linea_gprs)
    {
        try {
            $tipo_linea_gprs->delete();

            return response()->json([
                'message'=>'Tipo de linea gprs inhabilitada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de inhabilitar el tipo de linea gprs.',
                'errors'=>null
            ],500);
        }
    }

    public function restore($tipo_linea_gprs)
    {
        try {
            TipoLineaGprs::withTrashed()->where('id', $tipo_linea_gprs)->restore();

            return response()->json([
                'message'=>'Tipo linea gprs restablecido.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de restablecer el tipo de linea gprs.',
                'errors'=>null
            ],500);
        }
    }

    public function forceDestroy($tipo_linea_gprs)
    {
        try {
            TipoLineaGprs::withTrashed()->where('id',$tipo_linea_gprs)->forceDelete();

            return response()->json([
                'message'=>'Tipo linea gprs eliminada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de eliminar el tipo de linea gprs.',
                'errors'=>$th
            ],500);
        }
    }
}
