<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ValidacionAntena extends Model
{
    use HasFactory, SoftDeletes;

    protected $table='validacion_antenas';

    protected $fillable=[
        'poblacion_id',
        'operador_satelital_id',
        'nivel_senial_actual',
        'tecnico_id',
        'observacion',
        'id_antena',
        'tiene_router',
        'vpn_id',
        'prom_ping_hacia_vpn',
        'capacidad_datos',
        'ping_prom_tiemp_env_giro',
        'ping_prom_tiemp_vent_chance',
        'cant_equipos_oficina',
        'cant_equipos_betplay',
        'ping_prom_tiemp_pag_giro',
    ];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y H:m',
        'updated_at' => 'datetime:d-m-Y H:m',
    ];

    public function poblacion()
    {
        return $this->belongsTo(Poblacion::class);
    }

    public function operador_satelital()
    {
        return $this->belongsTo(OperadorSatelital::class);
    }

    public function tecnico()
    {
        return $this->belongsTo(User::class);
    }

    public function vpn()
    {
        return $this->belongsTo(Vpn::class);
    }

    public function scopeFilters($query,array $filters)
    {
        $query->when($filters['search'] ?? null, function($query, $search){
            $query->where('id_antena','like','%'.$search.'%');
        })->when($filters['vpn_id'] ?? null, function($query, $search){
            $query->where('vpn_id','like','%'.$search.'%');
        })->when($filters['tecnico_id'] ?? null, function($query, $search){
            $query->where('tecnico_id','like','%'.$search.'%');
        })->when($filters['poblacion_id'] ?? null, function($query, $search){
            $query->where('poblacion_id','like','%'.$search.'%');
        })->when($filters['operador_satelital_id'] ?? null, function($query, $search){
            $query->where('operador_satelital_id','like','%'.$search.'%');
        });
    }
}
