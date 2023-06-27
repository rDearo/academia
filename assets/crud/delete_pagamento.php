<?php
	header("Location: ../pages/pagamentos.php");

    include 'conexao.php';

    $id = isset($_POST['codigo_pagamento']) ? $_POST['codigo_pagamento'] : null;

    $sql = "DELETE FROM pagamento WHERE codigo_pagamento = $id";

    // Executa a declaração SQL
    if ($connection->query($sql) === true) {
        echo "Pagamento deletado com sucesso!";
    } else {
        echo "Erro ao deletar Pagamento: " . $connection->error;
    }

    // Fecha a conexão com o banco de dados
    $connection->close();
?>
