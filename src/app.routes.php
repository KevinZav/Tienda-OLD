<?php
    define('routes',[
        [
            'userType' => null,
            'defaultRoute' => 'login/acceder',
            'login/acceder' => [
                'header' => 'html',
                'title' => 'Login',
            ],
            'login/login' => [
                'header' => 'json',
                'title' => 'Login',
            ]
        ],
        [
            'userType' => 1,
            'defaultRoute' => 'administrador/index',
            'administrador/index' => [
                'header' => 'html',
                'title' => 'Administrador',
            ],
            'administrador/inventario' => [
                'header' => 'html',
                'title' => 'Inventario'
            ],
            'administrador/lineas' => [
                'header' => 'html',
                'title' => 'Lineas'
            ],
            'administrador/respaldo' => [
                'header' => 'html',
                'title' => 'Respaldo'
            ],
            'administrador/consultaVentas' => [
                'header' => 'html',
                'title' => 'Consultas',
            ],
            'administrador/logout' => [
                'header' => 'html',
                'title' => 'Logout'
            ],
            'administrador/getProductos' => [
                'header' => 'json',
                'title' => 'Productos'
            ],
            'administrador/agregarProducto' => [
                'header' => 'json',
                'title' => 'Productos'
            ],
            'administrador/modificarProducto' => [
                'header' => 'json',
                'title' => 'Modificar Producto'
            ],
            'administrador/eliminarProducto' => [
                'header' => 'json',
                'title' => 'Eliminar Producto'
            ],
            'administrador/getLineas' => [
                'header' => 'json',
                'title' => 'Lineas'
            ],
            'administrador/agregarLinea' => [
                'header' => 'json',
                'title' => 'Agregar Linea'
            ],
            'administrador/eliminarLinea' => [
                'header' => 'json',
                'title' => 'Eliminar Linea'
            ],
            'administrador/modificarLinea' => [
                'header' => 'json',
                'title' => 'Modificar Linea'
            ],
            'cajero/getVentas' => [
                'header' => 'json',
                'title' => 'Ventas'
            ],
            'cajero/imprimirVenta' => [
                'header' => 'html',
                'title' => 'Imprimir'
            ]
        ],
        [
            'userType' => 2,
            'defaultRoute' => 'cajero/index',
            'cajero/index' => [
                'header' => 'html',
                'title' => 'Cajero',
            ],
            'cajero/ventas' => [
                'header' => 'html',
                'title' => 'Ventas',
            ],
            'cajero/consultaVentas' => [
                'header' => 'html',
                'title' => 'Consultas',
            ],
            'administrador/getProductos' => [
                'header' => 'json',
                'title' => 'Productos'
            ],
            'cajero/pagarNota' => [
                'header' => 'json',
                'title' => 'Pagar'
            ],
            'cajero/imprimirVenta' => [
                'header' => 'html',
                'title' => 'Imprimir'
            ], 
            'cajero/getVentas' => [
                'header' => 'json',
                'title' => 'Ventas'
            ],
        ]
    ]);
    class Router {

        private static $routeMaster = 'http://localhost/tienda/';

        public static function getRoute( $userTipe, $routeAccess ) {

            $result = [
                'success' => false,
                'redirect' => 'login/acceder'
            ];
            foreach ( routes as $route  ) {
                $tipe = $route['userType'];
                if ($userTipe == $tipe) {
                    if (isset($route[$routeAccess])) {
                        $result = $route[$routeAccess];
                        $result['success'] = true;
                    } else {
                        $result['redirect'] = $route['defaultRoute'];
                        $result['success'] = false;
                    }
                }
            }
            return $result;
        }
        public static function getRouteURL($route) {
            return Router::$routeMaster.$route;
        }
        
        public static function getController( $controllerName ) {
            return "./src/${controllerName}/${controllerName}.controller.php";
        }

        public static function getRouteView( $controller, $view ) {
            return "./src/${controller}/views/${view}.view.php";
        }
        public static function getRouteJSON( $controller, $json ) {
            return "./src/${controller}/json/${json}.json.php";
        }
        public static function getScriptRoute($script) {
            return Router::$routeMaster."assets/js/${script}";
        }
    }

?>