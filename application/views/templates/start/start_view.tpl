<!DOCTYPE html>

<!--
/*
 * Copyright (C) 2014 jamr200
 *
 * This file is part Cgpimp.
 *
 * This program is free software: you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License
 * for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * this program. If not, see <http://www.gnu.org/licenses/>
 */
 -->

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shorcut icon" href="{base_url()}img/favicon.ico" type='image/png'>

    <title>Gestion de dispositivos</title>

<!--
    <link href="{base_url()}css/estilo.css" rel="stylesheet" type="text-css">
    <!-- Bootstrap core CSS
    <link href="{base_url()}css/bootstrap.css" rel="stylesheet" type="text-css">
    <link href="{base_url()}css/bootstrap-responsive.css" rel="stylesheet" type="text-css">

    <!-- Custom styles for this template
    <link href="{base_url()}css/signin.css" rel="stylesheet">
  -->
    <style>
      @import url('{base_url()}css/bootstrap.css');
      @import url('{base_url()}css/bootstrap-responsive.css');
      @import url('{base_url()}css/estilo.css');
      @import url('{base_url()}css/signin.css');
    </style>

  </head>

  <body>

    <img class="logo-cabecera" src="{base_url()}img/logo1.png" alt="">

    <div class="container">
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <h2>Sistema de gestión de dispositivos</h2>
        {if isset($success)}
            <div class="alert alert-success"> {$success}</div>
        {/if}
        {if isset($error)}
            <div class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign"></span> {$error}</div>
        {/if}
        <form class="form-signin" action="{base_url()}usuario_controller/login" method="POST">
        <fieldset>
          <h3 class="form-signin-heading">Login de usuario</h3>
          <input type="text" class="form-control" name="log_email" placeholder="Email" autofocus>
          <input type="password" class="form-control" name="log_pass" placeholder="Contraseña">

          <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
          <!--<a href="{base_url()}usuario_controller/alta_usuario" id="nuevo_usuario" class="btn btn-lg btn-default btn-block">Registrarse</a>-->
        </fieldset>
      </form>
      </div>
      <div class="col-md-3"></div>
    </div>
    </div> <!-- /container -->

  </body>
</html>