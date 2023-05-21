Write this line in the comand line MYSQL

CREATE USER 'negocio'@'%' IDENTIFIED WITH mysql_native_password BY 'holamundo42';
GRANT ALL PRIVILEGES ON *.* TO 'negocio'@'%' WITH GRANT OPTION;
FLUSH PRIVILEGES;