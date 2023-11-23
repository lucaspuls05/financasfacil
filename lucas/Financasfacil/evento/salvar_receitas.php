<?php
if(!isset($_SESSION)) {
    session_start();
}

if(!isset($_SESSION['id'])) {
    header('Location: ../login/login.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once('../evento/conexao.php');

    $id_usuario = $_SESSION['id'];
    $nome_entrada = $_POST['nome_entrada'];
    $valor_lucro = $_POST['valor_lucro'];
    $meio_pagamento = $_POST['meio_pagamento'];

    if (empty($nome_entrada) || empty($valor_lucro) || empty($meio_pagamento)) {
        header('Location: ../.php?error=empty_fields');
        exit;
    }

    $database = new Database();
    $db = $database->conectar();

    $query = "INSERT INTO receitas (id_usuario, nome_entrada, valor_lucro, meio_pagamento) VALUES (:id_usuario, :nome_entrada, :valor_lucro, :meio_pagamento)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $stmt->bindParam(':nome_entrada', $nome_entrada, PDO::PARAM_STR);
    $stmt->bindParam(':valor_lucro', $valor_lucro, PDO::PARAM_STR);
    $stmt->bindParam(':meio_pagamento', $meio_pagamento, PDO::PARAM_STR);

    if ($stmt->execute()) {
        header('Location: ../');
        exit;
    } else {
        header('Location: ../.php?error=database_error');
        exit;
    }
} else {
    header('Location:../');
    exit;
}
?>
