<?php
// Comandos de conexão PDO e listas predefinidas ($medicos e $especialidades do opcoes.php)
require_once 'conexao.php';
require_once 'opcoes.php';

// CREATE - a operação "C" do CRUD (criar).
// O formulário abaixo envia os dados para ESTA MESMA página (action="").
// Quando ela é carregada por GET (primeira vez), só mostra o formulário.
// Quando é carregada por POST (formulário enviado), executa a inserção.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // $_POST guarda os valores dos campos de input/select que têm o atributo "name".
    $paciente = $_POST['paciente'];
    $medico = $_POST['medico'];
    $especialidade = $_POST['especialidade'];
    $data_consulta = $_POST['data_consulta'];

    // Monta o SQL de inserção usando "?" como placeholders.
    // Os valores NUNCA vão direto no SQL: isso evita SQL Injection.
    $sql = "INSERT INTO agendamentos (paciente, medico, especialidade, data_consulta) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    // execute() substitui cada "?" pelas variáveis, NA MESMA ORDEM em que foram escritas.
    // Se der certo, manda o usuário de volta para a lista (index.php).
    if ($stmt->execute([$paciente, $medico, $especialidade, $data_consulta])) {
        header('Location: index.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Agendamento</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <span class="simbolo">+</span>
        <h1>Clínica Médica - Agendamento de Consultas</h1>
    </header>

    <main class="form-largura">
        <div class="card">
            <div class="toolbar">
                <h2>Novo Agendamento</h2>
            </div>

            <!-- method="POST" envia os dados "escondidos" (não aparecem na URL) e sem limite de tamanho -->
            <form method="POST" action="">
                <div class="campo">
                    <label for="paciente">Nome do Paciente</label>
                    <!-- "name" do input precisa bater com o que o PHP lê via $_POST -->
                    <input type="text" id="paciente" name="paciente" required placeholder="Digite o nome completo">
                </div>

                <div class="campo">
                    <label for="medico">Médico</label>
                    <!-- <select> = dropdown com as opções predefinidas vindas do opcoes.php.
                         O foreach transforma o array em vários <option>.
                         O atributo data-especialidade guarda a especialidade do médico para o JS preencher
                         o outro select automaticamente. -->
                    <select id="medico" name="medico" required>
                        <option value="">Selecione um médico</option>
                        <?php foreach ($medicos as $nome => $esp): ?>
                            <option value="<?= htmlspecialchars($nome) ?>" data-especialidade="<?= htmlspecialchars($esp) ?>">
                                <?= htmlspecialchars($nome) ?> — <?= htmlspecialchars($esp) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="campo">
                    <label for="especialidade">Especialidade</label>
                    <select id="especialidade" name="especialidade" required>
                        <option value="">Selecione a especialidade</option>
                        <?php foreach ($especialidades as $esp): ?>
                            <option value="<?= htmlspecialchars($esp) ?>"><?= htmlspecialchars($esp) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="campo">
                    <label for="data_consulta">Data da Consulta</label>
                    <!-- type="date" mostra um calendário no navegador e envia no formato YYYY-MM-DD (o que o MySQL aceita) -->
                    <input type="date" id="data_consulta" name="data_consulta" required>
                </div>

                <div class="acoes-form">
                    <button type="submit" class="botao botao_verde">Salvar Agendamento</button>
                    <a href="index.php" class="botao botao_cinza">Cancelar</a>
                </div>
            </form>
        </div>
    </main>

    <script>
        // Ao escolher um médico no dropdown, pega a especialidade guardada no atributo
        // data-especialidade da opção escolhida e coloca no select de especialidade.
        document.getElementById('medico').addEventListener('change', function () {
            var especialidade = this.options[this.selectedIndex].getAttribute('data-especialidade');
            if (especialidade) {
                document.getElementById('especialidade').value = especialidade;
            }
        });
    </script>
</body>
</html>