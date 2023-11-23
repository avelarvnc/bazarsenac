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
            // $sql = "CALL piItem(:quantidade, :usuario, :categoria)";
            $sql = "
                INSERT INTO item (quantidade, idUsuario, idCategoria)
                VALUES (:quantidade, :usuario, :categoria);
                
                SELECT valor INTO @valor FROM categoria WHERE idCategoria = :categoria;
                
                UPDATE usuario 
                    SET saldo = saldo + (@valor * :quantidade)
                WHERE idUsuario = :usuario;
            ";

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
                // $sql = "SELECT * FROM vwItens ORDER BY dtEntrega DESC LIMIT 50";
                $sql = "
                        SELECT 
                        c.nome AS nomeItem,
                        i.quantidade,
                        u.nome AS nomeUsuario,
                        i.dtEntrega
                    FROM item i 
                    JOIN usuario u ON u.idUsuario = i.idUsuario
                    JOIN categoria c ON c.idCategoria = i.idCategoria
                    ORDER BY dtEntrega DESC
                    LIMIT 50         
                ";
                $data = $conn->query($sql)->fetchAll();
              
                return $data;
            }
            catch (Exception $e)
            {
                return 0;
            }
        }

        public function venderItem($_vendedor)
        {
            include("db/conn.php");
            // $sql = "CALL piVenda(:vendedor, :comprador, :quantidade, :categoria)";
            $sql = "
                INSERT INTO venda (idVendedor, idComprador, quantidade, idCategoria)
                VALUES (:vendedor, :comprador, :quantidade, :categoria);
                
                SELECT valor INTO @valor FROM categoria WHERE idCategoria = :categoria;
                
                UPDATE usuario
                    SET saldo = saldo - (:quantidade * @valor)
                WHERE idUsuario = :comprador;
            ";

            $data = [
                'vendedor' => $_vendedor,
                'comprador' => $this->usuario,
                'quantidade' => $this->quantidade,
                'categoria' => $this->categoria
                
            ];
          
            $statement = $conn->prepare($sql);
            $statement->execute($data);
            return true;          
        }

        public function listarVendas()
        {
            try
            {
                
                include("./db/conn.php");
                // $sql = "SELECT * FROM vwVendas ORDER BY dtVenda DESC LIMIT 50";
                $sql = "
                    SELECT 
                        v.dtVenda,
                        v.quantidade,
                        c.nome AS categoria,
                        vnd.nome AS vendedor,
                        cmp.nome AS compradora
                    FROM venda v
                    JOIN categoria c ON c.idCategoria = v.idCategoria
                    JOIN usuario vnd ON vnd.idUsuario = v.idVendedor
                    JOIN usuario cmp ON cmp.idUsuario = v.idComprador
                    ORDER BY dtVenda DESC
                    LIMIT 50
                ";
                $data = $conn->query($sql)->fetchAll();
              
                return $data;
            }
            catch (Exception $e)
            {
                return 0;
            }
        }

        public function rankingDoacao()
        {
            try
            {
                
                include("./db/conn.php");
                // $sql = "SELECT nomeUsuario, SUM(quantidade) AS quantidade FROM vwitens GROUP BY nomeUsuario ORDER BY 2 DESC LIMIT 3";
                $sql = "
                SELECT 
                        u.nome AS nomeUsuario, 
                        SUM(i.quantidade) AS quantidade
                FROM item i 
                JOIN usuario u ON u.idUsuario = i.idUsuario
                JOIN categoria c ON c.idCategoria = i.idCategoria
                GROUP BY u.nome ORDER BY 2 DESC LIMIT 3
                ";
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