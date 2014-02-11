<?php /*%%SmartyHeaderCode:1416252a05fd89a43b5-43421661%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a5741a156020c96ca4eaf13f3a435ff4a8bbf2f0' => 
    array (
      0 => 'application\\views\\templates\\ubicacion\\balda\\modal_alta_balda.tpl',
      1 => 1381574397,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1416252a05fd89a43b5-43421661',
  'variables' => 
  array (
    'error' => 0,
    'success' => 0,
    'edificio' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52a05fd8a6b280_25467457',
  'cache_lifetime' => 120,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52a05fd8a6b280_25467457')) {function content_52a05fd8a6b280_25467457($_smarty_tpl) {?><div class="modal-dialog">
  <div class="modal-content">
    <!-- ************************-->
    <div class="modal-header">
      <h3 class="modal-title">Ingresar balda</h3>
    </div>
    <!-- ************************-->
    <div class="modal-body">
    
				<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Balda almacenada correctamente.</p>
	      <form class="FormBalda">
        <fieldset>
        <!-- ************************-->
        <div class="form-group">
			<label for="edificio4">Edificio</label>
			<select class="form-control" name="edificio4" id="edificio4">
				<option value=""></option>
									<option value="1">Ayuntamiento</option>
									<option value="2">Palacio Beniel</option>
							</select>
		</div>
		<!-- ************************-->
		<div class="form-group">
			<label for="habitacion4">Habitacion</label>
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
		<input type="hidden" value="http://localhost/pfcdata/" id="hiddenBaseUrl"/>
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
<!--JQuery para usar select 2 -->
<script>
    $(document).ready(function(){
    	$("#edificio4").select2();
    	$("#habitacion4").select2();
    	$("#mueble4").select2();
    });
</script>
<?php }} ?>