<?php 
	require_once 'gerencia_login.php';
	
	if(isset($_POST['nome'])){
		$e = new Evento();
		$e->setNomeEvento($_POST['nome']);
		$e->setDataInicio($_POST['inicio']);
		$e->setDateFim($_POST['fim']);
		$e->setModalidade($_POST['modalidade']);
		$e->setValor($_POST['valor']);
		$e->setCargaHoraria($_POST['ch']);
		$e->setGeraCertificado($_POST['geraCert']);
		$e->inserirEvento();
	}	
?>
<!DOCTYPE html>
<html class="ls-theme-green">
  <head>
    <title>EasyCad</title>

    <?php require_once('assets.php');?>
    
  </head>
  <body>

    <?php require_once('header.php');?>

    <?php require_once('aside.php');?>

    <main class="ls-main ">
      <div class="container-fluid">
        <h1 class="ls-title-intro ls-ico-home">Cadastro de Evento</h1>
        
        <div class="col-lg-12 col-xs-12">
          <form method="post" class="ls-form ls-form-horizontal row" action="cadEvento.php">

            <label class="ls-label col-lg-12 col-xs-12">
                <b class="ls-label-text">Nome do Evento:</b>
                <input type="text" name="nome" class="ls-field" placeholder="Nome do Evento">
            </label>
            
            <label class="ls-label col-lg-6 col-xs-12">
                <b class="ls-label-text">Data Início:</b>
                <input type="date" name="inicio" class="ls-field">
            </label>

            <label class="ls-label col-lg-6 col-xs-12">
                <b class="ls-label-text">Data Fim:</b>
                <input type="date" name="fim" class="ls-field">
            </label>

            <label class="ls-label col-lg-6 col-xs-12">
              <b class="ls-label-text">Modalidade de Inscrição:</b>
              <div class="ls-custom-select">
                <select class="ls-custom" name="modalidade">
                    <option value="P">Presencial</option>
                    <option value="O">Online</option>
                    <option value="PO">Presencial + Online</option>
                    <option value="N">Nenhuma</option>
                </select>
              </div>
            </label>

            <label class="ls-label col-lg-6 col-xs-12">
                <b class="ls-label-text">Valor:</b>
                <input type="number" step="0.01" placeholder="R$ 0.00" name="valor" class="ls-field">
            </label>

            <label class="ls-label col-lg-6 col-xs-12">
                <b class="ls-label-text">Carga Horária:</b>
                <input type="number" placeholder="Valor em Horas" min="1" name="ch" class="ls-field">
            </label>


            <div class="ls-label col-lg-6 col-xs-12">
              <strong><p>Gera Certificado?</p></strong>

              <label class="ls-label-text">
                <input type="radio" class="ls-field-radio" name="geraCert" value="S" id="geraS" checked>
                Sim
              </label>

              <label class="ls-label-text">
                <input type="radio" class="ls-field-radio" name="geraCert" value="N" id="geraN">
                Não
              </label>

            </div>
              
                            
            <input type="submit" value= "Cadastrar" class="ls-btn-primary ls-btn-lg ls-text-uppercase col-lg-4 col-xs-11 col-lg-pull-2">    
                
          </form>
        </div>

      </div>
    </main>

    <?php require_once('assets-footer.php');?>

  </body>
</html>