<?php 
	require_once 'gerencia_login.php';

  $mensagem = "";
	
	if(isset($_POST['nome'])){
		$c = new Curso();
		$c->setNomeCurso($_POST['nome']);
		if($_POST['evento'] != 0){
			$c->setIdEvento($_POST['evento']);
		} else {
			$e = new Evento();
			$e->setNomeEvento($_POST['nome']);
			if($_POST['tipoData'] == 'U'){
				$e->setDataInicio($_POST['dataInicioA']);
			} else {
				$e->setDataInicio($_POST['dataInicioB']);
				$e->setDataFim($_POST['dataFim']);
			}
			$e->setModalidade('N');
			$e->setGeraCertificado('N');
			$e->setValor($_POST['valor']);
			$e->setCargaHoraria($_POST['ch']);
			$e->inserirEvento();
			$c->setIdEvento($e->getIdEvento());
		}
		$c->setLocal($_POST['local']);
		$c->setConteudo($_POST['conteudo']);
		$c->setValor($_POST['valor']);
		$c->setCargaHoraria($_POST['ch']);
		if($_POST['tipoData'] == 'U'){
			$c->setDataInicio($_POST['dataInicioA']);
		} else {
			$c->setDataInicio($_POST['dataInicioB']);
			$c->setDataFim($_POST['dataFim']);
		}
		$c->inserirCurso();

    $mensagem = "Curso cadastrado com sucesso!";
	}	
?>
<!DOCTYPE html>
<html class="ls-theme-green">
  <head>
    <title>EasyCad</title>

    <?php require_once('assets.php');?>
    <script type="text/javascript">
		$(document).ready(function(){
			$('#U').click(function(){
				$('#unica').css('display','inline');
				$('#multipla').css('display','none');
			});
			$('#M').click(function(){
				$('#unica').css('display','none');
				$('#multipla').css('display','inline');
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
        <h1 class="ls-title-intro ls-ico-book">Cadastro de Curso</h1>
        

        <div class="col-lg-12 col-xs-12">
          <form method="post" class="ls-form ls-form-horizontal row" action="cadCurso.php">

            <label class="ls-label col-lg-12 col-xs-12">
                <b class="ls-label-text">Nome:</b>
                <input type="text" name="nome" class="ls-field" placeholder="Nome" required>
            </label>

            <label class="ls-label col-lg-6 col-xs-12">
              <b class="ls-label-text">Evento:</b>
              <div class="ls-custom-select">
                <select class="ls-custom" name="evento" required>
                    <option value="0">Nenhum Evento</option>
                      <?php 
                        $e = new Evento();
                        $evento = $e->retornarEventos();
                        foreach($evento as $e){
                          echo '<option value="'.$e->getIdEvento().'">'.$e->getNomeEvento().'</option>';
                        }
                      ?>
                </select>
              </div>
            </label>

            <label class="ls-label col-lg-6 col-xs-12">
                <b class="ls-label-text">Local:</b>
                <input type="text" name="local" class="ls-field" placeholder="Local" required>
            </label>

            <label class="ls-label col-lg-12 col-xs-12">
                <b class="ls-label-text">Conteúdo Programático: (Separar o conteúdo com ponto e vírgula " ; ")</b>
                <textarea rows="10" name="conteudo" placeholder="Descrição..." class="ls-field" required></textarea>
            </label>

            <label class="ls-label col-lg-6 col-xs-12">
                <b class="ls-label-text">Valor:</b>
                <input type="number" step="0.01" placeholder="R$ 0,00" name="valor" class="ls-field" required>
            </label>

            <label class="ls-label col-lg-6 col-xs-12">
                <b class="ls-label-text">Carga Horária:</b>
                <input type="number" placeholder="Valor em Horas" min="1" name="ch" class="ls-field" required>
            </label>

            <div class="ls-label col-lg-12 col-xs-12">
              <strong><p>Datas:</p></strong>

              <label class="ls-label-text">
                <input type="radio" class="ls-field-radio" name="tipoData" value="U" id="U" checked>
                Única Data
              </label>

              <label class="ls-label-text">
                <input type="radio" class="ls-field-radio" name="tipoData" value="M" id="M">
                Múltiplas Datas
              </label>

            </div>

            <div id="unica" style="display: inline">
              
              <label class="ls-label col-lg-12 col-xs-12">
                <b class="ls-label-text">Data do Curso:</b>
                <input type="date" name="dataInicioA" class="ls-field">
              </label>


            </div>


                
            <div id="multipla" style="display: none">

              <label class="ls-label col-lg-6 col-xs-12">
                  <b class="ls-label-text">Data Início:</b>
                  <input type="date" name="dataInicioB" class="ls-field">
              </label>

              <label class="ls-label col-lg-6 col-xs-12">
                  <b class="ls-label-text">Data Fim:</b>
                  <input type="date" name="dataFim" class="ls-field">
              </label> 



            </div>           
                            
            <input type="submit" value= "Cadastrar" class="ls-btn-primary ls-btn-lg ls-text-uppercase col-lg-4 col-xs-11 col-lg-push-4">    
        
          </form>
        </div>


      </div>
      <?php require_once('footer.php');?>
    </main>

    <?php require_once('assets-footer.php');?>

  </body>
</html>