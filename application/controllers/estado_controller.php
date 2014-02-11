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

//Clase para gestionar los estados de un dispositivo o un material

class Estado_controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('Instancia_dispositivo');
		$this->load->model('Instancia_material');
		$this->load->model('Estado');
	}

	public function index()
	{

	}

//Metodos para redirigirme en el menu a las distintas vistas
//***********************************************************
	public function alta_estado()
	{
		if($this->simple_sessions->get_value('status'))
		{
			$this->smarty->view('estado/alta_estado');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}

///////////////////////////////////////////////////////////////
//Fin de los métodos que me permiten moverme entre las vistas

//Metodo para dar de alta un estado
//***********************************************
	public function addEstado()
	{
		//validacion desde servidor
		$this->form_validation->set_rules('nombre','Nombre','required|trim|max_length[30]');

		//Si el formulario no fue bien
		if(!$this->form_validation->run())
		{//Cargamos la vista
			$this->alta_estado();
		}
		else{
			//nos creamos un objeto y metemos los datos que vienen del formulario
			$estado = new $this->Estado();

			$estado->nombre_estado = $this->input->post('nombre');

			if($this->Estado->set_estado($estado))
			{//mostramos un mensaje para dejar claro que ha sido agregado a la BD
				$this->smarty->assign("success", "Estado almacenado correctamente.");
			}
			else if(!$this->Estado->set_estado($estado))
			{//Existe el estado en la BD
				$this->smarty->assign("error", "El estado ya existe en la base de datos.");
			}
			else
			{//ha habido error en la BD
				$this->smarty->assign("error", "Error en la base de datos.");
			}
			$this->alta_estado();
		}
	}

}

/* End of file estado_controller.php */
/* Location: ./application/controllers/estado_controller.php */