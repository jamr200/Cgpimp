<?php

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

class Proveedor extends DataMapper {

	var $table = 'proveedores';
	var $has_many = array('compra');

    function __construct($id = NULL)
	{
		parent::__construct($id);
    }

    //Funcion para almacenar un proveedor en la base de datos
    function set_proveedor($proveedor)
    {//comprobamos que el proveedor no se encuentra almacenado
    	$consulta = $this->db->get_where('proveedores',array('nombre_proveedor' => $proveedor->nombre_proveedor));
    	if($consulta->num_rows() === 0)
    	{//Como NO esta almacenado, lo guardamos
    		$proveedor->save();
    		if($this->db->affected_rows() === 1)
    		{//lo hemos almacenado y devolvemos true
    			return TRUE;
    		}
    		else
    		{//No se ha almacenado porque hay error
    			return 0;
    		}
    	}//Ya se encuentra en la BD y por tanto devolvemos FALSE
    	return FALSE;
    }

    //Funcion para eliminar los proveedores seleccionados
    function unset_proveedor($proveedor)
    {//eliminamos los proveedores
        $ok = 0;
        //compruebo que el proveedor no tengan personas asociadas
        $pedido = new Pedido();
        $pedido->get_by_proveedor($proveedor);
        if(!$pedido->exists())
        {
            //No existen personas asociadas al proveedor y borramos
            $this->db->delete('proveedores', array('id' => $proveedor));
            $ok = 1;
        }

        return $ok;
    }

