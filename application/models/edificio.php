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

class Edificio extends DataMapper {

	var $table = 'edificios';
	var $has_many = array('ubicacion','habitacion');


    function __construct($id = NULL)
	{
		parent::__construct($id);
    }

    //Funcion para almacenar un edificio en la base de datos
    function set_edificio($edificio)
    {//comprobamos que el edificio no se encuentre almacenado
        $consulta = $this->db->get_where('edificios',array('nombre_edificio' => $edificio->nombre_edificio));
        if($consulta->num_rows() === 0)
        {//Como NO esta almacenado, lo guardamos
            $edificio->save();
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

    //Funcion para obtener en un array todos los registros de mi tabla
    function obtener_todos_edificios()
    {
        $edificios = new Edificio();
        $edificios->get();
        $edif = $edificios->all_to_array();
        return $edif;
    }

    //Funcion para obtener el nombre de un edificio dado a partir del id
    //obtener_nombre_edificio_por_id($int)
    function obtener_nombre_edificio_por_id($id)
    {
        $edificio = new Edificio();
        $edificio->get_by_id($id);
        return $edificio->nombre_edificio;
    }
}

/* End of file edificio.php */
/* Location: ./application/models/edificio.php */