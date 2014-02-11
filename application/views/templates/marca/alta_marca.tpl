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
			<form id="addmarca" action="{base_url()}marca_controller/addMarca" method="POST">
				<fieldset class="fieldset">
					<legend>Nueva Marca</legend>
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
		$('#addmarca').validate({
			errorElement: "span",
			errorClass: 'help-block',
			rules:
			{
				elemento: {required: true},
				tipo: {required: true},
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
<!--Jquery para combos de elemento-Tipo-->
<script>
$(document).ready(function(){
	// Parametros para el elemento
	$("#elemento").change(function () {
		$("#elemento option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("elemento", { elegido: elegido }, function(data){
				$("#tipo").html(data);
			});
		});
	})
});
</script>
<!--JQuery para usar select 2 -->
<script>
    $(document).ready(function(){
    	$("#tipo").select2();
    	$("#elemento").select2();
    });
</script>
{/literal}

{include file="includes/footer.tpl"}
