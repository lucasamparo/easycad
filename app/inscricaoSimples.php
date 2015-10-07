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
		<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
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
								html = '<input type="checkbox" name="cursos[]" id="curso'+data[i].id+'" value="'+data[i].id+'"><label for="curso'+data[i].id+'">'+data[i].nome+'</label>';
								$('#cursos').append(html);
							}
		                 }
					});
				});
			});
		</script>
	</head>
	<body>
		<form method="post" action="inscricaoSimples.php" id="form">
			<div id="warpCaixa">
				<label>CPF do Participante:</label>
				<input type="text" name="cpf" id="cpf"><br>
			</div>			
			<div id="warpNome" style="display: none">
				<input type="text" name="nomeP" id="nomeP"><br>
			</div>
			<input type="hidden" name="idEntidade" id="idEntidade">
			<select name="evento" id="evento">
				<?php 
					$e = new Evento();
					$ev = $e->retornarEventoExterno();
					foreach($ev as $e){
						if($e->getAtivo() == 'S'){
							echo '<option value="'.$e->getIdEvento().'">'.$e->getNomeEvento().'</option>';
						}						
					}
				?>
			</select><br>
			<div id="cursos"></div>
			<input type="submit" value="Inscrever">
		</form>
		<div id="msgErro" style="display: none">
			<h3>Você ainda não tem cadastro.</h3>
			<p>Utilize o formulário de cadastro antes de se inscrever nos minicursos</p>
			<a href="inscricaoExterna.php">Formulário de Cadastro</a>
		</div>
	</body>
</html>
