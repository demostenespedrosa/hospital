<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anamnese</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.php">UPA 24h</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="cadastro.php">Cadastro</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="painel.php">Painel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="anamnese.php">Anamnese</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="consulta.php">Consulta Médica</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="medicamentos.php">Sala de Medicamentos</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <h1 class="text-center">Registro de Anamnese</h1>

        <!-- Tabela de pacientes na etapa Anamnese -->
        <h3 class="mt-4">Pacientes para Anamnese</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Sintomas</th>
                    <th>Sinais Vitais</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="anamneseTable"></tbody>
        </table>
    </div>

    <!-- Modal para registrar anamnese -->
    <div class="modal fade" id="anamneseModal" tabindex="-1" aria-labelledby="anamneseModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="anamneseModalLabel">Registrar Anamnese</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="anamneseForm">
                        <input type="hidden" id="paciente_id" name="paciente_id">
                        <div class="mb-3">
                            <label for="sintomas" class="form-label">Sintomas</label>
                            <textarea class="form-control" id="sintomas" name="sintomas" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="sinais_vitais" class="form-label">Sinais Vitais</label>
                            <textarea class="form-control" id="sinais_vitais" name="sinais_vitais" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Salvar e Avançar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function () {
            // Carregar pacientes na etapa Anamnese
            function loadAnamnesePatients() {
                $.get("get_anamnese_patients.php", function (data) {
                    $("#anamneseTable").html(data);
                });
            }

            // Abrir o modal de registro de anamnese
            $(document).on("click", ".register-anamnese", function () {
                const id = $(this).data("id");
                $("#paciente_id").val(id);
                $("#anamneseModal").modal("show");
            });

            // Registrar anamnese e avançar para Consulta Médica
            $("#anamneseForm").on("submit", function (e) {
                e.preventDefault();
                $.post("save_anamnese.php", $(this).serialize(), function (response) {
                    alert(response);
                    $("#anamneseModal").modal("hide");
                    loadAnamnesePatients(); // Atualizar tabela
                });
            });

            // Inicializar a tabela
            loadAnamnesePatients();
        });
    </script>
</body>
</html>
