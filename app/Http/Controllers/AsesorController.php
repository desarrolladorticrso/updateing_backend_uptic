<?php

namespace App\Http\Controllers;

use App\Models\Asesor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AsesorController extends Controller
{

    public function index(Request $request)
    {
        $datas=Asesor::withTrashed()
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
        $datas=Asesor::orderBy('name')
            ->get();

        return response()->json([
            'message'=>"Datos obtenidos",
            'datas'=>$datas
        ],200);
    }

    public function store(Request $request)
    {
        $validate=Validator::make($request->all(),[
            'name'=>'required|string|max:50|min:3',
            'documento'=>'required|string|max:13|min:8|unique:asesores,documento',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'errors'=>$validate->errors()
            ],422);
        }

        if (!$validate->fails()) {
            try {
                $user=Asesor::create([
                    'name'=>$request->name,
                    'documento'=>$request->documento,
                ]);

                return response()->json([
                    'message'=>"Asesor registrado exitosamente.",
                    'datas'=>$user
                ],201);

            } catch (\Throwable $th) {
                return response()->json([
                    'message'=>"Ha surgido un error al tratar de agregar el asesor.",
                    'datas'=>null
                ],500);
            }
        }
    }

    public function show(Asesor $asesor)
    {
        return response()->json([
            'message'=>'Asesor obtenido.',
            'datas'=>$asesor,
            'errors'=>null
        ],200);
    }

    public function update(Asesor $asesor, Request $request)
    {
        $validation=Validator::make($request->all(),[
            'name'=>'required|string|max:50|min:3',
            'documento'=>'required|string|max:13|min:8|unique:asesores,documento,'.$asesor->id,
        ]);


        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            $asesor->name=$request->name;
            $asesor->documento=$request->documento;
            $asesor->save();

            return response()->json([
                'message'=>'Asesor actualizado.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de actualizar el asesor.',
                'errors'=>null
            ],500);
        }
    }

    public function destroy(Asesor $asesor)
    {
        try {
            $asesor->delete();

            return response()->json([
                'message'=>'Asesor inhabilitado.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de inhabilitar el asesor.',
                'errors'=>null
            ],500);
        }
    }

    public function restore($asesor)
    {
        try {
            Asesor::withTrashed()->where('id',$asesor)->restore();

            return response()->json([
                'message'=>'Asesor restablecido.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de restablecer el asesor.',
                'errors'=>null
            ],500);
        }
    }

    public function forceDestroy($asesor)
    {
        try {
            Asesor::withTrashed()->where('id',$asesor)->forceDelete();

            return response()->json([
                'message'=>'Asesor eliminado.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de eliminar el asesor.',
                'errors'=>$th
            ],500);
        }
    }

}
