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
			<form id="deletetipomaterial" action="{base_url()}material_controller/deleteTipoMaterial" method="POST">
				<fieldset class="fieldset">
					<legend>Eliminar tipo de material</legend>
					<!-- ************************-->
					<table class="table table-bordered table-striped">
						<tr>
							<th>Seleccionar</th>
							<th>Nombre</th>
						</tr>
						{foreach from=$lista item=fila}
						<tr>
							<td><input type="checkbox" name="borrar[{$fila->id}]" value="{$fila->id}"></td>
							<td>{$fila->nombre_tipo_material}</td>
						</tr>
						{/foreach}
					</table>
					<!-- ************************-->
					<div class="col-md-12">
						<div class="form-group" align="center">
							<ul class="pagination">
								{$paginacion}
							</ul>
						</div>
					</div>
					<!-- ************************-->
					<!--campo oculto con la url de la página-->
					<input type="hidden" value="{base_url()}" id="hiddenBaseUrl"/>
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