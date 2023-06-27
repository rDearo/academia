<?php
    $host = "localhost";
    $usuario = "root";
    $senha = "";
    $database = "academia";

    $connection = new mysqli($host, $usuario, $senha, $database);

    if($connection->connect_error) {
        die("Falha na conexão " . $connection->connect_error);
    }
?>