<?php

    class Connection{
        private $host = 'localhost';
        public $user = 'negocio';
        public $password = 'holamundo42';
        private $database = 'negocio';
        private $port = 3308;
        protected $connection;
        public function __construct(){}
        public function getConnection(){

            $connect = @$this -> connection = new mysqli($this->host,$this->user,
                                $this->password,$this->database,$this->port);
            if ($this->connection->connect_error) {
                var_dump($this->connection->connect_error);
                return false;
            } else {
                $this -> connection -> set_charset('utf-8');
                return true;
            }
        }
        public function closeConnection(){
            $this -> connection -> close();
        }
    }

?>      
