
<!DOCTYPE  html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt" lang="pt">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>index</title>
        <style type="text/css"> 
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
            .s1 { color: black; font-family: "Comic Sans MS", cursive, sans-serif; font-style: normal; font-weight: bold; text-decoration: none; font-size: 10pt; }
            .s2 { color: black; font-family: "Comic Sans MS", cursive, sans-serif; font-style: normal; font-weight: bold; text-decoration: none; font-size: 21.4pt; }
            table, tbody {vertical-align: top; overflow: visible; }
        </style>
    </head>
    <body>
        <div class="container-fluid">
            <table style="border-collapse:collapse;margin-left:40.624pt;margin-top: 6pt;width:700px;" cellspacing="0">
                <tr style="height:35mm;">
                    <td style="width:251pt">
                        <p class="s1" style="padding-left: 19pt;padding-right: 76pt;text-indent: 0pt;text-align: center;"><span>NºExpediente: F{{ $purchase->id }}<br/>Marca: {{ strtoupper($purchase->brand) }}</span></p>
                        <p class="s1" style="padding-left: 19pt;padding-right: 76pt;text-indent: 0pt;text-align: center;"><span>Modelo:  {{ $purchase_management->model }}<br/>Matricula: {{ $purchase_management->registration_number }}</span></p>
                        <p class="s1" style="padding-left: 9pt;padding-right: 66pt;text-indent: 0pt;line-height: 15pt;text-align: center;">Bastidor: {{ $purchase_management->frame_no }}</p>
                    </td>
                    <td style="width:252pt">
                        <p class="s1" style="padding-left: 19pt;padding-right: 76pt;text-indent: 0pt;text-align: center;"><span>NºExpediente: F{{ $purchase->id }}<br/>Marca: {{ strtoupper($purchase->brand) }}</span></p>
                        <p class="s1" style="padding-left: 19pt;padding-right: 76pt;text-indent: 0pt;text-align: center;"><span>Modelo:  {{ $purchase_management->model }}<br/>Matricula: {{ $purchase_management->registration_number }}</span></p>
                        <p class="s1" style="padding-left: 9pt;padding-right: 66pt;text-indent: 0pt;line-height: 15pt;text-align: center;">Bastidor: {{ $purchase_management->frame_no }}</p>
                    </td>
                </tr>
            </table>
            <table style="border-collapse:collapse;margin-left:40.624pt;margin-top: 4pt;width:700px; " cellspacing="0">
                <tr style="height:35mm;">
                    <td style="width:251pt">
                        <p class="s2" style="padding-top: 3pt;padding-left: 1pt;padding-right: 38pt;text-indent: 0pt;text-align: center;"><span>F{{ $purchase->id }} {{ strtoupper($purchase->brand) }}<br/>{{ strtoupper(nl2br($purchase_management->model)) }}</span></p>
                    </td>
                    <td style="width:252pt">
                        <p class="s2" style="padding-top: 3pt;padding-left: 1pt;padding-right: 38pt;text-indent: 0pt;text-align: center;"><span>F{{ $purchase->id }} {{ strtoupper($purchase->brand) }}<br/>{{ strtoupper(nl2br($purchase_management->model)) }}</span></p>
                    </td>
                </tr>
            </table>
            <table style="border-collapse:collapse;margin-left:40.624pt;margin-top: 4pt;width:700px " cellspacing="0">
                <tr style="height:35mm;">
                    <td style="width:251pt">
                        <p class="s2" style="padding-top: 3pt;padding-left: 1pt;padding-right: 38pt;text-indent: 0pt;text-align: center;"><span>F{{ $purchase->id }} {{ strtoupper($purchase->brand) }}<br/>{{ strtoupper(nl2br($purchase_management->model)) }}</span></p>
                    </td>
                    <td style="width:252pt">
                        <p class="s2" style="padding-top: 3pt;padding-left: 1pt;padding-right: 38pt;text-indent: 0pt;text-align: center;"><span>F{{ $purchase->id }} {{ strtoupper($purchase->brand) }}<br/>{{ strtoupper(nl2br($purchase_management->model)) }}</span></p>
                    </td>
                </tr>
            </table>
            <table style="border-collapse:collapse;margin-left:40.624pt;margin-top: 4pt;width:700px " cellspacing="0">
                <tr style="height:35mm;">
                    <td style="width:251pt">
                        <p class="s2" style="padding-top: 3pt;padding-left: 1pt;padding-right: 38pt;text-indent: 0pt;text-align: center;"><span>F{{ $purchase->id }} {{ strtoupper($purchase->brand) }}<br/>{{ strtoupper(nl2br($purchase_management->model)) }}</span></p>
                    </td>
                    <td style="width:252pt">
                        <p class="s2" style="padding-top: 3pt;padding-left: 1pt;padding-right: 38pt;text-indent: 0pt;text-align: center;"><span>F{{ $purchase->id }} {{ strtoupper($purchase->brand) }}<br/>{{ strtoupper(nl2br($purchase_management->model)) }}</span></p>
                    </td>
                </tr>
            </table>
            <table style="border-collapse:collapse;margin-left:40.624pt;margin-top: 4pt;width:700px " cellspacing="0">
                <tr style="height:35mm;">
                    <td style="width:251pt">
                        <p class="s2" style="padding-top: 3pt;padding-left: 1pt;padding-right: 38pt;text-indent: 0pt;text-align: center;"><span>F{{ $purchase->id }} {{ strtoupper($purchase->brand) }}<br/>{{ strtoupper(nl2br($purchase_management->model)) }}</span></p>
                    </td>
                    <td style="width:252pt">
                        <p class="s2" style="padding-top: 3pt;padding-left: 1pt;padding-right: 38pt;text-indent: 0pt;text-align: center;"><span>F{{ $purchase->id }} {{ strtoupper($purchase->brand) }}<br/>{{ strtoupper(nl2br($purchase_management->model)) }}</span></p>
                    </td>
                </tr>
            </table>
            <table style="border-collapse:collapse;margin-left:40.624pt;margin-top: 4pt;width:700px " cellspacing="0">
                <tr style="height:35mm;">
                    <td style="width:251pt">
                        <p class="s2" style="padding-top: 3pt;padding-left: 1pt;padding-right: 38pt;text-indent: 0pt;text-align: center;"><span>F{{ $purchase->id }} {{ strtoupper($purchase->brand) }}<br/>{{ strtoupper(nl2br($purchase_management->model)) }}</span></p>
                    </td>
                    <td style="width:252pt">
                    <p class="s2" style="padding-top: 3pt;padding-left: 1pt;padding-right: 38pt;text-indent: 0pt;text-align: center;"><span>F{{ $purchase->id }} {{ strtoupper($purchase->brand) }}<br/>{{ strtoupper(nl2br($purchase_management->model)) }}</span></p>
                    </td>
                </tr>
            </table>
            <table style="border-collapse:collapse;margin-left:40.624pt;margin-top: 4pt;width:700px " cellspacing="0">
            <tr style="height:35mm;">
                    <td style="width:251pt">
                        <p class="s2" style="padding-top: 3pt;padding-left: 1pt;padding-right: 38pt;text-indent: 0pt;text-align: center;"><span>F{{ $purchase->id }} {{ strtoupper($purchase->brand) }}<br/>{{ strtoupper(nl2br($purchase_management->model)) }}</span></p>
                    </td>
                    <td style="width:252pt">
                        <p class="s2" style="padding-top: 3pt;padding-left: 1pt;padding-right: 38pt;text-indent: 0pt;text-align: center;"><span>F{{ $purchase->id }} {{ strtoupper($purchase->brand) }}<br/>{{ strtoupper(nl2br($purchase_management->model)) }}</span></p>
                    </td>
                </tr>
            </table>
            <table style="border-collapse:collapse;margin-left:40.624pt;margin-top: 4pt;width:700px " cellspacing="0">
                <tr style="height:35mm;">
                    <td style="width:251pt">
                        <p class="s2" style="padding-top: 3pt;padding-left: 1pt;padding-right: 38pt;text-indent: 0pt;text-align: center;"><span>F{{ $purchase->id }} {{ strtoupper($purchase->brand) }}<br/>{{ strtoupper(nl2br($purchase_management->model)) }}</span></p>
                    </td>
                    <td style="width:252pt">
                        <p class="s2" style="padding-top: 3pt;padding-left: 1pt;padding-right: 38pt;text-indent: 0pt;text-align: center;"><span>F{{ $purchase->id }} {{ strtoupper($purchase->brand) }}<br/>{{ strtoupper(nl2br($purchase_management->model)) }}</span></p>
                    </td>
                </tr>
            </table>
            
        </div>
    </body>
</html>
