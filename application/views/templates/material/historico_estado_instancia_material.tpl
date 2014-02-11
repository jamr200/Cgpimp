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
			<form id="historicoinstmaterial" action="{base_url()}dispositivo_controller/historicoInstanciaMaterial" method="POST">
				<fieldset class="fieldset">
					<legend>Histórico de estados de instancia de material</legend>
					<!-- ************************-->
					<div class="col-md-12">
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
					<!-- ************************-->
					<div class="col-md-12">
						<div class="form-group">
							<label for="marca_material">Marca</label>
							<select class="form-control" name="marca_material" id="marca_material">
							</select>
						</div>
					</div>
					<!-- ************************-->
					<div class="col-md-12">
						<div class="form-group">
							<label for="modelo_material">Modelo</label>
							<select class="form-control" name="modelo_material" id="modelo_material">
							</select>
						</div>
					</div>
					<!-- ************************-->
					<div class="col-md-12">
						<div class="form-group">
							<label for="combo_instancia">Instancias (id // part_number // num_serie)</label>
							<select class="form-control" name="combo_instancia" id="combo_instancia">
							</select>
						</div>
					</div>
					<!-- ************************-->
					<div class="col-md-12">
						<div class="form-group">
							<label for="muestra_historico_instancia_material"></label>
							<div class="controls" id="muestra_historico_instancia_material" name="muestra_historico_instancia_material">
							</div>
						</div>
					</div>
					<!-- ************************-->
					<!--campo oculto con la url de la página-->
					<input type="hidden" value="{base_url()}" id="hiddenBaseUrl"/>
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
	$("#tipo_material").change(function () {
		$("#tipo_material option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("tipo_material", { elegido: elegido }, function(data){
				$("#marca_material").html(data);
				$("#modelo_material").html("");
				$("#combo_instancia").html("");
				$("#muestra_historico_instancia_material").html("");
			});
		});
	})
	// Parametros para el marca_dispositivo
	$("#marca_material").change(function () {
		$("#marca_material option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("marca_material", { elegido: elegido }, function(data){
				$("#modelo_material").html(data);
				$("#combo_instancia").html("");
				$("#muestra_historico_instancia_material").html("");
			});
		});
	})
	// Parametros para el modelo_dispositivo
	$("#modelo_material").change(function () {
		$("#modelo_material option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("combo_instancia", { elegido: elegido }, function(data){
				$("#combo_instancia").html(data);
				$("#muestra_historico_instancia_material").html("");
			});
		});
	})
	// Parametros para el combo_instancia
	$("#combo_instancia").change(function () {
		$("#combo_instancia option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("muestra_historico_instancia_material", { elegido: elegido }, function(data){
				$("#muestra_historico_instancia_material").html(data);
			});
		});
	})
});
</script>
<!--JQuery para usar select 2 -->
<script>
    $(document).ready(function(){
    	$("#tipo_material").select2();
    	$("#marca_material").select2();
    	$("#modelo_material").select2();
    	$("#combo_instancia").select2();
    });
</script>
{/literal}