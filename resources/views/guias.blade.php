@extends('layouts.master')
@section('titulo','GUIAS DE TURISTAS')
@push('css')

@endpush
@section('contenido')
<div id="sku">
        <div class="row">
			<div class="col-md-12">
				<div class="card card-warning"> 
					<div class="card-header">
						<h3>Guias de turistas</h3>
							<!--BOTON PARA AGREGAR-->
							<li class="nav-item d-none d-lg-flex">
								<span class="btn btn-primary" @click="mostrarModal()">+ Crear nuevo</span>
							</li>
						<!--FIN BOTON AGREGAR-->
							<div class="col-md-6">
							<input type="text" placeholder="Escriba el nombre del producto" class="form-control" v-model="buscar">
							</div>
						

				</div>

					<div class="card-body">
						
							<!-- INICIO DE LA TABLA -->
				<table class="table table-bordered table-striped">
					<thead>
						<th style="background: #FFFF00">ID</th>
						<th style="background: #FFFF00">NOMBRE</th>
						<th style="background: #FFFF00">CELULAR</th>
						<th style="background: #FFFF00">ACCIONES</th>

					</thead>

					<tbody>
                    <tr v-for="guias in filtroProducto">
							<td>@{{guias.id}}</td>
							<td >@{{guias.nombre}}</td>
							<td>@{{guias.celular}}</td>
                            <td>
								<button class="btn btn-sm" @click="editandoGuia(guias.id)">
									<i class="fas fa-pen"></i>
								</button>

								<button class="btn btn-sm" @click="eliminarGuia(guias.id)">
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
        <!-- INICIA VENTANA MODAL -->
<div class="modal fade" id="modalGuia" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" v-if="agregando===true">AGREGANDO GUIA</h5>
        <h5 class="modal-title" id="exampleModalLabel" v-if="agregando===false">EDITANDO GUIA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <input type="text" class="form-control" placeholder="Nombre del Guia" v-model="nombre"><br>
        <input type="text" class="form-control"  placeholder="Escriba el numero de Celular" v-model="celular"><br>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" @click="guardarGuias()" v-if="agregando==true">Guardar</button>

        <button type="button" class="btn btn-primary" @click="actualizarGuia()" v-if="agregando==false">Guardar</button>
      </div>
    </div>
  </div>
</div>
<!--FIN MODAL -->
</div>
	
	
@endsection

@push('scripts')
 	<script type="text/javascript" src="js/vue-resource.js"></script>
	<script type="text/javascript" src="js/apis/apiGuia.js"></script>
    <script type="text/javascript" src="js/vue.js"></script>

@endpush

<input type="hidden" name="route" value="{{url('/')}}">