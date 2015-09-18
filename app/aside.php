<aside class="ls-sidebar">
    <div data-ls-module="dropdown" class="ls-dropdown ls-user-account">
        <?php 
        require_once 'gerencia_login.php';
    
        $e = new Empresa();
        $empresa = $e->retornarEmpresa();
        ?>

              <a href="#" class="ls-ico-user" style="text-transform:uppercase;">
                <small><?=$empresa->getLogin()?></small>
              </a>
              <nav class="ls-dropdown-nav ls-user-menu">
                <ul>
                  <li><a href="#">Alterar Senha</a></li>
                  <li><a href="dadosEmpresa.php">Meus dados</a></li>
                  <li><a href="#">Sair</a></li>
                </ul>
              </nav>
            </div>


  <div class="ls-sidebar-inner">
      
      <nav class="ls-menu">
        <ul>
           <li><a href="inicio.php" class="ls-ico-dashboard" title="Dashboard">Dashboard</a></li>
           <li>
            <a href="#" class="ls-ico-cog" title="Cadastros gerais">Cadastros</a>
            <ul>
              <li><a href="cadEvento.php">Cadastro de Eventos</a></li>
              <li><a href="cadCurso.php">Cadastro de Cursos</a></li>
              <li><a href="cadParticipante.php">Cadastro de Participantes</a></li>
            </ul>
          </li>
           <li><a href="#" class="ls-ico-stats" title="Relatórios">Relatório</a>
           	<ul>
           		<li><a href="listaEvento.php">Listagem de Eventos</a></li>
           	</ul>
           </li>
           <li>
            <a href="#" class="ls-ico-cog" title="Configurações">Configurações</a>
            <ul>
              <li><a href="#">Alterar Senha</a></li>
              <li><a href="dadosEmpresa.php">Meus Dados</a></li>
            </ul>
          </li>
        </ul>
      </nav>


  </div>
</aside>