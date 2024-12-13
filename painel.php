<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Chamada</title>
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
        <h1 class="text-center">Painel de Chamada</h1>

        <!-- Seleção do setor -->
        <div class="mb-4">
            <label for="setor" class="form-label">Selecione o Setor:</label>
            <select id="setor" class="form-select">
                <option value="Cadastro">Cadastro</option>
                <option value="Anamnese">Anamnese</option>
                <option value="Consulta Médica">Consulta Médica</option>
                <option value="Sala de Medicamentos">Sala de Medicamentos</option>
            </select>
        </div>

        <!-- Exibição do próximo paciente -->
        <div id="painelChamada" class="alert alert-primary text-center d-none"></div>

        <!-- Botão para avançar -->
        <div class="text-center mt-4">
            <button id="chamarProximo" class="btn btn-success" disabled>Chamar Próximo</button>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            // Atualizar o painel ao selecionar o setor
            $("#setor").on("change", function () {
                loadNextPatient($(this).val());
            });

            // Função para carregar o próximo paciente
            function loadNextPatient(setor) {
                $.get("processar_chamada.php", { setor: setor }, function (response) {
                    const data = JSON.parse(response);
                    if (data.paciente) {
                        $("#painelChamada").text(
                            setor === "Cadastro" ? `Senha: ${data.paciente.senha_atendimento}` : `Paciente: ${data.paciente.nome_completo}`
                        ).removeClass("d-none");
                        $("#chamarProximo").prop("disabled", false).data("id", data.paciente.id);
                    } else {
                        $("#painelChamada").text("Nenhum paciente na fila.").removeClass("d-none");
                        $("#chamarProximo").prop("disabled", true);
                    }
                });
            }

            // Avançar o paciente para a próxima etapa
            $("#chamarProximo").on("click", function () {
                const id = $(this).data("id");
                const setor = $("#setor").val();

                $.post("avancar_etapa.php", { id: id, setor: setor }, function (response) {
                    alert(response);
                    loadNextPatient(setor); // Atualizar o painel com o próximo paciente
                });
            });

            // Inicializar com o setor "Cadastro"
            loadNextPatient("Cadastro");
        });
    </script>
</body>
</html>
