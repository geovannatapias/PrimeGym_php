<?php
session_start();
include 'includes/header.php';
?>


<div class="home-container">
    <div class="table-container">
        <h1>Seja Bem-vindo(a) à Prime Gym</h1>
        <p>Faça login para acessar seus agendamentos ou cadastre-se:</p>
        <br> 
        <div class="home-buttons" style="display:flex; justify-content:center; gap:20px; margin-top:10px;">
            <a href="login_aluno.php" class="btn-primary">Login</a>
            <a href="cadastro_aluno.php" class="btn-primary">Cadastre-se</a>
        </div>

        <?php if(isset($_SESSION['aluno_nome'])): ?>
            <div class="user-greeting">
                <p>Olá, <strong><?php echo htmlspecialchars($_SESSION['aluno_nome']); ?></strong>! 
                <a href="logout.php">Sair</a></p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
