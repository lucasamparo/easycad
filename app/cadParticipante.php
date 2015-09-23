<?php 
	require_once 'gerencia_login.php';
	
	if(isset($_POST['nome_pf']) || isset($_POST['nome_pj'])){
		$e = new Entidade();
		if($_POST['cpf'] != ''){
			//Pessoa Física
			$e->setNomeEntidade($_POST['nome_pf']);
			$e->setTelefone($_POST['telefone_pf']);
			$e->setEmail($_POST['email_pf']);
			$e->setCnpjCpf($_POST['cpf']);
			$e->setTipo('PF');
		} else {
			//Pessoa Jurídica
			$e->setNomeEntidade($_POST['nome_pj']);
			$e->setTelefone($_POST['telefone_pj']);
			$e->setEmail($_POST['email_pj']);
			$e->setCnpjCpf($_POST['cnpj']);
			$e->setTipo('PJ');
		}
		$e->inserirEntidade();
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
        <h1 class="ls-title-intro ls-ico-user-add">Cadastro de Participante</h1>
        <form method="post" action="cadParticipante.php">
        	<!-- Abas => Pessoa Física e Pessoa Jurídica. Vou "pré-separar" por div. -->
        	<div id="pFisica">
        		<fieldset>
        			<legend>Pessoa Física</legend>
	        		<label>Nome:</label>
	        		<input type="text" name="nome_pf"><br>
	        		<label>CPF:</label>
	        		<input type="text" name="cpf"><br>
	        		<label>Telefone:</label>
	        		<input type="text" name="telefone_pf"><br>
	        		<label>e-Mail:</label>
	        		<input type="text" name="email_pf"><br>
        		</fieldset>
        		
        	</div>        	
        	<div id="pJuridica">
        		<fieldset>
        			<legend>Pessoa Jurídica</legend>
	        		<label>Nome:</label>
	        		<input type="text" name="nome_pj"><br>
	        		<label>CNPJ:</label>
	        		<input type="text" name="cnpj"><br>
	        		<label>Telefone:</label>
	        		<input type="text" name="telefone_pj"><br>
	        		<label>e-Mail:</label>
	        		<input type="text" name="email_pj"><br>
        		</fieldset>
        	</div>
        	<input type="submit" value="Cadastrar">
        </form>
        
      </div>
      <?php require_once('footer.php');?>
    </main>

    <?php require_once('assets-footer.php');?>

  </body>
</html>