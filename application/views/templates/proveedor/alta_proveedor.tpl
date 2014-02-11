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
			<form id="addproveedor" action="{base_url()}proveedor_controller/addProveedor" method="POST">
				<fieldset class="fieldset">
					<legend>Nuevo proveedor</legend>
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
								<label for="email">Email: </label>
								<input type="text" class="form-control" id="email" name="email" value="" placeholder="Email"><br>
							</div>
						</div>
						<!-- ************************-->
						<div class="col-md-12">
							<div class="form-group">
								<label for="telefono_fijo">Teléfono fijo: </label>
								<input type="text" class="form-control" id="telefono_fijo" name="telefono_fijo" value="" placeholder="Telefono fijo"><br>
							</div>
						</div>
						<!-- ************************-->
						<div class="col-md-12">
							<div class="form-group">
								<label for="telefono_movil">Teléfono móvil: </label>
								<input type="text" class="form-control" id="telefono_movil" name="telefono_movil" value="" placeholder="Telefono movil"><br>
							</div>
						</div>
						<!-- ************************-->
						<div class="col-md-12">
							<div class="form-group">
								<label for="fax">Fax: </label>
								<input type="text" class="form-control" id="fax" name="fax" value="" placeholder="Fax"><br>
							</div>
						</div>
						<!-- ************************-->
						<div class="col-md-12">
							<div class="form-group">
								<label for="direccion">Dirección: </label>
								<input type="text" class="form-control" id="direccion" name="direccion" value="" placeholder="Direccion"><br>
							</div>
						</div>
					<!-- ************************-->
					<legend>Información de contacto</legend>
					<!-- ************************-->
						<div class="col-md-12">
							<div class="form-group">
								<label for="nombre_contacto">Nombre de contacto: </label>
								<input type="text" class="form-control" id="nombre_contacto" name="nombre_contacto" value="" placeholder="Nombre contacto"><br>
							</div>
						</div>
						<!-- ************************-->
						<div class="col-md-12">
							<div class="form-group">
								<label for="telefono_contacto">Teléfono de contacto: </label>
								<input type="text" class="form-control" id="telefono_contacto" name="telefono_contacto" value="" placeholder="Telefono contacto"><br>
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
		$('#addproveedor').validate({
			errorElement: "span",
			errorClass: 'help-block',
			rules:
			{
				nombre: {required: true, rangelength: [4,50]},
				email: {required: true, email: true},
				telefono_fijo: {required: true, rangelength: [9,12]},
				fax: {rangelength: [9,12]},
				direccion: {required: true, maxlength: 80},
				nombre_contacto:{maxlength: 80},
				telefono_contacto:{exactlength: 9}
			},
			messages:
			{
				nombre: "Este campo es obligatorio y debe tener entre 3 y 20 caracteres.",
				email : "Este campo es obligatorio y debe tener formato de email correcto.",
				telefono_fijo : "El campo Teléfono es obligatorio o no ha escrito un teléfono correcto.",
				fax : "Este campo debe tener entre 9 y 12 caracteres.",
				direccion : "Este campo es obligatorio y no debe exceder los 80 caracteres.",
				nombre_contacto : "Este campo no debe exceder los 80 caracteres.",
				telefono_contacto : "Este campo debe de tener un teléfono correcto."
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