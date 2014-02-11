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
			<form id="update1departamento" action="{base_url()}departamento_controller/updateDepartamento" method="POST">
				<fieldset class="fieldset">
					<legend>Modificar departamento</legend>
					<!-- ************************-->
					<div class="col-md-12">
						<div class="form-group">
							<label for="combo_departamento">Nombre:</label>
							<select class="form-control" id="combo_departamento" name="combo_departamento">
								<option value=""></option>
								{section name=d loop=$departamentos}
									<option value="{$departamentos[d]['id']}">{$departamentos[d]['nombre_departamento']}</option>
								{/section}
							</select>
						</div>
					</div>
					<!-- ************************-->
					<div class="col-md-12">
						<div class="form-group">
							<label for="modifica_departamento"></label>
							<div class="controls" id="modifica_departamento" name="modifica_departamento">
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
			// Parametros para el combo_departamento
		   $("#combo_departamento").change(function () {
		   		$("#combo_departamento option:selected").each(function () {
					//alert($(this).val());
						elegido=$(this).val();
						$.post("combo_departamento", { elegido: elegido }, function(data){
						$("#modifica_departamento").html(data);
					});
		        });
		   })
		});
</script>
<!-- Validcion desde lado del cliente -->
<script>
	$(document).ready(function(){
		$('#update1departamento').validate({
			errorElement: "span",
			errorClass: 'help-block',
			rules:
			{
				nombre: {required: true, rangelength: [4,50]},
				email: {required: true, email: true},
				telefono: {required: true, rangelength: [9,12]},
			},
			messages:
			{
				nombre: "Este campo es obligatorio y debe tener entre 4 y 50 caracteres.",
				email : "Este campo es obligatorio y debe tener formato de email correcto.",
				telefono : "El campo Teléfono es obligatorio y no ha escrito un teléfono correcto."
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
		$("#combo_departamento").select2();
	});
</script>
{/literal}

{include file="includes/footer.tpl"}

