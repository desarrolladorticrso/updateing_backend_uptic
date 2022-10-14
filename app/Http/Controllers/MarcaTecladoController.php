<?php

namespace App\Http\Controllers;

use App\Models\MarcaTeclado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MarcaTecladoController extends Controller
{
    public function index(Request $request)
    {
        $datas=MarcaTeclado::withTrashed()
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
        $datas=MarcaTeclado::orderBy('name')
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
            'name'=>'required|string|max:20|min:3|unique:marca_teclados,name',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion.',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            MarcaTeclado::create([
                'name'=>$request->name,
            ]);

            return response()->json([
                'message'=>'Marca de tacledo agregada.',
                'errors'=>null
            ],201);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al intentar agregar la marca del teclado.',
                'errors'=>null
            ],500);
        }
    }

    public function show(MarcaTeclado $marca_teclado)
    {
        return response()->json([
            'message'=>'Marca teclado obtenida.',
            'datas'=>$marca_teclado,
            'errors'=>null
        ],200);
    }

    public function update(MarcaTeclado $marca_teclado, Request $request)
    {
        $validation=Validator::make($request->all(),[
            'name'=>'required|string|max:20|min:3|unique:marca_teclados,name,'.$marca_teclado->id,
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            $marca_teclado->name=$request->name;
            $marca_teclado->save();

            return response()->json([
                'message'=>'Marca de taclado actualizada.',
                'errors'=>null
            ],202);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de actualizar la marca de teclado.',
                'error'=>null
            ],500);
        }
    }

    public function destroy(MarcaTeclado $marca_teclado)
    {
        try {
            $marca_teclado->delete();

            return response()->json([
                'message'=>'Marca de teclado inhabilitada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de inhabilitar la marca de teclado.',
                'errors'=>null
            ],500);
        }
    }
    public function restore($marca_teclado)
    {
        try {
            MarcaTeclado::withTrashed()->where('id',$marca_teclado)->restore();

            return response()->json([
                'message'=>'Marca de teclado restablecida.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al intentar de restablecer la maraca de teclado.',
                'errors'=>null
            ],500);
        }
    }

    public function forceDestroy($marca_teclado)
    {
        try {
            MarcaTeclado::withTrashed()->where('id',$marca_teclado)->forceDelete();

            return response()->json([
                'message'=>'Marca de teclado eliminada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de eliminar la maraca de teclado.',
                'errors'=>null
            ],500);
        }
    }
}
