<?php 
	require_once 'gerencia_login.php';
	
?>
<!DOCTYPE html>
<html class="ls-theme-green">
  <head>
    <title>EasyCad</title>

    <?php require_once('assets.php');?>
    
  </head>
  <body>

    <?php require_once('header.php');?>

    <?php require_once('aside.php');?>

    <main class="ls-main ">
      <div class="container-fluid">
        <h1 class="ls-title-intro ls-ico-user-add">Cadastro de Participante</h1>
        <form method="post" action="cadParticipante.php">
        	<!-- Colocar com as abas "Pessoa","Empresa" e "Apoio" -->
        	<input type="submit" value="Cadastrar">
        </form>
        
      </div>
      <?php require_once('footer.php');?>
    </main>

    <?php require_once('assets-footer.php');?>

  </body>
</html>