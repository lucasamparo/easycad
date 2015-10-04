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
        <form method="post" action="validaCert.php">
        	<label>Código do Certificado:</label>
        	<input type="text" name="cod">
        	<input type="submit">
        </form>
        
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