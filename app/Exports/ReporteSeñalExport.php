<?php

namespace App\Exports;

use App\Models\ReporteSeñal;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
class ReporteSeñalExport implements FromView, ShouldAutoSize, WithStyles
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
            $datas=ReporteSeñal::with([
                'tecnico',
                'poblacion',
                'operador_tecnologico',
            ])->filters($this->request->all())->get();
        }

        if ($this->request->opcion=='no') {
            $datas=ReporteSeñal::with([
                'tecnico',
                'poblacion',
                'operador_tecnologico',
            ])->get();
        }

        return view('Exports.inventario_reporte_de_señal',[
            'datas'=>$datas
        ]);
    }
}
