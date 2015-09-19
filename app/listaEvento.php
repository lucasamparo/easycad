<?php 
	require_once 'gerencia_login.php';
	
	if(isset($_GET['e'])){
		if($_GET['e'] == 1){
			$e = new Evento();
			$e->setIdEvento($_POST['idEvento']);
			$e->setNomeEvento($_POST['nome']);
			$e->setDataInicio($_POST['inicio']);
			$e->setDateFim($_POST['fim']);
			$e->setModalidade($_POST['modalidade']);
			$e->setValor($_POST['valor']);
			$e->setCargaHoraria($_POST['ch']);
			$e->setGeraCertificado($_POST['geraCert']);
			$e->alterarEvento();
			header('Location: listaEvento.php');
		}
	}
?>
<!DOCTYPE html>
<html class="ls-theme-green">
  <head>
    <title>EasyCad</title>

    <?php require_once('assets.php');?>
    <script type="text/javascript">
		function carregarEdicao(id){
			$('#edEvento').css('display','inline');
			var req = $.ajax({
			    url:    "wsEvento.php",
			    type:   "get",
			    dataType:"json",
			    data:   "id="+id,
			    async: false,

			    success: function( data ){
				    $('#idEvento').val(data.idEvento);
				    $('#nome').val(data.nome);
				    $('#inicio').val(data.inicio);
				    $('#fim').val(data.fim);
				    $('#modalidade').val(data.modalidade);
				    $('#valor').val(data.valor);
				    $('#ch').val(data.ch);
				    if(data.geraCert == 'S'){
						$('#geraS').attr('checked','');
				    } else {
				    	$('#geraN').attr('checked','');
				    }       
			    }
			});
		}
    </script>
  </head>
  <body>

    <?php require_once('header.php');?>

    <?php require_once('aside.php');?>

    <main class="ls-main ">
      <div class="container-fluid">
        <h1 class="ls-title-intro ls-ico-chart-bar-up">Listagem de Eventos</h1>
        <table>
        	<thead>
        		<th>Nome</th>
        		<th>Início</th>
        		<th>Fim</th>
        		<th>Cursos</th>
        		<th>Certificado</th>
        		<th>Editar</th>
        	</thead>
        	<tbody>
        	<?php 
        		$e = new Evento();
        		$evento = $e->retornarEventos();
        		foreach($evento as $e){
        			echo '<tr>';
        				echo '<td>'.$e->getNomeEvento().'</td>';
        				echo '<td>'.Util::arrumaData($e->getDataInicio()).'</td>';
        				echo '<td>'.Util::arrumaData($e->getDateFim()).'</td>';
        				if(count($e->getCurso()) > 0){
        					echo '<td><a href="listaCurso.php?id='.$e->getIdEvento().'">Ver Cursos</a></td>';
        				} else {
        					echo '<td>Nenhum Curso Cadastrado</td>';
        				}
        				if($e->getGeraCertificado() == 'S'){
        					echo '<td>Tem Certificado</td>';
        				} else {
        					echo '<td>Sem Certificado</td>';
        				}
        				echo '<td><a href="#" onclick="carregarEdicao('."'".$e->getIdEvento()."'".')">Editar</a></td>';      				       				
        			echo '</tr>';
        		}
        	?>        	
        	</tbody>
        </table>
        <hr>
        <div id="edEvento" style="display: none">
        	<form method="post" action="listaEvento.php?e=1">
        		<fieldset>
        			<legend>Editar Evento</legend>
        			<input type="hidden" name="idEvento" id="idEvento">
        			<label>Nome do Evento:</label>
		        	<input type="text" name="nome" id="nome"><br>
		        	<label>Datas:</label><br>
		        	<label>Início:</label>
		        	<input type="date" name="inicio" id="inicio">
		        	<label>Fim:</label>
		        	<input type="date" name="fim" id="fim"><br>
		        	<label>Modalidade de Inscrição:</label>
		        	<select name="modalidade" id="modalidade">
		        		<option value="P">Presencial</option>
		        		<option value="O">Online</option>
		        		<option value="PO">Presencial + Online</option>
		        		<option value="N">Nenhuma</option>
		        	</select><br>
		        	<label>Valor:</label>
		        	<input type="number" step="0.01" placeholder="R$ 0.00" name="valor" id="valor"><br>
		        	<label>Carga Horária:</label>
		        	<input type="number" min="1" name="ch" id="ch">
		        	<label>Gera Certificado?</label>
		        	<input type="radio" name="geraCert" value="S" id="geraS" checked><label for="geraS">Sim</label>
		        	<input type="radio" name="geraCert" value="N" id="geraN"><label for="geraN">Não</label>
		        	<input type="submit" value="Cadastrar">
        		</fieldset>	        	
	        </form>
        </div>
        
      </div>
      <?php require_once('footer.php');?>
    </main>

    <?php require_once('assets-footer.php');?>

  </body>
</html>