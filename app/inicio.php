<!DOCTYPE html>
<html class="ls-theme-green">
  <head>
    <title>EasyCad</title>

    <?php require_once('assets.php');?>
    
    <style type="text/css">

     .efeito {
    -webkit-transform: rotateX(360deg) rotateZ(0deg);
    -moz-transform: rotateX(360deg) rotateZ(0deg);
    -o-transform: rotateX(360deg) rotateZ(0deg);
    -ms-transform: rotateX(360deg) rotateZ(0deg);
    transform: rotateX(360deg) rotateZ(0deg);
    }

    .efeito{

      -webkit-transform: perspective(600px) rotateY(0deg);
      -moz-transform:perspective(600px) rotateY(0deg);
      -o-transform:perspective(600px) rotateY(0deg) ;
      -webkit-transition:All 0.8s ease;
      -moz-transition:All 0.8s ease;
      -o-transition:All 0.8s ease;
    }
    .efeito:hover{
      -webkit-transform: perspective(600px) rotateY(360deg) ;
      -moz-transform: perspective(600px) rotateY(360deg) ;
      -o-transform: perspective(600px) rotateY(360deg);
    }




    </style>
  
  </head>
  <body>

    <?php require_once('header.php');?>

    <?php require_once('aside.php');?>

    <main class="ls-main ">
      <div class="container-fluid">
        <h1 class="ls-title-intro ls-ico-home">Página inicial</h1>
        <!-- Conteúdo -->
        
        <p style="text-align:center;"><img class="efeito" title="EasyCad" src="images/easycad_logo.png" width="400" height="400" /></p>
        
        
        <!-- Fim Conteúdo -->
      </div>
      <?php require_once('footer.php');?>
    </main>

    
    <?php require_once('assets-footer.php');?>

  </body>
</html>