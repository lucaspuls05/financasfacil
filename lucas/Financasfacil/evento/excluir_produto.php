<?php
session_start();

if (!isset($_SESSION['id'])) {
    header('Location: ../login/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['produto_id'])) {
    $produto_id = $_POST['produto_id'];

    require_once('../evento/conexao.php');
    $database = new Database();
    $db = $database->conectar();

    $query = "DELETE FROM produtos WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $produto_id, PDO::PARAM_INT);
    $stmt->execute();

    header('Location: ../views/ver_estoque.php');
    exit;
} else {
    header('Location: erro.php');
    exit;
}
?>
