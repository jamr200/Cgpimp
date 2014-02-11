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
			<form id="estableceubicacion" action="{base_url()}ubicacion_controller/addUbicacionDesdeInstancia" method="POST">
				<fieldset class="fieldset">
					<legend>Establece ubicación de una instancia de material</legend>
					<!-- ************************-->
					<div class="col-md-12">
						<div class="col-md-3">
	                        <div class="form-group">
	                            <label for="id_instancia">Id instancia</label>
	                            <p class="form-control-static">{$id_instancia}</p>
	                        </div>
                        </div>
                        <!-- ************************-->
                        <div class="col-md-3">
	                        <div class="form-group">
	                            <label for="tipo">Tipo</label>
	                            <p class="form-control-static">{$tipo}</p>
	                        </div>
                        </div>
                        <!-- ************************-->
                        <div class="col-md-3">
	                        <div class="form-group">
	                            <label for="marca">Marca</label>
	                            <p class="form-control-static">{$marca}</p>
	                        </div>
                        </div>
                        <!-- ************************-->
                        <div class="col-md-3">
	                        <div class="form-group">
	                            <label for="modelo">Modelo</label>
	                            <p class="form-control-static">{$modelo}</p>
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
									{section name=edif loop=$edificio}
										<option value="{$edificio[edif]['id']}">{$edificio[edif]['nombre_edificio']}</option>
									{/section}
								</select>
							</div>
						</div>
						<!-- ************************-->
						<div class="col-md-2">
							<!--Boton modal 1-->
							<a data-toggle="modal" href="#myModal1" class="btn" id="modal1" rel="tooltip" title="Añade edificio"><span class="glyphicon glyphicon-plus"></span></a>
						</div>
						<!-- ************************-->
						<div class="col-md-10">
							<div class="form-group">
								<label for="habitacion">Habitación</label>
								<select class="form-control" name="habitacion" id="habitacion">
								</select>
							</div>
						</div>
						<!-- ************************-->
						<div class="col-md-2">
							<!--Boton modal 2-->
							<a data-toggle="modal" href="#myModal2" class="btn" id="modal2" rel="tooltip" title="Añade habitacion"><span class="glyphicon glyphicon-plus"></span></a>
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
							<a data-toggle="modal" href="#myModal3" class="btn" id="modal3" rel="tooltip" title="Añade mueble"><span class="glyphicon glyphicon-plus"></span></a>
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
							<a data-toggle="modal" href="#myModal4" class="btn" id="modal4" rel="tooltip" title="Añade balda"><span class="glyphicon glyphicon-plus"></span></a>
						</div>
						<!-- ************************-->
					</div>
					<!--campo oculto con la url de la página-->
					<input type="hidden" value="{$id_instancia}" id="id_instancia" name="id_instancia"/>
					<!-- ************************-->
					<!--campo oculto con la url de la página-->
					<input type="hidden" value="{base_url()}" id="hiddenBaseUrl"/>
					<!-- ************************-->
					<div class="clearfix visible"></div>
					<!-- ************************-->
					<div class="col-md-12">
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
		       		<h3 class="modal-title">Ingresar edificio</h3>
		       	</div>
		       	<!-- ************************-->
		        <div class="modal-body">
				    <form class="FormEdificio">
						<fieldset>
							<div class="form-group">
								<label for="nombre">Nombre</label>
								<input type="text" class="form-control" id="nombre" name="nombre" value="{if isset($smarty.post.nombre)}{$smarty.post.nombre}{/if}" placeholder="Nombre">
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
				<h3 class="modal-title">Ingresa habitación</h3>
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
							{section name=edif loop=$edificio}
								<option value="{$edificio[edif]['id']}">{$edificio[edif]['nombre_edificio']}</option>
							{/section}
						</select>
					</div>
					<!-- ************************-->
					<div class="form-group">
						<label for="nombre">Nombre</label>
						<input type="text" class="form-control" id="nombre" name="nombre" value="{if isset($smarty.post.nombre)}{$smarty.post.nombre}{/if}" placeholder="Nombre">
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
							{section name=edif loop=$edificio}
								<option value="{$edificio[edif]['id']}">{$edificio[edif]['nombre_edificio']}</option>
							{/section}
						</select>
					</div>
					<!-- ************************-->
					<div class="form-group">
						<label for="habitacion3">Habitación</label>
						<select class="form-control" name="habitacion3" id="habitacion3">
						</select>
					</div>
					<!-- ************************-->
					<div class="form-group">
						<label for="nombre">Nombre</label>
						<input type="text" class="form-control" id="nombre" name="nombre" value="{if isset($smarty.post.nombre)}{$smarty.post.nombre}{/if}" placeholder="Nombre">
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
							{section name=edif loop=$edificio}
								<option value="{$edificio[edif]['id']}">{$edificio[edif]['nombre_edificio']}</option>
							{/section}
						</select>
					</div>
					<!-- ************************-->
					<div class="form-group">
						<label for="habitacion4">Habitación</label>
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
						<input type="text" class="form-control" id="nombre" name="nombre" value="{if isset($smarty.post.nombre)}{$smarty.post.nombre}{/if}" placeholder="Nombre">
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
{/literal}