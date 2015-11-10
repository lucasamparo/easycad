<?php 
	require_once 'gerencia_login.php';
	
	if(isset($_POST['funcao'])){
		$m = new Membros();
		$m->setNomeMembro($_POST['nome']);
		$m->inserirMembros();
		
		$v = new Vinculo();
		$v->setCodMembro($m->getCodMembro());
		$v->setFuncao($_POST['funcao']);
		$v->setDataAdmissao($_POST['admissao']);
		$v->inserirVinculo();
	}
	
	if(isset($_GET['c'])){
		$m = new Membros();
		$m->setCodMembro($_GET['id']);
		$m->demitirMembro();
		header('Location: membrosEmpresa.php');
	}
		

	$m = new Membros();
	$membros = $m->retornarMembrosAtivos();
?>
<!DOCTYPE html>
<html class="ls-theme-green">
  <head>

    <title>EasyCad</title>

    <?php require_once('assets.php');?>

    <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">

    <script type="text/javascript">
		// $(document).ready(function(){
		// 	$('#addMembro').click(function(){
		// 		$('#novoMembro').css('display','inline');
		// 	});
		// });
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
        <h1 class="ls-title-intro ls-ico-users">Membros da Empresa</h1>
        <!-- Conteúdo -->
        

        <div id="membros">
        	<table class="ls-table ls-bg-header ls-table-striped ls-table-bordered display" cellspacing="0" cellpadding="0" border="0" id="tb1">
        		<thead>
        			<th>Membro</th>
        			<th>Funções</th>
	        		<th>Concluir Ciclo</th>
        		</thead>
        		<tbody>
        			<?php 
        				foreach($membros as $m){
        					echo '<tr>';
								echo '<td>'.$m->getNomeMembro().'</td>';
								echo '<td><a href="funcoes.php?id='.$m->getCodMembro().'" class="ls-ico-eye ls-btn" title="Ver Funções"></a></td>';
								echo '<td><a href="?id='.$m->getCodMembro().'&c=1" class="ls-ico-radio-unchecked ls-btn" title="Concluir"></a></td>';
	        				echo '</tr>';		
        				}        			
        			?>
        		</tbody>        		
        	</table>
        	
            <div class="col-lg-12 col-xs-12">  
                <br><br><br><br>
                <a href="#" id="addMembro" data-ls-module="modal" data-target="#novoMembro" class="ls-btn-primary ls-btn-lg ls-text-uppercase col-lg-4 col-xs-11 col-lg-push-2">Novo Membro</a>
            	<a href="histMembros.php" class="ls-btn-primary ls-btn-lg ls-text-uppercase col-lg-4 col-xs-11 col-lg-push-2">Histórico de Membros</a>
            </div>
        </div>


        <div class="ls-modal" id="novoMembro">
          <div class="ls-modal-box">
            <div class="ls-modal-header">
              <button data-dismiss="modal">&times;</button>
              <h4 class="ls-modal-title">Novo Membro</h4>
            </div>
            <div class="ls-modal-body" id="myModalBody">
            
                <form method="post" action="membrosEmpresa.php">
                    <br>


                    <label for="nomeGrupo" class="ls-label col-lg-12 col-xs-12">
                        <b class="ls-label-text">Nome:</b>
                        <input type="text" name="nome" id="nome" placeholder="Nome" class="ls-field" required>
                    </label>

                    <label for="nomeGrupo" class="ls-label col-lg-12 col-xs-12">
                        <b class="ls-label-text">Função:</b>
                        <input type="text" name="funcao" id="funcao" placeholder="Função" class="ls-field" required>
                    </label>
                    
                    <label class="ls-label col-lg-12 col-xs-12">
                        <b class="ls-label-text">Data de Admissão:</b>
                        <input type="date" name="admissao" id="admissao" class="ls-field" required>
                    </label>

                             

                </div>
                <div class="ls-modal-footer">
                  <a href="#" class="ls-btn ls-float-right" data-dismiss="modal">Cancelar</a>
                  <button type="submit" class="ls-btn-primary">Salvar</button>
                </div>

            </form>

          </div>
        </div><!-- /.modal -->   
                
        <!-- Fim Conteúdo -->
      </div>
      <?php require_once('footer.php');?>
    </main>

    
    <?php require_once('assets-footer.php');?>

  </body>
</html>