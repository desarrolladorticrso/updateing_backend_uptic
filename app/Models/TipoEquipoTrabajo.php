<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TipoEquipoTrabajo extends Model
{
    use HasFactory, SoftDeletes;

    protected $table='tipo_equipo_trabajos';
    protected $fillable=[
        'name'
    ];

    public function inventario_equipos()
    {
        return $this->hasMany(InventarioEquipos::class);
    }

    public function scopeFilters($query,array $filters)
    {
        $query->when($filters['search'] ?? null, function($query, $search){
            $query->where('name','like','%'.$search.'%');
        });
    }
}
