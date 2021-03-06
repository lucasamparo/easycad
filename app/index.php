<?php 
	require_once('../models/bootstrap.php');
	session_start();
	$mensagem = "";
	
	if(isset($_POST['login'])){
		$e = new Empresa();
		$empresa = $e->retornarEmpresa();
		if($_POST['login'] == $empresa->getLogin()){
			if(md5($_POST['senha']) == $empresa->getSenha()){
				$_SESSION['easycad']['logado'] = true;
				header('Location: inicio.php');
			} else { 
				$mensagem = "Usuário ou Senha inválidos!"; 
			}
		}
	}
	
?>
<!DOCTYPE html>
<html class="ls-theme-green">
<head>
  <meta charset="utf-8">
  <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
  <title>EasyCad</title>
  <meta name="description" content="" />
  <meta name="keywords" content="" />
  <link href="css/locastyle.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
  <script src="js/jquery.growl.js" type="text/javascript"></script>
  <link href="css/jquery.growl.css" rel="stylesheet" type="text/css" />
</head>
<body>


<?php if($mensagem != ""):?>
  <script>
    $(document).ready(function() {
      $.growl.error({message: "<?php echo $mensagem;?>"})
    });
  </script>
<?php endif;?>



<div class="ls-login-parent">
  <div class="ls-login-inner">
    <div class="ls-login-container">
      <div class="ls-login-box">
  <h1 class="ls-login-logo"><img title="Logo EasyCad" src="images/easycad.png" width="260" height="91" /></h1>
  <form role="form" class="ls-form ls-login-form" action="index.php" method="post">
    <fieldset>

      <label class="ls-label">
        <b class="ls-label-text ls-hidden-accessible">Usuário</b>
        <input class="ls-login-bg-user ls-field-lg" type="text" placeholder="Usuário" name="login" required autofocus>
      </label>

      <label class="ls-label">
        <b class="ls-label-text ls-hidden-accessible">Senha</b>
        <div class="ls-prefix-group">
          <input id="password_field" name="senha" class="ls-login-bg-password ls-field-lg" type="password" placeholder="Senha" required>
          <a class="ls-label-text-prefix ls-toggle-pass ls-ico-eye" data-toggle-class="ls-ico-eye, ls-ico-eye-blocked" data-target="#password_field" href="#"></a>
        </div>
      </label>

      <input type="submit" value="Entrar" class="ls-btn-primary ls-btn-block ls-btn-lg">
      <!-- <div class="ls-alert-danger text-center"><?= $mensagem;?></div> -->

    </fieldset>
  </form>
</div>

    </div>
  </div>
</div>

<script src="js/locastyle.js" type="text/javascript"></script>

</body>
</html>
