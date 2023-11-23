<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    header('Location: ../login/login.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once('../evento/conexao.php');

    $database = new Database();
    $db = $database->conectar();

    $id_usuario = $_SESSION['id'];
    $nome_perda = $_POST['nome_perda'];
    $valor_prejuizo = $_POST['valor_prejuizo'];
    $meio_pagamento_perda = $_POST['meio_pagamento_perda'];

    if (empty($nome_perda) || empty($valor_prejuizo) || empty($meio_pagamento_perda)) {
        header('Location: ../views/ver_perdas.php?error=empty_fields');
        exit;
    }

    $query = "INSERT INTO perdas (id_usuario, nome_perda, valor_prejuizo, meio_pagamento_perda) VALUES (:id_usuario, :nome_perda, :valor_prejuizo, :meio_pagamento_perda)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $stmt->bindParam(':nome_perda', $nome_perda, PDO::PARAM_STR);
    $stmt->bindParam(':valor_prejuizo', $valor_prejuizo, PDO::PARAM_STR);
    $stmt->bindParam(':meio_pagamento_perda', $meio_pagamento_perda, PDO::PARAM_STR);

    if ($stmt->execute()) {
        header('Location: ../views/ver_perdas.php');
        exit;
    } else {
        header('Location: ../views/ver_perdas.php');
        exit;
    }
} else {
    header('Location: ../views/ver_perdas.php');
    exit;
}
?>
