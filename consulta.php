<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta Médica</title>
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
        <h1 class="text-center">Consulta Médica</h1>

        <!-- Tabela de pacientes na etapa Consulta Médica -->
        <h3 class="mt-4">Pacientes para Consulta</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Diagnóstico</th>
                    <th>Prescrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="consultaTable"></tbody>
        </table>
    </div>

    <!-- Modal para registrar consulta -->
    <div class="modal fade" id="consultaModal" tabindex="-1" aria-labelledby="consultaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="consultaModalLabel">Registrar Consulta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="consultaForm">
                        <input type="hidden" id="paciente_id" name="paciente_id">
                        <div class="mb-3">
                            <label for="diagnostico" class="form-label">Diagnóstico</label>
                            <textarea class="form-control" id="diagnostico" name="diagnostico" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="medicamentos" class="form-label">Prescrição de Medicamentos</label>
                            <textarea class="form-control" id="medicamentos" name="medicamentos" rows="3" required></textarea>
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
            // Carregar pacientes na etapa Consulta Médica
            function loadConsultaPatients() {
                $.get("get_consulta_patients.php", function (data) {
                    $("#consultaTable").html(data);
                });
            }

            // Abrir o modal de registro de consulta
            $(document).on("click", ".register-consulta", function () {
                const id = $(this).data("id");
                $("#paciente_id").val(id);
                $("#consultaModal").modal("show");
            });

            // Registrar consulta e avançar para Sala de Medicamentos
            $("#consultaForm").on("submit", function (e) {
                e.preventDefault();
                $.post("save_consulta.php", $(this).serialize(), function (response) {
                    alert(response);
                    $("#consultaModal").modal("hide");
                    loadConsultaPatients(); // Atualizar tabela
                });
            });

            // Inicializar a tabela
            loadConsultaPatients();
        });
    </script>
</body>
</html>
