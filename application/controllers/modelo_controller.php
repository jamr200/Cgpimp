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

//Clase para gestionar los Modelos

class Modelo_controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('Modelo');
		$this->load->model('Marca');
		$this->load->model('Tipo_dispositivo');
		$this->load->model('Tipo_material');
		$this->load->model('Elemento');
	}

	public function index()
	{

	}

//Metodos para redirigirme en el menu a las distintas vistas
//***********************************************************
	public function alta_modelo()
	{
		if($this->simple_sessions->get_value('status'))
		{
			//obtengo el nombre de todos los elementos de mi BD y los almaceno en un array
			$elemento = $this->Elemento->obtener_nombre_elementos();
			//paso el array a mi vista para mostrar los resultados
			$this->smarty->assign("elementos",$elemento);
			$this->smarty->view('modelo/alta_modelo');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}
///////////////////////////////////////////////////////////////
	public function modal_alta_modelo_dispositivo()
	{
		//obtengo el nombre de todos los elementos de la tabla y los almaceno en un array
		$tipo = $this->Tipo_dispositivo->obtener_nombre_tipos();
		//paso el array a mi vista para mostrar los resultados
		$this->smarty->assign("tipo",$tipo);
		$this->smarty->view('modelo/modal_alta_modelo_dispositivo');
	}
///////////////////////////////////////////////////////////////
	public function modal_alta_modelo_material()
	{
		//obtengo el nombre de todos los elementos de la tabla y los almaceno en un array
		$tipo = $this->Tipo_material->obtener_nombre_tipos();
		//paso el array a mi vista para mostrar los resultados
		$this->smarty->assign("tipo",$tipo);
		$this->smarty->view('modelo/modal_alta_modelo_material');
	}
///////////////////////////////////////////////////////////////
//Fin de los métodos que me permiten moverme entre las vistas

	//Metodo que me llama a dame_modelos_dispositivo para recargar el select por ajax
	public function dame_modelos_dispositivo()
	{
		$this->smarty->view('modelo/dame_modelos_dispositivo');
	}

	//Metodo que me llama a dame_modelos_material para recargar el select por ajax
	public function dame_modelos_material()
	{
		$this->smarty->view('modelo/dame_modelos_material');
	}

//Metodo para dar de alta un modelo
//***********************************************
	public function addModelo()
	{
		//validacion desde servidor
		$this->form_validation->set_rules('nombre','Nombre','required|trim|max_length[50]');
		$this->form_validation->set_rules('combo_marca','Marca','required|trim');
		$this->form_validation->set_rules('elemento','elemento','required|trim');

		//Si el formulario no fue bien
		if(!$this->form_validation->run())
		{//Cargamos la vista
			$this->alta_modelo();
		}
		else{
			//nos creamos un objeto y metemos los datos que vienen del formulario
			$modelo = new $this->Modelo();

			$modelo->nombre_modelo = $this->input->post('nombre');
			$modelo->marca = $this->input->post('combo_marca');
			$modelo->elemento = $this->input->post('elemento');


			if($this->Modelo->set_modelo($modelo))
			{//mostramos un mensaje para dejar claro que ha sido agregado a la BD
				$this->smarty->assign("success", 'Modelo <strong>'.$modelo->nombre_modelo.'</strong> almacenado correctamente.');
			}
			else if(!$this->Modelo->set_modelo($modelo))
			{//Existe el modelo en la BD
				$this->smarty->assign("error", 'El modelo <strong>'.$modelo->nombre_modelo.'</strong> ya existe en la base de datos.');
			}
			else
			{//ha habido error en la BD
				$this->smarty->assign("error", "Error en la base de datos.");
			}
			$this->alta_modelo();
		}
	}

//Metodo para dar de alta un modelo en un modal
//***********************************************
	public function addModeloModalDispositivo()
	{
		//validacion desde servidor
		$this->form_validation->set_rules('nombre','Nombre','required|trim|max_length[50]');
		$this->form_validation->set_rules('combo_marca3','Marca','required|trim');

		//Si el formulario no fue bien
		if(!$this->form_validation->run())
		{//Cargamos la vista
			$this->modal_alta_modelo_dispositivo();
		}
		else{
			//nos creamos un objeto y metemos los datos que vienen del formulario
			$modelo = new $this->Modelo();

			$modelo->nombre_modelo = $this->input->post('nombre');
			$modelo->marca = $this->input->post('combo_marca3');
			$modelo->elemento = 1;


			if($this->Modelo->set_modelo($modelo))
			{//mostramos un mensaje para dejar claro que ha sido agregado a la BD
				$this->smarty->assign("success", 'Modelo <strong>'.$modelo->nombre_modelo.'</strong> almacenado correctamente.');
			}
			else if(!$this->Modelo->set_modelo($modelo))
			{//Existe el modelo en la BD
				$this->smarty->assign("error", 'El modelo <strong>'.$modelo->nombre_modelo.'</strong> ya existe en la base de datos.');
			}
			else
			{//ha habido error en la BD
				$this->smarty->assign("error", "Error en la base de datos.");
			}
			$this->modal_alta_modelo_dispositivo();
		}
	}

	//Metodo para dar de alta un modelo en un modal
//***********************************************
	public function addModeloModalMaterial()
	{
		//validacion desde servidor
		$this->form_validation->set_rules('nombre','Nombre','required|trim|max_length[50]');
		$this->form_validation->set_rules('combo_marca3','Marca','required|trim');

		//Si el formulario no fue bien
		if(!$this->form_validation->run())
		{//Cargamos la vista
			$this->modal_alta_modelo_material();
		}
		else{
			//nos creamos un objeto y metemos los datos que vienen del formulario
			$modelo = new $this->Modelo();

			$modelo->nombre_modelo = $this->input->post('nombre');
			$modelo->marca = $this->input->post('combo_marca3');
			$modelo->elemento = 2;


			if($this->Modelo->set_modelo($modelo))
			{//mostramos un mensaje para dejar claro que ha sido agregado a la BD
				$this->smarty->assign("success", 'Modelo <strong>'.$modelo->nombre_modelo.'</strong> almacenado correctamente.');
			}
			else if(!$this->Modelo->set_modelo($modelo))
			{//Existe el modelo en la BD
				$this->smarty->assign("error", 'El modelo <strong>'.$modelo->nombre_modelo.'</strong> ya existe en la base de datos.');
			}
			else
			{//ha habido error en la BD
				$this->smarty->assign("error", "Error en la base de datos.");
			}
			$this->modal_alta_modelo_material();
		}
	}

	//Usada para dar de alta un modelo
	//funcion que permite capturar el valor elegido en un select para mostrar otro select con los Tipos de dispositivos o materiales
	public function elemento()
	{
		$id_elemento = $this->input->post('elegido');

		if($id_elemento == 1)
		{
			$this->Tipo_dispositivo->muestra_tipos();
		}
		else
		{
			$this->Tipo_material->muestra_tipos();
		}
	}
	//Usada para dar de alta un modelo
	//funcion que permite capturar el valor elegido de un select y mostrar las marcas asociadas al tipo elegido
	public function tipo()
	{
		$id_elemento = $this->input->post('elemento');
		$id_tipo = $this->input->post('elegido');
		$this->Marca->muestra_marca($id_elemento,$id_tipo);
	}
/*
	//metodo que me escribe en un select anidado las marcas que pertenecen a un tipo de dispositivo
	//Usado en addModelo
	public function combo_tipo()
	{

		$tipo = $this->input->post('elegido');
		$this->Modelo->muestra_combo_tipo($tipo);
	}
*/
}

/* End of file modelo_controller.php */
/* Location: ./application/controllers/modelo_controller.php */