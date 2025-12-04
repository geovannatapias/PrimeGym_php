<?php
session_start();
if (!isset($_SESSION['aluno_id'])) {
    header("Location: ../login_aluno.php");
    exit;
}

include $_SERVER['DOCUMENT_ROOT'] . '/Somativa_2/bd/conexao_db.php';
include $_SERVER['DOCUMENT_ROOT'] . '/Somativa_2/includes/header.php';

$mensagem = "";

// Processa agendamento
if (isset($_POST['agendar'])) {
    $aluno_id = $_SESSION['aluno_id'];
    $professor_id = $_POST['professor_id'];
    $data_hora = $_POST['data_hora']; // formato: YYYY-MM-DDTHH:MM

    // Separa data e hora
    $data = date('Y-m-d', strtotime($data_hora));
    $hora = date('H:i:s', strtotime($data_hora));

    // Verifica se já existe agendamento para o mesmo professor na mesma hora
    $check = mysqli_query($conn, "SELECT * FROM agendamentos WHERE professor_id='$professor_id' AND data='$data' AND hora='$hora'");
    if (mysqli_num_rows($check) > 0) {
        $mensagem = "<p class='msg-erro'>Professor já está ocupado nesse horário!</p>";
    } else {
        mysqli_query($conn, "INSERT INTO agendamentos (aluno_id, professor_id, data, hora) VALUES ('$aluno_id','$professor_id','$data','$hora')");
        $mensagem = "<p class='msg-sucesso'>Aula agendada com sucesso!</p>";
    }
}

// Lista professores
$professores = mysqli_query($conn, "SELECT * FROM professores");
?>


<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<link rel="stylesheet" href="assets/css/style.css">

<div class="home-container">
    <div class="form-container">
        <h2 class="w3-center">Agendar Aula</h2>

        <?php if ($mensagem) echo $mensagem; ?>

        <form method="post">
            <div class="w3-section">
                <label for="professor_id">Professor:</label>
                <select name="professor_id" id="professor_id" class="w3-input w3-border" required>
                    <option value="">Selecione</option>
                    <?php while ($prof = mysqli_fetch_assoc($professores)): ?>
                        <option value="<?= $prof['id'] ?>"><?= htmlspecialchars($prof['nome']) ?> - <?= htmlspecialchars($prof['especialidade']) ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="w3-section">
                <label for="data_hora">Data e Hora:</label>
                <input type="datetime-local" name="data_hora" id="data_hora" class="w3-input w3-border" required>
            </div>

            <div class="w3-section" style="display: flex; gap: 10px;">
                <button type="submit" name="agendar" class="btn-primary" style="flex:1;">Agendar</button>
                <a href="index.php" class="btn-danger" style="flex:1; display:flex; justify-content:center; align-items:center;">Voltar

                </a>
            </div>
        </form>
    </div>
</div>

<script src="assets/js/script.js"></script>
<?php include '../includes/footer.php'; ?>