<div class="modal fade" id="modalDeleteEscola" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Apagar Escola?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body d-flex flex-column mb-3">
                <img src="https://consed.org.br/storage/cache/news_760x470/media/image/news/5d8515681bd60.jpg"
                    class="rounded-3" alt="...">
                <h5 class="py-3">
                    Escola de Referência em Ensino Médio Pastor José Florêncio Rodrigues
                </h5>
                <h6 class="">CNPJ: 77.614.997/0001-02</h6>

                <form action="/controller/escolaDelete.php" method="post">
                    <input type="hidden" name="id" id="idEscolaDel">
                    <input type="hidden" name="userIp" id="userIpDel">
                    <input type="hidden" name="dataHora" id="dataHoraDel">

                    <div class="mb-3">
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger">Apagar</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById("dataHoraDel").value = new Date().toISOString();

    fetch('https://api.ipify.org?format=json')
        .then(response => response.json())
        .then(data => {
            document.getElementById("userIpDel").value = data.ip;
        })
        .catch(error => {
            console.error('Error fetching IP address:', error);
        });
</script>