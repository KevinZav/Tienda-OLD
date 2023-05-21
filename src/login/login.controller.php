<?php
    require_once './service/session.service.php';

    class LoginController {

        public $response='';
        public $routeConfig=[];
        public $dataJSON = [];

        public function acceder() {
            $this->response = Router::getRouteView('login','login');
            $this->routeConfig['css'] = ['login.css'];
        }

        public function login() {
            $usuarioID = @$_POST['usuarioID'];
            $password = @$_POST['password'];

            $session = new Session();
            
            $this->dataJSON = $session->login($usuarioID, $password);
            unset($this->dataJSON['usuario']['password']);


            $this->response = Router::getRouteJSON('login', 'login');
        }

        public function logout() {
            Session::deleteSession('user');
            header('Location: '.Router::getRouteURL('login/acceder'));
        }

    }

?>