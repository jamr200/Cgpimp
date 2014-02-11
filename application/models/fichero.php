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

class Fichero extends DataMapper {

	var $table = 'ficheros';
	//var $has_one = array('pedido');


    function __construct($id = NULL)
	{
		parent::__construct($id);

    }

    //Funcion para almacenar informacion de archivo en la base de datos
    public function set_archivo($fichero)
    {
    	//comprobamos que esa compra no se encuentra almacenada
    	$consulta = $this->db->get_where('ficheros', array('nombre' => $fichero->nombre));
    	if($consulta->num_rows() === 0)
    	{//Como NO esta almacenada, la guardamos
    		$fichero->save();
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

    //Funcion que me devuelve los ficheros asociados a un pedido
    public function obtener_ficheros_asociados($id_pedido)
    {
        $consulta = $this->db->get_where('ficheros', array('pedido' => $id_pedido));
        $listado = array();
        foreach ($consulta->result() as $row)
        {
           array_push($listado,$row->nombre);
        }
        return $listado;
    }

    public function muestra_ficheros_actuales($id_pedido)
    {
        $rpta = "";
        //hago una consulta a la base de datos para obtener los datos del pedido a partir de su id
        $consulta = $this->db->get_where('ficheros',array('pedido'=>$id_pedido));

        if($consulta->num_rows() == 0)
        {
            $rpta .= '<h4>No hay ficheros asociados.</h4>';
        }
        else
        {
            $rpta .= '<div class="form-group">
                        <label for="ficheros_almacenados">Ficheros almacenados</label>';
                        foreach ($consulta->result() as $fila) {
                            $rpta .= '  <p class="form-control-static">'. $fila->nombre . '</p>';
                        }
            $rpta .= '</div>';
        }

        echo $rpta;
    }
}

/* End of file fichero.php */
/* Location: ./application/models/fichero.php */