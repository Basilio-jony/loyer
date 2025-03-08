<!DOCTYPE html>
<html>
<head> 
  <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
  <meta charset="utf-8">
  <meta https-equiv="X-UA-Compatible" content="IE=edge">
  <meta https-equiv="refresh" content="10">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="Keywords" content="LOUKMAN-TRANS,transit,douane,transport"/>
  <meta name="author" lang="fr" content="dovi KOGBA,KOGBA Dovi"/>
  <meta name="Robots" content="index,follow,all">
  <meta name="Revisit-after" content="7 days">
  <meta name="Identifier-URL" content="https://www.li-industrie.com">
  <meta name="distribution" content="Global">
  <meta name="Category" content="Internet">
  <meta name="content" Language="French">
  <meta name="format-detection" content="telephone=no">

  <link rel="shortcut icon" href="<?= base_url('img/logo.png') ?>" type="image/x-icon">
  <link href="<?php echo base_url('css/mycss.css')?>" rel="stylesheet" type='text/css'>
  <!-- label -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('java_label/atmos.css')?>">
<!-- fin label -->
 
  <title>Fazer&nbsp;Login</title>
</head>

  <body  class="orko dark-bg">
    <div class="login-body">
      <div class="login-content">
        <div class="login-box" style="border-radius: 25px;"  >
          <div class="login-logo">
            <img class="logo rounded img-fluid" src="<?php echo base_url('img/logo.png')?>" alt="logo">
          <i> CSA</i>
          </div>          
          <form method="post" class="username-challenge" autocomplete="off" action="<?= site_url('Signin')."?parametre=".md5('ok').'& action !='.md5("go") ?>">
            <?= csrf_field(); ?>
            <h2 class="sign-in-title" style="text-align: center">Fazer&nbsp;Loggin</h2>
            <?php  
            if (session()->getTempdata('passerror')) {?>
              <div class="alert alert-danger">
                <p><?php echo session()->getTempdata('passerror'); ?> </p> 
              </div>
            <?php } ?>
            <div class="form-row">
                <div class="form-group floating-label col-md-12 show-label orko pure-form">
                    <label style="color: #007BFD">Endereço&nbsp;de email</label>
                    <input class="form-control orko pure-form" autocomplete="off" tabindex="1" type="text" name="username" placeholder="Insira&nbsp;o seu&nbsp;endereço&nbsp;de email" autofocus id="loginFormInputLogin">
                    <strong class="rouge"><?= $validation->getError('username') ?></strong>
                </div>
                <div class="form-group floating-label col-md-12 show-label">
                    <label style="color: #007BFD">Password</label>
                    <input type="password" class="form-control" name="passwd" placeholder="Insira&nbsp;a&nbsp;sua&nbsp;palavra passe" tabindex="2" id="passwordFormInputLogin">
                  <strong class="rouge"><?= $validation->getError('passwd') ?></strong>
                </div>
            </div> <br/><br/>
            <button id="submit" type="submit" class="pure-button puree-button-primary puree-spinner-button" style='width: 100%; text-align: center; border-radius: 8px'>Entrar</button>
              <br/><br/>
          </form>
          
        </div>  
      </div>
      <img  style="width: 100%; height: 100%; background-size: cover;" src="<?php echo base_url('img/usine.png');?>" alt="lower">
    </div> 
      <!-- pied -->
    <footer class="login-footer">
      <p class="container pied">Copyright &copy; <?php $s=date("Y"); echo "2023 " . "- ". $s;?> Todos Direitos Reservados | CSA
     </p>
    </footer> 
    
    <?= $this->include('footer/script_bas')  ?>
  </body>
</html>