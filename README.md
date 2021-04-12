# Formulario Boleto Ferias
Este proyecto esta basado en los formularios de Concursos y Boleto Esenciales.

##### Visualizacion en Produccion/Replica
La info para abrir el proyecto desde WebLogin se encuentra en la tabla info.dbo.wlaplicaciones, app_id={actualizar appid}.

##### Iniciar proyecto localmente:
- Crear DB con `sql.sql` en la raiz del directorio (preparada para MSSQL, deberas [traducirla](http://www.sqlines.com/online) si queres crearla en MySQL u otro gestor de DB, o en lugar de crear una DB, pedir acceso/configurar tu cliente de sql para hacer uso de las tablas creadas en Infoprueba/crear las tablas en Infopruebas si no las encontras.
- Modifica los valores de `connections/BaseDatos.php` acorde a tu configuracion especifica. Ver [odbc_connect](https://www.php.net/manual/en/function.odbc-connect.php).
- Version minima de php 7.3
- Instalar [composer](https://getcomposer.org/) y correr en una consola sobre la raiz del proyecto `composer install`
- Para simular un usuario autorizada a usar la app (como sería en produccion) y tener su informacion para usarla en el formulario, se debe obtener una SESSIONKEY de un usuario inscripto en [WebLogin](https://weblogin.muninqn.gov.ar/).
    - Obtener SESSIONKEY desde [WebLogin](https://weblogin.muninqn.gov.ar/), abriendo la consola de desarrollador en cualquier navegador y en la pestaña 'Red', una vez entres a caulquier app de weblogin, uno de los primeros url's cargados en la pestaña  sera un GET con los parametros SESSIONKEY y APP ( lo encontras en la seccion 'Encabezados' dentro de 'Red' ) ejemplo: 
    GET  https://weblogin.muninqn.gov.ar/apps/app-que-seleccionaste/public/index.php?SESSIONKEY=<tu session key>&APP=<app_id>

- Dirigirte a `direccion-de-tu-proyecto/public/index.php?SESSIONKEY=<tu sessionkey>`
- La opcion anterior la podes usar local, sin necesidad de conectarte a las bases de datos de la muni, ya que la consulta del SESSIONKEY se realiza por un WebService directo a las tablas en produccion. En caso de no necesitar simular una persona con la info tal cual es provista en produccion, y querer realizar pruebas en Replica, podes modificar el proyecto en Replica para encontrar al usuario, buscando el SESSIONKEY que te entrega el WebLogin de Replica, en infoprueba.dbo.wlusuarios columna 'controlkey'. 

##### Subiendo a produccion / replica
Al momento de realizar este README, la subida es reemplazandolo el codigo modificado, evitando en lo posible subir los siguientes archivos/secciones de codigo.
> configuration.php  
> connections/BaseDatos.php  
> utils/funciones.php -> `spl_autoload_register()`  

##### Licencia
nosejsja