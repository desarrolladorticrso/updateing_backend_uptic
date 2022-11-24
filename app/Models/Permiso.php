<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permiso extends Model
{
    use HasFactory, SoftDeletes;

    protected $table="permisos";

    protected $fillable=[
        'slug',
        'name',
        'description',
    ];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y H:m',
        'updated_at' => 'datetime:d-m-Y H:m',
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
