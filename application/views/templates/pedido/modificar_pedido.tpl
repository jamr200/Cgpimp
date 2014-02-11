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
				<p class="alert alert-warning"><span class="glyphicon glyphicon-exclamation-sign"></span> {$advertencia}</p>
			{/if}
			{if isset($error)}
				<p class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign"></span> {$error}</p>
			{/if}
			{if isset($success)}
				<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> {$success}</p>
			{/if}
			<form  id="updatepedido" action="{base_url()}pedido_controller/updatePedido" method="POST">
				<fieldset class="fieldset">
					<legend>Modificar pedido</legend>
					<!-- ************************-->
					<div class="col-md-12">
						<div class="form-group">
							<label for="combo_pedido">Nombre</label>
							<select class="form-control" id="combo_pedido" name="combo_pedido">
								<option value=""></option>
								{section name=p loop=$pedido}
									<option value="{$pedido[p]['id']}">{$pedido[p]['nombre_pedido']}</option>
								{/section}
							</select>
						</div>
					</div>
					<!-- ************************-->
					<div class="col-md-12">
						<div class="form-group">
							<label for="modifica_pedido"></label>
							<div class="controls" id="modifica_pedido" name="modifica_pedido">
							</div>
						</div>
					</div>
					<!-- ************************-->
				</fieldset>
			</form>
		</div>
		<div class="col-md-2"></div>
	</div>
</div>

{literal}
<script language="javascript">
		$(document).ready(function(){
			// Parametros para el combo_pedido
		   $("#combo_pedido").change(function () {
		   		$("#combo_pedido option:selected").each(function () {
					//alert($(this).val());
						elegido=$(this).val();
						$.post("combo_pedido", { elegido: elegido }, function(data){
						$("#modifica_pedido").html(data);
					});
		        });
		   })
		});
</script>
<!--JQuery para usar select 2 -->
<script>
    $(document).ready(function(){
    	$("#combo_pedido").select2();
    });
</script>
{/literal}

{include file="includes/footer.tpl"}