@extends('layouts.master')
@section('titulo','Interface de ventas')
@push('css')

@endpush
@section('contenido')
	
<div id="apiVenta">
<div class="container"><!--INICIO DE CONTAINER-->
		<div class="row">
			<div class="col-md-6">

				<div class="input-group mb-3">
	  					<input type="text" class="form-control" placeholder="Escriba el codigo del producto" aria-label="Recipient's username" aria-describedby="basic-addon2" v-model="sku"
	  					v-on:keyup.enter="buscarProducto()">

	  				<div class="input-group-append">
	   					 <button class="btn btn-primary" type="button" @click="buscarProducto()">Buscar</button>
	  				</div>

	  				<div class="input-group-append">
	  					<button class="btn btn-success" @click="mostrarCobro">Cobrar</button>
	  				</div>
					  <div class="input-group-append">
	  					<button class="btn btn-info" @click="mostrarProducto">Buscar por nombre</button>
	  				</div>
					  <!--<button type="button" @click="printJS()">
							Print PDF
						</button>-->

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
					<p id="textArea"><h3>FOLIO: @{{uuid}}</h3></p><!-- Es una interpolacion-->
					<div class="table table-bordered">
						<thead>
							<th>Guia de turistas</th>
							<th><select class="form-control" name="nombre" v-model="nombre_guia" placeholder="Elija el tipo de producto">
							<option value='' selected="true">Seleccione un guia de turistas</option>
							<option v-for="guias in filtroGuias" ><td>@{{guias.nombre}}</td></option>
						</select></th>
							<th>Tipo de pago</th>
							<th><select class="form-control" name="nombre" v-model="Pago" placeholder="Elija el tipo de producto">
							<option value='' selected="true">Seleccione opcion de pago</option>
							<option ><td>Efectivo</td></option>
							<option ><td>Tarjeta</td></option>
						</select></th>
						</thead>						
					</div>
				
					<!--inicio tabla-->
					<table class="table table-bordered">
						<thead>
							<th style="background: #FFFF00">CODIGO</th>
							<th style="background: #FFFF00">PRODUCTO</th>
							<th style="background: #FFFF00">TIPO</th>
							<th style="background: #FFFF00" hidden="">comision POR PLATO</th>
							<th style="background: #FFFF00">OPER.</th>
							<th style="background: #FFFF00">PRECIO</th>
							<th style="background: #FFFF00">CANTIDAD</th>
							<th style="background: #FFFF00">TOTAL</th>
							<th style="background: #FFFF00" hidden="">TOTAL COMISION</th>
						</thead> 

						<tbody>
							
							<tr v-for="(venta,index) in ventas">
								<td>@{{venta.sku}}</td>
								<td>@{{venta.nombre}}</td>
								<td>@{{venta.id_comida}}</td>
								<td hidden="">@{{venta.comicion}}</td>
								<td>
									<button class="btn btn-default btn-sm" >
										<i class="fas fa-trash" @click="eliminarProducto(index)"></i>
									</button>
								</td>
								<td >@{{venta.precio}}</td>
								<td><input type="number" v-model.number="cantidades[index]" min="1"></td>
								<td>@{{totalProducto(index)}}</td>
								<td hidden="">@{{comicion(index)}}</td>
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


<div class="row">
	<div class="col-md-8"></div>
	

	<div class="col-md-4">
		<div class="card">
			<div class="card-body">
				
					<table class="table table-bordered table-condensed">
					 	<tr>
					 		<th style="background: #FFFF00">Subtotal</th>
					 		<td>$ @{{subTotal}}</td>
					 	</tr>
					 	<tr>
					 		<th style="background: #FFFF00">PROPINA POR PORCENTAJE</th>
					 		<!--<td><b>$ @{{granTotal}}</b></td>-->
        			<td><b>
        				<input type="number" class="form-control" v-model="porcentaje">
        				<input type="number" class="form-control" disabled :value="propina2">
        			</b></td>

					 	</tr>

					 	<tr>
					 		<th style="background: #FFFF00">PROPINA</th>
					 		<!--<td><b>$ @{{granTotal}}</b></td>-->
        					<td><b><input type="number" class="form-control" v-model="propina"></b></td>
					 	</tr>
						 <tr>
					 		<th style="background: #FFFF00">Propina Total</th>
					 		<td><b>$ @{{propinaTotal}}</b></td>
					 	</tr>
						 <tr>
					 		<th style="background: #FFFF00">Comision al guia</th>
					 		<td><b>@{{comisionTotal}}</b></td>
							          
					 	</tr>
					 	<tr>
					 		<th style="background: #FFFF00">TOTAL</th>
					 		<td><b>$ @{{granTotal}}</b></td>
					 	</tr>
						<tr>
							<th style="background: #FFFF00">Articulos :</th>
							<td>@{{noArticulos}}</td>
						</tr>
					</table>
					
				
			</div>
			<!-- FIN DEL CARD BODY -->
		</div> 
		<!-- FIN DEL CARD -->
		</div>
			<!-- FIN DEL COL-MD-4 -->
	</div>
</div><!--FIN DE CONTAINER Y DE CLASS ROW-->

<!-- Modal para el formulario del registro de los moovimientos -->
<div class="modal fade" id="modalCobro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Asistente de cobro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form>
        	<div class="form-row">
	        	<div class="col-md-2">
	        		<label>A PAGAR :</label>	
	        	</div> 
	        	<div class="col-md-6">
	        		<input type="number" class="form-control" disabled :value="granTotal">
	        	</div>
        	</div><br>

        	<div class="form-wor">
        		<div class="col-md-2">
        			<label>PAGA CON:</label>
        		</div>

        		<div class="col-md-6">
        			<input type="number" class="form-control" v-model="pagara_con">
        		</div><br>

        		<div class="form-row">
        			<div class="col-md-2">
        				<label>SU CAMBIO ES: </label>		
        			</div>
        			<div class="col-md-6">
        				<input type="number" class="form-control" disabled :value="cambio"> 
        			</div>	
        		</div>
        		
        	</div> 
        </form>
      </div>
      <div class="modal-footer">
	  <!--<p id="textArea"><h3>FOLIO: @{{uuid}}</h3></p> <--Es una interpolacion-->
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" @click="vender()" >Vender</button>
       <!--/* <li class="nav-item">
                <a href="ticket/2022042289043" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>imprimir ticket</p>
                </a>
              </li>*/-->
              
      </div>
    </div>
  </div>
</div>
<!-- aqui termina el modal-->




<!-- Modal para buscar productos -->
<div class="modal fade" id="modalProducto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Buscar_Producto</h5>
		
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form>
		<form>
        	<div><!--tabla2-->
        	<div class="col-md-6">
						<input type="text" placeholder="Escriba el nombre del producto" class="form-control" v-model="buscar">
						<button class="btn btn-success" @click="mostrarCobro" data-dismiss="modal">Cobrar</button>
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
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Seguir Vendiendo</button>
         <button class="btn btn-success" @click="mostrarCobro" data-dismiss="modal">Cobrar</button>
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
	<script type="text/javascript" src="js/apis/apiVenta.js"></script>
	<!--<script src="js/print.min.js"></script>-->
	<script type="text/javascript" src="js/moment-with-locales.min.js"></script>
	<script type="text/javascript" src="js/apis/apiProducto.js"></script>

	

@endpush


<input type="hidden" name="route" value="{{url('/')}}">