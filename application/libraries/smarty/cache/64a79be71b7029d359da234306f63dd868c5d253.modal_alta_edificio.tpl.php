<?php /*%%SmartyHeaderCode:192852a0586aaff385-96819128%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '64a79be71b7029d359da234306f63dd868c5d253' => 
    array (
      0 => 'application\\views\\templates\\ubicacion\\edificio\\modal_alta_edificio.tpl',
      1 => 1381574414,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '192852a0586aaff385-96819128',
  'variables' => 
  array (
    'error' => 0,
    'success' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_52a0586abcff02_70581426',
  'cache_lifetime' => 120,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_52a0586abcff02_70581426')) {function content_52a0586abcff02_70581426($_smarty_tpl) {?><div class="modal-dialog">
  <div class="modal-content">
    <!-- ************************-->
    <div class="modal-header">
      <h3 class="modal-title">Ingresar nuevo edificio</h3>
    </div>
    <!-- ************************-->
    <div class="modal-body">
      
                    <p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Edificio almacenado correctamente.</p>
            <form class="FormEdificio">
        <fieldset>
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
<?php }} ?>