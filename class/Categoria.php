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

        public function getValor()
        {
            return $this->valor;
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

        public function buscarCategoria($_id)
        {
            include("db/conn.php");

            $sql = "SELECT * FROM categoria WHERE idCategoria = $_id";
            $data = $conn->query($sql)->fetchAll();

            foreach ($data as $item) {
                $this->nome = $item["nome"];
                $this->valor = $item["valor"];
            }

            return true;
        }

    }

?>