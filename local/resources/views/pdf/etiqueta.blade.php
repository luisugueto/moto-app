<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style type="text/css">
        @page {size: portrait;}
        * {margin:0; padding:0; text-indent:0; }
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
        .saltoDePagina{page-break-after: always;}

        .s1 { color: black; font-family: "Avantgarde, TeX Gyre Adventor, URW Gothic L", sans-serif; font-style: bold; font-weight: normal; text-decoration: none; font-size: 12pt; }
        .s2 { color: black; font-family: "Avantgarde, TeX Gyre Adventor, URW Gothic L", sans-serif; font-style: bold; font-weight: bold; text-decoration: none; font-size: 18pt; }
        
      </style>
</head>
<body>
    <div class="container-fluid">
            <table style="width: 100%;">
                <tr>
                    <td>
                        <p class="s1" style="padding-top: 4pt;padding-left: 4pt;text-indent: 0pt;text-align: center;">N° de Expediente: {{ $purchase->id }}</p>   
                        <p class="s1" style="padding-top: 4pt;padding-left: 4pt;text-indent: 0pt;text-align: center;">Marca: {{ $purchase->brand }}</p>
                        <p class="s1" style="padding-top: 4pt;padding-left: 4pt;text-indent: 0pt;text-align: center;">Modelo: {{ $purchase_management->model }}</p>
                        <p class="s1" style="padding-top: 4pt;padding-left: 4pt;text-indent: 0pt;text-align: center;">Matrícula: {{ $purchase_management->registration_number }}</p>
                        <p class="s1" style="padding-top: 4pt;padding-left: 4pt;text-indent: 0pt;text-align: center;">Bastidor: {{ $purchase_management->frame_no }}</p>
                    </td>
                    <td>
                        <p class="s1" style="padding-top: 4pt;padding-left: 4pt;text-indent: 0pt;text-align: center;">N° de Expediente: {{ $purchase->id }}</p>   
                        <p class="s1" style="padding-top: 4pt;padding-left: 4pt;text-indent: 0pt;text-align: center;">Marca: {{ $purchase->brand }}</p>
                        <p class="s1" style="padding-top: 4pt;padding-left: 4pt;text-indent: 0pt;text-align: center;">Modelo: {{ $purchase_management->model }}</p>
                        <p class="s1" style="padding-top: 4pt;padding-left: 4pt;text-indent: 0pt;text-align: center;">Matrícula: {{ $purchase_management->registration_number }}</p>
                        <p class="s1" style="padding-top: 4pt;padding-left: 4pt;text-indent: 0pt;text-align: center;">Bastidor: {{ $purchase_management->frame_no }}</p>
                    </td>
                </tr>
               @for ($i = 0; $i < 10; $i++)
                <tr>               
                    <td>
                        <p class="s2" style="padding-top: 8pt;padding-left: 4pt;text-indent: 0pt;text-align: center;">{{ $purchase->id }}  {{ $purchase->brand }}</p>
                        <p class="s2" style="padding-top: 8pt;padding-left: 4pt;text-indent: 0pt;text-align: center;">{{ $purchase_management->model }}</p>
                    </td>
                    <td>
                        <p class="s2" style="padding-top: 8pt;padding-left: 4pt;text-indent: 0pt;text-align: center;">{{ $purchase->id }}  {{ $purchase->brand }}</p>
                        <p class="s2" style="padding-top: 8pt;padding-left: 4pt;text-indent: 0pt;text-align: center;">{{ $purchase_management->model }}</p>
                    </td>                
                </tr>
               @endfor
            </table>
            
        
    </div>
</body>
</html>