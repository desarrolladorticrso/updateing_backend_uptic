<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    use HasFactory;

    protected $table="permisos";

    protected $fillable=[
        'slug',
        'name',
        'description',
    ];

    public function roles()
    {
        return $this->belongsToMany(Rol::class);
    }

    public function scopeFilters($query,array $filters)
    {
        $query->when($filters['search'] ?? null, function($query, $search){
            $query->where('name','like','%'.$search.'%')
                    ->orWhere('slug','like','%'.$search.'%')
                    ->orWhere('description','like','%'.$search.'%');
        });
    }
}
