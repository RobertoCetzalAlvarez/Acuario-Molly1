var ruta = document.querySelector("[name=route]").value;
var urlDatos=ruta + '/getDatos';
var myChart=document.getElementById('myChart');


new Vue({
	el:"#grafica",
	data:{

	},

	created:function(){
		this.getDatos();
	},

	methods:{
		getDatos:function(){
			this.$http.get(urlDatos).then(function(j){
				console.log(j);

				//Construccion de la grafica
				var grafica = new Chart(myChart,{
					type:'bar',
					data:{
						labels:j.data.labels,
						datasets:[
						//SERIE1
						{
							label:'por agotarse',
							backgroundColor:'red',
							borderColor:'black',
							borderWidth:2,
							data:j.data.serie1
						},

						//SERIE 2
						/*{
							label:'alto',
							backgroundColor:'green',
							borderColor:'black',
							borderWidth:2,
							data:j.data.serie2

						}*/
						]
					}
				});


				//finde la construccion
			});
		}
	}

});
//fin del VUE