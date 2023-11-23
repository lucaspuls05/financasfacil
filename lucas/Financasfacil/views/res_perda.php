<?php
if (!isset($_SESSION)) {
    session_start();
}

$id_user = $_SESSION['id'];

if (!isset($_SESSION['id'])) {
    header('Location: ../login/login.php');
}

require_once('../evento/conexao.php');
date_default_timezone_set('America/Sao_Paulo');

$database = new Database();
$db = $database->conectar();

$query = "SELECT id, nome, email FROM usuarios WHERE id = :id";
$stmt = $db->prepare($query);
$stmt->bindParam(':id', $id_user, PDO::PARAM_INT);
$stmt->execute();
$user_data = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user_data) {
    header('Location: erro.php');
    exit;
}
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
      
        
        <h2>Registrar Perda</h2>
        <form action="../evento/salvar_perdas.php" method="post">
            <label for="nome_perda">Nome da Perda:</label>
            <input type="text" id="nome_perda" name="nome_perda"><br><br>

            <label for="valor_prejuizo">Valor do Prejuízo (ex: R$54):</label>
            <input type="text" id="valor_prejuizo" name="valor_prejuizo"><br><br>

            <label for="meio_pagamento_perda">Meio de Pagamento:</label>
            <input type="text" id="meio_pagamento_perda" name="meio_pagamento_perda"><br><br>

            <input type="submit" value="Registrar Perda">
        </form> 
         <a href="../">Voltar</a>
    </div>
</body>
</html>
