<?php

namespace App\Http\Controllers;

use App\Models\MarcaImpresora;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MarcaImpresoraController extends Controller
{
    public function index(Request $request)
    {
        $datas=MarcaImpresora::withTrashed()
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
        $datas=MarcaImpresora::orderBy('name')
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
            'name'=>'required|string|max:20|min:3|unique:marca_impresoras,name',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion.',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            MarcaImpresora::create([
                'name'=>$request->name,
            ]);

            return response()->json([
                'message'=>'maraca impresora creada.',
                'errors'=>null
            ],201);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al intentar agregar la maraca impresora',
                'errors'=>null
            ],500);
        }
    }

    public function show(MarcaImpresora $marca_impresora)
    {
        return response()->json([
            'message'=>'maraca impresora obtenida.',
            'datas'=>$marca_impresora,
            'errors'=>null
        ],200);
    }

    public function update(MarcaImpresora $marca_impresora, Request $request)
    {
        $validation=Validator::make($request->all(),[
            'name'=>'required|string|max:20|min:3|unique:marca_impresoras,name,'.$marca_impresora->id,
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            $marca_impresora->name=$request->name;
            $marca_impresora->save();

            return response()->json([
                'message'=>'Maraca impresora actualizada.',
                'errors'=>null
            ],202);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de actualizar la maraca impresora.',
                'error'=>null
            ],500);
        }
    }

    public function destroy(MarcaImpresora $marca_impresora)
    {
        try {
            $marca_impresora->delete();

            return response()->json([
                'message'=>'Maraca impresora inhabilitada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de inhabilitar la maraca impresora.',
                'errors'=>null
            ],500);
        }
    }
    public function restore($marca_impresora)
    {
        try {
            MarcaImpresora::withTrashed()->where('id',$marca_impresora)->restore();

            return response()->json([
                'message'=>'Maraca impresora restablecida.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al intentar de restablecer la maraca impresora.',
                'errors'=>null
            ],500);
        }
    }

    public function forceDestroy($marca_impresora)
    {
        try {
            MarcaImpresora::withTrashed()->where('id',$marca_impresora)->forceDelete();

            return response()->json([
                'message'=>'Maraca impresora eliminada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de eliminar la maraca impresora.',
                'errors'=>null
            ],500);
        }
    }
}
