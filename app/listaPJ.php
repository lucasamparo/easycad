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
        <h1 class="ls-title-intro ls-ico-home">Listagem de Pessoas Jurídicas</h1>
        <!-- Conteúdo -->
        <table>
        	<thead>
        		<th>Nome da PJ</th>
        		<th>CNPJ</th>
        		<th>Contagem de Eventos</th>
        	</thead>
        	<tbody>
        	<?php 
        		$e = new Entidade();
        		$entidades = $e->retornarPJ();
        		foreach($entidades as $e){
        			echo '<tr>';
        				echo '<td>'.$e->getNomeEntidade().'</td>';
        				echo '<td>'.$e->getCnpjCpf().'</td>';
        				echo '<td>'.count($e->getMatricula()).' Eventos</td>';
        			echo '</tr>';
        		}
        	?>
        	</tbody>
        </table>
        
        
        <!-- Fim Conteúdo -->
      </div>
      <?php require_once('footer.php');?>
    </main>

    
    <?php require_once('assets-footer.php');?>

  </body>
</html>