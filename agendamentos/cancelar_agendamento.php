<?php
session_start();
if (!isset($_SESSION['aluno_id'])) {
    header("Location: ../login_aluno.php");
    exit;
}

include $_SERVER['DOCUMENT_ROOT'] . '/Somativa_2/bd/conexao_db.php';

// Pega o ID do agendamento
if (isset($_GET['id'])) {
    $agendamento_id = intval($_GET['id']); // força ser inteiro
    $aluno_id = $_SESSION['aluno_id'];

    // Deleta apenas se o agendamento pertencer ao aluno logado
    $stmt = $conn->prepare("DELETE FROM agendamentos WHERE id = ? AND aluno_id = ?");
    $stmt->bind_param("ii", $agendamento_id, $aluno_id);

    if ($stmt->execute()) {
        $_SESSION['mensagem'] = "<p class='msg-sucesso'>Agendamento cancelado com sucesso!</p>";
    } else {
        $_SESSION['mensagem'] = "<p class='msg-erro'>Erro ao cancelar o agendamento.</p>";
    }
}


header("Location: index.php");
exit;
