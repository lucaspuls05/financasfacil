<?php
	if(!isset($_SESSION)){
    	session_start();
	}

	$id_user = $_SESSION['id'];

	if(!isset ($_SESSION['id'])) {
    	header('Location: ../login/login.php');
	}

	require_once('../evento/conexao.php');
	date_default_timezone_set('America/Sao_Paulo');

	$database = new Database();
	$db = $database->conectar();


    $query = "SELECT id, nome, email  FROM usuarios WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $id_user, PDO::PARAM_INT);
    $stmt->execute();
    $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="../css/receita.css">
    <title>Perfil</title>
</head>
<body>
<?php include '../menu/nav.php'; ?>
<div class="geral">
<div class="geral">

        <form action="../evento/salvar_receitas.php" method="post">
            <label for="nome_entrada">Nome da entrada:</label>
            <input type="text" id="nome_entrada" name="nome_entrada"><br><br>

            <label for="valor_lucro">Valor do lucro (ex: R$54):</label>
            <input type="text" id="valor_lucro" name="valor_lucro"><br><br>

            <label for="meio_pagamento">Meio de pagamento:</label>
            <input type="text" id="meio_pagamento" name="meio_pagamento"><br><br>

            <input type="submit" value="Registrar Receita">
        </form>
    </div>
    <a href="../">Voltar</a>

</div>

</body>
</html>