<?php 
	require_once 'gerencia_login.php';
	
	$e = new Empresa();
	$empresa = $e->retornarEmpresa();
?>
<div class="ls-topbar ">

  <!-- Barra de Notifica��es -->
  <div class="ls-notification-topbar">

    <!-- Dropdown com detalhes da conta de usu�rio -->
    <div data-ls-module="dropdown" class="ls-dropdown ls-user-account">
      <a href="#" class="ls-ico-user">
        <!-- <img src="images/locastyle/avatar-example.jpg" alt="" /> -->
        <span class="ls-name"><?=$empresa->getLogin()?></span>
      </a>

      <nav class="ls-dropdown-nav ls-user-menu">
        <ul>
          <li><a href="#">Alterar Senha</a></li>
          <li><a href="dadosEmpresa.php">Meus dados</a></li>
          <li><a href="#">Sair</a></li>
         </ul>
      </nav>
    </div>
  </div>

  <span class="ls-show-sidebar ls-ico-menu"></span>

  <!-- Nome do produto/marca com sidebar -->
    <h1 class="ls-brand-name">
      <a href="home" class="ls-ico-earth">
        <small>Gest�o de Certificados</small>
        EasyCad
      </a>
    </h1>

  <!-- Nome do produto/marca sem sidebar quando for o pre-painel  -->
</div>