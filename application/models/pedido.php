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

class Pedido extends DataMapper {

	var $table = 'pedidos';
	var $has_many = array('instancia_dispositivo','instancia_material');
	var $has_one = array('proveedor');


    function __construct($id = NULL)
	{
		parent::__construct($id);

    }

    //Funcion para almacenar una compra en la base de datos
    public function set_pedido($pedido)
    {
    	//comprobamos que esa compra no se encuentra almacenada
    	$consulta = $this->db->get_where('pedidos', array('nombre_pedido' => $pedido->nombre_pedido));
    	if($consulta->num_rows() === 0)
    	{//Como NO esta almacenada, la guardamos
    		$pedido->save();
    		if($this->db->affected_rows() === 1)
    		{//la hemos almacenado y devolvemos true
    			return TRUE;
    		}
    		else
    		{//no se ha almacenado porque hay error
    			return 0;
    		}
    	}
    	//Esa compra ya se encuentra en la BD y por tanto devolvemos FALSE
    	return FALSE;
    }

    //Funcion para eliminar el pedido indicado
    //unset_pedido($int)
    function unset_pedido($codigo)
    {//obtengo todos los registros de la tabla instancias materiales
        $inst_materiales = new Instancia_material();
        $inst_materiales->get_by_pedido($codigo);

        //obtengo todos los registros de la tabla instancias dispositivo
        $inst_dispositivos = new Instancia_dispositivo();
        $inst_dispositivos->get_by_pedido($codigo);

        //hago comparaciones para ver si existen instancias relacionadas a ese pedido
        if((!$inst_materiales->exists())&&(!$inst_dispositivos->exists()))
        {//no existen instancias de ninguna tabla y borro el pedido
            $this->db->delete('pedidos',array('id' => $codigo));
            return 0;
        }
        else
        {//Existe algun tipo de relacion y por tanto no podemos borrar el pedido
            if((!$inst_materiales->exists())&&($inst_dispositivos->exists()))
            {//relacion con instancias de dispositivos
                return 1;
            }
            else
            {
                if(($inst_materiales->exists())&&(!$inst_dispositivos->exists()))
                {//relacion con instancias de materiales
                    return 2;
                }
                else
                {//relacion con instancias de dispositivos y materiales
                    return 3;
                }
            }
        }
    }

