<?php

namespace App\Http\Controllers;

use App\Models\DiscosDuro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DiscosDuroController extends Controller
{
    public function index(Request $request)
    {
        $datas=DiscosDuro::withTrashed()
            ->orderBy('id','DESC')
            ->filters($request->only('search'))
            ->paginate();

        return response()->json([
            'message'=>"Datos obtenidos",
            'datas'=>$datas
        ],200);
    }

    public function store(Request $request)
    {
        $validate=Validator::make($request->all(),[
            'name'=>'required|string|max:50|min:3|unique:disco_duros,name',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'errors'=>$validate->errors()
            ],422);
        }

        if (!$validate->fails()) {
            try {
                $user=DiscosDuro::create([
                    'name'=>$request->name,
                ]);

                return response()->json([
                    'message'=>"Disco duro registrado exitosamente.",
                    'datas'=>$user
                ],201);

            } catch (\Throwable $th) {
                return response()->json([
                    'message'=>"Ha surgido un error al tratar de agregar el disco duro.",
                    'datas'=>null
                ],500);
            }
        }
    }

    public function show(DiscosDuro $disco_duro)
    {
        return response()->json([
            'message'=>'Disco duro obtenido.',
            'datas'=>$disco_duro,
            'errors'=>null
        ],200);
    }

    public function update(DiscosDuro $disco_duro, Request $request)
    {
        $validation=Validator::make($request->all(),[
            'name'=>'required|string|max:50|min:3|unique:disco_duros,name,'.$disco_duro->id,
        ]);


        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            $disco_duro->name=$request->name;
            $disco_duro->save();

            return response()->json([
                'message'=>'Disco duro actualizado.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de actualizar el disco duro.',
                'errors'=>null
            ],500);
        }
    }

    public function destroy(DiscosDuro $disco_duro)
    {
        try {
            $disco_duro->delete();

            return response()->json([
                'message'=>'Disco duro inhabilitado.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de inhabilitar el disco duro.',
                'errors'=>null
            ],500);
        }
    }

    public function restore($disco_duro)
    {
        try {
            DiscosDuro::withTrashed()->where('id',$disco_duro)->restore();

            return response()->json([
                'message'=>'Disco duro restablecido.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de restablecer el disco duro.',
                'errors'=>null
            ],500);
        }
    }

    public function forceDestroy($disco_duro)
    {
        try {
            DiscosDuro::withTrashed()->where('id',$disco_duro)->forceDelete();

            return response()->json([
                'message'=>'Disco duro eliminado.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de eliminar el disco duro.',
                'errors'=>$th
            ],500);
        }
    }
}
