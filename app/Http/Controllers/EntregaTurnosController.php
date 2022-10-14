<?php

namespace App\Http\Controllers;

use App\Models\EntregaTurnos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;

class EntregaTurnosController extends Controller
{
    public function index(Request $request)
    {
        $datas=EntregaTurnos::withTrashed()
            ->with('tecnico_turno','tecnico_recibe')
            ->orderBy('id', 'DESC')
            ->filters($request->only('search'))
            ->paginate();

        return response()->json([
            'message'=>"Datos obtenidos",
            'datas'=>$datas
        ],200);
    }

    public function store(Request $request)
    {
        $validate= Validator::make($request->all(),[
            'tecnico_turno_id'=>'required|numeric|exists:users,id',
            'tecnico_recibe_id'=>'required|numeric|exists:users,id',
            'observacion'=>'required|string|max:3000|min:20',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'errors'=>$validate->errors()
            ],422);
        }

        if (!$validate->fails()) {
            try {
                $user=EntregaTurnos::create($request->all());

                return response()->json([
                    'message'=>"Entrega de turno registrada exitosamente.",
                    'datas'=>$user
                ],201);

            } catch (\Throwable $th) {
                return response()->json([
                    'message'=>"Ha surgido un error al tratar de agregar la entrega de turno.",
                    'datas'=>null
                ],500);
            }
        }
    }

    public function show($entrega_turno)
    {
        $datas=EntregaTurnos::with('tecnico_turno','tecnico_recibe')
            ->where('id',$entrega_turno)
            ->first();

        return response()->json([
            'message'=>'Entrega de turno obtenida.',
            'datas'=>$datas,
            'errors'=>null
        ],200);
    }

    public function update(EntregaTurnos $entrega_turno, Request $request)
    {
        $validation= Validator::make($request->all(),[
            'tecnico_turno_id'=>'required|numeric|exists:users,id',
            'tecnico_recibe_id'=>'required|numeric|exists:users,id',
            'observacion'=>'required|string|max:3000|min:20',
        ]);


        if ($validation->fails()) {
            return response()->json([
                'message'=>'Error de validacion',
                'errors'=>$validation->errors()
            ],422);
        }

        try {
            $entrega_turno->tecnico_turno_id=$request->tecnico_turno_id;
            $entrega_turno->tecnico_recibe_id=$request->tecnico_recibe_id;
            $entrega_turno->observacion=$request->observacion;
            $entrega_turno->save();

            return response()->json([
                'message'=>'Entrega de turno actualizada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de actualizar la entrega de turno.',
                'errors'=>null
            ],500);
        }
    }

    public function destroy(EntregaTurnos $entrega_turno)
    {
        try {
            $entrega_turno->delete();

            return response()->json([
                'message'=>'Entrega de turno inhabilitada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de inhabilitar la entrega de turno.',
                'errors'=>null
            ],500);
        }
    }

    public function restore($entrega_turno)
    {
        try {
            EntregaTurnos::withTrashed()->where('id',$entrega_turno)->restore();

            return response()->json([
                'message'=>'entrega de turno restablecida.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de restablecer la entrega de turnos.',
                'errors'=>null
            ],500);
        }
    }

    public function forceDestroy($entrega_turno)
    {
        try {
            EntregaTurnos::withTrashed()->where('id',$entrega_turno)->forceDelete();

            return response()->json([
                'message'=>'Entrega de turno eliminada.',
                'errors'=>null
            ],202);

        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al tratar de eliminar la entrega de turno.',
                'errors'=>$th
            ],500);
        }
    }
}
