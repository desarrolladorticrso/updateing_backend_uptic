<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OperadorSatelital extends Model
{
    use HasFactory, SoftDeletes;

    protected $table='operador_satelitals';

    protected $fillable=[
        'name'
    ];

    public function validacion_antena()
    {
        return $this->hasOne(ValidacionAntena::class);
    }

    public function scopeFilters($query,array $filters)
    {
        $query->when($filters['search'] ?? null, function($query, $search){
            $query->where('name','like','%'.$search.'%');
        });
    }
}
