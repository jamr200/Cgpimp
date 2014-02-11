{include file="includes/header.tpl"}
{include file="includes/barra_navegacion.tpl"}

<!--
/*
 * Copyright (C) 2014 jamr200
 *
 * This file is part Cgpimp.
 *
 * This program is free software: you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License
 * for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * this program. If not, see <http://www.gnu.org/licenses/>
 */
 -->

<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <form id="update2departamento" action="{base_url()}departamento_controller/updateDepartamento" method="POST">
                <fieldset class="fieldset">
                <legend>Información de Departamento</legend>
                    <!-- ************************-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="{$departamento->nombre_departamento}" placeholder="Nombre">
                        </div>
                    </div>
                    <!-- ************************-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" class="form-control" id="email" name="email" value="{$departamento->email}" placeholder="Email">
                        </div>
                    </div>
                    <!-- ************************-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="telefono">Teléfono:</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" value="{$departamento->telefono }" placeholder="Telefono">
                        </div>
                    </div>
                    <!-- ************************-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="fax">Fax</label>
                            <input type="text" class="form-control" id="fax" name="fax" value="{if $departamento->fax != 0}{$departamento->fax}{/if}" placeholder="Fax">
                        </div>
                    </div>
                    <!-- ************************-->
                    <!--campo oculto con la url de la página-->
                    <input type="hidden" value="{$departamento->id}" name="combo_departamento" id="combo_departamento"/>
                    <!-- ************************-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Modificar</button>
                            <a href="{base_url()}departamento_controller/listar_departamento" class="btn btn-default">Cancelar</a>
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
<!-- Validacion de instancias desde el cliente -->
<script type="text/javascript">
    $(document).ready(function(){
        $('#update2departamento').validate({
            errorElement: "span",
            errorClass: 'help-block',
            rules:
            {
                nombre: {required: true, rangelength: [4,50]},
                email: {required: true, email: true},
                telefono: {required: true, rangelength: [9,12]},
            },
            messages:
            {
                nombre: "Este campo es obligatorio y debe tener entre 4 y 50 caracteres.",
                email : "Este campo es obligatorio y debe tener formato de email correcto.",
                telefono : "El campo Tel&eacute;fono es obligatorio y no ha escrito un telefono correcto."
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
<!--JQuery para usar select 2 -->
<script>
    $(document).ready(function(){
        $("#proveedor").select2();
    });
</script>
{/literal}

{include file="includes/footer.tpl"}