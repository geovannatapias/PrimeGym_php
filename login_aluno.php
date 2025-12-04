<?php
session_start();
include 'bd/conexao_db.php';
include 'includes/header.php';

$erro = "";

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $senha = $_POST['senha'];

    // Verifica se o email existe no banco
    $stmt = $conn->prepare("SELECT * FROM alunos WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $aluno = $result->fetch_assoc();

    if ($aluno && password_verify($senha, $aluno['senha'])) {
        // Login bem-sucedido
        $_SESSION['aluno_id'] = $aluno['id'];
        $_SESSION['aluno_nome'] = $aluno['nome'];
        header("Location: dashboard_aluno.php");
        exit;
    } else {
        $erro = "Email ou senha inválidos!";
    }
}
?>

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<div class="home-container">
    <div class="form-container">
        <h2 class="w3-center">Login do Aluno</h2>

        <?php if ($erro): ?>
            <p class="w3-text-red" style="text-align:center;"><?php echo $erro; ?></p>
        <?php endif; ?>

        <form method="post">
            <div class="w3-section">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="w3-input w3-border" placeholder="email@exemplo.com" required>
            </div>

            <div class="w3-section">
                <label for="senhaLogin">Senha:</label>
                <input type="password" name="senha" id="senhaLogin" class="w3-input w3-border" placeholder="Senha" required>
            </div>

            <label>
                <input type="checkbox" onclick="mostrarOcultarSenhaLogin()">
                Mostrar senha
            </label>

            <div class="w3-section">
                <button type="submit" name="login" class="btn-link">Entrar</button>
                <a href="index.php" class="btn-danger">Voltar</a>
            </div>
        </form>

        <p style="text-align:center;">Não tem conta? <a href="cadastro_aluno.php">Registre-se</a></p>
    </div>
</div>
<script src="assets/js/script.js"></script>
<?php include 'includes/footer.php'; ?>