<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MemoriaRam extends Model
{
    use HasFactory, SoftDeletes;

    protected $table='memoria_r_a_m_s';

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
