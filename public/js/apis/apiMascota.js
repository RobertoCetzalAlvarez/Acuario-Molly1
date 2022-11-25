var ruta = document.querySelector("[name=route]").value;

var apiMascota=ruta + '/apiMascota';

var apiEspecie=ruta + '/apiEspecie';



new Vue({


	http: {
      headers: {
        'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
      }
    },

	el:"#mascota",

	data:{
		prueba:'ESTA ES UNA PRUEBA DE NUEVO',
		mascotas:[],
		especies:[],
		razas:[],
		nombre:'',
		edad:'',
		peso:'',
		genero:'',
		agregando:true,
		id_mascota:'',
		id_especie:'',
		id_raza:'',

		cantidad:1,
		precio:0,
		buscar:'',




	},

	// AL CREARSE LA PAGINA
	created:function(){
		this.obtenerMascotas();
		this.obtenerEspecies();
	},

	methods:{
		obtenerMascotas:function(){
			
			this.$http.get(apiMascota).then(function(json){
				this.mascotas=json.data;
				console.log(json.data);
			}).catch(function(json){
				console.log(json);
			});
		},


		mostrarModal:function(){
			this.agregando=true;
			this.nombre='';
			this.edad='';
			this.peso='';
			this.genero='';
			this.id_especie='';
			
			$('#modalMascota').modal('show');
		},

		guardarMascota:function(){
			
			// Se construye el json para enviar al controlador
			var mascota={nombre:this.nombre,
				edad:this.edad,
				peso:this.peso,
				genero:this.genero,
			    id_especie:this.id_especie};

			    // console.log(mascota);

			// Se envia los datos en json al controlador
			this.$http.post(apiMascota,mascota).then(function(j){
				this.obtenerMascotas();
				this.nombre='';
				this.edad='';
				this.peso='';
				this.genero='';
				this.id_especie='';


			}).catch(function(j){
				console.log(j);
			});


			
			$('#modalMascota').modal('hide');

			console.log(mascota);



		},

		eliminarMascota:function(id){
			var confir= confirm('Esta seguro de eliminar la mascota?');

			if (confir)
			{
				this.$http.delete(apiMascota + '/' + id).then(function(json){
					this.obtenerMascotas();
				}).catch(function(json){

				});
			}
		},


		editandoMascota:function(id){
			this.agregando=false;
			this.id_mascota=id;

			this.$http.get(apiMascota + '/' + id).then(function(json){
			  // console.log(json.data);
			  this.nombre=json.data.nombre;
			  this.edad=json.data.edad;
			  this.genero=json.data.genero;
			  this.peso=json.data.peso;



			});

			$('#modalMascota').modal('show');

		},

		actualizarMascota:function(){

			var jsonMascota = {nombre:this.nombre,
							   edad:this.edad,
							   peso:this.peso,
							   genero:this.genero,
							   id_especie:this.id_especie
								};

			// console.log(jsonMascota);

			this.$http.patch(apiMascota + '/' + this.id_mascota,jsonMascota).then(function(json){
				this.obtenerMascotas();

			});
			$('#modalMascota').modal('hide');
		},

		obtenerEspecies:function(){
			this.$http.get(apiEspecie).then(function(json){
				this.especies=json.data;
			})
		},

		obtenerRazas(e){
				var id_especie=e.target.value;
				// console.log(id_especie);

				this.$http.get(ruta + '/getRazas/' + id_especie ).then(function(j){
					this.razas=j.data;
				});

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

		filtroMascotas:function(){
			return this.mascotas.filter((mascota)=>{
				return mascota.nombre.toLowerCase().match(this.buscar.toLowerCase().trim()) 

			});
		}
	}
	// FIN DE COMPUTED



});