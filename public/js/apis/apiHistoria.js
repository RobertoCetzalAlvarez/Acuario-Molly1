var ruta = document.querySelector("[name=route]").value;

var apiHistoria=ruta + '/hist';
var apiventa = ruta +'/totalventa';
var apiDetalles = ruta + '/historiaventa'

 
new Vue({

	http: {
      headers: {
        'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
      }
    },

	el:"#sku",

	data:{
		ventas:[],
		datosPaginados:[],
		getDato:[],
		detalles:[],
		nombre:'',
		precio:'',
		cantidad:'',
		agregando:true,
		elementosPorPagina:5,
		cantidad:1,
		precio:0,
		buscar:'',
		buscar3:'',
		buscar4:'',
		totalPagina:0,
		paginaActual:1,
        iid:'ticket',
        folio:'',
		fecha0:'',
		fecha:'',
		fecha2:'',

	},

	// AL CREARSE LA PAGINA

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
		//inicio metodos obtener datos
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
		//fin de metodos obtener datos
		//inicio de metodos de Mostrar modal
        mostrarticket(id){
            this.folio = id;
            //this.iid = this.iid + id;
			//window.open(ruta + '/ticket/' + this.folio,'_blank');
			//$('#modalticket').modal('show');
			var iframe = this._printIframe;
					if (!this._printIframe) {
						iframe = this._printIframe = document.createElement('iframe');
						document.body.appendChild(iframe);
	
						iframe.style.display = 'none';
						iframe.onload = function() {
						setTimeout(function() {
							iframe.focus();
							iframe.contentWindow.print();
						}, 1);
						};
					}
	
					iframe.src = ruta + '/ticket/' + this.folio;
		},
		MostrarModalVenta(){

			$('#modalventa').modal('show');
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
        cerrarModal(){
            this.iid = 'ticket/';

        
			$('#modalticket').modal('hide');
			$('#modalventa').modal('hide');
			$('#modaldetalle').modal('hide');
		},// fin de metodos mostrar
		

		//calcula la cantidad de  paginas
		totalPaginas:function(){
			
			return Math.ceil(this.ventas.length / this.elementosPorPagina)
		},
		getDataPagina:function(noPagina){
			
			this.datosPaginados = []
			let ini = (noPagina * this.elementosPorPagina) - this.elementosPorPagina;
			let fin = (noPagina * this.elementosPorPagina);
			//for (let index = ini; index < fin; index++) {
			//	this.datosPaginados.push(this.ventas[index])	
			//}
			this.datosPaginados = this.filtroProducto.slice(ini,fin);
		},
		//metodo para sacar fecha actual
		
	},
	// FIN DE METHODS


	// INICIO COMPUTED
	computed:{
		//total de propipa
		totalPropina:function(){
			var total=0;
			var auxSubTotal=0;

			//Se recorre del ultimo hacia abajo
			for (var i = this.getDato.length - 1; i >= 0; i--) {
				total=total+(this.getDato[i].Propina);
				
			}
			console.log(total);
			//Mando una copia del subtotal a la seccion del data 
			//Para el uso de otros calculos
			auxSubTotal=total.toFixed(1);
			return auxSubTotal;

		},
		//fin de total propina
		//total sin propina
		totalSinPropina:function(){
			var total=0;
			var auxSubTotal=0;

			//Se recorre del ultimo hacia abajo
			for (var i = this.getDato.length - 1; i >= 0; i--) {
				total=total+(this.getDato[i].total - this.getDato[i].Propina);
				
			}
			console.log(total);
			//Mando una copia del subtotal a la seccion del data 
			//Para el uso de otros calculos
			auxSubTotal=total.toFixed(0);
			return auxSubTotal;

		},
		//fin de total sin propina
		//total neto
		totalNeto:function(){
			var total=0;
			var auxSubTotal=0;

			//Se recorre del ultimo hacia abajo
			for (var i = this.getDato.length - 1; i >= 0; i--) {
				total=total+(this.getDato[i].total);
				
			}
			console.log(total);
			//Mando una copia del subtotal a la seccion del data 
			//Para el uso de otros calculos
			auxSubTotal=total.toFixed(0);
			return auxSubTotal;
		},
		//fin de total neto
		filtroProducto:function(){
			return this.ventas.filter((sku)=>{
				return sku.folio.toLowerCase().match(this.buscar.toLowerCase().trim()) 

			});
		},
		filtroProducto3:function(){
			return this.getDato.filter((folio)=>{
				return folio.fecha_venta.toLowerCase().match(this.buscar3.toLowerCase().trim())
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