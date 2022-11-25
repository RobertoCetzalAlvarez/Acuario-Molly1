var ruta = document.querySelector("[name=route]").value;
var apiProducto=ruta + '/entrada2';
var apiDetalle=ruta + '/entradaproducto';

 
new Vue({

	http: {
      headers: {
        'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
      }
    },

	el:"#historia",

	data:{
		productos:[],
        detalles:[],
		buscar:'',
        buscar2:'',
        folio:'20220620815069',
	},

	// AL CREARSE LA PAGINA
	created:function(){
		this.obtenerProductos();
       // this.obtenerDetalles();

	},
 
	methods:{
		//metodos de obtener
		obtenerProductos:function(){
			
			this.$http.get(apiProducto).then(function(json){
				this.productos=json.data;
				console.log(json.data);
			}).catch(function(json){
				console.log(json);
			});
		},
        /*obtenerDetalles:function(){
            this.$http.get(apiDetalle + '/' + this.folio).then(function(json){
                this.detalles=json.data;
                console.log(this.detalles);
            }).catch(function(json){
                console.log(json);
            });
        },*/
		//fin de metodos obtener
        //inicio mostrar modales
        detalle:function(id){
            console.log(id);
            this.$http.get(apiDetalle + '/' + id).then(function(json){
                this.detalles=json.data;
                console.log(this.detalles);
            }).catch(function(json){
                console.log(json);
            });
            $('#modalCobro').modal('show');
        },
        //fin de mostrar modales
        cerrar:function(){

            $('#modalCobro').modal('hide');
        },
	},
	// FIN DE METHODS


	// INICIO COMPUTED
	computed:{
	
		filtroProducto:function(){
			return this.productos.filter((sku)=>{
				return sku.folio.toLowerCase().match(this.buscar.toLowerCase().trim()) 

			});
		},
        filtroProducto2:function(){
            return this.detalles.filter((sku)=>{
				return sku.folio.toLowerCase().match(this.buscar2.toLowerCase().trim()) 

			});
        },
	}
	// FIN DE COMPUTED

});