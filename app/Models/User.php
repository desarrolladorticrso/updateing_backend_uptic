<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'image',
        'email',
        'role_id',
        'password',
        'number_document',

    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime:d-m-Y H:m',
        'updated_at' => 'datetime:d-m-Y H:m',
    ];


    public function role()
    {
        return $this->belongsTo(Rol::class);
    }

    public function tecnico_turno()
    {
        return $this->hasMany(EntregaTurnos::class);
    }

    public function tecnico_recibe()
    {
        return $this->hasOne(EntregaTurnos::class);
    }

    public function reporte_señal()
    {
        return $this->hasOne(ReporteSeñal::class,'tecnico_id');
    }

    public function inventario_maquinas()
    {
        return $this->hasMany(InventarioMaquina::class, 'tecnico_id');
    }

    public function inventario_equipos()
    {
        return $this->hasMany(InventarioEquipos::class);
    }

    public function actualizacion_posslim()
    {
        return $this->hasOne(ActualizacionPosslim::class);
    }

    public function inventario_camaras()
    {
        return $this->hasOne(InventarioCamara::class,'tecnico_id');
    }

    public function fallas_administrativas()
    {
        return $this->hasMany(ReporteFallasAbministrativas::class, 'user_id');
    }

    public function validacion_antena()
    {
        return $this->hasOne(ValidacionAntena::class);
    }

    public function scopeFilters($query,array $filters)
    {
        $query->when($filters['search'] ?? null, function($query, $search){
            $query->where('name','like','%'.$search.'%')
                ->orWhere('email','like','%'.$search.'%')
                ->orWhere('number_document','like','%'.$search.'%');
        });
    }

}
