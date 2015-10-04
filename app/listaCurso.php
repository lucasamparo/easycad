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

    });
    </script>
    
  </head>
  <body>

    <?php require_once('header.php');?>

    <?php require_once('aside.php');?>

    <main class="ls-main ">
      <div class="container-fluid">
        <h1 class="ls-title-intro ls-ico-home">Listagem de Cursos - Evento: <?= $evento->getNomeEvento()?></h1>

        <table class="ls-table ls-bg-header ls-table-striped ls-table-bordered display" cellspacing="0" cellpadding="0" border="0" id="tb1">
         	<thead>
         		<th>Nome</th>
         		<th>Data</th>
         		<th>Certificado</th>
         		<th>Matrículas</th>
         		<th>Lista de Presença</th>	
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
         				echo '<td><a href="configuraCertificado.php?id='.$c->getIdCurso().'&t=c" class="ls-ico-cog ls-btn" title="Configurar"></a></td>';
         				echo '<td><a href="matriculas.php?id='.$c->getIdCurso().'" class="ls-ico-pencil ls-btn" title="Matrículas"></a></td>';
         				echo '<td><a href="listaPresenca.php?id='.$c->getIdCurso().'" target="_blank" class="ls-ico-text ls-btn" title="Ver Lista"></a></td>';
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