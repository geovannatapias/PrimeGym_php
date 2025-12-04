<?php
include $_SERVER['DOCUMENT_ROOT'] . '/Somativa_2/bd/conexao_db.php';
include '../includes/header.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

// Deletar professor
$stmt = $conn->prepare("DELETE FROM professores WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

// Redirecionar para lista
header("Location: index.php");
exit;
