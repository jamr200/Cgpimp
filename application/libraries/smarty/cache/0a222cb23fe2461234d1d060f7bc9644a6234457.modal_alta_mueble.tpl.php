<?php /*%%SmartyHeaderCode:309452a0600732b3f4-02783028%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0a222cb23fe2461234d1d060f7bc9644a6234457' => 
    array (
      0 => 'application\\views\\templates\\ubicacion\\mueble\\modal_alta_mueble.tpl',
      1 => 1386175394,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '309452a0600732b3f4-02783028',
  'variables' => 
  array (
    'error' => 0,
    'success' => 0,
    'edificio' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52a060073aee25_00586403',
  'cache_lifetime' => 120,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52a060073aee25_00586403')) {function content_52a060073aee25_00586403($_smarty_tpl) {?><div class="modal-dialog">
  <div class="modal-content">
    <!-- ************************-->
    <div class="modal-header">
      <h3 class="modal-title">Ingresar mueble</h3>
    </div>
    <!-- ************************-->
    <div class="modal-body">
      
	  	  	  	<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Mueble almacenado correctamente.</p>
	        <form class="FormMueble">
        <fieldset>
        <!-- ************************-->
        <div class="form-group">
			<label for="edificio3">Edificio</label>
			<select class="form-control" name="edificio3" id="edificio3">
				<option value=""></option>
									<option value="1">Ayuntamiento</option>
									<option value="2">Palacio Beniel</option>
							</select>
		</div>
		<!-- ************************-->
		<div class="form-group">
			<label for="habitacion3">Habitacion</label>
			<select class="form-control" name="habitacion3" id="habitacion3">
			</select>
		</div>
		<!-- ************************-->
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
      <button type="button" class="btn btn-default" id="cerrar3" data-dismiss="modal">Cerrar</button>
      <button type="button" class="btn btn-primary" id="submit3">Guardar</button>
    </div>
    <!-- ************************-->
  </div>
</div>


<script>
	$(function() {
		var url_base = $('#hiddenBaseUrl').val();//campo oculto del formulario con la baseurl()
	    $("button#submit3").click(function(){
	        $.ajax({
	        type: "POST",
	        url: url_base + "ubicacion_controller/addMuebleModal",
	        data: $('form.FormMueble').serialize(),
	        success: function(msg){
	        	$("#thanks3").html(msg)
	            $("#modal3").modal('hide');
	            },
	        error: function(){
	            alert("failure");
	            }
	        });
	    });
	});
</script>
<script>
    $("#cerrar3").click(function(){
    	var url_base = $('#hiddenBaseUrl').val();//campo oculto del formulario con la baseurl()
    	$("#edificio").load(url_base + "ubicacion_controller/recarga_edificio", $('form.FormEdificio').serialize());
    	$("#habitacion").load(url_base + "ubicacion_controller/recarga_habitacion", $('form.FormHabitacion').serialize());
    	$("#mueble").load(url_base + "ubicacion_controller/recarga_mueble", $('form.FormMueble').serialize());

    });
</script>
<!--Jquery para combos-->
<script>
	$(document).ready(function(){
		// Parametros para el edificio3
		$("#edificio3").change(function () {
			$("#edificio3 option:selected").each(function () {
				//alert($(this).val());
					elegido=$(this).val();
					$.post("edificio3", { elegido: elegido }, function(data){
					$("#habitacion3").html(data);
				});
			});
		})
	});
</script>
<!--JQuery para usar select 2 -->
<script>
    $(document).ready(function(){
    	$("#edificio3").select2();
    	$("#habitacion3").select2();
    });
</script>
<?php }} ?>