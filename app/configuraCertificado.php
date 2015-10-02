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
  
  </head>
  <body>

    <?php require_once('header.php');?>

    <?php require_once('aside.php');?>

    <main class="ls-main ">
      <div class="container-fluid">
        <h1 class="ls-title-intro ls-ico-home">Configuração de Certificado</h1>
        <h4>Certificado: <?= $titulo?></h4>
        <form enctype="multipart/form-data" method="post" action="configuraCertificado.php?id=<?= $_GET['id']?>&t=<?= $_GET['t']?>">
        	<label>Cor do Texto</label>
        	<input type="color" name="cor" id="cor" value="<?= $corTexto?>"><input type="text" id="corsel" style="color: <?= $corTexto?>; font-weight: bold"width="20px" value="Cor da Fonte" readonly><br>
        	<label>Layout do Certificado</label>
        	<input type="radio" name="layout" value="1" id="l1" <?php if($layout == '1') echo 'checked'?>><label for="l1">Modelo 1</label>
        	<input type="radio" name="layout" value="2" id="l2" <?php if($layout == '2') echo 'checked'?>><label for="l2">Modelo 2</label><br>
        	<label>Possui verso?</label>
        	<input type="radio" name="verso" value="S" id="versoS" <?php if($verso == 'S') echo 'checked'?>><label for="versoS">Sim</label>
        	<input type="radio" name="verso" value="N" id="versoN" <?php if($verso == 'N') echo 'checked'?>><label for="versoN">Não</label><br>
        	<label>Frente do Certificado (PNG):</label>
        	<input type="file" name="frente" id="frente">
        	<a href="imgCert/<?= $caminho_frente?>" target="_blank">Ver Atual</a><br>
        	<?php 
        		if($verso == 'S'){
        			echo '<label>Fundo do Certificado (PNG):</label>';
        			echo '<input type="file" name="fundo" id="fundo">';
        			echo '<a href="imgCert/'.$caminho_fundo.'" target="_blank">Ver Atual</a><br>';
        		}
        	?>
        	<input type="submit" value="Salvar Configurações">
        </form>
        <a href="listaCurso.php?id=<?= $idEvento?>">Voltar</a>
      </div>
      <?php require_once('footer.php');?>
    </main>

    
    <?php require_once('assets-footer.php');?>

  </body>
</html>