<?php
    header("Location: ../pages/pagamentos.php");

    include 'conexao.php';

    $codigo_cliente = isset($_POST['codigo_cliente']) ? $_POST['codigo_cliente'] : null;
    $dataAtual = date("Y-m-d");
    $valor = isset($_POST['valor']) ? $_POST['valor'] : null;

    $consulta = $connection->query("SELECT nome_cliente FROM clientes WHERE codigo_cliente = $codigo_cliente");
    $dados_cliente = $consulta->fetch_assoc();
    $nome_cliente = $dados_cliente['nome_cliente'];

    $sql = "INSERT INTO pagamento (codigo_pagamento, codigo_cliente, nome_cliente, data_pagamento, valor_pagamento) VALUES (0, '$codigo_cliente', '$nome_cliente', '$dataAtual', $valor)";
        
    // Executa a declaração SQL
    if ($connection->query($sql) === true) {
        echo "Dados inseridos com sucesso!";
    } else {
        echo "Erro ao inserir dados: " . $connection->error;
    }

    // Fecha a conexão com o banco de dados
    $connection->close();

?>
