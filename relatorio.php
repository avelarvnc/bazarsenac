<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bazar Sustentável</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Ubuntu&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/main.css">
    <script src="assets/main.js"></script>
</head>
<body>
    <?php
        include("components/header-externo.html");
    ?>

    <main>
        <h1>Bazar Sustentável SAN/BER 2023 <br> <br>Relatório geral</h1>

        <?php
                        include_once("class/Item.php");
                        $i = new Item();
                        
                        if ($i->totalDoacao() == true)
                        {
                            echo "<h2>Total de doações: " . $i->getQuantidade() . " </h2>";
                        }
                        else
                        {
                            echo "<p>Ainda não temos doações registradas.</p>";
                        }
        
                    ?>

        
        <section style="display: flex; flex-direction: row; justify-content: space-around; align-items: flex-start;">
        <div>
            <?php

                include("db/conn.php");

                try
                {
                    
                    include("./db/conn.php");
                    // $sql = "SELECT * FROM vwItens ORDER BY dtEntrega DESC LIMIT 50";
                    $sql = "
                        SELECT 
                            u.nome,
                            SUM(i.quantidade) as total
                        FROM usuario U 
                        JOIN item I ON I.idUsuario = U.idUsuario
                        GROUP BY u.nome
                        ORDER BY 2 DESC;      
                    ";
                    $data = $conn->query($sql)->fetchAll();
                
                    if ($data != 0){
                        echo "<h2>Ranking de doadores</h2><br>
                                    <ol>";
                        foreach($data as $i)
                        {
                            echo "<li> " . $i["nome"] . " - Total de doações: " . $i["total"] . " </li> ";
                        }
                        echo "</ol>";
                    }
                    else
                    {
                        echo "<p>Ainda não existem dados registrados.</p>";
                    }
                }
                catch (Exception $e)
                {
                    echo "<p>Ocorreu um erro inesperado.</p>";
                }
            ?>
        </div>

        <div>
            <?php

            include("db/conn.php");

            try
            {
                $sql = "
                SELECT 
                    c.nome as categoria,
                    SUM(i.quantidade) as total
                FROM item I 
                JOIN categoria C ON C.idCategoria = i.idCategoria
                GROUP BY 1
                ORDER BY 2 DESC; 
                ";
                $data = $conn->query($sql)->fetchAll();

                if ($data != 0){
                    echo "<h2>Doações por categoria</h2>
                                <table>
                                    <tr>
                                        <th>Categoria</th>
                                        <th>Total</th>
                                    </tr>";
                    foreach($data as $i)
                    {
                        echo "
                            <tr>
                                <td>" . $i["categoria"] . "</td>
                                <td>" . $i["total"] . "</td>
                            </tr>
                        ";
                    }
                    echo "</table>";
                }
                else
                {
                    echo "<p>Ainda não existem dados registrados.</p>";
                }
            }
            catch (Exception $e)
            {
                echo "<p>Ocorreu um erro inesperado.</p>";
            }
            ?>
        </div>
        
        <div>
            <?php

            include("db/conn.php");

            try
            {
                $sql = "
                    SELECT 
                        u.nome,
                        c.nome AS categoria,
                        SUM(i.quantidade) as total
                    FROM usuario U 
                    JOIN item I ON I.idUsuario = U.idUsuario
                    JOIN categoria C ON C.idCategoria = i.idCategoria
                    GROUP BY 1,2
                    ORDER BY 3 DESC;    
                ";
                $data = $conn->query($sql)->fetchAll();
            
                if ($data != 0){
                    echo "<h2>Categoria por doador</h2>
                                <table>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Categoria</th>
                                        <th>Total</th>
                                    </tr>";
                    foreach($data as $i)
                    {
                        echo "
                            <tr>
                                <td>" . $i["nome"] . "</td>
                                <td>" . $i["categoria"] . "</td>
                                <td>" . $i["total"] . "</td>
                            </tr>
                        ";
                    }
                    echo "</table>";
                }
                else
                {
                    echo "<p>Ainda não existem dados registrados.</p>";
                }
            }
            catch (Exception $e)
            {
                echo "<p>Ocorreu um erro inesperado.</p>";
            }
            ?>
        </div>
    </section>
    </main>
</body>
</html>