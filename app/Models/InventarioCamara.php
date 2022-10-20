<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventarioCamara extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable=[
        'ip',
        'url',
        'user_sj',
        'user_admin',
        'tecnico_id',
        'password_sj',
        'puerto_http',
        'ancho_banda',
        'observacion',
        'user_soporte',
        'marca_dvr_id',
        'password_admin',
        'centro_costo_id',
        'puerto_servidor',
        'password_soporte',
        'punto_oficina_id',
        'cantidad_camaras',
        'estado_camaras_id',
        'nro_camaras_activas',
    ];

    public function centro_costo()
    {
        return $this->belongsTo(CentroCosto::class,'centro_costo_id');
    }

    public function punto_oficina()
    {
        return $this->belongsTo(PuntosOficinas::class);
    }

    public function marca_dvr()
    {
        return $this->belongsTo(MarcaDvr::class);
    }

    public function tecnico()
    {
        return $this->belongsTo(User::class);
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_camaras_id');
    }

    public function scopeFilters($query,array $filters)
    {
        $query->when($filters['tecnico_id'] ?? null, function($query, $search){
            $query->where('tecnico_id',$search);
        })->when($filters['marca_dvr_id'] ?? null, function($query, $search){
            $query->where('marca_dvr_id',$search);
        })->when($filters['centro_costo_id'] ?? null, function($query, $search){
            $query->where('centro_costo_id',$search);
        })->when($filters['punto_oficina_id'] ?? null, function($query, $search){
            $query->where('punto_oficina_id',$search);
        });
    }
}
