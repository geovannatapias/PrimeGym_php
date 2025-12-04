<?php
session_start();

if(!isset($_SESSION['aluno_id'])){
    header("Location: login_aluno.php");
    exit;
}

include 'includes/header.php';
?>

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<div class="home-container">
    <div class="form-container">
        <h2 class="w3-center">Bem-vindo, <?= htmlspecialchars($_SESSION['aluno_nome']) ?>!</h2>

        <div class="dashboard-links">
            <p><a href="professores/index.php" class="btn-link">Professores Disponíveis</a></p>
            <p><a href="agendamentos/agendar.php" class="btn-link">Agendar Aula</a></p>
            <p><a href="agendamentos/index.php" class="btn-link">Meus Agendamentos</a></p>
        </div>

        <p style="text-align:center; margin-top:20px;">
            <a href="logout.php" class="btn-danger">Sair</a>
        </p>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
