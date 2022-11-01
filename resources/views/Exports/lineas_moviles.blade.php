<table>
    <thead>
        <tr>
            <td>LINEA</td>
            <td>SERIAL</td>
            <td>OPERADOR</td>
            <td>ACTIVO DE LA MAQUINA</td>
            <td>SERIAL DE LA MAQUINA</td>
            <td>PUNTO DE OFICINA</td>
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
            </tr>
        @endforeach
    </tbody>
</table>
