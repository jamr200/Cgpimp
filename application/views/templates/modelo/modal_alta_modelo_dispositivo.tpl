
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
      <h3 class="modal-title">Ingresa nuevo modelo</h3>
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
      <form class="FormModelo" id="FormModelo">
        <fieldset>
        <div class="form-group">
    			<label for="tipo_dispositivo3">Tipo de Dispositivo</label>
    			<select class="form-control" name="tipo_dispositivo3" id="tipo_dispositivo3">
    				<option value=""></option>
    				{section name=fila loop=$tipo}
    					<option value="{$tipo[fila]['id']}">{$tipo[fila]['nombre_tipo_dispositivo']}</option>
    				{/section}
    			</select>
    		</div>
    		<!-- ************************-->
    		<div class="form-group">
    			<label for="combo_marca3">Marca</label>
    			<select class="form-control" name="combo_marca3" id="combo_marca3">
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
      <button type="button" class="btn btn-default" id="cerrar3" data-dismiss="modal">Cerrar</button>
      <button type="button" class="btn btn-primary" id="submit3">Guardar</button>
    </div>
    <!-- ************************-->
  </div>
</div>

{literal}
<script>
  $(document).ready(function(){
    //Validacion para modal
    $('#FormModelo').validate({
      errorElement: "span",
      errorClass: 'help-block',
      rules:
      {
        nombre: {required: true, rangelength: [2,50]}
      },
      messages:
      {
        nombre: "Este campo es obligatorio y debe tener entre  y 50 caracteres."
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
<script>
 $(function() {
  var url_base = $('#hiddenBaseUrl').val();//campo oculto del formulario con la baseurl()
    $("button#submit3").click(function(){
        $.ajax({
        type: "POST",
        url: url_base + "modelo_controller/addModeloModalDispositivo",
        data: $('form.FormModelo').serialize(),
        success: function(msg){
        	$("#thanks3").html(msg)
            $("#modal3").modal('hide');
            },
        error: function(){
            alert("Selecciona tipo y marca.");
            }
        });
    });
});
</script>
<script>
    $("#cerrar3").click(function(){
      var url_base = $('#hiddenBaseUrl').val();//campo oculto del formulario con la baseurl()
    	$("#tipo_dispositivo").load(url_base + "dispositivo_controller/dame_tipos", $('form.FormTipo').serialize());
    	$("#marca_dispositivo").load(url_base + "marca_controller/dame_marcas_dispositivo", $('form.FormMarca').serialize());
    	$("#modelo_dispositivo").load(url_base + "modelo_controller/dame_modelos_dispositivo", $('form.FormModelo').serialize());

    });
</script>
<!--Jquery para combos-->
<script>
$(document).ready(function(){
	// Parametros para la marca
	$("#tipo_dispositivo3").change(function () {
		$("#tipo_dispositivo3 option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("tipo_dispositivo3", { elegido: elegido }, function(data){
				$("#combo_marca3").html(data);
			});
		});
	})
});
</script>
<!--JQuery para usar select 2 -->
<script>
    $(document).ready(function(){
    	$("#tipo_dispositivo3").select2();
    	$("#combo_marca3").select2();
    });
</script>
{/literal}

