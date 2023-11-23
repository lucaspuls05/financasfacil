<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    header('Location: ../login/login.php');
    exit;
}

require_once('../evento/conexao.php');

$database = new Database();
$db = $database->conectar();

$id_usuario = $_SESSION['id'];

$query_receitas = "SELECT SUM(valor_lucro) AS total_receitas FROM receitas WHERE id_usuario = :id_usuario";
$stmt_receitas = $db->prepare($query_receitas);
$stmt_receitas->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
$stmt_receitas->execute();
$total_receitas = $stmt_receitas->fetch(PDO::FETCH_ASSOC)['total_receitas'];

$query_perdas = "SELECT SUM(valor_prejuizo) AS total_perdas FROM perdas WHERE id_usuario = :id_usuario";
$stmt_perdas = $db->prepare($query_perdas);
$stmt_perdas->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
$stmt_perdas->execute();
$total_perdas = $stmt_perdas->fetch(PDO::FETCH_ASSOC)['total_perdas'];

$balanco_total = $total_receitas - $total_perdas;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/receita.css">
    <title>Ver Balanço</title>
</head>
<body>
    <?php include '../menu/nav.php'; ?>
    <div class="geral">
        <a href="../">Voltar</a>

        <h2>Balanço Total</h2>
        
        <p>O balanço total é: <?php echo ($balanco_total < 0 ? '- ' : '') . 'R$ ' . number_format(abs($balanco_total), 2); ?></p>
    </div>
</body>
</html>
