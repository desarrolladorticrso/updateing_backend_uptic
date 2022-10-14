<?php

namespace App\Exports;

use App\Models\LineaMovile;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LinesMovilesExport implements FromView, ShouldAutoSize,WithStyles,
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
            $datas=LineaMovile::with('operador_simcard', 'estado')->filters($this->request->all())->get();
        }

        if ($this->request->opcion=='no') {
            $datas=LineaMovile::with('operador_simcard', 'estado')->get();
        }

        return view('exports.lineas_moviles', [
            'datas' =>$datas,
        ]);
    }
}
