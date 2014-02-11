
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
      <h3 class="modal-title">Ingresar nuevo edificio</h3>
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
      <form class="FormEdificio" id="FormEdificio">
        <fieldset>
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
      <button type="button" class="btn btn-default" id="cerrar1" data-dismiss="modal">Cerrar</button>
      <button type="button" class="btn btn-primary" id="submit1">Guardar</button>
    </div>
    <!-- ************************-->
  </div>
</div>

{literal}
<script>
	$(function() {
    var url_base = $('#hiddenBaseUrl').val();//campo oculto del formulario con la baseurl()
	    $("button#submit1").click(function(){
	        $.ajax({
		        type: "POST",
		        url: url_base + "ubicacion_controller/addEdificioModal",
		        data: $('form.FormEdificio').serialize(),
		        success: function(msg){
		        	$("#thanks1").html(msg)
		            $("#modal1").modal('hide');
		        },
		        error: function(){
		            alert("failure");
		        }
	        });
	    });
	});
</script>
<script>
    $("#cerrar1").click(function(){
      var url_base = $('#hiddenBaseUrl').val();//campo oculto del formulario con la baseurl()
      $("#edificio").load(url_base + "ubicacion_controller/recarga_edificio", $('form.FormEdificio').serialize());
    });
</script>
<script>
  $(document).ready(function(){
    //Validacion para modal
    $('#FormEdificio').validate({
      errorElement: "span",
      errorClass: 'help-block',
      rules:
      {
        nombre: {required: true, rangelength: [4,50]}
      },
      messages:
      {
        nombre: "Este campo es obligatorio y debe tener entre 4 y 50 caracteres."
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
{/literal}