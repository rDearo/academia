<?php
<<<<<<< HEAD
	header("Location: ../pages/clientes.php");

    include 'conexao.php';

    $nome = isset($_POST['nome_cliente']) ? $_POST['nome_cliente'] : null;
    $telefone = isset($_POST['telefone']) ? $_POST['telefone'] : null;
    $dataAtual = date("Y-m-d");

    if(($nome!=null) && ($telefone!=null)){
        $sql = "INSERT INTO clientes (codigo_cliente, nome_cliente, telefone, data_cadastro) VALUES (0, '$nome', '$telefone', '$dataAtual')";
    }
    
=======
    include 'conexao.php';

	$nome = isset($_GET['nome']) ? $_GET['nome'] : null;
	$telefone = isset($_GET['telefone']) ? $_GET['telefone'] : null;
    $dataAtual = date("Y-m-d");

    $sql = "INSERT INTO clientes VALUES (0, $nome, $telefone, $dataAtual)";
>>>>>>> 5e6b0742462aaadf98e9f00a7419f09d1d41fbdc

    // Executa a declaração SQL
    if ($connection->query($sql) === true) {
        echo "Dados inseridos com sucesso!";
    } else {
        echo "Erro ao inserir dados: " . $connection->error;
    }
<<<<<<< HEAD

    // Fecha a conexão com o banco de dados
    $connection->close();
?>
=======
?>
>>>>>>> 5e6b0742462aaadf98e9f00a7419f09d1d41fbdc
