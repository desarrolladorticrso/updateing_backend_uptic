<?php

namespace App\Http\Controllers;

use App\Models\Poblacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PoblacionController extends Controller
{
    public function index(Request $request)
    {
        $datas=Poblacion::withTrashed()
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
        $datas=Poblacion::orderBy('name')
            ->get();

        return response()->json([
            'message'=>"Datos obtenidos",
            'datas'=>$datas
        ],200);
    }

    public function store(Request $request)
    {
        $validate=Validator::make($request->all(),[
            'name'=>'required|string|max:50|min:3|unique:poblacions,name',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'errors'=>$validate->errors()
            ],422);
        }

        if (!$validate->fails()) {
            try {
                $user=Poblacion::create([
                    'name'=>$request->name,
                ]);

                return response()->json([
                    'message'=>"Poblacion registrada exitosamente.",
                    'datas'=>$user
                ],201);

            } catch (\Throwable $th) {
                return response()->json([
                    'message'=>"Ha surgido un error al tratar de agregar la poblacion.",
                    'datas'=>null
                ],500);
            }
        }
    }

    public function show(Poblacion $poblacion)
    {
        return response()->json([
            'message'=>'Poblacion obtenido.',
            'datas'=>$poblacion,
            'errors'=>null
        ],200);
    }

    public function update(Poblacion $poblacion, Request $request)
    {
        $validation=Validator::make($request->all(),[
            'name'=>'required|string|max:50|min:3|unique:poblacions,name,'.$poblacion->id,
        ]);


        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            $poblacion->name=$request->name;
            $poblacion->save();

            return response()->json([
                'message'=>'Poblacion actualizada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de actualizar la poblacion.',
                'errors'=>null
            ],500);
        }
    }

    public function destroy(Poblacion $poblacion)
    {
        try {
            $poblacion->delete();

            return response()->json([
                'message'=>'Poblacion inhabilitada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de inhabilitar la poblacion.',
                'errors'=>null
            ],500);
        }
    }

    public function restore($poblacion)
    {
        try {
            Poblacion::withTrashed()->where('id', $poblacion)->restore();

            return response()->json([
                'message'=>'Poblacion restablecida.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de restablecer la poblacion.',
                'errors'=>null
            ],500);
        }
    }

    public function forceDestroy($poblacion)
    {
        try {
            Poblacion::withTrashed()->where('id',$poblacion)->forceDelete();

            return response()->json([
                'message'=>'Poblacion eliminada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de eliminar el permiso.',
                'errors'=>$th
            ],500);
        }
    }
}
