# Proyecto Final DAW
## App Symfony 4.1 // Proyecto AUROS

Proyecto final del Grado Superior de Desarrollo de Aplicaciones Web.

## Instalación

Seleccionamos un direcctorio y clonamos el proyecto con:
```sh
$ git clone git://github.com/Zaruth/proyecto_auros.git
```

Una vez instalado y dentro de dicho directorio ejecutamos:
```sh
$ composer Install
```

Una vez instaladas las dependencias debemos editar el fichero .env para establecer la conexión con nuestra base de datos. Si no se ha creado base de datos para el proyecto, debe crearse primero.

Migramos la estructura de entidades a la base de datos con:
```sh
$ php bin/console doctrine:migrations:migrate
```

Ya está lista la app para usarse, ahora falta crear un usuario y asignarle en la base de datos el rol "ROLE_ADMIN" para tener todos los privilegios.

Para arrancar la app solo debemos ejecutar desde el directorio public el siguiente comando:
```sh
php -S 127.0.0.1:8080
```
El puerto por defecto es 8080, pero podéis cambiarlo al que necesitéis.
