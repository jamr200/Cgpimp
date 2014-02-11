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

class Persona extends DataMapper {

	var $table = 'personas';
	var $has_many = array('departamento');

    function __construct($id = NULL)
	{
		parent::__construct($id);
    }

    //Funcion para almacenar una persona en la base de datos
    function set_persona($persona)
    {//comprobamos que la persona no se encuentra almacenada
    	$consulta = $this->db->get_where('personas',array('dni' => $persona->dni));
    	if($consulta->num_rows() === 0)
    	{//Como NO esta almacenada, la guardamos
    		$persona->save();
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
	//Funcion paa eliminar la persona indicada
    function unset_persona($persona)
    {//eliminamos la persona de la BD
        $this->db->delete('personas', array('id' => $persona));
        if($this->db->affected_rows() == 0)
        {
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    //Funcion para actualizar persona de la BD
    function update_persona($array,$id)
    {
        $this->db->where('id',$id);
        $this->db->update('personas', $array);
        if($this->db->affected_rows() == 0)
        {
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    function getNumPersonas()
    {
        return $this->db->count_all('personas');
    }

    //Funcion para listar personas
    function lista_personas($limit, $start)
    {
        $this->db->select('per.id, per.nombre_persona, per.apellido1, per.apellido2, per.dni, per.email, departamentos.nombre_departamento');
        $this->db->from('personas as per');
        $this->db->join('departamentos','departamentos.id = per.departamento');
        $this->db->order_by("per.id","ASC");
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

    function lista_personas2()
    {
        $this->db->select('per.id, per.nombre_persona, per.apellido1, per.apellido2, per.dni, per.email, departamentos.nombre_departamento');
        $this->db->from('personas as per');
        $this->db->join('departamentos','departamentos.id = per.departamento');

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

    //Método para averiguar si el dni está en la BD o no
    function esta_dni($dni)
    {
    	$consulta = $this->db->get_where('personas',array('dni' => $dni));
    	if($consulta->num_rows() === 0)
    	{//el dni no se encuentra en la BD
    		return FALSE;
    	}
    	else
    	{
    		if($this->db->affected_rows() === 1)
    		{//el dni se encuentra en la BD
    			return TRUE;
    		}
    		else
    		{//Error en la BD (dni incorrecto)
    			return 0;
    		}
    	}
    }

    //Funcion para obtener los datos de una persona a partir de su id
    function obtener_persona($id)
    {
        $persona = new Persona();
        $persona->get_by_id($id);
        return $persona;
    }

    //funcion para obtener las personas de la BD
    function obtener_personas($persona)
    {
        $persona->get();
        $datos = array('id','nombre_persona','apellido1','apellido2');
        $personas = $persona->all_to_array($datos);
        return $personas;
    }

    //Funcion para obtener el nombre de una persona dada a partir del id
    //obtener_nombre_persona_por_id($int)
    function obtener_nombre_persona_por_id($id)
    {
        $persona = new Persona();
        $persona->get_by_id($id);
        $nombre = $persona->nombre_persona.' '.$persona->apellido1.' '.$persona->apellido2;
        return $nombre;
    }

    /*//funcion para obtener las personas de la BD
    function obtener_personas2()
    {
        $persona = new Persona();
        $persona->get();
        $datos = array('id','nombre_persona','apellido1','apellido2','dni','email');
        $personas = $persona->all_to_array($datos);
        return $personas;
    }*/

    //funcion que muestra el formulario con los datos de la persona a modificar
    function muestra_combo_persona($id)
    {
        $rpta = "";
        //hago una consulta a la base de datos para obtener los datos de la persona a partir de su id
        $persona = $this->db->get_where('personas',array('id'=>$id));

        foreach ($persona->result() as $fila) {
            //Convertimos el id del departamento a su nombre pra mostarlo
            $nombre_dep = $this->Departamento->obtener_nombre_departamento_por_id($fila->departamento);

            //En $dep meto todos los departamentos menos el obtenido de la BD
            $dep = $this->Departamento->obtener_nombre_departamentos_menos_uno($fila->departamento);

            $rpta .= '
            <form id="update2persona" action="'.base_url().'persona_controller/updatePersona" method="POST">
                <fieldset>
                <legend>Información de Persona</legend>
                    <!-- ************************-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nombre">Nombre: </label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="'. $fila->nombre_persona . '" placeholder="Nombre"><br>
                        </div>
                    </div>
                    <!-- ************************-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="appellido1">Primer apellido: </label>
                            <input type="text" class="form-control" id="apellido1" name="apellido1" value="'.$fila->apellido1.'" placeholder="Apellido1"><br>
                        </div>
                    </div>
                    <!-- ************************-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="apellido2">Segundo apellido: </label>
                            <input type="text" class="form-control" id="apellido2" name="apellido2" value="'.$fila->apellido2.'" placeholder="Apellido2"><br>
                        </div>
                    </div>
                    <!-- ************************-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="dni">DNI: </label>
                            <input type="text" class="form-control" id="dni" name="dni" value="'.$fila->dni.'" placeholder="Dni"><br>
                        </div>
                    </div>
                    <!-- ************************-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="email">Email: </label>
                            <input type="text" class="form-control" id="email" name="email" value="' . $fila->email . '" placeholder="Email"><br>
                        </div>
                    </div>
                    <!-- ************************-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="departamento">Selecciona departamento: </label>
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
                            <label for="jefe">¿Es Jefe?: </label>
                            <select class="form-control" id="jefe" name="jefe">
                                <option value=""></option>
                                <option>no</option>
                                <option>si</option>
                            </select>
                        </div>
                    </div>
                    <!-- ************************-->
                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a href="modificar_persona" class="btn btn-default">Cancelar</a>
                        </div>
                    </div>
                    <!-- ************************-->
                </fieldset>
            </form>
            <!--JQuery para usar select 2 -->
            <script>
                $(document).ready(function(){
                    $("#departamento").select2();
                    $("#jefe").select2();
                });
            </script>
            <!-- Validacion desde lado del cliente -->
            <script>
                $(document).ready(function(){
                    $("#update2persona").validate({
                        errorElement: "span",
                        errorClass: "help-block",
                        rules:
                        {
                            nombre: {required: true, rangelength: [3,20]},
                            apellido1: {required: true, rangelength: [4,30]},
                            apellido2: {required: true, rangelength: [4,30]},
                            dni: {required: true, exactlength: 9},
                            email: {required: true, email: true},
                            departamento: {required: true},
                            jefe: {required: true}
                        },
                        messages:
                        {
                            nombre: "Este campo es obligatorio y debe tener entre 3 y 20 caracteres.",
                            apellido1: "Este campo es obligatorio y debe tener entre 4 y 30 caracteres.",
                            apellido2: "Este campo es obligatorio y debe tener entre 4 y 30 caracteres.",
                            dni: "Este campo es obligatorio y debe tener un formato de DNI correcto.",
                            email : "Este campo es obligatorio y debe tener formato de email correcto."
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

/* End of file persona.php */
/* Location: ./application/models/persona.php */