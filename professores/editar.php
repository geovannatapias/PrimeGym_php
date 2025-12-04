<?php
include $_SERVER['DOCUMENT_ROOT'] . '/Somativa_2/bd/conexao_db.php';
include '../includes/header.php';

// Verifica se o ID foi passado
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];

// Buscar dados do professor
$result = mysqli_query($conn, "SELECT * FROM professores WHERE id='$id'");
$prof = mysqli_fetch_assoc($result);

if (!$prof) {
    echo "<p>Professor não encontrado!</p>";
    exit;
}

// Atualizar professor
if (isset($_POST['editar'])) {
    $nome = trim($_POST['nome']);
    $especialidade = trim($_POST['especialidade']);
    $telefone = trim($_POST['telefone']);

    mysqli_query($conn, "UPDATE professores 
                         SET nome='$nome', especialidade='$especialidade', telefone='$telefone' 
                         WHERE id='$id'");

    header("Location: index.php");
    exit;
}
?>

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<div class="home-container">
    <div class="table-container">
        <h2 class="w3-center">Editar Professor</h2>

        <form method="post">
            <div class="w3-section">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" class="w3-input w3-border" value="<?= htmlspecialchars($prof['nome']) ?>" required>
            </div>

            <div class="w3-section">
                <label for="especialidade">Especialidade:</label>
                <input type="text" name="especialidade" id="especialidade" class="w3-input w3-border" value="<?= htmlspecialchars($prof['especialidade']) ?>">
            </div>

            <div class="w3-section">
                <label for="telefone">Telefone:</label>
                <input type="text" name="telefone" id="telefone" class="w3-input w3-border" maxlength="15" placeholder="(XX)XXXXX-XXXX" onkeyup="mask(this, mphone)" value="<?= htmlspecialchars($prof['telefone']) ?>" required>
            </div>
            <div class="w3-section" style="display: flex; gap: 10px;">
                <!-- Botão Salvar -->
                <button type="submit" name="editar" class="btn-primary" style="flex:1;">Salvar</button>
                <!-- Botão Cancelar -->
                <a href="index.php" class="btn-danger" style="flex:1; display:flex; justify-content:center; align-items:center;">Cancelar</a>
            </div>
        </form>
    </div>
</div>
<script src="/assets/js/script.js"></script>
<?php include '../includes/footer.php'; ?>
