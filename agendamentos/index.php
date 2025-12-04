<?php
session_start();
if (!isset($_SESSION['aluno_id'])) {
    header("Location: ../login_aluno.php");
    exit;
}

include $_SERVER['DOCUMENT_ROOT'] . '/Somativa_2/bd/conexao_db.php';
include $_SERVER['DOCUMENT_ROOT'] . '/Somativa_2/includes/header.php';

// Exibe mensagem de feedback, se existir
if (isset($_SESSION['mensagem'])) {
    echo $_SESSION['mensagem'];
    unset($_SESSION['mensagem']);
}

// Busca agendamentos do aluno
$aluno_id = $_SESSION['aluno_id'];

$result = mysqli_query($conn, "
    SELECT 
        a.id, 
        CONCAT(a.data, ' ', a.hora) AS data_hora,
        p.nome AS professor
    FROM agendamentos a
    JOIN professores p ON a.professor_id = p.id
    WHERE a.aluno_id = '$aluno_id'
    ORDER BY a.data ASC, a.hora ASC
");
?>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<div class="home-container">
    <div class="table-container">
        <h2 class="w3-center">Meus Agendamentos</h2>

        <div class="table-responsive">
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>Professor</th>
                        <th>Data e Hora</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($result) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['professor']) ?></td>
                                <td><?= date("d/m/Y H:i", strtotime($row['data_hora'])) ?></td>
                                <td>
                                    <!-- Botão de cancelar usando link para cancelar_agendamento.php -->
                                    <a href="cancelar_agendamento.php?id=<?= $row['id'] ?>"
                                       onclick="return confirm('Tem certeza que deseja cancelar esta aula?');"
                                       class="btn-delete">
                                       Cancelar
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" style="text-align:center;">Você não tem nenhuma aula agendada.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="assets/js/script.js"></script>
<?php include '../includes/footer.php'; ?>
