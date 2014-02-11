<?php /*%%SmartyHeaderCode:596152e7d41e58bd03-60412563%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '986cf920270af0ea61f1a82924d67c1c47c528fe' => 
    array (
      0 => 'application\\views\\templates\\material\\alta_material.tpl',
      1 => 1390924789,
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
  'nocache_hash' => '596152e7d41e58bd03-60412563',
  'variables' => 
  array (
    'error' => 0,
    'success' => 0,
    'tipo' => 0,
    'tipo_disp' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52e7d41e731d54_81286441',
  'cache_lifetime' => 120,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52e7d41e731d54_81286441')) {function content_52e7d41e731d54_81286441($_smarty_tpl) {?><!DOCTYPE html>

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
		<div class="col-md-2"></div>
		<div class="col-md-8">
			
									<form id="addmaterial" action="http://localhost/pfcdata/material_controller/addMaterial" method="POST">
				<fieldset class="fieldset">
					<legend>Alta de material</legend>
					<!-- ************************-->
					<div class="col-md-8">
						<div class="form-group">
							<label for="tipo_material">Tipo de material</label>
							<select class="form-control" name="tipo_material" id="tipo_material">
								<option value=""></option>
																	<option value="1">Cartuchos de tinta</option>
															</select>
						</div>
					</div>
					<div class="col-md-1">
						<!--Boton modal 1-->
						<a data-toggle="modal" href="#myModal1" class="btn" id="modal1" rel="tooltip" title="Añade tipo de material"><span class="glyphicon glyphicon-plus"></span></a>
					</div>
					<!-- ************************-->
					<div class="col-md-8">
						<div class="form-group">
							<label for="marca_material">Marca</label>
							<select class="form-control" name="marca_material" id="marca_material">
							</select>
						</div>
					</div>
					<div class="col-md-1">
						<!--Boton modal 2-->
						<a data-toggle="modal" href="#myModal2" class="btn" id="modal2" rel="tooltip" title="Añade Marca"><span class="glyphicon glyphicon-plus"></span></a>
					</div>
					<!-- ************************-->
					<div class="col-md-8">
						<div class="form-group">
							<label for="modelo_material">Modelo</label>
							<select class="form-control" name="modelo_material" id="modelo_material">
							</select>
						</div>
					</div>
					<div class="col-md-1">
						<!--Boton modal 3-->
						<a data-toggle="modal" href="#myModal3" class="btn" id="modal3" rel="tooltip" title="Añade Modelo"><span class="glyphicon glyphicon-plus"></span></a>
					</div>
					<!-- ************************-->
					<div class="clearfix"></div>
					<!-- ************************-->
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label" for="combo_dispositivo">Tipo de dispositivo</label>
							<select class="form-control" id="combo_dispositivo" name="combo_dispositivo">
								<option value=""></option>
																	<option value="1">Impresoras</option>
															</select>
						</div>
					</div>
					<!-- ************************-->
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label" for="caja_dispositivo">Dispositivos</label>
							<select class="form-control" id="caja_dispositivo" name="caja_dispositivo[]" size="10" multiple="multiple">
							</select>
						</div>
					</div>
					<!-- ************************-->
					<div class="clearfix"></div>
					<!-- ************************-->
					<!--campo oculto con la url de la página-->
					<div class="col-md-12">
						<div class="form-group">
							<input type="hidden" value="http://localhost/pfcdata/" id="hiddenBaseUrl"/>
						</div>
					</div>
					<!-- ************************-->
					<div class="clearfix"></div>
					<!-- ************************-->
					<div class="col-md-8">
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
		       		<h3 class="modal-title">Ingresar nuevo tipo de material</h3>
		       	</div>
		       	<!-- ************************-->
		        <div class="modal-body">
				    <form class="FormTipo" id="FormTipo">
						<fieldset>
							<div class="form-group">
								<label class="control-label" for="nombre">Nombre</label>
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
				<h3 class="modal-title">Ingresa nueva marca</h3>
			</div>
			<!-- ************************-->
			<div class="modal-body">
				<form class="FormMarca" id="FormMarca">
					<fieldset>
					<div class="form-group">
						<label class="control-label" for="tipo_material2">Tipo de Material</label>
						<select class="form-control" name="tipo_material2" id="tipo_material2">
							<option value=""></option>
															<option value="1">Cartuchos de tinta</option>
													</select>
					</div>
					<!-- ************************-->
					<div class="form-group">
						<label class="control-label" for="nombre">Nombre</label>
						<input type="text" class="form-control" id="nombre" name="nombre" value="" placeholder="Nombre">
					</div>
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
				<h3>Ingresar nuevo modelo</h3>
			</div>
			<!-- ************************-->
			<div class="modal-body">
				<form class="FormModelo" id="FormModelo">
					<fieldset>
					<!-- ************************-->
					<div class="form-group">
						<label class="control-label" for="tipo_material3">Tipo de Material</label>
							<select class="form-control" name="tipo_material3" id="tipo_material3">
							<option value=""></option>
																	<option value="1">Cartuchos de tinta</option>
															</select>
					</div>
					<!-- ************************-->
					<div class="form-group">
						<label class="control-label" for="combo_marca3">Marca</label>
						<select class="form-control" name="combo_marca3" id="combo_marca3">
						</select>
					</div>
					<!-- ************************-->
					<div class="form-group">
						<label class="control-label" for="nombre">Nombre</label>
						<input type="text" class="form-control" id="nombre" name="nombre" value="" placeholder="Nombre">
					</div> 
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
</script>
<!-- Combos anidados pagina principal -->
<script>
	$(document).ready(function(){
		// Parametros para el tipo_material
		$("#tipo_material").change(function () {
			$("#tipo_material option:selected").each(function () {
				//alert($(this).val());
					elegido=$(this).val();
					$.post("tipo_material", { elegido: elegido }, function(data){
					$("#marca_material").html(data);
					$("#modelo_material").html("");
				});
			});
		})
		// Parametros para el marca_material
		$("#marca_material").change(function () {
			$("#marca_material option:selected").each(function () {
				//alert($(this).val());
					elegido=$(this).val();
					$.post("marca_material", { elegido: elegido }, function(data){
					$("#modelo_material").html(data);
				});
			});
		})
	});
</script>
<!-- Combos anidados pagina principal para dual select-->
<script language="javascript">
		$(document).ready(function(){
			// Parametros para el combo_dispositivo
		   $("#combo_dispositivo").change(function () {
		   		$("#combo_dispositivo option:selected").each(function () {
					//alert($(this).val());
						elegido=$(this).val();
						$.post("combo_dispositivo", { elegido: elegido }, function(data){
						$("#caja_dispositivo").html(data);
						$("#caja_dispositivo").trigger('bootstrapduallistbox.refresh');
					});
		        });
		   })
		});
</script>
<!-- Para crear el dual list -->
<script>
var demo1 = $('[name="caja_dispositivo[]"]').bootstrapDualListbox();
</script>
<!-- Validacion para los modals-->
<!--Modal 1-->
<script>
  $(document).ready(function(){
    //Validacion para modal
    $('#FormTipo').validate({
      errorElement: "span",
      errorClass: 'help-block',
      rules: 
      {
        nombre: {required: true, rangelength: [4,50]}
      },
      messages:
      {
        nombre: "Este campo es obligatorio y debe tener entre 4 y 50 caracteres."
      },
      highlight: function(element) 
      {
        $(element).closest('.form-group')
        .removeClass('has-success').addClass('has-error');
      },
      success: function(element) 
      {
        $(element).closest('.form-group')
        .removeClass('has-error').addClass('has-success');
      }
    });
  });
</script>
<!--Modal 2-->
<script>
  $(document).ready(function(){
    //Validacion para modal
    $('#FormMarca').validate({
      errorElement: "span",
      errorClass: 'help-block',
      rules: 
      {
        nombre: {required: true, rangelength: [2,50]}
      },
      messages:
      {
        nombre: "Este campo es obligatorio y debe tener entre 2 y 50 caracteres."
      },
      highlight: function(element) 
      {
        $(element).closest('.form-group')
        .removeClass('has-success').addClass('has-error');
      },
      success: function(element) 
      {
        $(element).closest('.form-group')
        .removeClass('has-error').addClass('has-success');
      }
    });
  });
</script>
<!--Modal 3-->
<script>
  $(document).ready(function(){
    //Validacion para modal
    $('#FormModelo').validate({
      errorElement: "span",
      errorClass: 'help-block',
      rules: 
      {
        nombre: {required: true, rangelength: [2,50]}
      },
      messages:
      {
        nombre: "Este campo es obligatorio y debe tener entre 2 y 50 caracteres."
      },
      highlight: function(element) 
      {
        $(element).closest('.form-group')
        .removeClass('has-success').addClass('has-error');
      },
      success: function(element) 
      {
        $(element).closest('.form-group')
        .removeClass('has-error').addClass('has-success');
      }
    });
  });
</script>
<!-- Acciones al pulsar boton submit del modal -->
<script>
	$(function() {
		var url_base = $('#hiddenBaseUrl').val();//campo oculto del formulario con la baseurl()
	    $("button#submit1").click(function(){
	        $.ajax({
		        type: "POST",
		        url: url_base + "material_controller/addTipoMaterialModal",
		        data: $('form.FormTipo').serialize(),
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
	        url: url_base + "marca_controller/addMarcaModalMaterial",
	        data: $('form.FormMarca').serialize(),
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
	        url: url_base + "modelo_controller/addModeloModalMaterial",
	        data: $('form.FormModelo').serialize(),
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
<!-- Combo anidado del modal 3 -->
<script>
	$(document).ready(function(){
		// Parametros para el tipo_dispositivo2
		$("#tipo_material3").change(function () {
			$("#tipo_material3 option:selected").each(function () {
				//alert($(this).val());
					elegido=$(this).val();
					$.post("tipo_material3", { elegido: elegido }, function(data){
					$("#combo_marca3").html(data);
				});
			});
		})
	});
</script>
<script>
//Al pulsar boton para añadir marca recargamos por AJAX el select
    $("#modal2").click(function(){
    	var url_base = $('#hiddenBaseUrl').val();//campo oculto del formulario con la baseurl()
    	$("#tipo_material2").load(url_base + "material_controller/dame_tipos", $('form.FormTipo').serialize());
    });
</script>
<script>
//Al pulsar boton para añadir modelo recargamos por AJAX el select
    $("#modal3").click(function(){
    	var url_base = $('#hiddenBaseUrl').val();//campo oculto del formulario con la baseurl()
    	$("#tipo_material3").load(url_base + "material_controller/dame_tipos", $('form.FormTipo').serialize());
    });
</script>
<!--JQuery para usar select 2 -->
<script>
    $(document).ready(function(){
    	$("#tipo_material").select2();
    	$("#marca_material").select2();
    	$("#modelo_material").select2();
    	$("#tipo_material2").select2();
    	$("#tipo_material3").select2();
    	$("#combo_marca3").select2();
    	$("#combo_dispositivo").select2();
    });
</script>


</body>
</html><?php }} ?>