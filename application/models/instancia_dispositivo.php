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

class Instancia_dispositivo extends DataMapper {

	var $table = 'instancias_dispositivos';

	var $has_one = array('departamento','dispositivo','pedido','estado');

    var $has_many = array('secuencia_estado');

    function __construct($id = NULL)
	{
		parent::__construct($id);
    }

    //Funcion para almacenar una instancia de un dispositivo en la base de datos
    function set_instancia_dispositivo($instancia_dispositivo)
    {
        //comprobamos que exista el dispositivo
        if($instancia_dispositivo->dispositivo === 0)
        {
            return 0;
        }
        //comprobamos que la instancia no se encuentra almacenada
        $consulta = $this->db->get_where('instancias_dispositivos',array('id' => $instancia_dispositivo->id,'part_number' => $instancia_dispositivo->part_number,'num_serie' => $instancia_dispositivo->num_serie));
        if($consulta->num_rows() === 0)
        {//Como NO esta almacenada, la guardamos
            $instancia_dispositivo->save();
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

    //funcion para obtener el id de la ultima instancia
    function obtener_id_ultima_instancia()
    {
        $instancia = new Instancia_dispositivo();
        $instancia->select_max('id');
        $instancia->get();
        return $instancia->id;
    }

    function getNumInstancias($datos)
    {
        //Capturo los datos
        $tipo = $datos['tipo_dispositivo'];
        $marca = $datos['marca_dispositivo'];
        $modelo = $datos['modelo_dispositivo'];
        $departamento = $datos['departamento'];
        $estado = $datos['estado'];
        $fecha_ini = $datos['fecha_ini'];
        $fecha_fin = $datos['fecha_fin'];

        //////////////////////
        //Genero mi consulta//
        //////////////////////

        $this->db->select('tipos_dispositivos.nombre_tipo_dispositivo, marcas.nombre_marca, modelos.nombre_modelo, inst.part_number, inst.num_serie, inst.fecha_compra, departamentos.nombre_departamento, estados.nombre_estado');
        $this->db->from('instancias_dispositivos as inst');
        $this->db->join('dispositivos as disp2', 'disp2.id = inst.dispositivo');
        $this->db->join('departamentos','departamentos.id = inst.departamento');
        $this->db->join('tipos_dispositivos','tipos_dispositivos.id = disp2.tipo_dispositivo');
        $this->db->join('marcas','marcas.id = disp2.marca');
        $this->db->join('modelos','modelos.id = disp2.modelo');
        $this->db->join('estados','estados.id = inst.estado_actual');

        if(!empty($tipo))
        {//Existe la variable
            if(!empty($marca))
            {//Existe la variable
                if(!empty($modelo))
                {//Existe la variable
                    //Debo de obtener el dispositivo y hacer where con el campo dispositivo de mi tabla instancias dispositivos
                    $dispositivo = $this->Dispositivo->obtener_id_dispositivo2($tipo,$marca,$modelo);
                    $this->db->where('dispositivo',$dispositivo);
                }
                else
                {
                    //Hago consulta con tipo y marca
                    $this->db->join('dispositivos', 'dispositivos.id = inst.dispositivo');
                    $this->db->where('dispositivos.tipo_dispositivo',$tipo);
                    $this->db->where('dispositivos.marca',$marca);
                }
            }
            else
            {
                //Hago consulta con tipo
                $this->db->join('dispositivos', 'dispositivos.id = inst.dispositivo');
                $this->db->where('dispositivos.tipo_dispositivo',$tipo);
            }
        }

        if(!empty($departamento))
        {//Existe la variable y hago consulta teniendo en cuenta el departamento
            $this->db->where('departamento',$departamento);
        }
        if(!empty($estado))
        {//Existe la variable y hago consulta teniendo en cuenta el estado
            $this->db->where('estado_actual',$estado);
        }
        if(!empty($fecha_ini))
        {//Existe la variable y hago consulta teniendo en cuenta la fecha
            if(!empty($fecha_fin))
            {
                //Comparamos con el rango de fechas
                $this->db->where('fecha_compra >=',$fecha_ini);
                $this->db->where('fecha_compra <=',$fecha_fin);
            }
            else
            {
                $this->db->where('fecha_compra >=',$fecha_ini);
            }

        }
        else
        {
            if(!empty($fecha_fin))
            {
                //limitamos al fin
                $this->db->where('fecha_compra <=',$fecha_fin);
            }
        }
        return $this->db->count_all_results();
    }

    function busca_instancia_dispositivo($datos, $limit, $start)
    {
        //Capturo los datos
        $tipo = $datos['tipo_dispositivo'];
        $marca = $datos['marca_dispositivo'];
        $modelo = $datos['modelo_dispositivo'];
        $departamento = $datos['departamento'];
        $estado = $datos['estado'];
        $fecha_ini = $datos['fecha_ini'];
        $fecha_fin = $datos['fecha_fin'];

        //////////////////////
        //Genero mi consulta//
        //////////////////////

        $this->db->select('tipos_dispositivos.nombre_tipo_dispositivo, marcas.nombre_marca, modelos.nombre_modelo, inst.id ,inst.part_number, inst.num_serie, inst.fecha_compra, departamentos.nombre_departamento, estados.nombre_estado');
        $this->db->from('instancias_dispositivos as inst');
        $this->db->join('dispositivos as disp2', 'disp2.id = inst.dispositivo');
        $this->db->join('departamentos','departamentos.id = inst.departamento');
        $this->db->join('tipos_dispositivos','tipos_dispositivos.id = disp2.tipo_dispositivo');
        $this->db->join('marcas','marcas.id = disp2.marca');
        $this->db->join('modelos','modelos.id = disp2.modelo');
        $this->db->join('estados','estados.id = inst.estado_actual');

        if(!empty($tipo))
        {//Existe la variable
            if(!empty($marca))
            {//Existe la variable
                if(!empty($modelo))
                {//Existe la variable
                    //Debo de obtener el dispositivo y hacer where con el campo dispositivo de mi tabla instancias dispositivos
                    $dispositivo = $this->Dispositivo->obtener_id_dispositivo2($tipo,$marca,$modelo);
                    $this->db->where('dispositivo',$dispositivo);
                }
                else
                {
                    //Hago consulta con tipo y marca
                    $this->db->join('dispositivos', 'dispositivos.id = inst.dispositivo');
                    $this->db->where('dispositivos.tipo_dispositivo',$tipo);
                    $this->db->where('dispositivos.marca',$marca);
                }
            }
            else
            {
                //Hago consulta con tipo
                $this->db->join('dispositivos', 'dispositivos.id = inst.dispositivo');
                $this->db->where('dispositivos.tipo_dispositivo',$tipo);
            }
        }

        if(!empty($departamento))
        {//Existe la variable y hago consulta teniendo en cuenta el departamento
            $this->db->where('departamento',$departamento);
        }
        if(!empty($estado))
        {//Existe la variable y hago consulta teniendo en cuenta el estado
            $this->db->where('estado_actual',$estado);
        }
        if(!empty($fecha_ini))
        {//Existe la variable y hago consulta teniendo en cuenta la fecha
            if(!empty($fecha_fin))
            {
                //Comparamos con el rango de fechas
                $this->db->where('fecha_compra >=',$fecha_ini);
                $this->db->where('fecha_compra <=',$fecha_fin);
            }
            else
            {
                $this->db->where('fecha_compra >=',$fecha_ini);
            }

        }
        else
        {
            if(!empty($fecha_fin))
            {
                //limitamos al fin
                $this->db->where('fecha_compra <=',$fecha_fin);
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
        }else
        {

            return $dd='no hay datos';
        }
    }

    function lista_instancia_dispositivos($datos)
    {
        //Capturo los datos
        $tipo = $datos['tipo_dispositivo'];
        $marca = $datos['marca_dispositivo'];
        $modelo = $datos['modelo_dispositivo'];
        $departamento = $datos['departamento'];
        $estado = $datos['estado'];
        $fecha_ini = $datos['fecha_ini'];
        $fecha_fin = $datos['fecha_fin'];

        //////////////////////
        //Genero mi consulta//
        //////////////////////

        $this->db->select('tipos_dispositivos.nombre_tipo_dispositivo, marcas.nombre_marca, modelos.nombre_modelo, inst.id, inst.part_number, inst.num_serie, inst.fecha_compra, inst.garantia, departamentos.nombre_departamento, estados.nombre_estado');
        $this->db->from('instancias_dispositivos as inst');
        $this->db->join('dispositivos as disp2', 'disp2.id = inst.dispositivo');
        $this->db->join('departamentos','departamentos.id = inst.departamento');
        $this->db->join('tipos_dispositivos','tipos_dispositivos.id = disp2.tipo_dispositivo');
        $this->db->join('marcas','marcas.id = disp2.marca');
        $this->db->join('modelos','modelos.id = disp2.modelo');
        $this->db->join('estados','estados.id = inst.estado_actual');

        if(!empty($tipo))
        {//Existe la variable
            if(!empty($marca))
            {//Existe la variable
                if(!empty($modelo))
                {//Existe la variable
                    //Debo de obtener el dispositivo y hacer where con el campo dispositivo de mi tabla instancias dispositivos
                    $dispositivo = $this->Dispositivo->obtener_id_dispositivo2($tipo,$marca,$modelo);
                    $this->db->where('dispositivo',$dispositivo);
                }
                else
                {
                    //Hago consulta con tipo y marca
                    $this->db->join('dispositivos', 'dispositivos.id = inst.dispositivo');
                    $this->db->where('dispositivos.tipo_dispositivo',$tipo);
                    $this->db->where('dispositivos.marca',$marca);
                }
            }
            else
            {
                //Hago consulta con tipo
                $this->db->join('dispositivos', 'dispositivos.id = inst.dispositivo');
                $this->db->where('dispositivos.tipo_dispositivo',$tipo);
            }
        }

        if(!empty($departamento))
        {//Existe la variable y hago consulta teniendo en cuenta el departamento
            $this->db->where('departamento',$departamento);
        }
        if(!empty($estado))
        {//Existe la variable y hago consulta teniendo en cuenta el estado
            $this->db->where('estado_actual',$estado);
        }
        if(!empty($fecha_ini))
        {//Existe la variable y hago consulta teniendo en cuenta la fecha
            if(!empty($fecha_fin))
            {
                //Comparamos con el rango de fechas
                $this->db->where('fecha_compra >=',$fecha_ini);
                $this->db->where('fecha_compra <=',$fecha_fin);
            }
            else
            {
                $this->db->where('fecha_compra >=',$fecha_ini);
            }

        }
        else
        {
            if(!empty($fecha_fin))
            {
                //limitamos al fin
                $this->db->where('fecha_compra <=',$fecha_fin);
            }
        }

        //////////////////////
        //Fin de mi consulta//
        //////////////////////

        //Obtengo los datos de la BD
        $query = $this->db->get();


        if ($query->num_rows() > 0)
        {
            return $query->result();
        }else
        {
            return $dd='no hay datos';
        }
    }

    //Funcion para actualizar instancia de la BD
    function update_instancia_dispositivo($array,$id)
    {
        $this->db->where('id',$id);
        $this->db->update('instancias_dispositivos', $array);
        if($this->db->affected_rows() == 0)
        {
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    //Funcion para obtener los datos de una instancia a partir de su id
    function obtener_instancia_dispositivo($id)
    {
        $instancia = new Instancia_dispositivo();
        $instancia->get_by_id($id);
        return $instancia;
    }

    //metodo para obtener el id de una instancia segun su num_serie y su part_number
    function obtener_id_instancia($part_number,$num_serie)
    {
        $instancia = new Instancia_dispositivo();
        $instancia->where('part_number', $part_number);
        $instancia->where('num_serie', $num_serie);
        $instancia->get();

        if($instancia->exists())
        {
            return $instancia->id;
        }
        else
        {
            return 0;
        }
    }

    //Método para recuperar el dispositivo al que pertenece la instancia
    function obtener_dispositivo_instancia($id)
    {
        $instancia = new Instancia_dispositivo();
        $instancia->where('id', $id);
        $instancia->get();

        if($instancia->exists())
        {
            return $instancia->dispositivo;
        }
    }

    function obtener_instancias_dispositivo($dispositivos)
    {
        $instancias = array();
        foreach ($dispositivos as $dispositivo) {
            $instancia_dispositivo = new Instancia_dispositivo();
            $instancia_dispositivo->get_by_id($dispositivo);
            $data = array('id','part_number','num_serie');
            $instancias = $instancia_dispositivo->all_to_array($data);
        }
        return $instancias;
    }

    function obtener_instancias_asociadas($id)
    {
        $consulta = $this->db->get_where('instancias_dispositivos', array('pedido' => $id));
        $listado = array();
        foreach ($consulta->result() as $row)
        {
           array_push($listado,$row);
        }
        return $listado;
    }

    //funcion para averiguar si se encuentra el num_serie en la base de datos
    function esta_num_serie($num_serie)
    {
    	$consulta = $this->db->get_where('instancias_dispositivos',array('num_serie' => $num_serie));
    	if($consulta->num_rows() === 0)
    	{//el numero de serie no se encuentra en la BD
    		return FALSE;
    	}
    	else
    	{
    		if($this->db->affected_rows() > 0)
    		{//el numero de serie se encuentra en la BD
    			return TRUE;
    		}
    		else
    		{//Error en la BD (num_serie incorrecto)
    			return 0;
    		}
    	}
    }

    function esta_part_number($part_number)
    {
    	$consulta = $this->db->get_where('instancias_dispositivos',array('part_number' => $part_number));
    	if($consulta->num_rows() === 0)
    	{//el part_number no se encuentra en la BD
    		return FALSE;
    	}
    	else
    	{
    		if($this->db->affected_rows() > 0)
    		{//el part_number se encuentra en la BD
    			return TRUE;
    		}
    		else
    		{//Error en la BD (part_number incorrecto)
    			return 0;
    		}
    	}
    }

    //Metodo para obtener la instancia de material con que se encuentra relacionada una instancia de dispositivo
    function obtener_inst_material($id)
    {
        $instancia = new Instancia_dispositivo();
        $instancia->where('id', $id);
        $instancia->get();

        if($instancia->exists())
        {
            return $instancia->instancia_material;
        }
    }

//funcion para mostrar una tabla con las instancias de dispositivos existentes
    public function muestra_tabla_instancias_dispositivos($id_dispositivo)
    {
        $rpta = "";
        //hago una consulta a la base de datos para obtener las instancias en funcion del id de dispositivo dado

        if($id_dispositivo > 0)
        {
            $instancias = $this->db->get_where('instancias_dispositivos',array('dispositivo'=>$id_dispositivo));

            if($instancias->num_rows() === 0)
            {
                $rpta .= '<p class="alert alert-danger" style="margin: 1px;">No existen instancias para ese dispositivo</p>';
            }
            else
            {
                if($instancias->num_rows() > 0)
                {
                    $rpta .='<table class="table table-bordered table-striped">
                                <tr>
                                    <th>Seleccionar</th>
                                    <th>Part number</th>
                                    <th>Número de serie</th>
                                    <th>fecha de compra</th>
                                    <th>garantía</th>
                                </tr>';
                    foreach ($instancias->result() as $fila)
                    {
                        $rpta .= '<tr>
                                    <td><input type="checkbox" name="borrar[' .$fila->id. ']" value="' .$fila->id. '"></td>
                                    <td>'.$fila->part_number.'</td>
                                    <td>'.$fila->num_serie.'</td>
                                    <td>'.$fila->fecha_compra.'</td>
                                    <td>'.$fila->garantia.'</td>
                                    </tr>';
                    }
                    $rpta .= '</table>';
                }
            }
        }
        else
        {
            $rpta .= '<p class="alert alert-danger" style="margin: 1px;">Ese dispositivo no esta dado de alta</p>';
        }

        echo $rpta;
    }

    //funcion para mostrar un select con las instancias de dispositivos existentes con un id determinado
    public function muestra_combo_instancia($id_dispositivo)
    {
        $rpta ='<option value=""></option>';
        //hago una consulta a la base de datos para obtener las instancias del dispositivo seleccionado
        $instancias = $this->db->get_where('instancias_dispositivos',array('dispositivo'=>$id_dispositivo));

        foreach ($instancias->result() as $fila)
        {
            $rpta.= '<option value="' . $fila->id .'">' . $fila->id . ' // '. $fila->part_number . ' // ' . $fila->num_serie . '</option>';
        }
        echo $rpta;
    }


    //funcion para mostrar un select con las instancias de dispositivos existentes
    public function muestra_instancia_en_asociar($id_dispositivo)
    {
        $rpta='<option value=""></option>';
        //hago una consulta a la base de datos para obtener las instancias del material seleccionado
        $instancias = $this->db->get_where('instancias_dispositivos',array('dispositivo'=>$id_dispositivo, 'relacionado'=>'no'));

        foreach ($instancias->result() as $fila)
        {
            $rpta.= '<option value="' . $fila->id .'">' . $fila->id . ' // ' . $fila->part_number . ' // ' . $fila->num_serie . '</option>';
        }
        echo $rpta;
    }

    //funcion para mostrar un select con las instancias de dispositivos asociadas
    public function muestra_instancia_en_desasociar($id_dispositivo)
    {
        $rpta='<option value=""></option>';
        //hago una consulta a la base de datos para obtener las instancias del material seleccionado
        $instancias = $this->db->get_where('instancias_dispositivos',array('dispositivo'=>$id_dispositivo, 'relacionado'=>'si'));

        foreach ($instancias->result() as $fila)
        {
            $rpta.= '<option value="' . $fila->id .'">' . $fila->id . ' // ' . $fila->part_number . ' // ' . $fila->num_serie . '</option>';
        }
        echo $rpta;
    }

    //funcion para mostrar el formulario con la instancia de dispositivo a modificar
    public function muestra_modifica_instancia_dispositivo($id)
    {
        $rpta = "";
        //hago una consulta a la base de datos para obtener los datos de la instancia a partir de su id
        $instancia = $this->db->get_where('instancias_dispositivos',array('id'=>$id));

        foreach ($instancia->result() as $fila) {
            //Convertimos el id del departamento a su nombre pra mostarlo
            $nombre_dep = $this->Departamento->obtener_nombre_departamento_por_id($fila->departamento);

            //En $dep meto todos los departamentos menos el obtenido de la BD
            $dep = $this->Departamento->obtener_nombre_departamentos_menos_uno($fila->departamento);

            //Convertimos el id del pedido a su nombre pra mostarlo
            $nombre_ped = $this->Pedido->obtener_nombre_pedido_por_id($fila->pedido);

            //En $pedido meto todos los pedidos menos el obtenido de la BD
            $pedido = $this->Pedido->obtener_nombre_pedidos_menos_uno($fila->pedido);

            //Convertimos el id del estado_actual a su nombre pra mostarlo
            $nombre_estado = $this->Estado->obtener_nombre_estado_por_id($fila->estado_actual);

            //En $estado meto todos los estados menos el obtenido de la BD
            $estado = $this->Estado->obtener_nombre_estados_menos_uno($fila->estado_actual);

            $rpta .= '
            <form id="update2instdispositivo" action="'.base_url().'dispositivo_controller/updateInstanciaDispositivo" method="POST">
                <fieldset>
                <legend>Información de Instancia</legend>
                <!-- ************************-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="part_number">Part Number</label>
                            <input type="text" class="form-control" id="part_number" name="part_number" value="'. $fila->part_number . '" placeholder="Part_number">
                        </div>
                    </div>
                    <!-- ************************-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="num_serie">Número de Serie</label>
                            <input type="text" class="form-control" id="num_serie" name="num_serie" value="' . $fila->num_serie . '" placeholder="Num_serie">
                        </div>
                    </div>
                    <!-- ************************-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="fecha">Fecha</label>
                            <input type="date" class="form-control" id="fecha" name="fecha" value="' . $fila->fecha_compra . '" placeholder="Fecha">
                        </div>
                    </div>
                    <!-- ************************-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="garantia">Garantía</label>
                            <input type="text" class="form-control" id="garantia" name="garantia" value="' . $fila->garantia . '" placeholder="Garantia">
                        </div>
                    </div>
                    <!-- ************************-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="pedido">Pedido</label>
                            <select class="form-control" id="pedido" name="pedido">
                                <option value="'.$fila->pedido.'">'.$nombre_ped.'</option>';
                                foreach ($pedido as $ped)
                                {
                                    $rpta .= '<option value="'.$ped['id'].'">'.$ped['nombre_pedido'].'</option>';
                                }
                    $rpta .='</select>
                        </div>
                    </div>
                    <!-- ************************-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="departamento">Departamento</label>
                            <select class="form-control" id="departamento" name="departamento">
                                <option value="'.$fila->departamento.'">'.$nombre_dep.'</option>';
                                foreach ($dep as $d)
                                {
                                    $rpta .= '<option value="'.$d['id'].'">'.$d['nombre_departamento'].'</option>';
                                }
                    $rpta .='</select>
                        </div>
                    </div>
                    <!-- ************************-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="estado_actual">Estado</label>
                                <select class="form-control" id="estado_actual" name="estado_actual">
                                    <option value="'.$fila->estado_actual.'">'.$nombre_estado.'</option>';
                                    foreach ($estado as $est)
                                    {
                                        $rpta .= '<option value="'.$est['id'].'">'.$est['nombre_estado'].'</option>';
                                    }
                        $rpta .='</select>
                        </div>
                    </div>
                    <!-- ************************-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="hidden" id="id_inst_dispositivo" name="id_inst_dispositivo" value="'.$id.'">
                        </div>
                    </div>
                    <!-- ************************-->
                    <div class="col-md-8">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a href="modificar_instancia_dispositivo" class="btn btn-default">Cancelar</a>
                        </div>
                    </div>
                    <!-- ************************-->
                </fieldset>
            </form>
            <!--JQuery para usar select 2 -->
            <script>
                $(document).ready(function(){
                    $("#pedido").select2();
                    $("#departamento").select2();
                    $("#estado_actual").select2();
                });
            </script>
            <!-- Validacion de instancias desde el cliente-->
            <script type="text/javascript">
                $(document).ready(function(){
                    $("#update2instdispositivo").validate({
                        errorElement: "span",
                        errorClass: "help-block",
                        rules:
                        {
                            part_number: {required: true, rangelength: [3,45]},
                            num_serie: {required: true, rangelength: [3,45]},
                            fecha: {date:true},
                            garantia: {},
                            pedido: {required: true},
                            departamento: {required: true}
                        },
                        messages:
                        {
                            part_number: "El part number es obligatorio y debe tener al menos 3 caracteres.",
                            num_serie: "El número de serie es obligatorio y debe tener al menos 3 caracteres.",
                            fecha: "La fecha no es correcta."
                        },
                        highlight: function(element)
                        {
                            $(element).closest(".form-group")
                            .removeClass("has-success").addClass("has-error");
                        },
                        success: function(element)
                        {
                            $(element).closest(".form-group")
                            .removeClass("has-error").addClass("has-success");
                        }
                    });
                });
            </script>';
        }
        echo $rpta;
    }
}
/* End of file instancia_dispositivo.php */
/* Location: ./application/models/instancia_dispositivo.php */