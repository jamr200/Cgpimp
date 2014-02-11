<?php /*%%SmartyHeaderCode:2330352a05875e1b965-96111794%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5d71f48f6916f83a61523d3dd327513dc58dc6a3' => 
    array (
      0 => 'application\\views\\templates\\ubicacion\\habitacion\\modal_alta_habitacion.tpl',
      1 => 1381574430,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2330352a05875e1b965-96111794',
  'variables' => 
  array (
    'error' => 0,
    'success' => 0,
    'edificio' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52a05875edc915_22374750',
  'cache_lifetime' => 120,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52a05875edc915_22374750')) {function content_52a05875edc915_22374750($_smarty_tpl) {?><div class="modal-dialog">
  <div class="modal-content">
    <!-- ************************-->
    <div class="modal-header">
      <h3 class="modal-title">Ingresa habitacion</h3>
    </div>
    <!-- ************************-->
    <div class="modal-body">
      
                    <p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Habitacion almacenada correctamente.</p>
            <form class="FormHabitacion">
        <fieldset>
          <!-- ************************-->
          <div class="form-group">
      			<label for="edificio2">Edificio</label>
      			<select class="form-control" name="edificio2" id="edificio2">
      				<option value=""></option>
      				      					<option value="1">Ayuntamiento</option>
      				      			</select>
      		</div>
          <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="" placeholder="Nombre">
          </div>
          <!-- ************************-->
          <!--campo oculto con la url de la página-->
          <input type="hidden" value="http://localhost/pfcdata/" id="hiddenBaseUrl"/>
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


<script>
	$(function() {
    var url_base = $('#hiddenBaseUrl').val();//campo oculto del formulario con la baseurl()
	    $("button#submit2").click(function(){
	        $.ajax({
	        type: "POST",
	        url: url_base + "ubicacion_controller/addHabitacionModal",
	        data: $('form.FormHabitacion').serialize(),
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
    $("#cerrar2").click(function(){
      var url_base = $('#hiddenBaseUrl').val();//campo oculto del formulario con la baseurl()
    	$("#edificio").load(url_base + "ubicacion_controller/recarga_edificio", $('form.FormEdificio').serialize());
    	$("#habitacion").load(url_base + "ubicacion_controller/recarga_habitacion", $('form.FormHabitacion').serialize());

    });
</script>
<!--JQuery para usar select 2 -->
<script>
    $(document).ready(function(){
    	$("#edificio2").select2();
    });
</script>
<?php }} ?>