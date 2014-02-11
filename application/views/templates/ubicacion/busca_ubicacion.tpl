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
			<form id="buscaubicacion" name="myform" onsubmit="return OnSubmitForm();" method="POST">
				<fieldset class="fieldset">
					<legend>Busqueda de ubicación</legend>
					<!-- ************************-->
					<div class="col-md-12">
						<div class="form-group">
							<label for="edificio">Edificio</label>
							<select class="form-control" name="edificio" id="edificio">
								<option value=""></option>
								{section name=edif loop=$edificio}
									<option value="{$edificio[edif]['id']}">{$edificio[edif]['nombre_edificio']}</option>
								{/section}
							</select>
						</div>
					</div>
					<!-- ************************-->
					<div class="col-md-12">
						<div class="form-group">
							<label for="habitacion">Habitación</label>
							<select class="form-control" name="habitacion" id="habitacion">
							</select>
						</div>
					</div>
					<!-- ************************-->
					<div class="col-md-12">
						<div class="form-group">
							<label for="mueble">Mueble</label>
							<select class="form-control" name="mueble" id="mueble">
							</select>
						</div>
					</div>
					<!-- ************************-->
					<div class="col-md-12">
						<div class="form-group">
							<label for="balda">Balda</label>
							<select class="form-control" name="balda" id="balda">
							</select>
						</div>
					</div>
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
    	$("#edificio").select2();
    	$("#habitacion").select2();
    	$("#mueble").select2();
    	$("#balda").select2();
    });
</script>
<script>
//SCRIPT PARA LA UBICACION
$(document).ready(function(){
	// Parametros para el edificio
	$("#edificio").change(function () {
		$("#edificio option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("edificio", { elegido: elegido }, function(data){
				$("#habitacion").html(data);
				$("#mueble").html("");
				$("#balda").html("");
			});
		});
	})
	// Parametros para e habitacion
	$("#habitacion").change(function () {
		$("#habitacion option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("habitacion", { elegido: elegido }, function(data){
				$("#mueble").html(data);
				$("#balda").html("");
			});
		});
	})
	// Parametros para el mueble
	$("#mueble").change(function () {
		$("#mueble option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("balda", { elegido: elegido }, function(data){
				$("#balda").html(data);
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
   document.myform.action ="buscaUbicacion";
  }
  else
  if(document.pressed == 'Generar Pdf')
  {
    document.myform.action ="GeneraPdfUbicacion";
  }
  return true;
}
</script>
{/literal}

{include file="includes/footer.tpl"}