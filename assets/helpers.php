<?php  
session_start();
use Carbon\Carbon;
if(!function_exists('checkMinutes')){


	/**
	 * FUNCION PARA CALCULAR EL TIEMPO QUE HA ESTADO
	 * UNA SESSION INACTIVA
	 * @param  $minutes minutos transcurridos (DESDE LA ULTIMA ACTIVIDAD)
	 * @param  $diff diferencia a calcular
	 * @return bool
	 */
	function checkMinutes($minutes, $diff)
	{
		$object = ( is_object($minutes) && ($minutes instanceof Carbon) ) ? $minutes : Carbon::parse($minutes);
		return $object->diffInMinutes(Carbon::now()) <= $diff;
	}


}

if( !function_exists('toObject')){
	/**
	 * TRANSFORMA UN ARREGLO A UN OBJETO
	 * @param  array  $vars [ARRAY DE DATOS]
	 * @return [object]       [OBJETO RESULTADO]
	 */
	function toObject($vars = array()){
		if(is_array($vars) && count($vars) > 0){
			$object = new stdClass();
			foreach($vars as $key => $value){
				$object->$key = (is_array($vars[$key])) ? toObject($vars[$key]) : $value;
			}

			return $object;
		}
		return $vars;
	}
}

if( !function_exists('setSessionWith')){
	function setSessionWith($user = null){
		if(is_null($user))
			throw new \Exception("Error: parametros invalidos, usuario null", 1);
		else{
			$_SESSION['usuario']['user'] = $user->toArray();
			$_SESSION['usuario']['persona'] = $user->persona->toArray();
			updateTime();
		}
	}
}


if( !function_exists('sessionActive')){
	function sessionActive(){
		global $global;
		return checkMinutes(getSessionUser()['tiempo'], $global['session_expire']);
	}
}

if( !function_exists('sessionDestoy')){
	function sessionDestroy(){
		session_destroy();
		return redirect();
	}
}

if( !function_exists('getSessionUser')){
	function getSessionUser(){
		if(isset($_SESSION['usuario']))
			return $_SESSION['usuario'];

		return null;
	}
}

if(!function_exists('updateTime')){

	/**
	 * FUNCION PARA ACTUALIZAR LA ULTIMA HORA DE ACTIVIDAD
	 * DEL USUARIO
	 */
	function updateTime()
	{
		$_SESSION['usuario']['tiempo'] = Carbon::now();
	}
}

if(!function_exists('host')){

	/**
	 * FUNCION PARA OBTENER LA URL
	 * @return [type] [description]
	 */
	function host(){
		global $global;
		return $global['url_app'];
	}
}

if(!function_exists('permiso')){

	/**
	 * FUNCION PARA VERIFICAR SI SE TIENE PERMISO DE UNA ACCION
	 * @param  string $tipo TIPO DE PERMISO A CONSULTAR
	 * @return boolean TRUE SI LO POSEE, DE LO CONTRARIO FALSE
	 */
	function permiso($tipo = ''){
		if(!empty($tipo)){
			foreach ($_SESSION['permisos'] as $permiso) {
				if($permiso['nombre_permiso'] == $tipo);
					return true;
			}
		}
		return false;
	}
}

if(!function_exists('guardar_img')){

	/**
	 * HELPER PARA MOVER IMAGENES A SU DESTINO FINAL
	 * @param  ARRAY $file ARCHIVO A MOVER
	 * @param  ARRAY $ruta RUTA DONDE GUARDAR EL ARCHIVO
	 * @return string 
	 */
	function guardar_img($file, $ruta){
		$nombre = md5(Carbon::now().'_pieza').'.png';
		if(move_uploaded_file($file['tmp_name'], $ruta.'/'.$nombre))
			return $nombre;

		return 'ERROR';
	}
}

if(!function_exists('filtrar_input') ){

	/**
	 * FUNCION PARA FILTRAR CUALQUIER INTENTO DE
	 * INYECCION SQL
	 * @param  [type] $input [description]
	 * @return [type]        [description]
	 */
	function filtrar_input($inputs){
		$palabras = [
			'SELECT' => 'SELECCIONAR',
			'DELETE' => 'BORRAR', 
			'DROP' => 'BORRAR',
			'CREATE' => 'CREAR',
			'UPDATE' => 'ACTUALIZAR'
		];

		$k = [];
		foreach($palabras as $clave => $valor){
			$inputs = str_replace($clave, $valor, strtoupper($inputs) );
		}
		return $inputs;
	}

}

if( !function_exists('assets') ){
	function assets($assetName = ''){
		global $global;
		return ( empty($assetName) ) ? $global['url_app'].'/assets' : $global['url_app'].'/assets/'.$assetName;
	}
}

if( !function_exists('redirect')){
	function redirect($path = ''){
		global $global;
		$url = ( empty($path) ) ? $global['url_app'] : $global['url_app'].'/'.$path;
		header('LOCATION: '.$url); 
	}
}