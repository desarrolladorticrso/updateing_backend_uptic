<table>
    <thead>
        <tr>
            <td>POBLACION</td>
            <td>OPERADOR SATELITAL</td>
            <td>NIVEL SEÑAL ACTUAL</td>
            <td>TECNICO</td>
            <td>OBSERVACION</td>
            <td>ID ANTENA</td>
            <td>TIENE ROUTER</td>
            <td>VPN</td>
            <td>PROMEDIO PING HACIA LA VPN</td>
            <td>CAPACIDAD DE DATOS</td>
            <td>PROMEDIO DE PING EN ENVIOS DE GIRO</td>
            <td>PROMEDIO DE PING EN PAGOS DE GIRO</td>
            <td>PROMEDIO DE PING EN VENTA DE CHANCE</td>
            <td>CANTIDAD DE EQUIPOS EN LA OFICINA</td>
            <td>CANTIDAD DE EQUIPOS DE BETPLAY</td>
        </tr>
    </thead>
    <tbody>
        @foreach($datas as $data)
            <tr>
                <td>{{ $data->poblacion?->name }}</td>
                <td>{{ $data->operador_satelital?->name }}</td>
                <td>{{ $data->nivel_senial_actual }}</td>
                <td>{{ $data->tecnico?->name }}</td>
                <td>{{ $data->observacion }}</td>
                <td>{{ $data->id_antena }}</td>
                <td>{{ $data->tiene_router }}</td>
                <td>{{ $data->vpn?->name }}</td>
                <td>{{ $data->operador_satelital?->name }}</td>
                <td>{{ $data->prom_ping_hacia_vpn }}</td>
                <td>{{ $data->capacidad_datos }}</td>
                <td>{{ $data->ping_prom_tiemp_env_giro }}</td>
                <td>{{ $data->ping_prom_tiemp_pag_giro }}</td>
                <td>{{ $data->ping_prom_tiemp_vent_chance }}</td>
                <td>{{ $data->cant_equipos_oficina }}</td>
                <td>{{ $data->cant_equipos_betplay }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

