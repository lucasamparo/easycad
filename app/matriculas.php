<?php 
	require_once('gerencia_login.php');
	
	if(isset($_GET['id'])){
		$c = new Curso();
		$c->setIdCurso($_GET['id']);
		$curso = $c->retornarCursoPorId();
		if(isset($_GET['m'])){
			$m = new Matricula();
			$m->setIdMatricula($_GET['m']);
			$m->revogarMatricula();
			header('Location: matriculas.php?id='.$_GET['id']);
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

    <script type="text/javascript">

    $(document).ready(function() {

      $('#tb1').dataTable({
        // "bJQueryUI": true,
        // "sPaginationType": "full_numbers",
        // "sDom": '<"H"Tlfr>t<"F"ip>',
        "oLanguage": {
          "sLengthMenu": "Registros/Página _MENU_",
          "sZeroRecords": "Nenhuma matrícula encontrada",
          "sInfo": "Mostrando _START_ / _END_ de _TOTAL_ registro(s)",
          "sInfoEmpty": "Mostrando 0 / 0 de 0 registros",
          "sInfoFiltered": "(filtrado de _MAX_ registros)",
          "sSearch": "Pesquisar: ",
          "oPaginate": {
            // "sFirst": " Primeiro ",
            "sPrevious": " Anterior ",
            "sNext": " Próximo ",
            // "sLast": "Último "
          }
        },
        "aaSorting": [[0, 'desc']],
        "aoColumnDefs": [ {"sType": "num-html", "aTargets": [0]} ]
      });

      $('#tb2').dataTable({
        // "bJQueryUI": true,
        // "sPaginationType": "full_numbers",
        // "sDom": '<"H"Tlfr>t<"F"ip>',
        "oLanguage": {
          "sLengthMenu": "Registros/Página _MENU_",
          "sZeroRecords": "Nenhuma matrícula encontrada",
          "sInfo": "Mostrando _START_ / _END_ de _TOTAL_ registro(s)",
          "sInfoEmpty": "Mostrando 0 / 0 de 0 registros",
          "sInfoFiltered": "(filtrado de _MAX_ registros)",
          "sSearch": "Pesquisar: ",
          "oPaginate": {
            // "sFirst": " Primeiro ",
            "sPrevious": " Anterior ",
            "sNext": " Próximo ",
            // "sLast": "Último "
          }
        },
        "aaSorting": [[0, 'desc']],
        "aoColumnDefs": [ {"sType": "num-html", "aTargets": [0]} ]
      });

      $('#tb3').dataTable({
        // "bJQueryUI": true,
        // "sPaginationType": "full_numbers",
        // "sDom": '<"H"Tlfr>t<"F"ip>',
        "oLanguage": {
          "sLengthMenu": "Registros/Página _MENU_",
          "sZeroRecords": "Nenhuma matrícula encontrada",
          "sInfo": "Mostrando _START_ / _END_ de _TOTAL_ registro(s)",
          "sInfoEmpty": "Mostrando 0 / 0 de 0 registros",
          "sInfoFiltered": "(filtrado de _MAX_ registros)",
          "sSearch": "Pesquisar: ",
          "oPaginate": {
            // "sFirst": " Primeiro ",
            "sPrevious": " Anterior ",
            "sNext": " Próximo ",
            // "sLast": "Último "
          }
        },
        "aaSorting": [[0, 'desc']],
        "aoColumnDefs": [ {"sType": "num-html", "aTargets": [0]} ]
      });

    });
    </script>
  
  </head>
  <body>

    <?php require_once('header.php');?>

    <?php require_once('aside.php');?>

    <main class="ls-main ">
      <div class="container-fluid">
        <h1 class="ls-title-intro ls-ico-ftp">Matrículas - Curso: "<?= $curso->getNomeCurso()?>"</h1>
        <!-- Conteúdo -->

        <ul class="ls-tabs-nav">
		  <li class="ls-active"><a data-ls-module="tabs" href="#participantes">Participante</a></li>
		  <li><a data-ls-module="tabs" href="#apoio">Apoio</a></li>
		  <li><a data-ls-module="tabs" href="#colaborador">Colaborador</a></li>
		</ul>

		<div class="ls-tabs-container">
	        <div id="participantes" class="ls-tab-content ls-active">
	        	<legend style="color:#1AB551; width:100%; font-size:20px; margin-bottom:20px;" class="ls-txt-center">Participante</legend>

		        <table class="ls-table ls-bg-header ls-table-striped ls-table-bordered display" cellspacing="0" cellpadding="0" border="0" id="tb1">
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
		        					echo '<td>'.$a->getNomeEntidade().' (<a href="?id='.$curso->getIdCurso().'&m='.$m->getIdMatricula().'">Revogar</a>)</td>';
		        					echo '<td>'.$a->getTelefone().'</td>';
		        					echo '<td>'.$a->getCnpjCpf().'</td>';
		        				echo '</tr>';
		        			}
		        		}
		        	?>
		        	</tbody>
		        </table>
		        <a href="addEntidade.php?id=<?= $curso->getIdCurso()?>&f=0" class="ls-btn-primary ls-btn-lg ls-text-uppercase col-lg-4 col-xs-11 col-lg-push-4">Adicionar Participantes</a>
	        </div>


	        <div id="apoio" class="ls-tab-content">
	        	<legend style="color:#1AB551; width:100%; font-size:20px; margin-bottom:20px;" class="ls-txt-center">Apoio</legend>

	        	<table class="ls-table ls-bg-header ls-table-striped ls-table-bordered display" cellspacing="0" cellpadding="0" border="0" id="tb2">
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
		        		}
		        	?>
		        	</tbody>
		        </table>
		        <a href="addEntidade.php?id=<?= $curso->getIdCurso()?>&f=1" class="ls-btn-primary ls-btn-lg ls-text-uppercase col-lg-4 col-xs-11 col-lg-push-4">Adicionar Apoiadores</a>
	        </div>


	        <div id="colaborador" class="ls-tab-content">
	        <legend style="color:#1AB551; width:100%; font-size:20px; margin-bottom:20px;" class="ls-txt-center">Colaborador</legend>

	        	<table class="ls-table ls-bg-header ls-table-striped ls-table-bordered display" cellspacing="0" cellpadding="0" border="0" id="tb3">
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
		        		}
		        	?>
		        	</tbody>
		        </table>
		        <a href="addEntidade.php?id=<?= $curso->getIdCurso()?>&f=2" class="ls-btn-primary ls-btn-lg ls-text-uppercase col-lg-4 col-xs-11 col-lg-push-4">Adicionar Colaboradores</a>
	        </div>
	    </div>


        <div>
        	<a href="listaCurso.php?id=<?= $curso->getEvento()->getIdEvento()?>" class="ls-ico-circle-left ls-btn ls-btn-lg ls-text-uppercase col-lg-3 col-xs-11">Voltar</a>
        </div>
        
        
        <!-- Fim Conteúdo -->
      </div>
      <?php require_once('footer.php');?>
    </main>

    
    <?php require_once('assets-footer.php');?>

  </body>
</html>