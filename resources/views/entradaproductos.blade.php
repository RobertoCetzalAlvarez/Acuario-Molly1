@extends('layouts.master')
@section('titulo','Entradas')
@section('contenido')
<div id="apiEntrada">
        <div class="row">
            <div class="col-md-8"></div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                            <table class="table table-bordered table-condensed">
                                <tr>
                                    <th style="background: #228B22">        
                                        <a href="productos">
                                            <button class="btn btn-success" type="button" >
                                                    Productos
                                            </button>
                                        </a>
                                    </th>
                                    <th style="background: #228B22">        
                                        <a href="productohistoria">
                                            <button class="btn btn-success" type="button" >
                                                    Historial
                                            </button>
                                        </a>
                                    </th>
                                </tr>
                            </table>
                
                    </div>
                    <!-- FIN DEL CARD BODY -->
                </div> 
                <!-- FIN DEL CARD -->
            </div>
         </div><!--FIN DE CONTAINER Y DE CLASS ROW-->



    <div class="container"><!--INICIO DE CONTAINER-->
            <div class="row">
                <div class="col-md-6">

                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <button class="btn btn-success" @click="vender()">GUARDAR</button>
                        </div>
                        <div class="input-group-append">
                            <button class="btn btn-info" @click="mostrarProducto">Buscar por nombre</button>
                        </div>
                    </div>
                    <!-- <h1>@{{prueba}}</h1> -->
                </div>
        </div>
        <!--fin de la cabeza--><!--fin de container-->
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">

                        <!--p v-bind:algin-->
                        <p id="textArea"><h3>FOLIO: @{{folio}}</h3></p> <!--Es una interpolacion-->
                        <!--inicio tabla-->
                        <table class="table table-bordered">
                            <thead>
                                <th style="background: #FFFF00">CODIGO</th>
                                <th style="background: #FFFF00">PRODUCTO</th>
                                <th style="background: #FFFF00" hidden="">TIPO</th>
                                <th style="background: #FFFF00" hidden="">comision POR PLATO</th>
                                <th style="background: #FFFF00">OPER.</th>
                                <th style="background: #FFFF00" hidden="">PRECIO</th>
                                <th style="background: #FFFF00">CANTIDAD</th>

                            </thead> 

                            <tbody>
                                
                                <tr v-for="(venta,index) in ventas">
                                    <td>@{{venta.sku}}</td>
                                    <td>@{{venta.nombre}}</td>
                                    <td hidden="" >@{{venta.id_comida}}</td>
                                    <td hidden="">@{{venta.comicion}}</td>
                                    <td>
                                        <button class="btn btn-default btn-sm" >
                                            <i class="fas fa-trash" @click="eliminarProducto(index)"></i>
                                        </button>
                                    </td>
                                    <td hidden="" >@{{venta.precio}}</td>
                                    <td><input type="number" v-model.number="cantidades[index]" min="1" @change="actuaCantidad(index)"></td>
                                    
                                    </tr>
                            </tbody>
                        </table><!--fin tabla-->
                        <hr>
                        @{{ventas}}
                    </div>

                </div>
                <!--  FIN DEL ROW  -->
        </div> 
        <!-- FIN DEL CARD BODY -->
    </div>
<!-- FIN DEL CARD -->

<!-- Modal para buscar productos -->
<div class="modal fade" id="modalProducto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Buscar_Producto</h5>
        <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>-->
        <button type="button" class="btn btn-primary" data-dismiss="modal">Seguir Editando</button>
      </div>

      <div class="modal-body">
        <form>
		<form>
        	<div><!--tabla2-->
        	<div class="col-md-6">
						<input type="text" placeholder="Escriba el nombre del producto" class="form-control" v-model="buscar">
						</div>
        	<!--inicio tabla-->
					<table class="table table-bordered">
						<thead>
							<th hidden="" style="background: #FFFF00">SKU</th>
							<th style="background: #FFFF00">PRODUCTO</th>
							<th style="background: #FFFF00">PRECIO</th>
							<th style="background: #FFFF00">AÑADIR A LA VENTA</th>
						</thead>

						<tbody max=10 width="50" height="60" >
						<tr v-for="(producto,index) in filtroProducto">
							<td hidden="">@{{producto.sku}}</td>
							<td>@{{producto.nombre}}</td>
							<td> $@{{producto.precio}}</td>
							<div>
								<!--quiero pasar el valor del @{{producto.sku}} a la variable
									v-model="sku" pero no se como 
									para que en buscar producto me añada un producto
									a la venta
									estoy usando apiVenta.js-->

							<td><span class="btn btn-sm btn-primary"
	  					@click="aniadirProducto(producto.sku)">
							<i class="fas fa-plus"></i>
						</span></td></div>

						<!--<button class="btn btn-sm" @click="editandoMascota(mascota.id_mascota)">
									<i class="fas fa-pen"></i>
								</button>-->
						<!--<td><input type="number" v-model.number="cantidades[index]" min="1"></td>-->
						</tr>
					</tbody>
					</table><!--fin tabla-->
        		</div><!--fin tabla2-->

        </form>
        
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Seguir Editando</button>
        <button class="btn btn-success" @click="vender()" >Guardar Entradas</button>
      </div>
    </div>
  </div>
</div>
<!-- aqui termina el modal-->
<!-- PLANTILLA MODAL LIMPIO -->
</div><!--Fin de vue-->

	
@endsection

@push('scripts')

    <script type="text/javascript" src="js/vue-resource.js"></script>
	<script type="text/javascript" src="js/apis/apiEntradaProducto.js"></script>
	<script type="text/javascript" src="js/moment-with-locales.min.js"></script>
	<script type="text/javascript" src="js/apis/apiProducto.js"></script>
@endpush

<input type="hidden" name="route" value="{{url('/')}}">