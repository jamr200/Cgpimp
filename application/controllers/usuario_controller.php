<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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

//Clase para gestionar los Usuarios que se registran para poder usar la aplicación.

class Usuario_controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('Usuario');
	}

	public function index()
	{
	}

//Metodos para redirigirme en el menu a las distintas vistas
//***********************************************************
	public function alta_usuario()
	{
		$this->smarty->view('usuario/alta_usuario');
	}
	//////////////////////////////////////////////////////////////
	public function modificar_usuario()
	{
		$this->smarty->view('usuario/modificar_usuario');
	}
	//////////////////////////////////////////////////////////////
	public function eliminar_usuario()
	{
		$this->smarty->view('usuario/eliminar_usuario');
	}
	//////////////////////////////////////////////////////////////

//Metodo para dar de alta un usuario
	public function addUsuario()
	{
		//validacion desde servidor
		$this->form_validation->set_rules('nombre','Nombre','required|trim|max_length[30]');
		$this->form_validation->set_rules('apellidos','Apellidos','required|trim|max_length[50]');
		$this->form_validation->set_rules('email','Email','required|valid_email|trim|max_length[80]');
		$this->form_validation->set_rules('password','Password','required|trim|max_length[35]');

		//Si el formulario no fue bien
		if(!$this->form_validation->run())
		{//Cargamos la vista
			$this->smarty->view('usuario/alta_usuario');
		}
		else{
			//nos creamos un objeto y metemos los datos que vienen del formulario
			$usuario = new $this->Usuario();

			$usuario->nombre    = $this->input->post('nombre');
			$usuario->apellidos = $this->input->post('apellidos');
			$usuario->email     = $this->input->post('email');
			$usuario->password  = $this->input->post('password');

			if($this->Usuario->set_usuario($usuario))
			{//mostramos un mensaje para dejar claro que ha sido agregado a la BD
				$this->smarty->assign("success", "Usuario almacenado correctamente.");
				$this->smarty->view('start/start_view');
			}
			else if(!$this->Usuario->set_usuario($usuario))
			{//Existe el usuario en la BD
				$this->smarty->assign("error", "El usuario ya existe en la base de datos.");
				$this->smarty->view('usuario/alta_usuario');
			}
			else
			{//ha habido error en la BD
				$this->smarty->assign("error", "Error en la base de datos.");
				$this->smarty->view('usuario/alta_usuario');
			}
		}
	}

	public function login()
	{
		$user = new $this->Usuario();

		$user->email = $this->input->post('log_email');
		$user->password = $this->input->post('log_pass');

		$password_bd = $this->Usuario->obtener_password();

		if(empty($user->email)||empty($user->password))
		{
			$this->smarty->assign('error','Debe rellenar los dos campos.');
			$this->smarty->view('start/start_view');
		}
		elseif(($user->email == "admin@admin.com")&&($user->password == '123456')&&(md5($user->password) == $password_bd))
		{//Es necesario cambiar contraseña
			$this->smarty->view('start/start_view2');
		}
		else
		{
			if($this->Usuario->login($user))
			{//Recojo todos los datos del ususario
				$datos = $this->Usuario->obtener_usuario($user);
			//Hacemos uso de sesiones
				$data = array(
					'id' => $datos['id'],
					'nombre' => $datos['nombre'],
					'apellidos' => $datos['apellidos'],
					'email' => $datos['email'],
					'status' => TRUE
					 );
				$this->simple_sessions->add_sess($data);
				//Si el valor de status es true vamos a la aplicacion, si no redirigimos a la vista de login
				//Esto es como hacer un redirect('main'); donde main es un controlador
				if($this->simple_sessions->get_value('status'))
				{
					$this->smarty->view('index');
				}
				else
				{
					$this->smarty->view('start/start_view');
				}
			}
			else
			{
				$this->smarty->assign('error','<strong>Error!</strong>, correo o contraseña incorrecto.');
				$this->smarty->view('start/start_view');
			}
		}
	}

	public function cambiarPass()
	{
		//validacion desde servidor
		$this->form_validation->set_rules('log_pass_actual','Password actual','required|trim|max_length[30]');
		$this->form_validation->set_rules('log_pass_nuevo','Password nuevo','required|trim|max_length[30]|matches[log_repass_nuevo]');
		$this->form_validation->set_rules('log_repass_nuevo','Repite password nuevo','required|trim|max_length[30]');

		//Si el formulario no fue bien
		if(!$this->form_validation->run())
		{//Cargamos la vista
			$this->smarty->assign("error", "La contraseña nueva no coincide en los dos campos");
			$this->smarty->view('start/start_view2');
		}
		else{

			$actual = $this->input->post('log_pass_actual');
			$nueva = $this->input->post('log_pass_nuevo');

			if($actual == $nueva)
			{
				$this->smarty->assign("error", "No ha cambiado la contraseña");
				$this->smarty->view('start/start_view2');
			}
			else
			{
				$password  = $this->input->post('log_pass_nuevo');

				if($this->Usuario->set_password($password))
				{//mostramos un mensaje para dejar claro que ha sido modificada la pass
					$this->smarty->assign("success", "Contraseña modificada correctamente");
					$this->smarty->view('start/start_view');
				}
			}
		}
	}


	public function logout()
	{
		 $this->simple_sessions->destroy_sess();
		 $this->smarty->assign('success','Ha cerrado la sesion.');
		 $this->smarty->view('start/start_view');
	}
}

/* End of file */
/* Location: ./application/controllers/ */