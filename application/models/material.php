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

class Material extends DataMapper {

	var $table = 'materiales';
	var $has_one = array('tipo_material','marca','modelo');

	var $has_many = array(
			'instancia_material',
			'dispositivo' => array(
				'class' => 'dispositivo',
				'other_field' => 'material',
				'join_self_as' => 'material',
				'join_other_as' => 'dispositivo',
				'join_table' => 'dispositivos_materiales')
		);

    function __construct($id = NULL)
	{
		parent::__construct($id);
    }

    //Funcion para almacenar material en la base de datos
    function set_material($material)
    {//comprobamos que el material no se encuentra almacenado
    	$consulta = $this->db->get_where('materiales',array('marca' => $material->marca,'modelo' => $material->modelo,'tipo_material' => $material->tipo_material));
    	if($consulta->num_rows() === 0)
    	{//Como NO esta almacenado, lo guardamos
    		$material->save();
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

    //Funcion para actualizar material de la BD
    function update_material($array,$id)
    {
        $this->db->where('id',$id);
        $this->db->update('materiales', $array);
        if($this->db->affected_rows() == 0)
        {
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    function getNumMateriales()
    {
        return $this->db->count_all('materiales');
    }

    //Funcion para listar materiales
    function lista_materiales($limit, $start)
    {
        $this->db->select('mat.id, tipos_materiales.nombre_tipo_material, marcas.nombre_marca, modelos.nombre_modelo');
        $this->db->from('materiales as mat');
        $this->db->join('tipos_materiales','tipos_materiales.id = mat.tipo_material');
        $this->db->join('marcas','marcas.id = mat.marca');
        $this->db->join('modelos','modelos.id = mat.modelo');
        $this->db->order_by("mat.id","ASC");
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

    function lista_materiales2()
    {
        $this->db->select('mat.id, tipos_materiales.nombre_tipo_material, marcas.nombre_marca, modelos.nombre_modelo');
        $this->db->from('materiales as mat');
        $this->db->join('tipos_materiales','tipos_materiales.id = mat.tipo_material');
        $this->db->join('marcas','marcas.id = mat.marca');
        $this->db->join('modelos','modelos.id = mat.modelo');

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

    //Funcion para obtener el contador
    function obtener_contador_material($id)
    {
        $material = new Material();
        $material->where('id', $id);
        $material->get();

        if($material->exists())
        {
            return $material->contador;
        }
    }

    //funcion para obtener el id del ultimo material
    function obtener_id_ultimo_material()
    {
        $material = new Material();
        $material->select_max('id');
        $material->get();
        return $material->id;
    }

    //Funcion para ver si un material se encuentra en la BD
    function esta_material($marca,$modelo)
    {
        //material a eliminar
        $material = new Material();
        $material->where('marca', $marca);
        $material->where('modelo', $modelo);
        $material->get();

        if($material->exists())
        {
            //El material se encuentra registrado
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //funcion para obtener el id de un material a partir del modelo
    function obtener_id_material($id_modelo)
    {
        $material = new Material();
        $material->where('modelo', $id_modelo);
        $material->get();

        if($material->exists())
        {
            return $material->id;
        }
        else
        {
            return 0;
        }
    }

    //funcion para obtener un material a partir de su marca y de su modelo
    function obtener_id_material2($tipo,$marca,$modelo)
    {
        //dispositivo a eliminar
        $material = new Material();
        $material->where('tipo_material', $tipo);
        $material->where('marca', $marca);
        $material->where('modelo', $modelo);
        $material->get();

        if($material->exists())
        {
            //El material se encuentra registrado
            return $material->id;
        }
        else
        {
            return 0;
        }
    }

    //funcion para obtener un material a partir de su marca y de su modelo
    function obtener_material($marca,$modelo)
    {
        //dispositivo a eliminar
        $material = new Material();
        $material->where('marca', $marca);
        $material->where('modelo', $modelo);
        $material->get();

        if($material->exists())
        {
            //El material se encuentra registrado
            return $material->id;
        }
        else
        {
            return 0;
        }
    }

    //Funcion para obtener los registros de un material dado su id
    public function obtener_material_por_id($id_material)
    {//Devolvemos un objeto
        $mat = new Material();
        $mat->get_by_id($id_material);
        return $mat;
    }

//Método para mostrar los materiales en un select
    function muestra_combo_a_material($id_tipo)
    {
        $rpta='<option value="9999"></option>';
        //hago una consulta a la base de datos para obtener los materiales en funcion del tipo seleccionado
        $materiales = $this->db->get_where('materiales',array('tipo_material'=>$id_tipo));

        foreach ($materiales->result() as $fila)
        {
            $rpta.= '<option value="' . $fila->id .'">' . $fila->marca . ' ' . $fila->modelo . '</option>';
        }
        echo $rpta;
    }
}

/* End of file material.php */
/* Location: ./application/models/material.php */