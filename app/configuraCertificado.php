<?php 
	require_once 'gerencia_login.php';
	
	if(isset($_GET['id'])){
		switch($_GET['t']){
			case 'e':
				if(isset($_POST['cor'])){
					$e = new Evento();
					$e->setIdEvento($_GET['id']);
					$e->setCorTexto($_POST['cor']);
					$e->setLayout($_POST['layout']);
					$e->setVerso($_POST['verso']);
					$e->alterarEvento();
				}
				$e = new Evento();
				$e->setIdEvento($_GET['id']);
				$evento = $e->retornaEventoPorId();
				$id = $evento->getIdEvento();
				$idEvento = $evento->getIdEvento();
				$titulo = $evento->getNomeEvento();
				$corTexto = $evento->getCorTexto();
				$layout = $evento->getLayout();
				$verso = $evento->getVerso();
				break;
			case 'c':
				if(isset($_POST['cor'])){
					$c = new Curso();
					$c->setIdCurso($_GET['id']);
					$c->setCorTexto($_POST['cor']);
					$c->setLayout($_POST['layout']);
					$c->setVerso($_POST['verso']);
					$c->alterarCurso();
				}
				$c = new Curso();
				$c->setIdCurso($_GET['id']);
				$curso = $c->retornarCursoPorId();
				$id = $curso->getIdCurso();
				$idEvento = $curso->getEvento()->getIdEvento();
				$titulo = $curso->getNomeCurso();
				$corTexto = $curso->getCorTexto();
				$layout = $curso->getLayout();
				$verso = $curso->getVerso();
				break;
		}
		
		$caminho_frente = $_GET['t']."_".$id.md5($titulo)."_frente.png";
		$caminho_fundo = $_GET['t']."_".$id.md5($titulo)."_fundo.png";
		
		//print_r($_FILES);
		if(count($_FILES) > 0){
			if($_FILES['frente']['name'] != ""){
				//Salvando os fundos
				$caminho = 'imgCert/';
					
				// Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
				if ($_FILES['frente']['error'] != 0) {
					die("Não foi possível fazer o upload.");
					exit; // Para a execução do script
				} else {
					$nome_final = $_GET['t']."_".$id.md5($titulo)."_frente.png";
					// Depois verifica se é possível mover o arquivo para a pasta escolhida
					if (move_uploaded_file($_FILES['frente']['tmp_name'], $caminho . $nome_final)) {
						$caminho_frente = $nome_final;
					} else {
						echo "Não foi possível enviar o arquivo, tente novamente";
					}
						
				}
			}
			if($_FILES['fundo']['name'] != ""){
				//Salvando os fundos
				$caminho = 'imgCert/';
			
				// Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
				if ($_FILES['fundo']['error'] != 0) {
					die("Não foi possível fazer o upload.");
					exit; // Para a execução do script
				} else {
					$nome_final = $_GET['t']."_".$id.md5($titulo)."_fundo.png";
					// Depois verifica se é possível mover o arquivo para a pasta escolhida
					if (move_uploaded_file($_FILES['fundo']['tmp_name'], $caminho . $nome_final)) {
						$caminho_fundo = $nome_final;
					} else {
						echo "Não foi possível enviar o arquivo, tente novamente";
					}
						
				}
			}
		}
	}
