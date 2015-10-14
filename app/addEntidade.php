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
          "sZeroRecords": "Nenhum registro encontrado",
          "sInfo": "Mostrando _START_ / _END_ de _TOTAL_ registro(s)",
          "sInfoEmpty": "Mostrando 0 / 0 de 0 registros",
          "sInfoFiltered": "(filtrado de _MAX_ registros)",
          "sSearch": "Pesquisar: ",
          "oPaginate": {
            // "sFirst": " Primeiro ",
            "sPrevious": " Anterior ",
            "sNext": " Próximo ",
            // "sLast": " Último "
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
          "sZeroRecords": "Nenhum registro encontrado",
          "sInfo": "Mostrando _START_ / _END_ de _TOTAL_ registro(s)",
          "sInfoEmpty": "Mostrando 0 / 0 de 0 registros",
          "sInfoFiltered": "(filtrado de _MAX_ registros)",
          "sSearch": "Pesquisar: ",
          "oPaginate": {
            // "sFirst": " Primeiro ",
            "sPrevious": " Anterior ",
            "sNext": " Próximo ",
            // "sLast": " Último "
          }
        },
        "aaSorting": [[0, 'desc']],
        "aoColumnDefs": [ {"sType": "num-html", "aTargets": [0]} ]
      });

    });
    </script>




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

        <h1 class="ls-title-intro ls-ico-user-add"><?= $titulo?></h1>

        <!-- Conteúdo -->
        <input type="hidden" name="funcao" value="<?= $funcao?>" id="funcao">
        
        <table class="ls-table ls-bg-header ls-table-striped ls-table-bordered display" cellspacing="0" cellpadding="0" border="0" id="tb1">
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
        	<input type="submit" value="Salvar" class="ls-btn-primary ls-btn-lg ls-text-uppercase col-lg-4 col-xs-11 col-lg-push-4" style="margin-bottom:50px;">
        </form>

        <hr>
        <div id="lista">
        	<table class="ls-table ls-bg-header ls-table-striped ls-table-bordered display" cellspacing="0" cellpadding="0" border="0" id="tb2">
        		<thead>
        			<th>Nome</th>
        			<th>CPF/CNPJ</th>
        			<th>Selecionar</th>
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
        					echo '<td><a href="#" onclick="'."addParticipante('".$e->getIdEntidade()."','".$e->getNomeEntidade()."')".'" class="ls-ico-plus ls-btn" title="Adicionar"></a></td>';
        				echo '</tr>';
        			}
        		?>
        		</tbody>
        	</table>
        	
        	<br>
        	<a href="matriculas.php?id=<?= $_GET['id']?>" class="ls-ico-circle-left ls-btn ls-btn-lg ls-text-uppercase col-lg-3 col-xs-11">Voltar</a>
        </div>
        <!-- Fim Conteúdo -->
      </div>
      <?php require_once('footer.php');?>
    </main>

    
    <?php require_once('assets-footer.php');?>

  </body>
</html>