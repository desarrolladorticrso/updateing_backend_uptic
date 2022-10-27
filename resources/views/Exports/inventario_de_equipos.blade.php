<table>
    <thead>
        <tr>
            <td>SERIAL DEL EQUIPO</td>
            <td>ACTIVO DEL EQUIPO</td>
            <td>ASESOR</td>
            <td>LIDER</td>
            <td>PUNTO OFICINAS</td>
            <td>TIPO DE EQUIPO</td>
            <td>MARCA DEL EQUIPO</td>
            <td>SISTEMA OPERATIVO</td>
            <td>MEMORIA RAM</td>
            <td>DISCO DURO</td>
            <td>ESTADO DEL EQUIPO</td>
            <td>IP DEL EQUIPO</td>
            <td>MAC DEL EQUIPO</td>
            <td>TIENE MONITOR</td>
            <td>MARCA MONITOR</td>
            <td>ACTIVO FIJO MONITOR</td>
            <td>MODELO MONITOR</td>
            <td>SERIAL MONITOR</td>
            <td>ESTADO DEL MONITOR</td>
            <td>TIENE TECLADO</td>
            <td>MARCA TECLADO</td>
            <td>MODELO TECLADO</td>
            <td>ACTIVO FIJO TECLADO</td>
            <td>SERIAL TECLADO</td>
            <td>ESTADO TECLADO</td>
            <td>TIENE MOUSE</td>
            <td>MARCA MOUSE</td>
            <td>MODELO MOUSE</td>
            <td>ACTIVO FIJO MOUSE</td>
            <td>SERIAL MOUSE</td>
            <td>ESTADO MOUSE</td>
            <td>TIENE IMPRESORA</td>
            <td>MARCA IMPRESORA</td>
            <td>MODELO IMPRESORA</td>
            <td>ACTIVO FIJO IMPRESORA</td>
            <td>SERIAL IMPRESORA</td>
            <td>ESTADO IMPRESORA</td>
            <td>TIENE LECTOR BIOMETRICO</td>
            <td>ACTIVO FIJO DEL LECTOR BIOMETRICO</td>
            <td>SERIAL DEL LECTOR BIOMETRICO</td>
            <td>TIENE LECTOR DE BARRA</td>
            <td>ACTIVO DEL LECTOR DE BARRA</td>
            <td>SERIAL DEL LECTOR DE BARRA</td>
            <td>TIPO DE CONEXION</td>
            <td>TECNICO</td>
            <td>TIPO DE SERVICIO</td>
            <td>TIENE SID</td>
            <td>SERIAL SID</td>
            <td>ACTIVO FIJO SID</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
            <tr>
                <td>{{$data->serial_equipo}}</td>
                <td>{{$data->activo_fijo_equipo}}</td>
                <td>{{$data->asesor?->name}}</td>
                <td>{{$data->lider?->name}}</td>
                <td>{{$data->punto_oficina?->name}}</td>
                <td>{{$data->tipo_equipo_trabajo?->name}}</td>
                <td>{{$data->marca_equipo?->name}}</td>
                <td>{{$data->tipo_sistema_operativo?->name}}</td>
                <td>{{$data->memoria_ram?->name}}</td>
                <td>{{$data->disco_duro?->name}}</td>
                <td>{{$data->estado_equipo_trabajo?->name}}</td>
                <td>{{$data->ip_equipo}}</td>
                <td>{{$data->mac_equipo}}</td>
                <td>{{$data->tiene_monitor}}</td>
                <td>{{$data->marca_monitor?->name}}</td>
                <td>{{$data->activo_fijo_monitor}}</td>
                <td>{{$data->modelo_monitor}}</td>
                <td>{{$data->serial_monitor}}</td>
                <td>{{$data->estado_monitor?->name}}</td>
                <td>{{$data->tiene_teclado}}</td>
                <td>{{$data->marca_teclado?->name}}</td>
                <td>{{$data->modelo_teclado}}</td>
                <td>{{$data->activo_fijo_teclado}}</td>
                <td>{{$data->serial_teclado}}</td>
                <td>{{$data->estado_teclado?->name}}</td>
                <td>{{$data->tiene_mouse}}</td>
                <td>{{$data->marca_mouse?->name}}</td>
                {{-- <td>{{$data->marca_mouse}}</td> --}}
                <td>{{$data->modelo_mouse}}</td>
                <td>{{$data->activo_fijo_mouse}}</td>
                <td>{{$data->serial_mouse}}</td>
                <td>{{$data->estado_mouse?->name}}</td>
                <td>{{$data->tiene_impresora}}</td>
                <td>{{$data->marca_impresora?->name}}</td>
                <td>{{$data->modelo_impresora}}</td>
                <td>{{$data->activo_fijo_impresora}}</td>
                <td>{{$data->serial_impresora}}</td>
                <td>{{$data->estado_impresora?->name}}</td>
                <td>{{$data->tiene_lector_biometrico}}</td>
                <td>{{$data->activo_fijo_lector_biometrico}}</td>
                <td>{{$data->serial_lector_biometrico}}</td>
                <td>{{$data->tiene_lector_barra}}</td>
                <td>{{$data->activo_lector_barra}}</td>
                <td>{{$data->serial_lector_barra}}</td>
                <td>{{$data->tipo_conexion?->name}}</td>
                <td>{{$data->tecnico?->name}}</td>
                <td>{{$data->tipo_servicio?->name}}</td>
                <td>{{$data->tiene_sid}}</td>
                <td>{{$data->serial_sid}}</td>
                <td>{{$data->activo_fijo_sid}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
