<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VersionSims extends Model
{
    use HasFactory, SoftDeletes;

    protected $table='version_del_sims';

    protected $fillable=[
        'name'
    ];

    public function actualizacion_posslim()
    {
        return $this->hasOne(ActualizacionPosslim::class, 'version_del_sims_id');
    }

    public function scopeFilters($query,array $filters)
    {
        $query->when($filters['search'] ?? null, function($query, $search){
            $query->where('name','like','%'.$search.'%');
        });
    }
}
