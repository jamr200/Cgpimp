{include file="includes/header.tpl"}
{include file="includes/barra_navegacion.tpl"}

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

<div class="container">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			{validation_errors('<p class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign"></span>','</p>')}
			{if isset($error)}
				<p class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign"></span> {$error}</p>
			{/if}
			{if isset($success)}
				<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> {$success}</p>
			{/if}
			<form id="addmaterial" action="{base_url()}material_controller/addMaterial" method="POST">
				<fieldset class="fieldset">
					<legend>Alta de material</legend>
					<!-- ************************-->
					<div class="col-md-8">
						<div class="form-group">
							<label for="tipo_material">Tipo de material</label>
							<select class="form-control" name="tipo_material" id="tipo_material">
								<option value=""></option>
								{section name=fila loop=$tipo}
									<option value="{$tipo[fila]['id']}">{$tipo[fila]['nombre_tipo_material']}</option>
								{/section}
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
								{section name=fila loop=$tipo_disp}
									<option value="{$tipo_disp[fila]['id']}">{$tipo_disp[fila]['nombre_tipo_dispositivo']}</option>
								{/section}
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
							<input type="hidden" value="{base_url()}" id="hiddenBaseUrl"/>
						</div>
					</div>
					<!-- ************************-->
					<div class="clearfix"></div>
					<!-- ************************-->
					<div class="col-md-8">
						<div class="form-group">
							<button type="submit" class="btn btn-primary">Guardar</button>
							<a href="{base_url()}main" class="btn btn-default">Cancelar</a>
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
							{section name=fila loop=$tipo}
								<option value="{$tipo[fila]['id']}">{$tipo[fila]['nombre_tipo_material']}</option>
							{/section}
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
								{section name=fila loop=$tipo}
									<option value="{$tipo[fila]['id']}">{$tipo[fila]['nombre_tipo_material']}</option>
								{/section}
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


{literal}
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
{/literal}

{include file="includes/footer.tpl"}