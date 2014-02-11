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

class Dispositivo_material extends DataMapper {

	var $table = 'dispositivos_materiales';


    function __construct($id = NULL)
	{
		parent::__construct($id);
    }

    public $validation = array(
        'id_dispositivo' => array(
            'label' => 'Id_dispositivo',
            'rules' => array('required', 'trim', 'unique pair' => 'id_material')
        ),
        'id_material' => array(
            'label' => 'Id_material',
            'rules' => array('required', 'trim')
        )
    );

    //Funcion para almacenar en tabla muchos-a-muchos en la base de datos
    function set_dispositivos_materiales($id_material,$compatibles)
    {//almacenamos directamente ese material con sus dispositivos compatibles
        //$compatibles = explode(',',$compatibles);
        for ($i=0; $i < count($compatibles); $i++)
        {
                $data = array(
                'id_dispositivo' => $compatibles[$i],
                'id_material' => $id_material
                );
                $this->db->insert('dispositivos_materiales', $data);
        }
    }

    //Funcion para ver si estan relacionados un dispositivo y un material
    function estan_relacionados($material,$dispositivo)
    {
        {
        $disp_mat = new Dispositivo_material();
        $disp_mat->where('id_material', $material);
        $disp_mat->where('id_dispositivo', $dispositivo);
        $disp_mat->get();

        if($disp_mat->exists())
        {
            //se encuentra registrado
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
    }

    function obtener_dispositivos($id)
    {
        $dispositivo = new Dispositivo_material();
        $dispositivo->get_by_id_material($id);
        $data = array('id_dispositivo');
        $disp = $dispositivo->all_to_array($data);
        return $disp;

    }
}

/* End of file device.php */
/* Location: ./application/models/device.php */