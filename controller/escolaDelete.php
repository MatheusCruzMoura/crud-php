<?php
include('conexao.php');

$id = $_POST["id"];

$query = "UPDATE escolas SET delete = true WHERE id = $id";

$resultado = pg_query($conection, $query);

if ($resultado) {
    echo "Escola apagada com sucesso!";
} else {
    echo "Erro ao apagar escola.";
}

pg_close($conection) or
    die('Não foi possível se desconectar!');

header("Location: http://localhost/");
