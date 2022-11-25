new Vue({
	// Zona de actuación
	el:'#prueba',

	// Zona de datos
	data:{
		demo:'HOLA MUNDO CRUEL - DESDE TECNOLOGÍAS DE LA INFORMACIÓN',
		nombre:'',
		genero:'',
		edad:6,
		mascotas:[
			{nombre:'Goldi',genero:'H',edad:9},
			{nombre:'Zuma',genero:'M',edad:2},
			{nombre:'Solovino',genero:'M',edad:5},
			{nombre:'Firulais',genero:'M',edad:4}
		],
	},

	// METODOS
	methods:{
		incrementar:function(){
			this.edad++;
		},

		decrementar:function(){
			this.edad--;	
		},
	}
});