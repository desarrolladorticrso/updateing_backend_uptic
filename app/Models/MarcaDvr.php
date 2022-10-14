<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MarcaDvr extends Model
{
    use HasFactory, SoftDeletes;

    protected $table='marcas_dvrs';

    protected $fillable=[
        'name'
    ];

    public function inventario_camaras()
    {
        return $this->hasOne(InventarioCamara::class,'marca_dvr_id');
    }

    public function scopeFilters($query,array $filters)
    {
        $query->when($filters['search'] ?? null, function($query, $search){
            $query->where('name','like','%'.$search.'%');
        });
    }
}
