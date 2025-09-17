<?php
include('conexao.php');

$nome = $_POST["nome"];
$cnpj = $_POST["cnpj"];
$imagem = $_FILES['imagem'];
$userIp = $_POST["userIp"];
$dataHora = $_POST["dataHora"];

$upload_dir = $_SERVER['DOCUMENT_ROOT'] . 'uploads/images/';

if (!is_dir($upload_dir)) {
    echo 'Upload directory does not exist.';
}

if (!is_writable($upload_dir)) {
    echo 'Upload directory is not writable.';
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
            echo "Imagem salva com sucesso!<br>";

            $imgUrl = "/uploads/images/" . $imagem["name"];
            $query = "INSERT INTO escolas (nome, cnpj, imagem) VALUES ('$nome', '$cnpj', '$imgUrl') RETURNING id";

            $resultado = pg_query($conection, $query);

            if (!$resultado) {
                echo "Erro ao cadastrar escola.<br>";
                echo pg_last_error($conection);
            } else {
                echo "Escola cadastrada com sucesso!";
                $queryAuditoria = "INSERT INTO auditoria_escolas (escola_id, nome, cnpj, imagem, user_ip, data_hora) VALUES ('" . pg_fetch_array($resultado)['id'] . "', '$nome', '$cnpj', '$imgUrl', '$userIp', '$dataHora')";

                $resultadoAuditoria = pg_query($conection, $queryAuditoria);
                if (!$resultadoAuditoria) {
                    echo "Erro ao cadastrar auditoria da escola.<br>";
                    echo pg_last_error($conection);
                } else {
                    echo "Auditoria da escola cadastrada com sucesso!";
                    header("Location: http://localhost/");
                }
            }

            pg_close($conection) or
                die('Não foi possível se desconectar!');
        } else {
            echo "Erro ao mover a imagem!";
        }
    } else {
        echo "Erro no envio da imagem!";
    }
}
