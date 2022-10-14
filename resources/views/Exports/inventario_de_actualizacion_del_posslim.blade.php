<table>
    <thead>
        <tr>
            <td>PUNTO DE OFICINA</td>
            <td>VERSION DEL POSSLIM</td>
            <td>VERSION DEL CLIENTE SIM</td>
            <td>TECNICO</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
            <tr>
                <td>{{$data->punto_oficina?->name}}</td>
                <td>{{$data->version_posslim?->name}}</td>
                <td>{{$data->version_sims?->name}}</td>
                <td>{{$data->tecnico?->name}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
