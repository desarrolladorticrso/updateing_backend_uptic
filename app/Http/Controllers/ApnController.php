<?php

namespace App\Http\Controllers;

use App\Models\Apn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApnController extends Controller
{
    public function index(Request $request)
    {
        $datas=Apn::withTrashed()
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
        $datas=Apn::orderBy('name')
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
            'name'=>'required|string|max:20|min:3|unique:apns,name',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            Apn::create([
                'name'=>$request->name,
            ]);

            return response()->json([
                'message'=>'Apn creada.',
                'errors'=>null
            ],201);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al intentar agregar el apn.',
                'errors'=>null
            ],500);
        }
    }

    public function show(Apn $apn)
    {
        return response()->json([
            'message'=>'apn obtenida',
            'datas'=>$apn,
            'errors'=>null
        ],200);
    }

    public function update(Apn $apn, Request $request)
    {
        $validation=Validator::make($request->all(),[
            'name'=>'required|string|max:20|min:3|unique:apns,name,'.$apn->id,
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            $apn->name=$request->name;
            $apn->save();

            return response()->json([
                'message'=>'Apn actualizada.',
                'errors'=>null
            ],202);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de actualizar la apn.',
                'error'=>null
            ],500);
        }
    }

    public function destroy(Apn $apn)
    {
        try {
            $apn->delete();

            return response()->json([
                'message'=>'Apn inhabilitada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de inhabilitar la apn.',
                'errors'=>null
            ],500);
        }
    }
    public function restore($apn)
    {
        try {
            Apn::withTrashed()->where('id',$apn)->restore();

            return response()->json([
                'message'=>'Apn restablecida.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al intentar de restablecer la apn.',
                'errors'=>null
            ],500);
        }
    }

    public function forceDestroy($apn)
    {
        try {
            Apn::withTrashed()->where('id',$apn)->forceDelete();

            return response()->json([
                'message'=>'Apn eliminada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de eliminar la apn.',
                'errors'=>null
            ],500);
        }
    }
}
