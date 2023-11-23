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

if (isset($_GET['delete_id']) && !empty($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $query_delete = "DELETE FROM perdas WHERE id = :delete_id AND id_usuario = :id_usuario";
    $stmt_delete = $db->prepare($query_delete);
    $stmt_delete->bindParam(':delete_id', $delete_id, PDO::PARAM_INT);
    $stmt_delete->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $stmt_delete->execute();

    header("Location: ver_perdas.php");
    exit;
}

$query = "SELECT * FROM perdas WHERE id_usuario = :id_usuario";
$stmt = $db->prepare($query);
$stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
$stmt->execute();
$perdas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/receita.css">
    <title>Exibir Perdas</title>
</head>
<body>
    <?php include '../menu/nav.php'; ?>
    <div class="geral">

        <h2>Suas Perdas:</h2>
        
        <table>
            <tr>
                <th>Nome da Perda</th>
                <th>Valor do Prejuízo</th>
                <th>Meio de Pagamento</th>
                <th>Data de Registro</th>
                <th>Ações</th>
            </tr>

            <?php foreach ($perdas as $perda) : ?>
                <tr>
                    <td><?php echo $perda['nome_perda']; ?></td>
                    <td><?php echo 'R$ ' . number_format($perda['valor_prejuizo'], 2); ?></td>
                    <td><?php echo $perda['meio_pagamento_perda']; ?></td>
                    <td><?php echo $perda['data_registro']; ?></td>
                    <td>
                        <a href="?delete_id=<?php echo $perda['id']; ?>">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>  
        
        <a href="../">Voltar</a>

    </div>
</body>
</html>
