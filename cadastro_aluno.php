<?php
session_start();
include 'bd/conexao_db.php';
include 'includes/header.php';

$erro = "";

if (isset($_POST['registrar'])) {
    // Pegando dados do formulário
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $celular = trim($_POST['telefone']);
    $senha = $_POST['senha'];
    $senha_confirmacao = $_POST['senha_confirmacao'];

    // Regex para senha segura: mínimo 8 caracteres, letras maiúsculas, minúsculas, número e caracter especial
    $regexSenha = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$/';

    // Confere se as senhas coincidem
    if ($senha !== $senha_confirmacao) {
        $erro = "As senhas não coincidem!";
    }
    // Confere complexidade da senha
    elseif (!preg_match($regexSenha, $senha)) {
        $erro = "Senha deve ter pelo menos 8 caracteres, incluindo maiúscula, minúscula, número e caracter especial.";
    } else {
        // Verifica se o email já existe
        $stmt = $conn->prepare("SELECT id FROM alunos WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $erro = "Email já cadastrado!";
        } else {
            // Cria hash da senha
            $hashSenha = password_hash($senha, PASSWORD_DEFAULT);

            // Insere no banco
            $stmtInsert = $conn->prepare("INSERT INTO alunos (nome, email, celular, senha) VALUES (?, ?, ?, ?)");
            $stmtInsert->bind_param("ssss", $nome, $email, $celular, $hashSenha);

            if ($stmtInsert->execute()) {
                // Login automático
                $_SESSION['aluno_id'] = $stmtInsert->insert_id;
                $_SESSION['aluno_nome'] = $nome;

                // Redireciona para dashboard
                header("Location: dashboard_aluno.php");
                exit;
            } else {
                $erro = "Erro ao registrar. Tente novamente!";
            }
        }
    }
}
?>

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<div class="home-container">
    <div class="form-container">
        <h2 class="w3-center">Cadastro de Aluno</h2>

        <?php if ($erro): ?>
            <p class="w3-text-red" style="text-align:center;"><?php echo $erro; ?></p>
        <?php endif; ?>

       <form method="post" onsubmit="return validarSenhaCadastro()">
            <div class="w3-section">
                <label for="nome">Nome completo</label>
                <input type="text" name="nome" id="nome" class="w3-input w3-border" placeholder="Seu nome" required>
            </div>

            <div class="w3-section">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="w3-input w3-border" placeholder="email@exemplo.com" required>
            </div>

            <div class="w3-section">
                <label for="telefone">Celular</label>
                <input type="text" name="telefone" id="telefone" class="w3-input w3-border"
                    maxlength="15" placeholder="(XX)XXXXX-XXXX"
                    onkeyup="mask(this, mphone)" required>
            </div>

            <div class="w3-section">
                <label for="senhaCadastro">Senha:</label>
                <input type="password" name="senha" id="senhaCadastro" class="w3-input w3-border" placeholder="Senha" required>
            </div>

            <div class="w3-section">
                <label for="senhaConfirmacao">Confirmar Senha</label>
                <input type="password" name="senha_confirmacao" id="senhaConfirmacao" class="w3-input w3-border" placeholder="Confirmar senha" required>
            </div>

            <div class="w3-section">
                <input type="checkbox" onclick="mostrarOcultarSenhaCadastro()"> Mostrar senha
            </div>

            <div class="w3-section">
                <button type="submit" name="registrar" class="btn-link">Cadastrar</button>
                <a href="index.php" class="btn-danger">Voltar</a>
            </div>
        </form>

        <p style="text-align:center;">Já tem conta? <a href="login_aluno.php">Faça login</a></p>
    </div>
</div>
<script src="assets/js/script.js"></script>
<?php include 'includes/footer.php'; ?>