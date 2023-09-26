<?php
  session_start();

  if (isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha'])) {
    include_once('bdConnection.php');

    //Recebendo os dados inseridos 
    $email=($_POST['email']);
    $senha = ($_POST['senha']);
    
    //Executa a query
    $selection = "SELECT `id`, `nome`, `nivel` FROM usuarios WHERE email = '$email' AND senha = '$senha' LIMIT 1";
    $result = $conexao->query($selection);

    if (mysqli_num_rows($result)<1) {
      //Se retornar 0, entao o usuario e/ou senha nao existe
      unset($_POST['email']);
      unset($_POST['senha']);
      header('Location: ../index.html'); exit;
    }
    else {
      //Usuario existente, salva os dados do usuario
      $keepdata = mysqli_fetch_assoc($result);

      // Se a sessão não existir, inicia uma sessao
      if (!isset($_SESSION)) session_start();

      // Salva os dados encontrados na sessão
      $_SESSION['id'] = $keepdata['id'];
      $_SESSION['nome'] = $keepdata['nome'];
      $_SESSION['nivel'] = $keepdata['nivel'];

      #Direcionando a pagina segundo o nivel de acesso
      if ($_SESSION['nivel'] == 2) {
        header('Location: ../pages/admin.php'); exit;
      }
      else if ($_SESSION['nivel'] == 1) {
        header('Location: ../pages/usuario.php'); exit;
      }
    }
  }
  else{
    header('Location: ../index.html');
  }
?>