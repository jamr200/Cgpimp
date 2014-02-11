<?php /*%%SmartyHeaderCode:2777552b2dfe2d5f040-58744435%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'af555a872c9d23fb0cac0f86854d36bb26d9b8ff' => 
    array (
      0 => 'application\\views\\templates\\modelo\\modal_alta_modelo_dispositivo.tpl',
      1 => 1382897212,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2777552b2dfe2d5f040-58744435',
  'variables' => 
  array (
    'error' => 0,
    'success' => 0,
    'tipo' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52b2dfe2e43969_93162682',
  'cache_lifetime' => 120,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52b2dfe2e43969_93162682')) {function content_52b2dfe2e43969_93162682($_smarty_tpl) {?><div class="modal-dialog">
  <div class="modal-content">
    <!-- ************************-->
    <div class="modal-header">
      <h3 class="modal-title">Ingresa nuevo modelo</h3>
    </div>
    <!-- ************************-->
    <div class="modal-body">
      
                    <p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Modelo <strong>sx235w</strong> almacenado correctamente.</p>
            <form class="FormModelo">
        <fieldset>
        <div class="form-group">
    			<label for="tipo_dispositivo3">Tipo de Dispositivo</label>
    			<select class="form-control" name="tipo_dispositivo3" id="tipo_dispositivo3">
    				<option value=""></option>
    				    					<option value="1">Impresoras</option>
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


<?php }} ?>