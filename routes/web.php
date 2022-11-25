<?php

use Illuminate\Support\Facades\Route;
use Luecano\NumeroALetras\NumeroALetras;
use App\Mascota;
use App\Propietario;
use Codedge\Fpdf\Fpdf\Fpdf;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProductoPruebaController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::view('http://localhost/Proyecto/public/grafvue','pruebaVue');

// Ruta de tipo clousure
Route::get('prueba',function(){
	return Mascota::all();
});
Route::apiResource('apiMascota','MascotaController');
Route::apiResource('apiEspecie','EspecieController');
Route::apiResource('apiPropietario','PropietarioController');



//trabajo santamaria apis
Route::apiResource('apiProducto','ProductoController');
Route::apiResource('apiAlmacen','IngrdienteController');
Route::apiResource('apiTipo','TipoController');
Route::apiResource('apiEntrataProducto','EntradaProductoController');
Route::apiResource('pr','ProductoPruebaController');
Route::apiResource('hist','HistoriaController');
Route::apiResource('apiVenta', 'VentaController');
Route::apiResource('apiGuia','GuiaController');
Route::apiResource('DV','DetalleVentaController');
Route::apiResource('apiComida','ComidaController');
Route::apiResource('DineroVenta','DineroController');
Route::apiResource('entrada2','ProductoEntradaController');
//apis para entradas de productos al almacen
Route::apiResource('apiEntradaIngrediente','IngredienteEntradaController');
//api para realizar las salidas de productos
Route::apiResource('IngredienteSalidaController','IngredienteSalidaController');
//api para visualizar el historial de entradas del stock almacen ingredientes
Route::apiResource('apiHistoria','EntradaHistoriaController');
//api para visualizar el historial de salidas del stock almacen ingredientes
Route::apiResource('apiHsalidas','SalidasHistoriaController');
//api para el control de egreso en dinero
Route::apiResource('apiEgreso','EgresoController');
//api que controla los inicios de caja
Route::apiResource('inicio','InicioController');


//vistas santa maria
Route::view('mascotas','mascotas');
Route::view('ventas','Venta\ventas');
Route::view('vt','ventas');
Route::view('vt2','ventas2');
Route::view('h','historiaventas');
Route::view('h2','historiaventas2');
Route::view('productos','productos');
Route::view('almacen','ingredientes');
Route::view('prueba','prueba');
Route::view('prueba2','pruebaVue');
Route::view('guias','guias');
Route::view('entrada','entradaproductos');
Route::view('productohistoria','entradahistoriaproductos');
Route::view('entradaingrediente','entradaingrediente');
Route::view('salidaingrediente','salidaingrediente');
Route::view('salidaingredientehistoria','salidaingredientehistoria');
Route::view('entradaingredientehistoria','entradaingredientehistoria');
Route::view('egresos','egresos');

//rutas parametrizadas de santaMaria
Route::get('ticket/{folio}',[//ruta para generar un ticket
    'as'=>'ticket',
    'uses'=>'VentaController@ticket'
]);
Route::view('graf','nivelprod');
Route::get('getDatos/{id}', 'NivelIngreController@getDatos');
Route::get('getDatos2/{id}', 'NivelIngreController@getInventario');
Route::get('totalventa/{id}/{id2}', 'NivelIngreController@getVentaDinero');
//api parametrizada para traer los detalles de las ventas
Route::get('entradaproducto/{id}', 'NivelIngreController@getProducto');
//api parametrizado para traer los detalles de las ventas realizadas
Route::get('historiaventa/{id}','NivelIngreController@getVentaHistoria');
//api parametrizado para traer los detalles de entrada del stock almacen ingrediente
Route::get('apiIngrediententrada/{id}','NivelIngreController@getHentra');
//api parametrizado para traer los detalles de salida del stock almacen ingrediente
Route::get('apidetallesentrada/{id}','NivelIngreController@getsalida');
//api parametrizado para traer los egresos
Route::get('egre/{id}/{id2}', 'NivelIngreController@getEgresos');
//api parametrizado para traer los capitales
Route::get('capital/{id}/{id2}', 'NivelIngreController@getInicio');
//rutas con en formato PDF
Route::get('Almacenpdf/{id}', 'VentaController@getDatos'); 
Route::get('productopdf/{id}', 'VentaController@getDatos2');

/*Route::get('detalle/{folio}',[//ruta para generar un ticket
    'as'=>'ticket',
    'uses'=>'DetalleVentaController@getdetalle'
]);/
Route::get('pdf','ReporteController@pdf');
// RUTA PARAMETRIZADAS
Route::get('getRazas/{id_especie}', [
    'as' => 'getRazas',
    'uses' => 'EspecieController@getRazas',
]);
/*Route::get('ticket/{folio}',[//ruta para generar un ticket
    'as'=>'ticket',
    'uses'=>'VentaController@ticket'
]);*/







Route::get('convertir',function(){
    $convertir= new NumeroALetras();
    return $convertir->toMoney(1251589.58,2,'PESOS','CENTAVOS');

});



