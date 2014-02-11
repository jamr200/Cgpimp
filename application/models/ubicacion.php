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

class Ubicacion extends DataMapper {

	var $table = 'ubicaciones';
	var $has_one = array('instancia_material','edificio','habitacion','mueble','balda','instancia_dispositivo');

    function __construct($id = NULL)
	{
		parent::__construct($id);
    }

    //Método para almacenar la ubicacion en la BD
    function set_ubicacion($ubicacion)
    {//Comprobamos que la ubicacion no se encuentra almacenada
    	$consulta = $this->db->get_where('ubicaciones',array('id_instancia_material' => $ubicacion->id_instancia_material));
    	if($consulta->num_rows() === 0)
    	{//Como NO esta almacenada, la guardamos
    		$ubicacion->save();
    		if($this->db->affected_rows() === 1)
    		{//la hemos almacenado y devolvemos true
    			return TRUE;
    		}
    		else
    		{//No se ha almacenado porque hay error
    			return 0;
    		}
    	}//Ya se encuentra en la BD y por tanto devolvemos FALSE
    	return FALSE;
    }

    //Funcion para eliminar la ubicacion de una instancia dada
    function unset_ubicacion($id_instancia)
    {//eliminamos la persona de la BD
        $this->db->delete('ubicaciones', array('id_instancia_material' => $id_instancia));
        if($this->db->affected_rows() == 0)
        {
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    //Funcion para eliminar la ubicacion
    function unset_ubicacion2($id_ubicacion)
    {//eliminamos la persona de la BD
        $this->db->delete('ubicaciones', array('id_ubicacion' => $id_ubicacion));
        if($this->db->affected_rows() == 0)
        {
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    //Funcion para obtener los datos de una ubicacion a partir de su id
    function obtener_ubicacion($id)
    {
        $ubicacion = new Ubicacion();
        $ubicacion->get_by_id_ubicacion($id);
        return $ubicacion;
    }

    //Para obtener todos los registros de nuestra tabla
    function getNumUbicaciones()
    {
        return $this->db->count_all('ubicaciones');
    }

    //para obtener todos los registros que se encuentran con los parametros indicados
    function getNumUbicaciones2($datos)
    {
        //Capturo los datos
        $edificio = $datos['edificio'];
        $habitacion = $datos['habitacion'];
        $mueble = $datos['mueble'];
        $balda = $datos['balda'];

        //////////////////////
        //Genero mi consulta//
        //////////////////////

        $this->db->select('edi.nombre_edificio, hab.nombre_habitacion,mue.nombre_mueble,bal.nombre_balda,inst.id,inst.part_number,inst.num_serie');
        $this->db->from('ubicaciones as ubi');
        $this->db->join('edificios as edi', 'edi.id = ubi.id_edificio');
        $this->db->join('habitaciones as hab','hab.id = ubi.id_habitacion');
        $this->db->join('muebles as mue','mue.id = ubi.id_mueble');
        $this->db->join('baldas as bal','bal.id = ubi.id_balda');
        $this->db->join('instancias_materiales as inst','inst.id = ubi.id_instancia_material');

        if(!empty($edificio))
        {//Existe la variable
            if(!empty($habitacion))
            {//Existe la variable
                if(!empty($mueble))
                {//Existe la variable
                    if(!empty($balda))
                    {//Existe la variable
                        $this->db->where('id_edificio',$edificio);
                        $this->db->where('id_habitacion',$habitacion);
                        $this->db->where('id_mueble',$mueble);
                        $this->db->where('id_balda',$balda);
                    }
                    else
                    {
                        $this->db->where('id_edificio',$edificio);
                        $this->db->where('id_habitacion',$habitacion);
                        $this->db->where('id_mueble',$mueble);
                    }
                }
                else
                {
                    $this->db->where('id_edificio',$edificio);
                    $this->db->where('id_habitacion',$habitacion);
                }
            }
            else
            {
                $this->db->where('id_edificio',$edificio);
            }
        }

        return $this->db->count_all_results();
    }

    //Lo uso en las busquedas(para listados paginados)
    function busca_ubicacion($datos, $limit, $start)
    {
        //Capturo los datos
        $edificio = $datos['edificio'];
        $habitacion = $datos['habitacion'];
        $mueble = $datos['mueble'];
        $balda = $datos['balda'];

        //////////////////////
        //Genero mi consulta//
        //////////////////////

        $this->db->select('ubi.id_ubicacion,edi.nombre_edificio, hab.nombre_habitacion,mue.nombre_mueble,bal.nombre_balda,inst.id,inst.part_number,inst.num_serie');
        $this->db->from('ubicaciones as ubi');
        $this->db->join('edificios as edi', 'edi.id = ubi.id_edificio');
        $this->db->join('habitaciones as hab','hab.id = ubi.id_habitacion');
        $this->db->join('muebles as mue','mue.id = ubi.id_mueble');
        $this->db->join('baldas as bal','bal.id = ubi.id_balda');
        $this->db->join('instancias_materiales as inst','inst.id = ubi.id_instancia_material');

        if(!empty($edificio))
        {//Existe la variable
            if(!empty($habitacion))
            {//Existe la variable
                if(!empty($mueble))
                {//Existe la variable
                    if(!empty($balda))
                    {//Existe la variable
                        $this->db->where('id_edificio',$edificio);
                        $this->db->where('id_habitacion',$habitacion);
                        $this->db->where('id_mueble',$mueble);
                        $this->db->where('id_balda',$balda);
                    }
                    else
                    {
                        $this->db->where('id_edificio',$edificio);
                        $this->db->where('id_habitacion',$habitacion);
                        $this->db->where('id_mueble',$mueble);
                    }
                }
                else
                {
                    $this->db->where('id_edificio',$edificio);
                    $this->db->where('id_habitacion',$habitacion);
                }
            }
            else
            {
                $this->db->where('id_edificio',$edificio);
            }
        }

        $this->db->order_by("inst.id","ASC");
        $this->db->limit($limit,$start);

        //////////////////////
        //Fin de mi consulta//
        //////////////////////

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

    //Lo uso en las busquedas (para los pdf's)
    function busca_ubicacion2($datos)
    {
        //Capturo los datos
        $edificio = $datos['edificio'];
        $habitacion = $datos['habitacion'];
        $mueble = $datos['mueble'];
        $balda = $datos['balda'];

        //////////////////////
        //Genero mi consulta//
        //////////////////////

        $this->db->select('edi.nombre_edificio, hab.nombre_habitacion,mue.nombre_mueble,bal.nombre_balda,inst.id,inst.part_number,inst.num_serie');
        $this->db->from('ubicaciones as ubi');
        $this->db->join('edificios as edi', 'edi.id = ubi.id_edificio');
        $this->db->join('habitaciones as hab','hab.id = ubi.id_habitacion');
        $this->db->join('muebles as mue','mue.id = ubi.id_mueble');
        $this->db->join('baldas as bal','bal.id = ubi.id_balda');
        $this->db->join('instancias_materiales as inst','inst.id = ubi.id_instancia_material');

        if(!empty($edificio))
        {//Existe la variable
            if(!empty($habitacion))
            {//Existe la variable
                if(!empty($mueble))
                {//Existe la variable
                    if(!empty($balda))
                    {//Existe la variable
                        $this->db->where('id_edificio',$edificio);
                        $this->db->where('id_habitacion',$habitacion);
                        $this->db->where('id_mueble',$mueble);
                        $this->db->where('id_balda',$balda);
                    }
                    else
                    {
                        $this->db->where('id_edificio',$edificio);
                        $this->db->where('id_habitacion',$habitacion);
                        $this->db->where('id_mueble',$mueble);
                    }
                }
                else
                {
                    $this->db->where('id_edificio',$edificio);
                    $this->db->where('id_habitacion',$habitacion);
                }
            }
            else
            {
                $this->db->where('id_edificio',$edificio);
            }
        }

        $this->db->order_by("inst.id","ASC");

        //////////////////////
        //Fin de mi consulta//
        //////////////////////

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

    //Lo uso en los listados (para listados paginados)
    function lista_ubicaciones($limit, $start)
    {
        $this->db->select('ubi.id_ubicacion, edificios.nombre_edificio, habitaciones.nombre_habitacion, muebles.nombre_mueble, baldas.nombre_balda, instancias_materiales.id, instancias_materiales.part_number, instancias_materiales.num_serie');
        $this->db->from('ubicaciones as ubi');
        $this->db->join('edificios','edificios.id = ubi.id_edificio');
        $this->db->join('habitaciones','habitaciones.id = ubi.id_habitacion');
        $this->db->join('muebles','muebles.id = ubi.id_mueble'); 
        $this->db->join('baldas','baldas.id = ubi.id_balda'); 
        $this->db->join('instancias_materiales','instancias_materiales.id = ubi.id_instancia_material'); 
        $this->db->order_by("ubi.id_ubicacion","ASC");
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

    //Lo uso en los listados (para los pdf's)
    function lista_ubicaciones2()
    {
        $this->db->select('ubi.id_ubicacion, edificios.nombre_edificio, habitaciones.nombre_habitacion, muebles.nombre_mueble, baldas.nombre_balda, instancias_materiales.id, instancias_materiales.part_number, instancias_materiales.num_serie');
        $this->db->from('ubicaciones as ubi');
        $this->db->join('edificios','edificios.id = ubi.id_edificio');
        $this->db->join('habitaciones','habitaciones.id = ubi.id_habitacion');
        $this->db->join('muebles','muebles.id = ubi.id_mueble');
        $this->db->join('baldas','baldas.id = ubi.id_balda');
        $this->db->join('instancias_materiales','instancias_materiales.id = ubi.id_instancia_material'); 
        $this->db->order_by("ubi.id_ubicacion","ASC");

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

    public function muestra_ubicacion_instancia($id)
    {
        $rpta = "";
        //hago una consulta a la base de datos para obtener los datos de la ubicacion a partir de su id
        $ubicacion = $this->db->get_where('ubicaciones',array('id_instancia_material'=>$id));

        if($ubicacion->num_rows() > 0)
        {
            $part_number = $this->Instancia_material->obtener_part_number_por_id($id);
            $num_serie = $this->Instancia_material->obtener_num_serie_por_id($id);

            foreach ($ubicacion->result() as $fila)
            {
                //transformo cada valor a su nombre

                //Convertimos el id del edificio a su nombre para mostarlo
                $nombre_edificio = $this->Edificio->obtener_nombre_edificio_por_id($fila->id_edificio);

                //Convertimos el id de la habitacion a su nombre para mostarlo
                $nombre_habitacion = $this->Habitacion->obtener_nombre_habitacion_por_id($fila->id_habitacion);

                //Convertimos el id del mueble a su nombre para mostarlo
                $nombre_mueble = $this->Mueble->obtener_nombre_mueble_por_id($fila->id_mueble);

                //Convertimos el id de la balda a su nombre para mostarlo
                $nombre_balda = $this->balda->obtener_nombre_balda_por_id($fila->id_balda);

                $rpta .= '
                <form id="muestraubicacion" method="POST">
                    <fieldset>
                    <legend>Información de ubicación para la instancia de material con id = '.$id.' </legend>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nombre_edificio">Edificio</label>:'.$nombre_edificio .'
                            </div>
                        </div>
                        <!-- ************************-->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nombre_habitacion">Habitación</label>:'.$nombre_habitacion .'
                            </div>
                        </div>
                        <!-- ************************-->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nombre_mueble">Mueble</label>:'.$nombre_mueble .'
                            </div>
                        </div>
                        <!-- ************************-->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nombre_balda">Balda</label>:'.$nombre_balda .'
                            </div>
                        </div>
                        <!-- ************************-->
                        <div class="col-md-12">
                            <div class="form-group">
                                <a href="encontrar_ubicacion" class="btn btn-default">Cancelar</a>
                            </div>
                        </div>
                        <!-- ************************-->
                    </fieldset>
                </form>';
            }
        }
        else
        {
            //Aqui podemos decir la instancia de dispositivo donde se encuentra instalada
            $id_inst_dispositivo = $this->Instancia_material->obtener_inst_dispositivo($id);
            $instancia_dispositivo = $this->Instancia_dispositivo->obtener_instancia_dispositivo($id_inst_dispositivo);
            $rpta .= '<h4>El material elegido se encuentra instalado en el dispositivo con id <strong>'.$instancia_dispositivo->id.'</strong>, part number <strong>'.$instancia_dispositivo->part_number.'</strong> y número de serie <strong>'.$instancia_dispositivo->num_serie.'</strong>.</h4>';
        }
        echo $rpta;
    }
}

/* End of file ubicacion.php */
/* Location: ./application/models/ubicacion.php */