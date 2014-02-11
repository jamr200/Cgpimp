<?php /*%%SmartyHeaderCode:1704652a0582e057a89-36513831%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bea6bde0351ae1e43ef2c56f0475e1c596d258b6' => 
    array (
      0 => 'application\\views\\templates\\marca\\modal_alta_marca_material.tpl',
      1 => 1382897240,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1704652a0582e057a89-36513831',
  'variables' => 
  array (
    'error' => 0,
    'success' => 0,
    'tipo' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52a0582e1a94d4_57717431',
  'cache_lifetime' => 120,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52a0582e1a94d4_57717431')) {function content_52a0582e1a94d4_57717431($_smarty_tpl) {?><div class="modal-dialog">
  <div class="modal-content">
    <!-- ************************-->
    <div class="modal-header">
      <h3 class="modal-title">Ingresa nueva marca</h3>
    </div>
    <!-- ************************-->
    <div class="modal-body">
      
                    <p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Marca <strong>hp</strong> almacenada correctamente.</p>
            <form class="FormMarca">
        <fieldset>
        <div class="form-group">
			<label class="control-label" for="tipo_material2">Tipo de Material</label>
			<select class="form-control" name="tipo_material2" id="tipo_material2">
				<option value=""></option>
									<option value="1">Cartuchos de tinta</option>
							</select>
		</div>
		<!-- ************************-->
        <div class="form-group">
          <label class="control-label" for="nombre">Nombre</label>
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
<?php }} ?>