<?php

namespace App\Exports;

use App\Models\InventarioEquipos;
use App\Models\InventarioMaquina;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class InventarioEquiposExport implements FromView, ShouldAutoSize, WithStyles
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

        if ($this->request->opcion=='si') {
            $datas=InventarioEquipos::with([
                'asesor',
                'lider',
                'tecnico',
                'disco_duro',
                'memoria_ram',
                'marca_equipo',
                'punto_oficina',
                'marca_teclado',
                'tipo_conexion',
                'marca_monitor',
                'tipo_conexion',
                'tipo_servicio',
                'tipo_servicio',
                'estado_teclado',
                'estado_monitor',
                'marca_impresora',
                'estado_impresora',
                'tipo_equipo_trabajo',
                'estado_equipo_trabajo',
                'tipo_sistema_operativo',
            ])
            ->filters($this->request->all())
            ->get();
        }

        if ($this->request->opcion=='no') {
            $datas=InventarioEquipos::with([
                'asesor',
                'lider',
                'tecnico',
                'disco_duro',
                'memoria_ram',
                'marca_equipo',
                'punto_oficina',
                'marca_teclado',
                'marca_monitor',
                'tipo_conexion',
                'tipo_conexion',
                'tipo_servicio',
                'tipo_servicio',
                'estado_teclado',
                'estado_monitor',
                'marca_impresora',
                'estado_impresora',
                'tipo_equipo_trabajo',
                'estado_equipo_trabajo',
                'tipo_sistema_operativo',
            ])
            ->get();
        }
        return view('Exports.inventario_de_equipos',[
            'datas'=>$datas,
        ]);
    }
}




