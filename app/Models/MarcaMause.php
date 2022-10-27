<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarcaMause extends Model
{
    use HasFactory;

    protected $table='marca_mice';

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
