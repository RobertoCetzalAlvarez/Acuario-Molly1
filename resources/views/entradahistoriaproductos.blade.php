@extends('layouts.master')
@section('titulo','Historial de Entradas')
@section('contenido')
<div id="historia">
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
                                        <a href="productos">
                                            <button class="btn btn-success" type="button" >
                                                    Productos
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
    	<!-- INICIO DE LA TABLA -->
	<table class="table table-bordered table-striped">
					
					<!--<p id="textArea"><h3>Fecha1: @{{fecha}}</h3></p> 
					<p id="textArea"><h3>Fecha2: @{{fecha2}}</h3></p>--> 
					<thead>
						<th style="background: #FFFF00" hidden=""	 >N°</th>
						<th style="background: #FFFF00">FOLIO</th>
						<th style="background: #FFFF00">FECHA</th>
						<th style="background: #FFFF00">ARTICULOS</th>
						<th style="background: #FFFF00">DETALLES</th>
						

					</thead>

					<tbody>
						<tr v-for="productos in filtroProducto">
							<td hidden=""	>@{{productos.n}}</td>
							<td >@{{productos.folio}}</td>
							<td>@{{productos.fecha_entrada}}</td>
							<td>@{{productos.num_articulos}}</td>
							<td>
								<!--@{{productos.detalles}}-->
                                <button  class="btn btn-sm" @click="detalle(productos.folio)">
									<svg  xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16" >
									<path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
									<path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
									</svg>
								</button>
								<!--<button @click="mostrarDetalles()">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
									<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
									</svg>
								</button>-->
							</td>
							
						</tr>
					</tbody>
				</table>
				<!-- FIN DE LA TABLA -->
                <!-- PLANTILLA MODAL LIMPIO -->
                <!--EL id es el nombre con el que se va a hablar la ventana modal-->
                <div class="modal fade" id="modalCobro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detalles</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form>
                            <!--AQUI VA EL CONTENIDO-->

                            <!-- INICIO DE LA TABLA -->
	<table class="table table-bordered table-striped">
					<div class="card-header">
						
							<!--BOTON PARA AGREGAR-->
							<li class="nav-item d-none d-lg-flex">
								<button class="btn btn-success" @click="MostrarModalVenta()" type="button" >productos total</button>
							</li>
						<!--FIN BOTON AGREGAR-->
							
					</div>
					<!--<p id="textArea"><h3>Fecha1: @{{fecha}}</h3></p> 
					<p id="textArea"><h3>Fecha2: @{{fecha2}}</h3></p>--> 
					<thead>
						<th style="background: #FFFF00" hidden=""	 >N°</th>
						<th style="background: #FFFF00">FOLIO</th>
						<th style="background: #FFFF00">NOMBRE</th>
						<th style="background: #FFFF00">CANTIDAD</th>
						
						

					</thead>

					<tbody>
						<tr v-for="productos in filtroProducto2">
							<td hidden=""	>@{{productos.n}}</td>
							<td >@{{productos.folio}}</td>
							<td>@{{productos.nombre}}</td>
							<td>@{{productos.cantidad}}</td>
							
						</tr>
					</tbody>
				</table>
				<!-- FIN DE LA TABLA -->

                            
                            <!--AQUI TERMINA EL CONTENIDO-->
                        </form>
                    </div>
                    <div class="modal-footer">
                        
                        <button type="button" class="btn btn-primary" @click="cerrar()">cerrar</button>
                    </div>
                    </div>
                </div>
                </div>
                <!-- aqui termina el modal-->



</div> <!--Fin de vue-->
	
	
@endsection

@push('scripts')
	<script type="text/javascript" src="melody/js/vue-resource.js"></script>
    <script type="text/javascript" src="js/apis/apiHistoriaProducto.js"></script>
@endpush

<input type="hidden" name="route" value="{{url('/')}}">