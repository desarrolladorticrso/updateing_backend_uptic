<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RecepcionCentral extends Model
{
    use HasFactory, SoftDeletes;

    protected $table='recepcion_central';

    protected $fillable=[
        'fecha_recibido',
        'nombre_quien_recibio',
        'numero_guia',
        'transportadora_id',
        'fecha_entrega',
        'proceso_id',
        'nombre_recibe',
        'observacion',
        'valor_paquete',
        'estado_paquete',
    ];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y H:m',
        'updated_at' => 'datetime:d-m-Y H:m',
    ];

    public function transportadora()
    {
        return $this->belongsTo(Transportadora::class);
    }

    public function proceso()
    {
        return $this->belongsTo(Proceso::class);
    }

    public function scopeFilters($query,array $filters)
    {
        $query->when($filters['search'] ?? null, function($query, $search){
            $query->where('numero_guia','like','%'.$search.'%');
        })->when($filters['proceso_id'] ?? null, function($query, $search){
            $query->where('proceso_id',$search);
        })->when($filters['transportadora_id'] ?? null, function($query, $search){
            $query->where('transportadora_id',$search);
        });
    }
}
