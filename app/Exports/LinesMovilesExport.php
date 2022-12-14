<?php

namespace App\Exports;

use App\Models\LineaMovile;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LinesMovilesExport implements FromView, ShouldAutoSize,WithStyles
{
    private $request;

    public function __construct($request)
    {
        $this->request=$request;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }

    public function view(): View
    {
        $datas=[];

            $datas=DB::table('lineas_moviles')
                ->leftJoin('inventario_maquinas','lineas_moviles.id','=','inventario_maquinas.nro_linea_id')
                ->leftJoin('asesores', 'asesores.id','=','inventario_maquinas.asesor_id')
                ->leftJoin('puntos_oficinas','inventario_maquinas.punto_oficina_id','=','puntos_oficinas.id')
                ->leftJoin('operador_simcards','lineas_moviles.operador_id','=','operador_simcards.id')
                ->leftJoin('estados','lineas_moviles.estado_linea_id','=','estados.id')
                ->select([
                    'lineas_moviles.linea as linea',
                    'lineas_moviles.serial as serial',
                    'inventario_maquinas.activo_fijo',
                    'inventario_maquinas.serial_maquina',
                    'puntos_oficinas.name as punto_oficina',
                    'operador_simcards.name as operador_simcard',
                    'asesores.name as asesor',
                    'asesores.documento as documento_asesor',
                    'estados.name as estado_linea'
                ])
                ->where(function ($query) {
                    if ($this->request->opcion=='si') {
                        $query->when($this->request['operador_id'] ?? null, function($query){
                            $query->where('lineas_moviles.operador_id',$this->request['operador_id']);
                        })->when($this->request['estado_linea_id'] ?? null, function($query){
                            $query->where('lineas_moviles.estado_linea_id',$this->request['estado_linea_id']);
                        });
                    }
                })
                ->orderBy('lineas_moviles.linea')
                ->get();

        return view('exports.lineas_moviles', [
            'datas' =>$datas,
        ]);
    }
}
