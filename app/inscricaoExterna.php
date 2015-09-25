<?php 
	require_once 'gerencia_login.php';
	
	if(isset($_POST['nome'])){
		$e = new Entidade();
		$e->setNomeEntidade($_POST['nome']);
		$e->setCnpjCpf($_POST['cpf']);
		$e->setTelefone($_POST['tel']);
		$e->setEmail($_POST['email']);
		$e->setTipo('PF');
		$e->inserirEntidade();
		if($e){
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
		<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
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
		<form method="post" action="inscricaoExterna.php">
			<label>Nome do Participante:</label>
			<input type="text" name="nome"><br>
			<label>CPF:</label>
			<input type="text" name="cpf"><br>
			<label>Telefone:</label>
			<input type="text" name="tel"><br>
			<label>Email:</label>
			<input type="text" name="email"><br>
			<select name="evento" id="evento">
				<?php 
					$e = new Evento();
					$ev = $e->retornarEventoExterno();
					foreach($ev as $e){
						echo '<option value="'.$e->getIdEvento().'">'.$e->getNomeEvento().'</option>';
					}
				?>
			</select><br>
			<div id="cursos"></div>
			<input type="submit" value="Inscrever">
		</form>
	</body>
</html>
