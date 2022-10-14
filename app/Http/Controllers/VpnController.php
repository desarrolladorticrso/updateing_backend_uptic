<?php

namespace App\Http\Controllers;

use App\Models\Vpn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VpnController extends Controller
{
    public function index(Request $request)
    {
        $datas=Vpn::withTrashed()
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
        $datas=Vpn::orderBy('name')
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
            'name'=>'required|string|max:20|min:3|unique:vpns,name',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            Vpn::create([
                'name'=>$request->name,
            ]);

            return response()->json([
                'message'=>'Vpn creada.',
                'errors'=>null
            ],201);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al intentar agregar el vpn.',
                'errors'=>$th
            ],500);
        }
    }

    public function show(Vpn $vpn)
    {
        return response()->json([
            'message'=>'Vpn obtenida',
            'datas'=>$vpn,
            'errors'=>null
        ],200);
    }

    public function update(Vpn $vpn, Request $request)
    {
        $validation=Validator::make($request->all(),[
            'name'=>'required|string|max:20|min:3|unique:vpns,name,'.$vpn->id,
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            $vpn->name=$request->name;
            $vpn->save();

            return response()->json([
                'message'=>'Vpn actualizada.',
                'errors'=>null
            ],202);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de actualizar la vpn.',
                'error'=>null
            ],500);
        }
    }

    public function destroy(Vpn $vpn)
    {
        try {
            $vpn->delete();

            return response()->json([
                'message'=>'Vpn inhabilitada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de inhabilitar la vpn.',
                'errors'=>null
            ],500);
        }
    }
    public function restore($vpn)
    {
        try {
            Vpn::withTrashed()->where('id',$vpn)->restore();

            return response()->json([
                'message'=>'vpn restablecida.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al intentar de restablecer la vpn.',
                'errors'=>null
            ],500);
        }
    }

    public function forceDestroy($vpn)
    {
        try {
            Vpn::withTrashed()->where('id',$vpn)->forceDelete();

            return response()->json([
                'message'=>'vpn eliminada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de eliminar la vpn.',
                'errors'=>null
            ],500);
        }
    }
}
