<html xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"
    xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">
 
<table>
    <tr>
        <td style="font-weight: bold;width: 60;height: 20;font-family: Arial;font-size: 12">PROCESO DE REUTILIZACIÓN</td>
    </tr>
    <tr ></tr>
    <tr style="background: #fff;border: 1px solid #d4d4d4"></tr>
 
    <tr stye="font-family: Arial;font-size: 10;text-align: center;vertical-align:middle;">
        <td style="width:60; height: 50;border: 2px medium #000;vertical-align:middle;">
            <p style="text-align: center;">NIF del titular </p>
        </td>
        <td style="width:30;height: 60;border: 2px medium #000;vertical-align:middle;">
            <p style="text-align: center;">Razón social del titular</p>
        </td>
        <td style="width:30;height: 60;border: 2px medium #000;vertical-align:middle;">
            <p style="text-align: center;">NIMA</p>
        </td>
        <td style="border: 2px medium #000;vertical-align:middle;" colspan="3">
            <p style="text-align: center;">PROCESO DE GESTIÓN O PRODUCCIÓN EN LA PROPIA INSTALACION</p>
        </td>
        
        <td style="width: 20;border: 2px medium #000;">
            <p style="text-align: center;vertical-align:middle;">CANTIDAD TOTAL </p>
        </td>
    </tr>
    <tr style="text-align: center">
        <td style="height: 20;vertical-align:middle;">&nbsp;</td>
        <td style="height: 20;vertical-align:middle;">&nbsp;</td>
        <td style="height: 20;vertical-align:middle;">&nbsp;</td>
        <td style="width: 30;height: 20;border: 2px medium #000;vertical-align:middle;">NÚMERO PROCESO (NP)</td>
        <td style="width: 30;border: 2px medium #000;vertical-align:middle;text-align: center" colspan="1">CODIGO LER</td>
        <td style="width: 40;height: 20;border: 2px medium #000;vertical-align:middle;">RESIDUO</td>        
        <td style="height: 20;border: 2px medium #000;">(en toneladas)</td>
    </tr>
</table>
<table>
    <?php 
        $contador = count($data); 
        $celdas = 0;
        if($contador < 10){
            $celdas = 10;
        }
        if($contador > 10){
            $celdas = 10 + 2;
        }
    ?>
    @for ($i = 0; $i < $celdas; $i++)
    <tr>
        <td style="height: 20;text-align: left;border: 2px medium #000;">1</td>
        <td style="height: 20;text-align: left;border: 2px medium #000;">2</td>
        <td style="height: 20;text-align: right;border: 2px medium #000;">3</td>
        <td style="text-align: left;border: 2px medium #000;">4</td>
        <td style="width: 15;text-align: ;text-align: right;border: 2px medium #000;" >5</td>
        <td style="width: 15;height: 20;text-align: left;border: 2px medium #000;">6</td>
        <td style="width: 20;height: 20;text-align: right;border: 2px medium #000;">=('PROCESO NP1'!D6-('PROCESO NP1'!P12+'PROCESO NP1'!P13+'PROCESO NP1'!P14+'PROCESO NP1'!P15+'PROCESO NP2'!P16+'PROCESO NP2'!P10+'PROCESO NP2'!P11+'PROCESO NP3'!P11))*0,01%</td>
    </tr>
    @endfor
</table>

</html>
