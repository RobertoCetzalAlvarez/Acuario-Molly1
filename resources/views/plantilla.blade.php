@extends('layouts.master')
@section('titulo','CRUD PRODUCTOS')
@section('contenido')
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<script type="text/javascript" src="js/vue.js"></script>





<!-- PLANTILLA MODAL LIMPIO -->
<!--EL id es el nombre con el que se va a hablar la ventana modal-->
<div class="modal fade" id="modalCobro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form>
        	<!--AQUI VA EL CONTENIDO-->

        	
        	<!--AQUI TERMINA EL CONTENIDO-->
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" @click="vender()">Guardar</button>
      </div>
    </div>
  </div>
</div>
<!-- aqui termina el modal-->


	
	
@endsection


@push('scripts')
	<script type="text/javascript" src="js/vue-resource.js"></script>
	<script type="text/javascript" src="js/apis/apiProducto.js"></script>
	<canvas id="myChart"></canvas>
<script type="text/javascript" src="js/vue-resource.js"></script>
<script type="text/javascript" src="js/chart.min.js"></script>
<script type="text/javascript" src="js/grafvue.js"></script>
@endpush

<input type="hidden" name="route" value="{{url('/')}}">


<!--inicia plantilla limpia-->
@extends('layouts.master')
@section('titulo','')
@section('contenido')
	
	
@endsection

@push('scripts')
	<script type="text/javascript" src="melody/js/vue-resource.js"></script>
@endpush

<input type="hidden" name="route" value="{{url('/')}}">
<!--termina plantilla limplia-->