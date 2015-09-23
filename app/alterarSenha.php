<?php 
	require_once 'gerencia_login.php';
?><!DOCTYPE html>
<html class="ls-theme-green">
  <head>
    <title>EasyCad</title>

    <?php require_once('assets.php');?>
    <script type="text/javascript">
		$(document).ready(function(){
			$('#password_field2').focus(function(){
				$('#password_field2').val("");
			});
		});
    </script>
  </head>
  <body>

    <?php require_once('header.php');?>

    <?php 
    	require_once('aside.php');
    	
    	if(isset($_POST['senhaAntiga'])){
    		if(md5($_POST['senhaAntiga']) == $empresa->getSenha()){
    			$empresa->alterarSenha($_POST['novaSenha']);
    		} else {
    			$mensagem = 'Senha Antiga não confere.';
    		}
    	}
    ?>

    <main class="ls-main ">
      <div class="container-fluid">
        <h1 class="ls-title-intro ls-ico-cog">Alterar Senha</h1>
        <!-- Conteúdo -->
        
        <!-- <div class="ls-box">
          <div class="col-lg-12 col-xs-12">
            <form method="post" class="ls-form ls-form-horizontal row" action="dadosEmpresa.php">

              <label class="ls-label col-lg-12 col-xs-12">
                  <b class="ls-label-text">Nome Fantasia:</b>
                  <input type="text" name="nome" value="<?= utf8_encode($empresa->getNomeFantasia())?>" class="ls-field">
                </label>
                <label class="ls-label col-lg-6 col-xs-12">
                  <b class="ls-label-text">RazÃ£o Social:</b>
                  <input type="text" name="razao" value="<?= utf8_encode($empresa->getRazaoSocial())?>" class="ls-field">
                </label>
                <label class="ls-label col-lg-6 col-xs-12">
                  <b class="ls-label-text">ResponsÃ¡vel Legal:</b>
                  <input type="text" name="responsavel" value="<?= utf8_encode($empresa->getResponsavel())?>" class="ls-field">
                </label>
                <label class="ls-label col-lg-6 col-xs-12">
                  <b class="ls-label-text">CNPJ:</b>
                  <input type="text" name="cnpj" id="cnpj" value="<?= $empresa->getCNPJ()?>" class="ls-field">
                </label>
                <label class="ls-label col-lg-6 col-xs-12">
                  <b class="ls-label-text">Login:</b>
                  <input type="text" name="login" value="<?= $empresa->getLogin()?>" readonly class="ls-field" style="background-color:#e3e3e3;">
                </label>
                              
              <input type="submit" value= "Alterar" class="ls-btn-primary ls-btn-lg ls-text-uppercase col-lg-4 col-xs-11 col-lg-push-4" id="sub">    
                  
            </form>
          </div>
        </div> -->

        
        <table class="ls-table ls-table-striped">
	  		<tbody>
	    		<tr>
	     			<td><strong>Usuário: </strong> <?= $empresa->getLogin()?></td>
    		</tr>
    		<tr>
      			<td>
        			<strong>Senha: </strong>
        			<input type="password" maxlength="20" id="password_field2" name="senha" class="ls-no-style-input" value="***********" >
        			<a href="#" data-ls-module="modal" class="ls-btn-primary ls-float-right" data-target="#changePassword">Alterar</a>
      			</td>
    		</tr>
  			</tbody>
		</table>


<div id="changePassword" class="ls-modal fade">
  <div class="ls-modal-box">
    <div class="ls-modal-content">
      <div class="ls-modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">Ã—</button>
        <h3 id="title_change_pass">Alteração de senha</h3>
      </div>
      <form action="#" class="ls-form ls-form-horizontal validate" method="post" >
        <div class="ls-modal-body">
          <div class="ls-alert ls-alert-warning" role="alert">
            <p>Ao alterar a senha, <strong>lembre-se</strong> de escolher uma senha <strong>segura</strong>.
            <strong>Recomenda-se:</strong> Senha entre 8 a 14 caracteres, contendo letras e números.</p>
          </div>

          <label class="ls-label">
            <b class="ls-label-text">Senha antiga:</b>
            <input class="password auto-focus required" required type="password" name="senhaAntiga">
          </label>

          <label class="ls-label">
            <b class="ls-label-text">Nova senha:</b>
            <input class="password required" required type="password" name="novaSenha">
          </label>

          <label class="ls-label">
            <b class="ls-label-text">Confirmar Nova senha:</b>
            <input class="password required" required type="password" name="confirmarNovaSenha">
          </label>


        </div>
        <div class="ls-modal-footer">
          <button class="ls-btn-default ls-float-right" type="button" data-dismiss="modal">Cancelar</button>
          <input class="ls-btn-primary" name="commit" type="submit" value="Confirmar">
        </div>
      </form>
    </div>
  </div>
</div>



        
        <!-- Fim ConteÃºdo -->
      </div>
      <?php require_once('footer.php');?>
    </main>

    <?php require_once('assets-footer.php');?>

  </body>
</html>