<?php

namespace App\Http\Controllers;

use App\Models\MarcaDvr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MarcaDvrController extends Controller
{
    public function index(Request $request)
    {
        $datas=MarcaDvr::withTrashed()
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
        $datas=MarcaDvr::orderBy('name')
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
            'name'=>'required|string|max:20|min:3|unique:marcas_dvrs,name',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion.',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            MarcaDvr::create([
                'name'=>$request->name,
            ]);

            return response()->json([
                'message'=>'Maraca dvr creada.',
                'errors'=>null
            ],201);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al intentar agregar la maraca dvr',
                'errors'=>null
            ],500);
        }
    }

    public function show(MarcaDvr $marca_dvr)
    {
        return response()->json([
            'message'=>'Maraca dvr obtenida.',
            'datas'=>$marca_dvr,
            'errors'=>null
        ],200);
    }

    public function update(MarcaDvr $marca_dvr, Request $request)
    {
        $validation=Validator::make($request->all(),[
            'name'=>'required|string|max:20|min:3|unique:marcas_dvrs,name,'.$marca_dvr->id,
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            $marca_dvr->name=$request->name;
            $marca_dvr->save();

            return response()->json([
                'message'=>'Maraca dvr actualizada.',
                'errors'=>null
            ],202);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de actualizar la maraca dvr.',
                'error'=>null
            ],500);
        }
    }

    public function destroy(MarcaDvr $marca_dvr)
    {
        try {
            $marca_dvr->delete();

            return response()->json([
                'message'=>'Maraca dvr inhabilitada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de inhabilitar la maraca dvr.',
                'errors'=>null
            ],500);
        }
    }
    public function restore($marca_dvr)
    {
        try {
            MarcaDvr::withTrashed()->where('id',$marca_dvr)->restore();

            return response()->json([
                'message'=>'Maraca dvr restablecida.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al intentar de restablecer la maraca dvr.',
                'errors'=>null
            ],500);
        }
    }

    public function forceDestroy($marca_dvr)
    {
        try {
            MarcaDvr::withTrashed()->where('id',$marca_dvr)->forceDelete();

            return response()->json([
                'message'=>'Maraca dvr eliminada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de eliminar la maraca dvr.',
                'errors'=>null
            ],500);
        }
    }
}
