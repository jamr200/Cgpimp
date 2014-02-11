{include file="includes/header.tpl"}
{include file="includes/barra_navegacion.tpl"}

<div class="container">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			{if isset($error)}
				<p class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign"></span> {$error}</p>
			{/if}
			{if isset($success)}
				<p class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> {$success}</p>
			{/if}
			<form id="deleteproveedor" action="{base_url()}proveedor_controller/deleteProveedor" method="POST">
				<fieldset class="fieldset">
					<legend>Eliminar proveedor</legend>
					<!-- ************************-->
					<div class="col-md-12">
						<div class="form-group">
							<label for="combo_proveedor">Selecciona proveedor:</label>
							<select class="form-control" id="combo_proveedor" name="combo_proveedor">
								<option value=""></option>
								{section name=p loop=$proveedor}
									<option value="{$proveedor[p]['id']}">{$proveedor[p]['nombre_proveedor']}</option>
								{/section}
							</select>
						</div>
					</div>
					<!-- ************************-->
					<div class="col-md-12">
						<div class="form-group">
							<button type="submit" class="btn btn-primary">Eliminar</button>
							<a href="{base_url()}main" class="btn btn-default">Cancelar</a>
						</div>
					</div>
					<!-- ************************-->
				</fieldset>
			</form>
		</div>
		<div class="col-md-2"></div>
	</div>
</div>

{literal}
<!--JQuery para usar select 2 -->
<script>
    $(document).ready(function(){
    	$("#combo_proveedor").select2();
    });
</script>
{/literal}

{include file="includes/footer.tpl"}