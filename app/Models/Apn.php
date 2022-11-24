<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Apn extends Model
{
    use HasFactory, SoftDeletes;

    protected $table="apns";

    protected $fillable=[
        'name'
    ];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y H:m',
        'updated_at' => 'datetime:d-m-Y H:m',
    ];

    public function inventario_maquinas()
    {
        return $this->hasOne(InventarioMaquina::class, 'apn_id');
    }

    public function scopeFilters($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function($query, $search){
            $query->where('name','like','%'.$search.'%');
        });
    }

}
