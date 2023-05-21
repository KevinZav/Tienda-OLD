<?php 

    class ProductosService extends Connection{
        
        public function getProductos(){
            $this->getConnection();

            $query = "SELECT productos.*, lineas.nombre as nombre_linea FROM productos LEFT JOIN lineas ON lineas.id = productos.linea_id ORDER BY productos.id;";
            $productos = $this->connection->query($query);
            $result = [];

            while( $row = mysqli_fetch_array($productos,MYSQLI_ASSOC) ) {
                $result[] = $row;
            }
            $this->closeConnection();
            
            return $result;
        }

        public function agregarProducto( $id, $descripcion, $precio, $costo, $stock, $linea_id = NULL) {
            $this->getConnection();

            $linea_id = (empty($linea_id)) ? "NULL" : "'${linea_id}'";

            $query = "INSERT INTO productos VALUES('${id}', '${descripcion}',${precio},${costo},${stock},${linea_id});";
            $insertado = $this->connection->query($query);
            $this->closeConnection();

            return $insertado;
        }

        public function modificarProducto( $id, $descripcion, $precio, $costo, $stock, $linea_id = NULL) {
            $this->getConnection();

            $linea_id = (empty($linea_id)) ? "NULL" : "'${linea_id}'";

            $query = "UPDATE productos SET descripcion='${descripcion}', precio=${precio},
                      costo=${costo}, stock=${stock},linea_id=${linea_id} WHERE id='${id}';";
            $modificado = $this->connection->query($query);
            $this->closeConnection();

            return $modificado;
        }

        public function eliminarProducto( $id ) {
            $this->getConnection();

            $query = "DELETE FROM productos WHERE id = '${id}';";

            $eliminado = $this->connection->query($query);

            $this->closeConnection();

            return $eliminado;
        }


    }
?>