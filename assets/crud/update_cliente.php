<?php
	header("Location: ../pages/clientes.php");

    include 'conexao.php';

    $codigo = isset($_POST['codigo_cliente']) ? $_POST['codigo_cliente'] : null;
    $nome = isset($_POST['nome_cliente']) ? $_POST['nome_cliente'] : null;
    $telefone = isset($_POST['telefone']) ? $_POST['telefone'] : null;

    if(($telefone==null)&&($nome!=null)){
        $sql = "UPDATE clientes SET nome_cliente = '$nome' WHERE codigo_cliente = $codigo ";
    }
    else if(($telefone!=null)&&($nome==null)){
        $sql = "UPDATE clientes SET telefone = '$telefone' WHERE codigo_cliente = $codigo ";
    }
    else if(($telefone!=null)&&($nome!=null)){
        $sql = "UPDATE clientes SET nome_cliente = '$nome' telefone = '$telefone' WHERE codigo_cliente = $codigo ";
    }
    else{
        $sql = "";
    }

    // Executa a declaração SQL
    if ($connection->query($sql) === true) {
        echo "Dados atualizaods com sucesso!";
    } else {
        echo "Erro ao atualizar dados: " . $connection->error;
    }

    // Fecha a conexão com o banco de dados
    $connection->close();
?>