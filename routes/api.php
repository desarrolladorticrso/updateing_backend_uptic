<?php

use App\Http\Controllers\ActualizacionPosslimController;
use Illuminate\Http\Request;
use App\Http\Controllers\ApnController;
use App\Http\Controllers\LiderController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\AsesorController;
use App\Http\Controllers\CentroCostoController;
use App\Http\Controllers\MemoriaRamController;
use App\Http\Controllers\DiscosDuroController;
use App\Http\Controllers\MarcaEquipoController;
use App\Http\Controllers\LineaMovileController;
use App\Http\Controllers\MarcaMonitorController;
use App\Http\Controllers\MarcaTecladoController;
use App\Http\Controllers\EntregaTurnosController;
use App\Http\Controllers\InventarioCamaraController;
use App\Http\Controllers\ModeloMaquinaController;
use App\Http\Controllers\MarcaImpresoraController;
use App\Http\Controllers\InventarioEquiposController;
use App\Http\Controllers\InventarioMaquinaController;
use App\Http\Controllers\MarcaDvrController;
use App\Http\Controllers\MarcaMauseController;
use App\Http\Controllers\OperadorSatelitalController;
use App\Http\Controllers\OperadorSimcardController;
use App\Http\Controllers\OperadorTecnologicoController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\PoblacionController;
use App\Http\Controllers\ProcesoController;
use App\Http\Controllers\PuntosOficinasController;
use App\Http\Controllers\RecepcionCentralController;
use App\Http\Controllers\ReporteSenalController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\SistemaOperativoController;
use App\Http\Controllers\TipoConexionController;
use App\Http\Controllers\TipoEquipoTrabajoController;
use App\Http\Controllers\TipoLineaGprsController;
use App\Http\Controllers\TipoServicioPuntoController;
use App\Http\Controllers\TransportadoraController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VersionMaquinaController;
use App\Http\Controllers\VersionPosslimController;
use App\Http\Controllers\VersionSimsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReporteFallasAbministrativasController;
use App\Http\Controllers\ValidacionAntenaController;
use App\Http\Controllers\VpnController;
use App\Models\InventarioMaquina;
use Illuminate\Support\Facades\DB;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::controller(UserController::class)->group(function(){
    Route::post('/login','login');
    Route::post('/user','register');
});

