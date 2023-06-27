<?php
	header("Location: ../pages/pagamentos.php");

    include 'conexao.php';

    $codigo_pagamento = isset($_POST['codigo_pagamento']) ? $_POST['codigo_pagamento'] : null;
    $valor = isset($_POST['valor']) ? $_POST['valor'] : null;

    $sql = "UPDATE pagamento SET valor_pagamento = '$valor' WHERE codigo_pagamento = $codigo_pagamento";

    // Executa a declaração SQL
    if ($connection->query($sql) === true) {
        echo "Valor atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar valor: " . $connection->error;
    }

    // Fecha a conexão com o banco de dados
    $connection->close();
?>