<?php 
	require_once 'gerencia_login.php';
	
	$e = new Empresa();
	$empresa = $e->retornarEmpresa();
?>
<div class="ls-topbar ">

  <!-- Barra de Notificações -->
  <div class="ls-notification-topbar">

    <!-- Dropdown com detalhes da conta de usuário -->
    <div data-ls-module="dropdown" class="ls-dropdown ls-user-account">
      <a href="#" class="ls-ico-user">
        <!-- <img src="images/locastyle/avatar-example.jpg" alt="" /> -->
        <span class="ls-name" style="text-transform:uppercase;"><?=$empresa->getLogin()?></span>
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
      <a href="inicio.php" class="ls-ico-docs">
        <small>Gestão de Certificados</small>
        EasyCad
      </a>
    </h1>

  <!-- Nome do produto/marca sem sidebar quando for o pre-painel  -->
</div>