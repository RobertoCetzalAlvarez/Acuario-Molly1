@extends('layouts.master')
@section('titulo','PRUEBA')
@section('contenido')
	<div id="sku">
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
							<td >@{{getDato.nombre}}</td>
							<td>@{{getDato.cantidad}}</td>
						</tr>
					</tbody>
			</table>
          	
        	<!--AQUI TERMINA EL CONTENIDO-->


	</div>
@endsection


@push('scripts')
<script type="text/javascript" src="js/vue-resource.js"></script>
<script type="text/javascript" src="js/apis/apiIngrediente.js"></script>
	
@endpush

<input type="hidden" name="route" value="{{url('/')}}">