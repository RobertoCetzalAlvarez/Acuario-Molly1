<!--inicia plantilla limpia-->
@extends('layouts.master')
@section('titulo','$Caja')
@section('contenido')
<div id="sku">
<div class="row"> 
        <div class="col-md-8"></div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        
                            <table class="table table-bordered table-condensed">
                                <tr>
                                    <th style="background: #228B22">        
                                        <a href="#">
                                            <!--es cuanto hay al final del dia-->
                                            <button class="btn btn-success" type="button" @click="MostrarCierre()" >
                                            CIERRE DE CAJA
                                            </button>
                                        </a>
                                    </th>
									<th style="background: #228B22">        
                                        <a href="#">
                                            <button class="btn btn-success" type="button" @click="MostrarInicio()" >
                                            INICIO DE CAJA
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
					<div class="card-header">
						<h3>EGRESOS</h3>
							<!--BOTON PARA AGREGAR-->
							<li class="nav-item d-none d-lg-flex">
								<button class="btn btn-success" @click="MostrarModalVenta()" type="button" >Egresos Del Dia</button>
                                <button class="btn btn-info" @click="AniadirEgreso()" type="button" >$ añadir egresos</button>
							</li>
						<!--FIN BOTON AGREGAR-->
							
					</div>
					<!--<p id="textArea"><h3>Fecha1: @{{fecha}}</h3></p> 
					<p id="textArea"><h3>Fecha2: @{{fecha2}}</h3></p>--> 
					<thead>
						<th style="background: #FFFF00">ID</th>
						<th style="background: #FFFF00">FECHA</th>
                        <th style="background: #FFFF00">PRODUCTO</th>
                        <th style="background: #FFFF00">CANTIDAD</th>
                        <th style="background: #FFFF00">PRECIO</th>					
						

					</thead>

					<tbody>
						<tr v-for="egresos in filtroProducto">

							<td >@{{egresos.id}}</td>
							<td>@{{egresos.fecha}}</td>
                            <td>@{{egresos.producto}}</td>
                            <td>@{{egresos.cantidad}}</td>
							<td>$@{{egresos.costo}}</td>	
						</tr>
					</tbody>
				</table>
				<!-- FIN DE LA TABLA -->
                <!--EL id es el nombre con el que se va a hablar la ventana modal-->
                <div class="modal fade" id="modalegreso" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal Egreso</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form>
                            <!--AQUI VA EL CONTENIDO-->
                            <input type="text" class="form-control" placeholder="Nombre de producto" v-model="producto"><br>
                            <h5>PRECIO</h5>
                            <input type="number" class="form-control" placeholder="Escriba precio" v-model="costo"><br>
                            <h5>CANTIDAD</h5>
                            <input type="number" class="form-control" placeholder="Escriba la cantidad" v-model="cantidad"><br>

                            
                            <!--AQUI TERMINA EL CONTENIDO-->
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-primary" @click="guardarEgreso()">Guardar</button>
                    </div>
                    </div>
                </div>
                </div>
