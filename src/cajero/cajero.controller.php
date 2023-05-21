<?php

require_once './service/venta.service.php';

class CajeroController {

    public $response = '';
    public $routeConfig=[];
    public $dataJSON = [];

    public function index() {

        $this->response = Router::getRouteView('cajero', 'index');
        $this->routeConfig['css'] = [ 'bootstrap.min.css' ];

    }

    public function ventas() {
        
        $this->response = Router::getRouteView('cajero', 'ventas');
        $this->routeConfig['css'] = [ 'bootstrap.min.css' ];

    }

    public function consultaVentas() {
        
        $this->response = Router::getRouteView('cajero', 'consultaVentas');
        $this->routeConfig['css'] = [ 'bootstrap.min.css' ];

    }

    public function imprimirVenta() {

        $venta_id = $_GET['venta'];

        $ventaS = new VentaService();
        
        $this->detallesVenta = $ventaS->getVenta($venta_id);
        $this->dataVenta = $ventaS->getDataVenta($venta_id);


        $this->response = Router::getRouteView('cajero', 'imprimirVenta');
        $this->routeConfig['css'] = [ 'imprimir.css' ];



    }

    public function pagarNota() {
        $ventas = json_decode($_POST['venta']);
        $totalVenta = $_POST['totalVenta'];
        $ventaS = new VentaService();

        $nuevaVenta = $ventaS->agregarNota($totalVenta);
        $venta_id = $nuevaVenta['id'];
        $consultas = [];
        $successAll = true;

        foreach( $ventas as $venta ) {
            $cantidad = $venta->cantidad;
            $precio = $venta->precio;
            $producto = $venta->id;

            $nuevoDetalleVenta = $ventaS->agregarDetalleVenta($cantidad,$precio,$producto,$venta_id);

            $consultas[] = $nuevoDetalleVenta;

            if($nuevoDetalleVenta['actualizado']!= true || $nuevoDetalleVenta['insertado'] !=true){
                $successAll = false;
            }

        }

        $this-> dataJSON = [
            "consultas"=>$consultas,
            "success" => $successAll,
            "venta_id" => $venta_id
        ];
        $this->response = Router::getRouteJSON('cajero','pagarNota');
    }

    public function getVentas() {

        $date = $_GET['date'];

        $ventaS = new VentaService();

        $ventas = $ventaS->getVentasDate($date);

        $this->dataJSON = [
            "success" => true,
            "ventas" => $ventas
        ];
        $this->response = Router::getRouteJSON('cajero','getVentas');
    }

    public function logout() {
        unset($_SESSION['user']);
        header("Location:".Router::getRouteURL(''));
    }


}



?>