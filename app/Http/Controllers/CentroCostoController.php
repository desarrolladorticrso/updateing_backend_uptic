<?php

namespace App\Http\Controllers;

use App\Models\CentroCosto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CentroCostoController extends Controller
{
    public function index(Request $request)
    {
        $datas=CentroCosto::withTrashed()
            ->orderBy('id','DESC')
            ->filters($request->only('search'))
            ->paginate();

        return response()->json([
            'message'=>"Datos obtenidos",
            'datas'=>$datas
        ],200);
    }

    public function all()
    {
        $datas=CentroCosto::orderBy('name')
            ->get();

        return response()->json([
            'message'=>"Datos obtenidos",
            'datas'=>$datas
        ],200);
    }

    public function store(Request $request)
    {
        $validate=Validator::make($request->all(),[
            'name'=>'required|string|max:50|min:3|unique:centros_costos,name',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'errors'=>$validate->errors()
            ],422);
        }

        if (!$validate->fails()) {
            try {
                $user=CentroCosto::create([
                    'name'=>$request->name,
                ]);

                return response()->json([
                    'message'=>"Centro de costo registrado exitosamente.",
                    'datas'=>$user
                ],201);

            } catch (\Throwable $th) {
                return response()->json([
                    'message'=>"Ha surgido un error al tratar de agregar el centro de costo.",
                    'datas'=>$th
                ],500);
            }
        }
    }

    public function show(CentroCosto $centro_costo)
    {
        return response()->json([
            'message'=>'Centro de costo obtenido.',
            'datas'=>$centro_costo,
            'errors'=>null
        ],200);
    }

    public function update(CentroCosto $centro_costo, Request $request)
    {
        $validation=Validator::make($request->all(),[
            'name'=>'required|string|max:50|min:3|unique:centros_costos,name,'.$centro_costo->id,
        ]);


        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            $centro_costo->name=$request->name;
            $centro_costo->save();

            return response()->json([
                'message'=>'Centro de costo actualizado.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de actualizar el centro de costo.',
                'errors'=>null
            ],500);
        }
    }

    public function destroy(CentroCosto $centro_costo)
    {
        try {
            $centro_costo->delete();

            return response()->json([
                'message'=>'Centro de costo inhabilitado.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de inhabilitar el centro de costo.',
                'errors'=>null
            ],500);
        }
    }

    public function restore($centro_costo)
    {
        try {
            CentroCosto::withTrashed()->where('id',$centro_costo)->restore();

            return response()->json([
                'message'=>'Centro de costo restablecido.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de restablecer el centro de costo.',
                'errors'=>null
            ],500);
        }
    }

    public function forceDestroy($centro_costo)
    {
        try {
            CentroCosto::withTrashed()->where('id',$centro_costo)->forceDelete();

            return response()->json([
                'message'=>'Centro de costo eliminado.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de eliminar el centro de costo.',
                'errors'=>$th
            ],500);
        }
    }
}
