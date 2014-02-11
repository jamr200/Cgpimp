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
			<form id="update1proveedor" action="{base_url()}proveedor_controller/updateProveedor" method="POST">
				<fieldset class="fieldset">
					<legend>Modificar proveedor</legend>
					<!-- ************************-->
					<div class="col-md-12">
						<div class="form-group">
							<label for="combo_proveedor">Selecciona proveedor:</label>
							<select class="form-control" id="combo_proveedor" name="combo_proveedor">
								<option value=""></option>
								{section name=p loop=$proveedor}
									<option value="{$proveedor[p]['id']}">{$proveedor[p]['nombre_proveedor']}</option>
								{/section}
							</select>
						</div>
					</div>
					<!-- ************************-->
					<div class="col-md-12">
						<div class="form-group">
							<label for="modifica_proveedor"></label>
							<div class="controls" id="modifica_proveedor" name="modifica_proveedor"></div>
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
			// Parametros para el combo_proveedor
		   $("#combo_proveedor").change(function () {
		   		$("#combo_proveedor option:selected").each(function () {
					//alert($(this).val());
						elegido=$(this).val();
						$.post("combo_proveedor", { elegido: elegido }, function(data){
						$("#modifica_proveedor").html(data);
					});
		        });
		   })
		});
</script>
<!-- Validacion desde el lado del cliente -->
<script>
	$(document).ready(function(){
		$('#update2proveedor').validate({
			errorElement: "span",
			errorClass: 'help-block',
			rules:
			{
				nombre: {required: true, rangelength: [4,50]},
				email: {required: true, email: true},
				telefono_fijo: {required: true, rangelength: [9,12]},
				fax: {rangelength: [9,12]},
				direccion: {required: true, maxlength: 80},
				nombre_contacto:{maxlength: 80},
				telefono_contacto:{exactlength: 9}
			},
			messages:
			{
				nombre: "Este campo es obligatorio y debe tener entre 3 y 20 caracteres.",
				email : "Este campo es obligatorio y debe tener formato de email correcto.",
				telefono_fijo : "El campo Tel&eacute;fono es obligatorio o no ha escrito un telefono correcto.",
				fax : "Este campo debe tener entre 9 y 12 caracteres.",
				direccion : "Este campo es obligatorio y no debe exceder los 80 caracteres.",
				nombre_contacto : "Este campo no debe exceder los 80 caracteres.",
				telefono_contacto : "Este campo debe de tener un telefono correcto."
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
    	$("#combo_proveedor").select2();
    });
</script>
{/literal}

{include file="includes/footer.tpl"}