<?php /*%%SmartyHeaderCode:11597526690a5830fa5-12179657%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c98132d8edf78e031b777ad94ee8f2cee1afd2f3' => 
    array (
      0 => 'application\\views\\templates\\usuario\\alta_usuario.tpl',
      1 => 1382453404,
      2 => 'file',
    ),
    '57af232e22ee9f7c4bbce0da0087391b39380300' => 
    array (
      0 => 'application\\views\\templates\\includes\\header.tpl',
      1 => 1382436268,
      2 => 'file',
    ),
    '13dd2963ff5ec3d260fc0e69ad79998940ada34f' => 
    array (
      0 => 'application\\views\\templates\\includes\\footer.tpl',
      1 => 1381828055,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11597526690a5830fa5-12179657',
  'variables' => 
  array (
    'error' => 0,
    'success' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_526690a58fff92_38550820',
  'cache_lifetime' => 120,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_526690a58fff92_38550820')) {function content_526690a58fff92_38550820($_smarty_tpl) {?><!DOCTYPE html>

<html lang="es-ES">
<head>
	<meta charset="utf-8">
	<title>Gestion de dispositivos</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Aplicacion web de control de impresoras y los consumibles correspondientes.">
	<meta name="author" content="Jose">
	<link rel="shorcut icon" href="http://localhost/pfcdata/img/favicon.ico" type='image/png'>
	<!--<style type="text/css">
		body{ padding-top: 60px; padding-bottom: 40px; }
	</style>-->

	<link href="http://localhost/pfcdata/css/bootstrap.css" rel="stylesheet" type="text-css">
	<link href="http://localhost/pfcdata/css/bootstrap-responsive.css" rel="stylesheet" type="text-css">
	<link href="http://localhost/pfcdata/css/style.css" rel="stylesheet" type="text-css">
	<link href="http://localhost/pfcdata/css/estilo.css" rel="stylesheet" type="text-css">
	<link href="http://localhost/pfcdata/css/select2/select2.css" rel="stylesheet" type="text-css">
	<link href="http://localhost/pfcdata/css/select2-bootstrap.css" rel="stylesheet" type="text-css">
	<link href="http://localhost/pfcdata/css/bootstrap-duallistbox.css" rel="stylesheet" type="text-css">

<!--
	<style>
		@import url('http://localhost/pfcdata/css/bootstrap.css');
		@import url('http://localhost/pfcdata/css/bootstrap-responsive.css');
		@import url('http://localhost/pfcdata/css/style.css');
		@import url('http://localhost/pfcdata/css/estilo.css');
		@import url('http://localhost/pfcdata/css/select2/select2.css');
	</style>


	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
-->
	<script src="http://localhost/pfcdata/js/jquery.js" type="text/javascript"></script>
	<script src="http://localhost/pfcdata/js/bootstrap.js" type="text/javascript"></script>
	<script src="http://localhost/pfcdata/js/validacion/jquery.validate.js" type="text/javascript"></script>
	<script src="http://localhost/pfcdata/js/validacion/messages_es.js" type="text/javascript"></script>
	<script src="http://localhost/pfcdata/js/select2.js" type="text/javascript"></script>
	<script src="http://localhost/pfcdata/js/bootstrap-duallistbox.js" type="text/javascript"></script>
	<script src="http://localhost/pfcdata/js/multi-upload/jquery.MultiFile.js" type="text/javascript"></script>

	<!--Reglas de validacion extras-->
	
	<script>
		jQuery.validator.addMethod("exactlength", function(value, element, param) {
		return this.optional(element) || value.length == param;
		}, jQuery.format("Please enter exactly 0 characters."));
	</script>
</head>

<body>

<!-- imagen logotipo --> 
<img class="logo-cabecera" src="http://localhost/pfcdata/img/logo2.png" alt="">
<!-- fin imagen logotipo --> 
<div class="container">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			
									<form id="usuariosform" action="http://localhost/pfcdata/usuario_controller/addUsuario" method="POST">
				<fieldset class="fieldset">
					<legend>Formulario para registro de usuarios</legend>
					<!-- ************************-->
					<div class="col-md-12">
						<div class="form-group">
							<label for="nombre">Inserta nombre: </label>
							<input type="text" class="form-control" id="nombre" name="nombre" value="" placeholder="Nombre">
						</div>
					</div>
					<!-- ************************-->
					<div class="col-md-12">
						<div class="form-group">
							<label for="apellidos">Apellidos:</label>
							<input type="text" class="form-control" name="apellidos" id="apellidos" value="" placeholder="Apellidos">
						</div>
					</div>
					<!-- ************************-->
					<div class="col-md-12">
						<div class="form-group">
							<label for="email">Inserta email: </label>
							<input type="text" class="form-control" id="email" name="email" value="" placeholder="Email">
						</div>
					</div>
					<!-- ************************-->
					<div class="col-md-12">
						<div class="form-group">
							<label for="password">Password:</label>
							<input type="password" class="form-control" name="password" id="password" value="" placeholder="Contraseña">
						</div>
					</div>
					<!-- ************************-->
					<div class="col-md-12">
						<div class="form-group">
							<label for="repassword">Repite password:</label>
							<input type="password" class="form-control" name="repassword" id="repassword" value="" placeholder="Repita contraseña">
						</div>
					</div>
					<!-- ************************-->
					<div class="col-md-12">
						<button type="submit" class="btn btn-primary">Guardar usuario</button>
						<a href="http://localhost/pfcdata/main" class="btn btn-default">Cancelar</a>
					</div>
					<!-- ************************-->
				</fieldset>
			</form>
		</div>
		<div class="col-md-3"></div>
	</div>
</div>





<script>
	$(document).ready(function(){
		$('#usuariosform').validate({
			errorElement: "span",
			errorClass: 'help-block',
			rules: 
			{
				nombre: {required: true, minlength: 3, maxlength: 30},
				apellidos: {required: true, minlength: 4, maxlength: 50},
				email: {required: true, email: true},
				password: {required: true, minlength: 6, maxlength: 30},
				repassword: {equalTo: "#password", minlength: 6, maxlength: 30}
			},
			messages:
			{
				nombre: "El campo es obligatorio y debe tener entre 3 y 30 caracteres.",
				apellidos: "El campo es obligatorio y debe tener entre 4 y 50 caracteres.",
				email : "El campo es obligatorio y debe tener formato de email correcto.",
				password : "El campo password es obligatorio y debe tener al menos 6 caracteres.",
				repassword : "Este campo debe tener al menos 6 caracteres y debe coincidir con el campo password."
			},
			highlight: function(element) 
			{
				$(element).closest('.form-group')
				.removeClass('has-success').addClass('has-error');
			},
			success: function(element) 
			{
				$(element).addClass('help-inline')
				.closest('.form-group')
				.removeClass('has-error').addClass('has-success');
			}
		});
	});
</script>


</body>
</html> <?php }} ?>