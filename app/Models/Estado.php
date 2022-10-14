<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estado extends Model
{
    use HasFactory, SoftDeletes;

    protected $table='estados';

    protected $fillable=[
        'name'
    ];

    public function lineas_moviles()
    {
        return $this->belongsTo(LineaMovile::class,'estado_linea_id');
    }

    public function inventario_camaras()
    {
        return $this->hasOne(InventarioCamara::class,'estado_camaras_id');
    }

    public function scopeFilters($query,array $filters)
    {
        $query->when($filters['search'] ?? null, function($query, $search){
            $query->where('name','like','%'.$search.'%');
        });
    }

}
