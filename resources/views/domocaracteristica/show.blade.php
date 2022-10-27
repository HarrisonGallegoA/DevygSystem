@extends('layouts.app')
@section('aside_menu')
@include('layouts.aside')
@endsection
@section('titulo_ventana', 'Lista Domos')

@section('Contenido_app')

<br>
<div class="row">
    <div class="col">
        <div class="col-sm-8 col-sm-offset-2">
            <a class="btn btn-info col-3" href="/domo/caracteristicas"><i
                    class="fa-sharp fa-solid fa-landmark-dome"></i>
                Agregar
                Domo</a>
        </div>
        <br>
        @if (session('status'))
        @if(session('status') == '1')
        <div class="alert alert-success">
            Se guardo
        </div>
        @else
        <div class="alert alert-danger">
            {{ session('status') }}
        </div>

        @endif
        @endif
    </div>
</div>

<div class="card shadow mb-4 col-12">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered dt-responsive nowrap" id="dataTable" width="100%"
                cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>capacidad</th>
                        <th>numero de baños</th>
                        <th>tipo domo</th>
                        <th>Estado</th>
                        <th>Caracteristicas</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($domos as $value)
                    <tr>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->nombre }}</td>
                        <td>{{ $value->descripcion }}</td>
                        <td>{{ $value->capacidad }}</td>
                        <td>{{ $value->numerobaños }}</td>
                        <td>{{ $value->tipodomo }}</td>
                        <td>
                            @if($value->estado == 1)

                            <button class="btn btn-success col-9"><i
                                    class="fa-sharp fa-solid fa-power-off"></i></button>

                            @elseif ($value->estado == 2)

                            <button class="btn btn-danger col-9"><i class="fa-sharp fa-solid fa-power-off"></i></button>
                            @endif
                        </td>
                        </td>
                        <td>
                            <a class="btn btn-info col-10" href="/domo/listar?id={{$value->id}}"><i
                                    class="fa-solid fa-eye">
                            </a></i>
                        </td>

                        <td>

                            <a class="btn btn-warning col-9"><i class="fa-sharp fa-solid fa-pen-to-square"></i>
                            </a>

                        </td>

                    </tr>
                    @endforeach

                    <!-- Modal CREAR caracteristica-->
                    <div class="modal" tabindex="-1">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">Modal title</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <p>Modal body text goes here.</p>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    <!-- FIN Modal CREAR Domo-->

                </tbody>
            </table>
        </div>
    </div>
</div>

@if(count($caracteristicas) > 0 )
<div class="row">
    <div class="col">
        <table class="table">
            <thead>
                <t>
                    <th colspan="2" class="text-center"></th>
                    </tr>
                    <t>
                        <th>Nombre</th>
                        <th>detalle</th>
                        <th>Cantidad</th>
            </thead>
            <tbody>
                @foreach ($caracteristicas as $value)
                <tr>
                    <td>{{ $value->nombre }}</td>
                    <td>{{ $value->detalle }}</td>
                    <td>{{ $value->cantidad_c }}</td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
<br>
<br>
<br>
<br>

@endif


@endsection