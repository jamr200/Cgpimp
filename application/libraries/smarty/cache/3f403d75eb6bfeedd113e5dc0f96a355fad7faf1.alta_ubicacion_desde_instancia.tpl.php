<?php /*%%SmartyHeaderCode:2914452b431ababbe55-03155422%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3f403d75eb6bfeedd113e5dc0f96a355fad7faf1' => 
    array (
      0 => 'application\\views\\templates\\ubicacion\\alta_ubicacion_desde_instancia.tpl',
      1 => 1386173348,
      2 => 'file',
    ),
    '57af232e22ee9f7c4bbce0da0087391b39380300' => 
    array (
      0 => 'application\\views\\templates\\includes\\header.tpl',
      1 => 1384860204,
      2 => 'file',
    ),
    'f8953d645edff036c3a9a536ab2c5d02a31d159b' => 
    array (
      0 => 'application\\views\\templates\\includes\\barra_navegacion.tpl',
      1 => 1386002847,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2914452b431ababbe55-03155422',
  'variables' => 
  array (
    'error' => 0,
    'success' => 0,
    'id_instancia' => 0,
    'tipo' => 0,
    'marca' => 0,
    'modelo' => 0,
    'edificio' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52b431abcb2c74_94125007',
  'cache_lifetime' => 120,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52b431abcb2c74_94125007')) {function content_52b431abcb2c74_94125007($_smarty_tpl) {?><!DOCTYPE html>

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
					<li><a href="http://localhost/pfcdata/dispositivo_controller/historico_instancia_dispositivo">Historico de estados</a></li>
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
					<li><a href="http://localhost/pfcdata/material_controller/historico_instancia_material">Historico de estados</a></li>
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
		<div class="col-md-2"></div>
		<div class="col-md-8">
			
										<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Instancia con tipo de material <strong>Cartuchos de tinta</strong> con marca: <strong>Epson</strong> // modelo: <strong>t281</strong> y con id: <strong>5</strong> se ha almacenado correctamente.</p>
						<form id="estableceubicacion" action="http://localhost/pfcdata/ubicacion_controller/addUbicacionDesdeInstancia" method="POST">
				<fieldset class="fieldset">
					<legend>Establece ubicacion de una instancia de material</legend>
					<!-- ************************-->
					<div class="col-md-12">
						<div class="col-md-3">
	                        <div class="form-group">
	                            <label for="id_instancia">Id instancia</label>
	                            <p class="form-control-static">5</p>
	                        </div>
                        </div>
                        <!-- ************************-->
                        <div class="col-md-3">
	                        <div class="form-group">
	                            <label for="tipo">Tipo</label>
	                            <p class="form-control-static">Cartuchos de tinta</p>
	                        </div>
                        </div>
                        <!-- ************************-->
                        <div class="col-md-3">
	                        <div class="form-group">
	                            <label for="marca">Marca</label>
	                            <p class="form-control-static">Epson</p>
	                        </div>
                        </div>
                        <!-- ************************-->
                        <div class="col-md-3">
	                        <div class="form-group">
	                            <label for="modelo">Modelo</label>
	                            <p class="form-control-static">t281</p>
	                        </div>
                        </div>
                    </div>
                    <!-- ************************-->
					<div class="col-md-12">
						<div class="col-md-10">
							<div class="form-group">
								<label for="edificio">Edificio</label>
								<select class="form-control" name="edificio" id="edificio">
									<option value=""></option>
																			<option value="1">Ayuntamiento</option>
																			<option value="2">Palacio Beniel</option>
																	</select>
							</div>
						</div>
						<!-- ************************-->
						<div class="col-md-2">
							<!--Boton modal 1-->
							<a data-toggle="modal" href="#myModal1" class="btn" id="modal1" rel="tooltip" title="Añade Edificio"><span class="glyphicon glyphicon-plus"></span></a>
						</div>
						<!-- ************************-->
						<div class="col-md-10">
							<div class="form-group">
								<label for="habitacion">Habitacion</label>
								<select class="form-control" name="habitacion" id="habitacion">
								</select>
							</div>
						</div>
						<!-- ************************-->
						<div class="col-md-2">
							<!--Boton modal 2-->
							<a data-toggle="modal" href="#myModal2" class="btn" id="modal2" rel="tooltip" title="Añade Habitacion"><span class="glyphicon glyphicon-plus"></span></a>
						</div>
						<!-- ************************-->
						<div class="col-md-10">
							<div class="form-group">
								<label for="mueble">Mueble</label>
								<select class="form-control" name="mueble" id="mueble">
								</select>
							</div>
						</div>
						<!-- ************************-->
						<div class="col-md-2">
							<!--Boton modal 3-->
							<a data-toggle="modal" href="#myModal3" class="btn" id="modal3" rel="tooltip" title="Añade Mueble"><span class="glyphicon glyphicon-plus"></span></a>
						</div>
						<!-- ************************-->
						<div class="col-md-10">
							<div class="form-group">
								<label for="balda">Balda</label>
								<select class="form-control" name="balda" id="balda">
								</select>
							</div>
						</div>
						<!-- ************************-->
						<div class="col-md-2">
							<!--Boton modal 4-->
							<a data-toggle="modal" href="#myModal4" class="btn" id="modal4" rel="tooltip" title="Añade Balda"><span class="glyphicon glyphicon-plus"></span></a>
						</div>
						<!-- ************************-->
					</div>
					<!--campo oculto con la url de la página-->
					<input type="hidden" value="5" id="id_instancia" name="id_instancia"/>
					<!-- ************************-->
					<!--campo oculto con la url de la página-->
					<input type="hidden" value="http://localhost/pfcdata/" id="hiddenBaseUrl"/>
					<!-- ************************-->
					<div class="clearfix visible"></div>
					<!-- ************************-->
					<div class="col-md-12">
						<div class="form-group">
							<button type="submit" class="btn btn-primary">Guardar</button>
							<a href="http://localhost/pfcdata/main" class="btn btn-default">Cancelar</a>
						</div>
					</div>
					<!-- ************************-->
				</fieldset>
			</form>
		</div>
		<div class="col-md-2"></div>
	</div>
</div>


<!--Modal 1-->
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div id="thanks1">
		<div class="modal-dialog">
		    <div class="modal-content">
		    	<!-- ************************-->	     
		       	<div class="modal-header">
		       		<h3 class="modal-title">Ingresar nuevo edificio</h3>
		       	</div>
		       	<!-- ************************-->
		        <div class="modal-body">
				    <form class="FormEdificio">
						<fieldset>
							<div class="form-group">
								<label for="nombre">Nombre</label>
								<input type="text" class="form-control" id="nombre" name="nombre" value="" placeholder="Nombre">
							</div> 
						</fieldset>
					</form>
		        </div>
		        <!-- ************************-->
			    <div class="modal-footer">
			       	<button type="button" class="btn btn-default" id="cerrar1" data-dismiss="modal">Cerrar</button>
			       	<button type="button" class="btn btn-primary" id="submit1">Guardar</button>
			    </div>
			    <!-- ************************-->
		    </div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div>
</div><!-- /.modal -->
<!--Cierro Modal 1-->


<!--Modal 2-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div id="thanks2">
		<div class="modal-dialog">
    		<div class="modal-content">
			<!-- ************************-->
			<div class="modal-header">
				<h3 class="modal-title">Ingresa habitacion</h3>
			</div>
			<!-- ************************-->
			<div class="modal-body">
				<form class="FormHabitacion">
					<fieldset>
					<!-- ************************-->
					<div class="form-group">
						<label for="edificio2">Edificio</label>
						<select class="form-control" name="edificio2" id="edificio2">
							<option value=""></option>
															<option value="1">Ayuntamiento</option>
															<option value="2">Palacio Beniel</option>
													</select>
					</div>
					<!-- ************************-->
					<div class="form-group">
						<label for="nombre">Nombre</label>
						<input type="text" class="form-control" id="nombre" name="nombre" value="" placeholder="Nombre">
					</div>
					<!-- ************************-->
					</fieldset>
				</form>
			</div>
			<!-- ************************-->
			<div class="modal-footer">
				<button type="button" class="btn btn-default" id="cerrar2" data-dismiss="modal">Cerrar</button>
			    <button type="button" class="btn btn-primary" id="submit2">Guardar</button>
			</div>
			<!-- ************************-->
	   		</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
</div>
<!--Cierro Modal 2-->

<!--Modal 3-->
<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div id="thanks3">
		<div class="modal-dialog">
		    <div class="modal-content">
		    <!-- ************************-->
			<div class="modal-header">
				<h3>Ingresar mueble</h3>
			</div>
			<!-- ************************-->
			<div class="modal-body">
				<form class="FormMueble">
					<fieldset>
					<!-- ************************-->
					<div class="form-group">
						<label for="edificio3">Edificio</label>
						<select class="form-control" name="edificio3" id="edificio3">
							<option value=""></option>
															<option value="1">Ayuntamiento</option>
															<option value="2">Palacio Beniel</option>
													</select>
					</div>
					<!-- ************************-->
					<div class="form-group">
						<label for="habitacion3">Habitacion</label>
						<select class="form-control" name="habitacion3" id="habitacion3">
						</select>
					</div>
					<!-- ************************-->
					<div class="form-group">
						<label for="nombre">Nombre</label>
						<input type="text" class="form-control" id="nombre" name="nombre" value="" placeholder="Nombre">
					</div>
					<!-- ************************-->
					</fieldset>
				</form>
			</div>
			<!-- ************************-->
			<div class="modal-footer">
				<button type="button" class="btn btn-default" id="cerrar3" data-dismiss="modal">Cerrar</button>
			    <button type="button" class="btn btn-primary" id="submit3">Guardar</button>
			</div>
			<!-- ************************-->
		</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div>
</div><!-- /.modal -->
<!--Cierro Modal 3-->


<!--Modal 4-->
<div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div id="thanks4">
		<div class="modal-dialog">
		    <div class="modal-content">
		    <!-- ************************-->
			<div class="modal-header">
				<h3>Ingresar balda</h3>
			</div>
			<!-- ************************-->
			<div class="modal-body">
				<form class="FormMueble">
					<fieldset>
					<!-- ************************-->
					<div class="form-group">
						<label for="edificio4">Edificio</label>
						<select class="form-control" name="edificio4" id="edificio4">
							<option value=""></option>
															<option value="1">Ayuntamiento</option>
															<option value="2">Palacio Beniel</option>
													</select>
					</div>
					<!-- ************************-->
					<div class="form-group">
						<label for="habitacion4">Habitacion</label>
						<select class="form-control" name="habitacion4" id="habitacion4">
						</select>
					</div>
					<!-- ************************-->
					<div class="form-group">
						<label for="mueble4">Mueble</label>
						<select class="form-control" name="mueble4" id="mueble4">
						</select>
					</div>
					<!-- ************************-->
					<div class="form-group">
						<label for="nombre">Nombre</label>
						<input type="text" class="form-control" id="nombre" name="nombre" value="" placeholder="Nombre">
					</div>
					<!-- ************************-->
					</fieldset>
				</form>
			</div>
			<!-- ************************-->
			<div class="modal-footer">
				<button type="button" class="btn btn-default" id="cerrar4" data-dismiss="modal">Cerrar</button>
			    <button type="button" class="btn btn-primary" id="submit4">Guardar</button>
			</div>
			<!-- ************************-->
		</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div>
</div><!-- /.modal -->
<!--Cierro Modal 4-->


<script>
    $(function () {
        $('#modal1').tooltip();
    });
    $(function () {
        $('#modal2').tooltip();
    });
    $(function () {
        $('#modal3').tooltip();
    });
    $(function () {
        $('#modal4').tooltip();
    });
</script>
<script>
//SCRIPT PARA LA UBICACION
$(document).ready(function(){
	// Parametros para el edificio
	$("#edificio").change(function () {
		$("#edificio option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("edificio", { elegido: elegido }, function(data){
				$("#habitacion").html(data);
				$("#mueble").html("");
				$("#balda").html("");
			});
		});
	})
	// Parametros para e habitacion
	$("#habitacion").change(function () {
		$("#habitacion option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("habitacion", { elegido: elegido }, function(data){
				$("#mueble").html(data);
				$("#balda").html("");
			});			
		});
	})
	// Parametros para el mueble
	$("#mueble").change(function () {
		$("#mueble option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("balda", { elegido: elegido }, function(data){
				$("#balda").html(data);
			});
		});
	})
});
</script>
<!-- Acciones al pulsar boton submit del modal -->
<script>
	$(function() {
		var url_base = $('#hiddenBaseUrl').val();//campo oculto del formulario con la baseurl()
	    $("button#submit1").click(function(){
	        $.ajax({
		        type: "POST",
		        url: url_base + "ubicacion_controller/addEdificioModal",
		        data: $('form.FormEdificio').serialize(),
		        success: function(msg){
		        	$("#thanks1").html(msg)
		            $("#modal1").modal('hide');
		        },
		        error: function(){
		            alert("failure");
		        }
	        });
	    });
	});
</script>
<script>
	$(function() {
		var url_base = $('#hiddenBaseUrl').val();//campo oculto del formulario con la baseurl()
	    $("button#submit2").click(function(){
	        $.ajax({
	        type: "POST",
	        url: url_base + "ubicacion_controller/addHabitacionModal",
	        data: $('form.FormHabitacion').serialize(),
	        success: function(msg){
	        	$("#thanks2").html(msg)
	            $("#modal2").modal('hide');
	            },
	        error: function(){
	            alert("failure");
	            }
	        });
	    });
	});
</script>
<script>
	$(function() {
		var url_base = $('#hiddenBaseUrl').val();//campo oculto del formulario con la baseurl()
	    $("button#submit3").click(function(){
	        $.ajax({
	        type: "POST",
	        url: url_base + "ubicacion_controller/addMuebleModal",
	        data: $('form.FormMueble').serialize(),
	        success: function(msg){
	        	$("#thanks3").html(msg)
	            $("#modal3").modal('hide');
	            },
	        error: function(){
	            alert("failure");
	            }
	        });
	    });
	});
</script>
<script>
	$(function() {
		var url_base = $('#hiddenBaseUrl').val();//campo oculto del formulario con la baseurl()
	    $("button#submit4").click(function(){
	        $.ajax({
	        type: "POST",
	        url: url_base + "ubicacion_controller/addBaldaModal",
	        data: $('form.FormBalda').serialize(),
	        success: function(msg){
	        	$("#thanks4").html(msg)
	            $("#modal4").modal('hide');
	            },
	        error: function(){
	            alert("failure");
	            }
	        });
	    });
	});
</script>
<!-- Combo anidado del modal 3 -->
<script>
	$(document).ready(function(){
		// Parametros para el edificio3
		$("#edificio3").change(function () {
			$("#edificio3 option:selected").each(function () {
				//alert($(this).val());
					elegido=$(this).val();
					$.post("edificio3", { elegido: elegido }, function(data){
					$("#habitacion3").html(data);
				});
			});
		})
	});
</script>
<!-- Combo anidado del modal 4 -->
<script>
	$(document).ready(function(){
		// Parametros para el edificio4
		$("#edificio4").change(function () {
			$("#edificio4 option:selected").each(function () {
				//alert($(this).val());
					elegido=$(this).val();
					$.post("edificio4", { elegido: elegido }, function(data){
					$("#habitacion4").html(data);
					$("#mueble4").html("");
				});
			});
		})
		// Parametros para el habitacion4
		$("#habitacion4").change(function () {
			$("#habitacion4 option:selected").each(function () {
				//alert($(this).val());
					elegido=$(this).val();
					$.post("habitacion4", { elegido: elegido }, function(data){
					$("#mueble4").html(data);
				});
			});
		})
	});
</script>
<script>
//Al pulsar boton para añadir habitacion recargamos por AJAX el select
    $("#modal2").click(function(){
    	var url_base = $('#hiddenBaseUrl').val();//campo oculto del formulario con la baseurl()
    	$("#edificio2").load(url_base + "ubicacion_controller/recarga_edificio", $('form.FormEdificio').serialize());
    });
</script>
<script>
//Al pulsar boton para añadir mueble recargamos por AJAX el select
    $("#modal3").click(function(){
    	var url_base = $('#hiddenBaseUrl').val();//campo oculto del formulario con la baseurl()
    	$("#edificio3").load(url_base + "ubicacion_controller/recarga_edificio", $('form.FormEdificio').serialize());
    });
</script>
<script>
//Al pulsar boton para añadir balda recargamos por AJAX el select
    $("#modal4").click(function(){
    	var url_base = $('#hiddenBaseUrl').val();//campo oculto del formulario con la baseurl()
    	$("#edificio4").load(url_base + "ubicacion_controller/recarga_edificio", $('form.FormEdificio').serialize());
    });
</script>
<!--JQuery para usar select 2 -->
<script>
    $(document).ready(function(){
    	$("#edificio").select2();
    	$("#edificio2").select2();
    	$("#edificio3").select2();
    	$("#edificio4").select2();
    	$("#habitacion").select2();
    	$("#habitacion3").select2();
    	$("#habitacion4").select2();
    	$("#mueble").select2();
    	$("#mueble4").select2();
    	$("#balda").select2();
    });
</script>
<?php }} ?>