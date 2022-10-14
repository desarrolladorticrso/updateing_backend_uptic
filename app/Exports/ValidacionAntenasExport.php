<?php

namespace App\Exports;

use App\Models\ValidacionAntena;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
class ValidacionAntenasExport implements FromView, ShouldAutoSize, WithStyles
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
            $datas=ValidacionAntena::with([
                'tecnico',
                'poblacion',
                'operador_satelital',
            ])->filters($this->request->all())->get();
        }

        if ($this->request->opcion=='no') {
            $datas=ValidacionAntena::with([
                'tecnico',
                'poblacion',
                'operador_satelital',
            ])->get();
        }

        return view('Exports.inventario_validacion_de_antenas',[
            'datas'=>$datas
        ]);
    }
}

