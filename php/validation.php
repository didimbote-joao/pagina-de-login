<?php
  session_start();

  if (isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha'])) {
    include_once('bdConnection.php');

    //Recebendo os dados inseridos 
    $email=($_POST['email']);
    $senha = ($_POST['senha']);
    
    //Executa a query
    $selection = "SELECT TOP 1 `id`, `nome`, `nivel` FROM usuarios WHERE email = '$email' AND senha = '$senha'";
    $result = $conexao->query($selection);

    if (mysqli_num_rows<1) {
      //Se retornar 0, entao o usuario e/ou senha nao existe
      unset($_POST['email']);
      unset($_POST['senha']);
      header('Location: index.html'); exit;
    }
    else {
      //Usuario existente, salva os dados do usuario
      $keepdata = mysqli_fetch_assoc($result);

      // Se a sessão não existir, inicia uma sessao
      if (!isset($_SESSION)) session_start();

      // Salva os dados encontrados na sessão
      $_SESSION['ID'] = $result['id'];
      $_SESSION['nome'] = $result['nome'];
      $_SESSION['nivel'] = $result['nivel'];

      #Direcionando a pagina segundo o nivel de acesso
      if ($_SESSION['nivel'] == 2) {
        header('Location: admin.html'); exit;
      }
      else if ($_SESSION['nivel'] == 1) {
        header('Location: usuario.html'); exit;
      }
    }
  }
?>