<?php

namespace App\Http\Controllers;

use App\Models\MarcaMonitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MarcaMonitorController extends Controller
{
    public function index(Request $request)
    {
        $datas=MarcaMonitor::withTrashed()
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
        $datas=MarcaMonitor::orderBy('name')
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
            'name'=>'required|string|max:20|min:3|unique:marca_monitors,name',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion.',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            MarcaMonitor::create([
                'name'=>$request->name,
            ]);

            return response()->json([
                'message'=>'Maraca monitor creada.',
                'errors'=>null
            ],201);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al intentar agregar la maraca monitor',
                'errors'=>null
            ],500);
        }
    }

    public function show(MarcaMonitor $marca_monitor)
    {
        return response()->json([
            'message'=>'Maraca monitor obtenida.',
            'datas'=>$marca_monitor,
            'errors'=>null
        ],200);
    }

    public function update(MarcaMonitor $marca_monitor, Request $request)
    {
        $validation=Validator::make($request->all(),[
            'name'=>'required|string|max:20|min:3|unique:marca_monitors,name,'.$marca_monitor->id,
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            $marca_monitor->name=$request->name;
            $marca_monitor->save();

            return response()->json([
                'message'=>'Maraca monitor actualizada.',
                'errors'=>null
            ],202);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de actualizar la maraca monitor.',
                'error'=>null
            ],500);
        }
    }

    public function destroy(MarcaMonitor $marca_monitor)
    {
        try {
            $marca_monitor->delete();

            return response()->json([
                'message'=>'Maraca monitor inhabilitada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de inhabilitar la maraca monitor.',
                'errors'=>null
            ],500);
        }
    }
    public function restore($marca_monitor)
    {
        try {
            MarcaMonitor::withTrashed()->where('id',$marca_monitor)->restore();

            return response()->json([
                'message'=>'Maraca monitor restablecida.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al intentar de restablecer la maraca monitor.',
                'errors'=>null
            ],500);
        }
    }

    public function forceDestroy($marca_monitor)
    {
        try {
            MarcaMonitor::withTrashed()->where('id',$marca_monitor)->forceDelete();

            return response()->json([
                'message'=>'Maraca monitor eliminada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de eliminar la maraca monitor.',
                'errors'=>null
            ],500);
        }
    }
}