Route::middleware('auth:sanctum')->group(function(){

    Route::controller(UserController::class)->group(function(){
        Route::post('/logout','logout');
    });

    Route::controller(RolController::class)->group(function(){
        Route::get('/roles/listar','index')->name('roles.index');
        Route::get('/roles/all','all')->name('roles.all');
        Route::post('/role','store')->name('roles.store');
        Route::get('/role/{role}','show')->name('roles.show');
        Route::put('/role/{role}','update')->name('roles.update');
        Route::post('/role/{role}','destroy')->name('roles.destroy');
        Route::post('/role/restore/{role}','restore')->name('roles.restore');
        Route::delete('/role/{role}','forceDestroy')->name('roles.forceDestroy');
    });

    Route::controller(PermisoController::class)->group(function(){
        Route::get('/permissions/listar', 'index')->name('permission.index');
        Route::get('/permission/{permission}', 'show')->name('permission.show');
        Route::put('/permission/{permission}', 'update')->name('permission.update');
        Route::post('/permission', 'store')->name('permission.store');
        Route::post('/permission/{permission}', 'destroy')->name('permission.destroy');
        Route::post('/permission/restore/{permission}', 'restore')->name('permission.restore');
        Route::delete('/permission/{permission}', 'forceDestroy')->name('permission.forceDestroy');
    });

    Route::controller(UserController::class)->group(function(){
        Route::get('/users/listar', 'index')->name('user.index');
        Route::get('/users/all', 'all')->name('user.all');
        Route::get('/user/{user}', 'show')->name('user.show');
        Route::put('/user/{user}', 'update')->name('user.update');
        Route::post('/user', 'store')->name('user.store');
        Route::post('/user/{user}', 'destroy')->name('user.destroy');
        Route::post('/user/restore/{user}', 'restore')->name('user.restore');
        Route::delete('/user/{user}', 'forceDestroy')->name('user.forceDestroy');
        Route::put('/user/update-profile/{user}', 'updatePrifle')->name('update.profile');
        Route::put('/user/update-password/{user}', 'updatePassword')->name('update.password');
    });

    Route::controller(DiscosDuroController::class)->group(function(){
        Route::get('/discos-duros/listar', 'index')->name('discos_duro.index');
        Route::get('/discos-duros/all', 'all')->name('discos_duro.all');
        Route::get('/disco-duro/{disco_duro}', 'show')->name('discos_duro.show');
        Route::put('/disco-duro/{disco_duro}', 'update')->name('discos_duro.update');
        Route::post('/disco-duro', 'store')->name('discos_duro.store');
        Route::post('/disco-duro/{disco_duro}', 'destroy')->name('discos_duro.destroy');
        Route::post('/disco-duro/restore/{disco_duro}', 'restore')->name('discos_duro.restore');
        Route::delete('/disco-duro/{disco_duro}', 'forceDestroy')->name('discos_duro.forceDestroy');
    });

    Route::controller(AsesorController::class)->group(function(){
        Route::get('/asesores/listar', 'index')->name('asesor.index');
        Route::get('/asesores/all', 'all')->name('asesor.all');
        Route::get('/asesor/{asesor}', 'show')->name('asesor.show');
        Route::put('/asesor/{asesor}', 'update')->name('asesor.update');
        Route::post('/asesor', 'store')->name('asesor.store');
        Route::post('/asesor/{asesor}', 'destroy')->name('asesor.destroy');
        Route::post('/asesor/restore/{asesor}', 'restore')->name('asesor.restore');
        Route::delete('/asesor/{asesor}', 'forceDestroy')->name('asesor.forceDestroy');
    });

    Route::controller(LiderController::class)->group(function(){
        Route::get('/lideres/listar', 'index')->name('lider.index');
        Route::get('/lideres/all', 'all')->name('lider.all');
        Route::get('/lider/{lider}', 'show')->name('lider.show');
        Route::put('/lider/{lider}', 'update')->name('lider.update');
        Route::post('/lider', 'store')->name('lider.store');
        Route::post('/lider/{lider}', 'destroy')->name('lider.destroy');
        Route::post('/lider/restore/{lider}', 'restore')->name('lider.restore');
        Route::delete('/lider/{lider}', 'forceDestroy')->name('lider.forceDestroy');
    });

    Route::controller(ApnController::class)->group(function(){
        Route::get('/apns/listar', 'index')->name('apns.index');
        Route::get('/apns/all', 'all')->name('apns.all');
        Route::get('/apn/{apn}', 'show')->name('apns.show');
        Route::put('/apn/{apn}', 'update')->name('apns.update');
        Route::post('/apn', 'store')->name('apns.store');
        Route::post('/apn/{apn}', 'destroy')->name('apns.destroy');
        Route::post('/apn/restore/{apn}', 'restore')->name('apns.restore');
        Route::delete('/apn/{apn}', 'forceDestroy')->name('apns.forceDestroy');
    });

    Route::controller(VpnController::class)->group(function(){
        Route::get('/vpns/listar', 'index')->name('vpns.index');
        Route::get('/vpns/all', 'all')->name('vpns.all');
        Route::get('/vpn/{vpn}', 'show')->name('vpns.show');
        Route::put('/vpn/{vpn}', 'update')->name('vpns.update');
        Route::post('/vpn', 'store')->name('vpns.store');
        Route::post('/vpn/{vpn}', 'destroy')->name('vpns.destroy');
        Route::post('/vpn/restore/{vpn}', 'restore')->name('vpns.restore');
        Route::delete('/vpn/{vpn}', 'forceDestroy')->name('vpns.forceDestroy');
    });

    Route::controller(EntregaTurnosController::class)->group(function(){
        Route::get('/entrega-turnos/listar', 'index')->name('entrega_turnos.index');
        Route::get('/entrega-turno/{entrega_turno}', 'show')->name('entrega_turnos.show');
        Route::put('/entrega-turno/{entrega_turno}', 'update')->name('entrega_turnos.update');
        Route::post('/entrega-turno', 'store')->name('entrega_turnos.store');
        Route::post('/entrega-turno/{entrega_turno}', 'destroy')->name('entrega_turnos.destroy');
        Route::post('/entrega-turno/restore/{entrega_turno}', 'restore')->name('entrega_turnos.restore');
        Route::delete('/entrega-turno/{entrega_turno}', 'forceDestroy')->name('entrega_turnos.forceDestroy');
    });

    Route::controller(EstadoController::class)->group(function(){
        Route::get('/estados/listar', 'index')->name('estados.index');
        Route::get('/estados/all', 'all')->name('estados.all');
        Route::get('/estado/{estado}', 'show')->name('estados.show');
        Route::put('/estado/{estado}', 'update')->name('estados.update');
        Route::post('/estado', 'store')->name('estados.store');
        Route::post('/estado/{estado}', 'destroy')->name('estados.destroy');
        Route::post('/estado/restore/{estado}', 'restore')->name('estados.restore');
        Route::delete('/estado/{estado}', 'forceDestroy')->name('estados.forceDestroy');
    });

    Route::controller(VersionPosslimController::class)->group(function(){
        Route::get('/version-posslims/listar', 'index')->name('version_posslims.index');
        Route::get('/version-posslims/all', 'all')->name('version_posslims.all');
        Route::get('/version-posslim/{version_posslim}', 'show')->name('version_posslims.show');
        Route::put('/version-posslim/{version_posslim}', 'update')->name('version_posslims.update');
        Route::post('/version-posslim', 'store')->name('version_posslims.store');
        Route::post('/version-posslim/{version_posslim}', 'destroy')->name('version_posslims.destroy');
        Route::post('/version-posslim/restore/{version_posslim}', 'restore')->name('version_posslims.restore');
        Route::delete('/version-posslim/{version_posslim}', 'forceDestroy')->name('version_posslims.forceDestroy');
    });

    Route::controller(VersionMaquinaController::class)->group(function(){
        Route::get('/version-maquinas/listar', 'index')->name('version_maquinas.index');
        Route::get('/version-maquinas/all', 'all')->name('version_maquinas.all');
        Route::get('/version-maquina/{version_maquina}', 'show')->name('version_maquinas.show');
        Route::put('/version-maquina/{version_maquina}', 'update')->name('version_maquinas.update');
        Route::post('/version-maquina', 'store')->name('version_maquinas.store');
        Route::post('/version-maquina/{version_maquina}', 'destroy')->name('version_maquinas.destroy');
        Route::post('/version-maquina/restore/{version_maquina}', 'restore')->name('version_maquinas.restore');
        Route::delete('/version-maquina/{version_maquina}', 'forceDestroy')->name('version_maquinas.forceDestroy');
    });

    Route::controller(VersionSimsController::class)->group(function(){
        Route::get('/version-sims/listar', 'index')->name('version_sims.index');
        Route::get('/version-sims/all', 'all')->name('version_sims.all');
        Route::get('/version-sim/{version_sim}', 'show')->name('version_sims.show');
        Route::put('/version-sim/{version_sim}', 'update')->name('version_sims.update');
        Route::post('/version-sim', 'store')->name('version_sims.store');
        Route::post('/version-sim/{version_sim}', 'destroy')->name('version_sims.destroy');
        Route::post('/version-sim/restore/{version_sim}', 'restore')->name('version_sims.restore');
        Route::delete('/version-sim/{version_sim}', 'forceDestroy')->name('version_sims.forceDestroy');
    });

    Route::controller(TransportadoraController::class)->group(function(){
        Route::get('/transportadoras/listar', 'index')->name('transportadoras.index');
        Route::get('/transportadoras/all', 'all')->name('transportadoras.all');
        Route::get('/transportadora/{transportadora}', 'show')->name('transportadoras.show');
        Route::put('/transportadora/{transportadora}', 'update')->name('transportadoras.update');
        Route::post('/transportadora', 'store')->name('transportadoras.store');
        Route::post('/transportadora/{transportadora}', 'destroy')->name('transportadoras.destroy');
        Route::post('/transportadora/restore/{transportadora}', 'restore')->name('transportadoras.restore');
        Route::delete('/transportadora/{transportadora}', 'forceDestroy')->name('transportadoras.forceDestroy');
    });

    Route::controller(TipoServicioPuntoController::class)->group(function(){
        Route::get('/tipo-servicios-puntos/listar', 'index')->name('tipo_servicios_puntos.index');
        Route::get('/tipo-servicios-puntos/all', 'all')->name('tipo_servicios_puntos.all');
        Route::get('/tipo-servicio-punto/{tipo_servicio_punto}', 'show')->name('tipo_servicios_puntos.show');
        Route::put('/tipo-servicio-punto/{tipo_servicio_punto}', 'update')->name('tipo_servicios_puntos.update');
        Route::post('/tipo-servicio-punto', 'store')->name('tipo_servicio_punto.store');
        Route::post('/tipo-servicio-punto/{tipo_servicio_punto}', 'destroy')->name('tipo_servicios_puntos.destroy');
        Route::post('/tipo-servicio-punto/restore/{tipo_servicio_punto}', 'restore')->name('tipo_servicios_puntos.restore');
        Route::delete('/tipo-servicio-punto/{tipo_servicio_punto}', 'forceDestroy')->name('tipo_servicios_puntos.forceDestroy');
    });

    Route::controller(TipoLineaGprsController::class)->group(function(){
        Route::get('/tipo-lineas-gprs/listar', 'index')->name('tipo_lineas_gprs.index');
        Route::get('/tipo-lineas-gprs/all', 'all')->name('tipo_lineas_gprs.all');
        Route::get('/tipo-linea-gprs/{tipo_linea_gprs}', 'show')->name('tipo_lineas_gprs.show');
        Route::put('/tipo-linea-gprs/{tipo_linea_gprs}', 'update')->name('tipo_lineas_gprs.update');
        Route::post('/tipo-linea-gprs', 'store')->name('tipo_lineas_gprs.store');
        Route::post('/tipo-linea-gprs/{tipo_linea_gprs}', 'destroy')->name('tipo_lineas_gprs.destroy');
        Route::post('/tipo-linea-gprs/restore/{tipo_linea_gprs}', 'restore')->name('tipo_lineas_gprs.restore');
        Route::delete('/tipo-linea-gprs/{tipo_linea_gprs}', 'forceDestroy')->name('tipo_lineas_gprs.forceDestroy');
    });

    Route::controller(TipoEquipoTrabajoController::class)->group(function(){
        Route::get('/tipo-equipos-trabajo/listar', 'index')->name('tipo_equipos_trabajo.index');
        Route::get('/tipo-equipos-trabajo/all', 'all')->name('tipo_equipos_trabajo.all');
        Route::get('/tipo-equipo-trabajo/{tipo_equipo_trabajo}', 'show')->name('tipo_equipos_trabajo.show');
        Route::put('/tipo-equipo-trabajo/{tipo_equipo_trabajo}', 'update')->name('tipo_equipos_trabajo.update');
        Route::post('/tipo-equipo-trabajo', 'store')->name('tipo_equipos_trabajo.store');
        Route::post('/tipo-equipo-trabajo/{tipo_equipo_trabajo}', 'destroy')->name('tipo_equipos_trabajo.destroy');
        Route::post('/tipo-equipo-trabajo/restore/{tipo_equipo_trabajo}', 'restore')->name('tipo_equipos_trabajo.restore');
        Route::delete('/tipo-equipo-trabajo/{tipo_equipo_trabajo}', 'forceDestroy')->name('tipo_equipos_trabajo.forceDestroy');
    });

    Route::controller(TipoConexionController::class)->group(function(){
        Route::get('/tipos-conexiones/listar', 'index')->name('tipos_conexiones.index');
        Route::get('/tipos-conexiones/all', 'all')->name('tipos_conexiones.all');
        Route::get('/tipo-conexion/{tipo_conexion}', 'show')->name('tipos_conexiones.show');
        Route::put('/tipo-conexion/{tipo_conexion}', 'update')->name('tipos_conexiones.update');
        Route::post('/tipo-conexion', 'store')->name('tipos_conexiones.store');
        Route::post('/tipo-conexion/{tipo_conexion}', 'destroy')->name('tipos_conexiones.destroy');
        Route::post('/tipo-conexion/restore/{tipo_conexion}', 'restore')->name('tipos_conexiones.restore');
        Route::delete('/tipo-conexion/{tipo_conexion}', 'forceDestroy')->name('tipos_conexiones.forceDestroy');
    });

    Route::controller(SistemaOperativoController::class)->group(function(){
        Route::get('/sistemas-operativos/listar', 'index')->name('sistemas_operativos.index');
        Route::get('/sistemas-operativos/all', 'all')->name('sistemas_operativos.all');
        Route::get('/sistema-operativo/{sistema_operativo}', 'show')->name('sistemas_operativos.show');
        Route::put('/sistema-operativo/{sistema_operativo}', 'update')->name('sistemas_operativos.update');
        Route::post('/sistema-operativo', 'store')->name('sistemas_operativos.store');
        Route::post('/sistema-operativo/{sistema_operativo}', 'destroy')->name('sistemas_operativos.destroy');
        Route::post('/sistema-operativo/restore/{sistema_operativo}', 'restore')->name('sistemas_operativos.restore');
        Route::delete('/sistema-operativo/{sistema_operativo}', 'forceDestroy')->name('sistemas_operativos.forceDestroy');
    });

    Route::controller(PoblacionController::class)->group(function(){
        Route::get('/poblaciones/listar', 'index')->name('poblacions.index');
        Route::get('/poblaciones/all', 'all')->name('poblacions.all');
        Route::get('/poblacion/{poblacion}', 'show')->name('poblacions.show');
        Route::put('/poblacion/{poblacion}', 'update')->name('poblacions.update');
        Route::post('/poblacion', 'store')->name('poblacions.store');
        Route::post('/poblacion/{poblacion}', 'destroy')->name('poblacions.destroy');
        Route::post('/poblacion/restore/{poblacion}', 'restore')->name('poblacions.restore');
        Route::delete('/poblacion/{poblacion}', 'forceDestroy')->name('poblacions.forceDestroy');
    });

    Route::controller(ReporteSenalController::class)->group(function(){
        Route::get('/reporte-senales/listar', 'index')->name('reporte_senal.index');
        Route::get('/reporte-senal/{reporte_señal}', 'show')->name('reporte_senal.show');
        Route::put('/reporte-senal/{reporte_señal}', 'update')->name('reporte_senal.update');
        Route::post('/reporte-senal', 'store')->name('reporte_senal.store');
        Route::post('/reporte-senal/{reporte_señal}', 'destroy')->name('reporte_senal.destroy');
        Route::post('/reporte-senal/restore/{reporte_señal}', 'restore')->name('reporte_senal.restore');
        Route::delete('/reporte-senal/{reporte_señal}', 'forceDestroy')->name('reporte_senal.forceDestroy');
    });

    Route::controller(OperadorTecnologicoController::class)->group(function(){
        Route::get('/operadores-tecnologicos/listar', 'index')->name('operador_tecnologicos.index');
        Route::get('/operadores-tecnologicos/all', 'all')->name('operador_tecnologicos.all');
        Route::get('/operador-tecnologico/{operador_tecnologico}', 'show')->name('operador_tecnologicos.show');
        Route::put('/operador-tecnologico/{operador_tecnologico}', 'update')->name('operador_tecnologicos.update');
        Route::post('/operador-tecnologico', 'store')->name('operador_tecnologicos.store');
        Route::post('/operador-tecnologico/{operador_tecnologico}', 'destroy')->name('operador_tecnologicos.destroy');
        Route::post('/operador-tecnologico/restore/{operador_tecnologico}', 'restore')->name('operador_tecnologicos.restore');
        Route::delete('/operador-tecnologico/{operador_tecnologico}', 'forceDestroy')->name('operador_tecnologicos.forceDestroy');
    });

    Route::controller(ReporteFallasAbministrativasController::class)->group(function(){
        Route::get('/reporte-fallas-administrativas/listar', 'index')->name('reporte_fallas_administrativas.index');
        Route::get('/reporte_falla_administativa/{reporte_falla_administrativa}', 'show')->name('reporte_fallas_administrativas.show');
        Route::put('/reporte_falla_administativa/{reporte_falla_administrativa}', 'update')->name('reporte_fallas_administrativas.update');
        Route::post('/reporte_falla_administativa', 'store')->name('reporte_fallas_administrativas.store');
        Route::post('/reporte_falla_administativa/{reporte_falla_administrativa}', 'destroy')->name('reporte_fallas_administrativas.destroy');
        Route::post('/reporte_falla_administativa/restore/{reporte_falla_administrativa}', 'restore')->name('reporte_fallas_administrativas.restore');
        Route::delete('/reporte_falla_administativa/{reporte_falla_administrativa}', 'forceDestroy')->name('reporte_fallas_administrativas.forceDestroy');
    });

    Route::controller(RecepcionCentralController::class)->group(function(){
        Route::get('/recepcion-central/listar', 'index')->name('recepcion_central.index');
        Route::get('/recepcion-central/{recepcion_central}', 'show')->name('recepcion_central.show');
        Route::put('/recepcion-central/{recepcion_central}', 'update')->name('recepcion_central.update');
        Route::post('/recepcion-central', 'store')->name('recepcion_central.store');
        Route::post('/recepcion-central/{recepcion_central}', 'destroy')->name('recepcion_central.destroy');
        Route::post('/recepcion-central/restore/{recepcion_central}', 'restore')->name('recepcion_central.restore');
        Route::delete('/recepcion-central/{recepcion_central}', 'forceDestroy')->name('recepcion_central.forceDestroy');
    });


    Route::controller(PuntosOficinasController::class)->group(function(){
        Route::get('/puntos-oficinas/listar', 'index')->name('puntos_oficina.index');
        Route::get('/puntos-oficinas/all', 'all')->name('puntos_oficina.all');
        Route::get('/punto-oficina/{punto_oficina}', 'show')->name('puntos_oficina.show');
        Route::put('/punto-oficina/{punto_oficina}', 'update')->name('puntos_oficina.update');
        Route::post('/punto-oficina', 'store')->name('puntos_oficina.store');
        Route::post('/punto-oficina/{punto_oficina}', 'destroy')->name('puntos_oficina.destroy');
        Route::post('/punto-oficina/restore/{punto_oficina}', 'restore')->name('puntos_oficina.restore');
        Route::delete('/punto-oficina/{punto_oficina}', 'forceDestroy')->name('puntos_oficina.forceDestroy');
    });

    Route::controller(ProcesoController::class)->group(function(){
        Route::get('/procesos/listar', 'index')->name('procesos.index');
        Route::get('/procesos/all', 'all')->name('procesos.all');
        Route::get('/proceso/{proceso}', 'show')->name('procesos.show');
        Route::put('/proceso/{proceso}', 'update')->name('procesos.update');
        Route::post('/proceso', 'store')->name('procesos.store');
        Route::post('/proceso/{proceso}', 'destroy')->name('procesos.destroy');
        Route::post('/proceso/restore/{proceso}', 'restore')->name('procesos.restore');
        Route::delete('/proceso/{proceso}', 'forceDestroy')->name('procesos.forceDestroy');
    });
//-----------------------------------------------------------------------------------------------------------------------
    Route::controller(OperadorSimcardController::class)->group(function(){
        Route::get('/operador-simcards/listar', 'index')->name('operador_simcards.index');
        Route::get('/operador-simcards/all', 'all')->name('operador_simcards.all');
        Route::get('/operador-simcard/{operador_simcard}', 'show')->name('operador_simcards.show');
        Route::put('/operador-simcard/{operador_simcard}', 'update')->name('operador_simcards.update');
        Route::post('/operador-simcard', 'store')->name('operador_simcards.store');
        Route::post('/operador-simcard/{operador_simcard}', 'destroy')->name('operador_simcards.destroy');
        Route::post('/operador-simcard/restore/{operador_simcard}', 'restore')->name('operador_simcards.restore');
        Route::delete('/operador-simcard/{operador_simcard}', 'forceDestroy')->name('operador_simcards.forceDestroy');
    });

    Route::controller(OperadorSatelitalController::class)->group(function(){
        Route::get('/operadores-satelitales/listar', 'index')->name('operador_satelitales.index');
        Route::get('/operadores-satelitales/all', 'all')->name('operador_satelitales.all');
        Route::get('/operador-satelital/{operador_satelital}', 'show')->name('operador_satelitales.show');
        Route::put('/operador-satelital/{operador_satelital}', 'update')->name('operador_satelitales.update');
        Route::post('/operador-satelital', 'store')->name('operador_satelitales.store');
        Route::post('/operador-satelital/{operador_satelital}', 'destroy')->name('operador_satelitales.destroy');
        Route::post('/operador-satelital/restore/{operador_satelital}', 'restore')->name('operador_satelitales.restore');
        Route::delete('/operador-satelital/{operador_satelital}', 'forceDestroy')->name('operador_satelitales.forceDestroy');
    });

    Route::controller(ModeloMaquinaController::class)->group(function(){
        Route::get('/modelo-maquinas/listar', 'index')->name('modelo_maquinas.index');
        Route::get('/modelo-maquinas/all', 'all')->name('modelo_maquinas.all');
        Route::get('/modelo-maquina/{modelo_maquina}', 'show')->name('modelo_maquinas.show');
        Route::put('/modelo-maquina/{modelo_maquina}', 'update')->name('modelo_maquinas.update');
        Route::post('/modelo-maquina', 'store')->name('modelo_maquina.store');
        Route::post('/modelo-maquina/{modelo_maquina}', 'destroy')->name('modelo_maquinas.destroy');
        Route::post('/modelo-maquina/restore/{modelo_maquina}', 'restore')->name('modelo_maquinas.restore');
        Route::delete('/modelo-maquina/{modelo_maquina}', 'forceDestroy')->name('modelo_maquinas.forceDestroy');
    });

    Route::controller(MemoriaRamController::class)->group(function(){
        Route::get('/memorias-rams/listar', 'index')->name('memorias_rams.index');
        Route::get('/memorias-rams/all', 'all')->name('memorias_rams.all');
        Route::get('/memoria-ram/{memoria_ram}', 'show')->name('memorias_rams.show');
        Route::put('/memoria-ram/{memoria_ram}', 'update')->name('memorias_rams.update');
        Route::post('/memoria-ram', 'store')->name('memoria_ram.store');
        Route::post('/memoria-ram/{memoria_ram}', 'destroy')->name('memorias_rams.destroy');
        Route::post('/memoria-ram/restore/{memoria_ram}', 'restore')->name('memorias_rams.restore');
        Route::delete('/memoria-ram/{memoria_ram}', 'forceDestroy')->name('memorias_rams.forceDestroy');
    });

    Route::controller(MarcaTecladoController::class)->group(function(){
        Route::get('/marcas-teclados/listar', 'index')->name('marcas_teclados.index');
        Route::get('/marcas-teclados/all', 'all')->name('marcas_teclados.all');
        Route::get('/marca-teclado/{marca_teclado}', 'show')->name('marcas_teclados.show');
        Route::put('/marca-teclado/{marca_teclado}', 'update')->name('marcas_teclados.update');
        Route::post('/marca-teclado', 'store')->name('marcas_teclados.store');
        Route::post('/marca-teclado/{marca_teclado}', 'destroy')->name('marcas_teclados.destroy');
        Route::post('/marca-teclado/restore/{marca_teclado}', 'restore')->name('marcas_teclados.restore');
        Route::delete('/marca-teclado/{marca_teclado}', 'forceDestroy')->name('marcas_teclados.forceDestroy');
    });

    Route::controller(MarcaEquipoController::class)->group(function(){
        Route::get('/marcas-equipos/listar', 'index')->name('marcas_equipos.index');
        Route::get('/marcas-equipos/all', 'all')->name('marcas_equipos.all');
        Route::get('/marca-equipo/{marca_equipo}', 'show')->name('marcas_equipos.show');
        Route::put('/marca-equipo/{marca_equipo}', 'update')->name('marcas_equipos.update');
        Route::post('/marca-equipo', 'store')->name('marcas_equipos.store');
        Route::post('/marca-equipo/{marca_equipo}', 'destroy')->name('marcas_equipos.destroy');
        Route::post('/marca-equipo/restore/{marca_equipo}', 'restore')->name('marcas_equipos.restore');
        Route::delete('/marca-equipo/{marca_equipo}', 'forceDestroy')->name('marcas_equipos.forceDestroy');
    });

    Route::controller(MarcaImpresoraController::class)->group(function(){
        Route::get('/marcas-impresoras/listar', 'index')->name('marcas_impresoras.index');
        Route::get('/marcas-impresoras/all', 'all')->name('marcas_impresoras.all');
        Route::get('/marca-impresora/{marca_impresora}', 'show')->name('marcas_impresoras.show');
        Route::put('/marca-impresora/{marca_impresora}', 'update')->name('marcas_impresoras.update');
        Route::post('/marca-impresora', 'store')->name('marcas_impresoras.store');
        Route::post('/marca-impresora/{marca_impresora}', 'destroy')->name('marcas_impresoras.destroy');
        Route::post('/marca-impresora/restore/{marca_impresora}', 'restore')->name('marcas_impresoras.restore');
        Route::delete('/marca-impresora/{marca_impresora}', 'forceDestroy')->name('marcas_impresoras.forceDestroy');
    });

    Route::controller(MarcaMonitorController::class)->group(function(){
        Route::get('/marcas-monitores/listar', 'index')->name('marcas_monitores.index');
        Route::get('/marcas-monitores/all', 'all')->name('marcas_monitores.all');
        Route::get('/marca-monitor/{marca_monitor}', 'show')->name('marcas_monitores.show');
        Route::put('/marca-monitor/{marca_monitor}', 'update')->name('marcas_monitores.update');
        Route::post('/marca-monitor', 'store')->name('marcas_monitores.store');
        Route::post('/marca-monitor/{marca_monitor}', 'destroy')->name('marcas_monitores.destroy');
        Route::post('/marca-monitor/restore/{marca_monitor}', 'restore')->name('marcas_monitores.restore');
        Route::delete('/marca-monitor/{marca_monitor}', 'forceDestroy')->name('marcas_monitores.forceDestroy');
    });

    Route::controller(MarcaDvrController::class)->group(function(){
        Route::get('/marcas-dvrs/listar', 'index')->name('marcas_dvrs.index');
        Route::get('/marcas-dvrs/all', 'all')->name('marcas_dvrs.all');
        Route::get('/marca-dvr/{marca_dvr}', 'show')->name('marcas_dvrs.show');
        Route::put('/marca-dvr/{marca_dvr}', 'update')->name('marcas_dvrs.update');
        Route::post('/marca-dvr', 'store')->name('marcas_dvrs.store');
        Route::post('/marca-dvr/{marca_dvr}', 'destroy')->name('marcas_dvrs.destroy');
        Route::post('/marca-dvr/restore/{marca_dvr}', 'restore')->name('marcas_dvrs.restore');
        Route::delete('/marca-dvr/{marca_dvr}', 'forceDestroy')->name('marcas_dvrs.forceDestroy');
    });

    Route::controller(MarcaMauseController::class)->group(function(){
        Route::get('/marcas-mouses/listar', 'index')->name('marcas_mouse.index');
        Route::get('/marcas-mouses/all', 'all')->name('marcas_mouse.all');
        Route::get('/marca-mouse/{marca_mouse}', 'show')->name('marcas_mouse.show');
        Route::put('/marca-mouse/{marca_mouse}', 'update')->name('marcas_mouse.update');
        Route::post('/marca-mouse', 'store')->name('marcas_mouse.store');
        Route::post('/marca-mouse/{marca_mouse}', 'destroy')->name('marcas_mouse.destroy');
        Route::post('/marca-mouse/restore/{marca_mouse}', 'restore')->name('marcas_mouse.restore');
        Route::delete('/marca-mouse/{marca_mouse}', 'forceDestroy')->name('marcas_mouse.forceDestroy');
    });

    Route::controller(CentroCostoController::class)->group(function(){
        Route::get('/centros-costos/listar', 'index')->name('centros_costos.index');
        Route::get('/centros-costos/all', 'all')->name('centros_costos.all');
        Route::get('/centro-costo/{centro_costo}', 'show')->name('centros_costos.show');
        Route::put('/centro-costo/{centro_costo}', 'update')->name('centros_costos.update');
        Route::post('/centro-costo', 'store')->name('centros_costos.store');
        Route::post('/centro-costo/{centro_costo}', 'destroy')->name('centros_costos.destroy');
        Route::post('/centro-costo/restore/{centro_costo}', 'restore')->name('centros_costos.restore');
        Route::delete('/centro-costo/{centro_costo}', 'forceDestroy')->name('centros_costos.forceDestroy');
    });

    Route::controller(InventarioMaquinaController::class)->group(function(){
        Route::get('/inventario-maquinas/listar', 'index')->name('inventario_maquinas.index');
        Route::get('/inventario-maquinas/report', 'report')->name('inventario_maquinas.report');
        Route::get('/inventario-maquina/{inventario_maquina}', 'show')->name('inventario_maquinas.show');
        Route::put('/inventario-maquina/{inventario_maquina}', 'update')->name('inventario_maquinas.update');
        Route::post('/inventario-maquina', 'store')->name('inventario_maquinas.store');
        Route::post('/inventario-maquina/{inventario_maquina}', 'destroy')->name('inventario_maquinas.destroy');
        Route::post('/inventario-maquina/restore/{inventario_maquina}', 'restore')->name('inventario_maquinas.restore');
        Route::delete('/inventario-maquina/{inventario_maquina}', 'forceDestroy')->name('inventario_maquinas.forceDestroy');
    });

    Route::controller(LineaMovileController::class)->group(function(){
        Route::get('/lineas-moviles/listar', 'index')->name('lineas_moviles.index');
        Route::get('/lineas-moviles/all', 'all')->name('lineas_moviles.all');
        Route::post('/lineas-moviles/relacionar', 'relacionar')->name('lineas_moviles.relacionar');
        Route::get('/lineas-moviles/report', 'report')->name('lineas_moviles.report');
        Route::get('/linea-movil/{linea_movil}', 'show')->name('lineas_moviles.show');
        Route::put('/linea-movil/{linea_movil}', 'update')->name('lineas_moviles.update');
        Route::post('/linea-movil', 'store')->name('lineas_moviles.store');
        Route::post('/linea-movil/{linea_movil}', 'destroy')->name('lineas_moviles.destroy');
        Route::post('/linea-movil/restore/{linea_movil}', 'restore')->name('lineas_moviles.restore');
        Route::delete('/linea-movil/{linea_movil}', 'forceDestroy')->name('lineas_moviles.forceDestroy');
    });

    Route::controller(InventarioEquiposController::class)->group(function(){
        Route::get('/inventario-equipos/listar', 'index')->name('inventario_equipos.index');
        Route::get('/inventario-equipo/{inventario_equipo}', 'show')->name('inventario_equipos.show');
        Route::put('/inventario-equipo/{inventario_equipo}', 'update')->name('inventario_equipos.update');
        Route::post('/inventario-equipo', 'store')->name('inventario_equipos.store');
        Route::post('/inventario-equipo/{inventario_equipo}', 'destroy')->name('inventario_equipos.destroy');
        Route::post('/inventario-equipo/restore/{inventario_equipo}', 'restore')->name('inventario_equipos.restore');
        Route::delete('/inventario-equipo/{inventario_equipo}', 'forceDestroy')->name('inventario_equipos.forceDestroy');
    });

    Route::controller(InventarioCamaraController::class)->group(function(){
        Route::get('/inventario-camaras/listar', 'index')->name('inventario_camaras.index');
        Route::get('/inventario-camara/{inventario_camara}', 'show')->name('inventario_camaras.show');
        Route::put('/inventario-camara/{inventario_camara}', 'update')->name('inventario_camaras.update');
        Route::post('/inventario-camara', 'store')->name('inventario_camaras.store');
        Route::post('/inventario-camara/{inventario_camara}', 'destroy')->name('inventario_camaras.destroy');
        Route::post('/inventario-camara/restore/{inventario_camara}', 'restore')->name('inventario_camaras.restore');
        Route::delete('/inventario-camara/{inventario_camara}', 'forceDestroy')->name('inventario_camaras.forceDestroy');
    });

    Route::controller(ActualizacionPosslimController::class)->group(function(){
        Route::get('/actualizaciones-posslims/listar', 'index')->name('actualizacion_posslim.index');
        Route::get('/actualizacion-posslim/{actualizacionPosslim}', 'show')->name('actualizacion_posslim.show');
        Route::put('/actualizacion-posslim/{actualizacionPosslim}', 'update')->name('actualizacion_posslim.update');
        Route::post('/actualizacion-posslim', 'store')->name('actualizacion_posslim.store');
        Route::post('/actualizacion-posslim/{actualizacionPosslim}', 'destroy')->name('actualizacion_posslim.destroy');
        Route::post('/actualizacion-posslim/restore/{actualizacionPosslim}', 'restore')->name('actualizacion_posslim.restore');
        Route::delete('/actualizacion-posslim/{actualizacionPosslim}', 'forceDestroy')->name('actualizacion_posslim.forceDestroy');
    });

    Route::controller(ValidacionAntenaController::class)->group(function(){
        Route::get('/validacion-antenas/listar', 'index')->name('validacion_antenas.index');
        Route::get('/validacion-antena/{validacion_antena}', 'show')->name('validacion_antenas.show');
        Route::put('/validacion-antena/{validacion_antena}', 'update')->name('validacion_antenas.update');
        Route::post('/validacion-antena', 'store')->name('validacion_antenas.store');
        Route::post('/validacion-antena/{validacion_antena}', 'destroy')->name('validacion_antenas.destroy');
        Route::post('/validacion-antena/restore/{validacion_antena}', 'restore')->name('validacion_antenas.restore');
        Route::delete('/validacion-antena/{validacion_antena}', 'forceDestroy')->name('validacion_antenas.forceDestroy');
    });

});

Route::get('/lineas-moviles/export', [LineaMovileController::class, 'export'])->name('lineas_moviles.export');
Route::get('/inventario-maquinas/export', [InventarioMaquinaController::class, 'export'])->name('inventario_maquinas.export');
Route::get('/actualizaciones-posslims/export', [ActualizacionPosslimController::class, 'export'])->name('actualizacion_posslim.export');
Route::get('/inventario-camaras/export', [InventarioCamaraController::class, 'export'])->name('inventario_camaras.export');
Route::get('/inventario-recepcion-central/export', [RecepcionCentralController::class, 'export'])->name('recepcion_central.export');
Route::get('/inventario-reporte-senales/export', [ReporteSenalController::class, 'export'])->name('reporte_senal.export');
Route::get('/inventario-validacion-antenas/export', [ValidacionAntenaController::class, 'export'])->name('validacion_antenas.export');
Route::get('/inventario-equipos/export', [InventarioEquiposController::class, 'export'])->name('inventario_equipos.export');
