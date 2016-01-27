<?php 
	//require_once 'gerencia_login.php';
	require_once('../models/bootstrap.php');
	
	if(isset($_POST['nome'])){
		$id = null;
		$e = new Entidade();
		$e->setNomeEntidade($_POST['nome']);
		$e->setCnpjCpf($_POST['cpf']);
		$e->setTelefone($_POST['tel']);
		$e->setEmail($_POST['email']);
		$e->setTipo('PF');
		if(isset($_POST['id'])){
			$ent = $e->retornarEntidadePorCnpjCpf();
			$id = $ent->getIdEntidade();
			$e->setIdEntidade($id);
			$e->alterarEntidade();
		} else {
			$e->inserirEntidade();
			$id = $e->getIdEntidade();
		}		
		if(!is_null($id)){
			foreach($_POST['cursos'] as $c){
				$m = new Matricula();
				$m->setIdCurso($c);
				$m->setIdEntidade($e->getIdEntidade());
				$m->setTipo('P');
				$m->setDataHoraMatricula(date('Y-m-d H:i:s'));
				$m->inserirMatricula();
			}
		}		
	}
?>
<html>
	<head>
		<link href="css/locastyle.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
		
		<script type="text/javascript" language="JScript">
	      	$(document).ready(function (){
	        	$("#cpf").mask("999.999.999-99");
			});
	    </script>

	    <script src="js/locastyle.js" type="text/javascript"></script>


		<script type="text/javascript">
			$(document).ready(function(){
				$('#cpf').blur(function(){
					id = $('#cpf').val();
					$.ajax({
		                 url:    "wsEntidade.php?c="+id,
		                 type:   "get",
		                 dataType:"json",
		                 async: false,
		                 success: function(data){
			                if(data.flag){
			                	$('#nome').val(data.nome);
								$('#tel').val(data.telefone);
								$('#email').val(data.email);
								$('#insc').append('<input type="hidden" id="id" name="id" val="'+data.id+'">');
			                }
			                $('#resto').css('display','inline');
							$('#nome').focus();
		                 }
					});
				});
				
				$('#evento').change(function(){
					id = $('#evento').val();
					$.ajax({
		                 url:    "wsCursos.php?id="+id,
		                 type:   "get",
		                 dataType:"json",
		                 async: false,
		                 success: function(data){
							$('#cursos').html("");
							for(i = 0; i < data.length; i++){
								html = '<label class="ls-label-text col-md-3 col-xs-12"><input type="checkbox" name="cursos[]" id="curso'+data[i].id+'" value="'+data[i].id+'">'+data[i].nome+'</label>';
								$('#cursos').append(html);
							}
		                 }
					});
				});
			});
		</script>
	</head>
	<body>

		<div class="col-lg-12 col-xs-12 ls-txt-center">
			<img src="images/easycad.png" width="150" height="60" style="margin-right:20px;">
		</div>

	

		<div class="col-lg-12 col-xs-12">
		    <form method="post" class="ls-form ls-form-horizontal row" action="inscricaoExterna.php" id="insc">

		    	<label class="ls-label col-lg-12 col-xs-12">
		            <b class="ls-label-text">CPF:</b>
		            <input type="text" name="cpf" id="cpf" class="ls-field" placeholder="Apenas números" required>
		        </label>
		    
		    	<div id="resto" style="display: none">
		    		<label class="ls-label col-lg-12 col-xs-12">
			            <b class="ls-label-text">Nome:</b>
			            <input type="text" name="nome" id="nome" class="ls-field" placeholder="Nome" required>
			        </label>		        
	
			        <label class="ls-label col-lg-12 col-xs-12">
			            <b class="ls-label-text">Telefone:</b>
			            <input type="text" name="tel" id="tel" class="ls-field" placeholder="Apenas números" required>
			        </label>
	
			        <label class="ls-label col-lg-12 col-xs-12">
			            <b class="ls-label-text">E-mail:</b>
			            <input type="email" name="email" id="email" class="ls-field" placeholder="email@exemplo.com" required>
			        </label>
	
			        <label class="ls-label col-lg-12 col-xs-12">
			          <b class="ls-label-text">Evento:</b>
			          <div class="ls-custom-select">
			            <select class="ls-custom" name="evento" id="evento" required>
			            	<option value="">Selecionar Evento</option>
			                <?php 
								$e = new Evento();
								$ev = $e->retornarEventoExterno();
								foreach($ev as $e){
									if($e->getAtivo() == 'S'){
										echo '<option value="'.$e->getIdEvento().'">'.$e->getNomeEvento().'</option>';
									}						
								}
							?>
			            </select>
			          </div>
			        </label>
					<div id="cursos" class="ls-label col-lg-12 col-xs-12"></div>
					<input type="submit" value= "Inscrever" class="ls-btn-primary ls-btn-lg ls-text-uppercase col-lg-4 col-xs-11 col-lg-push-4">
		    	</div>							
			</form>
		</div>


	</body>
</html>
