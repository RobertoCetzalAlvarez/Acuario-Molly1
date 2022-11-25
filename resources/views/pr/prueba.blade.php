@extends('layouts.master')
@section('titulo','Interface de ventas')
@push('css')
<link rel="stylesheet" href="css/estilo.css">
@endpush
@section('contenido')
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
				<form action="{{route('pr.index')}}" method="get">
				<div class="col-md-6">
					<input type="text" name="buscar" placeholder="Escriba el nombre del producto" class="form-control" value="{{$buscar}}">
				</div>
				</form>
					</div>

					<div class="card-body">
						
							<!-- INICIO DE LA TABLA -->
				<table class="table table-bordered table-striped" >
					<thead>
						<th >ID SKU</th>
						<th>NOMBRE</th>
						<th>FOTOGRAFIA</th>
						<th>PRECIO</th>
						<th>CANTIDAD</th>
						<th>ACCIONES</th>

					</thead>

					<tbody >
						@if(count($productos)<=0)
							<tr>
								<td colspan="5">No hay resultados</td>
							</tr>
						@else
					
						@foreach($productos as $producto)
            			<tr>
							<td >{{$producto->sku}}</td>
							<td>{{$producto->nombre}}</td>
							<td>{{$producto->foto}}</td>
							<td>{{$producto->precio}}</td>
							<td>{{$producto->cantidad}}</td>
							<td>
								<button class="btn btn-sm" @click="editandoProducto({{$producto->sku}})">
									<i class="fas fa-pen"></i>
								</button>

								<button class="btn btn-sm" @click="eliminarProducto({{$producto->sku}})">
									<i class="fas fa-trash"></i>
								</button>
							  </td>
              			</tr>
						@endforeach
						@endif
					</tbody>
				</table>
				<!-- FIN DE LA TABLA -->
				{{$productos->links()}}
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
						<a href="javascript:location.reload()" class="nav-link active">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						<button type="button" class="btn btn-primary" @click="guardarProducto" v-if="agregando==true">Guardar</button>

						<button type="button" class="btn btn-primary" @click="actualizarProducto()" v-if="agregando==false">Guardar</button>
						</a>
					</div>
				</div>
			</div>
		</div>
		<!-- FIN MODAL -->

	</div>
	<!-- TERMINA VUE -->

		

	</div>
	<!-- TERMINA VUE -->



</div>
@endsection

@push('scripts')
  <script type="text/javascript" src="js/vue-resource.js"></script>
  <script type="text/javascript" src="js/moment-with-locales.min.js"></script>
  <script type="text/javascript" src="js/apis/apiProducto.js"></script>
  
@endpush


<input type="hidden" name="route" value="{{url('/')}}">