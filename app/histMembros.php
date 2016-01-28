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

    <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">

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
            // "sLast": " Últmo "
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
        <h1 class="ls-title-intro ls-ico-ftp">Histórico de Membros da Empresa</h1>
        <!-- Conteúdo -->
        
        <div id="membros">
        	<table class="ls-table ls-bg-header ls-table-striped ls-table-bordered display" cellspacing="0" cellpadding="0" border="0" id="tb1">
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
								echo '<td><a href="funcoes.php?id='.$m->getCodMembro().'" class="ls-ico-eye ls-btn" title="Ver Funções"></a></td>';
								echo '<td><a href="certMembro.php?id='.$m->getCodMembro().'" target="_blank" class="ls-ico-image ls-btn" title="Emitir"></a></td>';
	        				echo '</tr>';		
        				}        			
        			?>
        		</tbody>        		
        	</table>
        </div>

        <br><br><br><br>
        <a href="membrosEmpresa.php" class="ls-ico-circle-left ls-btn ls-btn-lg ls-text-uppercase col-lg-3 col-xs-11">Voltar</a>
        
        
        
        <!-- Fim Conteúdo -->
      </div>
      <?php require_once('footer.php');?>
    </main>

    
    <?php require_once('assets-footer.php');?>

  </body>
</html>