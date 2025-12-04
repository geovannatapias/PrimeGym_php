
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prime Gym</title>
    <link rel="stylesheet" href="/Somativa_2/assets/css/style.css">
</head>
<body>
    <header>
    <nav class="navbar">
        <a href="/Somativa_2/index.php" class="logo">Prime Gym</a>
        <ul class="nav-links">
            <?php if(isset($_SESSION['aluno_id'])): ?>
         
                <li><a href="/Somativa_2/dashboard_aluno.php">Área do Aluno</a></li>
                <li><a href="/Somativa_2/logout.php">Sair</a></li>
            <?php else: ?>
              
                <li><a href="/Somativa_2/index.php">Home</a></li>
                <li><a href="/Somativa_2/contato.php">Contato</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
