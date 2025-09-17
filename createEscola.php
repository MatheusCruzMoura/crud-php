<div class="modal fade" id="modalCreateEscola" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Cadastar Escola</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="/controller/escolaSave.php" method="post" enctype="multipart/form-data" id="formCadastroEscola">
                    <input type="hidden" name="userIp" id="userIp">
                    <input type="hidden" name="dataHora" id="dataHora">
                    <div class="mb-3">
                        <label for="nomeEscola" class="form-label">Nome</label>
                        <input required type="text" name="nome" class="form-control" id="nomeEscola">
                    </div>
                    <div class="mb-3">
                        <label for="cnpjEscola" class="form-label">CNPJ</label>
                        <input required type="text" name="cnpj" class="form-control" id="cnpjEscola">
                    </div>
                    <div class="mb-3">
                        <label for="imgEscola" class="form-label">Imagem</label>
                        <input required type="file" name="imagem" class="form-control" id="imgEscola" accept="image/*"
                            onchange="document.getElementById('imgEscolaView').src = window.URL.createObjectURL(this.files[0])">
                        <div class="col-12 d-flex justify-content-center">
                            <img class="rounded-3 col-5 mt-3" id="imgEscolaView">
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary me-2" onclick="cancelarForm('formCadastroEscola')" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById("dataHora").value = new Date().toISOString();

    fetch('https://api.ipify.org?format=json')
        .then(response => response.json())
        .then(data => {
            document.getElementById("userIp").value = data.ip;
        })
        .catch(error => {
            console.error('Error fetching IP address:', error);
        });
</script>