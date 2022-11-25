@extends('layouts.master')
@section('title','STOCK PRODUCTOS')
@section('styles')
@endsection
@section('contenido2')

	<!-- INICIA VUE -->
	<div id="sku">

		<div class="row">
			<div class="col-xl-12">
			<div class="col-md-12">
				<div class="card card-warning"> 
					<div class="card-header">
						<h3>STOCK DE PRODUCTOS 
						<span class="btn btn-sm btn-primary" @click="mostrarModal()">
							<i class="fas fa-plus"></i>
						</span>
						</h3> 

						<div class="col-md-6">
						<input type="text" placeholder="Escriba el nombre del producto" class="form-control" v-model="buscar">
						</div>
					</div>

					<div class="card-body">
						
							<!-- INICIO DE LA TABLA -->
				<table class="table table-bordered table-striped" >
					<thead>
						<th hidden="">ID SKU</th>
						<th>NOMBRE</th>
						<th>FOTOGRAFIA</th>
						<th>PRECIO</th>
						<th>CANTIDAD</th>
						<th>ACCIONES</th>

					</thead>

					<tbody >
						<tr v-for="producto in filtroProducto">
							<td hidden=""	>@{{producto.sku}}</td>
							<td>@{{producto.nombre}}</td>
							<td>@{{producto.foto}}</td>
							<td>@{{producto.precio}}</td>
							<td>@{{producto.cantidad}}</td>
							<td>
								<button class="btn btn-sm" @click="editandoProducto(producto.sku)">
									<i class="fas fa-pen"></i>
								</button>

								<button class="btn btn-sm" @click="eliminarProducto(producto.sku)">
									<i class="fas fa-trash"></i>
								</button>
							</td>
						</tr>
					</tbody>
				</table>
				<!-- FIN DE LA TABLA -->

					</div>
				
					
				</div>
			</div>  
			<!-- FIN DE COL-MD-12 -->
				
			</div>
			
		</div><!--fin de row-->

		<!-- INICIA VENTANA MODAL -->
		<div class="modal fade" id="modalProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel" v-if="agregando==true">AGREGANDO PRODUCTO</h5>
						<h5 class="modal-title" id="exampleModalLabel" v-if="agregando==false">EDITANDO PRODUCTO</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						
						<input type="text" class="form-control" placeholder="Nombre de producto" v-model="nombre"><br>
						<input type="number" class="form-control" placeholder="Escriba precio" v-model="precio"><br>
						<input type="number" class="form-control" placeholder="Escriba la cantidad" v-model="cantidad"><br>


					</div>
					<div class="modal-footer">
						
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						<button type="button" class="btn btn-primary" @click="guardarProducto" v-if="agregando==true">Guardar</button>

						<button type="button" class="btn btn-primary" @click="actualizarProducto()" v-if="agregando==false">Guardar</button>
						
					</div>
				</div>
			</div>
		</div>
		<!-- FIN MODAL -->

	</div>
	<!-- TERMINA VUE -->

	
@endsection

@push('scripts2')
<script type="text/javascript" src="js/vue-resource.js"></script>
	<script type="text/javascript" src="js/apis/apiProducto.js"></script>
@endpush
<input type="hidden" name="route" value="{{url('/')}}">