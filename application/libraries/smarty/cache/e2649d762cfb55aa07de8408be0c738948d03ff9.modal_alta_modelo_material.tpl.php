<?php /*%%SmartyHeaderCode:2661752a0583ea22f22-33929947%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e2649d762cfb55aa07de8408be0c738948d03ff9' => 
    array (
      0 => 'application\\views\\templates\\modelo\\modal_alta_modelo_material.tpl',
      1 => 1382897220,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2661752a0583ea22f22-33929947',
  'variables' => 
  array (
    'error' => 0,
    'success' => 0,
    'tipo' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52a0583eaedff8_75863317',
  'cache_lifetime' => 120,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52a0583eaedff8_75863317')) {function content_52a0583eaedff8_75863317($_smarty_tpl) {?><div class="modal-dialog">
  <div class="modal-content">
    <!-- ************************-->
    <div class="modal-header">
      <h3 class="modal-title">Ingresa nuevo modelo</h3>
    </div>
    <!-- ************************-->
    <div class="modal-body">
      
                    <p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Modelo <strong>35</strong> almacenado correctamente.</p>
            <form class="FormModelo">
        <fieldset>
          <div class="form-group">
      			<label for="tipo_material3">Tipo de Material</label>
      			<select class="form-control" name="tipo_material3" id="tipo_material3">
      				<option value=""></option>
      				      					<option value="1">Cartuchos de tinta</option>
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
        url: url_base + "modelo_controller/addModeloModalMaterial",
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
    	$("#tipo_material").load(url_base + "material_controller/dame_tipos", $('form.FormTipo').serialize());
    	$("#marca_material").load(url_base + "marca_controller/dame_marcas_material", $('form.FormMarca').serialize());
    	$("#modelo_material").load(url_base + "modelo_controller/dame_modelos_material", $('form.FormModelo').serialize());

    });
</script>
<!--Jquery para combos-->
<script>
$(document).ready(function(){
	// Parametros para la marca
	$("#tipo_material3").change(function () {
		$("#tipo_material3 option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("tipo_material3", { elegido: elegido }, function(data){
				$("#combo_marca3").html(data);
			});
		});
	})
});
</script>
<!--JQuery para usar select 2 -->
<script>
    $(document).ready(function(){
    	$("#tipo_material3").select2();
    	$("#combo_marca3").select2();
    });
</script>


<?php }} ?>