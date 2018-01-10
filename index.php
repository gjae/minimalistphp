<?php
/**
 * CARGA DE LAS LIBRERIAS
 * EL ARCHIVO AUTOLOAD HACE UN AUTO CARGADO DE TODAS
 * LAS LIBRERIAS
 * DESARROLLADO POR: GIOVANNY AVILA <https://github.com/gjae
 */
require_once('vendor/autoload.php');
$vistas = require_once('config/vistas.php');
$db = require_once('config/database.php');
$global = require_once('config/globalConfig.php');
require_once('assets/helpers.php');

use Jenssegers\Blade\Blade;
use Illuminate\Database\Capsule\Manager as DB;

/**
 * $DB datos de la conexion a la base de datps
 * @var DB
 */
$DB = new DB;
$DB->addConnection($db);
$DB->setAsGlobal();
$DB->bootEloquent();

/**
 * $vista variable para acceder a las vistas
 * @var $vista
 */
$vista = new Blade($vistas['views'], $vistas['cache']);

$request = [];

/**
 * RECORRE Y OBTIENE TODOS LOS DATOS
 * DEL REQUEST HECHO POR EL CLIENTE
 * @var ARRAY
 */
foreach ($_REQUEST as $clave => $valor) {
	$request[$clave] = $valor;
}

/**
 * LA CLAVE "CONT" HACE REFERENCIA
 * AL CONTROLADOR QUE SERA LLAMADO
 */
if(array_key_exists('cont', $request)){

	$cont = ( !$global['capitalize'])? $request['cont'].$global['class_sufix'] : ucwords($request['cont']).$global['class_sufix'];

	if (getController($cont)) {
		require_once($global['controller_dir'].'/'.$cont.'.php');
		$class = new $cont;
		/**
		 * SI EN LA URL EXISTE UNA VARIABLE GET LLAMADA METHD
		 * ENTOCES ESE SERA EL METODO DEL CONTROLADOR LLAMADO
		 * DE LO CONTRARIO SE USA EL METODO POR
		 * DEFECTO ESTABLECIDO EN EL ARCHIVO globalConfig
		 * @var string
		 */
		$meth = getMethod();
		call($class, $meth);
	}
	else
		throw new Exception('Error 404. Controlador no encontrado');
}

/**
 * EN CASO DE NO EXISTIR LA VARIABLE CONT EN LA URL
 * ENTNCES SE INTENTA LLAMAR AL CONTROLADOR POR DEFECTO
 * PREVIAMENTE ESTABLECIDO EN EL ARCHIVO config/globalConfig.php
 */
else{

	if(getController($global['default_controller'].$global['class_sufix']))
	{
		 require_once($global['controller_dir'].'/'.$global['default_controller'].$global['class_sufix'].'.php');
	

		$cont = $global['default_controller'].$global['class_sufix'];
		$class = new $cont;

		call($class, getMethod());
	}
	else
		throw new Exception('Error 404. Controlador no encontrado');

}

/**
 * @param  $class CLASE QUE SERA LLAMADA
 * @param  $meth METODO DE LA CLASE QUE SERA LLAMADA
 *
 * FUNCION PARA HACER LA LLAMADA A LOS CONTROLADORES
 */
function call($class, $meth)
{
	global $DB, $vista, $request, $global;
	if(method_exists($class, $meth)){

			/**
			 * SE LLAMA AL METODO QUE VIENE POR LA VARIABLE METH
			 * EN LA URL
			 */
		echo call_user_func_array([$class, $meth], [
			'services' => [
				'DB' 		=> $DB, 
				'view' 		=> $vista, 
				'request' 	=> $request, 
				'conf' 		=> $global,
				'DB_CLASS'	=> DB::class,
				] 
			]);

	}
	else{
		throw new Exception('No existe el metodo '.$meth);
	}
}


/**
 * BUSCAR EL ARCHIVO DEL CONTROLADOR PEDIDO A VER SI EXISTE
 * @return [type]
 */
function getController($controller)
{
	global $global;
 	return file_exists( $global['controller_dir'].'/'.$controller.'.php' );
}

/**
 * FUNCION PARA OBTENER EL METODO CORRECTO
 * QUE DEBE EJECUTARSE EN DETERMINADO MOMENTO
 */
function getMethod()
{
	global $request, $global;
	return ( array_key_exists('meth', $request) )? 
				$request['meth'] : 
				$global['default_method'];
}