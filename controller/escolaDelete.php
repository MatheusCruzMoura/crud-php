<?php
include('conexao.php');

$id = $_POST["id"];
$userIp = $_POST["userIp"];
$dataHora = $_POST["dataHora"];

$query = "UPDATE escolas SET delete = true WHERE id = $id RETURNING nome, cnpj, imagem, delete";
$erro = '';
$sucesso = '';

$resultado = pg_query($conection, $query);

if ($resultado) {
    $sucesso = "Escola apagada com sucesso!<br>";

    $result = pg_fetch_array($resultado);
    $camposAudit = array();
    $camposAudit['nome'] = "'" . $result['nome'] . "'";
    $camposAudit['cnpj'] = "'" . $result['cnpj'] . "'";
    $camposAudit['imagem'] = "'" . $result['imagem'] . "'";
    $camposAudit['delete'] = "'" . $result['delete'] . "'";
    $camposAudit['user_ip'] = "'" . $userIp . "'";
    $camposAudit['data_hora'] = "'" . $dataHora . "'";
    $camposAudit['escola_id'] = $id;

    $keysAudit = array_keys($camposAudit);
    for ($i = 0; $i < count($keysAudit); $i++) {
        $keysAudit[$i] = '"' . $keysAudit[$i] . '"';
    }

    $queryAuditoria = "INSERT INTO auditoria_escolas (" . implode(", ", ($keysAudit)) . ") VALUES (" . implode(", ", $camposAudit)  . ")";

    $resultadoAuditoria = pg_query($conection, $queryAuditoria);

    if (!$resultadoAuditoria) {
        $erro = pg_last_error($conection);
    } else {
        header("Location: ../index.php");
    }
} else {
    $erro = "Erro ao apagar escola.";
}

pg_close($conection) or
    die('Não foi possível se desconectar!');
