<?php
    
    
    if (isset($_SESSION['id'])) {
        $id_user = $_SESSION['id']; 
    }

    require_once('../evento/conexao.php');
    date_default_timezone_set('America/Sao_Paulo');

    $database = new Database();
    $db = $database->conectar();
?>
<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/head.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200&display=swap" rel="stylesheet">

    <title>cabeçalho</title>

</head>

<body>

    <header>

        <img class="logo" src="../imagens/logo.jpg" alt="" srcset="">

       <h1 class="titulo">Finanças Fácil</h1>
        <div class="navega">


               
        <?php 
                                                if (isset($_SESSION['id'])) {
                                              echo ' <a href="views/perfil.php">Perfil</a>';
                                                }
                 
?>
        </div>

        <?php 
            if (!isset($_SESSION['id'])) { 
                

        echo '<a class="logs" href="login.php">Logar</a>';
        echo '<a  class="logs" href="cadastro.php">Cadastrar</a>';

            }
       
            if (isset($_SESSION['id'])) { 
                

        echo '<a class="logs" href="../evento/logout.php">Log Out</a>';
     

            }
        ?> 

    </header>

</body>

</html>