<?php

namespace App\Http\Controllers;

use App\Models\ReporteFallasAbministrativas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReporteFallasAbministrativasController extends Controller
{
    public function index(Request $request)
    {
        $datas=ReporteFallasAbministrativas::withTrashed()
            ->with('equipo','user')
            ->filters($request->only('search'))
            ->paginate();

        return response()->json([
            'message'=>'Datos obtenidos',
            'datas'=>$datas,
            'errors'=>null
        ],200);
    }

    public function store(Request $request)
    {
        $validation=Validator::make($request->all(),[
            'serial'=>'required|string|max:25|min:7',
            'user_id'=>'required|numeric|exists:users,id',
            'equipo_id'=>'required|numeric|exists:marca_equipos,id',
            'responsable'=>'required|string|max:200|min:10',
            'fallas_presentadas'=>'required',
            'fecha_mantenimiento'=>'required',
            'se_envio_a_provedor'=>'required',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion.',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            ReporteFallasAbministrativas::create([
                'serial'=>$request->serial,
                'user_id'=>$request->user_id,
                'equipo_id'=>$request->equipo_id,
                'responsable'=>$request->responsable,
                'fallas_presentadas'=>$request->fallas_presentadas,
                'fecha_mantenimiento'=>$request->fecha_mantenimiento,
                'se_envio_a_provedor'=>$request->se_envio_a_provedor,
            ]);

            return response()->json([
                'message'=>'Reporte de falla administrativa creada.',
                'errors'=>null
            ],201);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al intentar agregar el reporte de falla administrativa.',
                'errors'=>$th
            ],500);
        }
    }

    public function show(ReporteFallasAbministrativas $reporte_falla_administrativa)
    {
        return response()->json([
            'message'=>'Reporte de falla administrativa.',
            'datas'=>$reporte_falla_administrativa,
            'errors'=>null
        ],200);
    }

    public function update(ReporteFallasAbministrativas $reporte_falla_administrativa, Request $request)
    {
        $validation=Validator::make($request->all(),[
            'serial'=>'required|string|max:25|min:7',
            'user_id'=>'required|numeric|exists:users,id',
            'equipo_id'=>'required|numeric|exists:marca_equipos,id',
            'responsable'=>'required|string|max:200|min:10',
            'fallas_presentadas'=>'required',
            'fecha_mantenimiento'=>'required',
            'se_envio_a_provedor'=>'required',
        ]);

        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion.',
                'errors'=>$validation->errors()
            ],422);
        }

        try {

            $reporte_falla_administrativa->serial=$request->serial;
            $reporte_falla_administrativa->user_id=$request->user_id;
            $reporte_falla_administrativa->equipo_id=$request->equipo_id;
            $reporte_falla_administrativa->responsable=$request->responsable;
            $reporte_falla_administrativa->fallas_presentadas=$request->fallas_presentadas;
            $reporte_falla_administrativa->fecha_mantenimiento=$request->fecha_mantenimiento;
            $reporte_falla_administrativa->se_envio_a_provedor=$request->se_envio_a_provedor;
            $reporte_falla_administrativa->save();

            return response()->json([
                'message'=>'Reporte de fallas administrativas actualizada.',
                'errors'=>null
            ],202);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de actualizar el reporte de falla administrativas.',
                'error'=>$th
            ],500);
        }
    }

    public function destroy(ReporteFallasAbministrativas $reporte_falla_administrativa)
    {
        try {
            $reporte_falla_administrativa->delete();

            return response()->json([
                'message'=>'Reporte de fallos admistrativos inhabilitada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de inhabilitar el reporte de fallas administrativas.',
                'errors'=>null
            ],500);
        }
    }
    public function restore($reporte_falla_administrativa)
    {
        try {
            ReporteFallasAbministrativas::withTrashed()->where('id',$reporte_falla_administrativa)->restore();

            return response()->json([
                'message'=>'Reporte de falla administrativa restablecida.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al intentar de restablecer el reporte de falla administrativa.',
                'errors'=>null
            ],500);
        }
    }

    public function forceDestroy($reporte_falla_administrativa)
    {
        try {
            ReporteFallasAbministrativas::withTrashed()->where('id',$reporte_falla_administrativa)->forceDelete();

            return response()->json([
                'message'=>'Reporte de falla administrativa eliminada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de eliminar el reporte de falla administrativa.',
                'errors'=>null
            ],500);
        }
    }
}
