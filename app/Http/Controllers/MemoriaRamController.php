<?php

namespace App\Http\Controllers;

use App\Models\MemoriaRam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MemoriaRamController extends Controller
{
    public function index(Request $request)
    {
        $datas=MemoriaRam::withTrashed()
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
        $datas=MemoriaRam::orderBy('name')
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
            'name'=>'required|string|max:20|min:3|unique:memoria_r_a_m_s,name',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion.',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            MemoriaRam::create([
                'name'=>$request->name,
            ]);

            return response()->json([
                'message'=>'Memoria ram creada.',
                'errors'=>null
            ],201);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al intentar agregar la memoria ram',
                'errors'=>null
            ],500);
        }
    }

    public function show(MemoriaRam $memoria_ram)
    {
        return response()->json([
            'message'=>'Memoria ram obtenida.',
            'datas'=>$memoria_ram,
            'errors'=>null
        ],200);
    }

    public function update(MemoriaRam $memoria_ram, Request $request)
    {
        $validation=Validator::make($request->all(),[
            'name'=>'required|string|max:20|min:3|unique:memoria_r_a_m_s,name,'.$memoria_ram->id,
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            $memoria_ram->name=$request->name;
            $memoria_ram->save();

            return response()->json([
                'message'=>'Memoria ram actualizada.',
                'errors'=>null
            ],202);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de actualizar la memoria ram.',
                'error'=>null
            ],500);
        }
    }

    public function destroy(MemoriaRam $memoria_ram)
    {
        try {
            $memoria_ram->delete();

            return response()->json([
                'message'=>'Memoria ram inhabilitada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de inhabilitar la memoria ram.',
                'errors'=>null
            ],500);
        }
    }
    public function restore($memoria_ram)
    {
        try {
            MemoriaRam::withTrashed()->where('id',$memoria_ram)->restore();

            return response()->json([
                'message'=>'Memoria ram restablecida.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al intentar de restablecer la memoria ram.',
                'errors'=>null
            ],500);
        }
    }

    public function forceDestroy($memoria_ram)
    {
        try {
            MemoriaRam::withTrashed()->where('id',$memoria_ram)->forceDelete();

            return response()->json([
                'message'=>'Memoria ram eliminada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de eliminar la memoria ram.',
                'errors'=>null
            ],500);
        }
    }
}
