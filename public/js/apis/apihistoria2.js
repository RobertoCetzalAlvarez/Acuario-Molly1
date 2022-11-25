var ruta = document.querySelector("[name=route]").value;

var apiHistoria=ruta + '/hist';
var apiventa = ruta +'/totalventa';
var apiDetalles = ruta + '/historiaventa';
//import moment from 'moment';
 
new Vue({

	http: {
      headers: {
        'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
      }
    },

	el:"#sku",

	data:{
		ventas:[],
        detalles:[],
        getDato:[],
        buscar:'',
        buscar2:'',
        buscar3:'',
        folio:'',
        iid:'',
        fecha:'2022-06-20',
        fecha2:'2022-06-20',
        
	},

	// AL CREARSE LA PAGINA

	created:function(){
		this.foliar();
		this.obtenerProductos();
        this.obtenerDatos();
	},

	methods:{
        foliar:function(){
            
			//this.folio="VNT-" + moment().format('YYYYMMD8HMMS');
			//this.folio=moment().format('YYYYMMD8HMMS');
            var f =moment().format('YYYY-MM-DD');
            var f2=moment().format('YYYY-MM-DD');
            this.fecha=f;
			this.fecha2=f2;
		},
        //inicia metodos obtener
        obtenerProductos:function(){
			
			this.$http.get(apiHistoria).then(function(json){
				this.ventas=json.data;
		    	console.log(json.data);
			}).catch(function(json){
				console.log(json);
			});
		}, 
        obtenerDatos:function(){

			
			this.$http.get(apiventa + '/' + this.fecha + '/' + this.fecha2).then(function(json){
				this.getDato=json.data;
				console.log(this.getDato);
			}).catch(function(json){
				console.log(json);
			});
		},
        //termina metodos obtner
        //inicia el metodo  mostrar modal
        mostrarticket(id){
            this.folio = id;
            this.iid = this.iid + id;
			window.open(ruta + '/ticket/' + this.folio,'_blank');
			//$('#modalticket').modal('show');
		},
        mostrarDetalles:function(id){
			this.$http.get(apiDetalles + '/' + id).then(function(json){
				this.detalles=json.data;
				console.log(json.data);
			}).catch(function(json){
				console.log(json);
			});	
			$('#modaldetalle').modal('show');
		},
        MostrarModalVenta(){

			$('#modalventa').modal('show');
		},
        //termina el metodo modal
        //empieza metodos cerrar modal
        cerrarModal(){
            this.iid = 'ticket/';

        
			$('#modalticket').modal('hide');
			$('#modalventa').modal('hide');
			$('#modaldetalle').modal('hide');
        }
        //termina metodos cerrar modal
		
		
	},
	// FIN DE METHODS


	// INICIO COMPUTED
	computed:{
        filtroProducto:function(){
			return this.ventas.filter((sku)=>{
				return sku.folio.toLowerCase().match(this.buscar.toLowerCase().trim()) 

			});
        },
        filtroProducto2:function(){
			return this.getDato.filter((folio)=>{
				return folio.fecha_venta.toLowerCase().match(this.buscar2.toLowerCase().trim())
			});
		},
        filtroProducto4:function(){
			return this.detalles.filter((sku)=>{
				return sku.nombre.toLowerCase().match(this.buscar3.toLowerCase().trim())
			});
		},
	}
	// FIN DE COMPUTED

});