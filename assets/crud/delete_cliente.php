<?php
	header("Location: ../pages/clientes.php");

    include 'conexao.php';

    $id = isset($_POST['id_cliente']) ? $_POST['id_cliente'] : null;

    $sql = "DELETE FROM clientes WHERE codigo_cliente = $id";

    // Executa a declaração SQL
    if ($connection->query($sql) === true) {
        echo "Cliente deletado com sucesso!";
    } else {
        echo "Erro ao deletar Cliente: " . $connection->error;
    }

    // Fecha a conexão com o banco de dados
    $connection->close();
?>
