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
			{if isset($error)}
				<p class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign"></span> {$error}</p>
			{/if}
			{if isset($success)}
				<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> {$success}</p>
			{/if}
			<form id="update1persona" action="{base_url()}persona_controller/updatePersona" method="POST">
				<fieldset class="fieldset">
					<legend>Modificar persona</legend>
					<!-- ************************-->
					<div class="col-md-12">
						<div class="form-group">
							<label for="combo_persona">Seleccione persona</label>
							<select class="form-control" id="combo_persona" name="combo_persona">
								<option value=""></option>
								{section name=p loop=$persona}
									<option value="{$persona[p]['id']}">{$persona[p]['nombre_persona']} {$persona[p]['apellido1']} {$persona[p]['apellido2']}</option>
								{/section}
							</select>
						</div>
					</div>
					<!-- ************************-->
					<div class="col-md-12">
						<div class="form-group">
							<label for="modifica_persona"></label>
							<div class="controls" id="modifica_persona" name="modifica_persona">
							</div>
						</div>
					</div>
				</fieldset>
			</form>
		</div>
		<div class="col-md-2"></div>
	</div>
</div>

{literal}
<script language="javascript">
		$(document).ready(function(){
			// Parametros para el combo_persona
		   $("#combo_persona").change(function () {
		   		$("#combo_persona option:selected").each(function () {
					//alert($(this).val());
						elegido=$(this).val();
						$.post("combo_persona", { elegido: elegido }, function(data){
						$("#modifica_persona").html(data);
					});
		        });
		   })
		});
</script>
<!-- Validacion desde lado del cliente -->
<script>
	$(document).ready(function(){
		$('#update2persona').validate({
			errorElement: "span",
			errorClass: 'help-block',
			rules:
			{
				nombre: {required: true, rangelength: [3,20]},
				apellido1: {required: true, rangelength: [4,30]},
				apellido2: {required: true, rangelength: [4,30]},
				dni: {required: true, exactlength: 9},
				email: {required: true, email: true},
				departamento: {required: true},
				jefe: {required: true}
			},
			messages:
			{
				nombre: "Este campo es obligatorio y debe tener entre 3 y 20 caracteres.",
				apellido1: "Este campo es obligatorio y debe tener entre 4 y 30 caracteres.",
				apellido2: "Este campo es obligatorio y debe tener entre 4 y 30 caracteres.",
				dni: "Este campo es obligatorio",
				email : "Este campo es obligatorio y debe tener formato de email correcto."
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
    	$("#combo_persona").select2();
    });
</script>
{/literal}

{include file="includes/footer.tpl"}