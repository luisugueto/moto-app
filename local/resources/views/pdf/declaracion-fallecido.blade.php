<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>index</title>
    <meta name="author" content="Venus" />
    <style type="text/css">
         * {margin:0; padding:0; text-indent:0; }
        html,
        body,
        .container-fluid {			 
            width: 100%;
            padding-right: 30px;
            padding-left: 30px;
            margin-top: 5px;
            margin-right: auto;
            margin-left: auto;
        }
        .s1 {
        color: black;
        font-family: Arial, Helvetica, sans-serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 10pt;
        }
        .s2 {
        color: black;
        font-family: Arial, Helvetica, sans-serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 10pt;
        vertical-align: 19pt;
        }
        h1 {
        color: black;
        font-family: Arial, Helvetica, sans-serif;
        font-style: normal;
        font-weight: bold;
        text-decoration: none;
        font-size: 14pt;
        }
        .s3 {
        color: black;
        font-family: Arial, Helvetica, sans-serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 14pt;
        }
        .p,
        p {
        color: black;
        font-family: Arial, sans-serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 14pt;
        margin: 0pt;
        }
        .s5 {
        color: black;
        font-family: Arial, sans-serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: underline;
        font-size: 14pt;
        }
        ul.a {
            list-style-type: square;
            text-align: justify;
            
        }
        .underline { 
            border-bottom: 1px solid currentColor;
            width:400px;
            display: inline-block;
            line-height: 1.3;
            margin-top: 2px;
            margin-left: 2px;
        }
        .underline2 { 
            border-bottom: 1px solid currentColor;
            width:400px;
            display: inline-block;
            line-height: 1.3;
            margin-top: 2px;
            margin-left: 2px;
        }
        .underline-a { 
            border-bottom: 1px solid currentColor;
            width:150px;
            display: inline-block;
            line-height: 1.3;
            margin-top: 2px;
            margin-left: 10px;
        }
        .underline-b { 
            border-bottom: 1px solid currentColor;
            width:90px;
            display: inline-block;
            line-height: 1.3;
            margin-top: 2px;
            margin-left: 2px;
        }
        .underline-c { 
            border-bottom: 1px solid currentColor;
            width:65px;
            display: inline-block;
            line-height: 1.3;
            margin-top: 2px;
            margin-left: 2px;
        }
        .underline-d { 
            border-bottom: 1px solid currentColor;
            width:40px;
            display: inline-block;
            line-height: 1.3;
            margin-top: 2px;
            margin-left: 2px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <table style="border-collapse:collapse;margin-left:10.03pt;width: 700px; margin-top: 20pt" cellspacing="0">
            <tr style="height:14pt">
                <td style="width:100px;" colspan="4">
                    <p class="s12" style="padding-left: 10pt;padding-top: 4pt; text-indent: 1pt;line-height: 9pt;text-align: left;">
                        <span><img width="72" height="76" alt="image" src="{{ asset('index_files/Image_025.png') }}" /></span>
                        
                    </p>
                </td>
                <td style="width:400px;" colspan="4">
                    <span class="s1" style="text-align: center;padding-top: 4pt;">MINISTERIO <br>DEL INTERIOR </span> 
                </td>
                <td style="width:100px;padding-left: 20pt">
                    <span style="padding-left: 20pt"><img width="105" height="52" alt="image" src="{{ asset('index_files/Image_027.png') }}" /></span>
                </td>
            </tr>
        </table>
        <p style="text-indent: 0pt;text-align: left;"><br /></p>
        <table style="border-collapse:collapse;margin-left:7.03pt;width: 700px" cellspacing="0">
            <tr style="height:14pt">
                <td>
                    <h1 style="padding-top: 5pt;padding-left:10pt;padding-right:10pt; -90pt;text-align: center;"><span>DECLARACIÓN RESPONSABLE PARA LA SOLICITUD DE BAJA DEFINITIVA DE UN VEHÍCULO POR FALLECIMIENTO DE SU TITULAR</span>
                    </h1>

                </td>
            </tr>
        </table>
        <table style="border-collapse:collapse;margin-left:7.03pt;width: 700px;margin-top: 20pt;" cellspacing="0">
            <tr style="height:14pt">
                <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt "
                    colspan="3">
                    <h1 style="padding-top: 4pt;padding-left: 10pt;text-indent: 0pt;text-align: center;">Identificación del declarante
                    </h1>
                    <p style="text-indent: 0pt;text-align: left;"><br /></p>
                    <p class="s3" style="text-indent: 0pt;padding-left:10pt; ;text-align: left;">Nombre y apellidos: <span class="underline">{{ $purchase_management->name }} {{ $purchase_management->firts_surname }}
                        {{ $purchase_management->second_surtname }}</span></p>
                    <p style="text-indent: 0pt;text-align: left;"><br /></p>
                    <p class="s3" style="text-indent: 0pt;padding-left:10pt; padding-bottom: 10pt;text-align: left;">DNI:<span class="underline2">{{ $purchase_management->dni }}</span></p>
                </td>
            </tr>
        </table>
       
        <p style="text-indent: 0pt;text-align: left;"><br /></p>
        <table style="border-collapse:collapse;margin-left:7.03pt;width: 700px;" cellspacing="0">
            <tr style="height:14pt">
                <td style="" colspan="3">
                    <p style="padding-top: 4pt;text-align: justify;"><span>DECLARA BAJO SU
                        RESPONSABILIDAD, ante el Centro Autorizado de Tratamiento Medio ambiental</span> <span class="underline2" style="padding-left: 35px"></span><span style="padding-left: 0"> a
                        los efectos de la solicitud de baja definitiva del vehículo con matrícula , cuyo titular ha fallecido, que cumple con los requisitos establecidos en la normativa vigente, y en particular que:</span>
                    </p>
                </td>
            </tr>
        </table>
        
        <p style="text-indent: 0pt;text-align: left;"><br /></p>
        <ul style="padding-left: 40pt;">
            <li >
                
                <p>Ha resultado
                    adjudicatario definitivo del vehículo arriba señalado, y así consta en el testamento o la
                    declaración de herederos del titular del vehículo.</p>
            </li>
            <li style="padding-top: 10pt">
                 <p>Por el resto de adjudicatarios
                    del vehículo, en caso de que los hubiere, se ha acordado la destrucción del vehículo.</p>
                 
            </li>
            <li style="padding-top: 10pt">
                 
                    <p>Dispone de la documentación que acredita todo lo anterior y que la pondrá a disposición de la
                    Administración si le fuera requerida.</p>
                
            </li>
        </ul>
        <p style="text-indent: 0pt;text-align: left;"><br /></p>
        <table style="border-collapse:collapse;margin-left:7.03pt;width: 700px;" cellspacing="0">
            <tr style="height:14pt">
                <td style="" colspan="3">
                    <p style="padding-top: 4pt;text-align: justify;"><span>Lo que manifiesta con el conocimiento de
                        las responsabilidades penales, civiles y/o administrativas a que hubiera lugar, en caso de
                        inexactitud, falsedad u omisión, de carácter esencial, de cualquier dato o información de la
                        presente declaración o en caso de no presentación de la documentación que le fuera requerida para
                        acreditar el cumplimiento de lo declarado.</span>
                    </p>
                </td>
            </tr>
        </table>
        <p style="text-indent: 0pt;text-align: left;"><br></p>
        <p style="text-align: center;"><span>Y para que así conste y
            surta los efectos oportunos</span>
        </p>
        <p style="text-indent: 0pt;text-align: left;"><br></p>
        <p style="padding-top: 8pt;padding-left: 26pt;text-indent: 0pt;text-align: left;"><span>En</span><span class="underline-a"></span> a,<span class="underline-b"></span> de<span class="underline-c"></span> de 20<span class="underline-d"></span>
        </p>
        <p style="padding-top: 12pt;padding-left: 26pt;text-indent: 0pt;text-align: left;">Firmado: <span class="underline"></span>
        </p>
    </div>
</body>
</html>

