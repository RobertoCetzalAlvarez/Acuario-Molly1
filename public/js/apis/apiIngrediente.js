var ruta = document.querySelector("[name=route]").value;
var apiAlmacen=ruta + '/apiAlmacen';
var apiTipo=ruta +'/apiTipo';
var urlDatos=ruta + '/getDatos';

 
new Vue({

	http: {
      headers: {
        'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
      }
    },

	el:"#sku",

	data:{
		ingredientes:[],		
		tipos:[],
		getDato:[],
		nombre:'',
		tipo:'',
		agregando:true,
		agregando1:true,
		cantidad:0,
		precio:0,
		buscar:'',
		buscar2:'',
		buscar1:'',
		id_tipo:'',
		id_sku:'',
		num:'7',
		ruta:'Almacenpdf/7'

	},

	// AL CREARSE LA PAGINA
	created:function(){
		this.obtenerIngredientes();
		this.obtenerTipos();
		this.obtenerDatos();
	},
 
	methods:{
		//metodos de obtener
		obtenerIngredientes:function(){
			
			this.$http.get(apiAlmacen).then(function(json){
				this.ingredientes=json.data;
					console.log(json.data);

			}).catch(function(json){
				console.log(json);
			});
		},

		obtenerTipos:function(){
			this.$http.get(apiTipo).then(function(json){
				this.tipos=json.data;
				console.log(json.data);
			}).catch(function(json){
				console.log(json);
			});
		},
		obtenerDatos:function(){
			this.$http.get(urlDatos + '/' + this.num).then(function(json){
				this.getDato=json.data;
				console.log(this.getDato);
			}).catch(function(json){
				console.log(json);
			});
		},
		
//fin de metodos obtener  
//inicio mostrar modales
		mostrarModal:function(){
			this.agregando=true;
			this.nombre='';
			this.cantidad='';
			this.id_tipo='';
			
			$('#modalProducto').modal('show');
		},//fin de mostrar modal
		MostrarModalIngrediente:function(){

			$('#modaLIngrediente').modal('show');
		},
		MostrarModalTipo:function(){
			this.tipo='';
			$('#modalTipo').modal('show');
		},
		mostrarModaltipo2:function(){
			$('#modalTipo2').modal('show');
		},

//fin mostrar modales
//Inicio metodos guardar
		guardarIngrediente:function(){//inicio de guardar Ingrediente
			this.cantidad= 0;
			
			// Se construye el json para enviar al controlador
			var i={
				nombre:this.nombre,
				cantidad:this.cantidad,
				id_tipo:this.id_tipo,
							 };

				// Se envia los datos en json al controlador
			this.$http.post(apiAlmacen,i).then(function(j){
				this.obtenerIngredientes();
				this.nombre='';
				this.cantidad='';
				this.id_tipo='';


			}).catch(function(j){
				console.log(j);
			});
		
			$('#modalProducto').modal('hide');

			console.log(i);

		},//fin de guardar Ingrediente
		agregarTipo:function(){
			
			// Se construye el json para enviar al controlador
			var tipo={
				tipo:this.tipo,
				};

			// Se envia los datos en json al controlador
			this.$http.post(apiTipo,tipo).then(function(j){
				this.obtenerTipos();
				this.tipo='';
			}).catch(function(j){
				console.log(j);
			});
		
			$('#modalTipo2').modal('hide');

			console.log(tipo);
		},//fin de guardar



		//fin de metodos guardar
//inicio metodos eliminar 
		eliminarIngrediente:function(id){
			var confir= confirm('Esta seguro de eliminar el ingrediente?');

			if (confir)
			{
				this.$http.delete(apiAlmacen + '/' + id).then(function(json){
					this.obtenerIngredientes();
				}).catch(function(json){

				});
			}
		},//fin de eliminar
		eliminarTipo:function(sku){
			var confir= confirm('Esta seguro de eliminar el ingrediente?');

			if (confir)
			{
				
				this.$http.delete(apiTipo + '/' +sku).then(function(json){
			this.obtenerTipos();
			}).catch(function(json){

				});
			}
		},

//fin metodos eliminar
//inicio metodos editando
			editandoIngrediente:function(sku){
			this.agregando=false;
			this.sku=sku;

			this.$http.get(apiAlmacen + '/' +sku).then(function(json){
			  // console.log(json.data);
			  this.nombre=json.data.nombre;
			  this.id_tipo=json.data.id_tipo;
			  this.cantidad=json.data.cantidad;
			  console.log(json.data)
			});

			$('#modalProducto').modal('show');

		},//fin de editando Ingrediente
		editandoTipo:function(sku){
			this.agregando1=false;
			this.sku=sku;

			this.$http.get(apiTipo + '/' +sku).then(function(json){
			  // console.log(json.data);
			  this.tipo=json.data.tipo;
			});

			$('#modalTipo2').modal('show');
		},
	//fin metodos editando
	//Inicio metodos actualizar
		actualizarIngrediente:function(){

			var jsonIngrediente = {
								 nombre:this.nombre,
							   cantidad:this.cantidad,
							   id_tipo:this.id_tipo,
								};

			this.$http.patch(apiAlmacen + '/' + this.sku,jsonIngrediente).then(function(json){
				this.obtenerIngredientes();

			});
			$('#modalProducto').modal('hide');
		},
		actualizarTipo:function(){
			var jsonTipo = {
				tipo:this.tipo,
				id_tipo:this.id_tipo,
			};
			this.$http.patch(apiTipo + '/' + this.sku,jsonTipo).then(function(json){
				this.obtenerTipos();

			});
			this.tipo='',
			this.id_tipo='',
			this.agregando1=true;
			$('#modalTipo2').modal('hide');

		},
		//fin de metodos Actualizar
		cerrar:function(){
			$('#modalTipo2').modal('hide');
		},

		getLista:function(){
			window.open(ruta + '/Almacenpdf/' + this.num,'_blank');
		},
	},
	// FIN DE METHODS


	// INICIO COMPUTED
	computed:{
		total:function(){
			var t=0;
			t= this.cantidad * this.precio;
			return t;
		},

		filtroProducto:function(){
			return this.ingredientes.filter((sku)=>{
				return sku.nombre.toLowerCase().match(this.buscar.toLowerCase().trim()) ||
			    sku.tipo.tipo.toLowerCase().match(this.buscar.toLowerCase().trim());
 

			});
		},
		filtroProducto1:function(){
			return this.tipos.filter((id_tipo)=>{
				return id_tipo.tipo.toLowerCase().match(this.buscar1.toLowerCase().trim())
			});
		},
		/*este es el de la ruta parametrizada si se quita
		por algun motivo deja de visualizarse la tabla en la vista*/
		filtroProducto3:function(){
			return this.getDato.filter((sku)=>{
				return sku.nombre.toLowerCase().match(this.buscar2.toLowerCase().trim())
			});
		},
	}
	// FIN DE COMPUTED

});