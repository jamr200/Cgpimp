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

class Instancia_material extends DataMapper {

	var $table = 'instancias_materiales';
	var $has_one = array('pedido','material','estado');
    var $has_many = array('secuencia_estado');

    function __construct($id = NULL)
	{
		parent::__construct($id);
    }

    //Funcion para almacenar una instancia de un material en la base de datos
    function set_instancia_material($instancia_material)
    {
        //comprobamos que exista el dispositivo
        if($instancia_material->material === 0)
        {
            return 0;
        }

        //comprobamos que la instancia no se encuentra almacenada
    	$consulta = $this->db->get_where('instancias_materiales',array('id' => $instancia_material->id,'part_number' => $instancia_material->part_number,'num_serie' => $instancia_material->num_serie));
    	if($consulta->num_rows() === 0)
    	{//Como NO esta almacenada, la guardamos
    		$instancia_material->save();
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

    //Funcion para actualizar instancia de la BD
    function update_instancia_material($array,$id)
    {
        $this->db->where('id',$id);
        $this->db->update('instancias_materiales', $array);
        if($this->db->affected_rows() == 0)
        {
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    //funcion para obtener el id de la ultima instancia
    function obtener_id_ultima_instancia()
    {
        $instancia = new Instancia_material();
        $instancia->select_max('id');
        $instancia->get();
        return $instancia->id;
    }

    function getNumInstancias($datos)
    {
        //Capturo los datos
        $tipo = $datos['tipo_material'];
        $marca = $datos['marca_material'];
        $modelo = $datos['modelo_material'];
        $estado = $datos['estado'];
        $fecha_ini = $datos['fecha_ini'];
        $fecha_fin = $datos['fecha_fin'];

        //////////////////////
        //Genero mi consulta//
        //////////////////////

        $this->db->select('tipos_materiales.nombre_tipo_material, marcas.nombre_marca, modelos.nombre_modelo, inst.part_number, inst.num_serie, inst.fecha_compra, estados.nombre_estado');
        $this->db->from('instancias_materiales as inst');
        $this->db->join('materiales as mat2', 'mat2.id = inst.material');
        $this->db->join('tipos_materiales','tipos_materiales.id = mat2.tipo_material');
        $this->db->join('marcas','marcas.id = mat2.marca');
        $this->db->join('modelos','modelos.id = mat2.modelo');
        $this->db->join('estados','estados.id = inst.estado_actual');

        if(!empty($tipo))
        {//Existe la variable
            if(!empty($marca))
            {//Existe la variable
                if(!empty($modelo))
                {//Existe la variable
                    //Debo de obtener el dispositivo y hacer where con el campo dispositivo de mi tabla instancias dispositivos
                    $material = $this->Material->obtener_id_material2($tipo,$marca,$modelo);
                    $this->db->where('material',$material);
                }
                else
                {
                    //Hago consulta con tipo y marca
                    $this->db->join('materiales', 'materiales.id = inst.material');
                    $this->db->where('materiales.tipo_material',$tipo);
                    $this->db->where('materiales.marca',$marca);
                }
            }
            else
            {
                //Hago consulta con tipo
                $this->db->join('materiales', 'materiales.id = inst.material');
                $this->db->where('materiales.tipo_material',$tipo);
            }
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

    function busca_instancia_material($datos, $limit, $start)
    {
        //Capturo los datos
        $tipo = $datos['tipo_material'];
        $marca = $datos['marca_material'];
        $modelo = $datos['modelo_material'];
        $estado = $datos['estado'];
        $fecha_ini = $datos['fecha_ini'];
        $fecha_fin = $datos['fecha_fin'];

        //////////////////////
        //Genero mi consulta//
        //////////////////////

        $this->db->select('tipos_materiales.nombre_tipo_material, marcas.nombre_marca, modelos.nombre_modelo, inst.id, inst.part_number, inst.num_serie, inst.fecha_compra, estados.nombre_estado');
        $this->db->from('instancias_materiales as inst');
        $this->db->join('materiales as mat2', 'mat2.id = inst.material');
        $this->db->join('tipos_materiales','tipos_materiales.id = mat2.tipo_material');
        $this->db->join('marcas','marcas.id = mat2.marca');
        $this->db->join('modelos','modelos.id = mat2.modelo');
        $this->db->join('estados','estados.id = inst.estado_actual');

        if(!empty($tipo))
        {//Existe la variable
            if(!empty($marca))
            {//Existe la variable
                if(!empty($modelo))
                {//Existe la variable
                    //Debo de obtener el dispositivo y hacer where con el campo dispositivo de mi tabla instancias dispositivos
                    $material = $this->Material->obtener_id_material2($tipo,$marca,$modelo);
                    $this->db->where('material',$material);
                }
                else
                {
                    //Hago consulta con tipo y marca
                    $this->db->join('materiales', 'materiales.id = inst.material');
                    $this->db->where('materiales.tipo_material',$tipo);
                    $this->db->where('materiales.marca',$marca);
                }
            }
            else
            {
                //Hago consulta con tipo
                $this->db->join('materiales', 'materiales.id = inst.material');
                $this->db->where('materiales.tipo_material',$tipo);
            }
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

    function lista_instancia_materiales($datos)
    {
        //Capturo los datos
        $tipo = $datos['tipo_material'];
        $marca = $datos['marca_material'];
        $modelo = $datos['modelo_material'];
        $estado = $datos['estado'];
        $fecha_ini = $datos['fecha_ini'];
        $fecha_fin = $datos['fecha_fin'];

        //////////////////////
        //Genero mi consulta//
        //////////////////////

        $this->db->select('tipos_materiales.nombre_tipo_material, marcas.nombre_marca, modelos.nombre_modelo, inst.id, inst.part_number, inst.num_serie, inst.fecha_compra, inst.garantia, estados.nombre_estado');
        $this->db->from('instancias_materiales as inst');
        $this->db->join('materiales as mat2', 'mat2.id = inst.material');
        $this->db->join('tipos_materiales','tipos_materiales.id = mat2.tipo_material');
        $this->db->join('marcas','marcas.id = mat2.marca');
        $this->db->join('modelos','modelos.id = mat2.modelo');
        $this->db->join('estados','estados.id = inst.estado_actual');

        if(!empty($tipo))
        {//Existe la variable
            if(!empty($marca))
            {//Existe la variable
                if(!empty($modelo))
                {//Existe la variable
                    //Debo de obtener el dispositivo y hacer where con el campo dispositivo de mi tabla instancias dispositivos
                    $material = $this->Material->obtener_id_material2($tipo,$marca,$modelo);
                    $this->db->where('material',$material);
                }
                else
                {
                    //Hago consulta con tipo y marca
                    $this->db->join('materiales', 'materiales.id = inst.material');
                    $this->db->where('materiales.tipo_material',$tipo);
                    $this->db->where('materiales.marca',$marca);
                }
            }
            else
            {
                //Hago consulta con tipo
                $this->db->join('materiales', 'materiales.id = inst.material');
                $this->db->where('materiales.tipo_material',$tipo);
            }
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

//metodo para obtener el id de una instancia segun su num_serie y su part_number
    function obtener_id_instancia($part_number,$num_serie)
    {
        $instancia = new Instancia_material();
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

    //Funcion para obtener los datos de una instancia a partir de su id
    function obtener_instancia_material($id)
    {
        $instancia = new Instancia_material();
        $instancia->get_by_id($id);
        return $instancia;
    }

    //Funcion para obtener el part number de una instancia a partir de su id
    function obtener_part_number_por_id($id)
    {
        $instancia = new Instancia_material();
        $instancia->get_by_id($id);
        return $instancia->part_number;
    }

    //Funcion para obtener el numero de serie de una instancia a partir de su id
    function obtener_num_serie_por_id($id)
    {
        $instancia = new Instancia_material();
        $instancia->get_by_id($id);
        return $instancia->num_serie;
    }

//Método para recuperar el material al que pertenece la instancia
    function obtener_material_instancia($id)
    {
        $instancia = new Instancia_material();
        $instancia->where('id', $id);
        $instancia->get();

        if($instancia->exists())
        {
            return $instancia->material;
        }
    }

    function obtener_instancias_asociadas($id)
    {
        $consulta = $this->db->get_where('instancias_materiales', array('pedido' => $id));
        $listado = array();
        foreach ($consulta->result() as $row)
        {
           array_push($listado,$row);
        }
        return $listado;
    }
    //Metodo para obtener la instancia de dispositivo con que se encuentra relacionado una instancia de material
    function obtener_inst_dispositivo($id)
    {
        $instancia = new Instancia_material();
        $instancia->where('id', $id);
        $instancia->get();

        if($instancia->exists())
        {
            return $instancia->instancia_dispositivo;
        }
    }

    //Método para ver si el num_serie se encuentra registrado
    function esta_num_serie($num_serie)
    {
    	$consulta = $this->db->get_where('instancias_materiales',array('num_serie' => $num_serie));
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

    //Método para ver si el part_number se encuentra registrado
    function esta_part_number($part_number)
    {
    	$consulta = $this->db->get_where('instancias_materiales',array('part_number' => $part_number));
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

    //Método para mostrar una tabla con las instancias de materiales existentes
    public function muestra_tabla_instancias_materiales($id_material)
    {
        $rpta = "";
        //hago una consulta a la base de datos para obtener las instancias en funcion del id de material dado
        $instancias = $this->db->get_where('instancias_materiales',array('material'=>$id_material));

        if($instancias->num_rows() === 0)
        {
            $rpta .= '<p class="alert alert-error" style="margin: 1px;">No existen instancias para ese material</p>';
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
                            </tr>';
                foreach ($instancias->result() as $fila)
                {
                    $rpta .= '<tr>
                                <td><input type="checkbox" name="borrar[' .$fila->id. ']" value="' .$fila->id. '"></td>
                                <td>'.$fila->part_number.'</td>
                                <td>'.$fila->num_serie.'</td>
                                <td>'.$fila->fecha_compra.'</td>
                                </tr>';
                }
                $rpta .= '</table>';
            }
        }

        echo $rpta;
    }

    //funcion para mostrar un select con las instancias de materiales existentes con un id determinado
    public function muestra_combo_instancia($id_material)
    {
        $rpta='<option value=""></option>';
        //hago una consulta a la base de datos para obtener las instancias del material seleccionado
        $instancias = $this->db->get_where('instancias_materiales',array('material'=>$id_material));

        foreach ($instancias->result() as $fila)
        {
            $rpta.= '<option value="' . $fila->id .'">' . $fila->id . ' // ' . $fila->part_number . ' // ' . $fila->num_serie . '</option>';
        }
        echo $rpta;
    }

    //funcion para mostrar un select con las instancias de materiales existentes
    public function muestra_instancia_en_asociar($id_material)
    {
        $rpta='<option value=""></option>';
        $valor = 0;
        //hago una consulta a la base de datos para obtener las instancias del material seleccionado
        $instancias = $this->db->get_where('instancias_materiales',array('material'=>$id_material, 'instancia_dispositivo'=>$valor));

        foreach ($instancias->result() as $fila)
        {
            $rpta.= '<option value="' . $fila->id .'">' . $fila->id . ' // ' . $fila->part_number . ' // ' . $fila->num_serie . '</option>';
        }
        echo $rpta;
    }

    //funcion para mostrar un select con las instancias de materiales existentes
    public function muestra_instancia_en_desasociar($id_material)
    {
        $rpta='<option value=""></option>';
        $valor = 0;
        //hago una consulta a la base de datos para obtener las instancias del material seleccionado
        $instancias = $this->db->get_where('instancias_materiales',array('material'=>$id_material, 'relacionado'=>'si'));

        foreach ($instancias->result() as $fila)
        {
            $rpta.= '<option value="' . $fila->id .'">' . $fila->id . ' // ' . $fila->part_number . ' // ' . $fila->num_serie . '</option>';
        }
        echo $rpta;
    }

    //funcion para mostrar el formulario con la instancia de material a modificar
    public function muestra_modifica_instancia_material($id)
    {
        $rpta = "";
        //hago una consulta a la base de datos para obtener los datos de la instancia a partir de su id
        $instancia = $this->db->get_where('instancias_materiales',array('id'=>$id));

        foreach ($instancia->result() as $fila) {
            //Convertimos el id del pedido a su nombre pra mostarlo
            $nombre_ped = $this->Pedido->obtener_nombre_pedido_por_id($fila->pedido);

            //En $pedido meto todos los pedidos menos el obtenido de la BD
            $pedido = $this->Pedido->obtener_nombre_pedidos_menos_uno($fila->pedido);

            //Convertimos el id del estado_actual a su nombre pra mostarlo
            $nombre_estado = $this->Estado->obtener_nombre_estado_por_id($fila->estado_actual);

            //En $estado meto todos los estados menos el obtenido de la BD
            $estado = $this->Estado->obtener_nombre_estados_menos_uno($fila->estado_actual);

            $rpta .= '
            <form id="update2instmaterial" action="'.base_url().'material_controller/updateInstanciaMaterial" method="POST">
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
                            <label class="control-label" for="garantia">Garantía</label>
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
                            <input type="hidden" id="id_inst_material" name="id_inst_material" value="'.$id.'">
                        </div>
                    </div>
                    <!-- ************************-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a href="modificar_instancia_material" class="btn btn-default">Cancelar</a>
                        </div>
                    </div>
                    <!-- ************************-->
                </fieldset>
            </form>
            <!--JQuery para usar select 2 -->
            <script>
                $(document).ready(function(){
                    $("#pedido").select2();
                    $("#estado_actual").select2();
                });
            </script>
            <!-- Validacion de instancias desde el cliente -->
            <script>
                $(document).ready(function(){
                    $("#update2instmaterial").validate({
                        errorElement: "span",
                        errorClass: "help-block",
                        rules:
                        {
                            tipo_material:{required: true},
                            marca_material:{required: true},
                            modelo_material:{required: true},
                            part_number: {required: true, rangelength: [3,45]},
                            num_serie: {required: true, rangelength: [3,45]},
                            fecha: {date:true},
                            pedido: {required: true}
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

/* End of file instancia_material.php */
/* Location: ./application/models/instancia_material.php */