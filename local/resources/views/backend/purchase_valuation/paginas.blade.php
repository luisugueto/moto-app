@if (count($motos))
<div class="table-responsive">
    <table class="table table-striped projects">
        <thead> 
            <th>#</th>
            <th>Marca / Modelo</th>
            <th>No Bastidor / Matrícula / Año</th>
            <th>Motor</th>
            <th>Teléfono / Email</th>
            <th>Estado Ficha</th>
            <th>Estado de la Moto</th>
            <th></th>
        </thead>
        <tbody>
        @foreach ($motos as $item)          
            <tr>
                <td>
                    # {{ $item->id }}
                </td>
                <td>
                    <a>
                        {{ $item->brand }}
                    </a>
                    <br/>
                    <small>
                        {{ $item->model }}
                    </small>
                </td>
                <td>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            {{ $item->frame_no }}
                        </li>
                        <li class="list-inline-item">
                            {{ $item->registration_number }}
                        </li>
                        <li class="list-inline-item">
                            {{ $item->year }}
                        </li>
                    </ul>
                </td>
                
                <td><?php
                    $motor_no = '';
                    $purchase_management = App\PurchaseManagement::where('purchase_valuation_id', $item->id)->first();
                    if (isset($purchase_management->datos_del_mecanico)) {                    
                        $fieldsArray = json_decode(utf8_encode($purchase_management->datos_del_mecanico));
                        foreach ($fieldsArray as $key => $value) {
                            if ($value->name == 'nEJmSDym') {
                                $motor_no = $value->value;
                            }
                        }
                    }                  
                    ?>
                    {{$motor_no}}
                </td>
                <td class="project_progress">
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            {{ $item->phone }}
                        </li>
                        <li class="list-inline-item">
                            {{ $item->email }}
                        </li>
                    </ul>
                </td>
                
                <td class="project-state">
                    @if($item->status == 2)
                        <span class='badge badge-success'>Ficha <br> Verificada</span>
                
                    @elseif($item->status == 1)
                        <span class='badge badge-warning'>Ficha <br> Registrada</span>
                    
                    @elseif($item->status == 0)
                        <span class='badge badge-danger'>Ficha No <br> Registrada</span>
                    @endif
                </td>
                <td class="project-state">
                    <h6><b>{{ $item->state }}</b></h6>
                </td>
                <td class="project-actions text-right">
                    <a class='mb-2 mr-2 btn btn-warning text-white button_ver_ficha' title='Ficha Moto' data-moto="{{$item->id}}"> Editar</a>
                </td>
            </tr>
        @endforeach 
        </tbody>   
    </table>
</div>         
@endif

   
       
        