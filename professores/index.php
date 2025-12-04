<?php
include $_SERVER['DOCUMENT_ROOT'].'/Somativa_2/bd/conexao_db.php';
include $_SERVER['DOCUMENT_ROOT'].'/Somativa_2/includes/header.php';


$result = mysqli_query($conn, "SELECT * FROM professores");
?>


<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<div class="home-container">
    <div class="table-container">
        <h2 class="w3-center">Professores</h2>

        <p style="text-align:right; margin-bottom:15px;">
            <a href="adicionar.php" class="btn-primary">Adicionar Novo</a>
        </p>

        <div class="table-responsive">
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Especialidade</th>
                        <th>Telefone</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($prof = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= htmlspecialchars($prof['nome']) ?></td>
                        <td><?= htmlspecialchars($prof['especialidade']) ?></td>
                        <td><?= htmlspecialchars($prof['telefone']) ?></td>
                        <td>
                            <a href="editar.php?id=<?= $prof['id'] ?>" class="btn-link">Editar</a>
                            <a href="deletar.php?id=<?= $prof['id'] ?>" class="btn-danger" onclick="return confirm('Tem certeza que deseja deletar?')">Deletar</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'].'/Somativa_2/includes/footer.php'; ?>
