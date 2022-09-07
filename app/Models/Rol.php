<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rol extends Model
{
    use HasFactory, SoftDeletes;

    protected $table="roles";

    protected $fillable=[
        'name',
        'full_acces',
    ];


    public function users()
    {
        return $this->hasMany(User::class,'role');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permiso::class);
    }

    public function scopeFilters($query,array $filters)
    {
        $query->when($filters['search'] ?? null, function($query, $search){
            $query->where('name','like','%'.$search.'%');
        });
    }

}
