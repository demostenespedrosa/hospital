<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sala de Medicamentos</title>
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
        <h1 class="text-center">Sala de Medicamentos</h1>

        <!-- Tabela de pacientes na etapa Sala de Medicamentos -->
        <h3 class="mt-4">Pacientes na Sala de Medicamentos</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Prescrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="medicamentosTable"></tbody>
        </table>
    </div>

    <!-- Modal para registrar aplicação de medicamentos -->
    <div class="modal fade" id="medicamentosModal" tabindex="-1" aria-labelledby="medicamentosModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="medicamentosModalLabel">Registrar Aplicação</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="medicamentosForm">
                        <input type="hidden" id="paciente_id" name="paciente_id">
                        <div class="mb-3">
                            <label for="medicamento" class="form-label">Medicamento Aplicado</label>
                            <input type="text" class="form-control" id="medicamento" name="medicamento" required>
                        </div>
                        <div class="mb-3">
                            <label for="enfermeiro_responsavel" class="form-label">Enfermeiro Responsável</label>
                            <input type="text" class="form-control" id="enfermeiro_responsavel" name="enfermeiro_responsavel" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Salvar e Finalizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function () {
            // Carregar pacientes na etapa Sala de Medicamentos
            function loadMedicamentosPatients() {
                $.get("get_medicamentos_patients.php", function (data) {
                    $("#medicamentosTable").html(data);
                });
            }

            // Abrir o modal de registro de medicamentos
            $(document).on("click", ".register-medicamento", function () {
                const id = $(this).data("id");
                $("#paciente_id").val(id);
                $("#medicamentosModal").modal("show");
            });

            // Registrar medicamento e finalizar o atendimento
            $("#medicamentosForm").on("submit", function (e) {
                e.preventDefault();
                $.post("save_medicamento.php", $(this).serialize(), function (response) {
                    alert(response);
                    $("#medicamentosModal").modal("hide");
                    loadMedicamentosPatients(); // Atualizar tabela
                });
            });

            // Inicializar a tabela
            loadMedicamentosPatients();
        });
    </script>
</body>
</html>
