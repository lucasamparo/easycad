<?php 
	require_once('gerencia_login.php');
	
	if(isset($_GET['id'])){
		$funcao = $_GET['f'];
		switch ($funcao){
			case 0:
				if(isset($_POST['id'])){
					foreach($_POST['id'] as $id){
						$m = new Matricula();
						$m->setIdCurso($_GET['id']);
						$m->setIdEntidade($id);
						$m->setDataHoraMatricula(date('Y-m-d H:i:s'));
						$m->setTipo("P");
						$m->inserirMatricula();
					}					
				}
				$m = new Matricula();
				$matriculados = $m->retornarMatriculasPorTipo('P');
				$titulo = 'Adicionar Participantes';
				break;
			case 1:
				if(isset($_POST['id'])){
					foreach($_POST['id'] as $id){
						$m = new Matricula();
						$m->setIdCurso($_GET['id']);
						$m->setIdEntidade($id);
						$m->setDataHoraMatricula(date('Y-m-d H:i:s'));
						$m->setTipo("A");
						$m->inserirMatricula();
					}
				}
				$m = new Matricula();
				$matriculados = $m->retornarMatriculasPorTipo('A');
				$titulo = 'Adicionar Apoiadores'; 
				break;
			case 2:
				if(isset($_POST['id'])){
					foreach($_POST['id'] as $id){
						$m = new Matricula();
						$m->setIdCurso($_GET['id']);
						$m->setIdEntidade($id);
						$m->setDataHoraMatricula(date('Y-m-d H:i:s'));
						$m->setTipo("C");
						$m->inserirMatricula();
					}
				}
				$m = new Matricula();
				$matriculados = $m->retornarMatriculasPorTipo('C');
				$titulo = 'Adicionar Colaboradores';
				break;
		}
	} else {
		header('listaEvento.php');
	}
?>
<!DOCTYPE html>
<html class="ls-theme-green">
  <head>
    <title>EasyCad</title>

    <?php require_once('assets.php');?>
  	<script type="text/javascript">
		
		
		function addParticipante(id,nome){
			$('#corpoTabela').append("<tr><td>"+nome+"</td></tr>");
			$('#form').append('<input type="hidden" name="id[]" value="'+id+'">');
		}
  	</script>
  </head>
  <body>

    <?php require_once('header.php');?>

    <?php require_once('aside.php');?>

    <main class="ls-main ">
      <div class="container-fluid">
        <!-- Conteúdo -->
        <input type="hidden" name="funcao" value="<?= $funcao?>" id="funcao">
        <h4><?= $titulo?></h4>
        <table>
        	<thead>
        		<th>Nome</th>
        	</thead>
        	<tbody id="corpoTabela">
        		<?php 
        			foreach($matriculados as $m){
        				if($_GET['id'] == $m->getIdCurso()){
        					echo '<tr>';
        						echo '<td>'.$m->getEntidade()->getNomeEntidade().'</td>';
        					echo '</tr>';
        				}        				
        			}
        		?>
        	</tbody>
        </table>
        <form method="post" action="addEntidade.php?id=<?= $_GET['id']?>&f=<?= $_GET['f']?>">
        	<div id="form"></div>
        	<input type="submit" value="Inserir">
        </form>
        <hr>
        <div id="lista">
        	<table>
        		<thead>
        			<th>Nome</th>
        			<th>CPF/CNPJ</th>
        			<th>Adicionar</th>
        		</thead>
        		<tbody>
        		<?php 
        			$e = new Entidade();
        			if($funcao == 'A'){
        				$entidades = $e->retornarPJ();
        			} else {
        				$entidades = $e->retornarEntidades();
        			}
        			foreach($entidades as $e){
        				echo '<tr>';
        					echo '<td>'.$e->getNomeEntidade().'</td>';
        					echo '<td>'.$e->getCnpjCpf().'</td>';
        					echo '<td><a href="#" onclick="'."addParticipante('".$e->getIdEntidade()."','".$e->getNomeEntidade()."')".'">Adicionar</a></td>';
        				echo '</tr>';
        			}
        		?>
        		</tbody>
        	</table>
        	
        	<br>
        	<a href="matriculas.php?id=<?= $_GET['id']?>">Voltar</a>
        </div>
        <!-- Fim Conteúdo -->
      </div>
      <?php require_once('footer.php');?>
    </main>

    
    <?php require_once('assets-footer.php');?>

  </body>
</html>