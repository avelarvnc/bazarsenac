<?php

    class Categoria
    {
        private $nome;
        private $valor;

        public function __construct(){}

        public function create($_nome, $_id)
        {
            $this->nome = $_nome;
            $this->valor = $_valor;
        }

        public function listarCategoria()
        {
            try
            {
                
                include("./db/conn.php");
                $sql = "SELECT * FROM categoria";
                $data = $conn->query($sql)->fetchAll();
              
                return $data;
            }
            catch (Exception $e)
            {
                return 0;
            }
        }

    }

?>