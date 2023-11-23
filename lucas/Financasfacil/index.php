<?php
	if(!isset($_SESSION)){
    	session_start();
	}

	$id_user = $_SESSION['id'];

	if(!isset ($_SESSION['id'])) {
    	header('Location: login/login.php');
	}

	require_once('evento/conexao.php');
	date_default_timezone_set('America/Sao_Paulo');

	$database = new Database();
	$db = $database->conectar();
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/head.css">

    <title>Index</title>
</head>
<body>

<?php include 'menu/menu-index/nav.php'; ?>


<div class="geral">
<a href="views/ver_balanço.php">Balanço</a>
<a href="views/ver_receitas.php">Ver Receitas</a>
<a href="views/ver_perdas.php">Ver Perdas</a>
<a href="views/res_receita.php">Registrar Receita</a>
<a href="views/res_perda.php">Registrar Perda</a>

</div>

</body>
</html>