<?php 
	require_once 'gerencia_login.php';
	
	if(isset($_GET['id'])){
		$m = new Membros();
		$m->setCodMembro($_GET['id']);
		$membro = $m->retornarMembroPorId();
		
		if(isset($_POST['funcao'])){
			$v = new Vinculo();
			$v->setCodMembro($membro->getCodMembro());
			$v->setFuncao($_POST['funcao']);
			$v->setDataAdmissao($_POST['admissao']);
			$v->inserirVinculo();
		}
		
		if(isset($_POST['id'])){
			$v = new Vinculo();
			$v->setIdVinculo($_POST['id']);
			$v->setFuncao($_POST['funcao2']);
			$v->setDataAdmissao($_POST['admissao2']);
			$v->setDataDemissao($_POST['demissao2']);
			$v->atualizarVinculo();
		}
	} else {
		header("Location: membrosEmpresa.php");
	}
	
	if(isset($_GET['c'])){
		$v = new Vinculo();
		$v->setIdVinculo($_GET['c']);
		$v->terminarCiclo();
		header('Location: funcoes.php?id='.$_GET['id']);
	}
?>
<!DOCTYPE html>
<html class="ls-theme-green">
  <head>
    <title>EasyCad</title>
    <?php require_once('assets.php');?>
    <script type="text/javascript">
		$(document).ready(function(){
			$('#addFuncao').click(function(){
				$('#novaFuncao').css('display','inline');
			});
		});

		function carregaEdicao(id,funcao,admissao,demissao){
			$('#edFuncao').css('display','inline');

			$('#id').val(id);
			$('#funcao').val(funcao);
			$('#admissao').val(admissao);
			$('#demissao').val(demissao);
		}
    </script>  
  </head>
  <body>

    <?php require_once('header.php');?>

    <?php require_once('aside.php');?>

    <main class="ls-main ">
      <div class="container-fluid">
        <h1 class="ls-title-intro ls-ico-home">Funções Exercidas - <?= $membro->getNomeMembro()?></h1>
        <!-- Conteúdo -->
        
        <div id="membros">
        	<table>
        		<thead>
        			<th>Funções</th>
	        		<th>Admissão</th>
	        		<th>Concluir Ciclo</th>
	        		<th>Editar</th>
        		</thead>
        		<tbody>
        			<?php 
        				$vinculo = $membro->getVinculo();
        				foreach($vinculo as $v){
        					echo '<tr>';
								echo '<td>'.$v->getFuncao().'</td>';
								echo '<td>'.Util::arrumaData($v->getDataAdmissao()).'</td>';
								if(is_null($v->getDataDemissao())){
									echo '<td><a href="?id='.$_GET['id'].'&c='.$v->getIdVinculo().'">Concluir Função</a></td>';
								} else {
									echo '<td>'.Util::arrumaData($v->getDataDemissao()).'</td>';
								}
								echo '<td><a href="#" onclick="carregaEdicao('."'".$v->getIdVinculo()."','".$v->getFuncao()."','".$v->getDataAdmissao()."','".$v->getDataDemissao()."'".')">Editar</a></td>';
	        				echo '</tr>';		
        				}        			
        			?>
        		</tbody>        		
        	</table>
        </div>   
        <a href="#" id="addFuncao">Nova Função</a>
        <a href="membrosEmpresa.php">Voltar</a>
        
        <div id="novaFuncao" style="display: none;">
        	<form method="post">
        		<label>Função:</label>
        		<input type="text" name="funcao"><br>
        		<label>Data de Admissão:</label>
        		<input type="date" name="admissao"><br>
        		<input type="submit" value="Salvar">
        	</form>
        </div>
        
        <div id="edFuncao" style="display: none;">
        	<form method="post">
        		<input type="hidden" name="id" id="id"><br>
        		<label>Função:</label>
        		<input type="text" name="funcao2" id="funcao"><br>
        		<label>Data de Admissão:</label>
        		<input type="date" name="admissao2" id="admissao"><br>
        		<label>Data de Demissão:</label>
        		<input type="date" name="demissao2" id="demissao"><br>
        		<input type="submit" value="Salvar">
        	</form>
        </div>
        
        <!-- Fim Conteúdo -->
      </div>
      <?php require_once('footer.php');?>
    </main>

    
    <?php require_once('assets-footer.php');?>

  </body>
</html>