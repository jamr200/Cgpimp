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
			<form id="generapdflistadopedido" action="{base_url()}pedido_controller/GeneraPdfListadoPedido" method="POST">
				<fieldset class="fieldset">
					<legend>Listado de pedidos</legend>
					<!-- ************************-->
					{if $listado_pedidos != "no hay datos"}
						<table class="table table-bordered table-striped">
							<tr>
								<th width="42">Id</th>
								<th width="208">Nombre</th>
								<th width="326">Observaciones</th>
								<th width="262">Proveedor</th>
								<th width="98">Acciones</th>
							</tr>
							{foreach from=$listado_pedidos item=fila}
							<tr>
								<td width="42">{$fila->id}</td>
								<td width="208"><a data-toggle="modal" href="#myModal{$fila->id}" class="btn" id='modal'>{$fila->nombre_pedido}</a></td>

								<!--Modal-->
								<div class="modal fade" id='myModal{$fila->id}' tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									<div id="thanks{$fila->id}">
										<div class="modal-dialog">
										    <div class="modal-content">
										    	<!-- ************************-->
										       	<div class="modal-header">
										       		<h3 class="modal-title">Información de Pedido con id {$fila->id}</h3>
										       	</div>
										       	<!-- ************************-->
										        <div class="modal-body">
										        	<!-- Para listar ficheros -->
												    <h4>Ficheros</h4>
												    {if $fila->ficheros != NULL}
													    {foreach from=$fila->ficheros item=fich}
													    	<p>{$fich}</p>
													    {/foreach}
													{else}
														<p>No existen ficheros asociados a este pedido</p>
													{/if}
													<!-- Para listar instancias de dispositivo -->
												    <h4>Instancias de dispositivo (id // tipo // marca // modelo // part number // num serie)</h4>
												    {if $fila->instancias_dispositivo != NULL}
													    {foreach from=$fila->instancias_dispositivo item=inst_disp}
													    	<p>{$inst_disp->id} // {$inst_disp->tipo_dispositivo} // {$inst_disp->marca} // {$inst_disp->modelo} // {$inst_disp->part_number} // {$inst_disp->num_serie}</p>
													    {/foreach}
													{else}
														<p>No existen instancias de dispositivo asociadas a este pedido</p>
													{/if}
													<!-- Para listar instancias de material -->
												    <h4>Instancias de material (id // tipo // marca // modelo // part number // num serie)</h4>
												    {if $fila->instancias_material != NULL}
													    {foreach from=$fila->instancias_material item=inst_mat}
													    	<p>{$inst_mat->id} // {$inst_mat->tipo_material} // {$inst_mat->marca} // {$inst_mat->modelo} // {$inst_mat->part_number} // {$inst_mat->num_serie}</p>
													    {/foreach}
													{else}
														<p>No existen instancias de material asociadas a este pedido</p>
													{/if}
										        </div>
										        <!-- ************************-->
											    <div class="modal-footer">
											       	<button type="button" class="btn btn-default" id="cerrar{$fila->id}" data-dismiss="modal">Cerrar</button>
											    </div>
											    <!-- ************************-->
										    </div><!-- /.modal-content -->
										</div><!-- /.modal-dialog -->
									</div>
								</div><!-- /.modal -->
								<!--Cierro Modal-->

								<td width="326">{$fila->observaciones}</td>
								<td width="262">{$fila->nombre_proveedor}</td>
								<td width="98">
									<a href="{base_url()}pedido_controller/visualizar_pedido/?id={$fila->id}"><span class="glyphicon glyphicon-eye-open"></span></a>
									<a href="{base_url()}pedido_controller/modificar_pedido2/?id={$fila->id}"><span class="glyphicon glyphicon-pencil"></span></a>
									<a href="{base_url()}pedido_controller/eliminar_pedido2/?id={$fila->id}"><span class="glyphicon glyphicon-remove"></span></a>
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
								<button type="submit" class="btn btn-primary">Generar Pdf</button>
								<a href="{base_url()}main" class="btn btn-default">Cancelar</a>
							</div>
						</div>
						<!-- ************************-->
					{else}
						<div class="col-md-12">
							<div class="form-group">
								<h2>No hay registros para este criterio de busqueda</h2>
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