<?php
	header("Location: ../pages/clientes.php");

    include 'conexao.php';

    $nome = isset($_POST['nome_cliente']) ? $_POST['nome_cliente'] : null;
    $telefone = isset($_POST['telefone']) ? $_POST['telefone'] : null;
    $dataAtual = date("Y-m-d");

    if(($nome!=null) && ($telefone!=null)){
        $sql = "INSERT INTO clientes (codigo_cliente, nome_cliente, telefone, data_cadastro) VALUES (0, '$nome', '$telefone', '$dataAtual')";
    }
    


    // Executa a declaração SQL
    if ($connection->query($sql) === true) {
        echo "Dados inseridos com sucesso!";
    } else {
        echo "Erro ao inserir dados: " . $connection->error;
    }
form_pesquisa

    // Fecha a conexão com o banco de dados
    $connection->close();
?>

