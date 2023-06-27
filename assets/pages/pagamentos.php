<?php
include '../crud/conexao.php';

// Consulta SQL para obter os registros dos clientes
$sql = "SELECT * FROM pagamento";

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
            <?php
                while ($row = $registros_pagamentos->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row['codigo_pagamento'] . '</td>';
                    echo '<td>' . $row['codigo_cliente'] . '</td>';
                    echo '<td>' . $row['nome_cliente'] . '</td>';
                    echo '<td>' . $row['data_pagamento'] . '</td>';
                    echo '<td>' . $row['valor_pagamento'] . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
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
                    <form action="../crud/insert_pagamento.php" method="POST">
                        <div class="form-group">
                            <label for="nome_cliente">Código do Cliente</label>
                            <input type="text" class="form-control" id="codigo_cliente" name="codigo_cliente" required>
                        </div>
                        <div class="form-group">
                            <label for="telefone">Valor</label>
                            <input type="number" class="form-control" id="valor" name="valor" required>
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
                    <form action="../crud/update_pagamento.php" method="POST">
                        <div class="form-group">
                            <label for="nome_cliente">Código do Pagamento</label>
                            <input type="text" class="form-control" id="codigo_pagamento" name="codigo_pagamento" required>
                        </div>
                        <div class="form-group">
                            <label for="telefone">Valor</label>
                            <input type="number" class="form-control" id="valor" name="valor" required>
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
                    <form action="../crud/delete_pagamento.php" method="POST">
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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
