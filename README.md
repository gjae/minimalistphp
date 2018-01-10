# minimalistphp
A mini framework for aspiring novices wanting to learn to order and standardize their work

# Instalación / Installation

## Version en español

Primeramente debera clonar el repositorio con git tipeando en la consola lo siguiente:
git clone https://github.com/gjae/minimalistphp.git <nombre del proyecto> 
dentro de la carpeta publica de su instalación de apache (/var/www/html/)
Seguidamente ingrese en la carpeta del proyecto y ejecute el comando composer install para instalar la carpeta vendor/ y las dependencias  pre cargadas
Una vez realizado lo anterior, entre en su navegador preferido y dirijase a la url http://localhost/minimalistphp (on en su defecto a la ruta seleccionada) para visualizar la aplicación ya instalada

## English version
First you must clone the repository with git by typing in the console the following:
git clone https://github.com/gjae/minimalistphp.git <name of the project>
within the public folder of your apache installation (/ var / www / html /)
Next, enter the project folder and run the composer install command to install the vendor / folder and the pre-loaded dependencies
Once the above is done, enter your preferred browser and go to the url http: // localhost / minimalistphp (on failing to the selected route) to view the application already installed
  
# Configracuón / Configuration

## Version en español
La configuración basica se encuentra dentro de la carpeta config/.
Dirijase al archivo config/globalConfig.php para settear las variables del arreglo con respecto a sus necesidades 

## English version
The basic configuration is inside the config / folder.
Go to the config / globalConfig.php file to set the array variables with respect to your needs

# Configurando conexión a la base de datos / Configuring connection to the database

## Version en español

Todo lo necesario para configurar un proyecto en MinimalistPHP se encuentra en la carpeta config/.
Para configurar la conexion a la base de datos, usted debe dirigirse al archivo config/database.php. Ya que MinimalistPHP utiliza en ORM Eloquent de Laravel, los todos los drivers estan igualmente disponibles.

## English version

Everything you need to set up a project in MinimalistPHP is in the config / folder.
To configure the connection to the database, you must go to the file config / database.php. Since MinimalistPHP uses in ORM Eloquent de Laravel, all drivers are equally available.

# Inicio rapido / Quick start

## Controladores / Controller

## Version en español

Para crear un nuevo controlador, necesitara copiar el archivo IndexController.php, ubicado dentro de la carpeta controladores, con el nombre del controlador que desea colocarle (el nombre debe ser con el mismo formato Ejemplo: UsuarioController.php), el nombre de la clase del controlador debe ser identico al nombre del arcivo.
Cada uno de los metodos de cada controlador, se le inyecta por defecto un parametro con los servicios pre-definidos (motor de plantillas, clase maestra de Eloquent, etc) con la siguiente estructura:
[
    DB_CLASS => /* LO NECESARIO PARA CREAR TRANSACCIONES CON LA BASE DE DATOS Y DE MAS, ES LA CLASE MAESTRA DEL ORM Y FLUENT */,
    view => /* MOTOR DE PLANTILLAS BLADE: SU USO SE PUEDE VER DENTRO DEL CONTROLADOR IndexController.php */,
    conf => /* CONFIGURACIÓN GLOBAL DE MINIMALISTPHP */,
    request => /* VARIABLES ENVIADAS POR METODO GET COMO POR EJEMPLO EL CONTROLADOR Y EL METODO DEL CONTROLADOR */, 
].
Esto puede ser extendido, usted puede crear mas servicios en cualquier carpeta del proyecto (por ejempĺo en la carpeta de configuración) y manipularlo dentro del archivo index.php en la raíz del proyecto.

## English version

