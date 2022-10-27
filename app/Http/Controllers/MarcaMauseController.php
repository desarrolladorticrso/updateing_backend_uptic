<?php

namespace App\Http\Controllers;

use App\Models\MarcaMause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MarcaMauseController extends Controller
{
    public function index(Request $request)
    {
        $datas=MarcaMause::withTrashed()
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
        $datas=MarcaMause::orderBy('name')
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
            'name'=>'required|string|max:20|min:3|unique:marca_mice,name',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion.',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            MarcaMause::create([
                'name'=>$request->name,
            ]);

            return response()->json([
                'message'=>'Maraca mouse creada.',
                'errors'=>null
            ],201);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al intentar agregar la maraca mouse',
                'errors'=>null
            ],500);
        }
    }

    public function show(MarcaMause $marca_mouse)
    {
        return response()->json([
            'message'=>'Maraca mouse obtenida.',
            'datas'=>$marca_mouse,
            'errors'=>null
        ],200);
    }

    public function update(MarcaMause $marca_mouse, Request $request)
    {
        $validation=Validator::make($request->all(),[
            'name'=>'required|string|max:20|min:3|unique:marca_mice,name,'.$marca_mouse->id,
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            $marca_mouse->name=$request->name;
            $marca_mouse->save();

            return response()->json([
                'message'=>'Maraca mouse actualizada.',
                'errors'=>null
            ],202);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de actualizar la maraca mouse.',
                'error'=>null
            ],500);
        }
    }

    public function destroy(MarcaMause $marca_mouse)
    {
        try {
            $marca_mouse->delete();

            return response()->json([
                'message'=>'Maraca mouse inhabilitada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de inhabilitar la maraca mouse.',
                'errors'=>null
            ],500);
        }
    }
    public function restore($marca_mouse)
    {
        try {
            MarcaMause::withTrashed()->where('id',$marca_mouse)->restore();

            return response()->json([
                'message'=>'Maraca mouse restablecida.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al intentar de restablecer la maraca mouse.',
                'errors'=>null
            ],500);
        }
    }

    public function forceDestroy($marca_mouse)
    {
        try {
            MarcaMause::withTrashed()->where('id',$marca_mouse)->forceDelete();

            return response()->json([
                'message'=>'Maraca mouse eliminada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de eliminar la maraca mouse.',
                'errors'=>null
            ],500);
        }
    }
}
