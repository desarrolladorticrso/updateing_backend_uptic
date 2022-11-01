<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventarioMaquina extends Model
{
    use HasFactory, SoftDeletes;

    protected $table='inventario_maquinas';

    protected $fillable=[
        'imei',
        'apn_id',
        'lider_id',
        'asesor_id',
        'tecnico_id',
        'activo_fijo',
        'mantenimiento',
        'nro_linea_id',
        'serial_maquina',
        'punto_oficina_id',
        'modelo_maquina_id',
        'version_maquina_id',
        'operador_simcard_id',
    ];

    public function asesor()
    {
        return $this->belongsTo(Asesor::class);
    }

    public function lider()
    {
        return $this->belongsTo(Lider::class);
    }

    public function modelo_maquina()
    {
        return $this->belongsTo(ModeloMaquina::class);
    }

    public function version_maquina()
    {
        return $this->belongsTo(VersionMaquina::class);
    }

    public function operador_simcard()
    {
        return $this->belongsTo(OperadorSimcard::class);
    }

    public function linea_movil()
    {
        return $this->belongsTo(LineaMovile::class,'nro_linea_id');
    }

    public function tecnico()
    {
        return $this->belongsTo(User::class);
    }

    public function apn()
    {
        return $this->belongsTo(Apn::class);
    }

    public function punto_oficina()
    {
        return $this->belongsTo(PuntosOficinas::class);
    }

    public function scopeFilters($query,array $filters)
    {
        $query->when($filters['leaders_id'] ?? null, function($query, $search){
            $query->where('lider_id',$search);
        })->when($filters['officePoints_id'] ?? null, function($query, $search){
            $query->where('punto_oficina_id',$search);
        })->when($filters['machineModel_id'] ?? null, function($query, $search){
            $query->where('modelo_maquina_id',$search);
        });
    }
}
