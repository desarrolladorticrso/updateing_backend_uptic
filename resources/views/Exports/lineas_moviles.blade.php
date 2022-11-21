<table>
    <thead>
        <tr>
            <td>LINEA</td>
            <td>SERIAL</td>
            <td>OPERADOR</td>
            <td>ACTIVO DE LA MAQUINA</td>
            <td>SERIAL DE LA MAQUINA</td>
            <td>PUNTO DE OFICINA</td>
            <td>DOCUMENTO DEL ASESOR</td>
            <td>NOMBRE DEL ASESOR</td>
            <td>ESTADO DE LA LINEA</td>
        </tr>
    </thead>
    <tbody>
        @foreach($datas as $data)
            <tr>
                <td>{{ $data->linea }}</td>
                <td>{{ $data->serial }}</td>
                <td>{{ $data->operador_simcard}}</td>
                <td>{{ $data->activo_fijo}}</td>
                <td>{{ $data->serial_maquina}}</td>
                <td>{{ $data->punto_oficina}}</td>
                <td>{{ $data->asesor}}</td>
                <td>{{ $data->documento_asesor}}</td>
                <td>{{ $data->estado_linea}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
