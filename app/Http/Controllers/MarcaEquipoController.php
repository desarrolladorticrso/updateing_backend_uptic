<?php

namespace App\Http\Controllers;

use App\Models\MarcaEquipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MarcaEquipoController extends Controller
{
    public function index(Request $request)
    {
        $datas=MarcaEquipo::withTrashed()
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
        $datas=MarcaEquipo::orderBy('name')
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
            'name'=>'required|string|max:20|min:3|unique:marca_equipos,name',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion.',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            MarcaEquipo::create([
                'name'=>$request->name,
            ]);

            return response()->json([
                'message'=>'maraca equipo creada.',
                'errors'=>null
            ],201);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al intentar agregar la maraca equipo',
                'errors'=>null
            ],500);
        }
    }

    public function show(MarcaEquipo $marca_equipo)
    {
        return response()->json([
            'message'=>'maraca equipo obtenida.',
            'datas'=>$marca_equipo,
            'errors'=>null
        ],200);
    }

    public function update(MarcaEquipo $marca_equipo, Request $request)
    {
        $validation=Validator::make($request->all(),[
            'name'=>'required|string|max:20|min:3|unique:marca_equipos,name,'.$marca_equipo->id,
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            $marca_equipo->name=$request->name;
            $marca_equipo->save();

            return response()->json([
                'message'=>'Maraca equipo actualizada.',
                'errors'=>null
            ],202);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de actualizar la maraca equipo.',
                'error'=>null
            ],500);
        }
    }

    public function destroy(MarcaEquipo $marca_equipo)
    {
        try {
            $marca_equipo->delete();

            return response()->json([
                'message'=>'Maraca equipo inhabilitada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de inhabilitar la maraca equipo.',
                'errors'=>null
            ],500);
        }
    }
    public function restore($marca_equipo)
    {
        try {
            MarcaEquipo::withTrashed()->where('id',$marca_equipo)->restore();

            return response()->json([
                'message'=>'Maraca equipo restablecida.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al intentar de restablecer la maraca equipo.',
                'errors'=>null
            ],500);
        }
    }

    public function forceDestroy($marca_equipo)
    {
        try {
            MarcaEquipo::withTrashed()->where('id',$marca_equipo)->forceDelete();

            return response()->json([
                'message'=>'Maraca equipo eliminada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de eliminar la maraca equipo.',
                'errors'=>null
            ],500);
        }
    }
}
