<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReporteFallasAbministrativas extends Model
{
    use HasFactory, SoftDeletes;

    protected $table='reporte_fallas_administrativas';

    protected $fillable=[
        'serial',
        'user_id',
        'equipo_id',
        'responsable',
        'fallas_precentadas',
        'fecha_mantenimiento',
        'se_envio_a_provedor',
    ];


    public function scopeFilters($query,array $filters)
    {
        $query->when($filters['search'] ?? null, function($query, $search){
            $query->where('serial','like','%'.$search.'%');
        });
    }
}
