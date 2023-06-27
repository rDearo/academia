<?php
    include '../crud/conexao.php';

    // Verifica se foi enviado um nome para filtrar
    if (isset($_GET['nome_cliente'])) {
        $nome_cliente = $_GET['nome_cliente'];
        // Consulta SQL para obter os registros dos clientes filtrados pelo nome
        $sql = "SELECT * FROM clientes WHERE nome_cliente LIKE '%$nome_cliente%'";
    } else {
        // Consulta SQL para obter todos os registros dos clientes
        $sql = "SELECT * FROM clientes";
    }

    $cadastros_clientes = $connection->query($sql);

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
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Clientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./pagamentos.php">Pagamentos</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>



    <div class="container">
        <h1 class="text-center mb-4">Cadastro de Clientes</h1>
    
        <!-- Botões -->
        <div class="text-right mb-3">
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalCadastro">Cadastrar Cliente</button>
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAtualizar">Atualizar Cliente</button>
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalDeletar">Deletar Cliente</button>
        </div>
        
        <!-- Tabela de Clientes -->

        <form action="" method="GET" class="mb-3">
            <div class="form-group">
                <label for="nome_cliente">Filtrar por nome:</label>
                <input type="text" class="form-control" id="nome_cliente" name="nome_cliente" value="<?php echo isset($_GET['nome_cliente']) ? $_GET['nome_cliente'] : ''; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Filtrar</button>
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th>Código do Cliente</th>
                    <th>Telefone do Cliente</th>
                    <th>Nome do Cliente</th>
                    <th>Data de Cadastro</th>
                </tr>
            </thead>
            <tbody>
            <?php
                while ($row = $cadastros_clientes->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row['codigo_cliente'] . '</td>';
                    echo '<td>' . $row['telefone'] . '</td>';
                    echo '<td>' . $row['nome_cliente'] . '</td>';
                    echo '<td>' . $row['data_cadastro'] . '</td>';
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
                    <h5 class="modal-title" id="modalCadastroLabel">Cadastrar Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulário de cadastro de clientes -->
                    <form action="../crud/insert_cliente.php" method="POST">
                        <div class="form-group">
                            <label for="nome_cliente">Nome do Cliente:</label>
                            <input type="text" class="form-control" id="nome_cliente" name="nome_cliente" required>
                        </div>
                        <div class="form-group">
                            <label for="telefone">Telefone:</label>
                            <input type="tel" class="form-control" id="telefone" name="telefone" required>
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
                    <h5 class="modal-title" id="modalAtualizarLabel">Atualizar Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulário de atualização de clientes -->
                    <form action="../crud/update_cliente.php" method="POST">
                        <div class="form-group">
                            <label for="codigo_cliente">Código do Cliente:</label>
                            <input type="number" class="form-control" id="codigo_cliente" name="codigo_cliente" required>
                        </div>
                        <div class="form-group">
                            <label for="nome_cliente">Nome do Cliente:</label>
                            <input type="text" class="form-control" id="nome_cliente" name="nome_cliente">
                        </div>
                        <div class="form-group">
                            <label for="telefone">Telefone:</label>
                            <input type="tel" class="form-control" id="telefone" name="telefone" >
                        </div>
                        <button type="submit" class="btn btn-primary">Atualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal de Delete -->
    <div class="modal fade" id="modalDeletar" tabindex="-1" role="dialog" aria-labelledby="modalCadastroLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCadastroLabel">Deletar Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulário de delete de clientes -->
                    <form action="../crud/delete_cliente.php" method="POST">
                        <div class="form-group">
                            <label for="nome_cliente">Id do Cliente:</label>
                            <input type="number" class="form-control" id="id_cliente" name="id_cliente" required>
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
