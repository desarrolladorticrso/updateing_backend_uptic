<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MarcaEquipo extends Model
{
    use HasFactory, SoftDeletes;

    protected $table='marca_equipos';

    protected $fillable=[
        'name'
    ];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y H:m',
        'updated_at' => 'datetime:d-m-Y H:m',
    ];

    public function inventario_equipos()
    {
        return $this->hasMany(InventarioEquipos::class);
    }

    public function fallas_administrativas()
    {
        return $this->hasMany(ReporteFallasAbministrativas::class, 'equipo_id');
    }

    public function scopeFilters($query,array $filters)
    {
        $query->when($filters['search'] ?? null, function($query, $search){
            $query->where('name','like','%'.$search.'%');
        });
    }
}
