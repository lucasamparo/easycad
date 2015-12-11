<?php 
	require_once 'gerencia_login.php';

	$mensagem = "";
	
	if(isset($_GET['e'])){
		if($_GET['e'] == 1){
			$e = new Evento();
			$e->setIdEvento($_POST['idEvento']);
			$e->setNomeEvento(utf8_decode($_POST['nome']));
			$e->setDataInicio($_POST['inicio']);
			$e->setDateFim($_POST['fim']);
			$e->setModalidade($_POST['modalidade']);
			$e->setValor($_POST['valor']);
			$e->setCargaHoraria($_POST['ch']);
			$e->alterarEvento();
			header('Location: listaEvento.php');			
		}
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
		function carregarEdicao(id){
			var req = $.ajax({
			    url:    "wsEvento.php",
			    type:   "get",
			    dataType:"json",
			    data:   "id="+id,
			    async: false,

			    success: function( data ){
				    $('#idEvento').val(data.idEvento);
				    $('#nome').val(data.nome);
				    $('#inicio').val(data.inicio);
				    $('#fim').val(data.fim);
				    $('#modalidade').val(data.modalidade);
				    $('#valor').val(data.valor);
				    $('#ch').val(data.ch);    
			    },
		        error: function(XMLHttpRequest, textStatus, errorThrown){
		        	console.log(XMLHttpRequest.responseText);
		        	alert(textStatus+" -> "+errorThrown);
			    }
			});
		}


		$(document).ready(function() {

			$('#tb1').dataTable({
				"oLanguage": {
					"sLengthMenu": "Registros/Página _MENU_",
					"sZeroRecords": "Nenhum registro encontrado",
					"sInfo": "Mostrando _START_ / _END_ de _TOTAL_ registro(s)",
					"sInfoEmpty": "Mostrando 0 / 0 de 0 registros",
					"sInfoFiltered": "(filtrado de _MAX_ registros)",
					"sSearch": "Pesquisar: ",
					"oPaginate": {
						"sPrevious": " Anterior ",
						"sNext": " Próximo ",
					}
				},
				"aaSorting": [[0, 'desc']],
				"aoColumnDefs": [ {"sType": "num-html", "aTargets": [0]} ]
			});

		});
    </script>
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
        <h1 class="ls-title-intro ls-ico-calendar">Listagem de Eventos</h1>

        <table class="ls-table ls-bg-header ls-table-striped ls-table-bordered display" cellspacing="0" cellpadding="0" border="0" id="tb1">
        	<thead>
        		<th>Nome</th>
        		<th>Início</th>
        		<th>Fim</th>
        		<th>Cursos</th>
        		<th>Editar</th>
        	</thead>
        	<tbody>
        	<?php 
        		$e = new Evento();
        		$evento = $e->retornarEventos();
        		foreach($evento as $e){
        			echo '<tr>';
        				echo '<td>'.utf8_encode($e->getNomeEvento()).'</td>';
        				echo '<td>'.Util::arrumaData($e->getDataInicio()).'</td>';
        				echo '<td>'.Util::arrumaData($e->getDateFim()).'</td>';
        				if(count($e->getCurso()) > 0){
        					echo '<td><a href="listaCurso.php?id='.$e->getIdEvento().'" class="ls-ico-folder-open ls-btn" title="Ver Cursos"></a></td>';
        				} else {
        					echo '<td>Nenhum Curso Cadastrado</td>';
        				}
        				echo '<td><a href="#" data-ls-module="modal" data-target="#edEvento" class="ls-ico-edit-admin ls-btn" title="Editar" onclick="carregarEdicao('."'".$e->getIdEvento()."'".')"></a></td>';      				       				
        			echo '</tr>';
        		}
        	?>        	
        	</tbody>
        </table>


		<div class="ls-modal" id="edEvento">
          <div class="ls-modal-box">
            <div class="ls-modal-header">
              <button data-dismiss="modal">&times;</button>
              <h4 class="ls-modal-title">Editar Evento</h4>
            </div>
            <div class="ls-modal-body" id="myModalBody">
            
                <form method="post" action="listaEvento.php?e=1">
                    <br>

                    <input type="hidden" name="idEvento" id="idEvento">

        			<label for="nomeGrupo" class="ls-label col-lg-12 col-xs-12">
                        <b class="ls-label-text">Nome do Evento:</b>
                        <input type="text" name="nome" id="nome" placeholder="Nome do Evento" class="ls-field" required>
                    </label>

                    <label class="ls-label col-lg-12 col-xs-12">
		                <b class="ls-label-text">Data Início:</b>
		                <input type="date" name="inicio" id="inicio" class="ls-field" required>
		            </label>

		            <label class="ls-label col-lg-12 col-xs-12">
		                <b class="ls-label-text">Data Fim:</b>
		                <input type="date" name="fim" id="fim" class="ls-field" required>
		            </label>

		            <label class="ls-label col-lg-12 col-xs-12">
		              <b class="ls-label-text">Modalidade de Inscrição:</b>
		              <div class="ls-custom-select">
		                <select class="ls-custom" name="modalidade" id="modalidade" required>
		                    <option value="P">Presencial</option>
		                    <option value="O">Online</option>
		                    <option value="PO">Presencial + Online</option>
		                    <option value="N">Nenhuma</option>
		                </select>
		              </div>
		            </label>
        			
        			<label class="ls-label col-lg-12 col-xs-12">
		                <b class="ls-label-text">Valor:</b>
		                <input type="number" step="0.01" placeholder="R$ 0,00" name="valor" id="valor" class="ls-field">
		            </label>

		            <label class="ls-label col-lg-12 col-xs-12">
		                <b class="ls-label-text">Carga Horária:</b>
		                <input type="number" placeholder="Valor em Horas" min="0" name="ch" id="ch" class="ls-field">
		            </label>
         

                </div>
                <div class="ls-modal-footer">
                  <a href="#" class="ls-btn ls-float-right" data-dismiss="modal">Cancelar</a>
                  <button type="submit" class="ls-btn-primary">Salvar</button>
                </div>

            </form>

          </div>
        </div><!-- /.modal -->
        
      </div>
      <?php require_once('footer.php');?>
    </main>

    <?php require_once('assets-footer.php');?>

  </body>
</html>