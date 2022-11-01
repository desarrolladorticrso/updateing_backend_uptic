<?php

namespace App\Exports;

use App\Models\InventarioMaquina;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class InventoryMachineExport implements FromView, ShouldAutoSize, WithStyles
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
            $datas=InventarioMaquina::with([
                'apn',
                'lider',
                'asesor',
                'tecnico',
                'linea_movil',
                'punto_oficina',
                'modelo_maquina',
                'version_maquina',
                'operador_simcard',
            ])
            ->filters($this->request->all())
            ->get();
        }

        if ($this->request->opcion=='no') {
            $datas=InventarioMaquina::with([
                'apn',
                'lider',
                'asesor',
                'tecnico',
                'linea_movil',
                'punto_oficina',
                'modelo_maquina',
                'version_maquina',
                'operador_simcard',
            ])
            ->get();
        }

        return view('Exports.inventario_de_maquinas',[
            'datas'=>$datas,
        ]);
    }
}
