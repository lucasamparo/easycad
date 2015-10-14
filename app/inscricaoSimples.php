<?php 
	require_once 'gerencia_login.php';
	
	if(isset($_POST['idEntidade'])){
		foreach ($_POST['cursos'] as $c){
			$m = new Matricula();
			$m->setIdCurso($c);
			$m->setIdEntidade($_POST['idEntidade']);
			$m->setTipo('P');
			$m->setDataHoraMatricula(date('Y-m-d H:i:s'));
			$m->inserirMatricula();
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
							$('#nomeP').val(data.nome);
							$('#idEntidade').val(data.id);
							$('#warpNome').css('display','inline');
							$('#warpCaixa').css('display','none');
		                 },
		                 error: function(XMLHttpRequest, textStatus, errorThrown){
		                     $('#form').css('display','none');
		                     $('#msgErro').css('display','inline');
		                 }
					});
				});
				$('#evento').blur(function(){
					id = $('#evento').val();
					$.ajax({
		                 url:    "wsCursos.php?id="+id,
		                 type:   "get",
		                 dataType:"json",
		                 async: false,
		                 success: function(data){
							//alert(data);
							$('#cursos').html("");
							for(i = 0; i < data.length; i++){
								html = '<label class="ls-label-text"><input type="checkbox" name="cursos[]" id="curso'+data[i].id+'" value="'+data[i].id+'">'+data[i].nome+'</label><br>';
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
			<img src="images/eambjr.png" width="150" height="60" style="margin-left:20px;">
		</div>

		<div class="col-lg-12 col-xs-12">
		    <form method="post" class="ls-form ls-form-horizontal row" action="inscricaoSimples.php" id="form">
		    	
		    	<div id="warpCaixa">
			        <label class="ls-label col-lg-12 col-xs-12">
			            <b class="ls-label-text">CPF do Participante:</b>
			            <input type="text" name="cpf" id="cpf" class="ls-field" placeholder="Apenas números" required>
			        </label>
			    </div>

			    <div id="warpNome" style="display: none">
			    	<label class="ls-label col-lg-12 col-xs-12">
			            <b class="ls-label-text">Nome:</b>
			            <input type="text" name="nomeP" id="nomeP" class="ls-field" placeholder="Nome" required>
			        </label>
				</div>

				<input type="hidden" name="idEntidade" id="idEntidade">

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

			</form>
		</div>


		<div class="ls-txt-center" id="msgErro" style="display: none">
			<h3>Você ainda não tem cadastro.</h3>
			<p>Utilize o formulário de cadastro antes de se inscrever nos minicursos</p>
			<a href="inscricaoExterna.php" class="ls-btn-primary ls-btn-lg ls-text-uppercase col-lg-4 col-xs-11 col-lg-push-4">Formulário de Cadastro</a>
		</div>
	</body>
</html>
