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
        });
    }
}
