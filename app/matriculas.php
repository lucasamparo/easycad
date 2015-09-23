<?php 
	require_once('gerencia_login.php');
	
	if(isset($_GET['id'])){
		$c = new Curso();
		$c->setIdCurso($_GET['id']);
		$curso = $c->retornarCursoPorId();
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
        <h1 class="ls-title-intro ls-ico-home">Listagem de Pessoas Físicas</h1>
        <!-- Conteúdo -->
        <h4>Curso "<?= $curso->getNomeCurso()?>" - Matrículas</h4>
        <div id="participantes">
	        <table>
	        	<thead>
	        		<th>Nome</th>
	        		<th>Telefone</th>
	        		<th>CPF</th>
	        	</thead>
	        	<tbody>
	        	<?php 
	        		//$n = count($curso->getMatricula());
	        		$matriculas = $curso->getMatricula();
	        		//print_r($matriculas->toArray());
	        		$m_p = new Doctrine_Collection('Matricula');
	        		$m_a = new Doctrine_Collection('Matricula');
	        		$m_c = new Doctrine_Collection('Matricula');
	        		foreach($matriculas as $m){
	        			switch($m->getTipo()){
	        				case 'P':
	        					$m_p->add($m);
	        					break;
	        				case 'A':
	        					$m_a->add($m);
	        					break;
	        				case 'C':
	        					$m_c->add($m);
	        					break;
	        			}
	        		}
	        		if(count($m_p) != 0){
	        			foreach($m_p as $m){
	        				echo '<tr>';
	        					$a = $m->getEntidade();
	        					echo '<td>'.$a->getNomeEntidade().'</td>';
	        					echo '<td>'.$a->getTelefone().'</td>';
	        					echo '<td>'.$a->getCnpjCpf().'</td>';
	        				echo '</tr>';
	        			}
	        		} else {
	        			echo '<td colspan="3">Nenhuma Matrícula Presente</td>';
	        		}
	        	?>
	        	</tbody>
	        </table>
	        <a href="addEntidade.php?id=<?= $curso->getIdCurso()?>&f=0">Adicionar Participantes</a>
        </div>
        <div id="apoio">
        	<table>
	        	<thead>
	        		<th>Nome</th>
	        		<th>Telefone</th>
	        		<th>CPF</th>
	        	</thead>
	        	<tbody>
	        	<?php 
	        		if(count($m_a) != 0){
	        			foreach($m_a as $m){
	        				echo '<tr>';
	        					$a = $m->getEntidade();
	        					echo '<td>'.$a->getNomeEntidade().'</td>';
	        					echo '<td>'.$a->getTelefone().'</td>';
	        					echo '<td>'.$a->getCnpjCpf().'</td>';
	        				echo '</tr>';
	        			}
	        		} else {
	        			echo '<td colspan="3">Nenhuma Matrícula Presente</td>';
	        		}
	        	?>
	        	</tbody>
	        </table>
	        <a href="addEntidade.php?id=<?= $curso->getIdCurso()?>&f=1">Adicionar Apoiadores</a>
        </div>
        <div id="colaborador">
        	<table>
	        	<thead>
	        		<th>Nome</th>
	        		<th>Telefone</th>
	        		<th>CPF</th>
	        	</thead>
	        	<tbody>
	        	<?php 
	        		if(count($m_c) != 0){
	        			foreach($m_c as $m){
	        				echo '<tr>';
	        					$a = $m->getEntidade();
	        					echo '<td>'.$a->getNomeEntidade().'</td>';
	        					echo '<td>'.$a->getTelefone().'</td>';
	        					echo '<td>'.$a->getCnpjCpf().'</td>';
	        				echo '</tr>';
	        			}
	        		} else {
	        			echo '<td colspan="3">Nenhuma Matrícula Presente</td>';
	        		}
	        	?>
	        	</tbody>
	        </table>
	        <a href="addEntidade.php?id=<?= $curso->getIdCurso()?>&f=2">Adicionar Colaboradores</a>
        </div>
        
        
        <!-- Fim Conteúdo -->
      </div>
      <?php require_once('footer.php');?>
    </main>

    
    <?php require_once('assets-footer.php');?>

  </body>
</html>