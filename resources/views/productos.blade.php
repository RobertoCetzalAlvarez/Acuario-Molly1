@extends('layouts.master')
@section('titulo','STOCK PRODUCTOS')
@section('contenido') 
	
	<!-- INICIA VUE -->
	<div id="sku">
	<div class="row">
        <div class="col-md-8"></div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        
                            <table class="table table-bordered table-condensed">
                                <tr>
                                    <th style="background: #228B22">        
                                        <a href="entrada">
                                            <button class="btn btn-success" type="button" >
                                                    Entrada
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
            <!--</div>
                FIN DEL COL-MD-4 -->
        </div>
    </div><!--FIN DE CONTAINER Y DE CLASS ROW-->



		<div class="row">
			<div class="col-xl-12">
			<div class="col-md-12">
				<div class="card card-warning"> 
					<div class="card-header">
						<h3>STOCK DE PRODUCTOS</h3>
							<li class="nav-item d-none d-lg-flex">
								
								<span class="btn btn-primary" @click="mostrarModal()">+ Crear nuevo</span>
								<button class="btn btn-success" @click="MostrarModalProducto()" type="button" >productos por agotarse</button>
								<button class="btn btn-info" @click="MostrarModalTipo()" type="button" >añadir tipos</button>
							</li>
						<div class="col-md-6">
						<input type="text" placeholder="Escriba el nombre del producto" class="form-control" v-model="buscar">
						</div>
					</div>

					<div class="card-body">
						
							<!-- INICIO DE LA TABLA -->
				<table class="table table-bordered table-striped" >
					<thead>
						<th hidden="">ID SKU</th>
						<th style="background: #FFFF00">NOMBRE</th>
						<th style="background: #FFFF00" hidden="">FOTOGRAFIA</th>
						<th style="background: #FFFF00">PRECIO</th>
						<th style="background: #FFFF00">CANTIDAD</th>
						<th style="background: #FFFF00">TIPO</th>
						<th style="background: #FFFF00">ACCIONES</th>

					</thead>

					<tbody >
						<tr v-for="producto in filtroProducto">
							<td hidden="">@{{producto.sku}}</td>
							<td>@{{producto.nombre}}</td>
							<td hidden="">@{{producto.foto}}</td>
							<td>@{{producto.precio}}</td>
							<td>@{{producto.cantidad}}</td>
							<td>@{{producto.tipo.tipo}}</td>
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
						<div>
						<th style="background: #FFFF00">Elija el tipo de producto</th>
						<select class="form-control" name="id_comida" v-model="id_comida" placeholder="Elija el tipo de producto" >
							<option disabled="">tipo</option>
							<option v-for="comida in comidas" v-bind:value="comida.id_comida"><td>@{{comida.tipo}}</td></option>
						</select>
						</div>

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



<!-- PLANTILLA CRUD TIPO -->
<!--EL id es el nombre con el que se va a hablar la ventana modal-->
<div class="modal fade" id="modalTipo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hotel y Restaurante Santamria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form>
        	<!--AQUI VA EL CONTENIDO-->
        	<div class="row">
			<div class="col-md-12">
				<div class="card card-warning"> 
					<div class="card-header">
						<h3>Comición por Clase de Comida</h3> 
							<!--BOTON PARA AGREGAR-->
						<span class="btn btn-sm btn-primary" @click="mostrarModaltipo2()">
							<i class="fas fa-plus"></i>
						</span><!--FIN BOTON AGREGAR-->
					</div>

					<div class="card-body">
						
							<!-- INICIO DE LA TABLA -->
				<table class="table table-bordered table-striped">
					<thead>
						<th>NOMBRE</th>
						<th>PRECIO</th>
						<th>ACCIONES</th>
					</thead>

					<tbody>
						<tr v-for="comida in filtroProducto2">
							<td>@{{comida.tipo}}</td>
							<td>@{{comida.precio}}</td>
							<td>
								<!--BOTON PARA AGREGAR-->
								<span class="btn btn-sm btn-sm" @click="editandoTipo(comida.id_comida)">
									<i class="fas fa-pen"></i>
								</span>
								<button class="btn btn-sm" @click="eliminarTipo(comida.id_comida)">
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
		</div><!--fin de row-->	


	<!-- MODAL AÑADIR TIPO -->
<!--EL id es el nombre con el que se va a hablar la ventana modal-->
<div class="modal fade" id="modalTipo2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" v-if="agregando1===true">AGREGANDO PRODUCTO</h5>
        <h5 class="modal-title" id="exampleModalLabel" v-if="agregando1===false">EDITANDO ALMACEN</h5>
        <button type="button" class="close"  @click="cerrar()" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form>
        	<!--AQUI VA EL CONTENIDO-->
        	<div>
        		<input type="text" name="tipo" class="form-control" placeholder="Nombre de producto" v-model="tipo">
        	</div>
			<div>
        	<input type="number" class="form-control" placeholder="Escriba precio" v-model="precio"><br>
        	</div>
        	
        	<!--AQUI TERMINA EL CONTENIDO-->
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" @click="cerrar()">Cerrar</button>
        <button type="button" class="btn btn-primary"  @click="agregarTipo()"v-if="agregando1==true">Guardar</button>

        <button type="button" class="btn btn-primary" @click="actualizarTipo()" v-if="agregando1==false">Guardar</button>
      </div>
    </div>
  </div>
</div>
<!-- aqui termina el modal-->
        	
        	<!--AQUI TERMINA EL CONTENIDO-->
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- aqui termina el modal CRUD Tipo-->

<!--EL id es el nombre con el que se va a hablar la ventana modal-->
<div class="modal fade" id="ModalProducto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Productos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form> 
        	<!--AQUI VA EL CONTENIDO-->
			<table class="table table-bordered table-striped">
					<div class="input-group mb-3">
					<input type="number" class="form-control"   v-model="num">

						<div class="input-group-append">
							<button class="btn btn-primary" type="button" @click="obtenerDatos()">Buscar</button>
						</div>
			
					</div>
					<thead>
						<th style="background: #FFFF00">NOMBRE</th>
						<th style="background: #FFFF00">CANTIDAD</th>

					</thead>

					<tbody>
						<tr v-for="getDato in filtroProducto3">
						<td hidden="">@{{getDato.sku}}</td>
							<td >@{{getDato.nombre}}</td>
							<td>@{{getDato.cantidad}}</td>
						</tr>
					</tbody>
			</table>
          	
        	<!--AQUI TERMINA EL CONTENIDO-->
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
		@verbatim
		<button type="button" class="btn btn-primary"  class="nav-link active"
		 @click="getLista()">Obtener Lista</button>
		 @endverbatim
      </div>
    </div>
  </div>
</div>
<!-- aqui termina el modal GRAFICA-->

	<!--EL id es el nombre con el que se va a hablar la ventana modal-->
	<div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" id="modalEntrada" role="dialog" >
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Entrada Productos</h5>
						<button type="button" class="close" @click="cerrarModal()" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<div class="modal-body">
						<form>
							<!--AQUI COMIENZA EL CONTENIDO-->

							
						<iframe src="entrada"  width="700" height="700"></iframe>
					
							
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
	<!-- TERMINA VUE -->

	
@endsection

@push('scripts')
	<script type="text/javascript" src="melody/js/vue-resource.js"></script>
	<script type="text/javascript" src="js/apis/apiProducto.js"></script>
@endpush

<input type="hidden" name="route" value="{{url('/')}}">