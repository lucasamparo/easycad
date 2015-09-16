<?php 
	require_once 'gerencia_login.php';
	
	$e = new Empresa();
	$empresa = $e->retornarEmpresa();
	if(isset($_POST['nome'])){
		$e = new Empresa();
		$e->setNomeFantasia(utf8_decode($_POST['nome']));
		$e->setRazaoSocial(utf8_decode($_POST['razao']));
		$e->setResponsavel(utf8_decode($_POST['responsavel']));
		$e->setCnpj($_POST['cnpj']);
		$e->alterarEmpresa();
	}
?>
<!DOCTYPE html>
<html class="ls-theme-green">
  <head>
    <title>EasyCad</title>

    <?php require_once('assets.php');?>
    
    <script language="JScript">
      $(document).ready(function (){
        $("#cnpj").mask("99.999.999/9999-99");
      });

    </script>

  </head>
  <body>

    <?php require_once('header.php');?>

    <?php require_once('aside.php');?>

    <main class="ls-main ">
      <div class="container-fluid">
        <h1 class="ls-title-intro ls-ico-home">Meus Dados</h1>
        <!-- Conteúdo -->
        
        <div class="col-lg-12 col-xs-12">
          <form method="post" class="ls-form ls-form-horizontal row" action="dadosEmpresa.php">

            <label class="ls-label col-lg-12 col-xs-12">
                <b class="ls-label-text">Nome Fantasia:</b>
                <input type="text" name="nome" value="<?= utf8_encode($empresa->getNomeFantasia())?>" class="ls-field">
              </label>
              <label class="ls-label col-lg-6 col-xs-12">
                <b class="ls-label-text">Razão Social:</b>
                <input type="text" name="razao" value="<?= utf8_encode($empresa->getRazaoSocial())?>" class="ls-field">
              </label>
              <label class="ls-label col-lg-6 col-xs-12">
                <b class="ls-label-text">Responsável Legal:</b>
                <input type="text" name="responsavel" value="<?= utf8_encode($empresa->getResponsavel())?>" class="ls-field">
              </label>
              <label class="ls-label col-lg-6 col-xs-12">
                <b class="ls-label-text">CNPJ:</b>
                <input type="text" name="cnpj" id="cnpj" value="<?= $empresa->getCNPJ()?>" class="ls-field">
              </label>
              <label class="ls-label col-lg-6 col-xs-12">
                <b class="ls-label-text">Login:</b>
                <input type="text" name="login" value="<?= $empresa->getLogin()?>" readonly class="ls-field">
              </label>
                            
            <input type="submit" value= "Salvar" class="ls-btn-primary ls-btn-lg ls-text-uppercase col-lg-4 col-xs-11 col-lg-push-4" id="sub">    
                
          </form>
        </div>
        
        <!-- Fim Conteúdo -->
      </div>
    </main>

    <?php require_once('assets-footer.php');?>

  </body>
</html>