    //Funcion para actualizar pedido de la BD
    function update_pedido($array,$id)
    {
        $this->db->where('id',$id);
        $this->db->update('pedidos', $array);
        if($this->db->affected_rows() == 0)
        {
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    function getNumPedidos()
    {
        return $this->db->count_all('pedidos');
    }

    //Funcion para listar todos los pedidos
    function lista_pedidos($limit, $start)
    {
        $this->db->select('ped.id, ped.nombre_pedido, ped.observaciones, proveedores.nombre_proveedor');
        $this->db->from('pedidos as ped');
        $this->db->join('proveedores','proveedores.id = ped.proveedor');
        $this->db->order_by("ped.id","ASC");
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

    function lista_pedidos2()
    {
        $this->db->select('ped.id, ped.nombre_pedido, ped.observaciones, proveedores.nombre_proveedor');
        $this->db->from('pedidos as ped');
        $this->db->join('proveedores','proveedores.id = ped.proveedor');
        $this->db->order_by("ped.id","ASC");
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

    function esta_pedido($nombre)
    {
        $consulta = $this->db->get_where('pedidos',array('nombre_pedido' => $nombre_pedido));
        if($consulta->num_rows() === 0)
        {//el numero de serie no se encuentra en la BD
            return FALSE;
        }
        else
        {
            if($this->db->affected_rows() > 0)
            {//el numero de serie se encuentra en la BD
                return TRUE;
            }
            else
            {//Error en la BD (num_serie incorrecto)
                return 0;
            }
        }
    }

    //Funcion para obtener los datos de un pedido a partir de su id
    function obtener_pedido($id)
    {
        $pedido = new Pedido();
        $pedido->get_by_id($id);
        return $pedido;
    }

    //Funcion para obtener el nombre de los pedidos de la base de datos
    function obtener_nombre_pedido()
    {
        $pedido = new Pedido();
        $pedido->get();
        $data = array('id','nombre_pedido');
        $ped = $pedido->all_to_array($data);
        return $ped;
    }

    //Funcion para obtener el nombre de un pedido dado a partir del id
    //obtener_nombre_pedido_por_id($int)
    function obtener_nombre_pedido_por_id($id)
    {
        $pedido = new Pedido();
        $pedido->get_by_id($id);
        return $pedido->nombre_pedido;
    }

    //Funcion para obtener el id de un pedido dado a partir del nombre
    //obtener_id_pedido($string)
    function obtener_id_pedido($nombre)
    {
        $pedido = new Pedido();
        $pedido->get_by_nombre_pedido($nombre);
        return $pedido->id;
    }

    //Funcion para obtener en un array el nombre de pedidos de la base de datos menos el indicado por su id (usada para los mostrar en los selects)
//obtener_nombre_pedido_menos_uno($int)
    function obtener_nombre_pedidos_menos_uno($id)
    {
        $pedido = new Pedido();
        $pedido->not_like('id',$id);
        $pedido->get();
        $data = array('id','nombre_pedido');
        $p = $pedido->all_to_array($data);
        return $p;
    }

    //Funcion para obtener todos los pedidos de la base de datos
    function obtener_todos_pedidos($pedido)
    {
        $pedido->get();
        $data = array();
        $ped = $pedido->all_to_array($data);
        return $ped;
    }

    /*//Funcion para obtener todos los pedidos de la base de datos
    function obtener_todos_pedidos2()
    {
        //Obtengo los datos de la tabla pedido
        $pedido = new Pedido();
        $pedido->get();
        $data = array('nombre_pedido','observaciones');
        $ped = $pedido->all_to_array($data);
        return $ped;
    }*/

    //funcion que muestra el formulario de registro del pedido a modificar
    function muestra_combo_pedido($id)
    {
        $rpta = "";
        //hago una consulta a la base de datos para obtener los datos del pedido a partir de su id
        $pedido = $this->db->get_where('pedidos',array('id'=>$id));

        foreach ($pedido->result() as $fila) {
            //Convertimos el id del proveedor a su nombre para mostarlo
            $nombre_pro = $this->Proveedor->obtener_nombre_proveedor_por_id($fila->proveedor);

            //En $proveedor meto todos los proveedores menos el obtenido de la BD
            $proveedor = $this->Proveedor->obtener_nombre_proveedores_menos_uno($fila->proveedor);

            $rpta .= '
            <form id="update2pedido" action="'.base_url().'pedido_controller/updatePedido" method="POST">
                <fieldset>
                <legend>Información de Pedido</legend>
                    <!-- ************************-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nombre">Nombre: </label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="'. $fila->nombre_pedido . '" placeholder="Nombre">
                        </div>
                    </div>
                    <!-- ************************-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="observaciones">Observaciones: </label>
                            <textarea class="form-control" name="observaciones" id="observaciones" rows="3">'.$fila->observaciones.'</textarea>
                        </div>
                    </div>
                    <!-- ************************-->
                    <!--campo oculto con la id de pedido-->
                    <input type="hidden" value="'.$id.'" id="combo_pedido" name="combo_pedido" />
                    <!-- ************************-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="proveedor">Selecciona Proveedor: </label>
                             <select class="form-control" id="proveedor" name="proveedor">
                                    <option value="'.$fila->proveedor.'">'.$nombre_pro.'</option>';
                                    foreach ($proveedor as $pro)
                                    {
                                        $rpta .= '<option value="'.$pro['id'].'">'.$pro['nombre_proveedor'].'</option>';
                                    }
                                     $rpta .='
                            </select>
                        </div>
                    </div>
                    <!-- ************************-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a href="modificar_pedido" class="btn btn-default">Cancelar</a>
                        </div>
                    </div>
                     <!-- ************************-->
                </fieldset>
            </form>
            <!--JQuery para usar select 2 -->
            <script>
                $(document).ready(function(){
                    $("#proveedor").select2();
                });
            </script>
            <!-- Validacion desde lado del cliente -->
            <script>
                $(document).ready(function(){
                    $("#update2pedido").validate({
                        errorElement: "span",
                        errorClass: "help-block",
                        rules:
                        {
                            nombre: {required: true, rangelength:[3,30]},
                            observaciones: {maxlength: 500},
                            proveedor: {required: true}
                        },
                        messages:
                        {
                            nombre: "El campo es obligatorio y debe tener entre 3 y 30 caracteres.",
                            observaciones: "El campo es obligatorio y debe tener entre 4 y 50 caracteres.",
                            proveedor : "El campo es obligatorio"
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

/* End of file pedido.php */
/* Location: ./application/models/pedido.php */