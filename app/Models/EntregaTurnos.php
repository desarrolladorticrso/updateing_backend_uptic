<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EntregaTurnos extends Model
{
    use HasFactory, SoftDeletes;

    protected $table='entrega_turnos';
    protected $fillable=[
        'tecnico_turno_id',
        'tecnico_recibe_id',
        'observacion',
    ];

    protected $casts = [
        'created_at' => "date:Y-m-d",
    ];

    public function tecnico_turno()
    {
        return $this->belongsTo(User::class);
    }

    public function tecnico_recibe()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFilters($query,array $filters)
    {
        $query->when($filters['search'] ?? null, function($query, $search){
            $query->where('observacion','like','%'.$search.'%');
        });
    }
}
