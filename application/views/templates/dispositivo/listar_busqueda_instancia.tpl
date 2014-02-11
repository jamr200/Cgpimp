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
			<form id="listadoinstanciadispositivo" method="POST">
				<fieldset class="fieldset">
					<legend>Listado de instancias de dispositivo</legend>
					<!-- ************************-->
					{if $instancias != "no hay datos"}
						<table class="table table-bordered table-striped">
							<tr>
								<th width="42">Id</th>
								<th width="124">Tipo</th>
								<th width="130">Marca</th>
								<th width="130">Modelo</th>
								<th width="205">Part_number</th>
								<th width="205">Num_serie</th>
								<th width="98">Acciones</th>
							</tr>
							{foreach from=$instancias item=fila}
							<tr>
								<td width="42">{$fila->id}</td>
								<td width="124">{$fila->nombre_tipo_dispositivo}</td>
								<td width="130">{$fila->nombre_marca}</td>
								<td width="130">{$fila->nombre_modelo}</td>
								<td width="205">{$fila->part_number}</td>
								<td width="205">{$fila->num_serie}</td>
								<td width="98">
									<a href="{base_url()}dispositivo_controller/visualizar_instancia_dispositivo/?id={$fila->id}"><span class="glyphicon glyphicon-eye-open"></span></a>
									<a href="{base_url()}dispositivo_controller/modificar_instancia_dispositivo2/?id={$fila->id}"><span class="glyphicon glyphicon-pencil"></span></a>
									<a href="" class="btn disabled"><span class="glyphicon glyphicon-remove"></span></a>
									<a href="{base_url()}dispositivo_controller/historico_instancia_dispositivo2/?id={$fila->id}"><span class="glyphicon glyphicon-stats"></span></a>
								</td>
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
						<a href="{base_url()}dispositivo_controller/buscar_instancia_dispositivo" class="btn btn-primary">Cancelar</a>
						<!-- ************************-->
					{else}
						<h2>No hay registros para este criterio de busqueda</h2>
						<a href="{base_url()}dispositivo_controller/buscar_instancia_dispositivo" class="btn btn-default">Cancelar</a>
					{/if}
				</fieldset>
			</form>
		</div>
		<div class="col-md-1"></div>
	</div>
</div>

{include file="includes/footer.tpl"}