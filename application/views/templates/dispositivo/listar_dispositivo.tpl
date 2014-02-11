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
			<form id="generapdflistadodispositivo" action="{base_url()}dispositivo_controller/GeneraPdfListadoDispositivo" method="POST">
				<fieldset class="fieldset">
					<legend>Listado de dispositivo</legend>
					<!-- ************************-->
					{if $listado_dispositivos != "no hay datos"}
						<table class="table table-bordered table-striped">
							<tr>
								<th width="46">Id</th>
								<th width="245">Nombre</th>
								<th width="321">Marca</th>
								<th width="322">Modelo</th>
							</tr>
							{foreach from=$listado_dispositivos item=fila}
							<tr>
								<td width="46">{$fila->id}</td>
								<td width="245">{$fila->nombre_tipo_dispositivo}</td>
								<td width="321">{$fila->nombre_marca}</td>
								<td width="322">{$fila->nombre_modelo}</td>
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