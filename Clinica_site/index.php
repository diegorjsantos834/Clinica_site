<?php
// Inclui o arquivo de conexão para usar a variável $pdo (o objeto que fala com o banco).
require_once 'conexao.php';

// READ - a operação "R" do CRUD (ler/listar).
// query() executa um SQL que não recebe valores externos. Busca todos os agendamentos,
// ordenando pela data mais recente primeiro e, no mesmo dia, pelo id mais novo.
$stmt = $pdo->query("SELECT * FROM agendamentos ORDER BY data_consulta DESC, id DESC");

// fetchAll(PDO::FETCH_ASSOC) transforma cada registro do banco em um array
// associativo tipo: ['id' => 1, 'paciente' => 'João', ...]. Tudo vira um array de agendamentos.
$agendamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clínica Médica - Agendamentos</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <span class="simbolo">+</span>
        <h1>Clínica Médica - Agendamento de Consultas</h1>
    </header>

    <main>
        <div class="card">
            <div class="toolbar">
                <h2>Consultas Agendadas</h2>
                <a href="criar.php" class="botao botao_verde">Novo Agendamento</a>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Paciente</th>
                        <th>Médico</th>
                        <th>Especialidade</th>
                        <th>Data da Consulta</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($agendamentos) === 0): ?>
                        <!-- Se o banco estiver vazio, mostra um aviso ocupando as 6 colunas -->
                        <tr>
                            <td colspan="6" class="aviso">Nenhum agendamento cadastrado.</td>
                        </tr>
                    <?php else: ?>
                        <!-- Laço de repetição: para cada agendamento, imprime uma linha da tabela -->
                        <?php foreach ($agendamentos as $agendamento): ?>
                        <tr>
                            <!-- data-rotulo serve apenas para a versão responsiva do site -->
                            <td data-rotulo="ID"><?= $agendamento['id'] ?></td>

                            <!-- htmlspecialchars() protege contra ataques XSS:
                                 se o usuário digitar <script> ele vira &lt;script&gt; e não executa -->
                            <td data-rotulo="Paciente"><?= htmlspecialchars($agendamento['paciente']) ?></td>
                            <td data-rotulo="Médico"><?= htmlspecialchars($agendamento['medico']) ?></td>
                            <td data-rotulo="Especialidade">
                                <span class="etiqueta"><?= htmlspecialchars($agendamento['especialidade']) ?></span>
                            </td>

                            <!-- O banco guarda a data no formato YYYY-MM-DD (padrão do MySQL).
                                 date() + strtotime() convertem para DD/MM/YYYY na hora de mostrar -->
                            <td data-rotulo="Data"><?= date('d/m/Y', strtotime($agendamento['data_consulta'])) ?></td>

                            <td class="acoes" data-rotulo="Ações">
                                <!-- Link de edição passando o ID na URL (método GET): editar.php?id=4 -->
                                <a href="editar.php?id=<?= $agendamento['id'] ?>" class="botao botao_azul botao_pequeno">Editar</a>

                                <!-- Botão que chama a função JS abaixo para confirmar antes de excluir -->
                                <button onclick="confirmarExclusao(<?= $agendamento['id'] ?>)" class="botao botao_vermelho botao_pequeno">Excluir</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>

    <script>
        // Função JS: só apaga do banco se o usuário confirmar no "pop-up"
        function confirmarExclusao(id) {
            if (confirm("Tem certeza que deseja excluir este agendamento? Esta ação não pode ser desfeita.")) {
                // Redireciona para o excluir.php levando o ID na URL
                window.location.href = "excluir.php?id=" + id;
            }
        }
    </script>
</body>
</html>