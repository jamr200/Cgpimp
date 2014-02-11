Cgpimp
======

Herramienta Web Genérica de Control y Gestión de un Parque de Impresoras es un proyecto basado en CodeIgniter, 
que permite llevar el control de elementos que requieren de una gestión. Principalmente esta diseñado para gestionar 
un parque de impresoras, aunque como el título indica es una aplicación genérica.


Herramientas
============

- CodeIgniter (framework PHP)
- Datamapper (ORM)
- Smarty
- Bootstrap (framework para el diseño)
- Jquery (uploadify, multi-upload, jquery.validate)
- TCPDF (generar listados pdf)
- Otros plugins (bootstrap-duallistbox, select2)


Instalación
===========

Esta aplicación, vendrá comprimida en formato .zip, por lo que es necesario descomprimir el archivo y guardar 
el contenido en la carpeta destinada en el servidor. Una vez se ha colocado la aplicación en el destino final 
es necesario crear la base de datos en el servidor. Para ello entramos en la consola de MySQL y la creamos 
a través del comando siguiente:

CREATE DATABASE ‘NombreBaseDeDatos’

Por defecto se deberá de crear con el nombre impresoras. Una vez creada la base de datos hay que cargar el script 
"impresoras.sql" para que se cree la estructura básica de la base de datos y así poder empezar a usar la aplicación. 
Este script se encuentra en la carpeta backup, dentro del archivo comprimido que se adjunta. 
Para cargar el script se puede crear a través de la consola de MySQL o bien haciendo uso de PHPMyAdmin. 
Para hacerlo a través de MySQL basta con escribir la siguiente línea:

“mysql –u USUARIO –p impresoras < /Ruta/Del/Archivo/impresoras.sql”

Los pasos para crear la base de datos y cargar el script a través de PHPMyAdmin son los siguientes:

- Acceder al menú principal de base de datos y mediante el formulario crear una con el nombre de impresoras.

- En el menú lateral acceder a la fila impresoras.

- Acceder al submenú Importar. En este tenemos un formulario donde seleccionamos el fichero impresoras.sql. 
  En el conjunto de caracteres del archivo utilizamos utf-8.


Una vez importado el script es necesario modificar el fichero database.php dentro de la aplicación 
(application/config/database.php), concretamente las siguientes líneas:

 $db['default']['hostname'] = 'hostname del servidor';
 $db['default']['username'] = 'usuario del servidor';
 $db['default']['password'] = 'contraseña del servidor';


Por último, es necesario modificar el fichero config.php dentro de la aplicación (application/config/config.php), 
en concreto la siguiente línea:

 $config['base_url'] = 'dirección base de la aplicación';


Existe un usuario por defecto:

user: admin@admin.com

pass: 123456

El sistema cuando se introduzca por primera vez los datos de entrada permitirá cambiar la contraseña para ese usuario.
