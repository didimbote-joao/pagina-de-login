<?php
  #Inicia a sessao
  if (!isset($_SESSION)) {
    session_start();
  }
  
  #Define o nivel de acesso
  $nivel_requerido = 1; 
  
  #Verifica a existencia de um ID e analisa o nivel de acesso
  if (!isset($_SESSION['id']) || $_SESSION['nivel'] != $nivel_requerido) {
    // Destrói a sessão por segurança
    session_destroy();
    // Redireciona o visitante de volta pra login
    header("Location: ../index.html"); exit;
  }
  #Caso exista ID, analisa o nivel de acesso
  // else if($_SESSION['nivel'] != $nivel_requerido){
  //   // Destrói a sessão por segurança
  //   session_destroy();
  //   // Redireciona o visitante de volta pra login
  //   header("Location: ../index.html"); exit;
  // }
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Usuario</title>
  </head>
  <body>
    <a href="../php/logout.php">Sair</a>
    <p>Hello, <?php echo $_SESSION['nome'];?> - Usuario </p>
  </body>
</html>
