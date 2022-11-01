<table>
    <thead>
        <tr>
            <td>POBLACION</td>
            <td>OPERADOR TECNOLOGICO</td>
            <td>NUMEROS DE LINEA</td>
            <td>NUMERO DE INCIDENTE</td>
            <td>OBSERVACION</td>
            <td>TECNICO</td>
        </tr>
    </thead>
    <tbody>
        @foreach($datas as $data)
            <tr>
                <td>{{ $data->poblacion?->name }}</td>
                <td>{{ $data->operador_tecnologico?->name }}</td>
                <td>{{ $data->numero_linea }}</td>
                <td>{{ $data->numero_incidente }}</td>
                <td>{{ $data->observacion }}</td>
                <td>{{ $data->fecha_entrega }}</td>
                <td>{{ $data->tecnico?->name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
