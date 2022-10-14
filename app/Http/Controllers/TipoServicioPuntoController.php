<?php

namespace App\Http\Controllers;

use App\Models\TipoServicioPunto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TipoServicioPuntoController extends Controller
{
    public function index(Request $request)
    {
        $datas=TipoServicioPunto::withTrashed()
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
        $datas=TipoServicioPunto::orderBy('name')
            ->get();

        return response()->json([
            'message'=>"Datos obtenidos",
            'datas'=>$datas
        ],200);
    }

    public function store(Request $request)
    {
        $validate=Validator::make($request->all(),[
            'name'=>'required|string|max:50|min:3|unique:transportadoras,name',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'errors'=>$validate->errors()
            ],422);
        }

        if (!$validate->fails()) {
            try {
                $user=TipoServicioPunto::create([
                    'name'=>$request->name,
                ]);

                return response()->json([
                    'message'=>"Tipo de servicio puntos registrada exitosamente.",
                    'datas'=>$user
                ],201);

            } catch (\Throwable $th) {
                return response()->json([
                    'message'=>"Ha surgido un error al tratar de agregar tipo de servicio puntos.",
                    'datas'=>null
                ],500);
            }
        }
    }

    public function show(TipoServicioPunto $tipoServicioPunto)
    {
        return response()->json([
            'message'=>'Tipo de servicio puntos obtenido.',
            'datas'=>$tipoServicioPunto,
            'errors'=>null
        ],200);
    }

    public function update(TipoServicioPunto $tipoServicioPunto, Request $request)
    {
        $validation=Validator::make($request->all(),[
            'name'=>'required|string|max:50|min:3|unique:tipo_servicio_puntos,name,'.$tipoServicioPunto->id,
        ]);


        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            $tipoServicioPunto->name=$request->name;
            $tipoServicioPunto->save();

            return response()->json([
                'message'=>'Tipo servicio de puntos actualizado.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de actualizar el tipo de servicios de puntos.',
                'errors'=>null
            ],500);
        }
    }

    public function destroy(TipoServicioPunto $tipoServicioPunto)
    {
        try {
            $tipoServicioPunto->delete();

            return response()->json([
                'message'=>'Tipo de servicio de puntos inhabilitada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de inhabilitar el tipo de servicio de puntos.',
                'errors'=>null
            ],500);
        }
    }

    public function restore($tipoServicioPunto)
    {
        try {
            TipoServicioPunto::withTrashed()->where('id',$tipoServicioPunto)->restore();

            return response()->json([
                'message'=>'Tipo servicio puntos restablecido.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de restablecer el tipo de servicio de puntos.',
                'errors'=>null
            ],500);
        }
    }

    public function forceDestroy($tipoServicioPunto)
    {
        try {
            TipoServicioPunto::withTrashed()->where('id',$tipoServicioPunto)->forceDelete();

            return response()->json([
                'message'=>'Tipo servicio de puntos eliminada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de eliminar el tipo servicio de puntos.',
                'errors'=>$th
            ],500);
        }
    }
}
