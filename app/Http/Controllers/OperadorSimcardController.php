<?php

namespace App\Http\Controllers;

use App\Models\OperadorSimcard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OperadorSimcardController extends Controller
{
    public function index(Request $request)
    {
        $datas=OperadorSimcard::withTrashed()
        ->orderBy('id','DESC')
            ->filters($request->only('search'))
            ->paginate();

        return response()->json([
            'message'=>'Datos obtenidos',
            'datas'=>$datas,
            'errors'=>null
        ],200);
    }

    public function all()
    {
        $datas=OperadorSimcard::orderBy('name')
            ->get();

        return response()->json([
            'message'=>'Datos obtenidos',
            'datas'=>$datas,
            'errors'=>null
        ],200);
    }

    public function store(Request $request)
    {
        $validation=Validator::make($request->all(),[
            'name'=>'required|string|max:20|min:3|unique:operador_simcards,name',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion.',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            OperadorSimcard::create([
                'name'=>$request->name,
            ]);

            return response()->json([
                'message'=>'Operador de simcard creado.',
                'errors'=>null
            ],201);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al intentar agregar el operador de simcard.',
                'errors'=>null
            ],500);
        }
    }

    public function show(OperadorSimcard $operador_simcard)
    {
        return response()->json([
            'message'=>'Operador de simcard obtenido.',
            'datas'=>$operador_simcard,
            'errors'=>null
        ],200);
    }

    public function update(OperadorSimcard $operador_simcard, Request $request)
    {
        $validation=Validator::make($request->all(),[
            'name'=>'required|string|max:20|min:3|unique:operador_simcards,name,'.$operador_simcard->id,
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            $operador_simcard->name=$request->name;
            $operador_simcard->save();

            return response()->json([
                'message'=>'Operador de simcard actualizado.',
                'errors'=>null
            ],202);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de actualizar el operador de simcard.',
                'error'=>null
            ],500);
        }
    }

    public function destroy(OperadorSimcard $operador_simcard)
    {
        try {
            $operador_simcard->delete();

            return response()->json([
                'message'=>'Operador de simcard inhabilitada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de inhabilitar el operador de simcard.',
                'errors'=>null
            ],500);
        }
    }
    public function restore($operador_simcard)
    {
        try {
            OperadorSimcard::withTrashed()->where('id',$operador_simcard)->restore();

            return response()->json([
                'message'=>'Operador de simcard restablecido.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al intentar de restablecer el operador de simcard.',
                'errors'=>null
            ],500);
        }
    }

    public function forceDestroy($operador_simcard)
    {
        try {
            OperadorSimcard::withTrashed()->where('id',$operador_simcard)->forceDelete();

            return response()->json([
                'message'=>'Operador de simcard eliminado.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de eliminar el operador de simcard.',
                'errors'=>null
            ],500);
        }
    }
}
