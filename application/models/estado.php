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

class Estado extends DataMapper {

	var $table = 'estados';

	var $has_many = array('instancia_material','secuencia_estado');

    function __construct($id = NULL)
	{
		parent::__construct($id);
    }

    //Funcion para almacenar un estado en la base de datos
    function set_estado($estado)
    {//comprobamos que el estado no se encuentra almacenado
    	$consulta = $this->db->get_where('estados',array('nombre_estado' => $estado->nombre_estado));
    	if($consulta->num_rows() === 0)
    	{//Como NO esta almacenado, lo guardamos
    		$estado->save();
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

    //Funcion para obtener el nombre de un estado dado a partir del id
    //obtener_nombre_estado_por_id($int)
    function obtener_nombre_estado_por_id($id)
    {
        $estado = new Estado();
        $estado->get_by_id($id);
        return $estado->nombre_estado;
    }

    //Funcion para obtener el nombre de los estados
    //obtener_nombre_estado_por_id($int)
    function obtener_todos_estados()
    {
        $estado = new Estado();
        $estado->get();
        $e = $estado->all_to_array();
        return $e;
    }

    //Funcion para obtener en un array el nombre de estados de la base de datos menos el indicado por su id (usada para los mostrar en los selects)
    //obtener_nombre_estados_menos_uno($int)
    function obtener_nombre_estados_menos_uno($id)
    {
        $estado = new Estado();
        $estado->not_like('id',$id);
        $estado->get();
        $data = array('id','nombre_estado');
        $est = $estado->all_to_array($data);
        return $est;
    }

}