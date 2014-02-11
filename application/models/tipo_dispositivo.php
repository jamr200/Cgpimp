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

class Tipo_dispositivo extends DataMapper {

	var $table = 'tipos_dispositivos';
	var $has_many = array('dispositivo');


    function __construct($id = NULL)
	{
		parent::__construct($id);
    }


//Funcion para almacenar un tipo de dispositivo en la base de datos
    function set_tipo_dispositivo($tipo)
    {//comprobamos que el tipo no se encuentra almacenado
    	$consulta = $this->db->get_where('tipos_dispositivos',array('nombre_tipo_dispositivo' => $tipo->nombre_tipo_dispositivo));
    	if($consulta->num_rows() === 0)
    	{//Como NO esta almacenado, lo guardamos
    		$tipo->save();
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

////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////Hacen lo mismo estas fuciones/////////////////////////////////////////////////
//Funcion para obtener en un array todos los tipos de dispositivo de mi tabla
    function obtener_todos_tipos()
    {
        $tipos = new Tipo_dispositivo();
        $tipos->get();
        $t = $tipos->all_to_array();
        return $t;
    }

//Funcion para obtener en un array el nombre de los tipos de dispositivo de la base de datos (usada para los mostrar en los selects)
//obtener_nombre_tipos($objeto)
    function obtener_nombre_tipos()
    {
        //creo un objeto
        $tipo = new Tipo_dispositivo();
        //obtengo los registros
        $tipo->get();
        $data = array('nombre_tipo_dispositivo','id');
        //paso los registros a array y lo retorno
        $tipos = $tipo->all_to_array($data);
        return $tipos;
    }
/////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////
     function obtener_nombre_tipo_por_id($id)
    {
        //creo un objeto
        $tipo = new Tipo_dispositivo();
        //obtengo el registro en funcion de su id
        $tipo->get_by_id($id);

        //devuelvo el nombre correspondiente al id
        return $tipo->nombre_tipo_dispositivo;
    }


///////////////////////////////////////////////////////////////////
/////////////metodos para listar las tablas paginadas//////////////
///////////////////////////////////////////////////////////////////
    function getNumTipos()
    {
        return $this->db->count_all('tipos_dispositivos');
    }

    function getTipos($limit, $start)
    {
        $this->db->limit($limit,$start);
        $resultado = $this->db->get('tipos_dispositivos');
        return $resultado->result();
    }
///////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////

//Funcion para obtener el id de un tipo de dispositivo a partir del nombre
//obtener_id_tipo($string)
    function obtener_id_tipo($nombre)
    {
        $tipo_dispositivo = new Tipo_dispositivo();
        $tipo_dispositivo->get_by_nombre_tipo_dispositivo($nombre);
        return $tipo_dispositivo->id;
    }

    //funcion para mostrar un select con los tipos de dispositivo existentes
    public function muestra_tipos()
    {
        $rpta='<option value=""></option>';
        //hago una consulta a la base de datos para obtener las instancias del material seleccionado
        $tipos = $this->db->get_where('tipos_dispositivos');

        foreach ($tipos->result() as $fila)
        {
            $rpta.= '<option value="' . $fila->id .'">' . $fila->nombre_tipo_dispositivo . '</option>';
        }
        echo $rpta;
    }

}

/* End of file tipo_dispositivo.php */
/* Location: ./application/models/tipo_dispositivo.php */