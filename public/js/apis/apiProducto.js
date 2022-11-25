var ruta = document.querySelector("[name=route]").value;
var apiProducto=ruta + '/apiProducto';
var apiComida = ruta + '/apiComida';
var urlDatos = ruta + '/getDatos2';
 
new Vue({

	http: {
      headers: {
        'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
      }
    },

	el:"#sku",

	data:{
		productos:[],
		comidas:[],
		getDato:[],
		num:7,
		nombre:'',
		precio:'',
		cantidad:'',
		agregando:true,
		agregando1:true,
		cantidad:1,
		precio:0,
		buscar:'',
		buscar2:'',
		buscar3:'',
		tipo:'',
		sku:'',
		id_comida:'',
	},

	// AL CREARSE LA PAGINA
	created:function(){
		this.obtenerProductos();
		this.obtenerTipos();
		this.obtenerDatos();
	},
 
	methods:{
		//metodos de obtener
		obtenerProductos:function(){
			
			this.$http.get(apiProducto).then(function(json){
				this.productos=json.data;
				console.log(json);
			}).catch(function(json){
				console.log(json);
			});
		},
		obtenerTipos:function(){
			
			this.$http.get(apiComida).then(function(json){
				this.comidas=json.data;
				console.log(this.comidas);
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
		//fin de metodos de obtener
		//inicio metodos mostrar modal
		mostrarModal:function(){
			this.agregando=true;
			this.nombre='';
			this.precio='';
			this.cantidad='';
			this.foto='';
			
			$('#modalProducto').modal('show');
		},//fin de mostrar modal
		MostrarModalTipo:function(){
			this.tipo='';
			$('#modalTipo').modal('show');
		},
		mostrarModaltipo2:function(){
			$('#modalTipo2').modal('show');
		},
		MostrarModalProducto(){
			$('#ModalProducto').modal('show');
		},
		modalEntrada:function(){
			$('#modalEntrada').modal('show');
		},
		// fin de metodos mostrar modal
		//metodo de cerrar modal
		cerrar:function(){
			$('#modalTipo2').modal('hide');
		},
		cerrarModal(){
           
			$('#modalEntrada').modal('hide');
		},// fin de metodos mostrar
		//fin de metodo de cerrar modal
		//inicio metodos guardar
		guardarProducto:function(){
			
			// Se construye el json para enviar al controlador
			var producto={nombre:this.nombre,
				precio:this.precio,
				cantidad:this.cantidad,
				id_comida:this.id_comida};

			// Se envia los datos en json al controlador
			this.$http.post(apiProducto,producto).then(function(j){
				this.obtenerProductos();
				this.nombre='';
				this.precio='';
				this.cantidad='';
				this.foto='';


			}).catch(function(j){
				console.log(j);
			});
		
			$('#modalProducto').modal('hide');

			console.log(producto);
		},//fin de guardar
		agregarTipo:function(){
			
			// Se construye el json para enviar al controlador
			var tipo={
				tipo:this.tipo,
				precio:this.precio
			};

			// Se envia los datos en json al controlador
			this.$http.post(apiComida,tipo).then(function(j){
				this.obtenerTipos();
				this.tipo='';
			}).catch(function(j){
				console.log(j);
			});
		
			$('#modalTipo2').modal('hide');

			console.log(tipo);
		},//fin de guardar
		//fin de metodos de guardar
		//inicio metodos de editar
		editandoProducto:function(sku){
			this.agregando=false;
			this.id_sku=sku;

			this.$http.get(apiProducto + '/' +sku).then(function(json){
			  // console.log(json.data);
			  this.nombre=json.data.nombre;
			  this.precio=json.data.precio;
			  this.cantidad=json.data.cantidad;
			  this.id_comida=json.data.id_comida;
			  console.log(json);
			});

			$('#modalProducto').modal('show');

		},//fin de editando Producto
	
		editandoTipo:function(sku){
			this.agregando1=false;
			this.sku=sku;

			this.$http.get(apiComida + '/' +sku).then(function(json){
			  // console.log(json.data);
			  this.tipo=json.data.tipo;
			  this.sku=json.data.id_comida;
			  this.precio=json.data.precio;
			  console.log(json.data);
			});

			$('#modalTipo2').modal('show');
		},
		//fin de metodos de editando
		//inicio metodos de actualizar 
		actualizarProducto:function(){

			var jsonProducto = {nombre:this.nombre,
							   precio:this.precio,
							   id_comida:this.id_comida,
							   cantidad:this.cantidad,
							   foto:this.foto,
								};
								console.log(jsonProducto);
			this.$http.patch(apiProducto + '/' + this.id_sku,jsonProducto).then(function(json){
				this.obtenerProductos();

			});
			$('#modalProducto').modal('hide');
		},
		actualizarTipo:function(sku){
			var jsonTipo = {
				tipo:this.tipo,
				precio:this.precio,
			};
			this.$http.patch(apiComida + '/' + sku,jsonTipo).then(function(json){
				this.obtenerTipos();

			});
			$('#modalTipo2').modal('hide');

		}, 
		//fin de metodos de actualizar
		//inicio metodos de Eliminar
		eliminarProducto:function(id){
			var confir= confirm('Esta seguro de eliminar el producto?');

			if (confir)
			{
				this.$http.delete(apiProducto + '/' + id).then(function(json){
					this.obtenerProductos();
				}).catch(function(json){

				});
			}
		},//fin de eliminar
		eliminarTipo:function(sku){
			var confir= confirm('Esta seguro de eliminar el ingrediente?');

			if (confir)
			{
				
			this.$http.delete(apiComida + '/' +sku).then(function(json){
			this.obtenerTipos();
			});
			}
		},
		//fin de metodos de eliminar
		getLista:function(){
			window.open(ruta + '/productopdf/' + this.num,'_blank');
		},
		Entrada:function(){
			entrada = 'entrada';
			window.open(ruta + '/' + entrada,//'_blank'
			);
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
			return this.productos.filter((sku)=>{
				return sku.nombre.toLowerCase().match(this.buscar.toLowerCase().trim()) ||
				 sku.tipo.tipo.toLowerCase().match(this.buscar.toLowerCase().trim());

			});
		},
		filtroProducto2:function(){
			return this.comidas.filter((id_comida)=>{
				return id_comida.tipo.toLowerCase().match(this.buscar2.toLowerCase().trim()) 

			});
		},
		filtroProducto3:function(){
			return this.getDato.filter((sku)=>{
				return sku.nombre.toLowerCase().match(this.buscar3.toLowerCase().trim())
			});
		},
	}
	// FIN DE COMPUTED

});