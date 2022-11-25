var ruta = document.querySelector("[name=route]").value;

var apiProducto=ruta + '/apiProducto';
 
new Vue({

	http: {
      headers: {
        'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
      }
    },

	el:"#sku",

	data:{
		productos:[],
		nombre:'',
		precio:'',
		cantidad:'',
		agregando:true,

		cantidad:1,
		precio:0,
		buscar:'',

	},

	// AL CREARSE LA PAGINA
	created:function(){
		this.obtenerProductos();
	},

	methods:{
		obtenerProductos:function(){
			
			this.$http.get(apiProducto).then(function(json){
				this.productos=json.data;
				console.log(json.data);
			}).catch(function(json){
				console.log(json);
			});
		},


		mostrarModal:function(){
			this.agregando=true;
			this.nombre='';
			this.precio='';
			this.cantidad='';
			this.foto='';
			
			$('#modalProducto').modal('show');
		},//fin de mostrar modal

		guardarProducto:function(){
			
			// Se construye el json para enviar al controlador
			var producto={nombre:this.nombre,
				precio:this.precio,
				cantidad:this.cantidad};

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


		editandoProducto:function(sku){
			this.agregando=false;
			this.id_sku=sku;

			this.$http.get(apiProducto + '/' +sku).then(function(json){
			  // console.log(json.data);
			  this.nombre=json.data.nombre;
			  this.precio=json.data.precio;
			  this.cantidad=json.data.cantidad;
			  this.foto=json.data.foto;
			});

			$('#modalProducto').modal('show');

		},//fin de editando Producto

		actualizarProducto:function(){

			var jsonProducto = {nombre:this.nombre,
							   precio:this.precio,
							   cantidad:this.cantidad,
							   foto:this.foto,
								};

			this.$http.patch(apiProducto + '/' + this.id_sku,jsonProducto).then(function(json){
				this.obtenerProductos();

			});
			$('#modalProducto').modal('hide');
		}


		
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
				return sku.nombre.toLowerCase().match(this.buscar.toLowerCase().trim()) 

			});
		}
	}
	// FIN DE COMPUTED

});