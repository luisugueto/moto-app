<html>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table>
    <tr>
        <td style="border: 1px solid #fff;width: 20;height: 20;font-family: Arial;font-size: 12; margin-left: 10px" colspan="3">
            <b>motostion S.L</b>
        </td>
    </tr>
    <tr><td style="border: 1px solid #fff;width: 20;height: 20;font-family: Arial;font-size: 12; margin-left: 10px" colspan="3">CIF: B80804156</td></tr>
    <tr><td style="border: 1px solid #fff;width: 20;height: 20;font-family: Arial;font-size: 12; margin-left: 10px" colspan="3">Calle Matilde Hernandez, 10</td></tr>
    <tr><td style="border: 1px solid #fff;width: 20;height: 20;font-family: Arial;font-size: 12; margin-left: 10px" colspan="3">28019 Madrid</td></tr>
    <tr><td style="border: 1px solid #fff;width: 20;height: 20;font-family: Arial;font-size: 12; margin-left: 10px" colspan="3">Tlf: 914716248</td></tr>
    <tr><td style="border: 1px solid #fff;width: 20;height: 20;font-family: Arial;font-size: 12; margin-left: 10px" colspan="3">info@motostion.com</td></tr>
    <tr><td style="border: 1px solid #fff;width: 20;height: 20;font-family: Arial;font-size: 12; margin-left: 10px" colspan="3">www.motostion.com</td></tr>
</table>
<table>
    <tr stye="font-family: Arial;font-size: 10;text-align: center;vertical-align:middle;">
        <td style="height: 20;border: 1px solid #000;vertical-align:middle;">
            <p style="text-align: center;">ID </p>
        </td>
        <td style="height: 20;width: 20;border: 1px solid #000;vertical-align:middle;">
            <p style="text-align: center;">N° de Bastidor</p>
        </td>
        <td style="height: 20;width: 30;border: 1px solid #000;vertical-align:middle;">
            <p style="text-align: center;">Modelo</p>
        </td>
        <td style="height: 20;width: 30;border: 1px solid #000;vertical-align:middle;">
            <p style="text-align: center;">Fecha de Fragmentación</p>
        </td>
        <td style="height: 20;width: 20;border: 1px solid #000;vertical-align:middle;">
            <p style="text-align: center;">Matrícula</p>
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
        <td style="height: 20;text-align: left;border: 1px solid #000;">{{$data[$i]->frame_no}}</td>
        <td style="height: 20;text-align: right;border: 1px solid #000;">{{ $data[$i]->model1 }}</td>
        <td style="text-align: left;border: 1px solid #000;"></td>
        <td style="width: 15;text-align: right;border: 1px solid #000;" >{{ $data[$i]->registration_number }}</td>
    </tr>
    @endfor
    <tr></tr>
    <tr>
        <td style="text-align: ;text-align: right;" colspan="3">Entregado Para el camión</td>
        <td style="text-align: left;font-weight: bold">{{ date('d/m/Y') }}</td>
    </tr>
</table>

</html>
