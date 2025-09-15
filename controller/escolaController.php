<?php
include('conexao.php');

$query = "SELECT * FROM escolas";

$escolas = pg_query($conection, $query);
if (!$escolas) {
    echo "Ocorreu um erro.\n";
    exit;
}

pg_close($conection) or
    die('Não foi possível se desconectar!');
?>