<!-- aqui termina el modal-->
<!--EL id es el nombre con el que se va a hablar la ventana modal-->
<div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" id="modalventa" role="dialog" >
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">VENTA</h5>
						<button type="button" class="close" @click="cerrarModal()" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<div class="modal-body">
						<form>
							<!--AQUI COMIENZA EL CONTENIDO-->
							
							<div class="card-header">
								<li class="nav-item d-none d-lg-flex">
									<thead>
									<input type="date" class="form-control" v-model="fecha">
									</thead>
									<thead>
									<input type="date" class="form-control" v-model="fecha2">
									</thead>
									<button class="btn btn-success" @click="obtenerDatos()" type="button" >Buscar</button>
								</li>
									
							</div>
								
			<table class="table table-bordered table-striped">
					
					<thead>
						<th style="background: #FFFF00">TOTAL NETO DE EGRESOS</th>
					</thead>
					<thead>
						<th><input type="number" class="form-control" disabled :value="totalEgresos"></th>
					</thead>
			</table>
							
				<table class="table table-bordered table-striped">
					
					<thead>
                    <th style="background: #FFFF00">ID</th>
						<th style="background: #FFFF00">FECHA</th>
                        <th style="background: #FFFF00">PRODUCTO</th>
                        <th style="background: #FFFF00">CANTIDAD</th>
                        <th style="background: #FFFF00">PRECIO</th>	

					</thead>

					<tbody>
                    <tr v-for="getDato in filtroProducto3">

                    <td >@{{getDato.id}}</td>
                    <td>@{{getDato.fecha}}</td>
                    <td>@{{getDato.producto}}</td>
                    <td>@{{getDato.cantidad}}</td>
                    <td>$@{{getDato.costo}}</td>
                    </tr>
					</tbody>
			</table>
								
					
							
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

                <!--MODAL CIERRE DE CAJA-->
				<div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" id="MostrarCierre" role="dialog" >
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">VENTA</h5>
						<button type="button" class="close" @click="cerrarModalCierre()" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<div class="modal-body">
						<form>
							<!--AQUI COMIENZA EL CONTENIDO-->
							
							<div class="card-header">
								<li class="nav-item d-none d-lg-flex">
									<thead>
									<input type="date" class="form-control" v-model="fecha">
									</thead>
									<thead>
									<input type="date" class="form-control" v-model="fecha2">
									</thead>
									<button class="btn btn-success" @click="obtenerDatos()"  type="button" >Buscar</button>
								</li>
									
							</div>
								
			<table class="table table-bordered table-striped">
					
					<thead>
						<th style="background: #FFFF00">TOTAL PROPINA</th>
						<th style="background: #FFFF00">TOTAL EGRESOS</th>
                        <th style="background: #FFFF00">TOTAL VENTA</th>
                        <th style="background: #FFFF00">CAPITAL EN CAJA</th>
					    <th style="background: #FFFF00">TOTAL NETO CAJA</th>
					</thead>
					<thead>
						<th><input type="number" class="form-control" disabled :value="totalPropina"></th>
						<th><input type="number" class="form-control" disabled :value="totalEgresos"></th>
                        <th><input type="number" class="form-control" disabled :value="subTotal"></th>
                        <th><input type="number" class="form-control" disabled :value="capitalEnCaja"></th>
						<th><input type="number" class="form-control" disabled :value="totalNeto"></th>
					</thead>
			</table>
							<!--AQUI TERMINA EL CONTENIDO-->
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" @click="cerrarModalCierre()" >cerrar</button>
					</div>
					</div>
				</div>
				</div>
				<!-- aqui termina el modal-->
                 <!--MODAL CIERRE DE CAJA INICIO-->
				<!--EL id es el nombre con el que se va a hablar la ventana modal-->
                <div class="modal fade" id="MostrarInicio" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <!--EMPIEZA MODAL DENTRO DE MODAL-->
                            <!--AQUI VA EL CONTENIDO-->
                             <!-- INICIO DE LA TABLA -->
	            <table class="table table-bordered table-striped">
					<div class="card-header">
						<h3>INICIO DE CAJA</h3>
							<!--BOTON PARA AGREGAR-->
							<li class="nav-item d-none d-lg-flex">
                                <button class="btn btn-info" @click="AniadirCapital()" type="button" >$añadir capital</button>
							</li>
						<!--FIN BOTON AGREGAR-->
							
					</div>
					<!--<p id="textArea"><h3>Fecha1: @{{fecha}}</h3></p> 
					<p id="textArea"><h3>Fecha2: @{{fecha2}}</h3></p>--> 
					<thead>
						<th style="background: #FFFF00">ID</th>
						<th style="background: #FFFF00">FECHA</th>
                        <th style="background: #FFFF00">CANTIDAD</th>
                        <th style="background: #FFFF00">CARACTER</th>
				
						
						

					</thead>

					<tbody>
						<tr v-for="inicio in filtroProducto2">

							<td >@{{inicio.id}}</td>
							<td>@{{inicio.fecha}}</td>
                            <td>@{{inicio.cantidad}}</td>
                            <td>@{{inicio.producto}}</td>
                            	
						</tr>
					</tbody>
				</table>
                <!--EMPIEZA MODAL DENTRO DE MODAL-->
				<!-- FIN DE LA TABLA -->
                <!--MODAL CIERRE DE CAJA-->
				<div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" id="AniadirCapital" role="dialog" >
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">AÑADIR CAPITAL PARA EL INICIO DE CAJA</h5>
						<button type="button" class="close" @click="cerrarModalCierre()" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>

					<div class="modal-body">
						<form>
							<!--AQUI COMIENZA EL CONTENIDO-->
                            <h6>FECHA DE INICIO DE CAJA</h6>
                            <input type="date" class="form-control" v-model="fechaCaja">
                            <h6>CANTIDAD</h6>
                            <input type="number" class="form-control" placeholder="Escriba la cantidad" v-model="cantidadinicio"><br>
							<!--AQUI TERMINA EL CONTENIDO-->
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" @click="guardarCapital()" >Guardar</button>
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
				<!-- aqui termina el modal-->
                
	
@endsection

@push('scripts')
	<script type="text/javascript" src="melody/js/vue-resource.js"></script>
    <script type="text/javascript" src="js/apis/apiEgreso.js"></script>
@endpush

<input type="hidden" name="route" value="{{url('/')}}">
<!--termina plantilla limplia-->