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
			<form id="addpersona" action="{base_url()}persona_controller/addPersona" method="POST">
				<fieldset class="fieldset">
					<legend>Nueva persona</legend>
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
							<label for="appellido1">Primer apellido: </label>
							<input type="text" class="form-control" id="apellido1" name="apellido1" value="" placeholder="Apellido1"><br>
						</div>
					</div>
					<!-- ************************-->
					<div class="col-md-12">
						<div class="form-group">
							<label for="apellido2">Segundo apellido: </label>
							<input type="text" class="form-control" id="apellido2" name="apellido2" value="" placeholder="Apellido2"><br>
						</div>
					</div>
					<!-- ************************-->
					<div class="col-md-12">
						<div class="form-group">
							<label for="dni">DNI: </label>
							<input type="text" class="form-control" id="dni" name="dni" value="" placeholder="Dni"><br>
						</div>
					</div>
					<!-- ************************-->
					<div class="col-md-12">
						<div class="form-group">
							<label for="email">Email: </label>
							<input type="text" class="form-control" id="email" name="email" value="" placeholder="Email"><br>
						</div>
					</div>
					<!-- ************************-->
					<div class="col-md-12">
						<div class="form-group">
							<label for="departamento">Selecciona departamento: </label>
							<select class="form-control" id="departamento" name="departamento">
								<option value=""></option>
								{section name=dep loop=$departamento}
									<option value="{$departamento[dep]['id']}">{$departamento[dep]['nombre_departamento']}</option>
								{/section}
							</select>
						</div>
					</div>
					<!-- ************************-->
					<div class="col-md-12">
						<div class="form-group">
							<label for="jefe">¿Es Jefe?: </label>
							<select class="form-control" id="jefe" name="jefe">
								<option value=""></option>
								<option>no</option>
								<option>si</option>
							</select>
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
		$('#addpersona').validate({
			errorElement: "span",
			errorClass: 'help-block',
			rules:
			{
				nombre: {required: true, rangelength: [3,20]},
				apellido1: {required: true, rangelength: [4,30]},
				apellido2: {required: true, rangelength: [4,30]},
				dni: {required: true, exactlength: 9},
				email: {required: true, email: true},
				departamento: {required: true},
				jefe: {required: true}
			},
			messages:
			{
				nombre: "Este campo es obligatorio y debe tener entre 3 y 20 caracteres.",
				apellido1: "Este campo es obligatorio y debe tener entre 4 y 30 caracteres.",
				apellido2: "Este campo es obligatorio y debe tener entre 4 y 30 caracteres.",
				dni: "Este campo es obligatorio",
				email : "Este campo es obligatorio y debe tener formato de email correcto."
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
    	$("#departamento").select2();
    	$("#jefe").select2();
    });
</script>
{/literal}

{include file="includes/footer.tpl"}