<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReporteSenal extends Model
{
    use HasFactory, SoftDeletes;

    protected $table='reporte_senials';
    protected $fillable=[
        'tecnico_id',
        'observacion',
        'numero_linea',
        'poblacion_id',
        'numero_incidente',
        'operador_tecnologico_id',
    ];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y H:m',
        'updated_at' => 'datetime:d-m-Y H:m',
    ];

    public function poblacion()
    {
        return $this->belongsTo(Poblacion::class);
    }

    public function operador_tecnologico()
    {
        return $this->belongsTo(OperadorTecnologico::class);
    }

    public function tecnico()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFilters($query,array $filters)
    {
        $query->when($filters['search'] ?? null, function($query, $search){
            $query->where('numero_linea','like','%'.$search.'%')
                ->orWhere('numero_incidente','like','%'.$search.'%');
        })->when($filters['tecnico_id'] ?? null, function($query, $search){
            $query->where('tecnico_id', $search);
        })->when($filters['poblacion_id'] ?? null, function($query, $search){
            $query->where('poblacion_id', $search);
        })->when($filters['operador_tecnologico_id'] ?? null, function($query, $search){
            $query->where('operador_tecnologico_id', $search);
        });
    }
}


