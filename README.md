Write this line in the comand line MYSQL

CREATE USER 'negocio'@'%' IDENTIFIED WITH mysql_native_password BY 'holamundo42';
GRANT ALL PRIVILEGES ON *.* TO 'negocio'@'%' WITH GRANT OPTION;
FLUSH PRIVILEGES;

Se recomienda crear el usuario en la base de datos manualmente y asignarle todos los privilegios.
En service/database/conexion.service.php, linea 8 colocar el puerto donde este corriendo MySql.

-Comando para saber el charset de la db
SELECT @@character_set_database;

-Comando para cambiar el charset de la db
ALTER DATABASE negocio CHARACTER SET utf8 COLLATE utf8_general_ci;

Video de apoyo:
https://youtu.be/M7PlsDDWl_w