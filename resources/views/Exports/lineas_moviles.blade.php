<table>
    <thead>
        <tr>
            <td>LINEA</td>
            <td>SERIAL</td>
            <td>OPERADOR</td>
            <td>ESTADO DE LA LINEA</td>
        </tr>
    </thead>
    <tbody>
        @foreach($datas as $data)
            <tr>
                <td>{{ $data->linea }}</td>
                <td>{{ $data->serial }}</td>
                <td>{{ $data->operador_simcard ? $data->operador_simcard->name : ''}}</td>
                <td>{{ $data->estado ? $data->estado->name : ''}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
