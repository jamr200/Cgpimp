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
			<form id="" action="" method="POST">
				<fieldset class="fieldset">
					<legend>Listado de ubicaciones</legend>
					<!-- ************************-->
					{if $ubicacion != "no hay datos"}
						<table class="table table-bordered table-striped">
							<tr>
								<th width="195">Instancia</th>
								<th width="185">Edificio</th>
								<th width="152">Habitación</th>
								<th width="152">Mueble</th>
								<th width="152">Balda</th>
								<th width="98">Acciones</th>
							</tr>
							{foreach from=$ubicacion item=fila}
							<tr>
								<td width="195">{$fila->id} // {$fila->part_number} // {$fila->num_serie}</td>
								<td width="185">{$fila->nombre_edificio}</td>
								<td width="152">{$fila->nombre_habitacion}</td>
								<td width="152">{$fila->nombre_mueble}</td>
								<td width="152">{$fila->nombre_balda}</td>
								<td width="98">
									<a href="" class="btn disabled"><span class="glyphicon glyphicon-eye-open"></span></a>
									<a href="" class="btn disabled"><span class="glyphicon glyphicon-pencil"></span></a>
									<a href="{base_url()}ubicacion_controller/eliminar_ubicacion/?id={$fila->id_ubicacion}"><span class="glyphicon glyphicon-remove"></span></a>
									<a href="" class="btn disabled"><span class="glyphicon glyphicon-stats"></span></a>
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
						<a href="{base_url()}ubicacion_controller/buscar_ubicacion" class="btn btn-primary">Cancelar</a>
						<!-- ************************-->
					{else}
						<h2>No hay registros para este criterio de búsqueda</h2>
						<a href="{base_url()}ubicacion_controller/buscar_ubicacion" class="btn btn-default">Cancelar</a>
					{/if}
				</fieldset>
			</form>
		</div>
		<div class="col-md-1"></div>
	</div>
</div>

{include file="includes/footer.tpl"}