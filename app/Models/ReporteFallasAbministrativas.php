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
        'fallas_presentadas',
        'fecha_mantenimiento',
        'se_envio_a_provedor',
    ];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y H:m',
        'updated_at' => 'datetime:d-m-Y H:m',
    ];

    public function equipo()
    {
        return $this->belongsTo(MarcaEquipo::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFilters($query,array $filters)
    {
        $query->when($filters['search'] ?? null, function($query, $search){
            $query->where('serial','like','%'.$search.'%');
        });
    }
}
