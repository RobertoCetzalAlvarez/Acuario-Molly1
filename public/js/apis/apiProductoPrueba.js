var ruta = document.querySelector("[name=route]").value;

var apiProducto=ruta + '/pr';
 
new Vue({

	http: {
      headers: {
        'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
      }
    },

	el:"#sku",

	data:{
		productos:[],
		datosPaginados:[],
		nombre:'',
		precio:'',
		cantidad:'',
		agregando:true,
		elementosPorPagina:5,
		cantidad:1,
		precio:0,
		buscar:'',
		totalPagina:0,
		paginaActual:1,

	},

	// AL CREARSE LA PAGINA

	created:function(){
		this.obtenerProductos();
		this.getDataPagina(1);
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
		},

		//calcula la cantidad de  paginas
		totalPaginas:function(){
			
			return Math.ceil(this.productos.length / this.elementosPorPagina)
		},
		getDataPagina:function(noPagina){
			
			this.datosPaginados = []
			let ini = (noPagina * this.elementosPorPagina) - this.elementosPorPagina;
			let fin = (noPagina * this.elementosPorPagina);
			//for (let index = ini; index < fin; index++) {
			//	this.datosPaginados.push(this.productos[index])	
			//}
			this.datosPaginados = this.filtroProducto.slice(ini,fin);
		},
		getPreviousPage(){
	
			if(this.paginaActual >1){
				this.paginaActual--;
			}
			this.getDataPagina(this.paginaActual)

		},
		getNextPage(){
	
			if(this.paginaActual <this.totalPaginas()){
				this.paginaActual++;
			}
			this.getDataPagina(this.paginaActual)

		},
		isActive(noPagina){
			//active
			if(noPagina == this.paginaActual){
				return"active";
			}else{
				return"";
			}

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



var apiHistoria=ruta + '/hist';
new Vue({

	http: {
      headers: {
        'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
      }
    },

	el:"#sku",

	data:{
	getDato:[],
	},
created:function(){
		this.foliar();
		this.obtenerProductos();
		this.getDataPagina(1);
		this.obtenerDatos();
		
	},
	methods:{
		foliar:function(){
			//this.folio="VNT-" + moment().format('YYYYMMD8HMMS');
			//this.folio=moment().format('YYYYMMD8HMMS');
			this.fecha=moment().format('YYYY-MM-DD');
			this.fecha2=moment().format('YYYY-MM-DD');

		},
	obtenerDatos:function(){
			
			this.$http.get(apiventa + '/' + this.fecha + '/' + this.fecha2).then(function(json){
				this.getDato=json.data;
				console.log(this.getDato);
			}).catch(function(json){
				console.log(json);
			});
		},
	},
	computed:{
	filtroProducto3:function(){
			return this.getDato.filter((folio)=>{
				return folio.fecha_venta.toLowerCase().match(this.buscar3.toLowerCase().trim())
			});
		},
	}
	// FIN DE COMPUTED

});