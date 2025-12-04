<?php
include $_SERVER['DOCUMENT_ROOT'] . '/Somativa_2/bd/conexao_db.php';
include '../includes/header.php';

$erro = "";

if (isset($_POST['adicionar'])) {
    $nome = trim($_POST['nome']);
    $especialidade = trim($_POST['especialidade']);
    $telefone = trim($_POST['telefone']);

    if (empty($nome)) {
        $erro = "O nome do professor é obrigatório!";
    } else {
        // Inserir no banco
        mysqli_query($conn, "INSERT INTO professores (nome, especialidade, telefone) VALUES (
            '" . mysqli_real_escape_string($conn, $nome) . "',
            '" . mysqli_real_escape_string($conn, $especialidade) . "',
            '" . mysqli_real_escape_string($conn, $telefone) . "'
        )");

        header("Location: index.php");
        exit;
    }
}
?>

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<div class="home-container">
    <div class="table-container">
        <h2 class="w3-center">Adicionar Professor</h2>

        <?php if ($erro) echo "<p class='msg-erro'>{$erro}</p>"; ?>

        <form method="post">
            <div class="w3-section">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" class="w3-input w3-border" required>
            </div>

            <div class="w3-section">
                <label for="especialidade">Especialidade:</label>
                <input type="text" name="especialidade" id="especialidade" class="w3-input w3-border">
            </div>

            <div class="w3-section">
                <label for="telefone">Telefone:</label>
                <input type="text" name="telefone" id="telefone" class="w3-input w3-border" maxlength="15" placeholder="(XX)XXXXX-XXXX" onkeyup="mask(this, mphone)" required>
            </div>

            <div class="w3-section" style="display:flex; gap:10px;">
                <button type="submit" name="adicionar" class="btn-primary" style="flex:1;">Adicionar</button>
                <a href="index.php" class="btn-danger" style="flex:1; display:flex; justify-content:center; align-items:center;">Cancelar</a>
            </div>
        </form>
    </div>
</div>
<script src="/Somativa_2/assets/js/script.js" defer></script>
<?php include '../includes/footer.php'; ?>