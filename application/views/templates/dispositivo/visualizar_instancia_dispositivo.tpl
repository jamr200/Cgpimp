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
        <form id="visualizadispositivo" method="POST">
            <fieldset class="fieldset">
            <legend>Información de la instancia de dispositivo con id {$instancia->id}</legend>
                <!-- ************************-->
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="Tipo">Tipo</label>
                        <p class="form-control-static">{$tipo}</p>
                    </div>
                </div>
                <!-- ************************-->
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="marca">Marca</label>
                        <p class="form-control-static">{$marca}</p>
                    </div>
                 </div>
                <!-- ************************-->
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="modelo">Modelo</label>
                        <p class="form-control-static">{$modelo}</p>
                    </div>
                </div>
                <!-- ************************-->
                <div class="clearfix visible"></div>
                <!-- ************************-->
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="id">Id</label>
                        <p class="form-control-static">{$instancia->id}</p>
                    </div>
                </div>
                <!-- ************************-->
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="part_number">Part number</label>
                        <p class="form-control-static">{$instancia->part_number}</p>
                    </div>
                </div>
                <!-- ************************-->
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="num_serie">Num serie</label>
                        <p class="form-control-static">{$instancia->num_serie}</p>
                    </div>
                </div>
                <!-- ************************-->
                <div class="clearfix visible"></div>
                <!-- ************************-->
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="fecha">Fecha de compra</label>
                        <p class="form-control-static">{$instancia->fecha_compra}</p>
                    </div>
                </div>
                <!-- ************************-->
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="garantia">Garantía</label>
                        <p class="form-control-static">{if $instancia->garantia != 0}{$instancia->garantia}{/if}</p>
                    </div>
                </div>
                <!-- ************************-->
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="pedido">Pedido</label>
                        <p class="form-control-static">{$nombre_ped}</p>
                    </div>
                </div>
                <!-- ************************-->
                <div class="clearfix visible"></div>
                <!-- ************************-->
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="departamento">Departamento</label>
                        <p class="form-control-static">{$nombre_dep}</p>
                    </div>
                </div>
                <!-- ************************-->
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <p class="form-control-static">{$nombre_estado}</p>
                    </div>
                </div>
                <!-- ************************-->
                <div class="clearfix visible"></div>
                <!-- ************************-->
                <a href="{base_url()}dispositivo_controller/modificar_instancia_dispositivo2/?id={$instancia->id}" class="btn btn-primary">Modificar</a>
                <a href="{base_url()}dispositivo_controller/buscar_instancia_dispositivo" class="btn btn-default">Cancelar</a>
                <!-- ************************-->
            </fieldset>
        </form>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
{include file="includes/footer.tpl"}