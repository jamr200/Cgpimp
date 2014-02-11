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
        <form id="eliminapedido" method="POST">
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
                <a href="{base_url()}pedido_controller/deletePedido2/?id_pedido={$pedido->id}" class="btn btn-primary">Eliminar</a>
                <a href="{base_url()}pedido_controller/listar_pedido" class="btn btn-default">Cancelar</a>
                <!-- ************************-->
            </fieldset>
        </form>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
{include file="includes/footer.tpl"}