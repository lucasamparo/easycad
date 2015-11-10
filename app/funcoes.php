<?php 
	require_once 'gerencia_login.php';
	
	if(isset($_GET['id'])){
		$m = new Membros();
		$m->setCodMembro($_GET['id']);
		$membro = $m->retornarMembroPorId();
		
		if(isset($_POST['funcao'])){
			$v = new Vinculo();
			$v->setCodMembro($membro->getCodMembro());
			$v->setFuncao($_POST['funcao']);
			$v->setDataAdmissao($_POST['admissao']);
			$v->inserirVinculo();
		}
		
		if(isset($_POST['id'])){
			$v = new Vinculo();
			$v->setIdVinculo($_POST['id']);
			$v->setFuncao($_POST['funcao2']);
			$v->setDataAdmissao($_POST['admissao2']);
			$v->setDataDemissao($_POST['demissao2']);
			$v->atualizarVinculo();
		}
	} else {
		header("Location: membrosEmpresa.php");
	}
	
	if(isset($_GET['c'])){
		$v = new Vinculo();
		$v->setIdVinculo($_GET['c']);
		$v->terminarCiclo();
		header('Location: funcoes.php?id='.$_GET['id']);
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
		// $(document).ready(function(){
		// 	$('#addFuncao').click(function(){
		// 		// $('#novaFuncao').css('display','inline');
		// 	});
		// });

		function carregaEdicao(id,funcao,admissao,demissao){
			// $('#edFuncao').css('display','inline');

			$('#id').val(id);
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
        <h1 class="ls-title-intro ls-ico-folder-open">Funções Exercidas - <?= $membro->getNomeMembro()?></h1>
        <!-- Conteúdo -->
        
        <div id="membros">
        	<table class="ls-table ls-bg-header ls-table-striped ls-table-bordered display" cellspacing="0" cellpadding="0" border="0" id="tb1">
        		<thead>
        			<th>Funções</th>
	        		<th>Admissão</th>
	        		<th>Concluir Ciclo</th>
	        		<th>Editar</th>
        		</thead>
        		<tbody>
        			<?php 
        				$vinculo = $membro->getVinculo();
        				foreach($vinculo as $v){
        					echo '<tr>';
								echo '<td>'.$v->getFuncao().'</td>';
								echo '<td>'.Util::arrumaData($v->getDataAdmissao()).'</td>';
								if(is_null($v->getDataDemissao())){
									echo '<td><a href="?id='.$_GET['id'].'&c='.$v->getIdVinculo().'" class="ls-ico-radio-unchecked ls-btn" title="Concluir Função"></a></td>';
								} else {
									echo '<td>'.Util::arrumaData($v->getDataDemissao()).'</td>';
								}
								echo '<td><a href="#" onclick="carregaEdicao('."'".$v->getIdVinculo()."','".$v->getFuncao()."','".$v->getDataAdmissao()."','".$v->getDataDemissao()."'".')" data-ls-module="modal" data-target="#edFuncao" class="ls-ico-edit-admin ls-btn" title="Editar"></a></td>';
	        				echo '</tr>';		
        				}        			
        			?>
        		</tbody>        		
        	</table>
        </div>   

        <div class="col-lg-12 col-xs-12">  
            <br><br><br><br>
            
        	<a href="membrosEmpresa.php" class="ls-ico-circle-left ls-btn ls-btn-lg ls-text-uppercase col-lg-4 col-xs-11 col-lg-push-2">Voltar</a>
        	<a href="#" id="addFuncao" data-ls-module="modal" data-target="#novaFuncao" class="ls-btn-primary ls-btn-lg ls-text-uppercase col-lg-4 col-xs-11 col-lg-push-2">Nova Função</a>
        </div>

        <div class="ls-modal" id="novaFuncao">
          <div class="ls-modal-box">
            <div class="ls-modal-header">
              <button data-dismiss="modal">&times;</button>
              <h4 class="ls-modal-title">Nova Função</h4>
            </div>
            <div class="ls-modal-body" id="myModalBody">
            
                <form method="post" action="">
                    <br>

                    <label for="nomeGrupo" class="ls-label col-lg-12 col-xs-12">
                        <b class="ls-label-text">Função:</b>
                        <input type="text" name="funcao" placeholder="Função" class="ls-field" required>
                    </label>
                    
                    <label class="ls-label col-lg-12 col-xs-12">
                        <b class="ls-label-text">Data de Admissão:</b>
                        <input type="date" name="admissao" class="ls-field" required>
                    </label>

                             

                </div>
                <div class="ls-modal-footer">
                  <a href="#" class="ls-btn ls-float-right" data-dismiss="modal">Cancelar</a>
                  <button type="submit" class="ls-btn-primary">Salvar</button>
                </div>

            </form>

          </div>
        </div><!-- /.modal -->

        <div class="ls-modal" id="edFuncao">
          <div class="ls-modal-box">
            <div class="ls-modal-header">
              <button data-dismiss="modal">&times;</button>
              <h4 class="ls-modal-title">Editar Membro</h4>
            </div>
            <div class="ls-modal-body" id="myModalBody">
            
                <form method="post" action="">
                    <br>

                    <input type="hidden" name="id" id="id">

                    <label for="nomeGrupo" class="ls-label col-lg-12 col-xs-12">
                        <b class="ls-label-text">Função:</b>
                        <input type="text" name="funcao2" id="funcao" placeholder="Função" class="ls-field" required>
                    </label>
                    
                    <label class="ls-label col-lg-12 col-xs-12">
                        <b class="ls-label-text">Data de Admissão:</b>
                        <input type="date" name="admissao2" id="admissao" class="ls-field" required>
                    </label>

                    <label class="ls-label col-lg-12 col-xs-12">
                        <b class="ls-label-text">Data de Demissão:</b>
                        <input type="date" name="demissao2" id="demissao" class="ls-field" required>
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