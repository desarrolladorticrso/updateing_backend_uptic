<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VersionPosslim extends Model
{
    use HasFactory, SoftDeletes;
    protected $table="version_posslims";

    protected $fillable=[
        'name'
    ];

    public function actualizacion_posslim()
    {
        return $this->hasOne(ActualizacionPosslim::class);
    }

    public function scopeFilters($query,array $filters)
    {
        $query->when($filters['search'] ?? null, function($query, $search){
            $query->where('name','like','%'.$search.'%');
        });
    }
}
