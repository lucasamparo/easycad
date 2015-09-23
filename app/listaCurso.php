<?php 
	require_once('gerencia_login.php');
	
	if(isset($_GET['id'])){
		$e = new Evento();
		$e->setIdEvento($_GET['id']);
		$evento = $e->retornaEventoPorId();
		$curso = $evento->getCurso();
	} else {
		header('Location: inicio.php');
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
        <h1 class="ls-title-intro ls-ico-home">Listagem de Cursos - Evento <?= $evento->getNomeEvento()?></h1>
       <table>
       	<thead>
       		<th>Nome</th>
       		<th>Data</th>
       		<th>Certificado</th>
       		<th>Matrículas</th>	
       	</thead>
       	<tbody>
       	<?php 
       		foreach($curso as $c){
       			echo '<tr>';
       				echo '<td>'.$c->getNomeCurso().'</td>';
       				$data = "";
       				$data .= Util::arrumaData($c->getDataInicio());
       				if($c->getDataFim() != '0000-00-00'){
       					$data .= " a ".Util::arrumaData($c->getDataFim());
       				}
       				echo '<td>'.$data.'</td>';
       				echo '<td><a href="#">Certificado</a></td>';
       				echo '<td><a href="matriculas.php?id='.$c->getIdCurso().'">Matrículas</a></td>';
       			echo '</tr>';
       		}
       	?>
       	</tbody>
       </table>

       
      </div>
      <?php require_once('footer.php');?>
    </main>

    <?php require_once('assets-footer.php');?>

  </body>
</html>