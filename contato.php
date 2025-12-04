<?php
include 'includes/header.php';


$contato = [
  "endereco" => "Av. Fitness, 123 - Centro, São Paulo, SP",
  "telefone" => "(11) 98765-4321",
  "email" => "contato@primegym.com.br",
  "horario" => "Segunda a Sexta: 6h - 22h | Sábado: 8h - 18h | Domingo: Fechado",
];
?>

<div class="home-container">
  <div class="form-container contato-box">
    <h2 class="w3-center">FALE CONOSCO</h2>
    <p style="text-align:center;">Estamos prontos para ajudar você a atingir seus objetivos. Entre em contato com a Prime Gym pelos canais abaixo:</p>

    <div class="info-contato">
      <p><strong>Endereço:</strong> <?php echo $contato['endereco']; ?></p>
      <p><strong>Telefone:</strong> <?php echo $contato['telefone']; ?></p>
      <p><strong>Email:</strong> <a href="mailto:<?php echo $contato['email']; ?>"><?php echo $contato['email']; ?></a></p>
      <p><strong>Horário de Funcionamento:</strong> <?php echo $contato['horario']; ?></p>
    </div>
  </div>
</div>

<?php
include 'includes/footer.php';
?>