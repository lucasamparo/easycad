<?php 
	require_once 'gerencia_login.php';
	
	if(isset($_POST['nome'])){
		$c = new Curso();
		$c->setNomeCurso($_POST['nome']);
		if($_POST['evento'] != 0){
			$c->setIdEvento($_POST['evento']);
		} else {
			$e = new Evento();
			$e->setNomeEvento($_POST['nome']);
			if($_POST['tipoData'] == 'U'){
				$e->setDataInicio($_POST['dataInicioA']);
			} else {
				$e->setDataInicio($_POST['dataInicioB']);
				$e->setDataFim($_POST['dataFim']);
			}
			$e->setModalidade('N');
			$e->setGeraCertificado('N');
			$e->setValor($_POST['valor']);
			$e->setCargaHoraria($_POST['ch']);
			$e->inserirEvento();
			$c->setIdEvento($e->getIdEvento());
		}
		$c->setLocal($_POST['local']);
		$c->setConteudo($_POST['conteudo']);
		$c->setValor($_POST['valor']);
		$c->setCargaHoraria($_POST['ch']);
		if($_POST['tipoData'] == 'U'){
			$c->setDataInicio($_POST['dataInicioA']);
		} else {
			$c->setDataInicio($_POST['dataInicioB']);
			$c->setDataFim($_POST['dataFim']);
		}
		$c->inserirCurso();
	}	
?>
<!DOCTYPE html>
<html class="ls-theme-green">
  <head>
    <title>EasyCad</title>

    <?php require_once('assets.php');?>
    <script type="text/javascript">
		$(document).ready(function(){
			$('#U').click(function(){
				$('#unica').css('display','inline');
				$('#multipla').css('display','none');
			});
			$('#M').click(function(){
				$('#unica').css('display','none');
				$('#multipla').css('display','inline');
			});
		});
    </script>
  </head>
  <body>

    <?php require_once('header.php');?>

    <?php require_once('aside.php');?>

    <main class="ls-main ">
      <div class="container-fluid">
        <h1 class="ls-title-intro ls-ico-home">Cadastro de Evento</h1>
        <form method="post" action="cadCurso.php">
        	<label>Nome:</label>
        	<input type="text" name="nome"><br>
        	<label>Evento:</label>
        	<select name="evento">
        		<option value="0">Nenhum Evento</option>
        		<?php 
        			$e = new Evento();
        			$evento = $e->retornarEventos();
        			foreach($evento as $e){
        				echo '<option value="'.$e->getIdEvento().'">'.$e->getNomeEvento().'</option>';
        			}
        		?>
        	</select><br>
        	<label>Local:</label>
        	<input type="text" name="local"><br>
        	<label>Conteúdo Programático:</label>
        	<textarea name="conteudo" rows=10></textarea><br>
        	<label>Valor:</label>
        	<input type="number" name="valor" step="0.01" placeholder="R$ 0.00"><br>
        	<label>Carga Horária:</label>
        	<input type="number" name="ch" min="1"><br>
        	<label>Datas:</label>
        	<input type="radio" name="tipoData" value="U" id="U" checked><label for="U">Única Data</label>
        	<input type="radio" name="tipoData" value="M" id="M"><label for="M">Múltiplas Datas</label>
        	<br>
        	<div id="unica" style="display: inline">
        		<label>Data do Curso:</label>
        		<input type="date" name="dataInicioA"><br>
        	</div>
        	<div id="multipla" style="display: none">
        		<label>Data do Início:</label>
        		<input type="date" name="dataInicioB"><br>
        		<label>Data do Final:</label>
        		<input type="date" name="dataFim"><br>
        	</div>
        	<input type="submit" value="Cadastrar">
        </form>
      </div>
    </main>

    <?php require_once('assets-footer.php');?>

  </body>
</html>