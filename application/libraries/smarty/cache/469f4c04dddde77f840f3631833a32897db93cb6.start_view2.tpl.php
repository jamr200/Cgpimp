<?php /*%%SmartyHeaderCode:1729352f16f05928212-74158096%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '469f4c04dddde77f840f3631833a32897db93cb6' => 
    array (
      0 => 'application\\views\\templates\\start\\start_view2.tpl',
      1 => 1391514389,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1729352f16f05928212-74158096',
  'variables' => 
  array (
    'success' => 0,
    'error' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52f16f05997489_68501517',
  'cache_lifetime' => 120,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52f16f05997489_68501517')) {function content_52f16f05997489_68501517($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shorcut icon" href="http://localhost/pfcdata/img/favicon.ico" type='image/png'>

    <title>Gestion de dispositivos</title>

<!--
    <link href="http://localhost/pfcdata/css/estilo.css" rel="stylesheet" type="text-css">
    <!-- Bootstrap core CSS 
    <link href="http://localhost/pfcdata/css/bootstrap.css" rel="stylesheet" type="text-css">
    <link href="http://localhost/pfcdata/css/bootstrap-responsive.css" rel="stylesheet" type="text-css">

    <!-- Custom styles for this template 
    <link href="http://localhost/pfcdata/css/signin.css" rel="stylesheet">
  -->
    <style>
      @import url('http://localhost/pfcdata/css/bootstrap.css');
      @import url('http://localhost/pfcdata/css/bootstrap-responsive.css');
      @import url('http://localhost/pfcdata/css/estilo.css');
      @import url('http://localhost/pfcdata/css/changing.css');
    </style>

  </head>

  <body>

    <img class="logo-cabecera" src="http://localhost/pfcdata/img/logo1.png" alt="">

    <div class="container">
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <h2>Sistema de gestión de dispositivos</h2>
                        <form class="form-signin" action="http://localhost/pfcdata/usuario_controller/cambiarPass" method="POST">
        <fieldset>
          <h3 class="form-signin-heading">Cambiar contraseña</h3>
          <input type="password" class="form-control" name="log_pass_actual" placeholder="Contraseña actual" autofocus>
          <input type="password" class="form-control" name="log_pass_nuevo" placeholder="Contraseña nueva">
          <input type="password" class="form-control" name="log_repass_nuevo" placeholder="Repita contraseña nueva">

          <button class="btn btn-lg btn-primary btn-block" type="submit">Cambiar Contraseña</button>
          <!--<a href="http://localhost/pfcdata/usuario_controller/alta_usuario" id="nuevo_usuario" class="btn btn-lg btn-default btn-block">Registrarse</a>-->
        </fieldset>
      </form>
      </div>
      <div class="col-md-3"></div>
    </div>
    </div> <!-- /container -->

  </body>
</html><?php }} ?>