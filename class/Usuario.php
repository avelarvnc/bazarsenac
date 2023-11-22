<?php

    class Usuario
    {

        private $nome;
        private $email;
        private $perfil;

        public function __construct()
        {}

        public function create($_nome, $_email, $_perfil)
        {
            $this->nome = $_nome;
            $this->email = $_email;
            $this->perfil = $_perfil;
        }

        public function inserirUsuario()
        {
            include_once("db/conn.php");
            $sql = "INSERT INTO usuario (nome, email, perfil, senha) VALUES (:nome, :email, :perfil, :senha )";

            $data = [
                'nome' => $this->nome,
                'email' => $this->email,
                'perfil' => $this->perfil,
                'senha' => md5("S3n@c2023")
            ];
          
            $statement = $conn->prepare($sql);
            $statement->execute($data);
            return true;
        }

        
    }

?>