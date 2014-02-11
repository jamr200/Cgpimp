
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

<div class="modal-dialog">
  <div class="modal-content">
    <!-- ************************-->
    <div class="modal-header">
      <h3 class="modal-title">Ingresar balda</h3>
    </div>
    <!-- ************************-->
    <div class="modal-body">
    {validation_errors('<p class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign"></span>','</p>')}
	{if isset($error)}
		<p class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign"></span> {$error}</p>
	{/if}
	{if isset($success)}
		<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> {$success}</p>
	{/if}
      <form class="FormBalda" id="FormBalda">
        <fieldset>
        <!-- ************************-->
        <div class="form-group">
			<label for="edificio4">Edificio</label>
			<select class="form-control" name="edificio4" id="edificio4">
				<option value=""></option>
				{section name=edif loop=$edificio}
					<option value="{$edificio[edif]['id']}">{$edificio[edif]['nombre_edificio']}</option>
				{/section}
			</select>
		</div>
		<!-- ************************-->
		<div class="form-group">
			<label for="habitacion4">Habitación</label>
			<select class="form-control" name="habitacion4" id="habitacion4">
			</select>
		</div>
		<!-- ************************-->
		<div class="form-group">
			<label for="mueble4">Mueble</label>
			<select class="form-control" name="mueble4" id="mueble4">
			</select>
		</div>
		<!-- ************************-->
        <div class="form-group">
          <label for="nombre">Nombre</label>
          <input type="text" class="form-control" id="nombre" name="nombre" value="" placeholder="Nombre">
        </div>
        <!-- ************************-->
		<!--campo oculto con la url de la página-->
		<input type="hidden" value="{base_url()}" id="hiddenBaseUrl"/>
		<!-- ************************-->
        </fieldset>
      </form>
    </div>
    <!-- ************************-->
    <div class="modal-footer">
      <button type="button" class="btn btn-default" id="cerrar4" data-dismiss="modal">Cerrar</button>
      <button type="button" class="btn btn-primary" id="submit4">Guardar</button>
    </div>
    <!-- ************************-->
  </div>
</div>

{literal}
<script>
	$(function() {
		var url_base = $('#hiddenBaseUrl').val();//campo oculto del formulario con la baseurl()
	    $("button#submit4").click(function(){
	        $.ajax({
	        type: "POST",
	        url: url_base + "ubicacion_controller/addBaldaModal",
	        data: $('form.FormBalda').serialize(),
	        success: function(msg){
	        	$("#thanks4").html(msg)
	            $("#modal4").modal('hide');
	            },
	        error: function(){
	            alert("failure");
	            }
	        });
	    });
	});
</script>
<script>
    $("#cerrar4").click(function(){
    	var url_base = $('#hiddenBaseUrl').val();//campo oculto del formulario con la baseurl()
    	$("#edificio").load(url_base + "ubicacion_controller/recarga_edificio", $('form.FormEdificio').serialize());
    	$("#habitacion").load(url_base + "ubicacion_controller/recarga_habitacion", $('form.FormHabitacion').serialize());
    	$("#mueble").load(url_base + "ubicacion_controller/recarga_mueble", $('form.FormMueble').serialize());
    	$("#balda").load(url_base + "ubicacion_controller/recarga_balda", $('form.FormBalda').serialize());
    });
</script>
<!--Jquery para combos-->
<script>
	$(document).ready(function(){
		// Parametros para el edificio4
		$("#edificio4").change(function () {
			$("#edificio4 option:selected").each(function () {
				//alert($(this).val());
					elegido=$(this).val();
					$.post("edificio4", { elegido: elegido }, function(data){
					$("#habitacion4").html(data);
					$("#mueble4").html("");
				});
			});
		})
		// Parametros para el habitacion4
		$("#habitacion4").change(function () {
			$("#habitacion4 option:selected").each(function () {
				//alert($(this).val());
					elegido=$(this).val();
					$.post("habitacion4", { elegido: elegido }, function(data){
					$("#mueble4").html(data);
				});
			});
		})
	});
</script>
<script>
  $(document).ready(function(){
    //Validacion para modal
    $('#FormBalda').validate({
      errorElement: "span",
      errorClass: 'help-block',
      rules:
      {
        nombre: {required: true, rangelength: [2,50]}
      },
      messages:
      {
        nombre: "Este campo es obligatorio y debe tener entre 2 y 50 caracteres."
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
    	$("#edificio4").select2();
    	$("#habitacion4").select2();
    	$("#mueble4").select2();
    });
</script>
{/literal}