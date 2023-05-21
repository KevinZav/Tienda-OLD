<?php 

    class VentaService extends Connection{


        public function agregarNota( $total ) {

            $this->getConnection();

            $userId = $_SESSION['user']['id'];

            $query = "INSERT INTO ventas VALUES(NULL,NOW(),${total},${userId});";
            $insertado = $this->connection->query($query);


            $result = ["insertado" => $insertado, "id" => $this->connection->insert_id];

            $this->closeConnection();

            return $result;
        }

        public function agregarDetalleVenta($cantidad, $precio, $producto_id, $venta_id ) {

            $this->getConnection();

            $result = [];

            $query ="UPDATE productos SET productos.stock=productos.stock-${cantidad} WHERE id='${producto_id}';";

            $query2 = "INSERT INTO detalles_venta VALUES(NULL, ${cantidad}, ${precio},'${producto_id}', ${venta_id});";

            $actualizado = $this->connection->query($query);
            $result['actualizado'] = $actualizado;

            $insertado = $this->connection->query($query2);
            $result['insertado'] = $insertado;
            
            $this->closeConnection();

            return $result;

        }

        public function getVenta($id) {
            $this->getConnection();

            $query = "SELECT * FROM viewDetalleVenta WHERE venta_id=${id};";

            $detallesVenta = $this->connection->query($query);
            $result = [];

            while( $row = mysqli_fetch_array($detallesVenta,MYSQLI_ASSOC) ) {
                $result[] = $row;
            }

            $this->closeConnection();

            return $result;
        }

        public function getDataVenta( $id ) {
            $this->getConnection();


            $query = "SELECT ventas.*, usuarios.nombre, usuarios.apellidos FROM ventas JOIN ".
            "usuarios ON usuarios.id = ventas.usuario_id WHERE ventas.id=${id};";

            $venta = $this->connection->query($query);
            $result = mysqli_fetch_array($venta, MYSQLI_ASSOC);

            $this->closeConnection();


            return $result;



        }

        public function getVentasDate($date) {

            $this->getConnection();

            $query = "SELECT ventas.*, usuarios.usuarioID FROM ventas ".
            "JOIN usuarios ON usuarios.id = ventas.usuario_id ".
            "WHERE DATE(ventas.fecha)='${date}';";


            $ventas = $this->connection->query($query);
            $result = [];

            while( $row = mysqli_fetch_array($ventas,MYSQLI_ASSOC) ) {
                $result[] = $row;
            }

            $this->closeConnection();

            return $result;

        }


    }

?>