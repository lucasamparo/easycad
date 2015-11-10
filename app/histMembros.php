<?php 
	require_once 'gerencia_login.php';
	
	if(isset($_POST['nome'])){
		$m = new Membros();
		$m->setCodMembro($_POST['id']);
		$membro = $m->retornarMembroPorId();
		$membro->setNomeMembro($_POST['nome']);
		$membro->setFuncao($_POST['funcao']);
		$membro->setDataAdmissao($_POST['admissao']);
		$membro->setDataDemissao($_POST['demissao']);
		$membro->alterarMembro();
	}
	
	$m = new Membros();
	$membros = $m->retornarMembrosInativos();
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

		function carregarEdicao(id,nome,funcao,admissao,demissao){
			$('#edMembro').css('display','inline');
			$('#id').val(id);
			$('#nome').val(nome);
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
        <h1 class="ls-title-intro ls-ico-home">Histórico de Membros da Empresa</h1>
        <!-- Conteúdo -->
        
        <div id="membros">
        	<table>
        		<thead>
        			<th>Membro</th>
	        		<th>Admissão</th>
	        		<th>Conclusão</th>
	        		<th>Funções</th>
	        		<th>Certificado</th>
        		</thead>
        		<tbody>
        			<?php
        				foreach($membros as $m){
        					echo '<tr>';
								echo '<td>'.$m->getNomeMembro().'</td>';
								echo '<td>'.Util::arrumaData($m->getAdmissao()).'</td>';
								echo '<td>'.Util::arrumaData($m->getDemissao()).'</td>';
								echo '<td><a href="funcoes.php?id='.$m->getCodMembro().'">Ver Funções</a></td>';
								echo '<td><a href="certMembro.php?id='.$m->getCodMembro().'" target="_blank">Emitir</a></td>';
	        				echo '</tr>';		
        				}        			
        			?>
        		</tbody>        		
        	</table>
        </div>
        <a href="membrosEmpresa.php">Voltar</a>
        
        <div id="edMembro" style="display: none;">
        	<form method="post" action="histMembros.php">
        		<input type="hidden" name="id" id="id">
        		<label>Nome:</label>
        		<input type="text" name="nome" id="nome"><br>
        		<label>Função:</label>
        		<input type="text" name="funcao" id="funcao"><br>
        		<label>Admissão:</label>
        		<input type="date" name="admissao" id="admissao"><br>
        		<label>Demissão:</label>
        		<input type="date" name="demissao" id="demissao"><br>
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