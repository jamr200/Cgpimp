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

class Balda extends DataMapper {

	var $table = 'baldas';
	var $has_one = array('mueble');
	var $has_many = array('ubicacion');

    function __construct($id = NULL)
	{
		parent::__construct($id);
    }

    //Funcion para almacenar una balda en la base de datos
    function set_balda($balda)
    {//comprobamos que el balda no se encuentre almacenado
        $consulta = $this->db->get_where('baldas',array('nombre_balda' => $balda->nombre_balda, 'mueble' => $balda->mueble));
        if($consulta->num_rows() === 0)
        {//Como NO esta almacenado, lo guardamos
            $balda->save();
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

    //Método que me muestra en un select todas las baldas de un mueble indicado
    function muestra_balda($mueble)
    {
        $rpta='<option value=""></option>';


        //hago una consulta a la base de datos para obtener las baldas pertenecientes a un mueble
        $consulta = $this->db->get_where('baldas',array('mueble' => $mueble));

        foreach ($consulta->result() as $fila)
        {
            $rpta.= '<option value="' . $fila->id .'">' . $fila->nombre_balda . '</option>';
        }
        echo $rpta;
    }

    //Funcion para obtener el nombre de una balda dada a partir del id
    //obtener_nombre_balda_por_id($int)
    function obtener_nombre_balda_por_id($id)
    {
        $balda = new Balda();
        $balda->get_by_id($id);
        return $balda->nombre_balda;
    }
}

/* End of file balda.php */
/* Location: ./application/models/balda.php */