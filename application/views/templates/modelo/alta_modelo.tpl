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
			<form id="addmodelo" action="{base_url()}modelo_controller/addModelo" method="POST">
				<fieldset class="fieldset">
					<legend>Nuevo Modelo</legend>
					<!-- ************************-->
					<div class="form-group">
						<label for="elemento">Elemento</label>
						<select class="form-control" name="elemento" id="elemento">
							<option value=""></option>
							{section name=elem loop=$elementos}
								<option value="{$elementos[elem]['id']}">{$elementos[elem]['nombre']}</option>
							{/section}
						</select>
					</div>
					<!-- ************************-->
					<div class="form-group">
						<label for="tipo">Tipo de Elemento</label>
						<select class="form-control" name="tipo" id="tipo">
						</select>
					</div>
					<!-- ************************-->
					<div class="form-group">
						<label for="combo_marca3">Marca</label>
						<select class="form-control" id="combo_marca3" name="combo_marca3">
						</select>
					</div>
					<!-- ************************-->
					<div class="form-group">
						<label for="nombre">Nombre: </label>
						<input type="text" class="form-control" id="nombre" name="nombre" value="{if isset($smarty.post.nombre)}{$smarty.post.nombre}{/if}" placeholder="Nombre"><br>
					</div>
					<!-- ************************-->
					<button type="submit" class="btn btn-primary">Guardar</button>
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
		$('#addmodelo').validate({
			errorElement: "span",
			errorClass: 'help-block',
			rules:
			{
				elemento: {required: true},
				tipo: {required: true},
				combo_marca3: {required: true},
				nombre: {required: true}
			},
			messages:
			{
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

<script language="javascript">
	$(document).ready(function(){
		// Parametros para el elemento
	   $("#elemento").change(function () {
	   		$("#elemento option:selected").each(function () {
				//alert($(this).val());
					elegido=$(this).val();
					$.post("elemento", { elegido: elegido }, function(data){
					$("#tipo").html(data);
					$("#combo_marca3").html();
				});
	        });
	   })
		// Parametros para el tipo
	   $("#tipo").change(function () {
	   		$("#tipo option:selected").each(function () {
				//alert($(this).val());
					elegido=$(this).val();
					var elemento =$('#elemento').val();
					$.post("tipo", { elegido: elegido, elemento:elemento }, function(data){
					$("#combo_marca3").html(data);
				});
	        });
	   })
	});
</script>
<!--JQuery para usar select 2 -->
<script>
    $(document).ready(function(){
    	$("#elemento").select2();
    	$("#tipo").select2();
    	$("#combo_marca3").select2();
    });
</script>
{/literal}
{include file="includes/footer.tpl"}