<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
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
    {{-- Hoja 8 --}}
    <div class="container-fluid">        
        <table style="border-collapse:collapse;margin-left:8.52pt;width: 755px" cellspacing="0">
            <tr style="height:22pt">
                <td colspan="4">
                    <p class="s2" style="padding-top: 30pt; text-indent: 0pt;line-height: 11pt;text-align: center;">
                        <b>CONTRATO DE COMPRA-VENTA</b></p>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <p class="s1" style="padding-top: 11pt;text-indent: 14pt;  text-align: justify;">  
                        <?php $current_year = date_create($purchase_management->current_year);?>
                        En Madrid a {{ date_format($current_year,"d/m/Y") }} , a las 10:00 reunidos:</p>
                </td>
            </tr>
        </table>
        <table style="border-collapse:collapse;margin-left:8.52pt;width: 755px" cellspacing="0">
            <tr style="height:42pt">
                <td>
                    <p style="text-indent: 0pt;text-align: left;"><br /></p>
                    <p class="s1" style="text-indent: 14pt;line-height: 16pt;text-align: justify;"> De una parte, <b>{{ $purchase_management->name }} {{ $purchase_management->firts_surname }}
                            {{ $purchase_management->second_surtname }}</b> con D.N.I.:
                            <b>{{ $purchase_management->dni }}</b> y domiciliado en:
                            <b>{{ $purchase_management->municipality}}</b> de <b>{{ $purchase_management->province}}</b>, calle  <b>{{ $purchase_management->street }} {{ $purchase_management->nro_street }} {{ $purchase_management->stairs }} {{ $purchase_management->floor }} {{ $purchase_management->letter }}</b>, de código postal <b>{{ $purchase_management->postal_code }}</b>, telefono <b>{{ $purchase_management->phone }}</b>, correo electrónico <b>{{ $purchase_management->email }}</b>  en calidad de <u><b>VENDEDOR.</b></u></p>
                </td>
            </tr>
        </table>
        <table style="border-collapse:collapse;margin-left:8.52pt;width: 755px" cellspacing="0">
            <tr>
                <td>
                    <p style="text-indent: 0pt;text-align: left;"><br /></p>
                    <p class="s1" style="text-indent: 14pt;line-height: 16pt;text-align: justify;">De
                        otra parte <b>motOstion S.L.</b> con C.I.F. <b>B-80804156</b>  domiciliado en <b>Madrid</b> calle <b>Matilde Hernández  nº10</b>, en calidad de <u><b>COMPRADOR</b></u>.</p>
                </td>
            </tr>
        </table>
        <table style="border-collapse:collapse;margin-left:8.52pt;width: 755px" cellspacing="0">
            <tr>
                <td>
                    <p style="text-indent: 0pt;text-align: left;"><br /></p>
                    <h2 class="s1" style="padding-bottom: 4pt;text-indent: 0pt;line-height: 16pt;text-align: center;">
                        MANIFIESTAN</h2>
                    <p class="s1" style="text-indent: 14pt;line-height: 14pt;text-align: justify;"><span>1º- Que no
                            pesa sobre el vehículo ningún gravamen, arbitrio, impuesto ni débito de clase alguna
                            pendiente de liquidación a la fecha de extensión de este contrato, obligándose a estar de
                            entera indemnidad a favor del comprador de cualquier reclamación.</span></p>
                    <p class="s1" style="margin-top: 10pt; text-indent: 14pt;line-height: 14pt;text-align: justify;"><span>2º- Que han
                            convenido, como por el presente documento lo llevan a efecto, formalizar contrato de
                            compra-venta con ello el propietario vendedorda su conformidad para que a su vez pueda ser
                            vendido o desguazado por el comprador desde la fecha de dicho contrato, según convenga al
                            comprador.</span></p>
                </td>
            </tr>
        </table>
        <table style="border-collapse:collapse;margin-left:8.52pt;width: 755px; margin-top: 15pt;" cellspacing="0">
            <tr>
                <td colspan="4">
                    <h3 class="s1" style="padding-left: 4pt;text-indent: 0pt;line-height: 16pt;text-align: center;">CARACTERÍSTICAS
                        DEL VEHICULO</h3>
                    <p class="s1" style="padding-left: 4pt;text-indent: 0pt;text-align: left;">Nº DE BASTIDOR</p>
                    <p class="s1" style="padding-left: 4pt;text-decoration: none;"><b>{{ $purchase_management->frame_no }}</b></p>
                </td>
            </tr>
        </table>
        <table style="border-collapse:collapse;margin-left:8.52pt;width: 755px;" cellspacing="0">
            <tr>
                <td >
                    <h3 class="s1"style="padding-left: 4pt;text-indent: 0pt;line-height: 16pt;text-align: left;">MARCA Y MODELO</h3>
                            <p class="s1" style="padding-left: 4pt;text-decoration: none;"><b>{{ $purchase->brand }}
                                {{ $purchase_management->model }}</b></p>
                </td>
                <td >
                    <h3 class="s1"style="padding-left: 4pt;text-indent: 0pt;line-height: 16pt;text-align: left;">MATRICULA</h3>
                    <p class="s1" style="padding-left: 4pt;text-decoration: none;"><b>{{ $purchase_management->registration_number }}</b>
                    </p>
                </td>
                <td colspan="2" style="margin-top: 5pt;border: 1px solid #000; width: 250px">
                    <h3 class="s1" style="padding-left: 4pt;text-indent: 0pt;line-height: 16pt;text-align: center;">VALOR DE VENTA
                        IVA INCL.</h3>
                    <h3 class="s1" style="padding-top: 9pt;text-indent: 0pt;text-align: center;">€</h3>
                    <p class="s1" style="padding-top: 5pt;text-indent: 0pt;text-align: center;text-decoration: none">
                        <b>{{ round($precio, 2) }}</b></p>
                </td>
            </tr>
        </table>

        <table style="border-collapse:collapse;margin-left:8.52pt;width: 755px; margin-top: -5pt;" cellspacing="0">
            <tr>
                <td>
                    <p class="s1" style="padding-top: 0pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">
                        Especificaciones del vehículo:</p>
                    <p style="text-indent: 0pt;text-align: left;">
                   <table>
                       <tr>
                            @if ($purchase_management->vehicle_state_trafic == 'Alta')
                            <td>
                                <h3 class="s1" style="padding-left: 23pt;text-indent: -18pt;line-height: 17pt;text-align: left;">
                                Dado de alta en DGT </h3>
                            </td>
                            <td>   
                                <input type="checkbox" name="" id="" checked>
                            
                             </td>
                            @else
                            <td>
                                <h3 class="s1" style="padding-left: 23pt;text-indent: -18pt;line-height: 17pt;text-align: left;">
                                Dado de alta en DGT </h3>
                            </td>
                            <td>   
                                <input type="checkbox" name="" id="" >
                            
                             </td>
                            @endif
                       </tr>
                       <tr>
                            @if ($purchase_management->vehicle_state_trafic == 'Baja temporal')
                            <td>
                                <h3 class="s1" style="padding-left: 23pt;text-indent: -18pt;line-height: 17pt;text-align: left;">
                                Dado de baja en DGT </h3>
                            </td>
                            <td>   
                                <input type="checkbox" name="" id="" checked>
                            
                            </td>
                            @else
                            <td>
                                <h3 class="s1" style="padding-left: 23pt;text-indent: -18pt;line-height: 17pt;text-align: left;">
                                Dado de baja en DGT </h3>
                            </td>
                            <td>   
                                <input type="checkbox" name="" id="" >
                            
                            </td>
                            @endif
                        </tr>
                        <tr>
                            @if ($purchase_management->vehicle_state == 'Siniestrado')
                            <td>
                                <h3 class="s1" style="padding-left: 23pt;text-indent: -18pt;line-height: 17pt;text-align: left;">
                                Siniestrado </h3>
                            </td>
                            <td>   
                                <input type="checkbox" name="" id="" checked>
                            
                            </td>
                            @else
                            <td>
                                <h3 class="s1" style="padding-left: 23pt;text-indent: -18pt;line-height: 17pt;text-align: left;">
                                    Siniestrado </h3>
                            </td>
                            <td>   
                                <input type="checkbox" name="" id="" >
                            
                            </td>
                            @endif
                        </tr>
                        <tr>
                            @if ($purchase_management->vehicle_state == 'Averiado' || $purchase_management->vehicle_state == 'Avería Mecánica')
                            <td>
                                <h3 class="s1" style="padding-left: 23pt;text-indent: -18pt;line-height: 17pt;text-align: left;">
                                Averiado </h3>
                            </td>
                            <td>   
                                <input type="checkbox" name="" id="" checked>
                            
                            </td>
                            @else
                            <td>
                                <h3 class="s1" style="padding-left: 23pt;text-indent: -18pt;line-height: 17pt;text-align: left;">
                                    Averiado </h3>
                            </td>
                            <td>   
                                <input type="checkbox" name="" id="" >
                            
                            </td>
                            @endif
                        </tr>
                        <tr>
                            @if ($purchase_management->vehicle_state == 'Abandonado' || $purchase_management->vehicle_state == 'Vieja o Abandonada')
                            <td>
                                <h3 class="s1" style="padding-left: 23pt;text-indent: -18pt;line-height: 17pt;text-align: left;">
                                Abandonado </h3>
                            </td>
                            <td>   
                                <input type="checkbox" name="" id="" checked>
                            
                            </td>
                            @else
                            <td>
                                <h3 class="s1" style="padding-left: 23pt;text-indent: -18pt;line-height: 17pt;text-align: left;">
                                    Abandonado </h3>
                            </td>
                            <td>   
                                <input type="checkbox" name="" id="" >
                            
                            </td>
                            @endif
                        </tr>
                        <tr>
                             @if ($purchase_management->vehicle_state == 'Completo')
                            <td>
                                <h3 class="s1" style="padding-left: 23pt;text-indent: -18pt;line-height: 17pt;text-align: left;">
                                Completo </h3>
                            </td>
                            <td>   
                                <input type="checkbox" name="" id="" checked>
                            
                            </td>
                            @else
                            <td>
                                <h3 class="s1" style="padding-left: 23pt;text-indent: -18pt;line-height: 17pt;text-align: left;">
                                    Completo </h3>
                            </td>
                            <td>   
                                <input type="checkbox" name="" id="" >
                            
                            </td>
                            @endif
                        </tr>
                        <tr>
                           @if ($purchase_management->vehicle_state == 'Parcialmente desmontado')
                           <td>
                               <h3 class="s1" style="padding-left: 23pt;text-indent: -18pt;line-height: 17pt;text-align: left;">
                               Parcialmente desmontado </h3>
                           </td>
                           <td>   
                               <input type="checkbox" name="" id="" checked>
                           
                           </td>
                           @else
                           <td>
                               <h3 class="s1" style="padding-left: 23pt;text-indent: -18pt;line-height: 17pt;text-align: left;">
                                Parcialmente desmontado </h3>
                           </td>
                           <td>   
                               <input type="checkbox" name="" id="" >
                           
                           </td>
                           @endif
                       </tr>
                       <tr>
                           <td><h3 class="s1" style="padding-left: 22pt;text-indent: -18pt;text-align: left;">Color:
                            </h3></td>
                           <td><span class="s1"><b>{{ $purchase_management->color }}</b></span></td>
                       </tr>
                       <tr>
                            <td>
                                <h3 class="s1" style="padding-left: 22pt;text-indent: -18pt;text-align: left;">Kilómetros:</h3>
                            </td>
                            <td><span class="s1"><b>{{ $purchase->km }}</b></span></td>
                        </tr>
                        <tr>
                            <td>
                                <h3 class="s1" style="padding-left: 22pt;text-indent: -18pt;text-align: left;">Más datos:</h3>
                            </td>
                            <td></td>
                        </tr>
                   </table>
                    <br>
                    <p class="s1" style="padding-left: 5pt;text-indent: 0pt;text-align: left;">Táchese lo que proceda
                        con (x)</p>
                </td>
            </tr>
        </table>

        <table style="border-collapse:collapse;margin-left:8.52pt;width: 755px; " cellspacing="0">
            <tr>
                <td colspan="3">
                    <p class="s1" style="padding-top: 8pt;padding-left: 5pt;text-indent: 0pt;text-align: left;"><span>Y
                            para que conste, firman la presente en el lugar y fecha arriba indicados. El vendedor recibe
                            copia de este contrato en el momento de la firma de este<br />documento, así como el dinero
                            acordado por ambas partes.</span></p>
                    <p style="text-indent: 0pt;text-align: left;"><br /></p>
                </td>
            </tr>
            <tr>
                <td>
                    <h3 class="s1" style="padding-left: 41pt;text-indent: 0pt;text-align: left;"><b>EL VENDEDOR</b></h3>
                </td>
                <td></td>
                <td>
                    <h3 class="s1" style="padding-left: 41pt;text-indent: 0pt;text-align: left;"><b>EL COMPRADOR</b></h3>
                </td>
            </tr>
        </table>
        <div class="saltoDePagina"></div>
    </div>
     {{-- Hoja 14 --}}
     <div class="container-fluid">        
        <p style="text-indent: 0pt;text-align: left;"><br></p>
        <p style="text-indent: 0pt;text-align: left;"><br></p>
        <table style="border-collapse:collapse;margin-left:7.03pt;width: 755px" cellspacing="0">
            <tr style="height:14pt">
                <td style="width:150px;; padding-right: 40px">
                    <img width="103" height="46" alt="image" src="{{ asset('index_files/Image_022.jpg') }}" />
                </td>

                <td
                    style="width:350px;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s1" style="text-indent: 1pt;text-align: center;"><b>CAMBIO DE TITULARIDAD Y
                            <br>NOTIFICACIÓN DE VENTA DE VEHÍCULOS</b></p>

                </td>
                <td style="width:200px;padding-left: 110px;">
                    <img width="88" height="44" alt="image" src="{{ asset('index_files/Image_023.jpg') }}" />
                </td>
            </tr>
        </table>
        <p style="text-indent: 0pt;text-align: left;"><br></p>
        <table style="border-collapse:collapse;margin-left:7.03pt;width: 755px" cellspacing="0">
            <tr style="height:14pt">
                <td
                    style="padding-left: 30px;padding-right: 50px;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;">
                    <p class="s1" style="padding-left: 7pt;text-indent: 0pt;line-height: 16pt;text-align: left;">CAMBIO
                        DE TITULARIDAD <span class="s26"><input type="radio" name="" id=""></span></p>
                </td>
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s1" style="padding-top: 2pt;padding-left: 3pt;text-indent: 0pt;text-align: left;">
                        NOTIFICACIÓN DE VENTA <span class="s26"><input type="radio" name="" id="" checked></span></p>
                </td>
            </tr>
        </table>
        <p class="s1" style="padding-left: 10pt;text-indent: 0pt;text-align: left;font-size: 8pt">MOD 02/2016-01-ES</p>

        <table style="border-collapse:collapse;margin-left:7.03pt;width: 755px" cellspacing="0">
            <tr style="height:15pt">
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt; background-color:#D9D9D9">
                    <p class="s3" style="padding-top: 2pt;padding-left: 1pt;text-indent: 0pt;text-align: left;">DATOS
                        DEL VEHÍCULO</p>
                </td>
            </tr>
        </table>
        <table style="border-collapse:collapse;margin-left:7.03pt;width: 755px" cellspacing="0">
            <tr style="height:28pt">
                <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    rowspan="3">
                    <p class="s4" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 7pt;text-align: left;">
                        Matrícula: </p>
                    <p class="s1" style="padding-left: 5px; text-indent: 0pt;line-height: 20px; text-align: left;">{{ $purchase_management->registration_number }}</p>
                </td>
                <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    rowspan="3">
                    <p class="s4" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 7pt;text-align: left;">Fecha
                        matriculación (dd/mm/aaaa):</p>
                    <p class="s1" style="padding-left: 5px;text-indent: 0pt;line-height: 20px; text-align: left;">
                        <?php $registration_date = date_create($purchase_management->registration_date);?>
                        {{ date_format($registration_date,"d/m/Y") }}</p>
                </td>
            </tr>
        </table>
        <table style="border-collapse:collapse;margin-left:7.03pt;width: 755px" cellspacing="0">
            <tr style="height:28pt">
                <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s4" style="padding-left: 3pt;margin-top: -9pt;text-indent: 0pt;text-align: left;">Servicio al que destina el vehículo:</p>
                    <p class="s1" style="padding-left: 5px;text-indent: 0pt;line-height: 20px; text-align: left;"><br></p>
                </td>
                <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s4" style="padding-left: 3pt;margin-top: -9pt;text-indent: 0pt;text-align: left;">Código CET (Código
                        Electrónico de Transferencia): </p>
                    <p class="s1" style="padding-left: 5px;text-indent: 0pt;line-height: 20px; text-align: left;"><br></p>
                </td>
                <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s4" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;text-align: left;">Código CEMA (Código
                        Electrónico de Maquinaria Agrícola):</p>
                    <p class="s1" style="padding-left: 5px;text-indent: 0pt;line-height: 20px; text-align: left;"><br></p>
                </td>
            </tr>
        </table>
        <table style="border-collapse:collapse;margin-left:7.03pt;width: 755px" cellspacing="0">
            <tr style="height:17pt">
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt; background-color:#D9D9D9">
                    <p class="s3" style="padding-top: 4pt;padding-left: 1pt;text-indent: 0pt;text-align: left;">NUEVO
                        DOMICILIO DEL VEHÍCULO (domicilio de empadronamiento del comprador del vehículo)</p>
                </td>
            </tr>
        </table>
        <table style="border-collapse:collapse;margin-left:7.03pt;width: 755px" cellspacing="0">
            <tr style="height:28pt">
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s4" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 7pt;text-align: left;">Tipo vía:</p>
                    <p style="padding-left: 5px;text-indent: 0pt;line-height: 20px; text-align: left;"><br></p>
                </td>
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s4" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 7pt;text-align: left;">Nombre de la vía:</p>
                    <p style="padding-left: 5px;text-indent: 0pt;line-height: 20px; text-align: left;"><br></p>
                </td>
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s4" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 7pt;text-align: left;">Número:
                    </p>
                    <p style="padding-left: 5px;text-indent: 0pt;line-height: 20px; text-align: left;"><br></p>
                </td>
            </tr>
        </table>
        <table style="border-collapse:collapse;margin-left:7.03pt;width: 755px" cellspacing="0">
            <tr style="height:28pt">
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s4" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 7pt;text-align: left;">Bloque:
                    </p>
                    <p style="padding-left: 5px;text-indent: 0pt;line-height: 20px; text-align: left;"><br></p>
                </td>
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s4" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 7pt;text-align: left;">Portal:
                    </p>
                    <p style="padding-left: 5px;text-indent: 0pt;line-height: 20px; text-align: left;"><br></p>
                </td>
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s4" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 7pt;text-align: left;">
                        Escalera:</p>
                    <p style="padding-left: 5px;text-indent: 0pt;line-height: 20px; text-align: left;"><br></p>
                </td>
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s4" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 7pt;text-align: left;">Planta:
                    </p>
                    <p style="padding-left: 5px;text-indent: 0pt;line-height: 20px; text-align: left;"><br></p>
                </td>
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s4" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 7pt;text-align: left;">Puerta:
                    </p>
                    <p style="padding-left: 5px;text-indent: 0pt;line-height: 20px; text-align: left;"><br></p>
                </td>
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s4" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 7pt;text-align: left;">KM:</p>
                    <p style="padding-left: 5px;text-indent: 0pt;line-height: 20px; text-align: left;"><br></p>
                </td>
            </tr>
        </table>
        <table style="border-collapse:collapse;margin-left:7.03pt;width: 755px" cellspacing="0">
            <tr style="height:28pt">
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s4" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 7pt;text-align: left;">Código postal:</p>
                    <p style="padding-left: 5px;text-indent: 0pt;line-height: 20px; text-align: left;"><br></p>
                </td>
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s4" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 7pt;text-align: left;">
                        Provincia:</p>
                    <p style="padding-left: 5px;text-indent: 0pt;line-height: 20px; text-align: left;"><br></p>
                </td>
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s4" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 7pt;text-align: left;">
                        Municipio:</p>
                    <p style="padding-left: 5px;text-indent: 0pt;line-height: 20px; text-align: left;"><br></p>
                </td>
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s4" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 7pt;text-align: left;">
                        Localidad:</p>
                    <p style="padding-left: 5px;text-indent: 0pt;line-height: 20px; text-align: left;"><br></p>
                </td>
            </tr>
        </table>
        <p style="text-indent: 0pt;text-align: left;"><br /></p>
        <table style="border-collapse:collapse;margin-left:7.03pt;width: 755px" cellspacing="0">
            <tr style="height:15pt">
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt;background-color: #D9D9D9;">
                    <p class="s3" style="padding-top: 2pt;padding-left: 1pt;text-indent: 0pt;text-align: left;">DATOS
                        DEL COMPRADOR</p>
                </td>
            </tr>
        </table>
        <table style="border-collapse:collapse;margin-left:7.03pt;width: 755px" cellspacing="0">
            <tr style="height:23pt">
                <td
                    style="padding-left: 70px;padding-right: 10px;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;">
                    <p class="s1" style="padding-left: 7pt;text-indent: 0pt;line-height: 16pt;text-align: left;"><span
                            class="s1"><input type="radio" name="" id=""></span> Interesado </p>
                </td>
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s1" style="padding-top: 2pt;padding-left: 3pt;text-indent: 0pt;text-align: left;"><span
                            class="s1"><input type="radio" name="" id="" checked></span> Compraventa </p>
                </td>
            </tr>
        </table>
        <table style="border-collapse:collapse;margin-left:7.03pt;width: 755px" cellspacing="0">
            <tr style="height:28pt">
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s4" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;text-align: left;">NIF/NIE/CIF:</p>
                    <p style="padding-left: 5px;text-indent: 0pt;line-height: 20px; text-align: left;"><br></p>
                </td>
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s4" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;text-align: left;">Fecha nacimiento
                        (dd/mm/aaaa):</p>
                    <p style="padding-left: 5px;text-indent: 0pt;line-height: 20px; text-align: left;"><br></p>
                </td>
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s4" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;text-align: left;">Nombre/Razón social:</p>
                    <p style="padding-left: 5px;text-indent: 0pt;line-height: 20px; text-align: left;"><br></p>
                </td>
            </tr>
        </table>
        <table style="border-collapse:collapse;margin-left:7.03pt;width: 755px" cellspacing="0">
            <tr style="height:28pt">
                <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="2">
                    <p class="s4" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 7pt;text-align: left;">
                        Apellido 1:</p>
                        <p style="padding-left: 5px;text-indent: 0pt;line-height: 20px; text-align: left;"><br></p>
                </td>
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s4" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 7pt;text-align: left;">
                        Apellido 2:</p>
                    <p style="padding-left: 5px;text-indent: 0pt;line-height: 20px; text-align: left;"><br></p>
                </td>
            </tr>
            <tr style="height:30pt">
                <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="2">
                    <p class="s4" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 7pt;text-align: left;">Tutela:
                    </p>
                     
                     
                    <p class="s1" style="padding-left: 102pt;text-indent: -8pt;text-align: left;">
                        <span class="s1"><input type="radio" name="" id=""></span> Menor de edad 
                        &nbsp;&nbsp;&nbsp;
                        <span class="s1"><input type="radio" name="" id=""></span>Otras causas
                    </p>
                        
                </td>
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s4" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 7pt;text-align: left;">NIF/NIE del tutor:</p>
                    <p style="text-indent: 0pt;line-height: 20px; text-align: left;"><br></p>
                </td>
            </tr>
            <tr style="height:28pt">
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s4" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 7pt;text-align: left;">Código
                        IAE (Impuesto de Actividades Económicas):</p>
                    <p style="text-indent: 0pt;line-height: 20px; text-align: left;"><br></p>
                </td>
                <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="2">
                    <p class="s4" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 7pt;text-align: left;">
                        Descripción IAE:</p>
                    <p style="text-indent: 0pt;line-height: 20px; text-align: left;"><br></p>
                </td>
            </tr>
        </table>
        <p style="text-indent: 0pt;text-align: left;"><br /></p>
        <table style="border-collapse:collapse;margin-left:7.03pt;width: 755px" cellspacing="0">
            <tr style="height:15pt">
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt;background-color:#D9D9D9 ">
                    <p class="s3" style="padding-top: 2pt;padding-left: 1pt;text-indent: 0pt;text-align: left;">DATOS
                        DEL VENDEDOR</p>
                </td>
            </tr>
        </table>
        <table style="border-collapse:collapse;margin-left:7.03pt;width: 755px" cellspacing="0">
            <tr style="height:14pt">
                <td
                    style="padding-right: 50px border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;">
                    <p class="s1" style="padding-left: 7pt;text-indent: 0pt;line-height: 16pt;text-align: left;"><span
                            class="s1"><input type="radio" name="" id="" checked></span> Titular </p>
                </td>
                <td
                    style="padding-left: 50px; border-top-style:solid;border-top-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s1" style="padding-top: 2pt;padding-left: 3pt;text-indent: 0pt;text-align: left;"><span
                            class="s1"><input type="radio" name="" id=""></span> Compraventa/Poseedor/Arrendatario </p>
                </td>
            </tr>
        </table>
        <table style="border-collapse:collapse;margin-left:7.03pt;width: 755px" cellspacing="0">
            <tr style="height:28pt">
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s4" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 7pt;text-align: left;">
                        NIF/NIE/CIF:</p>
                    <p class="s1" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 20px; text-align: left;">{{ $purchase_management->dni }}
                        </p>
                </td>
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s4" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 7pt;text-align: left;">
                        Nombre/Razón social:</p>
                    <p class="s1" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 20px; text-align: left;">{{ $purchase_management->name }}
                    </p>

                </td>
            </tr>
            <tr style="height:28pt">
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s4" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 7pt;text-align: left;">
                        Apellido 1:</p>
                    <p class="s1" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 20px; text-align: left;">
                        {{ $purchase_management->firts_surname }}</p>

                </td>
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s4" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 7pt;text-align: left;">
                        Apellido 2:</p>
                    <p class="s1" style="padding-left: 3pt;padding-top: 2pt;text-indent: 0pt;line-height: 20px; text-align: left;">
                        {{ $purchase_management->second_surtname }}</p>

                </td>
            </tr>
        </table>
        <p style="text-indent: 0pt;text-align: left;"><br /></p>
        <table style="border-collapse:collapse;margin-left:7.03pt;width: 755px" cellspacing="0">
            <tr style="height:15pt">
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt;background-color:#D9D9D9 ">
                    <p class="s3" style="padding-top: 2pt;padding-left: 1pt;text-indent: 0pt;text-align: left;">DATOS
                        DEL OTROS</p>
                </td>
            </tr>
        </table>
        <table style="border-collapse:collapse;margin-left:7.03pt;width: 755px" cellspacing="0">
            <tr style="height:14pt">
                <td style="padding-right: 50px;border: 1px solid #000;">
                    <p class="s1" style="padding-left: 7pt;text-indent: 0pt;line-height: 20px;text-align: left;">
                        <br><br></p>
                </td>

            </tr>
        </table>
        <table style="border-collapse:collapse;margin-left:7.03pt;width: 755px" cellspacing="0">
            <tr style="height:14pt">
                <td style="padding-right: 50px;border: 1px solid #000">
                    <p class="s4"
                        style="text-indent: 0pt;line-height: 7pt;text-align: left;padding-left: 5px;padding-top: 3px;">
                        Doy mi consentimiento para que la DGT consulte a otros organismos públicos los siguientes datos
                        relativos a:</p>

                    <table>
                        <td style="width: 200px">
                            <p class="s4"
                                style="padding-left: 50px;text-indent: 0pt;line-height: 9pt;text-align: left;"><span
                                    style=" color: black; font-family: Arial, Helvetica, sans-serif; font-style: normal; font-weight: normal; text-decoration: none; font-size: 8pt;"><input
                                        type="checkbox" name="" id=""></span> Verificación de residencia</p>
                        </td>
                        <td style="width: 200px">
                            <p class="s4"
                                style="padding-left: 50px;text-indent: 0pt;line-height: 9pt;text-align: left;"><span
                                    style=" color: black; font-family: Arial, Helvetica, sans-serif; font-style: normal; font-weight: normal; text-decoration: none; font-size: 8pt;"><input
                                        type="checkbox" name="" id=""></span> Verificación de identidad</p>
                        </td>
                        <td style="width: 270px">
                            <p class="s4"
                                style="padding-left: 20px;text-indent: 0pt;line-height: 9pt;text-align: left;"><span
                                    style=" color: black; font-family: Arial, Helvetica, sans-serif; font-style: normal; font-weight: normal; text-decoration: none; font-size: 8pt;"><input
                                        type="checkbox" name="" id=""></span> Verificación del Impuesto de Actividades
                                Económicas (IAE)</p>
                        </td>
                    </table>
                </td>
            </tr>
        </table>
        <p style="text-indent: 0pt;text-align: left;"><br /></p>
        <table style="border-collapse:collapse;margin-left:7.03pt;width: 755px" cellspacing="0">
            <tr style="height:14pt">
                <td>
                    <p class="s1" style="padding-top: 3pt;text-indent: 0pt;text-align: center;">En <u>España </u>, a
                        <u> <?php echo date('d'); ?> </u> de <u><?php echo
                            date('M'); ?> </u> de <u><?php echo date('Y'); ?></u></p>
                </td>
            </tr>
        </table>
        <p style="text-indent: 0pt;text-align: left;"><br /></p>
        <table style="width: 755px">
            <tr>
                <td style="width: 200px;padding-left: 80px">
                    <p class="s1" style="padding-top: 3pt;text-indent: -155pt;text-align: center;"><span>Firma del
                            vendedor</span></p>
                </td>
                <td style="width: 200px;padding-right: 50px">
                    <p class="s1" style="padding-top: 3pt;text-align: center;"><span>Firma del comprador <br />(Sólo
                            necesario para cambio de titularidad)</span></p>
                </td>
                <td style="width: 200px;padding-left: 120px">
                    <p class="s1" style="padding-top: 3pt;text-indent: -155pt;text-align: center;"><span>Firma del
                            empleado público</span></p>
                </td>
            </tr>
        </table>
        <div class="saltoDePagina"></div>
    </div>
    {{-- Hoja 11 --}}
    <div class="container-fluid">
        <p style="text-indent: 0pt;text-align: left;"><br /></p>
        <p style="text-indent: 0pt;text-align: center;">
            <span><img width="222" height="60" alt="image" src="{{ asset('index_files/Image_007.jpg') }}" /></span>
        </p>
        <p class="s3" style="padding-top: 4pt;padding-left: 12pt;text-indent: 14pt;text-align: justify;"><span>D. <b>
                {{ $purchase_management->name }}
                {{ $purchase_management->firts_surname }} {{ $purchase_management->second_surtname }} </b> con DNI
            <b>{{ $purchase_management->dni }}</b> y D. <b>{{ $purchase_management->name_representantive }}
                {{ $purchase_management->firts_surname_representative }}
                {{ $purchase_management->second_surtname_representantive }}</b> con DNI <b>{{ $purchase_management->dni_representative }}</b>, que declara/declaran tener poder suficiente para actuar en su propio nombre y/o en representación de la entidad
            <b>{{ $purchase_management->province }}</b>  con CIF nº y domicilio a efectos de
            notificaciones en <b> {{ $purchase_management->municipality }}</b>, calle
            <b>{{ $purchase_management->street }} </b> nº <b>{{ $purchase_management->nro_street }} </b>C.P.
            <b>{{ $purchase_management->postal_code }} </b>, en concepto de <b>MANDANTE, </b>dice y otorga<b>:</b></span>
        </p>
        <p style="text-indent: 0pt;text-align: left;"><br /></p>
        <p class="s3" style="padding-top: 4pt;padding-left: 12pt;text-indent: 14pt;text-align: justify;"><span>Que por el presente documento confiere, con
            carácter específico, <b>MANDATO CON REPRESENTACIÓN </b> a favor
                de D. <b>{{ $purchase_management->name_representantive }}
                {{ $purchase_management->firts_surname_representative }}
                {{ $purchase_management->second_surtname_representantive }} </b>, con
            DNI <b>{{ $purchase_management->dni_representative }} </b>, Gestor Administrativo en ejercicio, colegiado
            número </b>, perteneciente al Colegio Oficial de Gestores Administrativos de <b></b>, con domicilio en <b></b>, calle <b> </b>
            nº <b>  </b> C.P.<b> </b>,en concepto de <b>MANDATARIO,</b> para su actuación ante todos los órganos y entidades de la
                Administración del Estado, Autonómica, Provincial y Local que resulten competentes, y específicamente
                ante la Dirección General de Tráfico del Ministerio del Interior del Gobierno de España, para que
                promueva, solicite y realice todos los trámites necesarios en relación con el siguiente
             <b>ASUNTO:</b></span></p>
                <p class="s40"
                    style="margin-left:40px;text-indent: -5pt;line-height: 11pt;text-align: center;border-bottom: 1px solid currentColor; display: inline-block;width: 650px">
                </p>
                <p class="s40"
                    style="margin-left:40px;text-indent: -5pt;line-height: 11pt;text-align: center;border-bottom: 1px solid currentColor; display: inline-block;width: 650px">
                </p>
        <p class="s3" style="padding-top: 4pt;padding-left: 12pt;text-indent: 14pt;text-align: justify;"><span>El presente mandato,
                que se regirá por los artículos 1709 a 1739 del Código Civil, se confiere al amparo del artículo 5 de la
                Ley 39/2015, de 1 de octubre, del Procedimiento Administrativo Común de las Administraciones Públicas, y
                del artículo 1 del Estatuto Orgánico de la Profesión de Gestor Administrativo, aprobado por Decreto
                424/1963.</span></p>
     
        <p class="s3" style="padding-top: 4pt;padding-left: 12pt;text-indent: 14pt;text-align: justify;"><span>El mandante autoriza al mandatario
                para que nombre sustituto, en caso de necesidad justificada, a favor de un Gestor Administrativo
                colegiado ejerciente. El presente mandato mantendrá su vigencia, como máximo, hasta la finalización del
                encargo aquí encomendado, siempre y cuando no sea expresamente revocado por el mandante con
                anterioridad, y comunicada fehacientemente su revocación al mandatario.</span></p>
       
        <p class="s3" style="padding-top: 4pt;padding-left: 12pt;text-indent: 14pt;text-align: justify;"><span>El mandante declara bajo su
                responsabilidad de conformidad con el artículo 69 de la Ley 39/2015, de 1 de octubre, del Procedimiento
                Administrativo Común de las Administraciones Públicas, que cumple con los requisitos establecidos en la
                normativa vigente para obtener el reconocimiento de un derecho o facultad o para su ejercicio, que
                dispone de la documentación que así lo acredita, que es auténtica y su contenido enteramente correcto, y
                que entrega al gestor Administrativo, el cual se responsabiliza de su custodia, se compromete a ponerla
                a disposición de la Administración cuando le sea requerida, y a mantener el cumplimiento de las
                anteriores obligaciones durante el período de tiempo inherente al trámite conferido.</span></p>
 
        <p class="s3" style="padding-top: 4pt;padding-left: 12pt;text-indent: 14pt;text-align: justify;"><span>El mandante declara, que conoce y
                consiente que los datos que suministra pueden incorporarse a ficheros automatizados de los que serán
                responsables el Gestor Administrativo al que se le otorga el mandato, el Colegio Oficial de Gestores
                Administrativos citado, y el Consejo General de Colegios de Gestores Administrativos de España, con el
                único objeto y plazo de posibilitar la prestación de los servicios profesionales objeto del presente
                mandato y el cumplimiento por estos de las obligaciones derivadas del trámite encomendado. No obstante
                lo anterior, el mandatario se reserva el derecho de custodia y conservación de los datos personales
                recabados con fines de cumplimiento de obligaciones legales exigidas por la normativa tributaria,
                laboral, civil o mercantil, así como para la atención o emprendimiento de reclamaciones y/o acciones
                judiciales. El mandante tendrá derecho a la portabilidad de sus datos, a su acceso, rectificación,
                supresión, limitación, y oposición, así como a interponer las reclamaciones que estime oportunas ante la
                Agencia Española de Protección de Datos, o su equivalente en su país de residencia como Autoridad de
                Control, en los términos previstos en la Ley de Protección de Datos de Carácter personal, y el
                Reglamento (UE) 2016/679 del Parlamento Europeo y del Consejo de 27 de abril de 2016.</span></p>
        <p style="text-indent: 0pt;text-align: left;"><br /></p>
        <?php 
            $diassemana = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            $fecha = date_create($purchase_management->current_year);
            $mes = date_format($fecha ,"n");
            //Salida: Miercoles 05 de Septiembre del 2016
        
        ?>
        <p class="s3" style="text-indent: 0pt;text-align: center;">En Madrid {{ date_format($fecha ,"d") }} {{ $meses[date($mes)-1] }} de {{ date_format($fecha ,"Y") }}</p>
        <p class="s3" style="padding-top: 4pt;text-indent: 0pt;text-align: center;"><b>EL MANDANTE</b></p>
       
        <p class="s3" style="padding-top: 5pt;padding-left: 12pt;text-indent: 0pt;text-align: justify;"><span>El mandatario acepta
                el mandato conferido y se obliga a cumplirlo de conformidad con las instrucciones del mandante, y
                declara bajo su responsabilidad que los documentos recibidos del mandante han sido verificados en cuanto
                a la corrección formal de los datos contenidos en los mismos.</span></p>
 
        <p class="s3" style="padding-top: 4pt;text-indent: 0pt;text-align: center;">En<u> </u>a _<u> </u>de<u> </u></p>
        <p class="s3" style="padding-top: 4pt;text-indent: 0pt;text-align: center;"><b>EL MANDATARIO</b></p>
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
                    <p style="text-indent: 0pt;text-align: justify;"><br /></p>

                </td>
            </tr>
        </table>
        <table style="border: 1px solid black; border-collapse: collapse;margin-left:15.04pt;width: 730px" cellspacing="0">
            <tr>
                <th style="border: 1px solid black; border-collapse: collapse;height: 30px"><span class="s3"><b>Nombre hel Recambio</b></span></th>
                <th style="border: 1px solid black; border-collapse: collapse;height: 30px"><span class="s3"><b>Precio €</b></span></th>
                <th style="border: 1px solid black; border-collapse: collapse;height: 30px"><span class="s3"><b>Nombre del Recambio</b></span></th>
                <th style="border: 1px solid black; border-collapse: collapse;height: 30px"><span class="s3"><b>Precio €</b></span></th>
            </tr>
            <tr>
                <td style="border: 1px solid black; border-collapse: collapse;height: 30px"><span class="s3">&nbsp;&nbsp;</span></td>
                <td style="border: 1px solid black; border-collapse: collapse;height: 30px"><span class="s3">&nbsp;&nbsp;</span></td>
                <td style="border: 1px solid black; border-collapse: collapse;height: 30px"><span class="s3">&nbsp;&nbsp;</span></td>
                <td style="border: 1px solid black; border-collapse: collapse;height: 30px"><span class="s3">&nbsp;&nbsp;</span></td>
            </tr>
            <tr>
                <td style="border: 1px solid black; border-collapse: collapse;height: 30px"><span class="s3">&nbsp;&nbsp;</span></td>
                <td style="border: 1px solid black; border-collapse: collapse;height: 30px"><span class="s3">&nbsp;&nbsp;</span></td>
                <td style="border: 1px solid black; border-collapse: collapse;height: 30px"><span class="s3">&nbsp;&nbsp;</span></td>
                <td style="border: 1px solid black; border-collapse: collapse;height: 30px"><span class="s3">&nbsp;&nbsp;</span></td>
            </tr>
            <tr>
                <td style="border: 1px solid black; border-collapse: collapse;height: 30px"><span class="s3">&nbsp;&nbsp;</span></td>
                <td style="border: 1px solid black; border-collapse: collapse;height: 30px"><span class="s3">&nbsp;&nbsp;</span></td>
                <td style="border: 1px solid black; border-collapse: collapse;height: 30px"><span class="s3">&nbsp;&nbsp;</span></td>
                <td style="border: 1px solid black; border-collapse: collapse;height: 30px"><span class="s3">&nbsp;&nbsp;</span></td>
            </tr>
            <tr>
                <td style="border: 1px solid black; border-collapse: collapse;height: 30px"><span class="s3">&nbsp;&nbsp;</span></td>
                <td style="border: 1px solid black; border-collapse: collapse;height: 30px"><span class="s3">&nbsp;&nbsp;</span></td>
                <td style="border: 1px solid black; border-collapse: collapse;height: 30px"><span class="s3">&nbsp;&nbsp;</span></td>
                <td style="border: 1px solid black; border-collapse: collapse;height: 30px"><span class="s3">&nbsp;&nbsp;</span></td>
            </tr>
            <tr>
                <td style="border: 1px solid black; border-collapse: collapse;height: 30px"><span class="s3">&nbsp;&nbsp;</span></td>
                <td style="border: 1px solid black; border-collapse: collapse;height: 30px"><span class="s3">&nbsp;&nbsp;</span></td>
                <td style="border: 1px solid black; border-collapse: collapse;height: 30px"><span class="s3">&nbsp;&nbsp;</span></td>
                <td style="border: 1px solid black; border-collapse: collapse;height: 30px"><span class="s3">&nbsp;&nbsp;</span></td>
            </tr>
        </table>
        <p style="text-indent: 0pt;text-align: justify;"><br /></p>
        <p style="text-indent: 0pt;text-align: justify;"><br /></p>
        <table style="border-collapse:collapse;margin-left:8.04pt;width: 755px" cellspacing="0">
            <tr style="height:35pt">
                <td style="width:489pt">
                    <p class="s3" style="padding-top: 40pt; text-indent: 0pt;line-height: 11pt;text-align: center;">
                        <b>Forma de pago</b>   </p>
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

