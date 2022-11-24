<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OperadorSimcard extends Model
{
    use HasFactory, SoftDeletes;

    protected $table='operador_simcards';

    protected $fillable=[
        'name'
    ];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y H:m',
        'updated_at' => 'datetime:d-m-Y H:m',
    ];

    public function lineas_moviles()
    {
        return $this->hasMany(LineaMovile::class);
    }

    public function inventario_maquina()
    {
        return $this->hasOne(InventarioMaquina::class);
    }

    public function scopeFilters($query,array $filters)
    {
        $query->when($filters['search'] ?? null, function($query, $search){
            $query->where('name','like','%'.$search.'%');
        });
    }
}
