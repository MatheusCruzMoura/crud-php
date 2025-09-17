<div class="modal fade" id="modalEditEscola" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar Escola</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="/controller/escolaEdit.php" method="post" id="formEditEscola" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="idEscolaEdit">
                    <input type="hidden" name="userIp" id="userIpEdit">
                    <input type="hidden" name="dataHora" id="dataHoraEdit">

                    <div class="mb-3">
                        <label for="nomeEscolaEdit" class="form-label">Nome</label>
                        <input type="text" name="nome" class="form-control" id="nomeEscolaEdit">
                    </div>
                    <div class="mb-3">
                        <label for="cnpjEscolaEdit" class="form-label">CNPJ</label>
                        <input type="text" name="cnpj" class="form-control" id="cnpjEscolaEdit">
                    </div>
                    <div class="mb-3">
                        <label for="imagemEscolaEdit" class="form-label">Imagem</label>
                        <input type="file" name="imagem" class="form-control" id="imagemEscolaEdit" accept="image/*"
                            onchange="inputImgChange()">
                        <button type="button" class="btn btn-danger position-absolute mt-2" id="limparImg" style="display: none;" onclick="limparInputImg()"><i class="bi bi-x-lg"></i></button>
                        <div class="col-12 d-flex justify-content-center">
                            <img class="rounded-3 col-5 mt-3" id="editImgEscolaView">
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal" onclick="cancelarForm('formEditEscola')">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Editar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById("dataHoraEdit").value = new Date().toISOString();

    fetch('https://api.ipify.org?format=json')
        .then(response => response.json())
        .then(data => {
            document.getElementById("userIpEdit").value = data.ip;
        })
        .catch(error => {
            console.error('Error fetching IP address:', error);
        });

    function inputImgChange() {
        inputImg = document.getElementById('imagemEscolaEdit');
        document.getElementById('editImgEscolaView').src = window.URL.createObjectURL(inputImg.files[0]);
        document.getElementById("limparImg").style.display = "block";
    }

    function limparInputImg() {
        inputImg = document.getElementById('imagemEscolaEdit');
        inputImg.value = null;
        inputImg.files[0] = undefined;
        document.querySelector("img#editImgEscolaView").src = '';

        document.getElementById("limparImg").style.display = "none";
    }
</script>