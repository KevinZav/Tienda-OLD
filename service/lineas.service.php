<?php 

    class LineasService extends Connection{
        
        public function getLineas(){
            $this->getConnection();

            $query = "SELECT * FROM lineas ORDER BY id;";
            $lineas = $this->connection->query($query);
            $result = [];

            while( $row = mysqli_fetch_array($lineas,MYSQLI_ASSOC) ) {
                $result[] = $row;
            }
            $this->closeConnection();

            return $result;
        }

        public function agregarLinea($id, $descripcion) {

            $this->getConnection();
            $query = "INSERT INTO lineas VALUES('${id}', '${descripcion}');";

            $insertado = $this->connection->query($query);

            $this->closeConnection();

            return $insertado;
        }

        public function eliminarLinea( $id ) {

            $this->getConnection();
            $query = "DELETE FROM lineas WHERE id='${id}';";

            $eliminado = $this->connection->query($query);

            $this->closeConnection();
            return $eliminado;
        }

        public function modificarLinea( $id, $nombre ) {

            $this->getConnection();
            $query = "UPDATE lineas SET nombre = '${nombre}' WHERE id='${id}';";

            $modificado = $this->connection->query($query);

            $this->closeConnection();
            return $modificado;
        }


    }
?>