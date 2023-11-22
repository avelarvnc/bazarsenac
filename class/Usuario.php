<?php

    class Usuario
    {

        private $nome;
        private $email;
        private $perfil;
        private $senha;

        public function __construct()
        {}

        public function create($_nome, $_email, $_perfil)
        {
            $this->nome = $_nome;
            $this->email = $_email;
            $this->perfil = $_perfil;
        }

        public function setNome($_nome)
        {
            $this->nome = $_nome;
        }

        public function setEmail($_email)
        {
            $this->email = $_email;
        }

        public function setPerfil($_perfil)
        {
            $this->perfil = $_perfil;
        }

        public function setSenha($_senha)
        {
            $this->senha = md5($_senha);
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

        public function acessar()
        {
            try
            {
                
                include("./db/conn.php");
                $sql = "SELECT * FROM usuario WHERE email = '$this->email' AND senha = '$this->senha'";
                $stmt = $conn->prepare($sql);

                $stmt->execute(); 
                
                if ($user = $stmt->fetch())
                {
                    return $user;
                }
                else
                {
                    return 0;
                }
              
            }
            catch (Exception $e)
            {
                return -1;
            }   
        }
        
        public function mudarSenha($_id, $_senha)
        {
            include_once("db/conn.php");
            $sql = "UPDATE usuario SET senha = :senha, situacao = :situacao WHERE idUsuario = :id";

            $data = [
                'senha' => md5($_senha),
                'situacao' => "1",
                'id' => $_id
            ];
          
            $statement = $conn->prepare($sql);
            $statement->execute($data);
            return true;
        }
    }

?>