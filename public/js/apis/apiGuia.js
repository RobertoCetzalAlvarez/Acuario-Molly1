var ruta = document.querySelector("[name=route]").value;

var apiGuia=ruta + '/apiGuia';
 
new Vue({

	http: {
      headers: {
        'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
      }
    },

	el:"#sku",

	data:{
		guias:[],
		nombre:'',
		celular:'',
		cantidad:'',
		agregando:true,
		buscar:'',
	},

	// AL CREARSE LA PAGINA

	created:function(){
		this.obtenerGuias();
	},

	methods:{
		obtenerGuias:function(){
			
			this.$http.get(apiGuia).then(function(json){
				this.guias=json.data;
		    	console.log(json.data);
			}).catch(function(json){
				console.log(json);
			});
		},
        //Inicio de Funciones para agregar a Guias de Turistas
            mostrarModal:function(){
                this.agregando=true;
                this.nombre='';
                this.celular='';
                $('#modalGuia').modal('show');
            },//fin de mostrar modal
            guardarGuias:function(){//inicio de guardar Guias de turistas
                
                
                // Se construye el json para enviar al controlador
                var i={
                    nombre:this.nombre,
                    celular:this.celular,
                                };
                    // Se envia los datos en json al controlador
                this.$http.post(apiGuia,i).then(function(j){
                    this.obtenerGuias();
                }).catch(function(j){
                    console.log(j);
                });
            
                $('#modalGuia').modal('hide');

                console.log(i);

            },//fin de guardar Guias de Turistas
        //fin de funciones para agregar a guias de turistas
        //funciones para editar
            editandoGuia:function(sku){//inicio de editando Guia
                this.agregando=false;
                this.sku=sku;

                this.$http.get(apiGuia + '/' +sku).then(function(json){
                // console.log(json.data);
                this.nombre=json.data.nombre;
                this.celular=json.data.celular;
                });

                $('#modalGuia').modal('show');

            },//fin de editando Guia
            actualizarGuia:function(){//inicio de Actualizar Guia

                var jsonGuia = {
                                    nombre:this.nombre,
                                    celular:this.celular,
                                    };

                this.$http.patch(apiGuia + '/' + this.sku,jsonGuia).then(function(json){
                    this.obtenerGuias();

                });
                $('#modalGuia').modal('hide');
            },//fin de Actualizar Guia
        //fin de funciones para editar
        //funciones para eliminar
            eliminarGuia:function(id){
                var confir= confirm('Esta seguro de eliminar el guia de turista?');

                if (confir)
                {
                    this.$http.delete(apiGuia + '/' + id).then(function(json){
                        this.obtenerGuias();
                    }).catch(function(json){

                    });
                }
            },//fin de eliminar
        //fin de funciones para eliminar
		
		
	},
	// FIN DE METHODS


	// INICIO COMPUTED
	computed:{


		filtroProducto:function(){
			return this.guias.filter((id)=>{
				return id.nombre.toLowerCase().match(this.buscar.toLowerCase().trim()) 

			});
		}
	}
	// FIN DE COMPUTED

});