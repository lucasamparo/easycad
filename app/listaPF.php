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

      $('#fechar1').click(function(){
    	  $('#editarPF').removeClass('ls-opened');
      });
      $('#fechar2').click(function(){
    	  $('#editarPF').removeClass('ls-opened');
      });

    });

    function abrirModal(id,nome,cpf,tel,email){
		$('#nome').val(nome);
		$('#id').val(id);
		$('#tel').val(tel);
		$('#cpf').val(cpf);
		$('#email').val(email);
		$('#editarPF').addClass('ls-opened');
    }
    </script>
  
  </head>
  <body>

    <?php require_once('header.php');?>
    <?php 
    	if(isset($_POST['id'])){
    		$e = new Entidade();
    		$e->setIdEntidade($_POST['id']);
    		$e->setNomeEntidade($_POST['nome']);
    		$e->setCnpjCpf($_POST['cpf']);
    		$e->setTelefone($_POST['tel']);
    		$e->setEmail($_POST['email']);
    		$e->alterarEntidade();
    	}
    ?>

    <?php require_once('aside.php');?>

    <main class="ls-main ">
      <div class="container-fluid">
        <h1 class="ls-title-intro ls-ico-home">Listagem de Pessoa Física</h1>
        <!-- Conteúdo -->
        <table class="ls-table ls-bg-header ls-table-striped ls-table-bordered display" cellspacing="0" cellpadding="0" border="0" id="tb1">
        	<thead>
        		<th>Nome da Pessoa Física</th>
        		<th>CPF</th>
        		<th>Contagem de Eventos</th>
        		<th>Editar Cadastro</th>
        	</thead>
        	<tbody>
        	<?php 
        		$e = new Entidade();
        		$entidades = $e->retornarPF();
        		foreach($entidades as $e){
        			echo '<tr>';
        				echo '<td>'.$e->getNomeEntidade().'</td>';
        				echo '<td>'.$e->getCnpjCpf().'</td>';
        				echo '<td>'.count($e->getMatricula()).' Eventos</td>';
        				echo '<td><a href="#" onclick="abrirModal('."'".$e->getIdEntidade()."','".$e->getNomeEntidade()."','".$e->getCnpjCpf()."','".$e->getTelefone()."','".$e->getEmail()."'".')">Editar</a></td>';
        			echo '</tr>';
        		}
        	?>
        	</tbody>
        </table>
        <div class="ls-modal" id="editarPF">
		  <div class="ls-modal-box">
		    <div class="ls-modal-header">
		      <button data-dismiss="modal" id="fechar1">&times;</button>
		      <h4 class="ls-modal-title">Editar Pessoa Física</h4>
		    </div>
		    <div class="ls-modal-body" id="myModalBody">
		    	<form method="post" class="ls-form-horizontal">
			    	<label class="ls-label col-lg-6 col-xs-12">
		                <b class="ls-label-text">Nome:</b>
		                <input type="text" name="nome" class="ls-field" placeholder="Nome" id="nome">
		                <input type="hidden" name="id" id="id">
		            </label>
	
		            <label class="ls-label col-lg-6 col-xs-12">
		                <b class="ls-label-text">CPF:</b>
		                <input type="text" name="cpf" id="cpf" class="ls-field" placeholder="CPF">
		            </label>
	
		            <label class="ls-label col-lg-6 col-xs-12">
		                <b class="ls-label-text">Telefone:</b>
		                <input type="text" name="tel" id="tel" class="ls-field" placeholder="Apenas números">
		            </label>
	
		            <label class="ls-label col-lg-6 col-xs-12">
		                <b class="ls-label-text">E-mail:</b>
		                <input type="email" name="email" class="ls-field" placeholder="email@exemplo.com" id="email">
		            </label>		      
		    </div>
		    <div class="ls-modal-footer">
		      <a class="ls-btn ls-float-right" data-dismiss="modal" id="fechar2">Fechar</a>
		      <button type="submit" class="ls-btn-primary">Salvar</button>
		      </form>
		    </div>
		  </div>
		</div>
        
        <!-- Fim Conteúdo -->
      </div>
      <?php require_once('footer.php');?>
    </main>    
    <?php require_once('assets-footer.php');?>

  </body>
</html>