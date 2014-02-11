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
			<form id="asociainstmaterial" action="{base_url()}material_controller/asocia_dispositivo_material" method="POST">
				<fieldset class="fieldset">
					<legend>Asociar instancia de material</legend>
						<!-- ************************-->
						<div class="col-lg-6">
							<div class="form-group">
								<label for="tipo_dispositivo">Tipo de dispositivo</label>
								<select class="form-control" name="tipo_dispositivo" id="tipo_dispositivo">
									<option value=""></option>
									{section name=disp loop=$tipo_disp}
										<option value="{$tipo_disp[disp]['id']}">{$tipo_disp[disp]['nombre_tipo_dispositivo']}</option>
									{/section}
								</select>
							</div>
						</div>
						<!-- ************************-->
						<div class="col-lg-6">
							<div class="form-group">
								<label for="tipo_material">Tipo de material</label>
									<select class="form-control" name="tipo_material" id="tipo_material">
										<option value=""></option>
										{section name=mat loop=$tipo_mat}
											<option value="{$tipo_mat[mat]['id']}">{$tipo_mat[mat]['nombre_tipo_material']}</option>
										{/section}
									</select>
							</div>
						</div>
						<!-- ************************-->
						<div class="col-lg-6">
							<div class="form-group">
								<label for="marca_dispositivo">Marca dispositivo</label>
									<select class="form-control" name="marca_dispositivo" id="marca_dispositivo">
									</select>
							</div>
						</div>
						<!-- ************************-->
						<div class="col-lg-6">
							<div class="form-group">
								<label for="marca_material">Marca material</label>
								<select class="form-control" name="marca_material" id="marca_material">
								</select>
							</div>
						</div>
						<!-- ************************-->
						<div class="col-lg-6">
							<div class="form-group">
								<label for="modelo_dispositivo">Modelo dispositivo</label>
									<select class="form-control" name="modelo_dispositivo" id="modelo_dispositivo">
									</select>
							</div>
						</div>
						<!-- ************************-->
						<div class="col-lg-6">
							<div class="form-group">
								<label for="modelo_material">Modelo material</label>
									<select class="form-control" name="modelo_material" id="modelo_material">
									</select>
							</div>
						</div>
						<!-- ************************-->
						<div class="col-lg-6">
							<div class="form-group">
								<label for="instancia_dispositivo">Instancias</label>
									<select class="form-control" name="instancia_dispositivo" id="instancia_dispositivo">
									</select>
							</div>
						</div>
						<!-- ************************-->
						<div class="col-lg-6">
							<div class="form-group">
								<label for="instancia_material">Instancias</label>
									<select class="form-control" name="instancia_material" id="instancia_material">
									</select>
							</div>
						</div>
					<!-- ************************-->
					<!--campo oculto con la url de la página-->
					<input type="hidden" value="{base_url()}" id="hiddenBaseUrl"/>
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

{literal}
<script>
//SCRIPT PARA LOS MATERIALES
$(document).ready(function(){
	// Parametros para el tipo_material
	$("#tipo_material").change(function () {
		$("#tipo_material option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("tipo_material", { elegido: elegido }, function(data){
				$("#marca_material").html(data);
				$("#modelo_material").html("");
				$("#instancia_material").html("");
			});
		});
	})
	// Parametros para e marca_material
	$("#marca_material").change(function () {
		$("#marca_material option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("marca_material", { elegido: elegido }, function(data){
				$("#modelo_material").html(data);
				$("#instancia_material").html("");
			});
		});
	})
	// Parametros para el modelo_material
	$("#modelo_material").change(function () {
		$("#modelo_material option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("instancia_material", { elegido: elegido }, function(data){
				$("#instancia_material").html(data);
			});
		});
	})
});
</script>
<script>
//SCRIPT PARA LOS DISPOSITIVOS
$(document).ready(function(){
	// Parametros para el tipo_dispositivo
	$("#tipo_dispositivo").change(function () {
		$("#tipo_dispositivo option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("tipo_dispositivo", { elegido: elegido }, function(data){
				$("#marca_dispositivo").html(data);
				$("#modelo_dispositivo").html("");
				$("#instancia_dispositivo").html("");
			});
		});
	})
	// Parametros para e marca_dispositivo
	$("#marca_dispositivo").change(function () {
		$("#marca_dispositivo option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("marca_dispositivo", { elegido: elegido }, function(data){
				$("#modelo_dispositivo").html(data);
				$("#instancia_dispositivo").html("");
			});
		});
	})
	// Parametros para el modelo_dispositivo
	$("#modelo_dispositivo").change(function () {
		$("#modelo_dispositivo option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("instancia_dispositivo", { elegido: elegido }, function(data){
				$("#instancia_dispositivo").html(data);
			});
		});
	})
});
</script>
<!--JQuery para usar select 2 -->
<script>
    $(document).ready(function(){
    	$("#tipo_dispositivo").select2();
    	$("#marca_dispositivo").select2();
    	$("#modelo_dispositivo").select2();
    	$("#instancia_dispositivo").select2();
    	$("#tipo_material").select2();
    	$("#marca_material").select2();
    	$("#modelo_material").select2();
    	$("#instancia_material").select2();
    });
</script>
{/literal}