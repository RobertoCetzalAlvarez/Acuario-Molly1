var ruta = document.querySelector("[name=route]").value;

var apiEgreso=ruta + '/apiEgreso';
var apiegresos = ruta +'/egre';
var apiventa = ruta +'/totalventa';
var apiInicio = ruta + '/inicio';
var apiCapital = ruta + '/capital';

 
new Vue({

	http: {
      headers: {
        'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
      }
    },

	el:"#sku",

	data:{
	egresos:[],
    getEgreso:[],
    getDato:[],
    inicio:[],
    capital:[],
    buscar:'',
    buscar2:'',
    buscar3:'',
    producto:'',
    costo:0,
    cantidad:1,
    fecha:'',
    fecha1:'',
	fecha2:'',
    cantidadinicio:'',
    fechaCaja:'',
    
	},
	// AL CREARSE LA PAGINA
	created:function(){
		this.obtenerProductos();
        this.foliar();
        this.obtenerEgresos();
		this.obtenerDatos();
        this.obtenerInicio();
	},
	methods:{
        foliar:function(){
			//this.folio="VNT-" + moment().format('YYYYMMD8HMMS');
			//this.folio=moment().format('YYYYMMD8HMMS');
			this.fecha=moment().format('YYYY-MM-DD');
			this.fecha2=moment().format('YYYY-MM-DD');

		},
        //inicio metodos obtener
        obtenerInicio:function(){
			
			this.$http.get(apiInicio).then(function(json){
				this.inicio=json.data;
		    	console.log(json.data);
			}).catch(function(json){
				console.log(json);
			});
		}, 
        obtenerDatos:function(){
			//obtiene el dinero de la caja
			this.$http.get(apiventa + '/' + this.fecha + '/' + this.fecha2).then(function(json){
				this.getDato=json.data;
				console.log(this.getDato);
			}).catch(function(json){
				console.log(json);
			});
            //obtiene los egresos de la caja
            this.$http.get(apiegresos + '/' + this.fecha + '/' + this.fecha2).then(function(json){
				this.getEgreso=json.data;
				console.log(this.getEgreso);
                console.log(json);
			}).catch(function(json){
				console.log(json);
			});
            console.log(this.getEgreso);

            //obtiene la capital 
            this.$http.get(apiCapital + '/' + this.fecha + '/' + this.fecha2).then(function(json){
				this.capital=json.data;
				console.log(this.capital);
                console.log(json);
			}).catch(function(json){
				console.log(json);
			});
            console.log(this.capital);
		},
        obtenerEgresos:function(){
			
			this.$http.get(apiegresos + '/' + this.fecha + '/' + this.fecha2).then(function(json){
				this.getEgreso=json.data;
				console.log(this.getEgreso);
                console.log(json);
			}).catch(function(json){
				console.log(json);
			});
            console.log(this.getEgreso);
		},
        obtenerProductos:function(){
			
			this.$http.get(apiEgreso).then(function(json){
				this.egresos=json.data;
		    	console.log(json.data);
			}).catch(function(json){
				console.log(json);
			});
		}, 
        //fin de metodos obtener
        //mostrar modal
        AniadirEgreso:function(){
            $('#modalegreso').modal('show');
        },
        MostrarModalVenta(){

			$('#modalventa').modal('show');
		},
        MostrarCierre(){

			$('#MostrarCierre').modal('show');
		},
        MostrarInicio(){
            $('#MostrarInicio').modal('show');
        },
        AniadirCapital(){
            $('#AniadirCapital').modal('show');
        },
        //fin de mostrar modal
        //inicio metodos guardar
		guardarEgreso:function(){
			
			// Se construye el json para enviar al controlador
			var egreso={
                fecha:moment().format('YYYY-MM-DD'),
                producto:this.producto,
				costo:this.costo,
				cantidad:this.cantidad,
				};
                console.log(egreso);
			// Se envia los datos en json al controlador
			this.$http.post(apiEgreso,egreso).then(function(j){
                console.log(j);
				this.obtenerProductos();
                this.obtenerEgresos();
				this.obtenerDatos();
				this.obtenerInicio();
				this.producto='';
				this.costo='';
				this.cantidad='';
			


			}).catch(function(j){
				console.log(j);
			});
		
			$('#modalegreso').modal('hide');
			

			//console.log(egreso);
		},//fin de guardar
		
        guardarCapital:function(){
			
			// Se construye el json para enviar al controlador
			var inicio={
                fecha:this.fechaCaja,
				cantidad:this.cantidadinicio,
				};
                console.log(inicio);
			// Se envia los datos en json al controlador
			this.$http.post(apiInicio,inicio).then(function(j){
                console.log(j);
				this.obtenerProductos();
                this.obtenerEgresos();
                this.obtenerInicio();
                this.fechaCaja='';
                this.cantidadinicio='';
			


			}).catch(function(j){
				console.log(j);
			});
		
			$('#AniadirCapital').modal('hide');

			
		},//fin de guardar
        cerrarModalCierre(){
            this.iid = 'ticket/';
            $('#AniadirCapital').modal('hide');
            $('#MostrarCierre').modal('hide');
		},
        cerrarModal(){
            this.iid = 'ticket/';
            
            $('#MostrarCierre').modal('hide');
			$('#modalticket').modal('hide');
			$('#modalventa').modal('hide');
			$('#modaldetalle').modal('hide');
		},// fin de metodos mostrar
        //fin cerrar modal
		
	},
	// FIN DE METHODS


	// INICIO COMPUTED
	computed:{
        capitalEnCaja:function(){
			var total=0;
			var auxSubTotal=0;

			//Se recorre del ultimo hacia abajo
			for (var i = this.capital.length - 1; i >= 0; i--) {
				total=total+(this.capital[i].cantidad);
				
			}
			console.log(total);
			//Mando una copia del subtotal a la seccion del data 
			//Para el uso de otros calculos
			auxSubTotal=total.toFixed(1);
            auxSubTotal=auxSubTotal-0;
			return auxSubTotal.toFixed(0);
		},
        totalNeto:function(){
			var total=0;
			var auxSubTotal=0;

			//Se recorre del ultimo hacia abajo
			for (var i = this.getDato.length - 1; i >= 0; i--) {
                //total=total+(this.getDato[i].total);
                if (this.getDato[i].pago =='Efectivo'){
                total=total+(this.getDato[i].total);
                }
			}
			console.log(total);
			//Mando una copia del subtotal a la seccion del data 
			//Para el uso de otros calculos
			auxSubTotal=total;
            auxSubTotal = auxSubTotal + Number(this.capitalEnCaja);
            auxSubTotal = auxSubTotal - this.totalEgresos;
			return auxSubTotal.toFixed(0);
		},
        subTotal:function(){
			var total=0;
			var auxSubTotal=0;

			//Se recorre del ultimo hacia abajo
			for (var i = this.getDato.length - 1; i >= 0; i--) {
				total=total+(this.getDato[i].total);
				// - this.getDato[i].Propina
			}
			console.log(total);
			//Mando una copia del subtotal a la seccion del data 
			//Para el uso de otros calculos
			auxSubTotal=total.toFixed(0);
            auxSubTotal=auxSubTotal-0;
            //this.totalEgresos
			return auxSubTotal.toFixed(0);

		},
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
        totalEgresos(){
            var total=0;
            var auxSubTotal=0;
    
            //Se recorre del ultimo hacia abajo
            for (var i = this.getEgreso.length - 1; i >= 0; i--) {
                total=total+(this.getEgreso[i].costo*this.getEgreso[i].cantidad);
                
            }
            console.log(total);
            //Mando una copia del subtotal a la seccion del data 
            //Para el uso de otros calculos
            auxSubTotal=total.toFixed(1);
            return auxSubTotal;
    
        },
        filtroProducto:function(){
			return this.egresos.filter((id)=>{
				return id.producto.toLowerCase().match(this.buscar.toLowerCase().trim()) 

			});
		},
        filtroProducto2:function(){
			return this.inicio.filter((id)=>{
				return id.producto.toLowerCase().match(this.buscar2.toLowerCase().trim()) 
                console.log(this.inicio);
			});
		},
        filtroProducto3:function(){
			return this.getEgreso.filter((id)=>{
				return id.producto.toLowerCase().match(this.buscar3.toLowerCase().trim())
			});
		},
	
	}
	// FIN DE COMPUTED

});