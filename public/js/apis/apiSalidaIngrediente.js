function init() {
    var ruta = document.querySelector("[name=route]").value;
    var apiProducto= ruta + '/apiAlmacen'; //se crea para tener un acceso global. 
    var apiSalida= ruta + '/IngredienteSalidaController';
  
     
    new Vue({
        //Asignamos el token
        http: {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
                }
            },
    
        //Especificar la zona de actuación de Vue
        el:"#apiSalidaIngrediente",
    
        //Esta sección de VUE sirve para declarar Variables
        //Y constantes. g
        data:{
            //mensaje: 'HOLA MUNDO DESDE LA UTC',
            sku:'',
            ventas:[],
            productos:[],
            cantidades:[],
            //guias
            nombre:'',
            folio:'',
            buscar:'', 
        },
    
        created:function(){
            this.foliar();
            this.obtenerProductos();
        },
    
        //INICIO DE METHODS
        methods:{
            //obtner datos
                obtenerProductos:function(){
                    
                    this.$http.get(apiProducto).then(function(json){
                        this.productos=json.data;
                        console.log(json.data);
                    }).catch(function(json){
                        console.log(json);
                    });
                },//Fin de obtener productos
            //fin de obtener datos
    
            buscarProducto:function(sku){
                var encontrado=0;
    
                if(this.sku){//INICIO DE IF(THIS.SKU)
        
                var producto = {};
    
                //Rutina de busqueda
    
                for (var i = 0; i < this.ventas.length; i++) {
    
                     if (this.sku==this.ventas[i].sku){
    
                         encontrado=1;
                         this.ventas[i].cantidad++;
                         this.cantidades[i]++;
                         this.sku='';
                         break;
                     } //this.ventas[1];
    
                }//fin de rutina de busqueda
    
                //Inicio GET de ARRAY
                //var producto = {}
                if (encontrado==0) 
                this.$http.get(apiProducto + '/' + this.sku).then(function(j){
                    console.log(j.data);
    
                    producto = {
                        sku:j.data.sku,
                        nombre:j.data.nombre,
                        cantidad:1, 
                    };
    
    
                    this.ventas.push(producto);
                    console.log(producto);
                    console.log(this.ventas);
                        this.cantidades.push(1);
                    this.sku='';
                });
                
            }//FIN DE IF(THIS.SKU)
            console.log(this.ventas);
            },//fin de buscar producto
            aniadirProducto:function(id){
                var encontrado=0;
                this.sku=id;
    
                if(this.sku){//INICIO DE IF(THIS.SKU)
        
                var producto = {};
    
                //Rutina de busqueda
    
                for (var i = 0; i < this.ventas.length; i++) {
    
                     if (this.sku==this.ventas[i].sku){
    
                         encontrado=1;
                         this.ventas[i].cantidad++;
                         this.cantidades[i]++;
                         this.sku='';
                         break;
                     } //this.ventas[1];
    
                }//fin de rutina de busqueda
                
                if (encontrado==0)
                
                this.$http.get(apiProducto + '/' +this.sku).then(function(j){
                    console.log(j.data);
    
                    producto = {
                        sku:j.data.sku,
                        nombre:j.data.nombre,
                        cantidad:1, 
                    };
    
                        console.log(producto);
                        this.ventas.push(producto);
                        this.cantidades.push(1);
                    this.sku='';
                });
            }
            },//fin aniadir producto
    
            eliminarProducto:function(id){
                this.ventas.splice(id,1); //Splice es eliminar la mascota
            },
            //modales mostrar
            mostrarProducto:function(){
                $('#modalProducto').modal('show');
            },
            
            //fin modales mostrar
    
            foliar:function(){
                //this.folio="VNT-" + moment().format('YYYYMMD8HMMS');
                this.folio=moment().format('YYYYMMD8HMMS');
    
    
            },
            
        
            vender:function(){
                var unaVenta = {};
                var deta = [];
    
                //Preparamos un JSON con los detalles 
                for (var i = 0; i < this.ventas.length; i++) {
                deta.push(
                        {	sku:this.ventas[i].sku,
                            folio:this.folio,
                            nombre:this.ventas[i].nombre,
                            cantidad:this.ventas[i].cantidad, 
                        }
                        );
                }
                console.log(deta);
    
                //Find a JSON Detalles
                unaVenta = {
                    folio:this.folio,
                    fecha_entrada:moment().format('YYYY-MM-DD'),
                    num_articulos:this.noArticulos,
                    detalles:deta,
                   
                };
                console.log(unaVenta);
                //console.log(unaVenta);
                $('#modalProducto').modal('hide');
                this.foliar();
                this.ventas=[];
                this.cantidades=[];
                this.$http.post(apiSalida,unaVenta).then(function(j){
                    console.log(j);
                    $('#modalProducto').modal('hide');
                    this.foliar();
                    this.ventas=[];
                    this.cantidades=[];
                });
                $('#modalProducto').modal('hide');
            },
            actuaCantidad:function(id){
                this.ventas[id].cantidad=this.cantidades[id];
            }
    },
    //FIN DE METHODS
    
    //SECCION PARA CALCULAR UN VALOR
    computed:{
        totalProducto(){
    
            return (id)=>{
                

    
                //ACTUALIZO LA CANTIDAD EN EL ARRAY VENTAS
                this.ventas[id].cantidad=this.cantidades[id];
    
                //return total.toFixed(1);//Regresa ek total con un decimal
    
            }
    
        },//FIN DE TOTALPRODUCTO
        
        noArticulos(){
            var acum=0;
            for (var i = this.ventas.length - 1; i >= 0; i--) {
                acum=acum+this.ventas[i].cantidad;
            }
            return acum;
        },
    
      
        filtroProducto:function(){
                return this.productos.filter((sku)=>{
                    return sku.nombre.toLowerCase().match(this.buscar.toLowerCase().trim()) 
    
                });
            },
            filtroGuias:function(){
                return this.guias.filter((id)=>{
                    return id.nombre.toLowerCase().match(this.buscar.toLowerCase().trim()) 
    
                });
            },
    },
    
    
    }) 
    } window.onload = init;