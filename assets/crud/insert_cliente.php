<?php
    include 'conexao.php';

	$nome = isset($_GET['nome']) ? $_GET['nome'] : null;
	$telefone = isset($_GET['telefone']) ? $_GET['telefone'] : null;
    $dataAtual = date("Y-m-d");

    $sql = "INSERT INTO clientes VALUES (0, $nome, $telefone, $dataAtual)";

    // Executa a declaração SQL
    if ($connection->query($sql) === true) {
        echo "Dados inseridos com sucesso!";
    } else {
        echo "Erro ao inserir dados: " . $connection->error;
    }
?>