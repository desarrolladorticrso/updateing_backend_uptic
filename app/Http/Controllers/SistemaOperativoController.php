<?php

namespace App\Http\Controllers;

use App\Models\SistemaOperativo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SistemaOperativoController extends Controller
{
    public function index(Request $request)
    {
        $datas=SistemaOperativo::withTrashed()
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
        $datas=SistemaOperativo::orderBy('name')
            ->get();

        return response()->json([
            'message'=>"Datos obtenidos",
            'datas'=>$datas
        ],200);
    }

    public function store(Request $request)
    {
        $validate=Validator::make($request->all(),[
            'name'=>'required|string|max:50|min:3|unique:sistema_operativos,name',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'errors'=>$validate->errors()
            ],422);
        }

        if (!$validate->fails()) {
            try {
                $sistema_operativo=SistemaOperativo::create([
                    'name'=>$request->name,
                ]);

                return response()->json([
                    'message'=>"Sistema operativo registrado exitosamente.",
                    'datas'=>$sistema_operativo
                ],201);

            } catch (\Throwable $th) {
                return response()->json([
                    'message'=>"Ha surgido un error al tratar de agregar sistema operativo.",
                    'datas'=>null
                ],500);
            }
        }
    }

    public function show(SistemaOperativo $sistema_operativo)
    {
        return response()->json([
            'message'=>'sistema operativo obtenido.',
            'datas'=>$sistema_operativo,
            'errors'=>null
        ],200);
    }

    public function update(SistemaOperativo $sistema_operativo, Request $request)
    {
        $validation=Validator::make($request->all(),[
            'name'=>'required|string|max:50|min:3|unique:sistema_operativos,name,'.$sistema_operativo->id,
        ]);


        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            $sistema_operativo->name=$request->name;
            $sistema_operativo->save();

            return response()->json([
                'message'=>'Sistema operativo actualizado.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de actualizar el sistema operativo.',
                'errors'=>null
            ],500);
        }
    }

    public function destroy(SistemaOperativo $sistema_operativo)
    {
        try {
            $sistema_operativo->delete();

            return response()->json([
                'message'=>'Sistema operativo inhabilitada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de inhabilitar el sistema operativo.',
                'errors'=>null
            ],500);
        }
    }

    public function restore($sistema_operativo)
    {
        try {
            SistemaOperativo::withTrashed()->where('id', $sistema_operativo)->restore();

            return response()->json([
                'message'=>'Sistema operativo restablecido.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de restablecer el sistema operativo.',
                'errors'=>null
            ],500);
        }
    }

    public function forceDestroy($sistema_operativo)
    {
        try {
            SistemaOperativo::withTrashed()->where('id',$sistema_operativo)->forceDelete();

            return response()->json([
                'message'=>'Sistema operativo eliminada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de eliminar el sistema operativo.',
                'errors'=>$th
            ],500);
        }
    }
}
