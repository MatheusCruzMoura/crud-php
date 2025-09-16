<?php
include('conexao.php');

$id = $_POST["id"];
$nome = $_POST["nome"];
$cnpj = $_POST["cnpj"];
$imagem = $_FILES['imagem'];

$upload_dir = $_SERVER['DOCUMENT_ROOT'] . 'uploads/images/';

$campos = array();

if ($nome) {
    $campos["nome"] = $nome;
}

if ($cnpj) {
    $campos["cnpj"] = $cnpj;
}

if ($imagem['error'] != 4) {
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
                $campos["imagem"] = "/uploads/images/" . $imagem['name'];
            } else {
                echo "Erro ao mover a imagem!";
            }
        } else {
            echo "Erro no envio da imagem!";
        }
    }
} else {
    echo "sem imagem";
}

$keys = array_keys($campos);

for ($i = 0; $i < count($keys); $i++) {
    $campos[$keys[$i]] = "'" . $campos[$keys[$i]] . "'";
}

for ($i = 0; $i < count($keys); $i++) {
    $keys[$i] = '"' . $keys[$i] . '" = ' . $campos[$keys[$i]];
}

$query = "UPDATE escolas SET " . implode(", ", $keys) . " WHERE id = $id";

$resultado = pg_query($conection, $query);

if ($resultado) {
    echo "Dados da escola alterados com sucesso!";
} else {
    echo "Erro ao alterar os dados da escola.";
}

pg_close($conection) or
    die('Não foi possível se desconectar!');

header("Location: http://localhost/");
