<?php
include('conexao.php');

$nome = $_POST["nome"];
$cnpj = $_POST["cnpj"];
$imagem = $_FILES['imagem'];

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
            echo "Imagem salva com sucesso!";

            $query = "INSERT INTO escolas (nome, cnpj, imagem) VALUES ('$nome', '$cnpj', '/uploads/images/" . $imagem["name"] . "')";

            $resultado = pg_query($conection, $query);

            if ($resultado) {
                echo "Escola cadastrada com sucesso!";
            } else {
                echo "Erro ao cadastrar escola.";
            }

            pg_close($conection) or
                die('Não foi possível se desconectar!');

            header("Location: http://localhost/");
        } else {
            echo "Erro ao mover a imagem!";
        }
    } else {
        echo "Erro no envio da imagem!";
    }
}
