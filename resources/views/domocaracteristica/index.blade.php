@extends('layouts.app')
@section('aside_menu')
@include('layouts.aside')
@endsection
@section('titulo_ventana', 'Agregar Domo')

@section('Contenido_app')
<br>
<div class="row">
    <div class="col-sm-8 col-sm-offset-2">
        <a class="btn btn-info col-3" href="/domo/listar"><i class="fa-solid fa-igloo"></i></i>
            Lista de Domos
        </a>
    </div>
</div>
<br>

<form action="/domo/guardar" method="post">
    @csrf
    <div class="row">
        <div class="col-6">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="text-center">Crear Domo</h5>
                </div>
                <div class="row card-body">
                    <div class="form-group col-6">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" placeholder="Ingrese el nombre del domo" name="nombre">
                    </div>
                    <div class="form-group col-6">
                        <label for="capacidad">Descripción</label>
                        <textarea class="form-control" name="descripcion" placeholder="Ingrese una descripción"
                            rows="2"></textarea>
                    </div>
                    <div class="form-group col-6">
                        <label for="">Capapcidad</label>
                        <input type="number" class="form-control" placeholder="Ingrese una la capacidad"
                            name="capacidad">
                    </div>
                    <div class="form-group col-6">
                        <label for="numerobaños">Numero de baños</label>
                        <input type="number" class="form-control" placeholder="Ingrese el numero de baños"
                            name="numerobaños">
                    </div>
                    <div class="form-group col-6">
                        <label for="tipodomo">Tipo de domo</label>
                        <input type="text" class="form-control" placeholder="Ingrese el tipo de domo" name="tipodomo">
                    </div>
                    {{-- <div class="form-group col-6">
                        <label for="">Estado</label>
                        <select name="" id="" class="form-control">
                            <option value="1">Activo</option>
                            <option value="2">Inactivo</option>
                        </select>
                    </div> --}}
                </div>
            </div>

            <div class="col-12" style="margin-top: 3%;">
                <button type="submit" class="btn btn-info btn-block">Guardar</button>
            </div>

        </div>
        <div class="col-6">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="text-center">Añadir Caracteristica</h5>
                </div>
                <div class="row card-body">
                    <div class="col-6">
                        <div class="form-group ">
                            <label for="">Nombre</label>
                            <select name="caracteristicas" id="caracteristicas" class="form-control">
                                <option value="">Seleccione</option>
                                @foreach ($caracteristicas as $value)
                                <option value="{{ $value->id }}">{{ $value->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="">Cantidad</label>
                            <input type="number" id="cantidad" class="form-control" min="1">
                        </div>
                    </div>
                    <div class="col-12">
                        <button onclick="agregar_caracteristica()" type="button"
                            class="btn btn-success float-right"><i class="fa-solid fa-plus"></i></button>
                    </div>
                </div>
                <div class="card shadow">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Cantidad</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody id="tblCaracteristicas">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<br><br><br>

@endsection

@section('scripts')
<script>
    let caracteristicasD = [''];
    function agregar_caracteristica(){
                    let caracteristica_id = $("#caracteristicas option:selected").val();
                    let caracteristica_text = $("#caracteristicas option:selected").text();
                    let cantidad = $("#cantidad").val();
                    let existe = caracteristicasD.includes(caracteristica_text)
                                        
                    if(cantidad > 0){
                        
                        if (existe) {
                            alert("la caracteristica ya existe")
                            
                        } else {
                            $("#tblCaracteristicas").append(`
                            <tr id="tr-${caracteristica_id}">
                                <td>
                                    <input type="hidden" name="caracteristica_id[]" value="${caracteristica_id} "/>
                                    <input type="hidden" name="cantidades[]" value="${cantidad} "/>
                                    ${caracteristica_text}
                                </td>
                                <td>${cantidad}</td>
                                <td>
                                    <button type="button" class="btn btn-danger" onclick="eliminar_caracteristica(${caracteristica_id})"><i class="fa-solid fa-trash"></i></button>
                                </td>
                            <tr>
                        
                        `);
                        }

                    }else{
                        alert("Se debe ingresar una cantidad");
                    }
                    caracteristicasD.push(caracteristica_text)
                    /* console.log(caracteristicasD); */
                }

                function eliminar_caracteristica(id){
                    $("#tr-" + id).remove();
                }

</script>


@endsection