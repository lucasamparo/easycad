<?php 
	//require_once 'gerencia_login.php';
	require_once('../models/bootstrap.php');
	
	if(isset($_POST['cod'])){
		$c = new Certificado();
		$c->setCodigo($_POST['cod']);
		$cert = $c->retornarCertificadoPorValidador();
		if(!$cert){
			$mensagem = "Código de Certificado Inválido!";
		}
	}
?>
<!DOCTYPE html>
<html class="ls-theme-green">
  <head>
    <title>EasyCad</title>

    <?php require_once('assets.php');?>
  
  </head>
  <body>
      <div class="container-fluid">
      	<div class="col-lg-12 col-xs-12 ls-txt-center">
			<img src="images/easycad.png" width="150" height="60" style="margin-right:20px;">
			<img src="images/eambjr.png" width="150" height="60" style="margin-left:20px;">
		</div>
        
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
        		if(!$cert){

              echo '<div class="col-lg-12 col-xs-12 ls-txt-center" style="margin-top:80px; background-color:#c0392b;">';
                echo '<p style="color:#FFFFFF; font-size:20px; padding:10px;">'.$mensagem.'</p>';
              echo '</div>';

        			
        		} else {
        			echo '<div class="col-lg-12 col-xs-12 ls-txt-center" style="margin-top:80px; background-color:#1AB551;">';
        				echo '<p style="color:#FFFFFF; font-size:20px; padding:10px;">Certificado emitido para <b>'.$cert->getMatricula()->getEntidade()->getNomeEntidade().'</b>, no dia <b>'.Util::arrumaData($cert->getDataEmissao()).'</b></p>';
        			echo '</div>';
        		}
        	}
        ?>
      </div>    
    <?php require_once('assets-footer.php');?>

  </body>
</html>