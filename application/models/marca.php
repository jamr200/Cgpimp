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

class Marca extends DataMapper {

	var $table = 'marcas';

    var $has_one = array('elemento');
	var $has_many = array('dispositivo','material','modelo');


    function __construct($id = NULL)
	{
		parent::__construct($id);
    }

    //Funcion para almacenar una marca en la base de datos
    function set_marca($marca)
    {//comprobamos que la marca no se encuentra almacenada
    	$consulta = $this->db->get_where('marcas',array('nombre_marca' => $marca->nombre_marca,'elemento' => $marca->elemento,'tipo_dispositivo' => $marca->tipo_dispositivo,'tipo_material' => $marca->tipo_material,));
    	if($consulta->num_rows() === 0)
    	{//Como NO esta almacenado, lo guardamos
    		$marca->save();
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


    function obtener_marcas_dispositivo()
    {
        //creo un objeto
        $marca = new Marca();
        //obtengo los registros en funcion de su tipo
        $marca->where('elemento',1);
        $marca->get();
        //paso los registros a array y lo retorno
        $data = array('nombre_marca','id');
        $marcas = $marca->all_to_array($data);
        return $marcas;
    }

    function obtener_marcas_material()
    {
        //creo un objeto
        $marca = new Marca();
        //obtengo los registros en funcion de su tipo
        $marca->where('tipo_material >',0);
        $marca->get();
        //paso los registros a array y lo retorno
        $data = array('nombre_marca','id');
        $marcas = $marca->all_to_array($data);
        return $marcas;
    }

    function obtener_nombre_marca_por_id($id)
    {
        //creo un objeto
        $marca = new Marca();
        //obtengo el registro en funcion de su id
        $marca->get_by_id($id);

        //devuelvo el nombre correspondiente al id
        return $marca->nombre_marca;
    }


//Método para mostrar las marcas en un select
    function muestra_marca($id_elemento,$id_tipo)
    {
        $rpta='<option value=""></option>';
        //hago una consulta a la base de datos para obtener las marcas del tipo seleccionado
        if($id_elemento == 1)
        {
            $marcas = $this->db->get_where('marcas',array('tipo_dispositivo' => $id_tipo));
        }
        else
        {
            $marcas = $this->db->get_where('marcas',array('tipo_material' => $id_tipo));
        }

        foreach ($marcas->result() as $fila)
        {
            $rpta.= '<option value="' . $fila->id .'">' . $fila->nombre_marca . '</option>';
        }
        echo $rpta;
    }

//Método para mostrar las marcas de dispositivo en un select
    function muestra_marca_dispositivo($id_tipo)
    {
        $rpta='<option value=""></option>';
        //hago una consulta a la base de datos para obtener las instancias del material seleccionado
        $marcas = $this->db->get_where('marcas',array('tipo_dispositivo'=>$id_tipo));

        foreach ($marcas->result() as $fila)
        {
            $rpta.= '<option value="' . $fila->id .'">' . $fila->nombre_marca . '</option>';
        }
        echo $rpta;
    }

//Método para mostrar las marcas de material en un select
    function muestra_marca_material($id_tipo)
    {
        $rpta='<option value=""></option>';
        //hago una consulta a la base de datos para obtener las instancias del material seleccionado
        $marcas = $this->db->get_where('marcas',array('tipo_material'=>$id_tipo));

        foreach ($marcas->result() as $fila)
        {
            $rpta.= '<option value="' . $fila->id .'">' . $fila->nombre_marca . '</option>';
        }
        echo $rpta;
    }

}