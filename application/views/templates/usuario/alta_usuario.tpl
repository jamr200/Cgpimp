{include file="includes/header.tpl"}

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

<!-- imagen logotipo -->
<img class="logo-cabecera" src="{base_url()}img/logo2.png" alt="">
<!-- fin imagen logotipo -->
<div class="container">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			{validation_errors('<p class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign"></span>','</p>')}
			{if isset($error)}
				<p class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign"></span> {$error}</p>
			{/if}
			{if isset($success)}
				<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> {$success}</p>
			{/if}
			<form id="usuariosform" action="{base_url()}usuario_controller/addUsuario" method="POST">
				<fieldset class="fieldset">
					<legend>Formulario para registro de usuarios</legend>
					<!-- ************************-->
					<div class="col-md-12">
						<div class="form-group">
							<label for="nombre">Nombre: </label>
							<input type="text" class="form-control" id="nombre" name="nombre" value="" placeholder="Nombre">
						</div>
					</div>
					<!-- ************************-->
					<div class="col-md-12">
						<div class="form-group">
							<label for="apellidos">Apellidos:</label>
							<input type="text" class="form-control" name="apellidos" id="apellidos" value="" placeholder="Apellidos">
						</div>
					</div>
					<!-- ************************-->
					<div class="col-md-12">
						<div class="form-group">
							<label for="email">Email: </label>
							<input type="text" class="form-control" id="email" name="email" value="" placeholder="Email">
						</div>
					</div>
					<!-- ************************-->
					<div class="col-md-12">
						<div class="form-group">
							<label for="password">Password:</label>
							<input type="password" class="form-control" name="password" id="password" value="" placeholder="Contraseña">
						</div>
					</div>
					<!-- ************************-->
					<div class="col-md-12">
						<div class="form-group">
							<label for="repassword">Repite password:</label>
							<input type="password" class="form-control" name="repassword" id="repassword" value="" placeholder="Repita contraseña">
						</div>
					</div>
					<!-- ************************-->
					<div class="col-md-12">
						<button type="submit" class="btn btn-primary">Guardar usuario</button>
						<a href="{base_url()}main" class="btn btn-default">Cancelar</a>
					</div>
					<!-- ************************-->
				</fieldset>
			</form>
		</div>
		<div class="col-md-3"></div>
	</div>
</div>




{literal}
<script>
	$(document).ready(function(){
		$('#usuariosform').validate({
			errorElement: "span",
			errorClass: 'help-block',
			rules:
			{
				nombre: {required: true, minlength: 3, maxlength: 30},
				apellidos: {required: true, minlength: 4, maxlength: 50},
				email: {required: true, email: true},
				password: {required: true, minlength: 6, maxlength: 30},
				repassword: {equalTo: "#password", minlength: 6, maxlength: 30}
			},
			messages:
			{
				nombre: "El campo es obligatorio y debe tener entre 3 y 30 caracteres.",
				apellidos: "El campo es obligatorio y debe tener entre 4 y 50 caracteres.",
				email : "El campo es obligatorio y debe tener formato de email correcto.",
				password : "El campo password es obligatorio y debe tener al menos 6 caracteres.",
				repassword : "Este campo debe tener al menos 6 caracteres y debe coincidir con el campo password."
			},
			highlight: function(element)
			{
				$(element).closest('.form-group')
				.removeClass('has-success').addClass('has-error');
			},
			success: function(element)
			{
				$(element).addClass('help-inline')
				.closest('.form-group')
				.removeClass('has-error').addClass('has-success');
			}
		});
	});
</script>
{/literal}

{include file="includes/footer.tpl"}