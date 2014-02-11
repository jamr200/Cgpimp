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


<!-- Lo tengo comentado porque si pulso el boton para guardar cambios me salta mensaje de que no hay seleccionados
{if isset($error)}
	<p class="alert alert-error" style="margin: 1px;"><i class="icon-exclamation-sign"></i>{$error}
{/if}
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
			<form id="deletetipodispositivo" action="{base_url()}dispositivo_controller/deleteTipoDispositivo" method="POST">
				<fieldset class="fieldset">
					<legend>Eliminar tipo de dispositivo</legend>
					<!-- ************************-->
					<table class="table table-bordered table-striped">
						<tr>
							<th>Seleccionar</th>
							<th>Nombre</th>
						</tr>
						{foreach from=$lista item=fila}
						<tr>
							<td><input type="checkbox" name="borrar[{$fila->id}]" value="{$fila->id}"></td>
							<td>{$fila->nombre_tipo_dispositivo}</td>
						</tr>
						{/foreach}
					</table>
					<!-- ************************-->
					<div class="form-group" align="center">
						<div class="pagination">
							{$paginacion}
						</div>
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
{/literal}

{include file="includes/footer.tpl"}