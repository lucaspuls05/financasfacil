<?php
if(!isset($_SESSION)) {
    session_start();
}

if(!isset($_SESSION['id'])) {
    header('Location: ../login/login.php');
    exit;
}

require_once('../evento/conexao.php');

$database = new Database();
$db = $database->conectar();

$id_usuario = $_SESSION['id'];

if (isset($_GET['delete_id']) && !empty($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $query_delete = "DELETE FROM receitas WHERE id = :delete_id AND id_usuario = :id_usuario";
    $stmt_delete = $db->prepare($query_delete);
    $stmt_delete->bindParam(':delete_id', $delete_id, PDO::PARAM_INT);
    $stmt_delete->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $stmt_delete->execute();

    header("Location: ver_receitas.php");
    exit;
}

$query = "SELECT * FROM receitas WHERE id_usuario = :id_usuario";
$stmt = $db->prepare($query);
$stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
$stmt->execute();
$receitas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/receita.css">
    <title>Exibir Receitas</title>
</head>
<body>
    <?php include '../menu/nav.php'; ?>
    <div class="geral">
        <a href="../">Voltar</a>

        <h2>Suas Receitas:</h2>
        
        <table>
            <tr>
                <th>Nome da Entrada</th>
                <th>Valor do Lucro</th>
                <th>Meio de Pagamento</th>
                <th>Data de Registro</th>
                <th>Ações</th>
            </tr>

            <?php foreach ($receitas as $receita) : ?>
                <tr>
                    <td><?php echo $receita['nome_entrada']; ?></td>
                    <td><?php echo 'R$ ' . number_format($receita['valor_lucro'], 2); ?></td>
                    <td><?php echo $receita['meio_pagamento']; ?></td>
                    <td><?php echo $receita['data_registro']; ?></td>
                    <td>
                        <a href="?delete_id=<?php echo $receita['id']; ?>">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