?>
<!DOCTYPE html>
<html class="ls-theme-green">
  <head>
    <title>EasyCad</title>

    <?php require_once('assets.php');?>
    <script type="text/javascript">
		$(document).ready(function(){
			$('#cor').change(function(){
				$('#corsel').css('font-weight','bold');
				$('#corsel').css('color',$('#cor').val());
			});

			$('#frente').change(function(){
				arquivo = $('#frente').val();
				ext = arquivo.substring((arquivo.indexOf(".")+1),arquivo.length);
				if(ext != 'png'){
					alert("Selecione um arquivo PNG");
					$('#frente').val("");
				}
			});

			$('#fundo').change(function(){
				arquivo = $('#fundo').val();
				ext = arquivo.substring((arquivo.indexOf(".")+1),arquivo.length);
				if(ext != 'png'){
					alert("Selecione um arquivo PNG");
					$('#fundo').val("");
				}
			});
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

    <?php require_once('header.php');?>

    <?php require_once('aside.php');?>

    <main class="ls-main ">
      <div class="container-fluid">

        <h1 class="ls-title-intro ls-ico-home">Configuração do Certificado</h1>

        <legend style="color:#1AB551; width:100%; font-size:20px; margin-bottom:20px;" class="ls-txt-center">Certificado: <?= utf8_encode($titulo)?></legend>

        <div class="col-lg-12 col-xs-12">
        	<form method="post" enctype="multipart/form-data" class="ls-form ls-form-horizontal row" action="configuraCertificado.php?id=<?= $_GET['id']?>&t=<?= $_GET['t']?>">

        		<label class="ls-label col-lg-12 col-xs-12">
	                <b class="ls-label-text">Cor do Texto:</b>
	                <input type="color" name="cor" id="cor" value="<?= $corTexto?>" class="ls-field" style="height:35px;">
	            </label>

	            <label class="ls-label col-lg-12 col-xs-12">
	                <b class="ls-label-text">Cor do Texto (Exemplo):</b>
	                <input type="text" style="background-color:#e3e3e3;" id="corsel" style="color: <?= $corTexto?>; font-weight: bold" width="20px" class="ls-field" value="Cor do Texto" readonly>
	            </label>


	            <div class="ls-label col-lg-6 col-xs-12 contorno">
	              <strong><p style="font-size:14px;">Layout do Certificado:</p></strong>

	              <label class="ls-label-text">
	                <input type="radio" class="ls-field-radio" name="layout" value="1" id="l1" <?php if($layout == '1') echo 'checked'?>>
	                Modelo 1
	              </label>

	              <label class="ls-label-text">
	                <input type="radio" class="ls-field-radio" name="layout" value="2" id="l2" <?php if($layout == '2') echo 'checked'?>>
	                Modelo 2
	              </label>

	            </div>

	            <div class="ls-label col-lg-6 col-xs-12 contorno">
	              <strong><p style="font-size:14px;">Possui verso?</p></strong>

	              <label class="ls-label-text">
	                <input type="radio" class="ls-field-radio" name="verso" value="S" id="versoS" <?php if($verso == 'S') echo 'checked'?>>
	                Sim
	              </label>

	              <label class="ls-label-text">
	                <input type="radio" class="ls-field-radio" name="verso" value="N" id="versoN" <?php if($verso == 'N') echo 'checked'?>>
	                Não
	              </label>

	            </div>

	            <label class="ls-label col-lg-6 col-xs-12 contorno">
	                <b class="ls-label-text">Frente do Certificado (PNG): | <a href="imgCert/<?= $caminho_frente?>" target="_blank" class="link">Ver Atual</a></b>
	                <input type="file" name="frente" id="frente" class="ls-field">
	                
	            </label>


	        	<?php 
	        		if($verso == 'S'){
	        			echo '<label class="ls-label col-lg-6 col-xs-12 contorno">';
			                echo '<b class="ls-label-text">Fundo do Certificado (PNG): | <a href="imgCert/'.$caminho_fundo.'" target="_blank" class="link">Ver Atual</a></b>';
			                echo '<input type="file" name="fundo" id="fundo" class="ls-field">';
			                
			            echo '</label>';
	        		}
	        	?>

	        	<input type="submit" value= "Salvar Configurações" class="ls-btn-primary ls-btn-lg ls-text-uppercase col-lg-4 col-xs-11 col-lg-push-4" style="margin-bottom:50px;">
        	</form>
       	</div>


        <a href="listaCurso.php?id=<?= $idEvento?>" class="ls-ico-circle-left ls-btn ls-btn-lg ls-text-uppercase col-lg-3 col-xs-11">Voltar</a>
      </div>
      <?php require_once('footer.php');?>
    </main>

    
    <?php require_once('assets-footer.php');?>

  </body>
</html>