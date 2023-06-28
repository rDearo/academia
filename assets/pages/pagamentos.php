<?php
    include '../database/conexao.php';

    // Parâmetros de pesquisa
    $nomeCliente = $_GET['nome_cliente'] ?? '';
    $dataPagamento = $_GET['data_pagamento'] ?? '';

    // Consulta SQL para obter os registros dos pagamentos
    $sql = "SELECT * FROM pagamento";

    // Adiciona a cláusula WHERE caso os parâmetros de pesquisa tenham sido enviados
    if (!empty($nomeCliente) || !empty($dataPagamento)) {
        $sql .= " WHERE";
        if (!empty($nomeCliente)) {
            $sql .= " nome_cliente LIKE '%$nomeCliente%'";
        }
        if (!empty($nomeCliente) && !empty($dataPagamento)) {
            $sql .= " AND";
        }
        if (!empty($dataPagamento)) {
            $sql .= " data_pagamento = '$dataPagamento'";
        }
    }

    $registros_pagamentos = $connection->query($sql);

    // Fecha a conexão com o banco de dados
    $connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Academia</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="../../index.html">Academia - Área Administrativa</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../../index.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./clientes.php">Clientes</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Pagamentos</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>


    <div class="container">
        <h1 class="text-center mb-4">Registro de Pagamentos</h1>
        
        <!-- Botões -->
        <div class="text-right mb-3">
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalCadastro">Registrar Pagamento</button>
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAtualizar">Editar Pagamento</button>
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalDeletar">Deletar Pagamento</button>
        </div>

    
        
        <!-- Tabela de Clientes -->
        <h3 class="mt-5">Pagamentos</h3>
        <form class="form-inline mt-3 mb-3" method="GET" id="form_pesquisa">
            <div class="form-group mr-2">
                <label for="nome_cliente">Nome do Cliente:</label>
                <input type="text" class="form-control" id="nome_cliente" name="nome_cliente" placeholder="Digite o nome do cliente">
            </div>
            <div class="form-group mr-2">
                <label for="data_pagamento">Data de Pagamento:</label>
                <input type="date" class="form-control" id="data_pagamento" name="data_pagamento">
            </div>
            <button type="submit" class="btn btn-primary">Pesquisar</button>
        </form>
        <?php if ($registros_pagamentos->num_rows > 0): ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Código do Pagamento</th>
                        <th>Código do Cliente</th>
                        <th>Nome do Cliente</th>
                        <th>Data de Pagamento</th>
                        <th>Valor do Pagamento</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($row = $registros_pagamentos->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['codigo_pagamento'] ?></td>
                        <td><?= $row['codigo_cliente'] ?></td>
                        <td><?= $row['nome_cliente'] ?></td>
                        <td><?= $row['data_pagamento'] ?></td>
                        <td><?= $row['valor_pagamento'] ?></td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Nenhum resultado encontrado.</p>
        <?php endif; ?>
    </div>

    <!-- Formulário de Pesquisa -->
    <div class="modal fade" id="modalPesquisa" tabindex="-1" role="dialog" aria-labelledby="modalCadastroLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                
                </div>
            </div>
        </div>
    </div>


    <!-- Modal de Cadastro -->
    <div class="modal fade" id="modalCadastro" tabindex="-1" role="dialog" aria-labelledby="modalCadastroLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCadastroLabel">Registrar Pagamento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulário de cadastro de clientes -->
                    <form action="../crud/pagamento/insert_pagamento.php" method="POST">
                        <div class="form-group">
                            <label for="nome_cliente">Código do Cliente</label>
                            <input type="text" class="form-control" id="codigo_cliente" name="codigo_cliente" required>
                        </div>
                        <div class="form-group">
                            <label for="telefone">Valor</label>
                            <input type="number" class="form-control" id="valor" name="valor" required>
                        </div>
                        <div class="form-group">
                            <label for="data">Data Pagamento</label>
                            <input type="date" class="form-control" id="data" name="data" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Atualização -->
    <div class="modal fade" id="modalAtualizar" tabindex="-1" role="dialog" aria-labelledby="modalAtualizarLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAtualizarLabel">Editar Pagamento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulário de atualização de clientes -->
                    <form action="../crud/pagamento/update_pagamento.php" method="POST">
                        <div class="form-group">
                            <label for="nome_cliente">Código do Pagamento</label>
                            <input type="text" class="form-control" id="codigo_pagamento" name="codigo_pagamento" required>
                        </div>
                        <div class="form-group">
                            <label for="telefone">Valor</label>
                            <input type="number" class="form-control" id="valor" name="valor">
                        </div>
                        <div class="form-group">
                            <label for="data">Data Pagamento</label>
                            <input type="date" class="form-control" id="data" name="data">
                        </div>
                        <button type="submit" class="btn btn-primary">Atualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal de Atualização -->
    <div class="modal fade" id="modalDeletar" tabindex="-1" role="dialog" aria-labelledby="modalAtualizarLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAtualizarLabel">Deletar Pagamento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulário de atualização de clientes -->
                    <form action="../crud/pagamento/delete_pagamento.php" method="POST">
                        <div class="form-group">
                            <label for="codigo_cliente">Código do Pagamento:</label>
                            <input type="number" class="form-control" id="codigo_pagamento" name="codigo_pagamento" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Deletar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <footer class="bg-dark text-white text-center py-3">
        <p>ETEC Sales Gomes | Desenvolvido por <a href="https://github.com/rDearo" target="_blank">Rodrigo</a> e  <a href="https://github.com/liabueno" target="_blank">Júlia</a></p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
