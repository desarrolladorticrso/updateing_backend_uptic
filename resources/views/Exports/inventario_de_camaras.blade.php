<table>
    <thead>
        <tr>
            <td>CENTRO DE COSTO</td>
            <td>PUNTOS DE OFICINA</td>
            <td>MARCA DEL DVR</td>
            <td>CANTIDAD DE CAMARAS</td>
            <td>CAMARAS ACTIVAS</td>
            <td>IP DE LA CAMARAS</td>
            <td>URL</td>
            <td>ANCHO DE BANDA</td>
            <td>ESTADO DE LA CAMARA</td>
            <td>PUERTO HTTP</td>
            <td>PUERTO DEL SERVIDOR</td>
            <td>USER ADMIN</td>
            <td>PASSWORD ADMIN</td>
            <td>USER SOPORTE</td>
            <td>PASSWORD SOPORTE</td>
            <td>USER SJ</td>
            <td>PASSWORD SJ</td>
            <td>OBSERVACION</td>
            <td>TECNICO</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
            <tr>
                <td>{{$data->centro_costo?->name}}</td>
                <td>{{$data->punto_oficina?->name}}</td>
                <td>{{$data->marca_dvr?->name}}</td>
                <td>{{$data->cantidad_camaras}}</td>
                <td>{{$data->nro_camaras_activas}}</td>
                <td>{{$data->ip}}</td>
                <td>{{$data->url}}</td>
                <td>{{$data->ancho_banda}}</td>
                <td>{{$data->estado?->name}}</td>
                <td>{{$data->puerto_http}}</td>
                <td>{{$data->puerto_servidor}}</td>
                <td>{{$data->user_admin}}</td>
                <td>{{$data->password_admin}}</td>
                <td>{{$data->user_soporte}}</td>
                <td>{{$data->password_soporte}}</td>
                <td>{{$data->user_sj}}</td>
                <td>{{$data->password_sj}}</td>
                <td>{{$data->observacion}}</td>
                <td>{{$data->tecnico?->name}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
