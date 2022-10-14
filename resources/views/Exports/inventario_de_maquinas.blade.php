<table>
    <thead>
        <tr>
            <td>LINEA MOVIL</td>
            <td>SERIAL</td>
            <td>ACTIVO FIJO</td>
            <td>OPERADOR DE SIMCARD</td>
            <td>MODELO</td>
            <td>VERSION</td>
            <td>IMEI</td>
            <td>MANTENIMIENTO</td>
            <td>APN</td>
            <td>PUNTO DE OFICINA</td>
            <td>ASEROR</td>
            <td>DOCUMENTO DEL ASESOR</td>
            <td>LIDER</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
            <tr>
                <td>{{$data->linea_movil?->linea}}</td>
                <td>{{$data->serial_maquina}}</td>
                <td>{{$data->activo_fijo}}</td>
                <td>{{$data->operador_simcard?->name}}</td>
                <td>{{$data->modelo_maquina?->name}}</td>
                <td>{{$data->version_maquina?->name}}</td>
                <td>{{$data->imei}}</td>
                <td>{{$data->mantenimiento}}</td>
                <td>{{$data->apn?->name}}</td>
                <td>{{$data->punto_oficina?->name}}</td>
                <td>{{$data->asesor?->name}}</td>
                <td>{{$data->asesor?->documento}}</td>
                <td>{{$data->lider?->name}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