To create a new driver, you will need to copy the IndexController.php file, located inside the drivers folder with the name of the controladores, you want to place it (the name must be in the same format Example: UserController.php), the name of the class of the controller must be identical to the name of the file.
Each of the methods of each controller, is injected by default a parameter with the pre-defined services (template engine, Eloquent master class, etc) with the following structure:
[
    DB_CLASS => / * WHAT IS NECESSARY TO CREATE TRANSACTIONS WITH THE DATABASE AND MORE, IT IS THE MASTER CLASS OF THE ORM AND FLUENT * /,
    view => / * BLADE TEMPLATE MOTOR: YOUR USE CAN BE SEEN INSIDE THE CONTROLLER IndexController.php * /,
    conf => / * GLOBAL CONFIGURATION OF MINIMALISTPHP * /,
    request => / * VARIABLES SENT BY THE GET METHOD AS FOR EXAMPLE THE CONTROLLER AND THE CONTROLLER METHOD * /,
]
This can be extended, you can create more services in any project folder (for example in the configuration folder) and manipulate it within the index.php file in the root of the project.

## Modelos / Models

## Version en español

Intuitivamente, todos los modelos se encuentran dentro de la carpeta modelos/, para crear un nuevo modelo, copie el archivo Usuario.php con el nombre que desee agregarle. MinimalistPHP utiliza el ORM Eloquent, de manera que todas las opciones y configuraciones puede encontrarlo dentro de su documentación oficial, dentro del sitio web de laravel.

## English version

Intuitively, all the models are inside the modelos/ folder, to create a new model, copy the User.php file with the name you want to add. MinimalistPHP uses the Eloquent ORM, so that all options and configurations can be found within its official documentation, within the laravel website.

## Vistas / Views

## Version en español

Predictivamente, al igual que en el caso de los modelos, todos los archivos de vistas se encuentran dentro de la carpeta vistas/. MinimalistPHP utiliza el motor de plantillas Blade, por lo cual, todas sus opciones y sintaxis puede encontrarlo dentro de la documentación oficial de laravel.
A diferencia de laravel, todas las funciones helpers que se pueden usar (tanto en los controladores como en las vistas) se encuentran en un archivo extensible dentro assets/helpers.php

## English version

Predictively, as in the case of the models, all the view files are found in the vitas/ folder. MinimalistPHP uses the Blade template engine, so all its options and syntax can be found within the official laravel documentation.
Unlike laravel, all the helper functions that can be used (both in the controllers and in the views) are in an extensible file in assets/helpers.php

## Rutas / Routes

## Version en español

Todas las rutas dentro de la aplicación vienen definidas por el nombre del controlador resultando una url similar a : http://localhost/index.php?cont=<nombre_controlador>&meth=<nombre_del_metodo>, es decir, en el caso del controlador por defecto sería algo similar a:
http://localhost/index.php?cont=index.
Hagamos una prueba: dirijase al archivo controladores/IndexController.php y cree un nuevo metodo, por ejemplo holaMundo y retorne la tipica palabra "Hola mundo" quedando el mismo con una estructura similar a:
<?php
class IndexController
{
	
	public function index($service){
		extract($service);

		return $view->make('welcome', ['request' => $request]);
	}

       public function holaMundo($service){
		return "Hola mundo";
	}
}
?>

ahora, en su navegador, ingrese en la url: http://localhost/minimalistphp/index.php?cont=index&meth=holaMundo para visualizar el resultado.
Si las variables cont y meth no se encuentran en la URL, MinimalistPHP utilizara el controlador y el metodo por defectos, definidos dentro del archivo config/globalConfig.php (variables: default_controller y default_method respectivamente)

## English version

All routes within the application are defined by the name of the controller resulting in a URL similar to: http://localhost/index.php?cont=<controller_name>&meth=<name_of_method>, that is, in the case of the controller by defect would be something similar to:
http: //localhost/index.php? cont = index.
Let's do a test: go to the file drivers / IndexController.php and create a new method, for example helloWorld and return the typical word "Hello world" being the same with a structure similar to:
<? php
class IndexController
{

	public function index ($ service) {
	extract ($ service);

		return $view->make('welcome', ['request' => $ request]);
	}

	public function helloWorld ($ service) {
		return "Hello world";
	}
}
?>

Now, in your browser, enter in the url: http://localhost/minimalistphp/index.php?cont=index&meth=helloWorld to visualize the result.
If the variables cont and meth are not found in the URL, MinimalistPHP will use the controller and the default method, defined within the config / globalConfig.php file (variables: default_controller and default_method respectively)
