<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Poblacion extends Model
{
    use HasFactory, SoftDeletes;

    protected $table='poblacions';
    protected $fillable=[
        'name'
    ];

    public function reporte_señal()
    {
        return $this->hasOne(ReporteSeñal::class);
    }

    public function validacion_antena()
    {
        return $this->hasOne(ValidacionAntena::class);
    }

    public function scopeFilters($query,array $filters)
    {
        $query->when($filters['search'] ?? null, function($query, $search){
            $query->where('name','like','%'.$search.'%');
        });
    }
}
