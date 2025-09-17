<?php
include('conexao.php');

if (isset($_POST['nome'])) {
    $nome = $_POST["nome"];
}

if (isset($_POST['cnpj'])) {
    $cnpj = $_POST["cnpj"];
}

if (isset($_FILES['imagem'])) {
    $imagem = $_FILES["imagem"];
}

if (isset($_POST['userIp'])) {
    $userIp = $_POST["userIp"];
}

if (isset($_POST['dataHora'])) {
    $dataHora = $_POST["dataHora"];
}


$upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/images/';
$erro = '';
$sucesso = '';

if (!is_dir($upload_dir)) {
    $erro = 'Upload directory does not exist.';
}

if (!is_writable($upload_dir)) {
    $erro = 'Upload directory is not writable.';
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($imagem) &&
        $imagem["error"] == UPLOAD_ERR_OK
    ) {
        if (move_uploaded_file(
            $imagem["tmp_name"],
            $upload_dir . $imagem["name"]
        )) {
            $sucesso = "Imagem salva com sucesso!";

            $imgUrl = "/uploads/images/" . $imagem["name"];
            $query = "INSERT INTO escolas (nome, cnpj, imagem) VALUES ('$nome', '$cnpj', '$imgUrl') RETURNING id";

            $resultado = pg_query($conection, $query);

            if (!$resultado) {
                $erro = pg_last_error($conection);
            } else {
                $sucesso = "Escola cadastrada com sucesso!";
                $queryAuditoria = "INSERT INTO auditoria_escolas (escola_id, nome, cnpj, imagem, user_ip, data_hora) VALUES ('" . pg_fetch_array($resultado)['id'] . "', '$nome', '$cnpj', '$imgUrl', '$userIp', '$dataHora')";

                $resultadoAuditoria = pg_query($conection, $queryAuditoria);
                if (!$resultadoAuditoria) {
                    $erro = pg_last_error($conection);
                } else {
                    header("Location: ../index.php");
                }
            }

            pg_close($conection) or
                die('Não foi possível se desconectar!');
        } else {
            $erro = "Erro ao mover a imagem!";
        }
    } else {
        $erro = "Erro no envio da imagem!<br>";
    }
}
