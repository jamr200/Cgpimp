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
        <form id="visualizapersona" method="POST">
            <fieldset class="fieldset">
            <legend>Información de la persona</legend>
                <!-- ************************-->
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <p class="form-control-static">{$persona->nombre_persona}</p>
                    </div>
                </div>
                <!-- ************************-->
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="apellidos">Apellidos</label>
                        <p class="form-control-static">{$persona->apellido1} {$persona->apellido2}</p>
                    </div>
                 </div>
                <!-- ************************-->
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="dni">DNI</label>
                        <p class="form-control-static">{$persona->dni}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <p class="form-control-static">{$persona->email}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="departamento">Departamento</label>
                        <p class="form-control-static">{$departamento}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="jefe">Jefe</label>
                        <p class="form-control-static">{$persona->jefe}</p>
                    </div>
                </div>
                <!-- ************************-->
                <div class="clearfix visible"></div>
                <!-- ************************-->
                <!-- ************************-->
                <a href="{base_url()}persona_controller/modificar_persona2/?id={$persona->id}" class="btn btn-primary">Modificar</a>
                <a href="{base_url()}persona_controller/listar_persona" class="btn btn-default">Cancelar</a>
                <!-- ************************-->
            </fieldset>
        </form>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
{include file="includes/footer.tpl"}