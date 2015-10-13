<?php 
	require_once('gerencia_login.php');
	
	if(isset($_GET['id'])){
		$c = new Curso();
		$c->setIdCurso($_GET['id']);
		$curso = $c->retornarCursoPorId();
		$alunos = $curso->retornarAlunosOrdenados();
		$presenca = $curso->getMatricula();
		if(isset($_POST['valida'])){
			foreach($alunos as $a){
				if(isset($_POST['p'.$a->getIdEntidade()])){
					$v = 'P';
				} else {
					$v = 'A';
				}
				foreach($presenca as $p){
					if($a->getIdEntidade() == $p->getIdEntidade()){
						$p->setPresenca($v);
						$p->atualizarMatricula();
					}
				}
			}
			$presenca = $curso->getMatricula();
		}
	} else {
		header('Location: listaEvento.php');
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
        <h1 class="ls-title-intro ls-ico-home">Lan�amento de Presen�a - Curso "<?= $curso->getNomeCurso()?>"</h1>
        <hr>
        <!-- Conte�do -->
        
        <form method="post">
        	<input type="hidden" name="valida" value="1">
	        <table>
	        	<thead>
	        		<th>Nome do Aluno</th>
	        		<th>Presen�a</th>
	        	</thead>
	        	<tbody>
	        		<?php 
	        			//print_r($alunos->toArray());
	        			foreach($alunos as $a){
	        				foreach($presenca as $p){
	        					if($a->getIdEntidade() == $p->getIdEntidade()){
	        						echo '<tr>';
		        						echo '<td>'.$a->getNomeEntidade().'</td>';
		        						if($p->getPresenca() == 'P'){
		        							echo '<td><input type="checkbox" name="p'.$a->getIdEntidade().'" id="p'.$a->getIdEntidade().'" checked></td>';
		        						} else {
		        							echo '<td><input type="checkbox" name="p'.$a->getIdEntidade().'" id="p'.$a->getIdEntidade().'"></td>';
		        						}
		        						
	        						echo '</tr>';
	        					}	
	        				}
	        			}
	        		?>
	        	</tbody>
	        </table>
	        <input type="submit" value="Lan�ar Presen�a">
        </form>
        <!-- Fim Conte�do -->
      </div>
      <?php require_once('footer.php');?>
    </main>

    
    <?php require_once('assets-footer.php');?>

  </body>
</html>