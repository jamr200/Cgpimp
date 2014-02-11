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

class Dispositivo extends DataMapper {

	var $table = 'dispositivos';

	var $has_one = array('tipo_dispositivo','marca','modelo');

	var $has_many = array(
			'instancia_dispositivo',
			'material' => array(
				'class' => 'material',
				'other_field' => 'dispositivo',
				'join_self_as' => 'dispositivo',
				'join_other_as' => 'material',
				'join_table' => 'dispositivos_materiales')
		);


    function __construct($id = NULL)
	{
		parent::__construct($id);
    }


    //Funcion para almacenar un dispositivo en la base de datos
    function set_dispositivo($dispositivo)
    {//comprobamos que el dispositivo no se encuentra almacenado
    	$consulta = $this->db->get_where('dispositivos',array('marca' => $dispositivo->marca,'modelo' => $dispositivo->modelo));
    	if($consulta->num_rows() === 0)
    	{//Como NO esta almacenado, lo guardamos
    		$dispositivo->save();
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
    function update_dispositivo($array,$id)
    {
        $this->db->where('id',$id);
        $this->db->update('dispositivos', $array);
        if($this->db->affected_rows() == 0)
        {
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    function getNumDispositivos()
    {
        return $this->db->count_all('dispositivos');
    }

    //Listar dispositivos
    function lista_dispositivos($limit, $start)
    {
        $this->db->select('disp.id, tipos_dispositivos.nombre_tipo_dispositivo, marcas.nombre_marca, modelos.nombre_modelo');
        $this->db->from('dispositivos as disp');
        $this->db->join('tipos_dispositivos','tipos_dispositivos.id = disp.tipo_dispositivo');
        $this->db->join('marcas','marcas.id = disp.marca');
        $this->db->join('modelos','modelos.id = disp.modelo');
        $this->db->order_by("disp.id","ASC");
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

    function lista_dispositivos2()
    {
        $this->db->select('disp.id, tipos_dispositivos.nombre_tipo_dispositivo, marcas.nombre_marca, modelos.nombre_modelo');
        $this->db->from('dispositivos as disp');
        $this->db->join('tipos_dispositivos','tipos_dispositivos.id = disp.tipo_dispositivo');
        $this->db->join('marcas','marcas.id = disp.marca');
        $this->db->join('modelos','modelos.id = disp.modelo');

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

    //Funcion para ver si un dispositivo se encuentra en la BD
    function esta_dispositivo($marca,$modelo)
    {
        //dispositivo a eliminar
        $dispositivo = new Dispositivo();
        $dispositivo->where('marca', $marca);
        $dispositivo->where('modelo', $modelo);
        $dispositivo->get();

        if($dispositivo->exists())
        {
            //El dispositivo se encuentra registrado
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //Funcion para obtener el contador
    function obtener_contador_dispositivo($id)
    {
        $dispositivo = new Dispositivo();
        $dispositivo->where('id', $id);
        $dispositivo->get();

        if($dispositivo->exists())
        {
            return $dispositivo->contador;
        }
    }

    //funcion para obtener el id de un dispositivo a partir del modelo
    function obtener_id_dispositivo($id_modelo)
    {
        $dispositivo = new Dispositivo();
        $dispositivo->where('modelo', $id_modelo);
        $dispositivo->get();

        if($dispositivo->exists())
        {
            return $dispositivo->id;
        }
        else
        {
            return 0;
        }
    }

    //funcion para obtener un id de un dispositivo a partir de su tipo,marca y modelo
    function obtener_id_dispositivo2($tipo,$marca,$modelo)
    {
        //dispositivo a eliminar
        $dispositivo = new Dispositivo();
        $dispositivo->where('tipo_dispositivo', $tipo);
        $dispositivo->where('marca', $marca);
        $dispositivo->where('modelo', $modelo);
        $dispositivo->get();

        if($dispositivo->exists())
        {
            //El dispositivo se encuentra registrado
            return $dispositivo->id;
        }
        else
        {
            return 0;
        }
    }

    //funcion para obtener el id del ultimo dispositivo
    function obtener_id_ultimo_dispositivo()
    {
        $dispositivo = new Dispositivo();
        $dispositivo->select_max('id');
        $dispositivo->get();
        return $dispositivo->id;
    }

    //funcion para obtener un id de un dispositivo a partir de su marca y de su modelo
    function obtener_dispositivo($marca,$modelo)
    {
        //dispositivo a eliminar
        $dispositivo = new Dispositivo();
        $dispositivo->where('marca', $marca);
        $dispositivo->where('modelo', $modelo);
        $dispositivo->get();

        if($dispositivo->exists())
        {
            //El dispositivo se encuentra registrado
            return $dispositivo->id;
        }
        else
        {
            return 0;
        }
    }

    //Funcion para obtener los registros de un dispositivo dado su id
    public function obtener_dispositivo_por_id($id_dispositivo)
    {//Devolvemos un objeto
        $dispo = new Dispositivo();
        $dispo->get_by_id($id_dispositivo);
        return $dispo;
    }


//funcion que a partir de un id me devuelve todas las marcas registradas con ese id
    public function obten_marcas_por_id($idtipo)
    {
    	//Funcion para obtener el id de un tipo de dispositivo dado
    	$dispo = new Dispositivo();
        $dispo->get_by_tipo_dispositivo($idtipo);
        $array = array();
        foreach ($dispo as $d) {
			array_push($array,$d->marca);
		}
        return $array;
    }

    //Funcion para obtener el id,marca,modelo de todos los dispositivos almacenados
    //obtener_todos_dispositivos_marca($objeto)
    public function obtener_todos_dispositivos($dispositivos)
    {
        $dispositivos->get();
        $campos = array('id','marca','modelo');
        $dispositivo = $dispositivos->all_to_array($campos);
        return $dispositivo;
    }

    //Muestra los elementos en el lugar indicado en la vista
    function muestra_combo_dispositivo($id_tipo)
    {
        $rpta="";
        //hago una consulta a la base de datos para obtener los dispositivos en funcion del tipo seleccionado
        $dispositivos = $this->db->get_where('dispositivos',array('tipo_dispositivo'=>$id_tipo));

        foreach ($dispositivos->result() as $fila)
        {
            //convierto el id de la marca y convierto el id del modelo
            $marca = $this->Marca->obtener_nombre_marca_por_id($fila->marca);
            $modelo = $this->Modelo->obtener_nombre_modelo_por_id($fila->modelo);

            $rpta.= '<option value="' . $fila->id .'">' . $marca . ' ' . $modelo . '</option>';
        }
        echo $rpta;
    }
}




/* End of file device.php */
/* Location: ./application/models/device.php */