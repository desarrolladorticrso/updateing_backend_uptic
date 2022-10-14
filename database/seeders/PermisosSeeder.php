<?php

namespace Database\Seeders;

use App\Models\Permiso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermisosSeeder extends Seeder
{
    public function run()
    {
        // 'slug',
        // 'name',
        // 'description',

        //-----------------------------------------------Modulos----------------

        Permiso::create([
            'slug'=>'modulo.tareas',
            'name'=>'Modulo tareas',
            'description'=>'Puede ver el modulo de tareas',
        ]);

        Permiso::create([
            'slug'=>'modulo.lineas',
            'name'=>'Modulo lineas',
            'description'=>'Puede ver el modulo de lineas',
        ]);

        Permiso::create([
            'slug'=>'modulo.recepcion',
            'name'=>'Modulo recepcion',
            'description'=>'Puede ver el modulo de recepcion',
        ]);

        Permiso::create([
            'slug'=>'modulo.operaciones',
            'name'=>'Modulo operaciones',
            'description'=>'Puede ver el modulo de operaciones',
        ]);

        //----------------------------Roles-------------------------------
        Permiso::create([
            'slug'=>'roles.index',
            'name'=>'Listar roles',
            'description'=>'Puede ver todos los roles',
        ]);
        Permiso::create([
            'slug'=>'roles.store',
            'name'=>'Agregar roles',
            'description'=>'Puede agregar roles',
        ]);
        Permiso::create([
            'slug'=>'roles.show',
            'name'=>'Actualizar roles',
            'description'=>'Puede actualizar todos los roles',
        ]);
        Permiso::create([
            'slug'=>'roles.destroy',
            'name'=>'Eliminar roles',
            'description'=>'Puede eliminar todos los roles',
        ]);
        Permiso::create([
            'slug'=>'roles.restore',
            'name'=>'Restablecer roles',
            'description'=>'Puede restablecer todos los roles',
        ]);
        Permiso::create([
            'slug'=>'roles.forceDestroy',
            'name'=>'Eliminar permanentemente roles',
            'description'=>'Puede eliminar permanentemente todos los roles',
        ]);

        //----------------------------Permisos-------------------------------
         Permiso::create([
            'slug'=>'permission.index',
            'name'=>'Listar permission',
            'description'=>'Puede ver todos los permission',
        ]);
        Permiso::create([
            'slug'=>'permission.store',
            'name'=>'Agregar permission',
            'description'=>'Puede agregar permission',
        ]);
        Permiso::create([
            'slug'=>'permission.show',
            'name'=>'Actualizar permission',
            'description'=>'Puede actualizar todos los permission',
        ]);
        Permiso::create([
            'slug'=>'permission.destroy',
            'name'=>'Eliminar permission',
            'description'=>'Puede eliminar todos los permission',
        ]);
        Permiso::create([
            'slug'=>'permission.restore',
            'name'=>'Restablecer permission',
            'description'=>'Puede restablecer todos los permission',
        ]);
        Permiso::create([
            'slug'=>'permission.forceDestroy',
            'name'=>'Eliminar permanentemente permission',
            'description'=>'Puede eliminar permanentemente todos los permission',
        ]);

         //----------------------------Users-------------------------------
         Permiso::create([
            'slug'=>'user.index',
            'name'=>'Listar user',
            'description'=>'Puede ver todos los user',
        ]);
        Permiso::create([
            'slug'=>'user.store',
            'name'=>'Agregar user',
            'description'=>'Puede agregar user',
        ]);
        Permiso::create([
            'slug'=>'user.show',
            'name'=>'Actualizar user',
            'description'=>'Puede actualizar todos los user',
        ]);
        Permiso::create([
            'slug'=>'user.destroy',
            'name'=>'Eliminar user',
            'description'=>'Puede eliminar todos los user',
        ]);
        Permiso::create([
            'slug'=>'user.restore',
            'name'=>'Restablecer user',
            'description'=>'Puede restablecer todos los user',
        ]);
        Permiso::create([
            'slug'=>'user.forceDestroy',
            'name'=>'Eliminar permanentemente user',
            'description'=>'Puede eliminar permanentemente todos los user',
        ]);

         //----------------------------Discos duros-------------------------------
         Permiso::create([
            'slug'=>'discos_duro.index',
            'name'=>'Listar discos duros',
            'description'=>'Puede ver todos los discos duros',
        ]);
        Permiso::create([
            'slug'=>'discos_duro.store',
            'name'=>'Agregar discos duros',
            'description'=>'Puede agregar discos duros',
        ]);
        Permiso::create([
            'slug'=>'discos_duro.show',
            'name'=>'Actualizar discos duros',
            'description'=>'Puede actualizar todos los discos duros',
        ]);
        Permiso::create([
            'slug'=>'discos_duro.destroy',
            'name'=>'Eliminar discos duros',
            'description'=>'Puede eliminar todos los discos duros',
        ]);
        Permiso::create([
            'slug'=>'discos_duro.restore',
            'name'=>'Restablecer discos duros',
            'description'=>'Puede restablecer todos los discos duros',
        ]);
        Permiso::create([
            'slug'=>'discos_duro.forceDestroy',
            'name'=>'Eliminar permanentemente discos duros',
            'description'=>'Puede eliminar permanentemente todos los discos duros',
        ]);

        //----------------------------Asesores-------------------------------
        Permiso::create([
            'slug'=>'asesor.index',
            'name'=>'Listar asesores',
            'description'=>'Puede ver todos los asesores',
        ]);
        Permiso::create([
            'slug'=>'asesor.store',
            'name'=>'Agregar asesores',
            'description'=>'Puede agregar asesores',
        ]);
        Permiso::create([
            'slug'=>'asesor.show',
            'name'=>'Actualizar asesores',
            'description'=>'Puede actualizar todos los asesores',
        ]);
        Permiso::create([
            'slug'=>'asesor.destroy',
            'name'=>'Eliminar asesores',
            'description'=>'Puede eliminar todos los asesores',
        ]);
        Permiso::create([
            'slug'=>'asesor.restore',
            'name'=>'Restablecer asesores',
            'description'=>'Puede restablecer todos los asesores',
        ]);
        Permiso::create([
            'slug'=>'asesor.forceDestroy',
            'name'=>'Eliminar permanentemente asesores',
            'description'=>'Puede eliminar permanentemente todos los asesores',
        ]);

        //----------------------------Liders-------------------------------
        Permiso::create([
            'slug'=>'lider.index',
            'name'=>'Listar lideres',
            'description'=>'Puede ver todos los lideres',
        ]);
        Permiso::create([
            'slug'=>'lider.store',
            'name'=>'Agregar lideres',
            'description'=>'Puede agregar lideres',
        ]);
        Permiso::create([
            'slug'=>'lider.show',
            'name'=>'Actualizar lideres',
            'description'=>'Puede actualizar todos los lideres',
        ]);
        Permiso::create([
            'slug'=>'lider.destroy',
            'name'=>'Eliminar lideres',
            'description'=>'Puede eliminar todos los lideres',
        ]);
        Permiso::create([
            'slug'=>'lider.restore',
            'name'=>'Restablecer lideres',
            'description'=>'Puede restablecer todos los lideres',
        ]);
        Permiso::create([
            'slug'=>'lider.forceDestroy',
            'name'=>'Eliminar permanentemente lideres',
            'description'=>'Puede eliminar permanentemente todos los lideres',
        ]);

        //----------------------------Apns-------------------------------
        Permiso::create([
            'slug'=>'apns.index',
            'name'=>'Listar apns',
            'description'=>'Puede ver todos los apns',
        ]);
        Permiso::create([
            'slug'=>'apns.store',
            'name'=>'Agregar apns',
            'description'=>'Puede agregar apns',
        ]);
        Permiso::create([
            'slug'=>'apns.show',
            'name'=>'Actualizar apns',
            'description'=>'Puede actualizar todos los apns',
        ]);
        Permiso::create([
            'slug'=>'apns.destroy',
            'name'=>'Eliminar apns',
            'description'=>'Puede eliminar todos los apns',
        ]);
        Permiso::create([
            'slug'=>'apns.restore',
            'name'=>'Restablecer apns',
            'description'=>'Puede restablecer todos los apns',
        ]);
        Permiso::create([
            'slug'=>'apns.forceDestroy',
            'name'=>'Eliminar permanentemente apns',
            'description'=>'Puede eliminar permanentemente todos los apns',
        ]);

        //----------------------------Vpns-------------------------------
        Permiso::create([
            'slug'=>'vpn.index',
            'name'=>'Listar vpn',
            'description'=>'Puede ver todos los vpn',
        ]);
        Permiso::create([
            'slug'=>'vpn.store',
            'name'=>'Agregar vpn',
            'description'=>'Puede agregar vpn',
        ]);
        Permiso::create([
            'slug'=>'vpn.show',
            'name'=>'Actualizar vpn',
            'description'=>'Puede actualizar todos los vpn',
        ]);
        Permiso::create([
            'slug'=>'vpn.destroy',
            'name'=>'Eliminar vpn',
            'description'=>'Puede eliminar todos los vpn',
        ]);
        Permiso::create([
            'slug'=>'vpn.restore',
            'name'=>'Restablecer vpn',
            'description'=>'Puede restablecer todos los vpn',
        ]);
        Permiso::create([
            'slug'=>'vpn.forceDestroy',
            'name'=>'Eliminar permanentemente vpn',
            'description'=>'Puede eliminar permanentemente todos los vpn',
        ]);

         //----------------------------Entrega de turnos-------------------------------
         Permiso::create([
            'slug'=>'entrega_turnos.index',
            'name'=>'Listar entrega de turnos',
            'description'=>'Puede ver todos los entrega de turnos',
        ]);
        Permiso::create([
            'slug'=>'entrega_turnos.store',
            'name'=>'Agregar entrega de turnos',
            'description'=>'Puede agregar entrega de turnos',
        ]);
        Permiso::create([
            'slug'=>'entrega_turnos.show',
            'name'=>'Actualizar entrega de turnos',
            'description'=>'Puede actualizar todos los entrega de turnos',
        ]);
        Permiso::create([
            'slug'=>'entrega_turnos.destroy',
            'name'=>'Eliminar entrega de turnos',
            'description'=>'Puede eliminar todos los entrega de turnos',
        ]);
        Permiso::create([
            'slug'=>'entrega_turnos.restore',
            'name'=>'Restablecer entrega de turnos',
            'description'=>'Puede restablecer todos los entrega de turnos',
        ]);
        Permiso::create([
            'slug'=>'entrega_turnos.forceDestroy',
            'name'=>'Eliminar permanentemente entrega de turnos',
            'description'=>'Puede eliminar permanentemente todos los entrega de turnos',
        ]);

         //----------------------------Estados-------------------------------
         Permiso::create([
            'slug'=>'estados.index',
            'name'=>'Listar estados',
            'description'=>'Puede ver todos los estados',
        ]);
        Permiso::create([
            'slug'=>'estados.store',
            'name'=>'Agregar estados',
            'description'=>'Puede agregar estados',
        ]);
        Permiso::create([
            'slug'=>'estados.show',
            'name'=>'Actualizar estados',
            'description'=>'Puede actualizar todos los estados',
        ]);
        Permiso::create([
            'slug'=>'estados.destroy',
            'name'=>'Eliminar estados',
            'description'=>'Puede eliminar todos los estados',
        ]);
        Permiso::create([
            'slug'=>'estados.restore',
            'name'=>'Restablecer estados',
            'description'=>'Puede restablecer todos los estados',
        ]);
        Permiso::create([
            'slug'=>'estados.forceDestroy',
            'name'=>'Eliminar permanentemente estados',
            'description'=>'Puede eliminar permanentemente todos los estados',
        ]);

         //----------------------------Version del posslim-------------------------------
         Permiso::create([
            'slug'=>'version_posslims.index',
            'name'=>'Listar version del posslim',
            'description'=>'Puede ver todos los version del posslim',
        ]);
        Permiso::create([
            'slug'=>'version_posslims.store',
            'name'=>'Agregar version del posslim',
            'description'=>'Puede agregar version del posslim',
        ]);
        Permiso::create([
            'slug'=>'version_posslims.show',
            'name'=>'Actualizar version del posslim',
            'description'=>'Puede actualizar todos los version del posslim',
        ]);
        Permiso::create([
            'slug'=>'version_posslims.destroy',
            'name'=>'Eliminar version del posslim',
            'description'=>'Puede eliminar todos los version del posslim',
        ]);
        Permiso::create([
            'slug'=>'version_posslims.restore',
            'name'=>'Restablecer version del posslim',
            'description'=>'Puede restablecer todos los version del posslim',
        ]);
        Permiso::create([
            'slug'=>'version_posslims.forceDestroy',
            'name'=>'Eliminar permanentemente version del posslim',
            'description'=>'Puede eliminar permanentemente todos los version del posslim',
        ]);

         //----------------------------Version de maquinas-------------------------------
         Permiso::create([
            'slug'=>'version_maquinas.index',
            'name'=>'Listar version de maquinas',
            'description'=>'Puede ver todos los version de maquinas',
        ]);
        Permiso::create([
            'slug'=>'version_maquinas.store',
            'name'=>'Agregar version de maquinas',
            'description'=>'Puede agregar version de maquinas',
        ]);
        Permiso::create([
            'slug'=>'version_maquinas.show',
            'name'=>'Actualizar version de maquinas',
            'description'=>'Puede actualizar todos los version de maquinas',
        ]);
        Permiso::create([
            'slug'=>'version_maquinas.destroy',
            'name'=>'Eliminar version de maquinas',
            'description'=>'Puede eliminar todos los version de maquinas',
        ]);
        Permiso::create([
            'slug'=>'version_maquinas.restore',
            'name'=>'Restablecer version de maquinas',
            'description'=>'Puede restablecer todos los version de maquinas',
        ]);
        Permiso::create([
            'slug'=>'version_maquinas.forceDestroy',
            'name'=>'Eliminar permanentemente version de maquinas',
            'description'=>'Puede eliminar permanentemente todos los version de maquinas',
        ]);

         //----------------------------Version de sim-------------------------------
         Permiso::create([
            'slug'=>'version_sims.index',
            'name'=>'Listar version del sims',
            'description'=>'Puede ver todos los version del sims',
        ]);
        Permiso::create([
            'slug'=>'version_sims.store',
            'name'=>'Agregar version del sims',
            'description'=>'Puede agregar version del sims',
        ]);
        Permiso::create([
            'slug'=>'version_sims.show',
            'name'=>'Actualizar version del sims',
            'description'=>'Puede actualizar todos los version del sims',
        ]);
        Permiso::create([
            'slug'=>'version_sims.destroy',
            'name'=>'Eliminar version del sims',
            'description'=>'Puede eliminar todos los version del sims',
        ]);
        Permiso::create([
            'slug'=>'version_sims.restore',
            'name'=>'Restablecer version del sims',
            'description'=>'Puede restablecer todos los version del sims',
        ]);
        Permiso::create([
            'slug'=>'version_sims.forceDestroy',
            'name'=>'Eliminar permanentemente version del sims',
            'description'=>'Puede eliminar permanentemente todos los version del sims',
        ]);

         //----------------------------Transportadoras-------------------------------
         Permiso::create([
            'slug'=>'transportadoras.index',
            'name'=>'Listar transportadoras',
            'description'=>'Puede ver todos los transportadoras',
        ]);
        Permiso::create([
            'slug'=>'transportadoras.store',
            'name'=>'Agregar transportadoras',
            'description'=>'Puede agregar transportadoras',
        ]);
        Permiso::create([
            'slug'=>'transportadoras.show',
            'name'=>'Actualizar transportadoras',
            'description'=>'Puede actualizar todos los transportadoras',
        ]);
        Permiso::create([
            'slug'=>'transportadoras.destroy',
            'name'=>'Eliminar transportadoras',
            'description'=>'Puede eliminar todos los transportadoras',
        ]);
        Permiso::create([
            'slug'=>'transportadoras.restore',
            'name'=>'Restablecer transportadoras',
            'description'=>'Puede restablecer todos los transportadoras',
        ]);
        Permiso::create([
            'slug'=>'transportadoras.forceDestroy',
            'name'=>'Eliminar permanentemente transportadoras',
            'description'=>'Puede eliminar permanentemente todos los transportadoras',
        ]);

         //----------------------------Tipo de servicio de los puntos-------------------------------
         Permiso::create([
            'slug'=>'tipo_servicios_puntos.index',
            'name'=>'Listar tipos de servicios',
            'description'=>'Puede ver todos los tipos de servicios',
        ]);
        Permiso::create([
            'slug'=>'tipo_servicios_puntos.store',
            'name'=>'Agregar tipos de servicios',
            'description'=>'Puede agregar tipos de servicios',
        ]);
        Permiso::create([
            'slug'=>'tipo_servicios_puntos.show',
            'name'=>'Actualizar tipos de servicios',
            'description'=>'Puede actualizar todos los tipos de servicios',
        ]);
        Permiso::create([
            'slug'=>'tipo_servicios_puntos.destroy',
            'name'=>'Eliminar tipos de servicios',
            'description'=>'Puede eliminar todos los tipos de servicios',
        ]);
        Permiso::create([
            'slug'=>'tipo_servicios_puntos.restore',
            'name'=>'Restablecer tipos de servicios',
            'description'=>'Puede restablecer todos los tipos de servicios',
        ]);
        Permiso::create([
            'slug'=>'tipo_servicios_puntos.forceDestroy',
            'name'=>'Eliminar permanentemente tipos de servicios',
            'description'=>'Puede eliminar permanentemente todos los tipos de servicios',
        ]);

         //----------------------------Tipos de lineas gprs-------------------------------
         Permiso::create([
            'slug'=>'tipo_lineas_gprs.index',
            'name'=>'Listar tipos de lineas gprs',
            'description'=>'Puede ver todos los tipos de lineas gprs',
        ]);
        Permiso::create([
            'slug'=>'tipo_lineas_gprs.store',
            'name'=>'Agregar tipos de lineas gprs',
            'description'=>'Puede agregar tipos de lineas gprs',
        ]);
        Permiso::create([
            'slug'=>'tipo_lineas_gprs.show',
            'name'=>'Actualizar tipos de lineas gprs',
            'description'=>'Puede actualizar todos los tipos de lineas gprs',
        ]);
        Permiso::create([
            'slug'=>'tipo_lineas_gprs.destroy',
            'name'=>'Eliminar tipos de lineas gprs',
            'description'=>'Puede eliminar todos los tipos de lineas gprs',
        ]);
        Permiso::create([
            'slug'=>'tipo_lineas_gprs.restore',
            'name'=>'Restablecer tipos de lineas gprs',
            'description'=>'Puede restablecer todos los tipos de lineas gprs',
        ]);
        Permiso::create([
            'slug'=>'tipo_lineas_gprs.forceDestroy',
            'name'=>'Eliminar permanentemente tipos de lineas gprs',
            'description'=>'Puede eliminar permanentemente todos los tipos de lineas gprs',
        ]);

         //----------------------------Tipo de equipo de trabajo-------------------------------
         Permiso::create([
            'slug'=>'tipo_equipos_trabajos.index',
            'name'=>'Listar tipos de equipos de trabajo',
            'description'=>'Puede ver todos los tipos de equipos de trabajo',
        ]);
        Permiso::create([
            'slug'=>'tipo_equipos_trabajos.store',
            'name'=>'Agregar tipos de equipos de trabajo',
            'description'=>'Puede agregar tipos de equipos de trabajo',
        ]);
        Permiso::create([
            'slug'=>'tipo_equipos_trabajos.show',
            'name'=>'Actualizar tipos de equipos de trabajo',
            'description'=>'Puede actualizar todos los tipos de equipos de trabajo',
        ]);
        Permiso::create([
            'slug'=>'tipo_equipos_trabajos.destroy',
            'name'=>'Eliminar tipos de equipos de trabajo',
            'description'=>'Puede eliminar todos los tipos de equipos de trabajo',
        ]);
        Permiso::create([
            'slug'=>'tipo_equipos_trabajos.restore',
            'name'=>'Restablecer tipos de equipos de trabajo',
            'description'=>'Puede restablecer todos los tipos de equipos de trabajo',
        ]);
        Permiso::create([
            'slug'=>'tipo_equipos_trabajos.forceDestroy',
            'name'=>'Eliminar permanentemente tipos de equipos de trabajo',
            'description'=>'Puede eliminar permanentemente todos los tipos de equipos de trabajo',
        ]);

         //----------------------------Tipos de conexiones-------------------------------
         Permiso::create([
            'slug'=>'tipos_conexiones.index',
            'name'=>'Listar tipos de conexiones',
            'description'=>'Puede ver todos los tipos de conexiones',
        ]);
        Permiso::create([
            'slug'=>'tipos_conexiones.store',
            'name'=>'Agregar tipos de conexiones',
            'description'=>'Puede agregar tipos de conexiones',
        ]);
        Permiso::create([
            'slug'=>'tipos_conexiones.show',
            'name'=>'Actualizar tipos de conexiones',
            'description'=>'Puede actualizar todos los tipos de conexiones',
        ]);
        Permiso::create([
            'slug'=>'tipos_conexiones.destroy',
            'name'=>'Eliminar tipos de conexiones',
            'description'=>'Puede eliminar todos los tipos de conexiones',
        ]);
        Permiso::create([
            'slug'=>'tipos_conexiones.restore',
            'name'=>'Restablecer tipos de conexiones',
            'description'=>'Puede restablecer todos los tipos de conexiones',
        ]);
        Permiso::create([
            'slug'=>'tipos_conexiones.forceDestroy',
            'name'=>'Eliminar permanentemente tipos de conexiones',
            'description'=>'Puede eliminar permanentemente todos los tipos de conexiones',
        ]);

         //----------------------------Sistemas operativos-------------------------------
         Permiso::create([
            'slug'=>'sistemas_operativos.index',
            'name'=>'Listar sistemas operativos',
            'description'=>'Puede ver todos los sistemas operativos',
        ]);
        Permiso::create([
            'slug'=>'sistemas_operativos.store',
            'name'=>'Agregar sistemas operativos',
            'description'=>'Puede agregar sistemas operativos',
        ]);
        Permiso::create([
            'slug'=>'sistemas_operativos.show',
            'name'=>'Actualizar sistemas operativos',
            'description'=>'Puede actualizar todos los sistemas operativos',
        ]);
        Permiso::create([
            'slug'=>'sistemas_operativos.destroy',
            'name'=>'Eliminar sistemas operativos',
            'description'=>'Puede eliminar todos los sistemas operativos',
        ]);
        Permiso::create([
            'slug'=>'sistemas_operativos.restore',
            'name'=>'Restablecer sistemas operativos',
            'description'=>'Puede restablecer todos los sistemas operativos',
        ]);
        Permiso::create([
            'slug'=>'sistemas_operativos.forceDestroy',
            'name'=>'Eliminar permanentemente sistemas operativos',
            'description'=>'Puede eliminar permanentemente todos los sistemas operativos',
        ]);

         //----------------------------Poblaciones-------------------------------
         Permiso::create([
            'slug'=>'poblaciones.index',
            'name'=>'Listar poblaciones',
            'description'=>'Puede ver todos los poblaciones',
        ]);
        Permiso::create([
            'slug'=>'poblaciones.store',
            'name'=>'Agregar poblaciones',
            'description'=>'Puede agregar poblaciones',
        ]);
        Permiso::create([
            'slug'=>'poblaciones.show',
            'name'=>'Actualizar poblaciones',
            'description'=>'Puede actualizar todos los poblaciones',
        ]);
        Permiso::create([
            'slug'=>'poblaciones.destroy',
            'name'=>'Eliminar poblaciones',
            'description'=>'Puede eliminar todos los poblaciones',
        ]);
        Permiso::create([
            'slug'=>'poblaciones.restore',
            'name'=>'Restablecer poblaciones',
            'description'=>'Puede restablecer todos los poblaciones',
        ]);
        Permiso::create([
            'slug'=>'poblaciones.forceDestroy',
            'name'=>'Eliminar permanentemente poblaciones',
            'description'=>'Puede eliminar permanentemente todos los poblaciones',
        ]);

         //----------------------------Reportes de señal-------------------------------
         Permiso::create([
            'slug'=>'reporte_senal.index',
            'name'=>'Listar reportes de señal',
            'description'=>'Puede ver todos los reportes de señal',
        ]);
        Permiso::create([
            'slug'=>'reporte_senal.store',
            'name'=>'Agregar reportes de señal',
            'description'=>'Puede agregar reportes de señal',
        ]);
        Permiso::create([
            'slug'=>'reporte_senal.show',
            'name'=>'Actualizar reportes de señal',
            'description'=>'Puede actualizar todos los reportes de señal',
        ]);
        Permiso::create([
            'slug'=>'reporte_senal.destroy',
            'name'=>'Eliminar reportes de señal',
            'description'=>'Puede eliminar todos los reportes de señal',
        ]);
        Permiso::create([
            'slug'=>'reporte_senal.restore',
            'name'=>'Restablecer reportes de señal',
            'description'=>'Puede restablecer todos los reportes de señal',
        ]);
        Permiso::create([
            'slug'=>'reporte_senal.forceDestroy',
            'name'=>'Eliminar permanentemente reportes de señal',
            'description'=>'Puede eliminar permanentemente todos los reportes de señal',
        ]);

         //----------------------------Operadores tecnologicos-------------------------------
         Permiso::create([
            'slug'=>'operador_tecnologicos.index',
            'name'=>'Listar operadores tecnologicos',
            'description'=>'Puede ver todos los operadores tecnologicos',
        ]);
        Permiso::create([
            'slug'=>'operador_tecnologicos.store',
            'name'=>'Agregar operadores tecnologicos',
            'description'=>'Puede agregar operadores tecnologicos',
        ]);
        Permiso::create([
            'slug'=>'operador_tecnologicos.show',
            'name'=>'Actualizar operadores tecnologicos',
            'description'=>'Puede actualizar todos los operadores tecnologicos',
        ]);
        Permiso::create([
            'slug'=>'operador_tecnologicos.destroy',
            'name'=>'Eliminar operadores tecnologicos',
            'description'=>'Puede eliminar todos los operadores tecnologicos',
        ]);
        Permiso::create([
            'slug'=>'operador_tecnologicos.restore',
            'name'=>'Restablecer operadores tecnologicos',
            'description'=>'Puede restablecer todos los operadores tecnologicos',
        ]);
        Permiso::create([
            'slug'=>'operador_tecnologicos.forceDestroy',
            'name'=>'Eliminar permanentemente operadores tecnologicos',
            'description'=>'Puede eliminar permanentemente todos los operadores tecnologicos',
        ]);

         //----------------------------Fallas administrativas-------------------------------
         Permiso::create([
            'slug'=>'reporte_falla_administrativa.index',
            'name'=>'Listar reportes de fallas administrativas',
            'description'=>'Puede ver todos los reportes de fallas administrativas',
        ]);
        Permiso::create([
            'slug'=>'reporte_falla_administrativa.store',
            'name'=>'Agregar reportes de fallas administrativas',
            'description'=>'Puede agregar reportes de fallas administrativas',
        ]);
        Permiso::create([
            'slug'=>'reporte_falla_administrativa.show',
            'name'=>'Actualizar reportes de fallas administrativas',
            'description'=>'Puede actualizar todos los reportes de fallas administrativas',
        ]);
        Permiso::create([
            'slug'=>'reporte_falla_administrativa.destroy',
            'name'=>'Eliminar reportes de fallas administrativas',
            'description'=>'Puede eliminar todos los reportes de fallas administrativas',
        ]);
        Permiso::create([
            'slug'=>'reporte_falla_administrativa.restore',
            'name'=>'Restablecer reportes de fallas administrativas',
            'description'=>'Puede restablecer todos los reportes de fallas administrativas',
        ]);
        Permiso::create([
            'slug'=>'reporte_falla_administrativa.forceDestroy',
            'name'=>'Eliminar permanentemente reportes de fallas administrativas',
            'description'=>'Puede eliminar permanentemente todos los reportes de fallas administrativas',
        ]);

         //----------------------------Recepcion central-------------------------------
         Permiso::create([
            'slug'=>'recepcion_central.index',
            'name'=>'Listar recepcion central',
            'description'=>'Puede ver todos los recepcion central',
        ]);
        Permiso::create([
            'slug'=>'recepcion_central.store',
            'name'=>'Agregar recepcion central',
            'description'=>'Puede agregar recepcion central',
        ]);
        Permiso::create([
            'slug'=>'recepcion_central.show',
            'name'=>'Actualizar recepcion central',
            'description'=>'Puede actualizar todos los recepcion central',
        ]);
        Permiso::create([
            'slug'=>'recepcion_central.destroy',
            'name'=>'Eliminar recepcion central',
            'description'=>'Puede eliminar todos los recepcion central',
        ]);
        Permiso::create([
            'slug'=>'recepcion_central.restore',
            'name'=>'Restablecer recepcion central',
            'description'=>'Puede restablecer todos los recepcion central',
        ]);
        Permiso::create([
            'slug'=>'recepcion_central.forceDestroy',
            'name'=>'Eliminar permanentemente recepcion central',
            'description'=>'Puede eliminar permanentemente todos los recepcion central',
        ]);

         //----------------------------Puntos de oficinas-------------------------------
         Permiso::create([
            'slug'=>'puntos_oficina.index',
            'name'=>'Listar puntos de oficinas',
            'description'=>'Puede ver todos los puntos de oficinas',
        ]);
        Permiso::create([
            'slug'=>'puntos_oficina.store',
            'name'=>'Agregar puntos de oficinas',
            'description'=>'Puede agregar puntos de oficinas',
        ]);
        Permiso::create([
            'slug'=>'puntos_oficina.show',
            'name'=>'Actualizar puntos de oficinas',
            'description'=>'Puede actualizar todos los puntos de oficinas',
        ]);
        Permiso::create([
            'slug'=>'puntos_oficina.destroy',
            'name'=>'Eliminar puntos de oficinas',
            'description'=>'Puede eliminar todos los puntos de oficinas',
        ]);
        Permiso::create([
            'slug'=>'puntos_oficina.restore',
            'name'=>'Restablecer puntos de oficinas',
            'description'=>'Puede restablecer todos los puntos de oficinas',
        ]);
        Permiso::create([
            'slug'=>'puntos_oficina.forceDestroy',
            'name'=>'Eliminar permanentemente puntos de oficinas',
            'description'=>'Puede eliminar permanentemente todos los puntos de oficinas',
        ]);

         //----------------------------Procesos-------------------------------
         Permiso::create([
            'slug'=>'procesos.index',
            'name'=>'Listar procesos',
            'description'=>'Puede ver todos los procesos',
        ]);
        Permiso::create([
            'slug'=>'procesos.store',
            'name'=>'Agregar procesos',
            'description'=>'Puede agregar procesos',
        ]);
        Permiso::create([
            'slug'=>'procesos.show',
            'name'=>'Actualizar procesos',
            'description'=>'Puede actualizar todos los procesos',
        ]);
        Permiso::create([
            'slug'=>'procesos.destroy',
            'name'=>'Eliminar procesos',
            'description'=>'Puede eliminar todos los procesos',
        ]);
        Permiso::create([
            'slug'=>'procesos.restore',
            'name'=>'Restablecer procesos',
            'description'=>'Puede restablecer todos los procesos',
        ]);
        Permiso::create([
            'slug'=>'procesos.forceDestroy',
            'name'=>'Eliminar permanentemente procesos',
            'description'=>'Puede eliminar permanentemente todos los procesos',
        ]);

         //----------------------------Operadores de simcard-------------------------------
         Permiso::create([
            'slug'=>'operador_simcard.index',
            'name'=>'Listar operadores de simcard',
            'description'=>'Puede ver todos los operadores de simcard',
        ]);
        Permiso::create([
            'slug'=>'operador_simcard.store',
            'name'=>'Agregar operadores de simcard',
            'description'=>'Puede agregar operadores de simcard',
        ]);
        Permiso::create([
            'slug'=>'operador_simcard.show',
            'name'=>'Actualizar operadores de simcard',
            'description'=>'Puede actualizar todos los operadores de simcard',
        ]);
        Permiso::create([
            'slug'=>'operador_simcard.destroy',
            'name'=>'Eliminar operadores de simcard',
            'description'=>'Puede eliminar todos los operadores de simcard',
        ]);
        Permiso::create([
            'slug'=>'operador_simcard.restore',
            'name'=>'Restablecer operadores de simcard',
            'description'=>'Puede restablecer todos los operadores de simcard',
        ]);
        Permiso::create([
            'slug'=>'operador_simcard.forceDestroy',
            'name'=>'Eliminar permanentemente operadores de simcard',
            'description'=>'Puede eliminar permanentemente todos los operadores de simcard',
        ]);

         //----------------------------operadores satelitales-------------------------------
         Permiso::create([
            'slug'=>'operador_satelitales.index',
            'name'=>'Listar operadores satelitales',
            'description'=>'Puede ver todos los operadores satelitales',
        ]);
        Permiso::create([
            'slug'=>'operador_satelitales.store',
            'name'=>'Agregar operadores satelitales',
            'description'=>'Puede agregar operadores satelitales',
        ]);
        Permiso::create([
            'slug'=>'operador_satelitales.show',
            'name'=>'Actualizar operadores satelitales',
            'description'=>'Puede actualizar todos los operadores satelitales',
        ]);
        Permiso::create([
            'slug'=>'operador_satelitales.destroy',
            'name'=>'Eliminar operadores satelitales',
            'description'=>'Puede eliminar todos los operadores satelitales',
        ]);
        Permiso::create([
            'slug'=>'operador_satelitales.restore',
            'name'=>'Restablecer operadores satelitales',
            'description'=>'Puede restablecer todos los operadores satelitales',
        ]);
        Permiso::create([
            'slug'=>'operador_satelitales.forceDestroy',
            'name'=>'Eliminar permanentemente operadores satelitales',
            'description'=>'Puede eliminar permanentemente todos los operadores satelitales',
        ]);

         //----------------------------Modelo de maquinas-------------------------------
         Permiso::create([
            'slug'=>'modelo_maquinas.index',
            'name'=>'Listar modelo de maquinas',
            'description'=>'Puede ver todos los modelo de maquinas',
        ]);
        Permiso::create([
            'slug'=>'modelo_maquinas.store',
            'name'=>'Agregar modelo de maquinas',
            'description'=>'Puede agregar modelo de maquinas',
        ]);
        Permiso::create([
            'slug'=>'modelo_maquinas.show',
            'name'=>'Actualizar modelo de maquinas',
            'description'=>'Puede actualizar todos los modelo de maquinas',
        ]);
        Permiso::create([
            'slug'=>'modelo_maquinas.destroy',
            'name'=>'Eliminar modelo de maquinas',
            'description'=>'Puede eliminar todos los modelo de maquinas',
        ]);
        Permiso::create([
            'slug'=>'modelo_maquinas.restore',
            'name'=>'Restablecer modelo de maquinas',
            'description'=>'Puede restablecer todos los modelo de maquinas',
        ]);
        Permiso::create([
            'slug'=>'modelo_maquinas.forceDestroy',
            'name'=>'Eliminar permanentemente modelo de maquinas',
            'description'=>'Puede eliminar permanentemente todos los modelo de maquinas',
        ]);

         //----------------------------Memoria ram-------------------------------
         Permiso::create([
            'slug'=>'memorias_rams.index',
            'name'=>'Listar memorias ram',
            'description'=>'Puede ver todos los memorias ram',
        ]);
        Permiso::create([
            'slug'=>'memorias_rams.store',
            'name'=>'Agregar memorias ram',
            'description'=>'Puede agregar memorias ram',
        ]);
        Permiso::create([
            'slug'=>'memorias_rams.show',
            'name'=>'Actualizar memorias ram',
            'description'=>'Puede actualizar todos los memorias ram',
        ]);
        Permiso::create([
            'slug'=>'memorias_rams.destroy',
            'name'=>'Eliminar memorias ram',
            'description'=>'Puede eliminar todos los memorias ram',
        ]);
        Permiso::create([
            'slug'=>'memorias_rams.restore',
            'name'=>'Restablecer memorias ram',
            'description'=>'Puede restablecer todos los memorias ram',
        ]);
        Permiso::create([
            'slug'=>'memorias_rams.forceDestroy',
            'name'=>'Eliminar permanentemente memorias ram',
            'description'=>'Puede eliminar permanentemente todos los memorias ram',
        ]);

         //----------------------------Marcas equipos-------------------------------
         Permiso::create([
            'slug'=>'mascas_equipos.index',
            'name'=>'Listar marcas de equipos',
            'description'=>'Puede ver todos los marcas de equipos',
        ]);
        Permiso::create([
            'slug'=>'mascas_equipos.store',
            'name'=>'Agregar marcas de equipos',
            'description'=>'Puede agregar marcas de equipos',
        ]);
        Permiso::create([
            'slug'=>'mascas_equipos.show',
            'name'=>'Actualizar marcas de equipos',
            'description'=>'Puede actualizar todos los marcas de equipos',
        ]);
        Permiso::create([
            'slug'=>'mascas_equipos.destroy',
            'name'=>'Eliminar marcas de equipos',
            'description'=>'Puede eliminar todos los marcas de equipos',
        ]);
        Permiso::create([
            'slug'=>'mascas_equipos.restore',
            'name'=>'Restablecer marcas de equipos',
            'description'=>'Puede restablecer todos los marcas de equipos',
        ]);
        Permiso::create([
            'slug'=>'mascas_equipos.forceDestroy',
            'name'=>'Eliminar permanentemente marcas de equipos',
            'description'=>'Puede eliminar permanentemente todos los marcas de equipos',
        ]);

         //----------------------------Marcas impresoras-------------------------------
         Permiso::create([
            'slug'=>'marcas_impresoras.index',
            'name'=>'Listar estados',
            'description'=>'Puede ver todos los estados',
        ]);
        Permiso::create([
            'slug'=>'marcas_impresoras.store',
            'name'=>'Agregar estados',
            'description'=>'Puede agregar estados',
        ]);
        Permiso::create([
            'slug'=>'marcas_impresoras.show',
            'name'=>'Actualizar estados',
            'description'=>'Puede actualizar todos los estados',
        ]);
        Permiso::create([
            'slug'=>'marcas_impresoras.destroy',
            'name'=>'Eliminar estados',
            'description'=>'Puede eliminar todos los estados',
        ]);
        Permiso::create([
            'slug'=>'marcas_impresoras.restore',
            'name'=>'Restablecer estados',
            'description'=>'Puede restablecer todos los estados',
        ]);
        Permiso::create([
            'slug'=>'marcas_impresoras.forceDestroy',
            'name'=>'Eliminar permanentemente estados',
            'description'=>'Puede eliminar permanentemente todos los estados',
        ]);

         //----------------------------Marcas monitores-------------------------------
         Permiso::create([
            'slug'=>'marcas_monitores.index',
            'name'=>'Listar marcas de monitores',
            'description'=>'Puede ver todos los marcas de monitores',
        ]);
        Permiso::create([
            'slug'=>'marcas_monitores.store',
            'name'=>'Agregar marcas de monitores',
            'description'=>'Puede agregar marcas de monitores',
        ]);
        Permiso::create([
            'slug'=>'marcas_monitores.show',
            'name'=>'Actualizar marcas de monitores',
            'description'=>'Puede actualizar todos los marcas de monitores',
        ]);
        Permiso::create([
            'slug'=>'marcas_monitores.destroy',
            'name'=>'Eliminar marcas de monitores',
            'description'=>'Puede eliminar todos los marcas de monitores',
        ]);
        Permiso::create([
            'slug'=>'marcas_monitores.restore',
            'name'=>'Restablecer marcas de monitores',
            'description'=>'Puede restablecer todos los marcas de monitores',
        ]);
        Permiso::create([
            'slug'=>'marcas_monitores.forceDestroy',
            'name'=>'Eliminar permanentemente marcas de monitores',
            'description'=>'Puede eliminar permanentemente todos los marcas de monitores',
        ]);

         //----------------------------Marcas dvr-------------------------------
         Permiso::create([
            'slug'=>'marcas_dvrs.index',
            'name'=>'Listar marcas de dvrs',
            'description'=>'Puede ver todos los marcas de dvrs',
        ]);
        Permiso::create([
            'slug'=>'marcas_dvrs.store',
            'name'=>'Agregar marcas de dvrs',
            'description'=>'Puede agregar marcas de dvrs',
        ]);
        Permiso::create([
            'slug'=>'marcas_dvrs.show',
            'name'=>'Actualizar marcas de dvrs',
            'description'=>'Puede actualizar todos los marcas de dvrs',
        ]);
        Permiso::create([
            'slug'=>'marcas_dvrs.destroy',
            'name'=>'Eliminar marcas de dvrs',
            'description'=>'Puede eliminar todos los marcas de dvrs',
        ]);
        Permiso::create([
            'slug'=>'marcas_dvrs.restore',
            'name'=>'Restablecer marcas de dvrs',
            'description'=>'Puede restablecer todos los marcas de dvrs',
        ]);
        Permiso::create([
            'slug'=>'marcas_dvrs.forceDestroy',
            'name'=>'Eliminar permanentemente marcas de dvrs',
            'description'=>'Puede eliminar permanentemente todos los marcas de dvrs',
        ]);

         //----------------------------Centro de costos-------------------------------
         Permiso::create([
            'slug'=>'centros_costos.index',
            'name'=>'Listar centros de costos',
            'description'=>'Puede ver todos los centros de costos',
        ]);
        Permiso::create([
            'slug'=>'centros_costos.store',
            'name'=>'Agregar centros de costos',
            'description'=>'Puede agregar centros de costos',
        ]);
        Permiso::create([
            'slug'=>'centros_costos.show',
            'name'=>'Actualizar centros de costos',
            'description'=>'Puede actualizar todos los centros de costos',
        ]);
        Permiso::create([
            'slug'=>'centros_costos.destroy',
            'name'=>'Eliminar centros de costos',
            'description'=>'Puede eliminar todos los centros de costos',
        ]);
        Permiso::create([
            'slug'=>'centros_costos.restore',
            'name'=>'Restablecer centros de costos',
            'description'=>'Puede restablecer todos los centros de costos',
        ]);
        Permiso::create([
            'slug'=>'centros_costos.forceDestroy',
            'name'=>'Eliminar permanentemente centros de costos',
            'description'=>'Puede eliminar permanentemente todos los centros de costos',
        ]);

         //----------------------------Inventario de maquinas-------------------------------
         Permiso::create([
            'slug'=>'inventario_maquinas.index',
            'name'=>'Listar inventarios de maquinas',
            'description'=>'Puede ver todos los inventarios de maquinas',
        ]);
        Permiso::create([
            'slug'=>'inventario_maquinas.store',
            'name'=>'Agregar inventarios de maquinas',
            'description'=>'Puede agregar inventarios de maquinas',
        ]);
        Permiso::create([
            'slug'=>'inventario_maquinas.show',
            'name'=>'Actualizar inventarios de maquinas',
            'description'=>'Puede actualizar todos los inventarios de maquinas',
        ]);
        Permiso::create([
            'slug'=>'inventario_maquinas.destroy',
            'name'=>'Eliminar inventarios de maquinas',
            'description'=>'Puede eliminar todos los inventarios de maquinas',
        ]);
        Permiso::create([
            'slug'=>'inventario_maquinas.restore',
            'name'=>'Restablecer inventarios de maquinas',
            'description'=>'Puede restablecer todos los inventarios de maquinas',
        ]);
        Permiso::create([
            'slug'=>'inventario_maquinas.forceDestroy',
            'name'=>'Eliminar permanentemente inventarios de maquinas',
            'description'=>'Puede eliminar permanentemente todos los inventarios de maquinas',
        ]);

         //----------------------------Lineas moviles-------------------------------
         Permiso::create([
            'slug'=>'lineas_moviles.index',
            'name'=>'Listar lineas moviles',
            'description'=>'Puede ver todos los lineas moviles',
        ]);
        Permiso::create([
            'slug'=>'lineas_moviles.store',
            'name'=>'Agregar lineas moviles',
            'description'=>'Puede agregar lineas moviles',
        ]);
        Permiso::create([
            'slug'=>'lineas_moviles.show',
            'name'=>'Actualizar lineas moviles',
            'description'=>'Puede actualizar todos los lineas moviles',
        ]);
        Permiso::create([
            'slug'=>'lineas_moviles.destroy',
            'name'=>'Eliminar lineas moviles',
            'description'=>'Puede eliminar todos los lineas moviles',
        ]);
        Permiso::create([
            'slug'=>'lineas_moviles.restore',
            'name'=>'Restablecer lineas moviles',
            'description'=>'Puede restablecer todos los lineas moviles',
        ]);
        Permiso::create([
            'slug'=>'lineas_moviles.forceDestroy',
            'name'=>'Eliminar permanentemente lineas moviles',
            'description'=>'Puede eliminar permanentemente todos los lineas moviles',
        ]);

         //----------------------------Inventario de equipos-------------------------------
         Permiso::create([
            'slug'=>'inventario_equipos.index',
            'name'=>'Listar inventario de equipos',
            'description'=>'Puede ver todos los inventario de equipos',
        ]);
        Permiso::create([
            'slug'=>'inventario_equipos.store',
            'name'=>'Agregar inventario de equipos',
            'description'=>'Puede agregar inventario de equipos',
        ]);
        Permiso::create([
            'slug'=>'inventario_equipos.show',
            'name'=>'Actualizar inventario de equipos',
            'description'=>'Puede actualizar todos los inventario de equipos',
        ]);
        Permiso::create([
            'slug'=>'inventario_equipos.destroy',
            'name'=>'Eliminar inventario de equipos',
            'description'=>'Puede eliminar todos los inventario de equipos',
        ]);
        Permiso::create([
            'slug'=>'inventario_equipos.restore',
            'name'=>'Restablecer inventario de equipos',
            'description'=>'Puede restablecer todos los inventario de equipos',
        ]);
        Permiso::create([
            'slug'=>'inventario_equipos.forceDestroy',
            'name'=>'Eliminar permanentemente inventario de equipos',
            'description'=>'Puede eliminar permanentemente todos los inventario de equipos',
        ]);

         //----------------------------Inventario de camaras-------------------------------
         Permiso::create([
            'slug'=>'inventario_camaras.index',
            'name'=>'Listar inventario de camaras',
            'description'=>'Puede ver todos los inventario de camaras',
        ]);
        Permiso::create([
            'slug'=>'inventario_camaras.store',
            'name'=>'Agregar inventario de camaras',
            'description'=>'Puede agregar inventario de camaras',
        ]);
        Permiso::create([
            'slug'=>'inventario_camaras.show',
            'name'=>'Actualizar inventario de camaras',
            'description'=>'Puede actualizar todos los inventario de camaras',
        ]);
        Permiso::create([
            'slug'=>'inventario_camaras.destroy',
            'name'=>'Eliminar inventario de camaras',
            'description'=>'Puede eliminar todos los inventario de camaras',
        ]);
        Permiso::create([
            'slug'=>'inventario_camaras.restore',
            'name'=>'Restablecer inventario de camaras',
            'description'=>'Puede restablecer todos los inventario de camaras',
        ]);
        Permiso::create([
            'slug'=>'inventario_camaras.forceDestroy',
            'name'=>'Eliminar permanentemente inventario de camaras',
            'description'=>'Puede eliminar permanentemente todos los inventario de camaras',
        ]);

         //----------------------------Actualizacion del posslim-------------------------------
         Permiso::create([
            'slug'=>'actualizacion_posslim.index',
            'name'=>'Listar actualizacion del posslim',
            'description'=>'Puede ver todos los actualizacion del posslim',
        ]);
        Permiso::create([
            'slug'=>'actualizacion_posslim.store',
            'name'=>'Agregar actualizacion del posslim',
            'description'=>'Puede agregar actualizacion del posslim',
        ]);
        Permiso::create([
            'slug'=>'actualizacion_posslim.show',
            'name'=>'Actualizar actualizacion del posslim',
            'description'=>'Puede actualizar todos los actualizacion del posslim',
        ]);
        Permiso::create([
            'slug'=>'actualizacion_posslim.destroy',
            'name'=>'Eliminar actualizacion del posslim',
            'description'=>'Puede eliminar todos los actualizacion del posslim',
        ]);
        Permiso::create([
            'slug'=>'actualizacion_posslim.restore',
            'name'=>'Restablecer actualizacion del posslim',
            'description'=>'Puede restablecer todos los actualizacion del posslim',
        ]);
        Permiso::create([
            'slug'=>'actualizacion_posslim.forceDestroy',
            'name'=>'Eliminar permanentemente actualizacion del posslim',
            'description'=>'Puede eliminar permanentemente todos los actualizacion del posslim',
        ]);

         //----------------------------Estados-------------------------------
         Permiso::create([
            'slug'=>'validacion_antenas.index',
            'name'=>'Listar validacion de antenas',
            'description'=>'Puede ver todos los validacion de antenas',
        ]);
        Permiso::create([
            'slug'=>'validacion_antenas.store',
            'name'=>'Agregar validacion de antenas',
            'description'=>'Puede agregar validacion de antenas',
        ]);
        Permiso::create([
            'slug'=>'validacion_antenas.show',
            'name'=>'Actualizar validacion de antenas',
            'description'=>'Puede actualizar todos los validacion de antenas',
        ]);
        Permiso::create([
            'slug'=>'validacion_antenas.destroy',
            'name'=>'Eliminar validacion de antenas',
            'description'=>'Puede eliminar todos los validacion de antenas',
        ]);
        Permiso::create([
            'slug'=>'validacion_antenas.restore',
            'name'=>'Restablecer validacion de antenas',
            'description'=>'Puede restablecer todos los validacion de antenas',
        ]);
        Permiso::create([
            'slug'=>'validacion_antenas.forceDestroy',
            'name'=>'Eliminar permanentemente validacion de antenas',
            'description'=>'Puede eliminar permanentemente todos los validacion de antenas',
        ]);


         //----------------------------Exportaciones-------------------------------
         Permiso::create([
            'slug'=>'lineas_moviles.export',
            'name'=>'Exportar lineas moviles',
            'description'=>'Puede generar reportes de las lineas moviles',
        ]);

        Permiso::create([
            'slug'=>'inventario_maquinas.export',
            'name'=>'Exportar inventario de maquinas',
            'description'=>'Puede generar reportes de las inventario de maquinas',
        ]);

        Permiso::create([
            'slug'=>'actualizacion_posslim.export',
            'name'=>'Exportar actualizacion del posslim',
            'description'=>'Puede generar reportes de las actualizacion del posslim',
        ]);

        Permiso::create([
            'slug'=>'inventario_camaras.export',
            'name'=>'Exportar inventario de camaras',
            'description'=>'Puede generar reportes de las inventario de camaras',
        ]);

        Permiso::create([
            'slug'=>'recepcion_central.export',
            'name'=>'Exportar recepcion central',
            'description'=>'Puede generar reportes de las recepcion central',
        ]);

        Permiso::create([
            'slug'=>'validacion_antenas.export',
            'name'=>'Exportar validacion de antenas',
            'description'=>'Puede generar reportes de las validacion de antenas',
        ]);
    }
}
