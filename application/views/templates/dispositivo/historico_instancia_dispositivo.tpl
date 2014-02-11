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
            <form id="historicoinstancia">
                <fieldset class="fieldset">
                <legend>Histórico de estados</legend>
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th width="90">Id instancia dispositivo</th>
                            <th width="90">Part number</th>
                            <th width="90">Num serie</th>
                            <th width="90">Estado</th>
                            <th width="90">Fecha</th>
                            <th width="90">Instancia asociada</th>
                        </tr>

                        {foreach from=$historico item=fila}
                        <tr>
                            <td width="90">{$fila->instancia_dispositivo}</td>
                            <td width="90">{$fila->part_number}</td>
                            <td width="90">{$fila->num_serie}</td>
                            <td width="90">{$fila->estado}</td>
                            <td width="90">{$fila->fecha}</td>
                            <td width="90">{$fila->instancia_relacion}</td>
                        </tr>
                        {/foreach}
                    </table>
                    <!-- ************************-->
                    <a href="{base_url()}dispositivo_controller/buscar_instancia_dispositivo" class="btn btn-default">Cancelar</a>
                </fieldset>
            </form>
        </div>
        <div class="col-md-1"></div>
    </div>
</div>

{include file="includes/footer.tpl"}
