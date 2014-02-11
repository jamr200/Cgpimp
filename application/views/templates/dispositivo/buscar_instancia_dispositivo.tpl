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
			{if isset($error)}
				<p class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign"></span> {$error}</p>
			{/if}
			{if isset($success)}
				<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> {$success}</p>
			{/if}
			<form id="buscainstanciadispositivo" name="myform" onsubmit="return OnSubmitForm();" method="POST">
				<fieldset class="fieldset">
					<legend>Búsqueda de instancia de dispositivo</legend>
					<!-- ************************-->
					<table>
						<tbody>
							<!--fila 1-->
							<tr>
								<td width="25%" align="left">
									<div class="col-md-12">
										<div class="form-group">
											<label for="tipo_dispositivo">Tipo de dispositivo</label>
											<select class="form-control" name="tipo_dispositivo" id="tipo_dispositivo">
												<option value=""></option>
												{section name=disp loop=$dispositivo}
													<option value="{$dispositivo[disp]['id']}">{$dispositivo[disp]['nombre_tipo_dispositivo']}</option>
												{/section}
											</select>
										</div>
									</div>
								</td>
								<td width="25%" align="left">
									<div class="col-md-12">
										<div class="form-group">
											<label for="marca_dispositivo">Marca</label>
											<select class="form-control" name="marca_dispositivo" id="marca_dispositivo">
												<option value=""></option>
												{section name=mar loop=$marca}
													<option value="{$marca[mar]['id']}">{$marca[mar]['nombre_marca']}</option>
												{/section}
											</select>
										</div>
									</div>
								</td>
								<td width="25%" align="left">
									<div class="col-md-12">
										<div class="form-group">
											<label for="modelo_dispositivo">Modelo</label>
											<select class="form-control" name="modelo_dispositivo" id="modelo_dispositivo">
												<option value=""></option>
												{section name=mod loop=$modelo}
													<option value="{$modelo[mod]['id']}">{$modelo[mod]['nombre_modelo']}</option>
												{/section}
											</select>
										</div>
									</div>
								</td>
							</tr>
							<!-- ************************-->
							<div class="clearfix visible"></div>
							<!-- ************************-->
							<!--fila 2-->
							<tr>
								<td width="25%" align="left">
									<div class="col-md-12">
										<div class="form-group">
											<label for="departamento">Departamento</label>
											<select class="form-control" name="departamento" id="departamento">
												<option value=""></option>
												{section name=dep loop=$departamento}
													<option value="{$departamento[dep]['id']}">{$departamento[dep]['nombre_departamento']}</option>
												{/section}
											</select>
										</div>
									</div>
								</td>
								<td width="25%" align="left">
									<div class="col-md-12">
										<div class="form-group">
											<label for="estado">Estado</label>
											<select class="form-control" name="estado" id="estado">
												<option value=""></option>
												{section name=est loop=$estado}
													<option value="{$estado[est]['id']}">{$estado[est]['nombre_estado']}</option>
												{/section}
											</select>
										</div>
									</div>
								</td>
							</tr>
							<!--fila 3-->
							<tr>
								<td width="25%" align="left">
									<div class="col-md-12">
										<div class="form-group">
											<label for="fecha_ini">Fecha de inicio</label>
											<input type="date" class="form-control" id="fecha_ini" name="fecha_ini" value="{if isset($smarty.post.fecha_ini)}{$smarty.post.fecha_ini}{/if}" placeholder="Fecha_inicio">
										</div>
									</div>
								</td>
								<td width="25%" align="left">
									<div class="col-md-12">
										<div class="form-group">
											<label for="fecha_fin">Fecha fin</label>
											<input type="date" class="form-control" id="fecha_fin" name="fecha_fin" value="{if isset($smarty.post.fecha_fin)}{$smarty.post.fecha_fin}{/if}" placeholder="Fecha_Fin">
										</div>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
					<!-- ************************-->
					<!--campo oculto con la url de la página-->
					<input type="hidden" value="{base_url()}" id="hiddenBaseUrl"/>
					<!-- ************************-->
					<div class="col-md-8">
						<div class="form-group">
							<input type="submit" class="btn btn-primary" name="operation" onclick="document.pressed=this.value" value="Buscar"/>
							<input type="submit" class="btn btn-default" name="operation" onclick="document.pressed=this.value" value="Generar Pdf"/>
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
<!--JQuery para usar select 2 -->
<script>
    $(document).ready(function(){
    	$("#tipo_dispositivo").select2();
    	$("#marca_dispositivo").select2();
    	$("#modelo_dispositivo").select2();
    	$("#departamento").select2();
    	$("#estado").select2();
    });
</script>
<!-- Combos anidados pagina principal -->
<script>
	$(document).ready(function(){
		// Parametros para el tipo_dispositivo
		$("#tipo_dispositivo").change(function () {
			$("#tipo_dispositivo option:selected").each(function () {
				//alert($(this).val());
					elegido=$(this).val();
					$.post("tipo_dispositivo", { elegido: elegido }, function(data){
					$("#marca_dispositivo").html(data);
					$("#modelo_dispositivo").html("");
				});
			});
		})
		// Parametros para el marca_dispositivo
		$("#marca_dispositivo").change(function () {
			$("#marca_dispositivo option:selected").each(function () {
				//alert($(this).val());
					elegido=$(this).val();
					$.post("marca_dispositivo", { elegido: elegido }, function(data){
					$("#modelo_dispositivo").html(data);
				});
			});
		})
	});
</script>
<script type="text/javascript">
function OnSubmitForm()
{
  if(document.pressed == 'Buscar')
  {
   document.myform.action ="buscaInstanciaDispositivo";
  }
  else
  if(document.pressed == 'Generar Pdf')
  {
    document.myform.action ="GeneraPdfInstanciaDispositivo";
  }
  return true;
}
</script>
{/literal}

{include file="includes/footer.tpl"}