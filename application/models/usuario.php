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

class Usuario extends DataMapper {

	var $table = 'usuarios';

    function __construct($id = NULL)
	{
		parent::__construct($id);
    }

    //Funcion para almacenar un usuario nuevo en la base de datos
    function set_usuario($usuario)
    {//comprobamos que el usuario no se encuentra almacenado
    	$consulta = $this->db->get_where('usuarios',array('email' => $usuario->email));
    	if($consulta->num_rows() === 0)
    	{//Como NO esta almacenado, lo guardamos
    		//antes encriptamos la contraseña
    		$usuario->password = md5($usuario->password);
    		$usuario->save();
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

    //Funcion para almacenar una nueva contraseña en la base de datos
    function set_password($password)
    {//comprobamos que el usuario no se encuentra almacenado
        $consulta = $this->db->get_where('usuarios',array('email' => 'nuevas.tecnologias@velezmalaga.es'));
        if($consulta->num_rows() === 1)
        {//Como está almacenado, lo modificamos
            //antes encriptamos la contraseña
            $data = array(
                    'password' => md5($password)
                );
            $this->db->where('id', 1);
            $this->db->update('usuarios', $data);
            return TRUE;
        }
        return FALSE;
    }

    function login($usuario)
    {
    	$usuario->password = md5($usuario->password);
    	$consulta = $this->db->get_where('usuarios',array('email' => $usuario->email,'password' => $usuario->password));
    	if($consulta->num_rows() == 1)
    	{
    		return TRUE;
    	}
    	else
    	{
    		return FALSE;
    	}
    }

    function obtener_usuario($usuario)
    {
        $usuario->password = md5($usuario->password);
        $consulta = $this->db->get_where('usuarios',array('email' => $usuario->email,'password' => $usuario->password));
        if($consulta->num_rows() == 1)
        {
            foreach($consulta->result() as $fila)
            {
                $data = array(
                    'id' => $fila->id,
                    'nombre' => $fila->username,
                    'apellidos' => $fila->surname,
                    'email' => $fila->email
                    );
            }
            return $data;
        }
        else
        {
            return FALSE;
        }
    }

    function obtener_password()
    {
        $usuario = new Usuario();
        $usuario->get_by_id(1);
        return $usuario->password;
    }
}

/* End of file usuario.php */
/* Location: ./application/models/usuario.php */