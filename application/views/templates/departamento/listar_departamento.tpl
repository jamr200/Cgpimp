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
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<form id="generapdflistadodepartamentos" action="{base_url()}departamento_controller/GeneraPdfListadoDepartamento" method="POST">
				<fieldset class="fieldset">
					<legend>Listado de departamentos</legend>
					<!-- ************************-->
					{if $listado_departamentos != "no hay datos"}
						<table class="table table-bordered table-striped">
							<tr>
								<th width="306">Nombre</th>
								<th width="290">Email</th>
								<th width="120">Teléfono</th>
								<th width="120">Fax</th>
								<th width="98">Acciones</th>
							</tr>
							{foreach from=$listado_departamentos item=fila}
							<tr>
								<td width="306">{$fila->nombre_departamento}</td>
								<td width="290">{$fila->email}</td>
								<td width="120">{$fila->telefono}</td>
								<td width="120">{if $fila->fax != 0}{$fila->fax}{/if}</td>
								<td width="98">
									<a href="" class="btn disabled"><span class="glyphicon glyphicon-eye-open"></span></a>
									<a href="{base_url()}departamento_controller/modificar_departamento2/?id={$fila->id}"><span class="glyphicon glyphicon-pencil"></span></a>
									<a href="{base_url()}departamento_controller/eliminar_departamento2/?id={$fila->id}"><span class="glyphicon glyphicon-remove"></span></a>
									<a href="" class="btn disabled"><span class="glyphicon glyphicon-stats"></span></a>
								</td>
							</tr>
							{/foreach}
						</table>
						<!-- ************************-->
						<div class="col-md-12">
							<div class="form-group" align="center">
								<div class="pagination">
									{$paginacion}
								</div>
							</div>
						</div>
						<!-- ************************-->
						<!--campo oculto con la url de la página-->
						<input type="hidden" value="{base_url()}" id="hiddenBaseUrl"/>
						<!-- ************************-->
						<div class="col-md-12">
							<div class="form-group">
								<button type="submit" class="btn btn-primary">Genera Pdf</button>
								<a href="{base_url()}main" class="btn btn-default">Cancelar</a>
							</div>
						</div>
						<!-- ************************-->
					{else}
						<div class="col-md-12">
							<div class="form-group">
								<h2>No hay registros para este criterio de búsqueda</h2>
								<a href="{base_url()}main" class="btn btn-default">Cancelar</a>
							</div>
						</div>
					{/if}
				</fieldset>
			</form>
		</div>
		<div class="col-md-1"></div>
	</div>
</div>

{include file="includes/footer.tpl"}