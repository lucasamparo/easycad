<?php 
	require_once('gerencia_login.php');

	$mensagem = "";
	
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

			$mensagem = "Lista de presença salva com sucesso!";
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
    <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">
  
  </head>
  <body>

  <?php if($mensagem != ""):?>
    <script>
      $(document).ready(function() {
        $.growl.notice({message: "<?php echo $mensagem;?>"})
      });
    </script>
  <?php endif;?>

    <?php require_once('header.php');?>

    <?php require_once('aside.php');?>

    <main class="ls-main ">
      <div class="container-fluid">
        <h1 class="ls-title-intro ls-ico-list2">Lançamento de Presença - Curso "<?= $curso->getNomeCurso()?>"</h1>
        <hr>
                
        <div class="ls-label col-lg-12 col-xs-12">
        	<form method="post">
	        	<input type="hidden" name="valida" value="1">
		        <table class="ls-table ls-bg-header ls-table-striped ls-table-bordered display" cellspacing="0" cellpadding="0" border="0">
		        	<thead>
		        		<th>Nome do Aluno</th>
		        		<th>Presença</th>
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
	
		        <input type="submit" value="Lançar Presença" class="ls-btn-primary ls-btn-lg ls-text-uppercase col-lg-4 col-xs-11 col-lg-push-4">
	        </form>
        </div>
        <div class="ls-label col-lg-12 col-xs-12">
        	<a href="listaCurso.php?id=<?= $curso->getEvento()->getIdEvento()?>" class="ls-ico-circle-left ls-btn ls-btn-lg ls-text-uppercase col-lg-3 col-xs-11">Voltar</a>
        </div>
      </div>
      <?php require_once('footer.php');?>
    </main>

    
    <?php require_once('assets-footer.php');?>

  </body>
</html>