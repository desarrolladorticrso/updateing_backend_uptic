<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PuntosOficinas extends Model
{
    use HasFactory, SoftDeletes;

    protected $table='puntos_oficinas';

    protected $fillable=[
        'name'
    ];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y H:m',
        'updated_at' => 'datetime:d-m-Y H:m',
    ];

    public function inventario_maquins()
    {
        return $this->belongsTo(InventarioMaquina::class);
    }

    public function inventario_camaras()
    {
        return $this->hasOne(InventarioCamara::class,'punto_oficina_id');
    }

    public function inventario_equipos()
    {
        return $this->hasMany(InventarioEquipos::class);
    }

    public function actualizacion_posslim()
    {
        return $this->hasOne(ActualizacionPosslim::class);
    }

    public function scopeFilters($query,array $filters)
    {
        $query->when($filters['search'] ?? null, function($query, $search){
            $query->where('name','like','%'.$search.'%');
        });
    }
}
