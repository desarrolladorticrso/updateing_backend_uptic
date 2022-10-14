<?php

namespace App\Exports;

use App\Models\ActualizacionPosslim;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ActualizacionPosslimExport implements FromView,ShouldAutoSize, WithStyles
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
            $datas=ActualizacionPosslim::with([
                'tecnico',
                'punto_oficina',
                'version_posslim',
                'version_sims',
            ])->filters($this->request->all())->get();
        }

        if ($this->request->opcion=='no') {
            $datas=ActualizacionPosslim::with([
                'tecnico',
                'punto_oficina',
                'version_posslim',
                'version_sims',
            ])->get();
        }

        return view('Exports.inventario_de_actualizacion_del_posslim',[
            'datas'=>$datas,
        ]);
    }
}
