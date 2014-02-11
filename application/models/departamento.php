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

class Departamento extends DataMapper {

	var $table = 'departamentos';
	var $has_many = array('persona','instancia_dispositivo');


    function __construct($id = NULL)
	{
		parent::__construct($id);
    }

//Funcion para almacenar un departamento en la base de datos
    function set_departamento($departamento)
    {//comprobamos que el departamento no se encuentra almacenado
    	$consulta = $this->db->get_where('departamentos',array('nombre_departamento' => $departamento->nombre_departamento));
    	if($consulta->num_rows() === 0)
    	{//Como NO esta almacenado, lo guardamos
    		$departamento->save();
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

    //Funcion para eliminar el departamento seleccionado
    function unset_departamento($departamento)
    {//compruebo que el departamento no tenga personas asociadas
        $ok = 0;
        $p = new Persona();
        $p->get_by_departamento($departamento);
        if(!$p->exists()){
            //No existen personas asociadas al departamentos y borramos
            $this->db->delete('departamentos', array('id' => $departamento));
            $ok = 1;
        }

        return $ok;
    }

    //Funcion para actualizar departamento de la BD
    function update_departamento($array,$id)
    {
        $this->db->where('id',$id);
        $this->db->update('departamentos', $array);
        if($this->db->affected_rows() == 0)
        {
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    function getNumDepartamentos()
    {
        return $this->db->count_all('departamentos');
    }

    //Listar Departamentos
    function lista_departamentos($limit, $start)
    {
        $this->db->select('depart.id, depart.nombre_departamento, depart.email, depart.telefono, depart.fax');
        $this->db->from('departamentos as depart');
        $this->db->order_by("depart.id","ASC");
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

//Funcion para obtener los datos de un pedido a partir de su id
    function obtener_departamento($id)
    {
        $departamento = new Departamento();
        $departamento->get_by_id($id);
        return $departamento;
    }

//Funcion para obtener en un array todos los departamentos de mi tabla
//obtener_todos_departamentos($objeto)
    function obtener_todos_departamentos()
    {
        $departamentos = new Departamento();
        $departamentos->get();
        $d = $departamentos->all_to_array();
        return $d;
    }

//Funcion para obtener en un array el nombre departamentos de la base de datos (usada para los mostrar en los selects)
//obtener_nombre_departamentos($objeto)
    function obtener_nombre_departamentos()
    {
        $departamento = new Departamento();
        $departamento->get();
        $data = array('id','nombre_departamento');
        $d = $departamento->all_to_array($data);
        return $d;
    }

//Funcion para obtener en un array el nombre departamentos de la base de datos menos el indicado por su id (usada para los mostrar en los selects)
//obtener_nombre_departamentos_menos_uno($int)
    function obtener_nombre_departamentos_menos_uno($id)
    {
        $departamento = new Departamento();
        $departamento->where_not_in('id',$id);
        $departamento->get();
        $data = array('id','nombre_departamento');
        $d = $departamento->all_to_array($data);
        return $d;
    }

    //Funcion para obtener el nombre de un departamento dado a partir del id
    //obtener_nombre_departamento_por_id($int)
    function obtener_nombre_departamento_por_id($id)
    {
        $departamento = new Departamento();
        $departamento->get_by_id($id);
        return $departamento->nombre_departamento;
    }

//Muestra un formulario a modificar
    function muestra_combo_departamento($id)
    {
        $rpta = "";
        //hago una consulta a la base de datos para obtener los datos del departamento a partir de su id
        $departamento = $this->db->get_where('departamentos',array('id'=>$id));

        foreach ($departamento->result() as $fila) {
            $rpta .= '
            <form id="update2departamento" action="'.base_url().'departamento_controller/updateDepartamento" method="POST">
                <fieldset>
                <legend>Información de Departamento</legend>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="'. $fila->nombre_departamento . '" placeholder="Nombre">
                        </div>
                    </div>
                    <!-- ************************-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email" value="' . $fila->email . '" placeholder="Email">
                        </div>
                    </div>
                    <!-- ************************-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="telefono">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" value="' . $fila->telefono . '" placeholder="Telefono">
                        </div>
                    </div>
                    <!-- ************************-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="fax">Fax</label>
                            <input type="text" class="form-control" id="fax" name="fax" value="' . $fila->fax . '" placeholder="Fax">
                        </div>
                    </div>
                    <!-- ************************-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a href="modificar_departamento" class="btn btn-default">Cancelar</a>
                        </div>
                    </div>
                    <!-- ************************-->
                </fieldset>
            </form>';
        }
        echo $rpta;
    }
}

/* End of file departamento.php */
/* Location: ./application/models/departamento.php */