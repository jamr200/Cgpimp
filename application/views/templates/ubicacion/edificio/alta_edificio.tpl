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
			<form id="addedificio" action="{base_url()}ubicacion_controller/addEdificio" method="POST">
				<fieldset class="fieldset">
					<legend>Nuevo edificio</legend>
					<!-- ************************-->
					<div class="col-md-12">
						<div class="form-group">
							<label for="nombre">Nombre</label>
							<input type="text" class="form-control" id="nombre" name="nombre" value="" placeholder="Nombre">
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

{include file="includes/footer.tpl"}