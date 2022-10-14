<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LineaMovile extends Model
{
    use HasFactory, SoftDeletes;

    protected $table='lineas_moviles';

    protected $fillable=[
        'ip',
        'plan',
        'linea',
        'serial',
        'usuario',
        'password',
        'operador_id',
        'cargo_basico',
        'codigo_cliente',
        'estado_linea_id ',
        'caracteristicas_servicio',
    ];

    public function operador_simcard()
    {
        return $this->belongsTo(OperadorSimcard::class,'operador_id');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class,'estado_linea_id');
    }

    public function inventario_maquinas()
    {
        return $this->hasOne(InventarioMaquina::class,'nro_linea_id');
    }

    public function scopeFilters($query,array $filters)
    {
        $query->when($filters['search'] ?? null, function($query, $search){
            $query->where('linea','like','%'.$search.'%')
                ->orWhere('serial','like','%'.$search.'%')
                ->orWhere('plan','like','%'.$search.'%')
                ->orWhere('usuario','like','%'.$search.'%');
        })->when($filters['operador_id'] ?? null, function($query, $search){
            $query->where('operador_id', $search);
        });
    }
}

