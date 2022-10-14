<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CentroCosto extends Model
{
    use HasFactory, SoftDeletes;

    protected $table='centros_costos';

    protected $fillable=[
        'name'
    ];

    public function inventario_camara()
    {
        return $this->hasOne(InventarioCamara::class,'centro_costo_id');
    }

    public function scopeFilters($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function($query, $search){
            $query->where('name','like','%'.$search.'%');
        });
    }
}
