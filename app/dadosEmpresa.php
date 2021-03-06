<?php 
	require_once 'gerencia_login.php';

  $mensagem = "";
	
	$e = new Empresa();
	$empresa = $e->retornarEmpresa();
	if(isset($_POST['nome'])){
		$e = new Empresa();
		$e->setNomeFantasia(utf8_decode($_POST['nome']));
		$e->setRazaoSocial(utf8_decode($_POST['razao']));
		$e->setResponsavel(utf8_decode($_POST['responsavel']));
		$e->setCnpj($_POST['cnpj']);
		$e->alterarEmpresa();
		
		if(count($_FILES) > 0){
			if($_FILES['frente']['name'] != ""){
				//Salvando os fundos
				$caminho = 'imgCert/';
					
				// Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
				if ($_FILES['frente']['error'] != 0) {
					die("Não foi possível fazer o upload.");
					exit; // Para a execução do script
				} else {
					// Depois verifica se é possível mover o arquivo para a pasta escolhida
					if (!move_uploaded_file($_FILES['frente']['tmp_name'], "imgCert/frente_membro.png")) {
						echo "Não foi possível enviar o arquivo, tente novamente";
					}
		
				}
			}
			if($_FILES['fundo']['name'] != ""){
					
				// Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
				if ($_FILES['fundo']['error'] != 0) {
					die("Não foi possível fazer o upload.");
					exit; // Para a execução do script
				} else {
					// Depois verifica se é possível mover o arquivo para a pasta escolhida
					if (!move_uploaded_file($_FILES['fundo']['tmp_name'], "imgCert/fundo_membro.png")) {
						echo "Não foi possível enviar o arquivo, tente novamente";
					}
		
				}
			}
		}

    $mensagem = "Dados atualizados com sucesso!";
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
      });

    </script>

    <style type="text/css">
      .contorno{
        /*border:1px dotted #CCC;*/
        padding: 30px;
      }
      .link{
        text-decoration: underline;
        color: #1AB551;
        text-transform: uppercase;
      }
    </style>

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
        <h1 class="ls-title-intro ls-ico-globe">Meus Dados</h1>
        <!-- Conteúdo -->
                
          <div class="col-lg-12 col-xs-12">
            <form method="post" class="ls-form ls-form-horizontal row" action="dadosEmpresa.php" enctype="multipart/form-data">

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
                  <input type="text" name="login" value="<?= $empresa->getLogin()?>" readonly class="ls-field" style="background-color:#e3e3e3;">
                </label>
                
                <label class="ls-label col-lg-6 col-xs-12 contorno">
	                <b class="ls-label-text">Frente do Certificado (PNG): | <a href="imgCert/frente_membro.png" target="_blank" class="link">Ver Atual</a></b>
	                <input type="file" name="frente" id="frente" class="ls-field">
	                
	            </label>
       	
       			<label class="ls-label col-lg-6 col-xs-12 contorno">
	                <b class="ls-label-text">Fundo do Certificado (PNG): | <a href="imgCert/fundo_membro.png" target="_blank" class="link">Ver Atual</a></b>
	                <input type="file" name="fundo" id="fundo" class="ls-field">
	            </label>                              
              <input type="submit" value= "Salvar" class="ls-btn-primary ls-btn-lg ls-text-uppercase col-lg-4 col-xs-11 col-lg-push-4" id="sub">    
                  
            </form>
          </div>
               
        <!-- Fim Conteúdo -->
      </div>
      <?php require_once('footer.php');?>
    </main>

    <?php require_once('assets-footer.php');?>

  </body>
</html>