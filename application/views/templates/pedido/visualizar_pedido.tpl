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
        <form id="visualizapedido" method="POST">
            <fieldset class="fieldset">
            <legend>Información del pedido con id {$pedido->id}</legend>
                <!-- ************************-->
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <p class="form-control-static">{$pedido->nombre_pedido}</p>
                    </div>
                </div>
                <!-- ************************-->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="observaciones">Observaciones</label>
                        <p class="form-control-static">{$pedido->observaciones}</p>
                    </div>
                 </div>
                <!-- ************************-->
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="proveedor">Proveedor</label>
                        <p class="form-control-static">{$proveedor}</p>
                    </div>
                </div>
                <!-- ************************-->
                <div class="clearfix visible"></div>
                <!-- ************************-->
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="ficheros">Ficheros</label>
                        {if $pedido->ficheros != NULL}
                            {foreach from=$pedido->ficheros item=fich}
                                <p><a href="{base_url()}uploads/pedidos/{$pedido->id}/{$fich}">{$fich}</a></p>
                            {/foreach}
                        {else}
                            <p>No existen ficheros asociados a este pedido</p>
                        {/if}
                    </div>
                </div>
                <!-- ************************-->
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="inst_dispositivos">Instancias de dispositivo</label>
                        {if $pedido->instancias_dispositivo != NULL}
                            {foreach from=$pedido->instancias_dispositivo item=inst_disp}
                                <p><a href="{base_url()}dispositivo_controller/visualizar_instancia_dispositivo/?id={$inst_disp->id}">{$inst_disp->id} // {$inst_disp->tipo_dispositivo} // {$inst_disp->marca} // {$inst_disp->modelo} // {$inst_disp->part_number} // {$inst_disp->num_serie}</a></p>
                            {/foreach}
                        {else}
                            <p>No existen instancias de dispositivo asociadas a este pedido</p>
                        {/if}
                    </div>
                </div>
                <!-- ************************-->
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="inst_materiales">Instancias de materiales</label>
                        {if $pedido->instancias_material != NULL}
                            {foreach from=$pedido->instancias_material item=inst_mat}
                                <p><a href="{base_url()}material_controller/visualizar_instancia_material/?id={$inst_mat->id}">{$inst_mat->id} // {$inst_mat->tipo_material} // {$inst_mat->marca} // {$inst_mat->modelo} // {$inst_mat->part_number} // {$inst_mat->num_serie}</a></p>
                            {/foreach}
                        {else}
                            <p>No existen instancias de materiales asociadas a este pedido</p>
                        {/if}
                    </div>
                </div>
                <!-- ************************-->
                <div class="clearfix visible"></div>
                <!-- ************************-->
                <!-- ************************-->
                <a href="{base_url()}pedido_controller/modificar_pedido2/?id={$pedido->id}" class="btn btn-primary">Modificar</a>
                <a href="{base_url()}pedido_controller/listar_pedido" class="btn btn-default">Cancelar</a>
                <!-- ************************-->
            </fieldset>
        </form>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
{include file="includes/footer.tpl"}