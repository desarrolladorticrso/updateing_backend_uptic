<?php

namespace App\Exports;

use App\Models\InventarioCamara;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class InventarioCamarasExport implements FromView, ShouldAutoSize, WithStyles
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
            $datas=InventarioCamara::with([
                'centro_costo',
                'punto_oficina',
                'marca_dvr',
                'tecnico',
                'estado',
            ])->filters($this->request->all())->get();
        }
        if ($this->request->opcion=='no') {
            $datas=InventarioCamara::with([
                'centro_costo',
                'punto_oficina',
                'marca_dvr',
                'tecnico',
                'estado',
            ])->get();
        }
        return view('Exports.inventario_de_camaras',[
            'datas'=>$datas
        ]);
    }
}
