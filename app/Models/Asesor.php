<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asesor extends Model
{
    use HasFactory, SoftDeletes;

    protected $table="asesores";

    protected $fillable=[
        'name',
        'documento',
        'estado_id',
    ];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y H:m',
        'updated_at' => 'datetime:d-m-Y H:m',
    ];

    public function inventario_maquinas()
    {
        return $this->hasMany(InventarioMaquina::class, 'asesor_id');
    }

    public function inventario_equipos()
    {
        return $this->hasMany(InventarioEquipos::class);
    }

    public function scopeFilters($query,array $filters)
    {
        $query->when($filters['search'] ?? null, function($query, $search){
            $query->where('name','like','%'.$search.'%')
            ->orWhere('documento','like','%'.$search.'%');
        });
    }
}
