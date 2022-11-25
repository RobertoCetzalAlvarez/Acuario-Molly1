@extends('layouts.master')
@section('titulo','CRUD MASCOTAS')
@section('contenido')
	
	<!-- INICIA VUE -->
	<div id="mascota">

	

 <div class="row">
 	<div class="col-md-8">
 		
 	</div>
 </div>

		<div class="row">
			<div class="col-md-12">
				<div class="card card-warning"> 
					<div class="card-header">
						<h3>CRUD MASCOTAS 
						<span class="btn btn-sm btn-primary" @click="mostrarModal()">
							<i class="fas fa-plus"></i>
						</span>
						</h3> 

						<div class="col-md-6">
						<input type="text" placeholder="Escriba el nombre o especie de la mascota" class="form-control" v-model="buscar">
						</div>
					</div>

					<div class="card-body">
						
							<!-- INICIO DE LA TABLA -->
				<table class="table table-bordered table-striped">
					<thead>
						<th hidden="">ID MASCOTA</th>
						<th>NOMBRE</th>
						<th>EDAD</th>
						<th>GENERO</th>
						<th>ESPECIE</th>
						<th>ACCIONES</th>

					</thead>

					<tbody>
						<tr v-for="mascota in filtroMascotas">
							<td hidden="">@{{mascota.id_mascota}}</td>
							<td>@{{mascota.nombre}}</td>
							<td>@{{mascota.edad}}</td>
							<td>@{{mascota.genero}}</td>
							<td>@{{mascota.especie.especie}}</td>
							<td>
								<button class="btn btn-sm" @click="editandoMascota(mascota.id_mascota)">
									<i class="fas fa-pen"></i>
								</button>

								<button class="btn btn-sm" @click="eliminarMascota(mascota.id_mascota)">
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
		<!-- Modal -->
<div class="modal fade" id="modalMascota" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel " v-if="agregando==true">AGREGANDO MASCOTAS</h5>
        <h5 class="modal-title" id="exampleModalLabel " v-if="agregando==false">EDITANDO MASCOTAS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="text" class="form-control" placeholder="Nombre de mascota" v-model="nombre"><br>
        <input type="number" class="form-control" placeholder="Escriba edad" v-model="edad"><br>
        <input type="number" class="form-control" placeholder="Escriba el peso" v-model="peso"><br>
        <select class="form-control" v-model="genero">
        	<option disabled="">Elije un genero</option>
        	<option value="M">M</option>
        	<option value="H">H</option>
        </select><br>

        <select class="form-control" name="especie" v-model="id_especie" @change="obtenerRazas">
        	<option disabled="">Elije una especie</option>
        	<option v-for="especie in especies" v-bind:value="especie.id_especie"><td>@{{especie.especie}}</td></option>
        </select><br>
        <select class="form-control" v-model="id_raza">
        	<option value="" disabled="">Seleccione una raza</option>
        	<option v-for="raza in razas" v-bind:value="id_raza">@{{raza.raza}}</option>
        </select>
        <!--<h5>Especie elegida: @{{id_especie}}</h5>-->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" >Cerrar</button>
        <button type="button" class="btn btn-primary" @click="guardarMascota" v-if="agregando==true">Guardar</button>
         <button type="button" class="btn btn-primary" @click="actualizarMascota()" v-if="agregando==false">Guardar</button>
      </div>
    </div>
  </div>
</div>
<!-- TERMINA MODAL -->

	</div>
	<!-- TERMINA VUE -->

	
@endsection

@push('scripts')
	<script type="text/javascript" src="js/vue-resource.js"></script>
	<script type="text/javascript" src="js/apis/apiMascota.js"></script>
@endpush

<input type="hidden" name="route" value="{{url('/')}}">