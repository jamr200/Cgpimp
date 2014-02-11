<?php /*%%SmartyHeaderCode:1812552fa536b13d1b4-39602487%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bd063d99b8f2eecd3cbca827109a4cdffa4eb19d' => 
    array (
      0 => 'application\\views\\templates\\start\\start_view.tpl',
      1 => 1390909266,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1812552fa536b13d1b4-39602487',
  'variables' => 
  array (
    'success' => 0,
    'error' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52fa536b1b2633_35435557',
  'cache_lifetime' => 120,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52fa536b1b2633_35435557')) {function content_52fa536b1b2633_35435557($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shorcut icon" href="http://localhost/Cgpimp/img/favicon.ico" type='image/png'>

    <title>Gestion de dispositivos</title>

<!--
    <link href="http://localhost/Cgpimp/css/estilo.css" rel="stylesheet" type="text-css">
    <!-- Bootstrap core CSS 
    <link href="http://localhost/Cgpimp/css/bootstrap.css" rel="stylesheet" type="text-css">
    <link href="http://localhost/Cgpimp/css/bootstrap-responsive.css" rel="stylesheet" type="text-css">

    <!-- Custom styles for this template 
    <link href="http://localhost/Cgpimp/css/signin.css" rel="stylesheet">
  -->
    <style>
      @import url('http://localhost/Cgpimp/css/bootstrap.css');
      @import url('http://localhost/Cgpimp/css/bootstrap-responsive.css');
      @import url('http://localhost/Cgpimp/css/estilo.css');
      @import url('http://localhost/Cgpimp/css/signin.css');
    </style>

  </head>

  <body>

    <img class="logo-cabecera" src="http://localhost/Cgpimp/img/logo1.png" alt="">

    <div class="container">
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <h2>Sistema de gestión de dispositivos</h2>
                        <form class="form-signin" action="http://localhost/Cgpimp/usuario_controller/login" method="POST">
        <fieldset>
          <h3 class="form-signin-heading">Login de usuario</h3>
          <input type="text" class="form-control" name="log_email" placeholder="Email" autofocus>
          <input type="password" class="form-control" name="log_pass" placeholder="Contraseña">

          <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
          <!--<a href="http://localhost/Cgpimp/usuario_controller/alta_usuario" id="nuevo_usuario" class="btn btn-lg btn-default btn-block">Registrarse</a>-->
        </fieldset>
      </form>
      </div>
      <div class="col-md-3"></div>
    </div>
    </div> <!-- /container -->

  </body>
</html><?php }} ?>