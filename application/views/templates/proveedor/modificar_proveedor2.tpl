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
            <form id="update2proveedor" action="{base_url()}proveedor_controller/updateProveedor" method="POST">
                <fieldset class="fieldset">
                    <legend>Información del proveedor</legend>
                    <!-- ************************-->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="{$proveedor->nombre_proveedor}" placeholder="Nombre">
                        </div>
                    </div>
                    <!-- ************************-->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="telefono_fijo">Teléfono fijo</label>
                            <input type="text" class="form-control" id="telefono_fijo" name="telefono_fijo" value="{$proveedor->telefono_fijo}" placeholder="Telefono fijo">
                        </div>
                    </div>
                    <!-- ************************-->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="telefono_movil">Teléfono móvil</label>
                            <input type="text" class="form-control" id="telefono_movil" name="telefono_movil" value="{$proveedor->telefono_movil}" placeholder="Telefono movil">
                        </div>
                    </div>
                    <!-- ************************-->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email" value="{$proveedor->email}" placeholder="Email">
                        </div>
                     </div>
                    <!-- ************************-->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="direccion">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" value="{$proveedor->direccion}" placeholder="Direccion">
                        </div>
                    </div>
                    <!-- ************************-->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="fax">Fax</label>
                            <input type="text" class="form-control" id="fax" name="fax" value="{$proveedor->fax}" placeholder="Fax">
                        </div>
                    </div>
                    <!-- ************************-->
                    <legend>Información de contacto</legend>
                    <!-- ************************-->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="contacto">Nombre contacto</label>
                            <input type="text" class="form-control" id="contacto" name="contacto" value="{$proveedor->contacto}" placeholder="Nombre contacto">
                        </div>
                    </div>
                    <!-- ************************-->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="telefono_contacto">Teléfono contacto</label>
                            <input type="text" class="form-control" id="telefono_contacto" name="telefono_contacto" value="{if $proveedor->telefono_contacto != 0}{$proveedor->telefono_contacto}{/if}" placeholder="Telefono Contacto">
                        </div>
                    </div>
                    <!-- ************************-->
                    <!--campo oculto con la url de la página-->
                    <input type="hidden" value="{$proveedor->id}" name="combo_proveedor" id="combo_proveedor"/>
                    <!-- ************************-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a href="{base_url()}proveedor_controller/listar_proveedor" class="btn btn-default">Cancelar</a>
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
<!-- Validacion desde lado del cliente -->
<script>
    $(document).ready(function(){
        $('#update2proveedor').validate({
            errorElement: "span",
            errorClass: 'help-block',
            rules:
            {
                nombre: {required: true, rangelength: [4,50]},
                email: {required: true, email: true},
                telefono_fijo: {required: true, rangelength: [9,12]},
                fax: {rangelength: [9,12]},
                direccion: {required: true, maxlength: 80},
                nombre_contacto:{maxlength: 80},
                telefono_contacto:{exactlength: 9}
            },
            messages:
            {
                nombre: "Este campo es obligatorio y debe tener entre 3 y 20 caracteres.",
                email : "Este campo es obligatorio y debe tener formato de correo electrónico correcto.",
                telefono_fijo : "El campo Teléfono es obligatorio o no ha escrito un teléfono correcto.",
                fax : "Este campo debe tener entre 9 y 12 caracteres.",
                direccion : "Este campo es obligatorio y no debe exceder los 80 caracteres.",
                nombre_contacto : "Este campo no debe exceder los 80 caracteres.",
                telefono_contacto : "Este campo debe de tener un teléfono correcto."
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
{/literal}

{include file="includes/footer.tpl"}