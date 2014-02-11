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
        <form id="eliminadepartamento" method="POST">
            <fieldset class="fieldset">
            <legend>Información del departamento</legend>
                <!-- ************************-->
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <p class="form-control-static">{$departamento->nombre_departamento}</p>
                    </div>
                </div>
                <!-- ************************-->
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <div class="controls">
                            <p class="form-control-static">{$departamento->email}</p>
                        </div>
                    </div>
                </div>
                <!-- ************************-->
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <div class="controls">
                            <p class="form-control-static">{$departamento->telefono}</p>
                        </div>
                    </div>
                </div>
                <!-- ************************-->
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="fax">Fax</label>
                        <div class="controls">
                            <p class="form-control-static">{if $departamento->fax != 0}{$departamento->fax}{/if}</p>
                        </div>
                    </div>
                </div>
                <!-- ************************-->
                <a href="{base_url()}departamento_controller/deleteDepartamento2/?id_departamento={$departamento->id}" class="btn btn-primary">Eliminar</a>
                <a href="{base_url()}departamento_controller/listar_departamento" class="btn btn-default">Cancelar</a>
                <!-- ************************-->
            </fieldset>
        </form>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
{include file="includes/footer.tpl"}