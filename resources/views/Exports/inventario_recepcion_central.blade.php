<table>
    <thead>
        <tr>
            <td>NUMERO DE GUIA</td>
            <td>NOMBRE DE QUIEN RECIBIO</td>
            <td>FECHA EN LA QUE RECIBIO</td>
            <td>TRANSPORTADORA</td>
            <td>NOMBRE DE QUIEN RECIBE</td>
            <td>FECHA EN LA QUE SE ENTREGA</td>
            <td>PROCESO</td>
            <td>OBSERVACION</td>
            <td>VALOR DEL PAQUETE</td>
        </tr>
    </thead>
    <tbody>
        @foreach($datas as $data)
            <tr>
                <td>{{ $data->numero_guia }}</td>
                <td>{{ $data->nombre_quien_recibio }}</td>
                <td>{{ $data->fecha_recibido }}</td>
                <td>{{ $data->transportadora?->name }}</td>
                <td>{{ $data->nombre_recibe }}</td>
                <td>{{ $data->fecha_entrega }}</td>
                <td>{{ $data->proceso?->name }}</td>
                <td>{{ $data->observacion }}</td>
                <td>{{ $data->valor_paquete }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
