# Formulario Libreta Sanitaria
Este proyecto esta basado en los formularios de Ferias.

##### Visualizacion en Produccion/Replica
La info para abrir el proyecto desde WebLogin se encuentra en la tabla info.dbo.wlaplicaciones, app_id={actualizar appid}.

##### Iniciar proyecto localmente:
- Crear DB con `sql.sql` en la raiz del directorio (preparada para MSSQL, deberas [traducirla](http://www.sqlines.com/online) si queres crearla en MySQL u otro gestor de DB, o en lugar de crear una DB, pedir acceso/configurar tu cliente de sql para hacer uso de las tablas creadas en Infoprueba/crear las tablas en Infopruebas si no las encontras.
- Modifica los valores de `.env` (úbicado en la raiz del proyecto) acorde a tu configuración especifica. Ver [odbc_connect](https://www.php.net/manual/en/function.odbc-connect.php).
- Version minima de php 7.3
- Instalar [composer](https://getcomposer.org/) y correr en una consola sobre la raiz del proyecto `composer install`
- Para simular un usuario autorizada a usar la app (como sería en produccion) y tener su informacion para usarla en el formulario, se debe obtener una SESSIONKEY de un usuario inscripto en [WebLogin](https://weblogin.muninqn.gov.ar/).
    - Obtener SESSIONKEY desde [WebLogin](https://weblogin.muninqn.gov.ar/), abriendo la consola de desarrollador en cualquier navegador y en la pestaña 'Red', una vez entres a caulquier app de weblogin, uno de los primeros url's cargados en la pestaña  sera un GET con los parametros SESSIONKEY y APP ( lo encontras en la seccion 'Encabezados' dentro de 'Red' ) ejemplo: 
    GET  https://weblogin.muninqn.gov.ar/apps/app-que-seleccionaste/public/index.php?SESSIONKEY=<tu session key>&APP=<app_id>

- Dirigirte a `direccion-de-tu-proyecto/public/index.php?SESSIONKEY=<tu sessionkey>`
- La opcion anterior la podes usar local, sin necesidad de conectarte a las bases de datos de la muni, ya que la consulta del SESSIONKEY se realiza por un WebService directo a las tablas en produccion. En caso de no necesitar simular una persona con la info tal cual es provista en produccion, y querer realizar pruebas en Replica, podes modificar el proyecto en Replica para encontrar al usuario, buscando el SESSIONKEY que te entrega el WebLogin de Replica, en infoprueba.dbo.wlusuarios columna 'controlkey'. 


##### Subiendo a produccion / replica - Configutación del proyecto
- Hay que configurar correctament el archivo `.env` ubicado en el `root` del proyecto:
    - `PROD=true`
        - Permite eliminiar la muestra de los errores, ademas nos permite facilitar diferentes configuraciones.
    - `MIGRATE=false`
        - 'llave' para permitir poder crear las tablas y las relaciones.
    - `DB_HOST=`
        - IP/HOST donde se encuentra la base de datos.
    - `DB_USER=` 
        - Usuario de la base de datos.
    - `DB_PASS=`
        - Contraseña de la base de datos.
    - `DB_NAME=`
        - Nombre de la base de datos.
    - `DB_PORT=`
        - Puerto de la base de datos, este parametro no se esta utilzando.
    - `DB_CHARSET=` 
        - Charset de la base de datos.

- En `app/config/config.php` se encuentra la configuración general del proyecto, ahi es donde se levanta la información del `.env`. Se encuentra tambien la configuración de las tablas, como estan definidas.
- En `app/config/path.php` se encuentra la configuración de las rutas del proyecto.
