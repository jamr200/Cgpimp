<?php /*%%SmartyHeaderCode:25907525ad86079acd8-39768140%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9fe47d2cface68bb765e7096b6d3ed95e8253e4e' => 
    array (
      0 => 'application\\views\\templates\\material\\modal_alta_tipo_material.tpl',
      1 => 1381574155,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '25907525ad86079acd8-39768140',
  'variables' => 
  array (
    'error' => 0,
    'success' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_525ad86086b7b2_85046158',
  'cache_lifetime' => 120,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_525ad86086b7b2_85046158')) {function content_525ad86086b7b2_85046158($_smarty_tpl) {?><div class="modal-dialog">
  <div class="modal-content">
    <!-- ************************-->
    <div class="modal-header">
      <h3 class="modal-title">Ingresar Tipo de Material</h3>
    </div>
    <!-- ************************-->
    <div class="modal-body">
      <p class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign"></span>El campo Nombre es obligatorio.</p>

                  <form class="FormTipo">
        <fieldset>
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
      <button type="button" class="btn btn-default" id="cerrar1" data-dismiss="modal">Cerrar</button>
      <button type="button" class="btn btn-primary" id="submit1">Guardar</button>
    </div>
    <!-- ************************-->
  </div>
</div>


<script>
 $(function() {
    var url_base = $('#hiddenBaseUrl').val();//campo oculto del formulario con la baseurl()
    $("button#submit1").click(function(){
        $.ajax({
        type: "POST",
        url: url_base + "material_controller/addTipoMaterialModal",
        data: $('form.FormTipo').serialize(),
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
      $("#tipo_material").load(url_base + "material_controller/dame_tipos", $('form.FormTipo').serialize());
    });
</script>
<?php }} ?>