<?php 
	require_once 'gerencia_login.php';

	$mensagem = "";
	
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

		$mensagem = "Participante cadastrado com sucesso!";
	}
?>
<!DOCTYPE html>
<html class="ls-theme-green">
  <head>
    <title>EasyCad</title>

    <?php require_once('assets.php');?>

    <script type="text/javascript" language="JScript">
      $(document).ready(function (){
        	
        	$("#cnpj").mask("99.999.999/9999-99");
		
			$("#cpf").mask("999.999.999-99");


			$('#telefone_pj').focus(function(){
				$("#telefone_pj").unmask();
			});
			$('#telefone_pj').blur(function(){
				if($('#telefone_pj').val().length == 11){
					$("#telefone_pj").mask("(99) 99999-9999");
				} else {
					$("#telefone_pj").mask("(99) 9999-9999");
				}
			});

			$('#telefone_pf').focus(function(){
				$("#telefone_pf").unmask();
			});
			$('#telefone_pf').blur(function(){
				if($('#telefone_pf').val().length == 11){
					$("#telefone_pf").mask("(99) 99999-9999");
				} else {
					$("#telefone_pf").mask("(99) 9999-9999");
				}
			});
      });

    </script>
    
  </head>
  <body>

  <?php if($mensagem != ""):?>
    <script>
      $(document).ready(function() {
        $.growl.notice({message: "<?php echo $mensagem;?>"})
      });
    </script>
  <?php endif;?>

    <?php require_once('header.php');?>

    <?php require_once('aside.php');?>

    <main class="ls-main ">
      <div class="container-fluid">
        <h1 class="ls-title-intro ls-ico-user-add">Cadastro de Participante</h1>

        <ul class="ls-tabs-nav">
		  <li class="ls-active"><a data-ls-module="tabs" href="#pFisica">Pessoa Física</a></li>
		  <li><a data-ls-module="tabs" href="#pJuridica">Pessoa Jurídica</a></li>
		</ul>

        <div class="col-lg-12 col-xs-12">
        	<form method="post" class="ls-form ls-form-horizontal row" action="cadParticipante.php"> 
				
				<div class="ls-tabs-container">
				  <div id="pFisica" class="ls-tab-content ls-active">
					
						<legend style="color:#1AB551; width:100%; font-size:20px; margin-bottom:20px;" class="ls-txt-center">Pessoa Física</legend>

						<label class="ls-label col-lg-6 col-xs-12">
			                <b class="ls-label-text">Nome:</b>
			                <input type="text" name="nome_pf" class="ls-field" placeholder="Nome">
			            </label>

			            <label class="ls-label col-lg-6 col-xs-12">
			                <b class="ls-label-text">CPF:</b>
			                <input type="text" name="cpf" id="cpf" class="ls-field" placeholder="CPF">
			            </label>

			            <label class="ls-label col-lg-6 col-xs-12">
			                <b class="ls-label-text">Telefone:</b>
			                <input type="text" name="telefone_pf" id="telefone_pf" class="ls-field" placeholder="Apenas números">
			            </label>

			            <label class="ls-label col-lg-6 col-xs-12">
			                <b class="ls-label-text">E-mail:</b>
			                <input type="email" name="email_pf" class="ls-field" placeholder="email@exemplo.com">
			            </label>

				  </div>
				  <div id="pJuridica" class="ls-tab-content">

				   		<legend style="color:#1AB551; width:100%; font-size:20px; margin-bottom:20px;" class="ls-txt-center">Pessoa Jurídica</legend>

				   		<label class="ls-label col-lg-6 col-xs-12">
			                <b class="ls-label-text">Nome:</b>
			                <input type="text" name="nome_pj" class="ls-field" placeholder="Nome">
			            </label>

			            <label class="ls-label col-lg-6 col-xs-12">
			                <b class="ls-label-text">CNPJ:</b>
			                <input type="text" name="cnpj" id="cnpj" class="ls-field" placeholder="CNPJ">
			            </label>

			            <label class="ls-label col-lg-6 col-xs-12">
			                <b class="ls-label-text">Telefone:</b>
			                <input type="text" name="telefone_pj" id="telefone_pj" class="ls-field" placeholder="Apenas números">
			            </label>

			            <label class="ls-label col-lg-6 col-xs-12">
			                <b class="ls-label-text">E-mail:</b>
			                <input type="email" name="email_pj" class="ls-field" placeholder="email@exemplo.com">
			            </label>

				  </div>
				</div>

	        	<input type="submit" value="Cadastrar" disabled class="ls-btn-primary ls-btn-lg ls-text-uppercase col-lg-4 col-xs-11 col-lg-push-4">
        	</form>
        </div>
        
      </div>
      <?php require_once('footer.php');?>
    </main>

    <?php require_once('assets-footer.php');?>

  </body>
</html>