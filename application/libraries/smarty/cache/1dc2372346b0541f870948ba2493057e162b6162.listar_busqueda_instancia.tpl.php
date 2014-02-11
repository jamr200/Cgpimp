<?php /*%%SmartyHeaderCode:2379552ea3e9e768d11-17807661%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1dc2372346b0541f870948ba2493057e162b6162' => 
    array (
      0 => 'application\\views\\templates\\dispositivo\\listar_busqueda_instancia.tpl',
      1 => 1382542701,
      2 => 'file',
    ),
    '57af232e22ee9f7c4bbce0da0087391b39380300' => 
    array (
      0 => 'application\\views\\templates\\includes\\header.tpl',
      1 => 1390909770,
      2 => 'file',
    ),
    'f8953d645edff036c3a9a536ab2c5d02a31d159b' => 
    array (
      0 => 'application\\views\\templates\\includes\\barra_navegacion.tpl',
      1 => 1390909747,
      2 => 'file',
    ),
    '13dd2963ff5ec3d260fc0e69ad79998940ada34f' => 
    array (
      0 => 'application\\views\\templates\\includes\\footer.tpl',
      1 => 1381828055,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2379552ea3e9e768d11-17807661',
  'variables' => 
  array (
    'instancias' => 0,
    'fila' => 0,
    'paginacion' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52ea3e9e929601_68158695',
  'cache_lifetime' => 120,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52ea3e9e929601_68158695')) {function content_52ea3e9e929601_68158695($_smarty_tpl) {?><!DOCTYPE html>

<html lang="es-ES">
<head>
	<meta charset="utf-8">
	<title>Gestión de dispositivos</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Aplicacion web de control de impresoras y los consumibles correspondientes.">
	<meta name="author" content="Jose">
	<link rel="shorcut icon" href="http://localhost/pfcdata/img/favicon.ico" type='image/png'>
	<!--<style type="text/css">
		body{ padding-top: 60px; padding-bottom: 40px; }
	</style>

	<link href="http://localhost/pfcdata/css/bootstrap.css" rel="stylesheet" type="text-css">
	<link href="http://localhost/pfcdata/css/bootstrap-responsive.css" rel="stylesheet" type="text-css">
	<link href="http://localhost/pfcdata/css/style.css" rel="stylesheet" type="text-css">
	<link href="http://localhost/pfcdata/css/estilo.css" rel="stylesheet" type="text-css">
	<link href="http://localhost/pfcdata/css/select2/select2.css" rel="stylesheet" type="text-css">
	<link href="http://localhost/pfcdata/css/select2-bootstrap.css" rel="stylesheet" type="text-css">
	<link href="http://localhost/pfcdata/css/bootstrap-duallistbox.css" rel="stylesheet" type="text-css">
-->

	<style>
		@import url('http://localhost/pfcdata/css/bootstrap.css');
		@import url('http://localhost/pfcdata/css/bootstrap-responsive.css');
		@import url('http://localhost/pfcdata/css/style.css');
		@import url('http://localhost/pfcdata/css/estilo.css');
		@import url('http://localhost/pfcdata/css/select2/select2.css');
		@import url('http://localhost/pfcdata/css/select2-bootstrap.css');
		@import url('http://localhost/pfcdata/css/bootstrap-duallistbox.css');
	</style>
<!--

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
 
<div class="container">
	<img class="logo-cabecera" src="http://localhost/pfcdata/img/logo.png" alt="">
	<!--<h2>Sistema de gestion de dispositivos</h2>-->
	<div class="row">
		<div class="col-md-12">
			<div class="navbar">
			<ul class="nav navbar-nav">
			<!-- **************************************** -->
			<li><a href="http://localhost/pfcdata/">Inicio</a></li>
			<!-- **************************************** -->
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">Dispositivos<b class="caret"></b></a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
					<li role="presentation" class="dropdown-header">Tipo de dispositivo</li>
					<li><a href="http://localhost/pfcdata/dispositivo_controller/alta_tipo_dispositivo">Dar de alta</a></li>
					<!--<li><a href="http://localhost/pfcdata/dispositivo_controller/eliminar_tipo_dispositivo">Dar de baja</a></li>-->
					<!-- **************************************** -->
					<li role="presentation" class="divider"></li>
  					<li role="presentation" class="dropdown-header">Dispositivo</li>
  					<li><a href="http://localhost/pfcdata/dispositivo_controller/alta_dispositivo">Dar de alta</a></li>
					<!--<li><a href="http://localhost/pfcdata/dispositivo_controller/eliminar_dispositivo">Dar de baja</a></li>-->
					<li><a href="http://localhost/pfcdata/dispositivo_controller/listar_dispositivo">Listar</a></li>
					<!-- **************************************** -->
					<li role="presentation" class="divider"></li>
  					<li role="presentation" class="dropdown-header">Instancia de dispositivo</li>
  					<li><a href="http://localhost/pfcdata/dispositivo_controller/alta_instancia_dispositivo">Dar de alta</a></li>
					<!--<li><a href="http://localhost/pfcdata/dispositivo_controller/eliminar_instancia_dispositivo">Dar de baja</a></li>-->
					<li><a href="http://localhost/pfcdata/dispositivo_controller/modificar_instancia_dispositivo">Modificar</a></li>
					<li><a href="http://localhost/pfcdata/dispositivo_controller/buscar_instancia_dispositivo">Buscar</a></li>
					<li><a href="http://localhost/pfcdata/dispositivo_controller/historico_instancia_dispositivo">Histórico de estados</a></li>
				</ul>
			</li>
			<!-- **************************************** -->
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">Materiales<b class="caret"></b></a>
				<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
					<li role="presentation" class="dropdown-header">Tipo de material</li>
					<li><a href="http://localhost/pfcdata/material_controller/alta_tipo_material">Dar de alta</a></li>
					<!--<li><a href="http://localhost/pfcdata/material_controller/eliminar_tipo_material">Dar de baja</a></li>-->
					<!-- **************************************** -->
					<li role="presentation" class="divider"></li>
  					<li role="presentation" class="dropdown-header">Material</li>
  					<li><a href="http://localhost/pfcdata/material_controller/alta_material">Dar de alta</a></li>
					<!--<li><a href="http://localhost/pfcdata/material_controller/eliminar_material">Dar de baja</a></li>-->
					<li><a href="http://localhost/pfcdata/material_controller/listar_material">Listar</a></li>
					<!-- **************************************** -->
					<li role="presentation" class="divider"></li>
  					<li role="presentation" class="dropdown-header">Instancia de material</li>
  					<li><a href="http://localhost/pfcdata/material_controller/alta_instancia_material">Dar de alta</a></li>
					<li><a href="http://localhost/pfcdata/material_controller/modificar_instancia_material">Modificar</a></li>
					<li><a href="http://localhost/pfcdata/material_controller/buscar_instancia_material">Buscar</a></li>
					<li><a href="http://localhost/pfcdata/material_controller/asociar_instancia_material">Asociar a una instancia de dispositivo</a></li>
					<li><a href="http://localhost/pfcdata/material_controller/desasociar_instancia_material">Desasociar de una instancia de dispositivo</a></li>
					<li><a href="http://localhost/pfcdata/material_controller/historico_instancia_material">Histórico de estados</a></li>
				</ul>
			</li>
			<!-- **************************************** -->
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">Departamentos<b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="http://localhost/pfcdata/departamento_controller/alta_departamento">Dar de alta</a></li>
					<li><a href="http://localhost/pfcdata/departamento_controller/eliminar_departamento">Dar de baja</a></li>
					<li><a href="http://localhost/pfcdata/departamento_controller/modificar_departamento">Modificar</a></li>
					<li><a href="http://localhost/pfcdata/departamento_controller/listar_departamento">Listar</a></li>
				</ul>
			</li>
			<!-- **************************************** -->
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">Pedidos<b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="http://localhost/pfcdata/pedido_controller/alta_pedido">Nuevo</a></li>
					<li><a href="http://localhost/pfcdata/pedido_controller/eliminar_pedido">Eliminar</a></li>
					<li><a href="http://localhost/pfcdata/pedido_controller/modificar_pedido">Modificar</a></li>
					<li><a href="http://localhost/pfcdata/pedido_controller/almacena_ficheros">Almacena ficheros</a></li>
					<li><a href="http://localhost/pfcdata/pedido_controller/listar_pedido">Listar</a></li>
				</ul>
			</li>
			<!-- **************************************** -->
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">Proveedores<b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="http://localhost/pfcdata/proveedor_controller/alta_proveedor">Dar de alta</a></li>
					<li><a href="http://localhost/pfcdata/proveedor_controller/eliminar_proveedor">Dar de baja</a></li>
					<li><a href="http://localhost/pfcdata/proveedor_controller/modificar_proveedor">Modificar</a></li>
					<li><a href="http://localhost/pfcdata/proveedor_controller/listar_proveedor">Listar</a></li>
				</ul>
			</li>
			<!-- **************************************** -->
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">Personal<b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="http://localhost/pfcdata/persona_controller/alta_persona">Dar de alta</a></li>
					<li><a href="http://localhost/pfcdata/persona_controller/eliminar_persona">Dar de baja</a></li>
					<li><a href="http://localhost/pfcdata/persona_controller/modificar_persona">Modificar</a></li>
					<li><a href="http://localhost/pfcdata/persona_controller/listar_persona">Listar</a></li>
				</ul>
			</li>
			<!-- **************************************** 
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">Estado<b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="http://localhost/pfcdata/estado_controller/alta_estado">Dar de alta</a></li>
					<li><a href="http://localhost/pfcdata/estado_controller/alta_estado">Ver histórico</a></li>
				</ul>
			</li>
			<!-- **************************************** 
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">Marca<b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="http://localhost/pfcdata/marca_controller/alta_marca">Dar de alta marca</a></li>
				</ul>
			</li>
			<!-- **************************************** 
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">Modelo<b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="http://localhost/pfcdata/modelo_controller/alta_modelo">Dar de alta modelo</a></li>
				</ul>
			</li>
			<!-- **************************************** -->

			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">Ubicacion<b class="caret"></b></a>
				<ul class="dropdown-menu">
  					<!--
  					<li role="presentation" class="dropdown-header">Edificio</li>
  					<li><a href="http://localhost/pfcdata/ubicacion_controller/alta_edificio">Dar de alta</a></li>
					<!-- **************************************** 
					<li role="presentation" class="divider"></li>
  					<li role="presentation" class="dropdown-header">Habitacion</li>
  					<li><a href="http://localhost/pfcdata/ubicacion_controller/alta_habitacion">Dar de alta</a></li>
					<!-- **************************************** 
					<li role="presentation" class="divider"></li>
  					<li role="presentation" class="dropdown-header">Mueble</li>
  					<li><a href="http://localhost/pfcdata/ubicacion_controller/alta_mueble">Dar de alta</a></li>
					<!-- **************************************** 
					<li role="presentation" class="divider"></li>
  					<li role="presentation" class="dropdown-header">Balda</li>
  					<li><a href="http://localhost/pfcdata/ubicacion_controller/alta_balda">Dar de alta</a></li>
					<!-- **************************************** 
					<li role="presentation" class="divider"></li>-->
					<li><a href="http://localhost/pfcdata/ubicacion_controller/establece_ubicacion">Establecer ubicación</a></li>
					<li><a href="http://localhost/pfcdata/ubicacion_controller/encontrar_ubicacion">Encontrar ubicacion</a></li>
					<li><a href="http://localhost/pfcdata/ubicacion_controller/listar_ubicacion">Listar ubicaciones</a></li>
					<li><a href="http://localhost/pfcdata/ubicacion_controller/buscar_ubicacion">Buscar ubicacion</a></li>
				</ul>
			</li>
			<!-- **************************************** -->
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">Backup<b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="http://localhost/pfcdata/backup_controller/hacer_backup">Hacer copia de seguridad</a></li>
					<li><a href="http://localhost/pfcdata/backup_controller/restaurando_backup">Restaurar copia de seguridad</a></li>
				</ul>
			</li>
			<!-- **************************************** -->
			<li><a href="http://localhost/pfcdata/usuario_controller/logout">Salir</a></li>
			</ul>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<form id="listadoinstanciadispositivo" method="POST">
				<fieldset class="fieldset">
					<legend>Listado de instancias de dispositivo</legend>
					<!-- ************************-->
											<table class="table table-bordered table-striped">
							<tr>
								<th width="42">Id</th>
								<th width="124">Tipo</th>
								<th width="130">Marca</th>
								<th width="130">Modelo</th>
								<th width="205">Part_number</th>
								<th width="205">Num_serie</th>
								<th width="98">Acciones</th>
							</tr>
														<tr>
								<td width="42">1</td>
								<td width="124">Impresoras</td>
								<td width="130">Hp</td>
								<td width="130">Psc 750</td>
								<td width="205">C8426A</td>
								<td width="205">MY57E9206M</td>
								<td width="98">
									<a href="http://localhost/pfcdata/dispositivo_controller/visualizar_instancia_dispositivo/?id=1"><span class="glyphicon glyphicon-eye-open"></span></a>
									<a href="http://localhost/pfcdata/dispositivo_controller/modificar_instancia_dispositivo2/?id=1"><span class="glyphicon glyphicon-pencil"></span></a>
									<a href="" class="btn disabled"><span class="glyphicon glyphicon-remove"></span></a>
									<a href="http://localhost/pfcdata/dispositivo_controller/historico_instancia_dispositivo2/?id=1"><span class="glyphicon glyphicon-stats"></span></a>
								</td>
							</tr>
														<tr>
								<td width="42">2</td>
								<td width="124">Impresoras</td>
								<td width="130">Epson</td>
								<td width="130">stylus dx3800</td>
								<td width="205">C11C612012</td>
								<td width="205">GC7Y106031</td>
								<td width="98">
									<a href="http://localhost/pfcdata/dispositivo_controller/visualizar_instancia_dispositivo/?id=2"><span class="glyphicon glyphicon-eye-open"></span></a>
									<a href="http://localhost/pfcdata/dispositivo_controller/modificar_instancia_dispositivo2/?id=2"><span class="glyphicon glyphicon-pencil"></span></a>
									<a href="" class="btn disabled"><span class="glyphicon glyphicon-remove"></span></a>
									<a href="http://localhost/pfcdata/dispositivo_controller/historico_instancia_dispositivo2/?id=2"><span class="glyphicon glyphicon-stats"></span></a>
								</td>
							</tr>
														<tr>
								<td width="42">3</td>
								<td width="124">Impresoras</td>
								<td width="130">Canon</td>
								<td width="130">ix6550</td>
								<td width="205">4895B008AA</td>
								<td width="205">B004N5J9V4</td>
								<td width="98">
									<a href="http://localhost/pfcdata/dispositivo_controller/visualizar_instancia_dispositivo/?id=3"><span class="glyphicon glyphicon-eye-open"></span></a>
									<a href="http://localhost/pfcdata/dispositivo_controller/modificar_instancia_dispositivo2/?id=3"><span class="glyphicon glyphicon-pencil"></span></a>
									<a href="" class="btn disabled"><span class="glyphicon glyphicon-remove"></span></a>
									<a href="http://localhost/pfcdata/dispositivo_controller/historico_instancia_dispositivo2/?id=3"><span class="glyphicon glyphicon-stats"></span></a>
								</td>
							</tr>
														<tr>
								<td width="42">4</td>
								<td width="124">Impresoras</td>
								<td width="130">Epson</td>
								<td width="130">stylus sx130</td>
								<td width="205">C11C61112</td>
								<td width="205">GC7Y106133</td>
								<td width="98">
									<a href="http://localhost/pfcdata/dispositivo_controller/visualizar_instancia_dispositivo/?id=4"><span class="glyphicon glyphicon-eye-open"></span></a>
									<a href="http://localhost/pfcdata/dispositivo_controller/modificar_instancia_dispositivo2/?id=4"><span class="glyphicon glyphicon-pencil"></span></a>
									<a href="" class="btn disabled"><span class="glyphicon glyphicon-remove"></span></a>
									<a href="http://localhost/pfcdata/dispositivo_controller/historico_instancia_dispositivo2/?id=4"><span class="glyphicon glyphicon-stats"></span></a>
								</td>
							</tr>
													</table>					
						<!-- ************************-->
						<div class="form-group" align="center">
							<div class="pagination">
								
							</div>
						</div>
						<!-- ************************-->
						<!--campo oculto con la url de la página-->
						<input type="hidden" value="http://localhost/pfcdata/" id="hiddenBaseUrl"/>
						<!-- ************************-->
						<a href="http://localhost/pfcdata/dispositivo_controller/buscar_instancia_dispositivo" class="btn btn-primary">Cancelar</a>
						<!-- ************************-->
									</fieldset>
			</form>
		</div>
		<div class="col-md-1"></div>
	</div>
</div>

</body>
</html><?php }} ?>