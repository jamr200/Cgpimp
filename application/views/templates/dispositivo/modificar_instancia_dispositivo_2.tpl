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
			{validation_errors('<p class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign"></span>','</p>')}
			{if isset($advertencia)}
				<p class="alert alert-info"><span class="glyphicon glyphicon-warning-sign"></span> {$advertencia}</p>
			{/if}
			{if isset($error)}
				<p class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign"></span> {$error}</p>
			{/if}
			{if isset($success)}
				<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> {$success}</p>
			{/if}
			<form id="update2instdispositivo" action="{base_url()}dispositivo_controller/updateInstanciaDispositivo" method="POST">
				<fieldset class="fieldset">
					<legend>Modificar instancia de dispositivo</legend>
					<!-- ************************-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="part_number">Part Number</label>
                            <input type="text" class="form-control" id="part_number" name="part_number" value="{$instancia->part_number}" placeholder="Part_number">
                        </div>
                    </div>
                    <!-- ************************-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="num_serie">Número de Serie</label>
                            <input type="text" class="form-control" id="num_serie" name="num_serie" value="{$instancia->num_serie}" placeholder="Num_serie">
                        </div>
                    </div>
                    <!-- ************************-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="fecha">Fecha</label>
                            <input type="date" class="form-control" id="fecha" name="fecha" value="{$instancia->fecha_compra}" placeholder="Fecha">
                        </div>
                    </div>
                    <!-- ************************-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="garantia">Garantía</label>
                            <input type="text" class="form-control" id="garantia" name="garantia" value="{if $instancia->garantia != 0}{$instancia->garantia}{/if}" placeholder="Garantia">
                        </div>
                    </div>
                    <!-- ************************-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="pedido">Pedido</label>
                            <select class="form-control" id="pedido" name="pedido">
                                <option value="{$instancia->pedido}">{$nombre_ped}</option>
                                {section name=fila loop=$pedido}
                                    <option value="{$pedido[fila]['id']}">{$pedido[fila]['nombre_pedido']}</option>
                                {/section}
                            </select>
                        </div>
                    </div>
                    <!-- ************************-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="departamento">Departamento</label>
                            <select class="form-control" id="departamento" name="departamento">
                                <option value="{$instancia->departamento}">{$nombre_dep}</option>
                                {section name=fila loop=$dep}
                                    <option value="{$dep[fila]['id']}">{$dep[fila]['nombre_departamento']}</option>
                                {/section}
                            </select>
                        </div>
                    </div>
                    <!-- ************************-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="estado_actual">Estado</label>
                                <select class="form-control" id="estado_actual" name="estado_actual">
                                    <option value="{$instancia->estado_actual}">{$nombre_estado}</option>
                                    {section name=fila loop=$estado}
                                    <option value="{$estado[fila]['id']}">{$estado[fila]['nombre_estado']}</option>
                                {/section}
                                </select>
                        </div>
                    </div>
                    <!-- ************************-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="hidden" id="id_inst_dispositivo" name="id_inst_dispositivo" value="{$instancia->id}">
                        </div>
                    </div>
                    <!-- ************************-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a href="{base_url()}dispositivo_controller/buscar_instancia_dispositivo" class="btn btn-default">Cancelar</a>
                        </div>
                    </div>
                    <!-- ************************-->
					<!--campo oculto con la url de la página-->
					<input type="hidden" value="{base_url()}" id="hiddenBaseUrl"/>
					<!-- ************************-->
				</fieldset>
			</form>
		</div>
		<div class="col-md-2"></div>
	</div>
</div>

{literal}
<!-- Validacion de instancias desde el cliente -->
<script type="text/javascript">
	$(document).ready(function(){
		$('#update2instdispositivo').validate({
			errorElement: "span",
			errorClass: 'help-block',
			rules:
			{
				part_number: {required: true, rangelength: [3,45]},
				num_serie: {required: true, rangelength: [3,45]},
				fecha: {date:true},
				garantia: {},
				pedido: {required: true},
				departamento: {required: true}
			},
			messages:
			{
				part_number: "El part number es obligatorio y debe tener al menos 3 caracteres.",
				num_serie: "El número de serie es obligatorio y debe tener al menos 3 caracteres.",
				fecha: "La fecha no es correcta."
			},
			highlight: function(element)
			{
				$(element).closest('.form-group')
				.removeClass('has-success').addClass('has-error');
			},
			success: function(element)
			{
				$(element).closest('.form-group')
				.removeClass('has-error').addClass('has-success');
			}
		});
	});
</script>
<!--JQuery para usar select 2 -->
<script>
    $(document).ready(function(){
        $("#pedido").select2();
        $("#departamento").select2();
        $("#estado_actual").select2();
    });
</script>';
{/literal}

{include file="includes/footer.tpl"}