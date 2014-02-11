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
        <form id="visualizaproveedor" method="POST">
            <fieldset class="fieldset">
            <legend>Información del proveedor</legend>
                <!-- ************************-->
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <p class="form-control-static">{$proveedor->nombre_proveedor}</p>
                    </div>
                </div>
                <!-- ************************-->
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="telefono_fijo">Teléfono fijo</label>
                        <p class="form-control-static">{$proveedor->telefono_fijo}</p>
                    </div>
                </div>
                <!-- ************************-->
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="telefono_movil">Teléfono móvil</label>
                        <p class="form-control-static">{if $proveedor->telefono_movil != 0}{$proveedor->telefono_movil}{/if}</p>
                    </div>
                </div>
                <!-- ************************-->
                <div class="clearfix visible"></div>
                <!-- ************************-->
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <p class="form-control-static">{$proveedor->email}</p>
                    </div>
                 </div>
                <!-- ************************-->
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <p class="form-control-static">{$proveedor->direccion}</p>
                    </div>
                </div>
                <!-- ************************-->
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="departamento">Fax</label>
                        <p class="form-control-static">{if $proveedor->fax != 0}{$proveedor->fax}{/if}</p>
                    </div>
                </div>
                <!-- ************************-->
                <div class="clearfix visible"></div>
                <!-- ************************-->
                <!-- ************************-->
                <legend>Información de contacto</legend>
                <!-- ************************-->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nombre_contacto">Nombre contacto</label>
                        <p class="form-control-static">{$proveedor->contacto}</p>
                    </div>
                </div>
                <!-- ************************-->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="telefono_contacto">Teléfono contacto</label>
                        <p class="form-control-static">{if $proveedor->telefono_contacto != 0}{$proveedor->telefono_contacto}{/if}</p>
                    </div>
                </div>
                <!-- ************************-->
                <div class="clearfix visible"></div>
                <!-- ************************-->
                <a href="{base_url()}proveedor_controller/modificar_proveedor2/?id={$proveedor->id}" class="btn btn-primary">Modificar</a>
                <a href="{base_url()}proveedor_controller/listar_proveedor" class="btn btn-default">Cancelar</a>
                <!-- ************************-->
            </fieldset>
        </form>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
{include file="includes/footer.tpl"}