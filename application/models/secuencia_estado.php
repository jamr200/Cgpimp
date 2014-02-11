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

class Secuencia_estado extends DataMapper {

	var $table = 'secuencia_estados';

    var $has_one = array('instancia_dispositivo','instancia_material');

	var $has_many = array('estado');

    function __construct($id = NULL)
	{
		parent::__construct($id);
    }


    //Funcion para almacenar una secuencia en la base de datos
    function set_secuencia_estado_material($secuencia)
    {//comprobamos que exista la instancia
        if($secuencia->instancia_material === 0)
        {
            return 0;
        }

        //almaceno la secuencia
        $secuencia->save();
        //Compruebo que se ha almacenado
        if($this->db->affected_rows() === 1)
        {//lo hemos almacenado y devolvemos true
            return TRUE;
        }
        else
        {//No se ha almacenado
            return FALSE;
        }
    }

    //Funcion para almacenar una secuencia en la base de datos
    function set_secuencia_estado_dispositivo($secuencia)
    {//comprobamos que exista la instancia
        if($secuencia->instancia_dispositivo === 0)
        {
            return 0;
        }

        //almaceno la secuencia
        $secuencia->save();
        //Compruebo que se ha almacenado
        if($this->db->affected_rows() === 1)
        {//lo hemos almacenado y devolvemos true
            return TRUE;
        }
        else
        {//No se ha almacenado
            return FALSE;
        }
    }

    //Funcion para obtener el ultimo registro almacenado de una instancia concreta
    function obtener_registro_estado_material($instancia)
    {
        $secuencia = new Secuencia_estado();
        //Ordenamos descendentemente por id. El mayor sera el primero.
        $secuencia->order_by("fecha_unix","desc");
        //obtenemos el registro
        $secuencia->get_by_instancia_material($instancia);

        return $secuencia->estado;
    }

    //Funcion para obtener el ultimo registro almacenado de una instancia concreta
    function obtener_registro_estado_dispositivo($instancia)
    {
        $secuencia = new Secuencia_estado();
        //Ordenamos descendentemente por id. El mayor sera el primero.
        $secuencia->order_by("fecha_unix","desc");
        //obtenemos el registro
        $secuencia->get_by_instancia_dispositivo($instancia);

        return $secuencia->estado;
    }

    //Funcion para obtener el nombre de un estado dado a partir del id
    //obtener_nombre_estado_por_id($int)
    function obtener_nombre_estado_por_id($id)
    {
        $estado = new Estado();
        $estado->get_by_id($id);
        return $estado->nombre_estado;
    }

    //Funcion para obtener en un array el nombre de estados de la base de datos menos el indicado por su id (usada para los mostrar en los selects)
    //obtener_nombre_estados_menos_uno($int)
    function obtener_nombre_estados_menos_uno($id)
    {
        $estado = new Estado();
        $estado->not_like('id',$id);
        $estado->get();
        $data = array('id','nombre_estado');
        $est = $estado->all_to_array($data);
        return $est;
    }

    public function obtener_historico_estados_inst_dispositivo($id)
    {
        $historico = $this->db->get_where('secuencia_estados',array('instancia_dispositivo'=>$id));
        return $historico->result();
    }

    public function obtener_historico_estados_inst_material($id)
    {
        $historico = $this->db->get_where('secuencia_estados',array('instancia_material'=>$id));
        return $historico->result();
    }

    public function genera_historico_inst_dispositivo($id)
    {
        $rpta = "";
        //hago una consulta a la base de datos para obtener los datos de los estados por los que pasa la instancia a partir de su id
        $estados = $this->db->get_where('secuencia_estados',array('instancia_dispositivo'=>$id));

$rpta .='<table class="table table-bordered table-striped">
            <tr>
                <th width="90">Id instancia dispositivo</th>
                <th width="90">Part number</th>
                <th width="90">Num serie</th>
                <th width="90">Estado</th>
                <th width="90">Fecha</th>
                <th width="90">Instancia asociada</th>
            </tr>';
        foreach ($estados->result() as $fila) {

            //Obtenemos el nombre del estado
            $nombre_estado = $this->Estado->obtener_nombre_estado_por_id($fila->estado);

            if($fila->instancia_relacion == 0)
            {
                $instancia_asociada = NULL;
            }
            else
            {
                $instancia = $this->Instancia_material->obtener_instancia_material($fila->instancia_relacion);
                $instancia_asociada = $instancia->id.' // '.$instancia->part_number.' // '.$instancia->num_serie;;
            }

$rpta .= '   <tr>
                <td width="90">'.$fila->instancia_dispositivo.'</td>
                <td width="90">'.$fila->part_number.'</td>
                <td width="90">'.$fila->num_serie.'</td>
                <td width="90">'.$nombre_estado.'</td>
                <td width="90">'.$fila->fecha.'</td>
                <td width="90">'.$instancia_asociada.'</td>
            </tr>';
        }
$rpta .='</table>';

echo $rpta;
    }

        public function genera_historico_inst_material($id)
    {
        $rpta = "";
        //hago una consulta a la base de datos para obtener los datos de los estados por los que pasa la instancia a partir de su id
        $estados = $this->db->get_where('secuencia_estados',array('instancia_material'=>$id));

$rpta .='<table class="table table-bordered table-striped">
            <tr>
                <th width="90">Id instancia material</th>
                <th width="90">Part number</th>
                <th width="90">Num serie</th>
                <th width="90">Estado</th>
                <th width="90">Fecha</th>
                <th width="90">Instancia asociada</th>
            </tr>';
        foreach ($estados->result() as $fila) {

            //Obtenemos el nombre del estado
            $nombre_estado = $this->Estado->obtener_nombre_estado_por_id($fila->estado);

            if($fila->instancia_relacion == 0)
            {
                $instancia_asociada = NULL;
            }
            else
            {
                $instancia = $this->instancia_dispositivo->obtener_instancia_dispositivo($fila->instancia_relacion);
                $instancia_asociada = $instancia->id.' // '.$instancia->part_number.' // '.$instancia->num_serie;;
            }

$rpta .= '   <tr>
                <td width="90">'.$fila->instancia_material.'</td>
                <td width="90">'.$fila->part_number.'</td>
                <td width="90">'.$fila->num_serie.'</td>
                <td width="90">'.$nombre_estado.'</td>
                <td width="90">'.$fila->fecha.'</td>
                <td width="90">'.$instancia_asociada.'</td>
            </tr>';
        }
$rpta .='</table>';

echo $rpta;
    }
}