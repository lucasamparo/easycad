<?php 
	require_once 'gerencia_login.php';
	
	if(isset($_POST['nome'])){
		$e = new Evento();
		$e->setNomeEvento($_POST['nome']);
		$e->setDataInicio($_POST['inicio']);
		$e->setDateFim($_POST['fim']);
		$e->setModalidade($_POST['modalidade']);
		$e->setValor($_POST['valor']);
		$e->setCargaHoraria($_POST['ch']);
		$e->setGeraCertificado($_POST['geraCert']);
		$e->inserirEvento();
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
        <h1 class="ls-title-intro ls-ico-home">Cadastro de Evento</h1>
        <form method="post" action="cadEvento.php">
        	<label>Nome do Evento:</label>
        	<input type="text" name="nome"><br>
        	<label>Datas:</label><br>
        	<label>Início:</label>
        	<input type="date" name="inicio">
        	<label>Fim:</label>
        	<input type="date" name="fim"><br>
        	<label>Modalidade de Inscrição:</label>
        	<select name="modalidade">
        		<option value="P">Presencial</option>
        		<option value="O">Online</option>
        		<option value="PO">Presencial + Online</option>
        		<option value="N">Nenhuma</option>
        	</select><br>
        	<label>Valor:</label>
        	<input type="number" step="0.01" placeholder="R$ 0.00" name="valor"><br>
        	<label>Carga Horária:</label>
        	<input type="number" min="1" name="ch">
        	<label>Gera Certificado?</label>
        	<input type="radio" name="geraCert" value="S" id="geraS" checked><label for="geraS">Sim</label>
        	<input type="radio" name="geraCert" value="N" id="geraN"><label for="geraN">Não</label>
        	<input type="submit" value="Cadastrar">
        </form>
      </div>
    </main>

    <?php require_once('assets-footer.php');?>

  </body>
</html>