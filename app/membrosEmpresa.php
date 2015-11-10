<?php 
	require_once 'gerencia_login.php';
	
	if(isset($_POST['funcao'])){
		$m = new Membros();
		$m->setNomeMembro($_POST['nome']);
		$m->inserirMembros();
		
		$v = new Vinculo();
		$v->setCodMembro($m->getCodMembro());
		$v->setFuncao($_POST['funcao']);
		$v->setDataAdmissao($_POST['admissao']);
		$v->inserirVinculo();
	}
	
	if(isset($_GET['c'])){
		$m = new Membros();
		$m->setCodMembro($_GET['id']);
		$m->demitirMembro();
		header('Location: membrosEmpresa.php');
	}
		

	$m = new Membros();
	$membros = $m->retornarMembrosAtivos();
?>
<!DOCTYPE html>
<html class="ls-theme-green">
  <head>
    <title>EasyCad</title>
    <?php require_once('assets.php');?>
    <script type="text/javascript">
		$(document).ready(function(){
			$('#addMembro').click(function(){
				$('#novoMembro').css('display','inline');
			});
		});
    </script>  
  </head>
  <body>

    <?php require_once('header.php');?>

    <?php require_once('aside.php');?>

    <main class="ls-main ">
      <div class="container-fluid">
        <h1 class="ls-title-intro ls-ico-home">Membros da Empresa</h1>
        <!-- Conteúdo -->
        
        <div id="membros">
        	<table>
        		<thead>
        			<th>Membro</th>
        			<th>Funções</th>
	        		<th>Concluir Ciclo</th>
        		</thead>
        		<tbody>
        			<?php 
        				foreach($membros as $m){
        					echo '<tr>';
								echo '<td>'.$m->getNomeMembro().'</td>';
								echo '<td><a href="funcoes.php?id='.$m->getCodMembro().'">Ver Funções</a></td>';
								echo '<td><a href="?id='.$m->getCodMembro().'&c=1">Concluir</a></td>';
	        				echo '</tr>';		
        				}        			
        			?>
        		</tbody>        		
        	</table>
        	<a href="#" id="addMembro">Novo Membro</a>
        	<a href="histMembros.php">Histórico de Membros</a>
        </div>   
        
        <div id="novoMembro" style="display: none;">
        	<form method="post" action="membrosEmpresa.php">
        		<label>Nome:</label>
        		<input type="text" name="nome"><br>
        		<label>Função:</label>
        		<input type="text" name="funcao"><br>
        		<label>Admissão:</label>
        		<input type="date" name="admissao"><br>
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