<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            margin: 0;
            padding: 0;
            text-indent: 0;
        }

        html,
        body,
        .container-fluid {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-top: 5px;
            margin-right: auto;
            margin-left: auto;
        }

        .saltoDePagina {
            page-break-after: always;
        }

        .s1 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 11.5pt;
        }

        .s2 {
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 12pt;
        }
        .s3{
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 11pt;
        }
        .s4{
            color: black;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 8pt;
        }
        
        
        .underline-a { 
            border-bottom: 1px solid currentColor;
            width:150px;
            display: inline-block;
            line-height: 1.3;
            margin-top: 2px;
            margin-left: 10px;
        }
    </style>
    <?php
        $fieldsArray = json_decode(utf8_encode($purchase->data_serialize));
        foreach ($fieldsArray as $key => $value) {
            if ($value->name == 'dLQrpaV2') {
            $precio = $value->value;
            }
        }
    ?>
</head>

<body>
    {{-- Hoja 5 --}}
    <div class="container-fluid">
        <p style="text-indent: 0pt;text-align: left;"><br></p>
        <table style="border-collapse:collapse;margin-left:8.52pt;width: 755px" cellspacing="0">
            <tr style="height:22pt">
                <td style="">
                    <p style="text-indent: 0pt;text-align: left;"><br /></p>
                    <p style="text-indent: 0pt;text-align: left;"><br /></p>
                </td>
                <td style="">
                    <p class="s1" style="padding-left: 64pt;text-indent: 0pt;line-height: 16pt;text-align: left;"><a
                            name="bookmark1">Número de expediente: </a><b>F
                            {{ $purchase->id }}</b></p>
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
            </tr>

            <tr style="height:32pt">
                <td style="" colspan="2">
                    <p class="s1" style="padding-left: 58pt;padding-right: 79pt;text-indent: 0pt;text-align: center;">
                        <?php $current_year = date_create($purchase_management->current_year);?>
                        En Madrid a: {{ date_format($current_year,"d/m/Y") }}</p>
                    <p style="text-indent: 0pt;text-align: left;"><br /></p>
                </td>
            </tr>
            <tr style="height:53pt">
                <td style="" colspan="2">
                    <p class="s1" style="padding-left: 58pt;padding-right: 79pt;text-indent: 0pt;text-align: center;">
                        Entrega de motocicleta a centro autorizado de tratamiento de vehículos al final de su vida útil.
                    </p>
                </td>
            </tr>
            <tr style="height:28pt">
                <td style="" colspan="2">
                    <p style="text-indent: 0pt;text-align: left;"><br /></p>
                    <p class="s1" style="padding-left: 58pt;padding-right: 79pt;text-indent: 0pt;text-align: center;">
                        Propietario:</p>
                    <p style="text-indent: 0pt;text-align: left;"><br /></p>
                </td>
            </tr>
            <tr style="height:42pt">
                <td style="width:534pt" colspan="2">
                    <p class="s1"
                        style="padding-top: 1pt;text-indent: 0pt;line-height: 11pt;text-align: center;">
                        De una parte, D. <b>{{ $purchase_management->name }}
                            {{ $purchase_management->firts_surname }}
                            {{ $purchase_management->second_surtname }}</b> con D.N.I.:
                        <b>{{ $purchase_management->dni }}</b> <br> y domicilio en:
                        <b>{{ $purchase_management->street }} {{ $purchase_management->nro_street }}
                            {{ $purchase_management->stairs }} {{ $purchase_management->floor }}
                            {{ $purchase_management->letter }}</b> &nbsp; en calidad de propietario.</p>
                </td>
            </tr>
        </table>
        <table style="border-collapse:collapse;margin-left:8.52pt;width: 755px" cellspacing="0">
            <tr style="height:33pt">
                <td style="width:534pt">
                    <p style="text-indent: 0pt;text-align: left;"><br /></p>
                    <p class="s1" style="padding-left: 58pt;padding-right: 79pt;text-indent: 0pt;text-align: center;">
                        Centro de tratamiento:</p>
                    <p style="text-indent: 0pt;text-align: left;"><br /></p>

                </td>
            </tr>
        </table>
        <table style="border-collapse:collapse;margin-left:8.52pt;width: 740px" cellspacing="0">
            <tr style="height:53pt">
                <td style="width:534pt" colspan="2">
                    <p class="s1" style="padding-top: 4pt;text-indent: 14pt;text-align: justify;"><span>
                        De otra parte: motOstion, con NIF: B80804156 y dirección en C/ Matilde Hernandez nº10, 28019,
                        Madrid. Tel.:914716248</span></p>
                        <p class="s1" style="padding-top: 4pt;text-indent: 14pt;text-align: justify;"><span>
                        Con número de CAT: CATV/MD/12173 y e-mail: info@motostion.com. En calidad de centro autorizado
                        de tratamiento de vehículos al final de su vida útil.</span></p>

                    <p style="text-indent: 0pt;text-align: left;"><br /></p>
                </td>
            </tr>
        </table>
        <table style="border-collapse:collapse;margin-left:8.52pt;width: 755px" cellspacing="0">
            <tr style="height:25pt">
                <td style="width:534pt" colspan="2">
                    <p class="s1"
                        style="padding-top: 5pt;text-indent: 0pt;text-align: center;">
                        Manifiestan:</p>
                    <p style="text-indent: 0pt;text-align: left;"><br /></p>
                </td>
            </tr>
        </table>
        <table style="border-collapse:collapse;margin-left:8.52pt;width: 740px" cellspacing="0">
            <tr style="height:89pt">
                <td  >
                  
                <p class="s1" style="padding-top: 4pt;text-indent: 14pt;text-align: justify;"><span>
                        El propietario, declara en este acto que dicho vehículo es de su absoluta y exclusiva
                        propiedad y se halla libre de cargas o gravámenes, se responsabiliza de cualquier
                        concepto que pudiese aparecer contra el referido vehículo y responda a actos anteriores
                        a la fecha.</span></p>
                    <p style="text-indent: 0pt;text-align: left;"><br /></p>
                
                    <p class="s1" style="padding-top: 4pt;text-indent: 14pt;text-align: justify;"><span> El
                        propietario hace entrega del vehiculo para que pueda ser vendido o descontaminado, segun
                        convenga a motOstion desde la fecha de de firma de este documento.</span></p>
                    <p style="text-indent: 0pt;text-align: left;"><br /></p>
                         
                </td>
            </tr>
        </table>
        <table style="border-collapse:collapse;margin-left:8.52pt;width: 740px" cellspacing="0">
            <tr style="height:39pt">
                <td style="width:534pt" colspan="2">
                    <p style="text-indent: 0pt;text-align: left;"><br /></p>
                    <p class="s1" style=";text-indent: 0pt;text-align: center;">
                        Datos del vehículo</p>
                    <p style="text-indent: 0pt;text-align: left;"><br /></p>
                    <p style="text-indent: 0pt;text-align: left;"><br /></p>
                </td>
            </tr>
            <tr style="height:123pt">
                <td style="width:288pt">
                    <p class="s1" style="padding-top: 7pt;padding-left: 34pt;text-indent: 0pt;text-align: left;">Marca:
                        <b>{{ $purchase->brand }}</b></p>
                    <p style="text-indent: 0pt;text-align: left;"><br /></p>
                    <p class="s1" style="padding-left: 34pt;text-indent: 0pt;text-align: left;">Modelo:
                        <b>{{ $purchase_management->model }}</b></p>
                    <p style="text-indent: 0pt;text-align: left;"><br /></p>
                    <p class="s1" style="padding-left: 34pt;text-indent: 0pt;text-align: left;">Versión:
                        <b>{{ $purchase_management->version }}</b></p>
                </td>
                <td style="width:288pt">
                    <p class="s1" style="padding-top: 7pt;padding-left: 34pt;text-indent: 0pt;text-align: left;">Número
                        de bastidor: <b>{{ $purchase_management->frame_no }}</b></p>
                    <p style="text-indent: 0pt;text-align: left;"><br /></p>
                    <p class="s1" style="padding-left: 34pt;text-indent: 0pt;text-align: left;">Número de motor:
                        <b>{{ $purchase_management->type_motor }}</b></p>
                    <p style="text-indent: 0pt;text-align: left;"><br /></p>
                    <p class="s1" style="padding-left: 34pt;text-indent: 0pt;text-align: left;">Matrícula:
                        <b>{{ $purchase_management->registration_number }}</b></p>
                </td>
            </tr>
            <tr style="height:97pt">
                <td style="width:534pt" colspan="2">
                    <p style="text-indent: 0pt;text-align: left;"><br /></p>
                    <p style="text-indent: 0pt;text-align: left;"><br /></p>
                    <p class="s1"
                        style="padding-top: 8pt;padding-left: 58pt;padding-right: 80pt;text-indent: 0pt;line-height: 11pt;text-align: center;">
                        Y para que conste, firman la presente en el lugar y fecha arriba indicados. <br>
                        El vendedor recibe copia de este contrato en el momento de la firma de este documento.</p>
                </td>
            </tr>
        </table>
        <table style="border-collapse:collapse;margin-left:8.52pt;width: 740px" cellspacing="0">
            <tr style="height:55pt">
                <td style="200px">
                    <p style="text-indent: 0pt;text-align: left;"><br /></p>
                    <p style="text-indent: 0pt;text-align: left;"><br /></p>
                    <p class="s1" style="text-indent: 0pt;text-align: center;">Propietario del Vehículo
                    </p>
                    <p class="s1" style="text-indent: 0pt;text-align: center;">
                        <b>{{ $purchase_management->name }} {{ $purchase_management->firts_surname }}
                        {{ $purchase_management->second_surtname }}</b></p>
                </td>
                <td style="width:400px">
                    <p style="text-indent: 0pt;text-align: left;"><br /></p>
                    <p style="text-indent: 0pt;text-align: left;"><br /></p>
                    <p class="s1"
                        style="padding-right: 33pt;text-indent: 0pt;line-height: 14pt;text-align: center;">
                        Centro Autorizado de Vehículos al Final de su Vida Útil motOstion </p>
                </td>
            </tr>
        </table>

        <div class="saltoDePagina"></div>
    </div> 
    {{-- Hoja 7 --}}
    <div class="container-fluid">       
        <table style="border-collapse:collapse;margin-left:7.03pt;width: 755px" cellspacing="0">
            <tr style="height:14pt">
                <td style="width:50px;">
                    <img width="87" height="88" alt="image" src="{{ asset('index_files/Image_006.png') }}" />
                </td>
                <td>
                    <p class="s1" style="padding-top: 20pt;padding-left: 30pt;text-indent: 0pt;text-align: left;"><a
                            name="bookmark2"><span><b>MINISTERIO<br />DEL INTERIOR</b></span></a></p>
                </td>
                <td style="width:260px;" colspan="2">
                    <p class="s1"
                        style="margin-top: 20pt;text-indent: 0pt;text-align: center; border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                        <b>DIRECCIÓN GENERAL DE TRÁFICO</b></p>

                    <p class="s4" style="margin-top: 10pt; padding-left: 47pt;text-indent: 0pt;text-align: center;">
                        <span>JEFATURA PROVINCIAL DE TRÁFICO</span></p>
                    <p class="s4" style="padding-left: 47pt;text-indent: 0pt;line-height: 8pt;text-align: center;">DE
                    </p>
                    <p style="padding-top: 3pt;padding-left: 80pt;text-indent: 0pt;line-height: 1pt;text-align: left;">
                        _______________</p>
                </td>
            </tr>
        </table>

        <table style="border-collapse:collapse;margin-left:7.03pt;width: 755px" cellspacing="0">
            <tr style="height:53pt">
                <td style="">
                    <p class="s1" style="padding-top: 6pt;padding-left: 20pt;text-indent: 0pt;text-align: center;font-size: 14pt">
                        SOLICITUD DE BAJA DEFINITIVA POR CAT</p>
                    <p class="s1" style="padding-left: 20pt;text-indent: 0pt;text-align: center;"><b>(Orden INT/ 624
                        /2008, de 26 de febrero)</b></p>
                    <p class="s1" style="text-indent: 0pt;text-align: right;"><b>DATOS DEL VEHÍCULO</b></p>
                </td>
            </tr>
            <tr>

            </tr>
        </table>

        <table style="border-collapse:collapse;margin-left:8.52pt;width: 755px" cellspacing="0">
            <tr style="height:28pt">
                <td
                    style="width:142pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s1" style="padding-top: 6pt;text-indent: 0pt;text-align: center;">
                        Matrícula</p>
                </td>
                <td
                    style="width:158pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s1" style="padding-top: 6pt;text-indent: 10pt;line-height: 14pt;text-align: center;">
                        <span>Fecha de matriculación</span></p>
                </td>
                <td
                    style="width:196pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s1"
                        style="text-indent: 0pt;line-height: 14pt;text-align: center;">
                        Bastidor</p>
                    <p class="s1"
                        style="text-indent: 0pt;line-height: 13pt;text-align: center;">
                        (6 últimas cifras)</p>
                </td>
            </tr>
            <tr style="height:60pt">
                <td
                    style="width:142pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="text-indent: 0pt;text-align: center;"></p>
                    <p class="s2" style="padding-top: 10pt;padding-bottom: 4pt ;text-indent: 0pt;line-height: 10pt;text-align: center;">    {{ $purchase_management->registration_number }}
                    </p>
                </td>
                <td
                    style="width:158pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="text-indent: 0pt;text-align: center;"></p>
                    <p class="s2" style="padding-top: 10pt;padding-bottom: 4pt ;text-indent: 0pt;line-height: 10pt;text-align: center;">    {{ $purchase_management->registration_date }}
                    </p>
                </td>
                <td
                    style="width:196pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="text-indent: 0pt;text-align: center;"></p>
                    <p class="s2" style="padding-top: 10pt;padding-bottom: 4pt ;text-indent: 0pt;line-height: 10pt;text-align: center;">
                        {{ $purchase_management->frame_no }}
                    </p>
                </td>
            </tr>
        </table>

        <p class="s1" style="padding-left: 24pt;text-indent: 0pt;text-align: left; margin-top: 10pt;"><b>FECHA DE ENTREGA
            DEL VEHÍCULO</b>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>TIPO
            DE BAJA</b></p>
        <table style="border-collapse:collapse;margin-left:8.52pt;width: 755px" cellspacing="0">
            <tr style="height:28pt;">
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt; width: 160pt">

                </td>
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s2" style="padding-top: 0pt;padding-left: 8pt;text-indent: 0pt;text-align: left;">
                        <input type="checkbox" name="" id="" checked> ORDINARIA
                        <input type="checkbox" name="" id=""> DE OFICIO
                        <input type="checkbox" name="" id=""> TRATAMIENTO RESIDUAL
                    </p>
                </td>
            </tr>
        </table>

        <p style="text-indent: 0pt;line-height: 6pt;text-align: left;"><span
                style=" color: black; font-family:&quot;MS UI Gothic&quot;, sans-serif; font-style: normal; font-weight: normal; text-decoration: none; font-size: 6pt;">&nbsp;</span>
        </p>
        <p style="padding-left: 17pt;text-indent: 0pt;text-align: left;" />
        <p style="text-indent: 0pt;text-align: left;" />

        <table style="border-collapse:collapse;margin-left:7.03pt;width: 755px" cellspacing="0">
            <tr style="height:53pt">
                <td style="">
                    <p class="s1" style="padding-top: 7pt;padding-left: 256pt;text-indent: 0pt;text-align: right;">
                        <b>CONCEPTO EN EL QUE SOLICITA LA BAJA</b></p>
                </td>
            </tr>
        </table>

        <table style="border-collapse:collapse;margin-left:8.52pt;width: 755px" cellspacing="0">
            <tr style="height:28pt;">
                @if ($purchase_management->vehicle_delivers == 'Titular') 
                <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt; width: 160pt">
                    <p class="s1" style="padding-top: 2pt;padding-left: 53pt;text-indent: 0pt;text-align: left;">
                        <input type="checkbox" name="" id="" checked> TITULAR
                    </p>

                </td>
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s1" style="padding-top: 0pt;padding-left: 8pt;text-indent: 0pt;text-align: left;">
                        <input type="checkbox" name="" id=""> PROPIETARIO <span class="s13">(APORTAR DOCUMENTACIÓN QUE
                            LO ACREDITE)</span>

                    </p>
                </td>               
                @elseif ($purchase_management->vehicle_delivers == 'Propietario') 
                <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt; width: 160pt">
                    <p class="s1" style="padding-top: 2pt;padding-left: 53pt;text-indent: 0pt;text-align: left;">
                        <input type="checkbox" name="" id="" > TITULAR
                    </p>

                </td>
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s1" style="padding-top: 0pt;padding-left: 8pt;text-indent: 0pt;text-align: left;">
                        <input type="checkbox" name="" id="" checked> PROPIETARIO <span class="s13">(APORTAR DOCUMENTACIÓN QUE
                            LO ACREDITE)</span>

                    </p>
                </td>
                @else
                <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt; width: 160pt">
                    <p class="s1" style="padding-top: 2pt;padding-left: 53pt;text-indent: 0pt;text-align: left;">
                        <input type="checkbox" name="" id="" > TITULAR
                    </p>

                </td>
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s1" style="padding-top: 0pt;padding-left: 8pt;text-indent: 0pt;text-align: left;">
                        <input type="checkbox" name="" id="" > PROPIETARIO <span class="s13">(APORTAR DOCUMENTACIÓN QUE
                            LO ACREDITE)</span>

                    </p>
                </td>
                @endif
            </tr>
        </table>

        <p class="s1" style="padding-top: 2pt;text-indent: 0pt;text-align: right;"><b>DATOS DEL CENTRO DE TRATAMIENTO</b></p>
        <table style="border-collapse:collapse;margin-left:8.52pt;width: 755px" cellspacing="0">
            <tr style="height:23pt">
                <td
                    style="width:191pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s1" style="padding-top: 4pt;text-indent: 0pt;text-align: center;">Nombre
                    </p>
                </td>
                <td
                    style="width:135pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s1" style="padding-top: 4pt;text-indent: 0pt;text-align: center;">CIF
                    </p>
                </td>
                <td
                    style="width:163pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s1" style="padding-top: 4pt;text-indent: 0pt;text-align: center;">Nº de
                        autorización</p>
                </td>
            </tr>_
            <tr style="height:23pt">
                <td
                    style="width:191pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s2" style="text-indent: 0pt;line-height: 20pt;text-align: center;">
                        <b>motOstion S.L.</b></p>
                </td>
                <td
                    style="width:135pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s2" style="padding-left: 19pt;text-indent: 0pt;line-height: 22pt;text-align: center;">
                        <b>B80804156</b></p>
                </td>
                <td
                style="width:163pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s2" style="padding-left: 12pt;text-indent: 0pt;line-height: 22pt;text-align: center;"><b>CAT/MD/121736</b></p>
                </td>
            </tr>
        </table>

        <p class="s1" style="padding-top: 9pt;text-indent: 0pt;text-align: right;"><b>DATOS DEL TITULAR / TITULARES</b>    </p>
        <table style="border-collapse:collapse;margin-left:8.52pt;width: 755px" cellspacing="0">
            <tr style="height:23pt">
                <td style="width:370px;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    >
                    <p class="s1" style="padding-top: 4pt;text-indent: 0pt;text-align: center;">1er
                        apellido</p>
                </td>
                <td
                    style="width:370px;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s1"
                        style="padding-top: 4pt;text-indent: 0pt;text-align: center;">
                        2 º apellido</p>
                </td>
            </tr>
            <tr style="height:28pt">
                <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    >
                    <p class="s2" style="padding-left: 6pt;padding-top: 6pt;padding-bottom: 4pt;text-indent: 0pt;line-height: 14pt;text-align: left;">
                        {{ $purchase_management->firts_surname }}</p>
                </td>
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s2" style="padding-left: 6pt;padding-top: 6pt;padding-bottom: 4pt;text-indent: 0pt;line-height: 14pt;text-align: left;">
                        {{ $purchase_management->second_surtname }}</p>
                </td>
            </tr>
        </table>
        <table style="border-collapse:collapse;margin-left:8.52pt;width: 755px" cellspacing="0">
            <tr style="height:23pt">
                <td
                    style="width:180pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s1" style="padding-top: 4pt;text-indent: 0pt;text-align: center;">
                        Nombre/ Razón social</p>
                </td>
                <td
                    style="width:100pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s1" style="padding-top: 4pt;text-indent: 0pt;text-align: center;">
                        DNI/NIE/CIF</p>
                </td>
                <td
                    style="width:100pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s1" style="padding-top: 4pt;text-indent: 0pt;text-align: center;">Fecha
                        nacimiento</p>
                </td>
            </tr>
            <tr style="height:28pt">
                <td
                    style="width:100pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s2" style="padding-left: 6pt;padding-top: 6pt;padding-bottom: 4pt;text-indent: 0pt;line-height: 14pt;text-align: left;">
                        {{ $purchase_management->name }}</p>
                </td>
                <td
                    style="width:100pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s2" style="padding-left: 6pt;padding-top: 6pt;padding-bottom: 4pt;text-indent: 0pt;line-height: 14pt;text-align: left;">
                        {{ $purchase_management->dni }}</p>
                </td>
                <td
                    style="width:100pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s2" style="padding-left: 6pt;padding-top: 6pt;padding-bottom: 4pt;text-indent: 0pt;line-height: 14pt;text-align: left;">
                        <?php $birthdate = date_create($purchase_management->birthdate);?>
   
                        {{ date_format($birthdate,"d/m/Y") }}</p>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td><p class="s1" style="padding-left: 25pt; text-indent: 0pt;text-align: left;">
                    <span style="text-indent: 0pt;text-align: left;"><b>(A RELLENAR SOLO EN CASO DE SER DISTINTO DEL TITULAR)</b></span></p></td>
                    <td><p class="s1" style="padding-left: 25pt; text-indent: 0pt;text-align: right;">
                        <span style="padding-left: 25pt; text-indent: 0pt;text-align: left;"><b>DATOS DEL PROPIETARIO</b></span>
                    </p></td>
            </tr>
        </table>
        <table style="border-collapse:collapse;margin-left:8.52pt;width: 755px" cellspacing="0">
            <tr style="height:23pt">
                <td style="width:370px;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    >
                    <p class="s1" style="padding-top: 4pt;text-indent: 0pt;text-align: center;">1er
                        apellido</p>
                </td>
                <td
                    style=width:370px;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s1" style="padding-top: 4pt;text-indent: 0pt;text-align: center;">2 º
                        apellido</p>
                </td>
            </tr>
            <tr style="height:23pt">
                <td style=";border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    >
                    <p class="s2" style="padding-left: 6pt;padding-top: 4pt;text-indent: 0pt;line-height: 14pt;text-align: center;">
                        {{ $purchase_management->firts_surname_representative }} <br></p>
                </td>
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s2" style="padding-left: 6pt;padding-top: 4pt;text-indent: 0pt;line-height: 14pt;text-align: center;">
                        {{ $purchase_management->second_surtname_representantive }} <br></p>
                </td>
            </tr>
        </table>
        <table style="border-collapse:collapse;margin-left:8.52pt;width: 755px" cellspacing="0">
            <tr style="height:23pt">
                <td
                    style="width:199pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s1" style="padding-top: 4pt;text-indent: 0pt;text-align: center;">
                        Nombre/ Razón social</p>
                </td>
                <td
                    style="width:148pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s1" style="padding-top: 4pt;text-indent: 0pt;text-align: center;">
                        DNI/NIE/CIF</p>
                </td>
                <td
                    style="width:142pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s1" style="padding-top: 4pt;ptext-indent: 0pt;text-align: center;">Fecha
                        nacimiento</p>
                </td>
            </tr>
            <tr style="height:23pt">
                <td
                    style="width:199pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s2" style="padding-left: 6pt;padding-top: 4pt;text-indent: 0pt;line-height: 14pt;text-align: center;">
                        {{ $purchase_management->name_representantive }}<br></p>
                </td>
                <td
                    style="width:148pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s2" style="padding-left: 6pt;padding-top: 4pt;text-indent: 0pt;line-height: 14pt;text-align: center;">
                        {{ $purchase_management->dni_representantive }}<br></p>
                </td>
                <td
                    style="width:142pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s2" style="padding-left: 6pt;padding-top: 4pt;text-indent: 0pt;line-height: 14pt;text-align: center;">
                        <?php $birthdate_representative = date_create($purchase_management->birthdate_representative);?>
                       @if($purchase_management->birthdate_representative != '0000-00-00')
                         {{ date_format($birthdate_representative,"d/m/Y") }} <br> 
                       @endif
                        
                    </p>
                </td>
            </tr>
        </table>

        <table style="border-collapse:collapse;margin-left:8.52pt;width: 755px;margin-top: 5" cellspacing="0">
            <tr style="height:23pt">
                <td style="width: 200pt">
                    <p class="s4" style="padding-top: 4pt;padding-left: 91pt;text-indent: 1pt;text-align: left;">
                        <span>(sello y número del Centro Autorizado de Tratamiento)</span></p>
                </td>
                <td>
                    <p class="s4" style="padding-top: 4pt;padding-left: 89pt;text-indent: 0pt;text-align: left;">
                        <span>Por la presente declaro tener facultad de disposición sobre el vehículo arriba
                            indicado y solicito su baja entregándolo en la fecha señalada en el Centro de
                            Tratamiento referenciado.</span></p>
                    <p style="text-indent: 0pt;text-align: left;">
                    <p class="s1" style="padding-top: 6pt;padding-left: 89pt;text-indent: 0pt;text-align: left;">
                        <span>
                            @if ($purchase_management->vehicle_delivers == 'Titular')
                                <input type="checkbox" name="" id="" checked>TITULAR
                                <input type="checkbox" name="" id="">PROPIETARIO<br />
                                <input type="checkbox" name="" id="">REPRESENTANTE:
                            @elseif ($purchase_management->vehicle_delivers == 'Propietario')
                                <input type="checkbox" name="" id="">TITULAR
                                <input type="checkbox" name="" id="" checked>PROPIETARIO<br />
                                <input type="checkbox" name="" id="">REPRESENTANTE
                            @elseif ($purchase_management->vehicle_delivers == 'Representante')
                                <input type="checkbox" name="" id="">TITULAR
                                <input type="checkbox" name="" id="">PROPIETARIO<br />
                                <input type="checkbox" name="" id="" checked>REPRESENTANTE
                            @endif
                            
                        </span>
                    </p>
                    <p class="s1" style="padding-left: 92pt;text-indent: 0pt;line-height: 10pt;text-align: left;">DNI: <span class="s4" style="padding-left: 3pt;text-indent: 0pt;line-height: 14pt;text-align: left;"><b>{{ $purchase_management->dni }}</b></span>
                    </p>
                    <p class="s1" style="padding-left: 91pt;text-indent: 0pt;line-height: 10pt;text-align: left;">
                        NOMBRE Y APELLIDOS: <span class="s4" style="padding-left: 3pt;text-indent: 0pt;line-height: 14pt;text-align: left;"><b>{{ $purchase_management->name }} {{ $purchase_management->firts_surname }}
                            {{ $purchase_management->second_surtname }}</b></span>
                    </p>
                    <?php
 
                        $diassemana = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
                        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                        $fecha = date_create($purchase_management->current_year);
                        $mes = date_format($fecha ,"n");
                        //Salida: Miercoles 05 de Septiembre del 2016
                    
                    ?>
                    <p class="s1" style="padding-top: 2pt;padding-left: 85pt;text-indent: 2pt;text-align: left;">
                        <span class="s1"> MADRID</span> <span class="s30">, a {{ date_format($fecha ,"d") }} {{ $meses[date($mes)-1] }}</span><span class="s1" style="text-decoration: none;" > de {{ date_format($fecha ,"Y") }}</span>
                        </p>
                        <p class="s1" style="padding-top: 4pt;padding-left: 90pt;text-indent: 0pt;line-height: 10pt;text-align: left;">FIRMA 
                        </p>
                </td>
            </tr>
        </table>

        <p class="s1" style="padding-top: 20pt;padding-left: 29pt;text-indent: 0pt;text-align: left;">Sr. Jefe
            Provincial de Tráfico de <span class="s33">&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </span></p>
        <div class="saltoDePagina"></div>
    </div>
    {{-- Hoja 12 --}}
    <div class="container-fluid">
        <p style="text-indent: 0pt;text-align: left;"><br /></p>
        <table style="border-collapse:collapse;margin-left:8.04pt;width: 755px" cellspacing="0">
            <tr style="height:35pt">
                <td style="width:489pt">
                    <p class="s1" style="padding-top: 30pt; text-indent: 0pt;line-height: 11pt;text-align: center;">
                        <b>DECLARACIÓN</b></p>
                </td>
            </tr>
            <tr style="height:97pt">
                <td style="width:489pt">
                    <p style="text-indent: 0pt;text-align: justify;"><br /></p>
                    <p class="s3" style="padding-top: 4pt;padding-left: 12pt;text-indent: 14pt;text-align: justify;"><span> D./Dª.
                        <b>{{ $purchase_management->name }} {{ $purchase_management->firts_surname }}
                        {{ $purchase_management->second_surtname }}</b> con D.N.I. núm. <b>{{ $purchase_management->dni }}</b>
                        domicilio de provincia de <b>{{ $purchase_management->province }}</b> con dirección <b>{{ $purchase_management->street }}</b>,  nro
                            <b>{{ $purchase_management->nro_street }}</b>,  
                            @if(!!$purchase_management->stairs) escalera, <b>{{ $purchase_management->stairs }}</b> @endif
                            @if(!!$purchase_management->floor) piso <b>{{ $purchase_management->floor }}</b>, @endif   
                             @if(!!$purchase_management->letter) letra <b>{{ $purchase_management->letter }}</b> @endif  declara haber
                            extraviado la documentación del vehículo matrícula
                            <b>{{ $purchase_management->registration_number }}</b>, marca
                            <b>{{ $purchase_management->brand }}</b> y se compromete a entregarla a motOstion en caso de
                        que aparezca.</span></p>
                </td>
            </tr>
        </table>
        <table style="border-collapse:collapse;margin-left:8.04pt;margin-top:50px;width: 755px;" cellspacing="0">
            <tr style="height:45pt">
                <td style="">
                    <p class="s3"
                        style="padding-top: 3pt;padding-left: 10pt;text-indent: 0pt;line-height: 13pt;text-align: left;">
                        Firma del titular:</p>
                </td>
                <td style="">
                    <?php
 
                        $diassemana = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
                        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                        $fecha = date_create($purchase_management->current_year);
                        $mes = date_format($fecha ,"n");
                        //Salida: Miercoles 05 de Septiembre del 2016
                    
                    ?>
                    <p class="s3" style="padding-top: 3pt;padding-left: 10pt;text-indent: 0pt;line-height: 13pt;text-align: right;">
                        <span class="s30"> A {{ date_format($fecha ,"d") }} {{ $meses[date($mes)-1] }}</span><span class="s30" style="text-decoration: none;" > de {{ date_format($fecha ,"Y") }}</span></p>
                </td>
            </tr>
        </table>

        <div class="saltoDePagina"></div>
    </div>
    {{-- Hoja 13 --}}
    <div class="container-fluid">
        <table style="border-collapse:collapse;margin-left:8.04pt;width: 755px" cellspacing="0">
            <tr style="height:35pt">
                <td style="width:489pt">
                    <p class="s1" style="padding-top: 40pt; text-indent: 0pt;line-height: 11pt;text-align: center;">
                        <b>RECIBO DE COMPRA</b></p>
                </td>
            </tr>
            <tr style="height:97pt">
                <td style="width:489pt">
                    <p style="text-indent: 0pt;text-align: justify;"><br /></p>
                    <p style="text-indent: 0pt;text-align: justify;"><br /></p>
                    <p class="s3" style="padding-top: 4pt;padding-left: 12pt;text-indent: 14pt;text-align: justify;"><span>D.
                        <b>{{ $purchase_management->name }} {{ $purchase_management->firts_surname }}
                        {{ $purchase_management->second_surtname }}</b> con D.N.I. núm. <b>{{ $purchase_management->dni }}</b>
                         y domicilio en: <b>{{ $purchase_management->street }}
                            {{ $purchase_management->nro_street }} {{ $purchase_management->stairs }}
                            {{ $purchase_management->floor }} {{ $purchase_management->letter }},
                            {{ $purchase_management->postal_code }}</b>, vendo a motOstion, con NIF: <b>B80804156</b>  y
                        dirección en <b>C/Matilde Hernandez n°10, 28019, Madrid</b>. Un despiece completo del vehiculo de mi
                        propriedad marca <b>{{ $purchase->brand }}</b>, modelo <b>{{ $purchase->model }}</b>, matrícula
                        <b>{{ $purchase_management->registration_number }}</b></span></p>

                    <p class="s3" style="padding-left: 10pt;text-indent: 0pt;line-height: 14pt;text-align: left;">Por
                        un total de <b>{{ $precio }}</b> Euros, por los siguientes repuestos:</p>

                </td>
            </tr>
        </table>
        <table style="border-collapse:collapse;margin-left:8.04pt;width: 755px" cellspacing="0">
            <tr style="height:35pt">
                <td style="width:489pt">
                    <p class="s3" style="padding-top: 40pt; text-indent: 0pt;line-height: 11pt;text-align: center;">
                        Forma de pago</p>
                </td>
            </tr>
        </table>
        <table style="border-collapse:collapse;margin-left:8.04pt;margin-top:30px;width: 755px" cellspacing="0">
            <tr style="height:35pt">
                <td style="border: 1px solid currentColor;border-right:none;">
                    <p style="text-indent: 0pt;text-align: justify;"><br /></p>
                    <p class="s3" style="padding-left: 10pt;text-indent: 2pt;line-height: 12pt;text-align: left;">Al
                        contado:</p>
                    <p class="s3" style="padding-left: 10pt;text-indent: 2pt;line-height: 12pt;text-align: left;">El
                        vendedor recibe en este acto la cantidad acordada por parte de motOstion y para que conste firma
                        en el lugar y la fecha indicada.</p>
                    <p class="s3" style="padding-left: 10pt;text-indent: 0pt;line-height: 12pt;text-align: left;">en
                        Madrid a :</p>
                    <p style="text-indent: 0pt;text-align: justify;"><br /></p>
                    <p style="text-indent: 0pt;text-align: justify;"><br /></p>
                </td>
                <td style="width: 200px; border: 1px solid currentColor; border-left:none;">
                    <p style="text-indent: 0pt;text-align: justify;"><br /></p>
                    <p style="text-indent: 0pt;text-align: justify;"><br /></p>
                    <p style="text-indent: 0pt;text-align: justify;"><br /></p>
                    <table style="width: 200px;">
                        <tr>
                            <td style="background:#D9D9D9;border: 1px solid #D9D9D9">
                                <p class="s3"
                                    style="padding-left: 10pt;text-indent: 0pt;line-height: 14pt;text-align: center;">
                                    <b>Firma</b></p>
                                <p style="text-indent: 0pt;text-align: justify;"><br /></p>
                                <p style="text-indent: 0pt;text-align: justify;"><br /></p>
                            </td>
                        </tr>
                    </table>

                </td>
            </tr>
        </table>
        <table style="border-collapse:collapse;margin-left:8.04pt;margin-top:30px;width: 755px" cellspacing="0">
            <tr style="height:35pt">
                <td style="border: 1px solid solid #000;border-right:none;">
                    <p style="text-indent: 0pt;text-align: justify;"><br /></p>
                    <p class="s3" style="padding-left: 10pt;text-indent: 0pt;line-height: 12pt;text-align: left;">
                        Transferencia Bancaria:</p>
                    <p class="s3" style="padding-left: 10pt;text-indent: 2pt;line-height: 12pt;text-align: left;">El
                        vendedor recibirá el importe acordado a través de transferencia bancaria en el plazo de 5 días
                        hábiles desde el momento en que el vehículo y la documentación llegue a las instalaciones de
                        motOstion.</p>
                    <p class="s3" style="padding-left: 10pt;text-indent: 0pt;line-height: 12pt;text-align: left;">
                        Número de Cuenta :</p>
                    <p class="s3" style="padding-left: 10pt;text-indent: 0pt;line-height: 12pt;text-align: left;"> <b>{{ $purchase_management->iban }}</b> </p>
                    <p style="text-indent: 0pt;text-align: justify;"><br /></p>
                </td>
                <td style="width: 200px; border: 1px solid #000; border-left:none;">
                    <p style="text-indent: 0pt;text-align: justify;"><br /></p>
                    <p style="text-indent: 0pt;text-align: justify;"><br /></p>
                    <p style="text-indent: 0pt;text-align: justify;"><br /></p>
                    <p style="text-indent: 0pt;text-align: justify;"><br /></p>
                    <table style="width: 200px;">
                        <tr>
                            <td style="background:#D9D9D9;border: 1px solid #D9D9D9">
                                <p class="s3"
                                    style="padding-left: 10pt;text-indent: 0pt;line-height: 14pt;text-align: center;">
                                    <b>Firma</b></p>
                                <p style="text-indent: 0pt;text-align: justify;"><br /></p>
                                <p style="text-indent: 0pt;text-align: justify;"><br /></p>
                            </td>
                        </tr>
                    </table>

                </td>
            </tr>
        </table>
    </div>
</body>
</html>