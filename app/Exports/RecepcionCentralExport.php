<?php

namespace App\Exports;

use App\Models\RecepcionCentral;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
class RecepcionCentralExport implements FromView, ShouldAutoSize, WithStyles
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
            $datas=RecepcionCentral::with([
                'proceso',
                'transportadora',
            ])->filters($this->request->all())->get();
        }

        if ($this->request->opcion=='no') {
            $datas=RecepcionCentral::with([
                'proceso',
                'transportadora',
            ])->get();
        }

        return view('Exports.inventario_recepcion_central',[
            'datas'=>$datas
        ]);
    }
}
