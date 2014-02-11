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
			{if isset($error)}
				<p class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign"></span> {$error}</p>
			{/if}
			{if isset($success)}
				<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> {$success}</p>
			{/if}
			<form id="deleteinstdispositivo" action="{base_url()}dispositivo_controller/deleteInstanciaDispositivo" method="POST">
				<fieldset class="fieldset">
					<legend>Eliminar dispositivo</legend>
					<!-- ************************-->
					<div class="col-md-12">
						<div class="form-group">
							<label for="tipo_dispositivo">Tipo de dispositivo</label>
							<select class="form-control" name="tipo_dispositivo" id="tipo_dispositivo">
								<option value=""></option>
								{section name=fila loop=$tipo}
									<option value="{$tipo[fila]['id']}">{$tipo[fila]['nombre_tipo_dispositivo']}</option>
								{/section}
							</select>
						</div>
					</div>
					<!-- ************************-->
					<div class="col-md-12">
						<div class="form-group">
							<label for="marca_dispositivo">Marca</label>
							<select class="form-control" name="marca_dispositivo" id="marca_dispositivo">
							</select>
						</div>
					</div>
					<!-- ************************-->
					<div class="col-md-12">
						<div class="form-group">
							<label for="modelo_dispositivo">Modelo</label>
							<select class="form-control" name="modelo_dispositivo" id="modelo_dispositivo">
							</select>
						</div>
					</div>
					<!-- ************************-->
					<div align="center" name="tabla_instancias_dispositivos" id="tabla_instancias_dispositivos">
						<label for="tabla_instancias_dispositivos"></label>
					</div>
					<!-- ************************-->
					<!--campo oculto con la url de la página-->
					<input type="hidden" value="{base_url()}" id="hiddenBaseUrl"/>
					<!-- ************************-->
					<div class="col-md-12">
						<div class="form-group">
							<button type="submit" class="btn btn-primary">Eliminar</button>
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
$(document).ready(function(){
	// Parametros para el tipo_dispositivo
	$("#tipo_dispositivo").change(function () {
		$("#tipo_dispositivo option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("tipo_dispositivo", { elegido: elegido }, function(data){
				$("#marca_dispositivo").html(data);
				$("#modelo_dispositivo").html("");
				$("#tabla_instancias_dispositivos").html("");
			});
		});
	})
	// Parametros para el marca_dispositivo
	$("#marca_dispositivo").change(function () {
		$("#marca_dispositivo option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("marca_dispositivo", { elegido: elegido }, function(data){
				$("#modelo_dispositivo").html(data);
				$("#tabla_instancias_dispositivos").html("");
			});
		});
	})
	// Parametros para el modelo_dispositivo
	$("#modelo_dispositivo").change(function () {
		$("#modelo_dispositivo option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("tabla_instancias_dispositivos", { elegido: elegido }, function(data){
				$("#tabla_instancias_dispositivos").html(data);
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
    });
</script>
{/literal}

{include file="includes/footer.tpl"}