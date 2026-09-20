<?php
// UPADATE - a operação "U" do CRUD (atualizar).
// Este arquivo tem DUAS tarefas em um só:
//   1) Buscar o agendamento pelo id vindo da URL e preencher o formulário com os valores atuais;
//   2) Ao enviar o formulário (POST), gravar as alterações no banco.

require_once 'conexao.php';
require_once 'opcoes.php';

// (1) O id chega pela URL via GET (ex.: editar.php?id=4), montado lá no index.php.
$id = $_GET['id'];

// Busca o registro ATUAL no banco usando SELECT ... WHERE id = ? (placeholder protege contra SQL Injection).
$stmt = $pdo->prepare("SELECT * FROM agendamentos WHERE id = ?");
$stmt->execute([$id]);
// fetch() (no singular) traz APENAS 1 registro, diferente do fetchAll() usado no index.
$agendamento = $stmt->fetch(PDO::FETCH_ASSOC);

// Se o id não existe no banco (por exemplo, foi apagado), volta para a lista.
if (!$agendamento) {
    header('Location: index.php');
    exit;
}

// (2) Quando o formulário for enviado (método POST), faz o UPDATE.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $paciente = $_POST['paciente'];
    $medico = $_POST['medico'];
    $especialidade = $_POST['especialidade'];
    $data_consulta = $_POST['data_consulta'];

    // UPDATE ... SET ... WHERE id = ? atualiza apenas o registro com aquele id.
    $sql = "UPDATE agendamentos SET paciente = ?, medico = ?, especialidade = ?, data_consulta = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);

    // Atenção à ordem: os 4 primeiros valores são os campos e o ÚLTIMO é o id.
    if ($stmt->execute([$paciente, $medico, $especialidade, $data_consulta, $id])) {
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
    <title>Editar Agendamento</title>
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
                <h2>Editar Agendamento <?= '#' . $agendamento['id'] ?></h2>
            </div>

            <!-- O formulário é igual ao de criar.php, a diferença é que os campos vêm PREENCHIDOS
                 com o valor atual ($agendamento[...]) e o "Salvar" faz UPDATE em vez de INSERT -->
            <form method="POST" action="">
                <div class="campo">
                    <label for="paciente">Nome do Paciente</label>
                    <!-- "value" pré-preenche o campo com o valor salvo no banco -->
                    <input type="text" id="paciente" name="paciente" required
                           value="<?= htmlspecialchars($agendamento['paciente']) ?>">
                </div>

                <div class="campo">
                    <label for="medico">Médico</label>
                    <select id="medico" name="medico" required>
                        <option value="">Selecione um médico</option>
                        <?php foreach ($medicos as $nome => $esp): ?>
                            <!-- O ternário abaixo adiciona o atributo "selected" na opção
                                 que corresponde ao médico salvo no banco -->
                            <option value="<?= htmlspecialchars($nome) ?>"
                                    data-especialidade="<?= htmlspecialchars($esp) ?>"
                                    <?= $nome === $agendamento['medico'] ? 'selected' : '' ?>>
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
                            <option value="<?= htmlspecialchars($esp) ?>"
                                    <?= $esp === $agendamento['especialidade'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($esp) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="campo">
                    <label for="data_consulta">Data da Consulta</label>
                    <input type="date" id="data_consulta" name="data_consulta" required
                           value="<?= htmlspecialchars($agendamento['data_consulta']) ?>">
                </div>

                <div class="acoes-form">
                    <button type="submit" class="botao botao_azul">Atualizar Agendamento</button>
                    <a href="index.php" class="botao botao_cinza">Cancelar</a>
                </div>
            </form>
        </div>
    </main>

    <script>
        // Mesmo comportamento do criar.php: escolher um médico preenche a especialidade
        document.getElementById('medico').addEventListener('change', function () {
            var especialidade = this.options[this.selectedIndex].getAttribute('data-especialidade');
            if (especialidade) {
                document.getElementById('especialidade').value = especialidade;
            }
        });
    </script>
</body>
</html>