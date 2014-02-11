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
			<form id="addpedido" enctype="multipart/form-data" action="{base_url()}pedido_controller/addPedido" method="POST">
				<fieldset class="fieldset">
					<legend>Nuevo Pedido</legend>
					<!-- ************************-->
					<div class="col-md-12">
						<div class="form-group">
							<label for="nombre">Nombre: </label>
							<input type="text" class="form-control" id="nombre" name="nombre" value="" placeholder="Nombre"><br>
						</div>
					</div>
					<!-- ************************-->
					<div class="col-md-12">
						<div class="form-group">
							<label for="observaciones">Observaciones: </label>
							<textarea class="form-control" name="observaciones" id="observaciones" rows="3"></textarea>
						</div>
					</div>
					<!-- ************************-->
					<div class="col-md-12">
						<div class="form-group">
							<label for="proveedor">Selecciona proveedor: </label>
							<select class="form-control" id="proveedor" name="proveedor">
								<option value=""></option>
								{section name=prov loop=$proveedor}
									<option value="{$proveedor[prov]['id']}">{$proveedor[prov]['nombre_proveedor']}</option>
								{/section}
							</select>
						</div>
					</div>
					<!-- ************************-->
					<div class="col-md-12">
						<div class="form-group">
							<label class="control-label" for="fichero">Ficheros</label>
							<input id="ficheros" type="file" class="multi" name="ficheros[]" size="20" multiple="multiple">
						</div>
					</div>
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

{literal}
<script>
	$(document).ready(function(){
		$('#addpedido').validate({
			errorElement: "span",
			errorClass: 'help-block',
			rules:
			{
				nombre: {required: true, rangelength:[3,30]},
				observaciones: {maxlength: 500},
				proveedor: {required: true}
			},
			messages:
			{
				nombre: "El campo es obligatorio y debe tener entre 3 y 30 caracteres.",
				observaciones: "El campo es obligatorio y debe tener entre 4 y 50 caracteres.",
				proveedor : "El campo es obligatorio"
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
<!--JQuery para usar select 2 -->
<script>
    $(document).ready(function(){
    	$("#proveedor").select2();
    });
</script>
{/literal}

{include file="includes/footer.tpl"}

