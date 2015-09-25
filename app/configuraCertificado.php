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
				$titulo = $curso->getNomeCurso();
				$corTexto = $curso->getCorTexto();
				$layout = $curso->getLayout();
				$verso = $curso->getVerso();
				break;
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
        <form method="post" action="configuraCertificado.php?id=<?= $_GET['id']?>&t=<?= $_GET['t']?>">
        	<label>Cor do Texto</label>
        	<input type="color" name="cor" id="cor" value="<?= $corTexto?>"><input type="text" id="corsel" style="color: <?= $corTexto?>; font-weight: bold"width="20px" value="Cor da Fonte" readonly><br>
        	<label>Layout do Certificado</label>
        	<input type="radio" name="layout" value="1" id="l1" <?php if($layout == '1') echo 'checked'?>><label for="l1">Modelo 1</label>
        	<input type="radio" name="layout" value="2" id="l2" <?php if($layout == '2') echo 'checked'?>><label for="l2">Modelo 2</label><br>
        	<label>Possui verso?</label>
        	<input type="radio" name="verso" value="S" id="versoS" <?php if($verso == 'S') echo 'checked'?>><label for="versoS">Sim</label>
        	<input type="radio" name="verso" value="N" id="versoN" <?php if($verso == 'N') echo 'checked'?>><label for="versoN">Não</label><br>
        	<input type="submit" value="Salvar Configurações">
        </form>
      </div>
      <?php require_once('footer.php');?>
    </main>

    
    <?php require_once('assets-footer.php');?>

  </body>
</html>