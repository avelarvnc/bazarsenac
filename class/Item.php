<?php

    class Item
    {
        private $quantidade;
        private $dataEntrega;
        private $categoria;
        private $usuario;

        public function __construct(){}

        public function create($_quantidade, $_categoria, $_usuario)
        {
            $this->quantidade = $_quantidade;
            $this->categoria = $_categoria;
            $this->usuario = $_usuario;
        }

        public function inserirItem()
        {
            include("db/conn.php");
            $sql = "CALL piItem(:quantidade, :usuario, :categoria)";

            $data = [
                'quantidade' => $this->quantidade,
                'usuario' => $this->usuario,
                'categoria' => $this->categoria
                
            ];
          
            $statement = $conn->prepare($sql);
            $statement->execute($data);
            return true;
        }

        public function listarItens()
        {
            try
            {
                
                include("./db/conn.php");
                $sql = "SELECT * FROM vwItens ORDER BY dtEntrega DESC LIMIT 50";
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