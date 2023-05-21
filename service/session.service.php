<?php 

    class Session extends Connection{
        public function __construct() {
        }
        public function login($user, $password) {
            // Open Connection to database

            $this->getConnection();
            $query = "SELECT * FROM usuarios WHERE usuarioID='${user}' AND password='${password}';";
            $userSession = $this->connection->query($query);
            $userSession = mysqli_fetch_array($userSession,MYSQLI_ASSOC);
            if($userSession == null) {
                return ['success'=>false, 'message' => 'Usuario y/o contraseña invalidos'];
            } else {
                $_SESSION['user'] = $userSession;

                return ['success'=>true, 'usuario' => $userSession];
            }
        }
        public static function is_login() {
            if (isset($_SESSION['user']) and $_SESSION['user']['login']) {
                return true;
            } else {
                return false;
            }
        }
        public static function create_session($key,$value) {
            $_SESSION[$key] = $value;
        }

        public static function deleteSession($key){
            unset($_SESSION[$key]);
        }
    }

?>