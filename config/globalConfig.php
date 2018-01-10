<?php

/**
 * ARREGLO CO LA CONFIGURACION GLOBAL
 * DEL SISTEMA
 */

return [
	
	/**
	 * AGREGA AQUI LA URL DE LA APLICACION
	 *	EJEMPLO : http://localhost/mi/web
	 *	ESTA VARIABLE SE USARA PARA DEFINIR LA RUTA 
	 *	A LOS ASSETS, ENTRE OTRAS COSAS
	 */
	'url_app'		=> 'http://localhost/minimalistphp',
	/**
	 * SUFIJO DE LOS CONTROLADORES
	 */
	'class_sufix'	=>	'Controller',

	/**
	 * SUFIJO POR DEFECTO EN LOS 
	 * METODOS DE LOS CONTROLADORES
	 */
	'default_action_sufix' => 'Action',

	/**
	 * metodo llamado por defecto
	 */
	'default_method'	=> 'index',

	/**
	 * CAPITALIZAR POR DEFECTO 
	 * LOS NOMBRES TANTO DE LAS CLASES COMO
	 * DE LOS METODOS, EJEMPLO:
	 * SI TENEMOS "hola", el resultado es: "Hola"
	 */
	'capitalize'	=> true,

	/**
	 * DIRECTORIO POR DEFECTO DE LOS CONTROLADORES
	 */
	'controller_dir' => 'controladores',

	/**
	 * METODO AL QUE LLAMARA PARA OBTENER LA INSTANCIA
	 * DE LA CLASE
	 */
	'get_instance' => 'getInstance',
	/**
	 * CONTROLADOR POR DEFECTO
	 */
	
	'default_controller' => 'Index',

	/**
	 * GUARDA LA RUTA PADRE DE LOS ARCHIVOS ASSETS
	 */
	'assets' =>  dirname(__DIR__).'/assets',

	/**
	 * TIEMPO DE EXPIRACION DE UNA SESSION
	 * SIN ACTIVIDAD
	 *	ESTA VARIABLE SE USA PARA DECIRLE AL FRAMEWORK
	 *	QUE TIEMPO DURA ACTIVA LA SESSION
	 */
	'session_expire' => 45
];