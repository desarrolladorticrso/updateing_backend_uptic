<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OperadorTecnologico extends Model
{
    use HasFactory, SoftDeletes;

    protected $table='operador_tecnologicos';

    protected $fillable=[
        'name'
    ];

    public function reporte_señal()
    {
        return $this->hasOne(ReporteSeñal::class);
    }

    public function scopeFilters($query,array $filters)
    {
        $query->when($filters['search'] ?? null, function($query, $search){
            $query->where('name','like','%'.$search.'%');
        });
    }

}
