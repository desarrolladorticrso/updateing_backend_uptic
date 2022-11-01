<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventarioEquipos extends Model
{
    use HasFactory, SoftDeletes;

    protected $table='inventario_equipos';

    protected $fillable=[
        'asesor_id',
        'lider_id',
        'punto_oficina_id',
        'tipo_equipo_trabajo_id',
        'marca_equipo_id',
        'tipo_sistema_operativo_id',
        'memoria_ram_id',
        'disco_duro_id',
        'activo_fijo_equipo',
        'serial_equipo',
        'estado_equipo_trabajo_id',
        'tiene_monitor',
        'marca_monitor_id',
        'activo_fijo_monitor',
        'modelo_monitor',
        'serial_monitor',
        'estado_monitor_id ',
        'tiene_teclado',
        'marca_teclado_id ',
        'modelo_teclado',
        'activo_fijo_teclado',
        'serial_teclado',
        'estado_teclado_id ',
        'tiene_mouse',
        'marca_mouse_id ',
        'modelo_mouse',
        'activo_fijo_mouse',
        'serial_mouse',
        'estado_mouse_id ',
        'tiene_impresora',
        'marca_impresora_id ',
        'modelo_impresora',
        'activo_fijo_impresora',
        'serial_impresora',
        'estado_impresora_id ',
        'tiene_lector_biometrico',
        'activo_fijo_lector_biometrico',
        'serial_lector_biometrico',
        'tiene_lector_barra',
        'activo_lector_barra',
        'serial_lector_barra',
        'tipo_conexion_id ',
        'tecnico_id ',
        'tipo_servicio_id ',
        'ip_equipo',
        'mac_equipo',
        'tiene_sid',
        'serial_sid',
        'activo_fijo_sid',
    ];

    public function asesor()
    {
        return $this->belongsTo(Asesor::class);
    }

    public function lider()
    {
        return $this->belongsTo(Lider::class);
    }

    public function punto_oficina()
    {
        return $this->belongsTo(PuntosOficinas::class);
    }

    public function tipo_equipo_trabajo()
    {
        return $this->belongsTo(TipoEquipoTrabajo::class);
    }

    public function marca_equipo()
    {
        return $this->belongsTo(MarcaEquipo::class);
    }

    public function tipo_sistema_operativo()
    {
        return $this->belongsTo(SistemaOperativo::class);
    }

    public function memoria_ram()
    {
        return $this->belongsTo(MemoriaRam::class);
    }

    public function disco_duro()
    {
        return $this->belongsTo(DiscosDuro::class);
    }

    public function estado_equipo_trabajo()
    {
        return $this->belongsTo(Estado::class);
    }

    public function marca_monitor()
    {
        return $this->belongsTo(MarcaMonitor::class);
    }

    public function estado_monitor()
    {
        return $this->belongsTo(Estado::class);
    }

    public function marca_teclado()
    {
        return $this->belongsTo(MarcaTeclado::class);
    }

    public function estado_teclado()
    {
        return $this->belongsTo(Estado::class);
    }

    public function marca_mouse()
    {
        return $this->belongsTo(MarcaMause::class);
    }

    public function estado_mouse()
    {
        return $this->belongsTo(Estado::class);
    }

    public function marca_impresora()
    {
        return $this->belongsTo(MarcaImpresora::class);
    }

    public function estado_impresora()
    {
        return $this->belongsTo(Estado::class);
    }

    public function tipo_conexion()
    {
        return $this->belongsTo(TipoConexion::class);
    }

    public function tecnico()
    {
        return $this->belongsTo(User::class);
    }

    public function tipo_servicio()
    {
        return $this->belongsTo(TipoServicioPunto::class);
    }


    public function scopeFilters($query,array $filters)
    {
        $query->when($filters['search'] ?? null, function($query, $search){
            $query->where('serial_equipo','like','%'.$search.'%')
                ->orWhere('activo_fijo_equipo','like','%'.$search.'%');
        })->when($filters['officePoints_id'] ?? null, function($query, $officePoints_id){
            $query->where('punto_oficina_id',$officePoints_id);
        })->when($filters['marca_equipo_id'] ?? null, function($query, $marca_equipo_id){
            $query->where('marca_equipo_id',$marca_equipo_id);
        });
    }
}
