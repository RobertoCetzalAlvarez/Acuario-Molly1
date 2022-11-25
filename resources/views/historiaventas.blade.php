@extends('layouts.master')
@section('titulo','Historial de Ventas')
@push('css')

@endpush
@section('contenido')
<div id="sku">
	<!-- INICIO DE LA TABLA -->
	<table class="table table-bordered table-striped">
					<div class="card-header">
						<h3>HISTORIAL DE VENTA</h3>
							<!--BOTON PARA AGREGAR-->
							<li class="nav-item d-none d-lg-flex">
								<button class="btn btn-success" @click="MostrarModalVenta()" type="button" >Ventas total</button>
							</li>
						<!--FIN BOTON AGREGAR-->
							
					</div>
					<!--<p id="textArea"><h3>Fecha1: @{{fecha}}</h3></p> 
					<p id="textArea"><h3>Fecha2: @{{fecha2}}</h3></p>--> 
					<thead>
						<th style="background: #FFFF00" hidden=""	 >N°</th>
						<th style="background: #FFFF00">FOLIO</th>
						<th style="background: #FFFF00">FECHA</th>
						<th style="background: #FFFF00">ARTICULOS</th>
						<th style="background: #FFFF00" hidden="">SUBTOTAL</th>
						<th style="background: #FFFF00"hidden="">IVA</th>
						<th style="background: #FFFF00">TOTAL</th>
						<th style="background: #FFFF00">GUIA</th>
						<th style="background: #FFFF00">COMICIÓN DEL GUIA</th>
						<th style="background: #FFFF00">PROPINA</th>
						<th style="background: #FFFF00">DETALLES</th>
						

					</thead>

					<tbody>
						<tr v-for="ventas in filtroProducto">
							<td hidden=""	>@{{ventas.n}}</td>
							<td >@{{ventas.folio}}</td>
							<td>@{{ventas.fecha_venta}}</td>
							<td>@{{ventas.num_articulos}}</td>
							<td hidden="">$ @{{ventas.subtotal}}</td>
							<td hidden="">@{{ventas.iva}}</td>
							<td>$@{{ventas.total}}</td>
							<td>@{{ventas.guia}}</td>
							<td>$@{{ventas.comicion}}</td>
							<td>$@{{ventas.Propina}}</td>
							<td>
								<button  class="btn btn-sm" @click="mostrarticket(ventas.folio)">
									<svg  xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16" >
									<path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
									<path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
									</svg>
								</button>
								<button @click="mostrarDetalles(ventas.folio)">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
									<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
									</svg>
								</button>
							</td>
							
						</tr>
					</tbody>
				</table>
				<!-- FIN DE LA TABLA -->
				<!--EL id es el nombre con el que se va a hablar la ventana modal-->
				<div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" id="modalticket" role="dialog" >
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">ticket</h5>
						<button type="button" class="close" @click="cerrarModal()" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<div class="modal-body">
						<form>
							<!--AQUI COMIENZA EL CONTENIDO-->

							
						<!--<iframe src="@{{iid}}"  width="700" height="400"></iframe>-->
					
							
							<!--AQUI TERMINA EL CONTENIDO-->
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" @click="cerrarModal()" >cerrar</button>
					</div>
					</div>
				</div>
				</div>
				<!-- aqui termina el modal-->
				<!--EL id es el nombre con el que se va a hablar la ventana modal-->
				<div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" id="modalventa" role="dialog" >
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">VENTA</h5>
						<button type="button" class="close" @click="cerrarModal()" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<div class="modal-body">
						<form>
							<!--AQUI COMIENZA EL CONTENIDO-->
							
							<div class="card-header">
								<li class="nav-item d-none d-lg-flex">
									<thead>
									<input type="date" class="form-control" v-model="fecha">
									</thead>
									<thead>
									<input type="date" class="form-control" v-model="fecha2">
									</thead>
									<button class="btn btn-success" @click="obtenerDatos()" type="button" >Buscar</button>
								</li>
									
							</div>
								
			<table class="table table-bordered table-striped">
					
					<thead>
						<th style="background: #FFFF00">TOTAL PROPINA</th>
						<th style="background: #FFFF00">TOTAL SIN PROPINA</th>
						<th style="background: #FFFF00">TOTAL NETO</th>
					</thead>
					<thead>
						<th><input type="number" class="form-control" disabled :value="totalPropina"></th>
						<th><input type="number" class="form-control" disabled :value="totalSinPropina"></th>
						<th><input type="number" class="form-control" disabled :value="totalNeto"></th>
					</thead>
			</table>
							
				<table class="table table-bordered table-striped">
					
					<thead>
						<th style="background: #FFFF00">FECHA</th>
						<th style="background: #FFFF00">PROPINA</th>
						<th style="background: #FFFF00">TOTAL</th>

					</thead>

					<tbody>
						<tr v-for="getDato in filtroProducto3">
						<td hidden="">@{{getDato.folio}}</td>
							<td >@{{getDato.fecha_venta}}</td>
							<td>@{{getDato.Propina}}</td>
							<td>@{{getDato.total}}</td>
						</tr>
					</tbody>
			</table>
								
					
							
							<!--AQUI TERMINA EL CONTENIDO-->
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" @click="cerrarModal()" >cerrar</button>
					</div>
					</div>
				</div>
				</div>
				<!-- aqui termina el modal-->



				<!--EL id es el nombre con el que se va a hablar la ventana modal-->
				<div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" id="modaldetalle" role="dialog" >
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">DETALLE</h5>
						<button type="button" class="close" @click="cerrarModal()" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<div class="modal-body">
						<form>
							<!--AQUI COMIENZA EL CONTENIDO-->
				<!-- INICIO DE LA TABLA -->
				<table class="table table-bordered table-striped">
									
					<!--<p id="textArea"><h3>Fecha1: @{{fecha}}</h3></p> 
					<p id="textArea"><h3>Fecha2: @{{fecha2}}</h3></p>--> 
					<thead>
						<th style="background: #FFFF00" hidden=""	 >N°</th>
						<th style="background: #FFFF00">NOMBRE</th>
						<th style="background: #FFFF00">CANTIDAD</th>
						<th style="background: #FFFF00">TOTAL</th>

						

					</thead>

					<tbody>
						<tr v-for="productos in filtroProducto4">
							<td hidden=""	>@{{productos.n}}</td>
							<td >@{{productos.nombre}}</td>
							<td>@{{productos.cantidad}}</td>
							<td>@{{productos.total}}</td>
						</tr>
					</tbody>
				</table>
				<!-- FIN DE LA TABLA -->
					
							
							<!--AQUI TERMINA EL CONTENIDO-->
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" @click="cerrarModal()" >cerrar</button>
					</div>
					</div>
				</div>
				</div>
				<!-- aqui termina el modal-->

</div>
	 
	
@endsection

@push('scripts')
 	<script type="text/javascript" src="js/vue-resource.js"></script>
	<script type="text/javascript" src="js/apis/apiHistoria.js"></script>
	<script type="text/javascript" src="js/moment-with-locales.min.js"></script>
	
@endpush

<input type="hidden" name="route" value="{{url('/')}}">