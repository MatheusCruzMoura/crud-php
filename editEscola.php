<div class="modal fade" id="modalEditEscola" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar Escola</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="" method="" id="formEditEscola" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nomeEscola" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nomeEscola"
                            value="Escola de Referência em Ensino Médio Pastor José Florêncio Rodrigues">
                    </div>
                    <div class="mb-3">
                        <label for="cnpjEscola" class="form-label">CNPJ</label>
                        <input type="text" class="form-control" id="cnpjEscola"
                            value="77.614.997/0001-02">
                    </div>
                    <div class="mb-3">
                        <label for="imgEditEscola" class="form-label">Imagem</label>
                        <input type="file" class="form-control" id="imgEditEscola" accept="image/*"
                            onchange="document.getElementById('editImgEscolaView').src = window.URL.createObjectURL(this.files[0])">
                        <div class="col-12 d-flex justify-content-center">
                            <img src="https://consed.org.br/storage/cache/news_760x470/media/image/news/5d8515681bd60.jpg" class="rounded-3 col-5 mt-3" id="editImgEscolaView">
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