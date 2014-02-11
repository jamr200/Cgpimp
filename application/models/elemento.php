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

class Elemento extends DataMapper {

	var $table = 'elementos';
	var $has_many = array('modelo','marca');

    function __construct($id = NULL)
	{
		parent::__construct($id);
    }

    //Funcion para obtener en un array el nombre de elementos de la base de datos (usada para los mostrar en los selects)
//obtener_nombre_elementos($objeto)
    function obtener_nombre_elementos()
    {
        $elemento = new Elemento();
        $elemento->get();
        $data = array('id','nombre');
        $elem = $elemento->all_to_array($data);
        return $elem;
    }
}

/* End of file elemento.php */
/* Location: ./application/models/elemento.php */