<?php 
	require_once('gerencia_login.php');
	
	if(isset($_GET['id'])){
		$e = new Evento();
		$e->setIdEvento($_GET['id']);
		$evento = $e->retornaEventoPorId();
		
		if(isset($_GET['c'])){
			$c = new Curso();
			$c->setIdCurso($_GET['c']);
			$c = $c->retornarCursoPorId();
			$ativo = "S";
			if($c->getAtivo() == "S"){
				$ativo = "N";
			}
			$c->setAtivo($ativo);
			$c->alterarAtivo();
			header('Location: listaCurso.php?id='.$_GET['id']);
		}
		
		if(isset($_GET['d'])){
			$c = new Curso();
			$c->setIdCurso($_GET['d']);
			$c = $c->retornarCursoPorId();
			$liberar = "S";
			if($c->getLiberarCertificado() == "S"){
				$liberar = "N";
			}
			$c->setLiberarCertificado($liberar);
			$c->alterarLiberacao();
			header('Location: listaCurso.php?id='.$_GET['id']);
		}
		
		if(isset($_POST['nome'])){
			//print_r($_POST);
			$c = new Curso();
			$c->setIdCurso($_POST['idCurso']);
			$c->retornarCursoPorId();
			$c->setNomeCurso($_POST['nome']);
			$c->setLocal($_POST['local']);
			$c->setConteudo($_POST['conteudo']);
			$c->setValor($_POST['valor']);
			$c->setCargaHoraria($_POST['ch']);
			if($_POST['datas'] == 'u'){
				$c->setDataInicio($_POST['dataInicio']);
				$c->setDataFim(null);
			} else {
				$c->setDataInicio($_POST['dataInicio']);
				$c->setDataFim($_POST['dataFim']);
			}
			$c->alterarCurso();
		}
		
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
		function carregarEdicao(id){
			$.ajax({
                url:    "wsCurso.php?id="+id,
                type:   "get",
                dataType:"json",
                async: false,
                success: function(data){
					//alert(data);
					$('#idCurso').val(data.id);
					$('#nome').val(data.nome);
					$('#local').val(data.local);
					$('#conteudo').val(data.conteudo);
					$('#valor').val(data.valor);
					$('#ch').val(data.ch);
					//alert(data.dataFim);
					if(data.dataFim != null){
						$('#m').attr('checked','');
						$('#dataFim').val(data.dataFim);
					} else {
						$('#u').attr('checked','');
						$('#dataFim').val(null);
					}
					$('#dataInicio').val(data.dataInicio);
                }
			});
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
         		<th>Editar</th>
         		<th>Ativo?</th>
         		<th>Certificado Liberado?</th>
         	</thead>
         	<tbody>
         	<?php 
         		foreach($curso as $c){
         			echo '<tr>';
         				echo '<td>'.$c->getNomeCurso().'</td>';
         				$data = "";
         				$data .= Util::arrumaData($c->getDataInicio());
         				if(!is_null($c->getDataFim())){
         					$data .= " a ".Util::arrumaData($c->getDataFim());
         				}
         				echo '<td>'.$data.'</td>';
         				echo '<td><a href="configuraCertificado.php?id='.$c->getIdCurso().'&t=c" class="ls-ico-cog ls-btn" title="Configurar"></a></td>';
         				echo '<td><a href="matriculas.php?id='.$c->getIdCurso().'" class="ls-ico-pencil ls-btn" title="Matrículas"></a></td>';
         				echo '<td><a href="listaPresenca.php?id='.$c->getIdCurso().'" target="_blank" class="ls-ico-text ls-btn" title="Ver Lista"></a></td>';
         				echo '<td><a href="#" onclick="carregarEdicao('."'".$c->getIdCurso()."'".')">Editar</a></td>';
         				if($c->getAtivo() == 'S'){
         					echo '<td>Ativo (<a href="listaCurso.php?id='.$_GET['id'].'&c='.$c->getIdCurso().'">Desativar</a>)</td>';
         				} else {
         					echo '<td>Inativo (<a href="listaCurso.php?id='.$_GET['id'].'&c='.$c->getIdCurso().'">Reativar</a>)</td>';
         				}
         				if($c->getLiberarCertificado() == 'S'){
         					echo '<td>Liberado (<a href="listaCurso.php?id='.$_GET['id'].'&d='.$c->getIdCurso().'">Bloquear</a>)</td>';
         				} else {
         					echo '<td>Retido (<a href="listaCurso.php?id='.$_GET['id'].'&d='.$c->getIdCurso().'">Liberar</a>)</td>';
         				}
         			echo '</tr>';
         		}
         	?>
         	</tbody>
       </table>
       
       <div id="edCurso">
       		<form method="post" action="listaCurso.php?id=<?= $_GET['id']?>">
       			<label>Nome do Curso:</label>
       			<input type="text" name="nome" id="nome"><br>
       			<label>Local:</label>
       			<input type="text" name="local" id="local"><br>
       			<label>Conteúdo Programático:</label>
       			<textarea name="conteudo" id="conteudo"></textarea><br>
       			<label>Valor:</label>
       			<input type="number" name="valor" step="0.01" id="valor"><br>
       			<label>Carga Horária:</label>
       			<input type="number" name="ch" id="ch"><br>
       			<label>Datas:</label>
       			<input type="radio" name="datas" value="u" id="u"><label for="u">Única Data</label>
       			<input type="radio" name="datas" value="m" id="m"><label for="m">Múltiplas Datas</label><br>
       			<label>Data de Início do Curso:</label>
       			<input type="date" name="dataInicio" id="dataInicio"><br>
       			<label>Data de Término do Curso:</label>
       			<input type="date" name="dataFim" id="dataFim"><br>
       			<input type="hidden" name="idCurso" id="idCurso">
       			<input type="submit" value="Salvar">
       		</form>
       </div>

       
      </div>
      <?php require_once('footer.php');?>
    </main>

    <?php require_once('assets-footer.php');?>

  </body>
</html>