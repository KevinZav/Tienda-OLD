DROP DATABASE negocio;
CREATE DATABASE negocio;

use negocio;

CREATE TABLE lineas(
    id VARCHAR(100) NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    CONSTRAINT pk_linea PRIMARY KEY (id)
)ENGINE=INNODB;


CREATE TABLE productos(
    id VARCHAR(100) NOT NULL,
    descripcion VARCHAR(100) NOT NULL,
    precio FLOAT(100,2) NOT NULL,
    costo FLOAT(100,2) NOT NULL,
    stock INTEGER,
    linea_id VARCHAR(100) DEFAULT '',
    CONSTRAINT pk_producto PRIMARY KEY (id),
    CONSTRAINT fk_linea_producto FOREIGN KEY (linea_id) REFERENCES lineas(id) ON DELETE SET NULL
)ENGINE=INNODB;

CREATE table roles(
    id INTEGER NOT NULL AUTO_INCREMENT,
    role varchar(100) NOT NULL,
    CONSTRAINT pk_role PRIMARY KEY (id)
)ENGINE=INNODB;

CREATE TABLE usuarios(
    id INTEGER NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    usuarioID VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL,
    role_id INTEGER NOT NULL,
    CONSTRAINT pk_usuario PRIMARY KEY (id),
    CONSTRAINT fk_role_usuario FOREIGN KEY (role_id) REFERENCES roles(id)
)ENGINE=INNODB;

CREATE TABLE ventas(
    id INTEGER NOT NULL AUTO_INCREMENT,
    fecha TIMESTAMP,
    total FLOAT(100,2),
    usuario_id INTEGER NOT NULL,
    CONSTRAINT pk_venta PRIMARY KEY (id),
    CONSTRAINT fk_usuario_venta FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
)ENGINE=INNODB;

CREATE TABLE detalles_venta(
    id INTEGER NOT NULL AUTO_INCREMENT,
    cantidad INTEGER NOT NULL,
    precio FLOAT(100,2),
    producto_id VARCHAR(100) NOT NULL,
    venta_id INTEGER NOT NULL,
    CONSTRAINT pk_detalle_venta PRIMARY KEY (id),
    CONSTRAINT fk_producto_venta FOREIGN KEY (producto_id) REFERENCES productos(id),
    CONSTRAINT fk_venta_detalle_venta FOREIGN KEY (venta_id) REFERENCES ventas(id)
)ENGINE=INNODB;

INSERT INTO roles VALUES(NULL,'Administrador'),(NULL, 'Cajero');

INSERT INTO usuarios (id,nombre,apellidos, usuarioID, password, role_id) VALUES(NULL, 'Sonia', 'Vera Franco', 'SoniaVer','holamundo',1),
                           (NULL, 'Omar', 'Lopez Aguilar', 'OmarLop', 'holamundo', 1),
                           (NULL, 'Carla', 'Lastpat Apmat', 'CarlaLas', 'cajera', 2);


CREATE VIEW viewDetalleVenta AS 
SELECT ventas.id as 'venta_id', detalles_venta.cantidad as 'cantidad', detalles_venta.precio as 'precio',
productos.id as 'producto_id', productos.descripcion as 'descripcion_producto' FROM detalles_venta
JOIN productos ON productos.id=detalles_venta.producto_id
JOIN ventas ON ventas.id=detalles_venta.venta_id;