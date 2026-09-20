<?php
// DELETE - a operação "D" do CRUD (apagar).
// Este arquivo não tem formulário nem tela: ele só recebe o id, apaga e volta para a lista.

require_once 'conexao.php';

// O id chega pela URL (ex.: excluir.php?id=4), montado pela função JS confirmarExclusao() do index.php.
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // DELETE com placeholder (?) para evitar SQL Injection.
    $sql = "DELETE FROM agendamentos WHERE id = ?";
    $stmt = $pdo->prepare($sql);

    // Executa passando o id. Se houver sucesso, o registro é removido para sempre.
    $stmt->execute([$id]);
}

// Independentemente de sucesso ou erro, redireciona o usuário de volta para a lista.
header('Location: index.php');
exit;