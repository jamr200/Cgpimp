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

class Habitacion extends DataMapper {

	var $table = 'habitaciones';
	var $has_one = array('edificio');
	var $has_many = array('ubicacion','mueble');

    function __construct($id = NULL)
	{
		parent::__construct($id);
    }

    //Funcion para almacenar una habitacion en la base de datos
    function set_habitacion($habitacion)
    {//comprobamos que la habitacion no se encuentre almacenada
        $consulta = $this->db->get_where('habitaciones',array('nombre_habitacion' => $habitacion->nombre_habitacion));
        if($consulta->num_rows() === 0)
        {//Como NO esta almacenado, lo guardamos
            $habitacion->save();
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

    //Método que me muestra en un select todas las habitaciones en funcion del edificio indicado
    function muestra_habitacion($edificio)
    {
        $rpta='<option value=""></option>';


        //hago una consulta a la base de datos para obtener las habitaciones pertenecientes a un edificio
        $consulta = $this->db->get_where('habitaciones',array('edificio' => $edificio));

        foreach ($consulta->result() as $fila)
        {
            $rpta.= '<option value="' . $fila->id .'">' . $fila->nombre_habitacion . '</option>';
        }
        echo $rpta;
    }

    //Funcion para obtener el nombre de una habitacion dada a partir del id
    //obtener_nombre_habitacion_por_id($int)
    function obtener_nombre_habitacion_por_id($id)
    {
        $habitacion = new Habitacion();
        $habitacion->get_by_id($id);
        return $habitacion->nombre_habitacion;
    }

}

/* End of file habitacion.php */
/* Location: ./application/models/habitacion.php */