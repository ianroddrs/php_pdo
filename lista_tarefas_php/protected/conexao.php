<?php

    class Conexao{
        private $host = 'localhost';
        private $dbname = 'php_pdo';
        private $user = 'root';
        private $pass = '';

        public function conectar(){
           try {

                $conexao = new PDO(
                   "mysql:host",
                   "$this->user",
                   "$this->pass" 
                );

           } catch (PDOException $e){{
                echo '<p>' . $e->getMessage() . '</p>';
           }}
        }
    }

?>