    //Funcion para actualizar proveedor de la BD
    function update_proveedor($array,$id)
    {
        $this->db->where('id',$id);
        $this->db->update('proveedores', $array);
        if($this->db->affected_rows() == 0)
        {
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    function getNumProveedores()
    {
        return $this->db->count_all('proveedores');
    }

    //Funcion para listar todos los proveedores
    function lista_proveedores($limit, $start)
    {
        $this->db->select('pro.id, pro.nombre_proveedor, pro.email, pro.direccion, pro.telefono_fijo, pro.telefono_movil, pro.contacto,pro.telefono_contacto');
        $this->db->from('proveedores as pro');
        $this->db->order_by("pro.id","ASC");
        $this->db->limit($limit,$start);

        //Obtengo los datos de la BD
        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {

            return $dd='no hay datos';
        }
    }

    function listar_proveedores2()
    {
        $this->db->select('pro.id, pro.nombre_proveedor, pro.email, pro.direccion, pro.telefono_fijo, pro.telefono_movil, pro.fax, pro.contacto,pro.telefono_contacto');
        $this->db->from('proveedores as pro');

        //Obtengo los datos de la BD
        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            return $query->result();
        }
        else
        {
            return $dd='no hay datos';
        }
    }

    //Funcion para obtener los datos de un proveedor a partir de su id
    function obtener_proveedor($id)
    {
        $proveedor = new Proveedor();
        $proveedor->get_by_id($id);
        return $proveedor;
    }

    //Funcion para obtener todos los proveedores de la BD
    function obtener_todos_proveedores()
    {
        $proveedores = new Proveedor();
        $proveedores->get();
        $p = $proveedores->all_to_array();
        return $p;
    }

    //Funcion para obtener los proveedores de la base de datos
    function obtener_nombre_proveedor()
    {
        $proveedor = new Proveedor();
        $proveedor->get();
        $data = array('id','nombre_proveedor');
        $pr = $proveedor->all_to_array($data);
        return $pr;
    }

	//Funcion para obtener el id de un proveedor dado
    function obtener_id_proveedor($nombre)
    {
        $proveedor = new Proveedor();
        $proveedor->get_by_nombre_proveedor($nombre);
        return $proveedor->id;
    }

//Funcion para obtener el nombre de un proveedor dado a partir del id
    //obtener_nombre_proveedor_por_id($int)
    function obtener_nombre_proveedor_por_id($id)
    {
        $proveedor = new Proveedor();
        $proveedor->get_by_id($id);
        return $proveedor->nombre_proveedor;
    }

//Funcion para obtener en un array el nombre de proveedores de la base de datos menos el indicado por su id (usada para los mostrar en los selects)
//obtener_nombre_proveedor_menos_uno($int)
    function obtener_nombre_proveedores_menos_uno($id)
    {
        $proveedor = new Proveedor();
        $proveedor->not_like('id',$id);
        $proveedor->get();
        $data = array('id','nombre_proveedor');
        $p = $proveedor->all_to_array($data);
        return $p;
    }

    //funcion que muestra el formulario del proveedor a modificar
    function muestra_combo_proveedor($id)
    {
        $rpta = "";
        //hago una consulta a la base de datos para obtener los datos del proveedor a partir de su id
        $proveedor = $this->db->get_where('proveedores',array('id'=>$id));

        foreach ($proveedor->result() as $fila) {
            $rpta .= '
            <form id="update2proveedor" action="{base_url()}proveedor_controller/updateProveedor" method="POST">
                <fieldset>
                <legend>Información Proveedor</legend>
                    <!-- ************************-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nombre">Nombre: </label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="'. $fila->nombre_proveedor . '" placeholder="Nombre"><br>
                        </div>
                    </div>
                    <!-- ************************-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="email">Email: </label>
                            <input type="text" class="form-control" id="email" name="email" value="' . $fila->email . '" placeholder="Email"><br>
                        </div>
                    </div>
                    <!-- ************************-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="telefono_fijo">Teléfono fijo: </label>
                            <input type="text" class="form-control" id="telefono_fijo" name="telefono_fijo" value="'.$fila->telefono_fijo.'" placeholder="Telefono fijo"><br>
                        </div>
                    </div>
                    <!-- ************************-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="telefono_movil">Teléfono móvil: </label>
                            <input type="text" class="form-control" id="telefono_movil" name="telefono_movil" value="'.$fila->telefono_movil.'" placeholder="Telefono movil"><br>
                        </div>
                    </div>
                    <!-- ************************-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="fax">Fax: </label>
                            <input type="text" class="form-control" id="fax" name="fax" value="'.$fila->fax.'" placeholder="Fax"><br>
                        </div>
                    </div>
                    <!-- ************************-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="direccion">Dirección: </label>
                            <input type="text" class="form-control" id="direccion" name="direccion" value="'.$fila->direccion.'" placeholder="Direccion"><br>
                        </div>
                    </div>
                    <!-- ************************-->
                </fieldset>
                <fieldset>
                    <legend>Información de contacto</legend>
                    <!-- ************************-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nombre_contacto">Nombre de contacto: </label>
                            <input type="text" class="form-control" id="nombre_contacto" name="nombre_contacto" value="'.$fila->contacto.'" placeholder="Nombre contacto"><br>
                        </div>
                    </div>
                    <!-- ************************-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="telefono_contacto">Teléfono de contacto: </label>
                            <input type="text" class="form-control" id="telefono_contacto" name="telefono_contacto" value="'.$fila->telefono_contacto.'" placeholder="Telefono contacto"><br>
                        </div>
                    </div>
                </fieldset>
                <!-- ************************-->
                <div class="col-md-12">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="modificar_proveedor" class="btn btn-default">Cancelar</a>
                    </div>
                </div>
                <!-- ************************-->
            </form>
            <!-- Validacion desde lado del cliente -->
            <script>
                $(document).ready(function(){
                    $("#update2proveedor").validate({
                        errorElement: "span",
                        errorClass: "help-block",
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
                            $(element).closest(".form-group")
                            .removeClass("has-success").addClass("has-error");
                        },
                        success: function(element)
                        {
                            $(element).closest(".form-group")
                            .removeClass("has-error").addClass("has-success");
                        }
                    });
                });
            </script>';
        }
        echo $rpta;
    }
}

/* End of file proveedor.php */
/* Location: ./application/models/proveedor.php */