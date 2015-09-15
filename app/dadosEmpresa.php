<?php 
	require_once 'gerencia_login.php';
	
	$e = new Empresa();
	$empresa = $e->retornarEmpresa();
	if(isset($_POST['nome'])){
		$e = new Empresa();
		$e->setNomeFantasia($_POST['nome']);
		$e->setRazaoSocial($_POST['razao']);
		$e->setResponsavel($_POST['responsavel']);
		$e->setCnpj($_POST['cnpj']);
		$e->alterarEmpresa();
	}
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
        <h1 class="ls-title-intro ls-ico-home">Meus Dados</h1>
        <!-- Conteúdo -->
        <form method="post" action="dadosEmpresa.php">
        	<label>Nome Fantasia:</label>
        	<input type="text" name="nome" value="<?= $empresa->getNomeFantasia()?>"><br>
        	<label>Razão Social:</label>
        	<input type="text" name="razao" value="<?= $empresa->getRazaoSocial()?>"><br>
        	<label>Nome Responsável:</label>
        	<input type="text" name="responsavel" value="<?= $empresa->getResponsavel()?>"><br>
        	<label>CNPJ:</label>
        	<input type="text" name="cnpj" value="<?= $empresa->getCNPJ()?>"><br>
        	<label>Login:</label>
        	<input type="text" name="login" value="<?= $empresa->getLogin()?>" readonly><br>
        	<input type="submit" value="Salvar">
        </form>
        
        <!-- Fim Conteúdo -->
      </div>
    </main>

    <?php require_once('assets-footer.php');?>

  </body>
</html>