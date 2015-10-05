<?php 
	require_once 'gerencia_Login.php';
	
	if(isset($_POST['cod'])){
		$c = new Certificado();
		$c->setCodigo($_POST['cod']);
		$cert = $c->retornarCertificadoPorValidador();
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
        <h1 class="ls-title-intro ls-ico-home">Validação de Certificado</h1>
        
        <div class="col-lg-12 col-xs-12">
          <form method="post" class="ls-form ls-form-horizontal row" action="validaCert.php">

            <label class="ls-label col-lg-12 col-xs-12">
                <b class="ls-label-text">Código do Certificado:</b>
                <input type="text" name="cod" class="ls-field" placeholder="Código do Certificado">
            </label>

        	  <input type="submit" value= "Validar" class="ls-btn-primary ls-btn-lg ls-text-uppercase col-lg-4 col-xs-11 col-lg-push-4">
          </form>
        </div>
        
        <?php 
        	if(isset($cert)){
        		echo '<div>';
        			//echo '<label>'.$cert->getMatricula()->getEntidade()->getNomeEntidade().'<label>';
        			echo '<p>Certificado emitido para '.$cert->getMatricula()->getEntidade()->getNomeEntidade().', no dia .'.Util::arrumaData($cert->getDataEmissao()).'</p>';
        		echo '</div>';
        	}
        ?>
      </div>
      <?php require_once('footer.php');?>
    </main>

    
    <?php require_once('assets-footer.php');?>

  </body>
</html>