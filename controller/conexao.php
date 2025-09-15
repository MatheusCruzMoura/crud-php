<?php

$host = "localhost";
$user = "admin";
$password = "escolas123";
$port = "5433";
$dbname = "escolas";

$con_string = "host=$host port=$port dbname=$dbname user=$user password=$password";

$conection = pg_connect($con_string) or
    die('Não foi possível se conectar ao servidor PostgreSQL');

?>