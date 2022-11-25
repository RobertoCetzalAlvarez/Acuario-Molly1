@extends('layouts.master')
@section('titulo','CRUD PRODUCTOS')
	<script type="text/javascript" src="js/vue.js"></script>
@section('contenido')
<div id="grafica">
</div>
	
	
	<canvas id="myChart"></canvas>
@endsection

@push('scripts')	
<script type="text/javascript" src="js/vue-resource.js"></script>
<script type="text/javascript" src="js/chart.min.js"></script>
<script type="text/javascript" src="js/grafvue.js"></script>
@endpush

<input type="hidden" name="route" value="{{url('/')}}">