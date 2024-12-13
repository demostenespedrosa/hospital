<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Paciente</title>
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
        <h1 class="text-center">Cadastro de Paciente</h1>
        <form id="cadastroForm" class="mt-4">
            <div class="mb-3">
                <label for="nome_completo" class="form-label">Nome Completo</label>
                <input type="text" class="form-control" id="nome_completo" name="nome_completo" required>
            </div>
            <div class="mb-3">
                <label for="cpf" class="form-label">CPF</label>
                <input type="text" class="form-control" id="cpf" name="cpf" required>
            </div>
            <div class="mb-3">
                <label for="telefone" class="form-label">Telefone</label>
                <input type="text" class="form-control" id="telefone" name="telefone">
            </div>
            <div class="mb-3">
                <label for="endereco" class="form-label">Endereço</label>
                <input type="text" class="form-control" id="endereco" name="endereco">
            </div>
            <button type="submit" class="btn btn-primary w-100">Cadastrar</button>
        </form>

        <!-- Feedback de Sucesso -->
        <div id="successMessage" class="alert alert-success mt-3 d-none"></div>
        <!-- Feedback de Erro -->
        <div id="errorMessage" class="alert alert-danger mt-3 d-none"></div>
    </div>

    <script>
        $(document).ready(function () {
            $("#cadastroForm").on("submit", function (e) {
                e.preventDefault();

                $.ajax({
                    url: "processar_cadastro.php",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function (response) {
                        if (response.startsWith("Paciente cadastrado")) {
                            $("#successMessage").text(response).removeClass("d-none");
                            $("#cadastroForm")[0].reset();
                        } else {
                            $("#errorMessage").text(response).removeClass("d-none");
                        }
                    },
                    error: function () {
                        $("#errorMessage").text("Erro ao enviar os dados. Tente novamente.").removeClass("d-none");
                    }
                });
            });
        });
    </script>
</body>
</html>
