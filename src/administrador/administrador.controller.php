<?php

    require_once './service/productos.service.php';
    require_once './service/lineas.service.php';

    class AdministradorController {
        public $response = '';
        public $routeConfig=[];
        public $dataJSON = [];

        public function index() {

            $this->response = Router::getRouteView('administrador','index');
            $this->routeConfig['css'] = ['bootstrap.min.css'];
            

        }

        public function inventario() {
            $this->response = Router::getRouteView('administrador','inventario');
            $this->routeConfig['css'] = ['bootstrap.min.css'];
        }

        public function lineas() {
            $this->response = Router::getRouteView('administrador','lineas');
            $this->routeConfig['css'] = ['bootstrap.min.css'];
        }

        public function consultaVentas() {
        
            $this->response = Router::getRouteView('administrador', 'consultaVentas');
            $this->routeConfig['css'] = [ 'bootstrap.min.css' ];
    
        }

        public function respaldo() {
            $this->response = Router::getRouteView('administrador','respaldo');
            $this->routeConfig['css'] = ['bootstrap.min.css'];
        }

        public function getProductos() {
            $productosS = new ProductosService();

            $this->dataJSON = [
                "success" => true,
                "productos" =>$productosS->getProductos()
            ];

            $this->response = Router::getRouteJSON('administrador','productos');
        }

        public function getLineas() {
            $lineasS = new LineasService();

            $this->dataJSON = [
                "success" => true,
                "lineas" => $lineasS->getLineas()
            ];

            $this->response = Router::getRouteJSON('administrador','lineas');

        }

        public function agregarLinea() {

            $id = @$_POST['id'];
            $descripcion = @$_POST['descripcion'];

            if(!isset($descripcion) or !isset($id)) {
                $this->dataJSON = [
                    "success" => false,
                    "message" => "Error al recibir datos"
                ];
            } else {
                $lineasS = new LineasService();
    
                $insertado = $lineasS->agregarLinea($id, $descripcion);

                $message = ($insertado) ? 'Linea agregada con éxito' : 'Algo ha fallado';
                $this-> dataJSON = [
                    "success" =>$insertado,
                    "message" =>$message
                ];
            }
            $this->response = Router::getRouteJSON('administrador','nuevaLinea');

        }

        public function modificarLinea() {
            $id = @$_POST['id'];
            $nombre = @$_POST['nombre'];
            if(!isset($nombre) or !isset($id)) {
                $this->dataJSON = [
                    "success" => false,
                    "message" => "Error al recibir datos"
                ];
            } else {
                $lineasS = new LineasService();

                $modificado = $lineasS->modificarLinea($id,$nombre);

                $message = ($modificado) ? 'Linea modificada con éxito' : 'Algo ha fallado';
                $this-> dataJSON = [
                    "success" =>$modificado,
                    "message" =>$message
                ];
            }
            $this->response = Router::getRouteJSON('administrador','modificarLinea');

        }

        public function eliminarLinea() {

            $id = @$_POST['id'];

            if(!isset($id)) {
                $this->dataJSON = [
                    "success" => false,
                    "message" => "Error al recibir datos"
                ];
            } else {
                $lineasS = new LineasService();
    
                $insertado = $lineasS->eliminarLinea($id);

                $message = ($insertado) ? 'Linea eliminada con éxito' : 'Algo ha fallado';
                $this-> dataJSON = [
                    "success" =>$insertado,
                    "message" =>$message
                ];
            }
            $this->response = Router::getRouteJSON('administrador','eliminarLinea');

        }

        public function eliminarProducto() {
            $id = @$_POST['id'];

            if(!isset($id)) {
                $this->dataJSON = [
                    "success" => false,
                    "message" => "Error al recibir datos"
                ];
            } else {
                $productosS = new ProductosService();
    
                $insertado = $productosS->eliminarProducto($id);

                $message = ($insertado) ? 'Producto eliminado con éxito' : 'Algo ha fallado';
                $this-> dataJSON = [
                    "success" =>$insertado,
                    "message" =>$message
                ];
            }
            $this->response = Router::getRouteJSON('administrador','eliminarProducto');

        }

        public function agregarProducto() {

            $id = @$_POST['id'];
            $descripcion = @$_POST['descripcion'];
            $precio = @$_POST['precio'];
            $costo = @$_POST['costo'];
            $stock = @$_POST['stock'];
            $linea_id = @$_POST['linea_id'];

            $linea_id = empty($linea_id) ? NULL : $linea_id;

            if (!isset($id) or !isset($descripcion) or 
            !isset($precio) or !isset($costo) or !isset($stock)) {
                $this->dataJSON = [
                    "success" => false,
                    "message" => "Error al recibir datos"
                ];
            } else {
                $productosS = new ProductosService();

                $insertado = $productosS->agregarProducto($id,$descripcion,$precio,$costo,$stock,$linea_id);

                $message = ($insertado) ? 'Producto agregado con éxito' : 'Algo ha fallado';
                $this-> dataJSON = [
                    "success" =>$insertado,
                    "message" =>$message
                ];

            }

            $this->response = Router::getRouteJSON('administrador','nuevoProducto');

        }

        public function modificarProducto() {
            $id = @$_POST['id'];
            $descripcion = @$_POST['descripcion'];
            $precio = @$_POST['precio'];
            $costo = @$_POST['costo'];
            $stock = @$_POST['stock'];
            $linea_id = @$_POST['linea_id'];

            $linea_id = empty($linea_id) ? NULL : $linea_id;

            if (!isset($id) or !isset($descripcion) or 
            !isset($precio) or !isset($costo) or !isset($stock)) {
                $this->dataJSON = [
                    "success" => false,
                    "message" => "Error al recibir datos"
                ];
            } else {
                $productosS = new ProductosService();

                $modificado = $productosS->modificarProducto($id,$descripcion,$precio,$costo,$stock,$linea_id);

                $message = ($modificado) ? 'Producto modificado con éxito' : 'Algo ha fallado';
                $this-> dataJSON = [
                    "success" =>$modificado,
                    "message" =>$message
                ];

            }

            $this->response = Router::getRouteJSON('administrador','modificarProducto');
        }

        public function logout() {
            unset($_SESSION['user']);
            header("Location:".Router::getRouteURL(''));
        }

    }


?>