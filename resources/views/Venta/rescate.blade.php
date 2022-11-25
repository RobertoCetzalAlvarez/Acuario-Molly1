<div class="container"><!--INICIO DE CONTAINER-->
		<div class="row">
			<div class="col-md-4">

				<div class="input-group mb-3">
	  					<input type="text" class="form-control" placeholder="Escriba el codigo del producto" aria-label="Recipient's username" aria-describedby="basic-addon2" v-model="sku"
	  					v-on:keyup.enter="buscarProducto()">

	  				<div class="input-group-append">
	   					 <button class="btn btn-primary" type="button" @click="buscarProducto()">Buscar</button>
	  				</div>

	  				<div class="input-group-append">
	  					<button class="btn btn-success" @click="mostrarCobro">Cobrar</button>
	  				</div>
				</div>
				<div >
							<section aria-labelledby="trending-heading">
											<div class="bg-white rounded-md shadow" >
											<div><!--tabla2-->
									<div class="col-md-6">
											<input type="text" placeholder="Escriba el nombre del producto" class="form-control" v-model="buscar">
											</div>
								<!--inicio tabla-->
										<table class="table table-bordered">
											<thead>
												<th  style="background: #FFFF00">SKU</th>
												<th style="background: #FFFF00">PRODUCTO</th>
												<th style="background: #FFFF00">PRECIO</th>
												<th style="background: #FFFF00">AÑADIR A LA VENTA</th>
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
														<td>{{$producto->precio}}</td>
														<div>
															<!--quiero pasar el valor del @{{producto.sku}} a la variable
																v-model="sku" pero no se como 
																para que en buscar producto me añada un producto
																a la venta
																estoy usando apiVenta.js-->

														<td><span class="btn btn-sm btn-primary"
															@click="aniadirProducto({{$producto->sku}})">
														<i class="fas fa-plus"></i>
														</span></td></div>

													</tr>
													@endforeach
													@endif
										</tbody>
										</table><!--fin tabla-->
				        		</div><!--fin tabla2-->

														


									</div>
							</section>
					</div>

				<!-- <h1>@{{prueba}}</h1> -->

			</div>
	</div>
	<!--fin de la cabeza--><!--fin de container-->   



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



			<!--fin de la cabeza--><!--fin de container-->
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-12">

					<table class="table table-bordered">
						<thead>
							<th style="background: #FFFF00">SKU</th>
							<th style="background: #FFFF00">PRODUCTO</th>
							<th style="background: #FFFF00">OPER.</th>
							<th style="background: #FFFF00">PRECIO</th>
							<th style="background: #FFFF00">CANTIDAD</th>
							<th style="background: #FFFF00">TOTAL</th>
						</thead>

						<tbody>
							<tr v-for="(venta,index) in ventas">
								<td>@{{venta.sku}}</td>
								<td>@{{venta.nombre}}
									<!--<img v-bind:src=venta.foto width="50" height="60">--></td>
								<td>
									<button class="btn btn-default btn-sm" >
										<i class="fas fa-trash" @click="eliminarProducto(index)"></i>
									</button>
								</td>
								<td >@{{venta.precio}}</td>
								<td><input type="number" v-model.number="cantidades[index]" min="1"></td>
								<td>@{{totalProducto(index)}}</td>
						</tbody>
					</table><!--fin tabla-->
					@{{cantidades}}
					<hr>
					@{{ventas}}
				</div>

			</div>
			<!--  FIN DEL ROW  -->
	</div> 
	<!-- FIN DEL CARD BODY -->
</div>
<!-- FIN DEL CARD -->







@extends('layouts.master')
@section('titulo','Interface de ventas')
@push('css')
<link rel="stylesheet" href="css/estilo.css">
@endpush
@section('contenido')
<div id="sku" >
	<div class="row">
	<td>@{{totalPaginas()}}	</td>
	
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
						<tr v-for="producto in productos">
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
				<nav aria-label="Page navigation example">
					<ul class="pagination">
						<li class="page-item" @click="getPreviousPage"><a class="page-link" href="#">Previous</a></li>
						<li v-for="pagina in totalPaginas()" @click="getDataPagina(pagina)" class="page-item" v-bind:class="isActive(pagina)"><a class="page-link" href="#">@{{pagina}}</a></li>
						<li class="page-item" @click="getNextPage"><a class="page-link" href="#">Next</a></li>
					</ul>
				</nav>

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
@endsection

@push('scripts')
<script type="text/javascript" src="js/vue-resource.js"></script>
	<script type="text/javascript" src="js/apis/apiProductoPrueba.js"></script>
@endpush


<input type="hidden" name="route" value="{{url('/')}}">