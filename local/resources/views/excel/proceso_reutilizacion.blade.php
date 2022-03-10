<html xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"
    xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">

<?php $sumNp1 = 0; $sumNp2 = 0; $sumNp3 = 0; $sumKilo = 0;  ?>

@foreach($purchases as $purc)
    <?php $sumKilo+=$purc->weight;
    ?>
@endforeach

@foreach($np1 as $np)
    <?php 
        $sumNp1+=$np->sum;
    ?>
@endforeach

@foreach($np2 as $n)
    <?php 
        $sumNp2+=$n->sum;
    ?>
@endforeach

@foreach($np3 as $r)
    <?php 
        if($r->materialC->material->id == 11)
            $sumNp3+=$r->sum;
    ?>
@endforeach

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
    ?>
    @for ($i = 0; $i < $contador; $i++)
    <tr>
        <td style="height: 20;text-align: left;border: 2px medium #000;">B8084156</td>
        <td style="height: 20;text-align: left;border: 2px medium #000;">MOTOSTION SL</td>
        <td style="height: 20;text-align: right;border: 2px medium #000;">2800018300</td>
        <td style="text-align: left;border: 2px medium #000;">NP</td>
        <td style="width: 15;text-align: ;text-align: right;border: 2px medium #000;" >{{ $data[$i]->LER }}</td>
        <td style="width: 15;height: 20;text-align: left;border: 2px medium #000;">{{ $data[$i]->description }}</td>

        <?php 
            $formula = str_replace(" ", "", $data[$i]->percent_formula);
            $sumaProcesos = $sumNp1+$sumNp2+$sumNp3;
            $sumaTotal = eval('return '.(($sumKilo-$sumaProcesos)/1000)*(float)$formula.';'); 

        ?>
        <td style="height: 20;text-align: right;color:#dd0000;border: 2px medium #000;">{{ $sumaTotal }}</td>
    </tr>
    @endfor
</table>
</html>
