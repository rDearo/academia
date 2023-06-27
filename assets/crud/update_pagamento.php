<?php
	header("Location: ../pages/pagamentos.php");

    include 'conexao.php';

    $codigo_pagamento = isset($_POST['codigo_pagamento']) ? $_POST['codigo_pagamento'] : null;
    $data_pagamento = isset($_POST['data']) ? $_POST['data'] : null;
    $valor = isset($_POST['valor']) ? $_POST['valor'] : null;

    if(($valor==null)&&($data_pagamento!=null)){
        $sql = "UPDATE pagamento SET data_pagamento = '$data_pagamento' WHERE codigo_pagamento = $codigo_pagamento";
    }
    else if(($valor!=null)&&($data_pagamento==null)){
        $sql = "UPDATE pagamento SET valor_pagamento = '$valor' WHERE codigo_pagamento = $codigo_pagamento";
    }
    else if(($valor!=null)&&($data_pagamento!=null)){
        $sql = "UPDATE pagamento SET valor_pagamento = '$valor' data_pagamento = '$data_pagamento' WHERE codigo_pagamento = $codigo_pagamento";
    }
    else{
        $sql = "";
    }

    // Executa a declaração SQL
    if ($connection->query($sql) === true) {
        echo "Valor atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar valor: " . $connection->error;
    }

    // Fecha a conexão com o banco de dados
    $connection->close();
?>