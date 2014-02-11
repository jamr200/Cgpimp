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
      <h3 class="modal-title">Ingresa nueva marca</h3>
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
      <form class="FormMarca" id="FormMarca">
        <fieldset>
        <div class="form-group">
			<label class="control-label" for="tipo_material2">Tipo de Material</label>
			<select class="form-control" name="tipo_material2" id="tipo_material2">
				<option value=""></option>
				{section name=fila loop=$tipo}
					<option value="{$tipo[fila]['id']}">{$tipo[fila]['nombre_tipo_material']}</option>
				{/section}
			</select>
		</div>
		<!-- ************************-->
        <div class="form-group">
          <label class="control-label" for="nombre">Nombre</label>
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
      <button type="button" class="btn btn-default" id="cerrar2" data-dismiss="modal">Cerrar</button>
      <button type="button" class="btn btn-primary" id="submit2">Guardar</button>
    </div>
    <!-- ************************-->
  </div>
</div>

{literal}
<script>
  $(document).ready(function(){
    //Validacion para modal
    $('#FormMarca').validate({
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

<script>
 $(function() {
  var url_base = $('#hiddenBaseUrl').val();//campo oculto del formulario con la baseurl()
    $("button#submit2").click(function(){
        $.ajax({
        type: "POST",
        url: url_base + "marca_controller/addMarcaModalMaterial",
        data: $('form.FormMarca').serialize(),
        success: function(msg){
        	$("#thanks2").html(msg)
            $("#modal2").modal('hide');
            },
        error: function(){
            alert("failure");
            }
        });
    });
});
</script>
<script>
  var url_base = $('#hiddenBaseUrl').val();//campo oculto del formulario con la baseurl()
    $("#cerrar2").click(function(){
    	$("#tipo_material").load(url_base + "material_controller/dame_tipos", $('form.FormTipo').serialize());
    	$("#marca_material").load(url_base + "marca_controller/dame_marcas_material", $('form.FormMarca').serialize());

    });
</script>
<!--JQuery para usar select 2 -->
<script>
    $(document).ready(function(){
    	$("#tipo_material2").select2();
    });
</script>
{/literal}