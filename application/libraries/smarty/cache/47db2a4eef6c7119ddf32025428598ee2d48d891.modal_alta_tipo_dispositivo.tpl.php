<?php /*%%SmartyHeaderCode:716252e7cca03bf6c0-59174028%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '47db2a4eef6c7119ddf32025428598ee2d48d891' => 
    array (
      0 => 'application\\views\\templates\\dispositivo\\modal_alta_tipo_dispositivo.tpl',
      1 => 1390922443,
      2 => 'file',
    ),
    '13dd2963ff5ec3d260fc0e69ad79998940ada34f' => 
    array (
      0 => 'application\\views\\templates\\includes\\footer.tpl',
      1 => 1381828055,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '716252e7cca03bf6c0-59174028',
  'variables' => 
  array (
    'error' => 0,
    'success' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52e7cca04348b4_11954091',
  'cache_lifetime' => 120,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52e7cca04348b4_11954091')) {function content_52e7cca04348b4_11954091($_smarty_tpl) {?><div class="modal-dialog">
  <div class="modal-content">
    <!-- ************************-->
    <div class="modal-header">
      <h3 class="modal-title">Nuevo tipo de dispositivo</h3>
    </div>
    <!-- ************************-->
    <div class="modal-body">
      
                    <p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Tipo de dispositivo con nombre <strong>a</strong> almacenado correctamente.</p>
            <form class="FormTipo" id="FormTipo">
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
  $(document).ready(function(){
    //Validacion para modal
    $('#FormTipo').validate({
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

<script>
 $(function() {
//twitter bootstrap script
    var url_base = $('#hiddenBaseUrl').val();//campo oculto del formulario con la baseurl()
    $("button#submit1").click(function(){
        $.ajax({
        type: "POST",
        url: url_base + "dispositivo_controller/addTipoDispositivoModal",
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
        $("#tipo_dispositivo").load(url_base + "dispositivo_controller/dame_tipos", $('form.FormTipo').serialize());
    });
</script>


</body>
</html> <?php }} ?>