<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActualizacionPosslim extends Model
{
    use HasFactory, SoftDeletes;

    protected $table="actualizacion_posslims";

    protected $fillable=[
        'tecnico_id',
        'punto_oficina_id',
        'version_posslim_id',
        'version_del_sims_id',
    ];

    public function tecnico()
    {
        return $this->belongsTo(User::class);
    }

    public function punto_oficina()
    {
        return $this->belongsTo(PuntosOficinas::class);
    }

    public function version_posslim()
    {
        return $this->belongsTo(VersionPosslim::class);
    }

    public function version_sims()
    {
        return $this->belongsTo(VersionSims::class,'version_del_sims_id');
    }

    public function scopeFilters($query,array $filters)
    {
        $query->when($filters['tecnico_id'] ?? null, function($query, $search){
            $query->where('tecnico_id',$search);
        })
        ->when($filters['punto_oficina_id'] ?? null, function($query, $search){
            $query->where('punto_oficina_id',$search);
        })
        ->when($filters['version_posslim_id'] ?? null, function($query, $search){
            $query->where('version_posslim_id',$search);
        })
        ->when($filters['version_del_sims_id'] ?? null, function($query, $search){
            $query->where('version_del_sims_id',$search);
        });
    }


}
