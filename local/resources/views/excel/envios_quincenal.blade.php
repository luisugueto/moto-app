<html>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table>
    <tr stye="font-family: Arial;font-size: 10;text-align: center;vertical-align:middle;">
        <td style="height: 20;border: 1px solid #000;vertical-align:middle;">
            <p style="text-align: center;">ID </p>
        </td>
        <td style="height: 20;width: 30;border: 1px solid #000;vertical-align:middle;">
            <p style="text-align: center;">Modelo</p>
        </td>
        <td style="height: 20;width: 20;border: 1px solid #000;vertical-align:middle;">
            <p style="text-align: center;">Matrícula</p>
        </td>
        <td style="height: 20;width: 20;border: 1px solid #000;vertical-align:middle;">
            <p style="text-align: center;">Fecha Matriculación</p>
        </td>
        <td style="height: 20;width: 20;border: 1px solid #000;vertical-align:middle;">
            <p style="text-align: center;">Bastidor</p>
        </td>
        <td style="height: 20;;width: 20;border: 1px solid #000;vertical-align:middle;">
            <p style="text-align: center;">Estado en tráfico </p>
        </td>
        <td style="height: 20;width: 15;border: 1px solid #000;vertical-align:middle;">
            <p style="text-align: center;">Peso (kg)</p>
        </td>
        <td style="height: 20;width: 35;border: 1px solid #000;vertical-align:middle;">
            <p style="text-align: center;">Titular</p>
        </td>
        <td style="height: 20;width: 15;border: 1px solid #000;vertical-align:middle;">
            <p style="text-align: center;">Dni</p>
        </td>
        <td style="height: 20;width: 25;border: 1px solid #000;vertical-align:middle;">
            <p style="text-align: center;">Fecha de Nacimiento</p>
        </td>

        <td style="height: 20;width: 30;border: 1px solid #000;vertical-align:middle;">
            <p style="text-align: center;">Dirección</p>
        </td>
        <td style="height: 20;width: 15;border: 1px solid #000;vertical-align:middle;">
            <p style="text-align: center;">Codigo Postal</p>
        </td>
        <td style="height: 20;width: 25;border: 1px solid #000;vertical-align:middle;">
            <p style="text-align: center;">Población</p>
        </td>
        <td style="height: 20;width: 20;border: 1px solid #000;vertical-align:middle;">
            <p style="text-align: center;">Provincia</p>
        </td>
        <td style="height: 20;width: 30;border: 1px solid #000;vertical-align:middle;">
            <p style="text-align: center;">Estado Moto</p>
        </td>
        <td style="height: 20;width: 20;border: 1px solid #000;vertical-align:middle;">
            <p style="text-align: center;">Fecha de Baja</p>
        </td>
        <td style="height: 20;width: 30;border: 1px solid #000;vertical-align:middle;">
            <p style="text-align: center;">N° Certificado de Destrucción</p>
        </td>
        <td style="height: 20;width: 30;border: 1px solid #000;vertical-align:middle;">
            <p style="text-align: center;">Fecha Certificado de Destrucción</p>
        </td>
        <td style="height: 20;width: 30;border: 1px solid #000;vertical-align:middle;">
            <p style="text-align: center;">Fecha de Descontaminacion</p>
        </td>
    </tr>
</table>
<table>
    <?php 
        $contador = count($data); 
    ?>
    @for ($i = 0; $i < $contador; $i++)
    <tr>
        <td style="height: 20;text-align: left;border: 1px solid #000;">{{ $data[$i]->id_pv }}</td>
        <td style="height: 20;text-align: left;border: 1px solid #000;">{{$data[$i]->model1}}</td>
        <td style="height: 20;text-align: right;border: 1px solid #000;">{{ $data[$i]->registration_number }}</td>
        <td style="text-align: left;border: 1px solid #000;">{{ $data[$i]->registration_date }}</td>
        <td style="width: 15;text-align: right;border: 1px solid #000;" >{{ $data[$i]->frame_no }}</td>
        <td style="height: 20;text-align: left;border: 1px solid #000;">{{ $data[$i]->vehicle_state_trafic }}</td>
        <td style="height: 20;text-align: left;border: 1px solid #000;">{{ round($data[$i]->weight, 2)}}</td>
        <td style="height: 20;text-align: right;border: 1px solid #000;">{{ $data[$i]->pvname }}  {{ $data[$i]->lastname }}</td>
        <td style="text-align: left;border: 1px solid #000;">{{ $data[$i]->dni }}</td>
        <td style="width: 25;text-align: right;border: 1px solid #000;" >{{ $data[$i]->birthdate }}</td>
        <td style="height: 20;text-align: left;border: 1px solid #000;">{{ $data[$i]->street }}  {{ $data[$i]->nro_street }}</td>
        <td style="height: 20;text-align: left;border: 1px solid #000;">{{$data[$i]->postal_code}}</td>
        <td style="height: 20;text-align: right;border: 1px solid #000;">{{ $data[$i]->municipality }}</td>
        <td style="text-align: left;border: 1px solid #000;">{{ $data[$i]->province }}</td>
        <td style="width: 15;text-align: right;border: 1px solid #000;" >{{ $data[$i]->status_trafic }}</td>

        <td style="height: 20;text-align: left;border: 1px solid #000;">{{ date('d-m-Y', strtotime($data[$i]->destruction_date))}}</td>
        <td style="height: 20;text-align: left;border: 1px solid #000;">CATV/MD/12173/{{ $data[$i]->purchase_valuation_id }}</td>
        <td style="height: 20;text-align: left;border: 1px solid #000;">{{ date('d-m-Y', strtotime($data[$i]->destruction_date)) }}</td>
        <td style="height: 20;text-align: left;border: 1px solid #000;">
        @if(isset($apply))        
            @foreach ($apply as $key)
            @if ($key->purchase_valuation_id == $data[$i]->id_pv)
            {{ date('d-m-Y', strtotime($key['created_at'])) }} 
            @else
                &nbsp;
            @endif                         
            @endforeach
        @endif  
        </td>   
    </tr>
    @endfor
    <tr></tr>
    <tr>
        <td style="text-align: ;text-align: right;" colspan="3">Entregado listado de Descontaminacion</td>
        <td style="text-align: left;font-weight: bold">{{ date('d/m/Y') }}</td>
    </tr>
</table>

</html>
