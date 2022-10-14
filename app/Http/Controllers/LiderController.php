<?php

namespace App\Http\Controllers;

use App\Models\Lider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LiderController extends Controller
{
    public function index(Request $request)
    {
        $datas=Lider::withTrashed()
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
        $datas=Lider::orderBy('name')
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
                $user=Lider::create([
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

    public function show(Lider $lider)
    {
        return $lider;

        return response()->json([
            'message'=>'Lider obtenido.',
            'datas'=>$lider,
            'errors'=>null
        ],200);
    }

    public function update(Lider $lider, Request $request)
    {
        $validation=Validator::make($request->all(),[
            'name'=>'required|string|max:50|min:3',
            'numero_documento'=>'required|string|max:13|min:8|unique:lideres,numero_documento,'.$lider->id,
        ]);


        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            $lider->name=$request->name;
            $lider->numero_documento=$request->documento;
            $lider->save();

            return response()->json([
                'message'=>'Lider actualizado.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de actualizar el lider.',
                'errors'=>null
            ],500);
        }
    }

    public function destroy(Lider $lider)
    {
        try {
            $lider->delete();

            return response()->json([
                'message'=>'Lider inhabilitado.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de inhabilitar el lider.',
                'errors'=>null
            ],500);
        }
    }

    public function restore($lider)
    {
        try {
            Lider::withTrashed()->where('id',$lider)->restore();

            return response()->json([
                'message'=>'Lider restablecido.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de restablecer el lider.',
                'errors'=>null
            ],500);
        }
    }

    public function forceDestroy($lider)
    {
        try {
            Lider::withTrashed()->where('id',$lider)->forceDelete();

            return response()->json([
                'message'=>'Lider eliminado.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de eliminar el lider.',
                'errors'=>$th
            ],500);
        }
    }

}
