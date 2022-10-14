<?php

namespace App\Http\Controllers;

use App\Models\OperadorSatelital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OperadorSatelitalController extends Controller
{
    public function index(Request $request)
    {
        $datas=OperadorSatelital::withTrashed()
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
        $datas=OperadorSatelital::orderBy('name')
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
            'name'=>'required|string|max:20|min:3|unique:operador_satelitals,name',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion.',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            OperadorSatelital::create([
                'name'=>$request->name,
            ]);

            return response()->json([
                'message'=>'Operador de sateltial creado.',
                'errors'=>null
            ],201);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al intentar agregar el operador de satelital.',
                'errors'=>null
            ],500);
        }
    }

    public function show(OperadorSatelital $operador_satelital)
    {
        return response()->json([
            'message'=>'Operador de satelital obtenido.',
            'datas'=>$operador_satelital,
            'errors'=>null
        ],200);
    }

    public function update(OperadorSatelital $operador_satelital, Request $request)
    {
        $validation=Validator::make($request->all(),[
            'name'=>'required|string|max:20|min:3|unique:operador_satelitals,name,'.$operador_satelital->id,
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            $operador_satelital->name=$request->name;
            $operador_satelital->save();

            return response()->json([
                'message'=>'Operador de satelital actualizado.',
                'errors'=>null
            ],202);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de actualizar el operador de satelital.',
                'error'=>null
            ],500);
        }
    }

    public function destroy(OperadorSatelital $operador_satelital)
    {
        try {
            $operador_satelital->delete();

            return response()->json([
                'message'=>'Operador de satelital inhabilitada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de inhabilitar el operador de satelital.',
                'errors'=>null
            ],500);
        }
    }
    public function restore($operador_satelital)
    {
        try {
            OperadorSatelital::withTrashed()->where('id',$operador_satelital)->restore();

            return response()->json([
                'message'=>'Operador de satelital restablecido.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al intentar de restablecer el operador de satelital.',
                'errors'=>null
            ],500);
        }
    }

    public function forceDestroy($operador_satelital)
    {
        try {
            OperadorSatelital::withTrashed()->where('id',$operador_satelital)->forceDelete();

            return response()->json([
                'message'=>'Operador de satelital eliminado.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de eliminar el operador de satelital.',
                'errors'=>null
            ],500);
        }
    }
}
