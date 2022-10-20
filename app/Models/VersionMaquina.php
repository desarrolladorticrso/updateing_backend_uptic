<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VersionMaquina extends Model
{
    use HasFactory, SoftDeletes;

    protected $table='version_maquinas';

    protected $fillable=[
        'name'
    ];

    public function inventario_maquina()
    {
        return $this->hasMany(InventarioMaquina::class);
    }

    public function scopeFilters($query,array $filters)
    {
        $query->when($filters['search'] ?? null, function($query, $search){
            $query->where('name','like','%'.$search.'%');
        });
    }
}