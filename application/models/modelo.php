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

class Modelo extends DataMapper {

	var $table = 'modelos';

    var $has_one = array('elemento','marca');
	var $has_many = array('dispositivo','material');


    function __construct($id = NULL)
	{
		parent::__construct($id);
    }

	//Funcion para almacenar un modelo en la base de datos
    function set_modelo($modelo)
    {//comprobamos que el modelo no se encuentra almacenado
    	$consulta = $this->db->get_where('modelos',array('nombre_modelo' => $modelo->nombre_modelo,'elemento' => $modelo->elemento,'marca' => $modelo->marca));
    	if($consulta->num_rows() === 0)
    	{//Como NO esta almacenado, lo guardamos
    		$modelo->save();
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


    function obtener_nombre_modelo_por_id($id)
    {
        //creo un objeto
        $modelo = new Modelo();
        //obtengo el registro en funcion de su id
        $modelo->get_by_id($id);

        //devuelvo el nombre correspondiente al id
        return $modelo->nombre_modelo;
    }

    function obtener_modelos_dispositivo()
    {
        //creo un objeto
        $modelo = new Modelo();
        //obtengo los registros en funcion de su tipo
        $modelo->where('elemento',1);
        $modelo->get();
        //paso los registros a array y lo retorno
        $data = array('nombre_modelo','id');
        $modelos = $modelo->all_to_array($data);
        return $modelos;
    }


    //Método que me muestra en un select todos los modelos en funcion de la marca indicada
    function muestra_modelo($marca)
    {
        $rpta='<option value=""></option>';


        //hago una consulta a la base de datos para obtener las modelos para un dispositivo en funcion de la marca
        $modelos = $this->db->get_where('modelos',array('marca' => $marca));

        foreach ($modelos->result() as $fila)
        {
            $rpta.= '<option value="' . $fila->id .'">' . $fila->nombre_modelo . '</option>';
        }
        echo $rpta;
    }
/*  IGUAL QUE LA DE ARRIBA
    //Funcion que me muestra en un select todas las marcas cuyo tipo es material
    function muestra_modelos_por_marca_material($marca)
    {
        $rpta='<option value=""></option>';

        //hago una consulta a la base de datos para obtener las modelos para un material en funcion de la marca
        $modelos = $this->db->get_where('modelos',array('marca' => $marca,'tipo' => 'material'));

        foreach ($modelos->result() as $fila)
        {
            $rpta.= '<option value="' . $fila->id .'">' . $fila->nombre . '</option>';
        }
        echo $rpta;
    }


	function muestra_combo_tipo($tipo)
    {
        $rpta='';
        //hago una consulta a la base de datos para obtener las marcas en funcion del tipo seleccionado
        $marcas = $this->db->get_where('marcas',array('tipo' => $tipo));

        foreach ($marcas->result() as $fila)
        {
            $rpta.= '<option value="' . $fila->nombre .'">' . $fila->nombre . '</option>';
        }
        echo $rpta;
    }
    */

}