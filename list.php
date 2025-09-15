<list class="container p-4 text-primary-emphasis col px-5">
    <h1>Escolas Cadastradas</h1>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreateEscola">
        <i class="bi bi-plus"></i> Adicionar Escola</button>

    <ul class="list-group list-group-flush">
        <?php
        include('controller/escolaController.php');

        while ($escola = pg_fetch_assoc($escolas)) {
            echo "
            <li class='list-group-item list-group-item-light'>
                <div class='d-flex justify-content-around align-items-center'>
                    <img src='" . $escola['imagem'] . "' class='rounded-circle col-3' style='height: 90px !important; width: 90px !important;'
                                    alt='...'>
                    <h5 class='col-4 two-lines-ellipsis' style='max-width: 340px;'>" . $escola['nome'] . "</h5>
                    <h5 class='col-2'>" . $escola['cnpj'] . "</h5>
                    <div class='col-3'>
                        <button type='button' class='btn btn-outline-primary' data-bs-toggle='modal' data-bs-target='#modalViewEscola'>
                            <i class='bi bi-eye'></i></button>
                        <button type='button' class='btn btn-outline-warning mx-3' data-bs-toggle='modal' data-bs-target='#modalEditEscola'>
                            <i class='bi bi-pencil'></i></button>
                        <button type='button' class='btn btn-outline-danger' data-bs-toggle='modal' data-bs-target='#modalDeleteEscola'>
                            <i class='bi bi-trash'></i></button>
                    </div>
                </div>
            </li>";
        }
        ?>
    </ul>
</list>