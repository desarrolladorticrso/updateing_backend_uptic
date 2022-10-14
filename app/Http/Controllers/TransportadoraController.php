<?php

namespace App\Http\Controllers;

use App\Models\Transportadora;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransportadoraController extends Controller
{
    public function index(Request $request)
    {
        $datas=Transportadora::withTrashed()
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
        $datas=Transportadora::orderBy('name')
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
                $user=Transportadora::create([
                    'name'=>$request->name,
                ]);

                return response()->json([
                    'message'=>"Transportadora registrada exitosamente.",
                    'datas'=>$user
                ],201);

            } catch (\Throwable $th) {
                return response()->json([
                    'message'=>"Ha surgido un error al tratar de agregar la transportadora.",
                    'datas'=>null
                ],500);
            }
        }
    }

    public function show(Transportadora $transportadora)
    {
        return response()->json([
            'message'=>'Transportadora obtenido.',
            'datas'=>$transportadora,
            'errors'=>null
        ],200);
    }

    public function update(Transportadora $transportadora, Request $request)
    {
        $validation=Validator::make($request->all(),[
            'name'=>'required|string|max:50|min:3|unique:transportadoras,name,'.$transportadora->id,
        ]);


        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            $transportadora->name=$request->name;
            $transportadora->save();

            return response()->json([
                'message'=>'Transportadora actualizada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de actualizar la transportadora.',
                'errors'=>null
            ],500);
        }
    }

    public function destroy(Transportadora $transportadora)
    {
        try {
            $transportadora->delete();

            return response()->json([
                'message'=>'Transportadora inhabilitada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de inhabilitar la transportadora.',
                'errors'=>null
            ],500);
        }
    }

    public function restore($transportadora)
    {
        try {
            Transportadora::withTrashed()->where('id',$transportadora)->restore();

            return response()->json([
                'message'=>'Transportadora restablecida.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de restablecer la transportadora.',
                'errors'=>null
            ],500);
        }
    }

    public function forceDestroy($transportadora)
    {
        try {
            Transportadora::withTrashed()->where('id',$transportadora)->forceDelete();

            return response()->json([
                'message'=>'Transportadora eliminada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de eliminar la transportadora.',
                'errors'=>$th
            ],500);
        }
    }
}
