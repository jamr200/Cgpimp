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

//Clase para gestionar las Marcas

class Marca_controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
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
	public function alta_marca()
	{
		if($this->simple_sessions->get_value('status'))
		{
			//obtengo el nombre de todos los tipos de dispositivo o de materiales de mi BD y los almaceno en un array
			$elemento = $this->Elemento->obtener_nombre_elementos();
			//paso el array a mi vista para mostrar los resultados
			$this->smarty->assign("elementos",$elemento);

			$this->smarty->view('marca/alta_marca');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}
	//////////////////////////////////////////////////////////////
	public function modal_alta_marca_dispositivo()
	{
		//obtengo el nombre de todos los elementos de la tabla y los almaceno en un array
		$tipo = $this->Tipo_dispositivo->obtener_nombre_tipos();
		//paso el array a mi vista para mostrar los resultados
		$this->smarty->assign("tipo",$tipo);
		$this->smarty->view('marca/modal_alta_marca_dispositivo');
	}
	//////////////////////////////////////////////////////////////
	public function modal_alta_marca_material()
	{
		//obtengo el nombre de todos los elementos de la tabla y los almaceno en un array
		$tipo = $this->Tipo_material->obtener_nombre_tipos();
		//paso el array a mi vista para mostrar los resultados
		$this->smarty->assign("tipo",$tipo);
		$this->smarty->view('marca/modal_alta_marca_material');
	}
///////////////////////////////////////////////////////////////
//Fin de los métodos que me permiten moverme entre las vistas

//Metodo que me llama a dame_marcas_dispositivo para recargar el select por ajax
	public function dame_marcas_dispositivo()
	{
		$this->smarty->view('marca/dame_marcas_dispositivo');
	}
//Metodo que me llama a dame_marcas_material para recargar el select por ajax
	public function dame_marcas_material()
	{
		$this->smarty->view('marca/dame_marcas_material');
	}
///////////////////////////////////////////////////////////////

//Metodo para dar de alta una marca
//***********************************************
	public function addMarca()
	{
		//validacion desde servidor
		$this->form_validation->set_rules('nombre','Nombre','required|trim|max_length[30]');
		$this->form_validation->set_rules('elemento','Elemento','required|trim');

		//Si el formulario no fue bien
		if(!$this->form_validation->run())
		{//Cargamos la vista
			$this->alta_marca();
		}
		else{
			//nos creamos un objeto y metemos los datos que vienen del formulario
			$marca = new $this->Marca();

			$marca->nombre_marca = $this->input->post('nombre');
			$marca->elemento = $this->input->post('elemento');
			//Almacenamos en una variable el elemento para almacenar en nuestra BD si el tipo dado es de un material o un dispositivo
			$elemento = $this->input->post('elemento');
			if($elemento == 1)
			{//Pertenece a un tipo de dispositivo
				$marca->tipo_dispositivo = $this->input->post('tipo');
				$marca->tipo_material = 0;
			}
			else
			{//pertenece a un tipo de material
				$marca->tipo_dispositivo = 0;
				$marca->tipo_material = $this->input->post('tipo');
			}

			if($this->Marca->set_marca($marca))
			{//mostramos un mensaje para dejar claro que ha sido agregado a la BD
				$this->smarty->assign("success", 'Marca <strong>'.$marca->nombre_marca.'</strong> almacenada correctamente.');
			}
			else if(!$this->Marca->set_marca($marca))
			{//Existe la marca en la BD
				$this->smarty->assign("error", 'La marca <strong>'.$marca->nombre_marca.'</strong> ya existe en la base de datos.');
			}
			else
			{//ha habido error en la BD
				$this->smarty->assign("error", "Error en la base de datos.");
			}
			$this->alta_marca();
		}
	}

//Metodo para dar de alta una marca en el modal
//*************************************************
	public function addMarcaModalDispositivo()
	{
		//validacion desde servidor
		$this->form_validation->set_rules('nombre','Nombre','required|trim|max_length[30]');
		$this->form_validation->set_rules('tipo_dispositivo2','tipo','required|trim');

		//Si el formulario no fue bien
		if(!$this->form_validation->run())
		{//Cargamos la vista
			$this->modal_alta_marca_dispositivo();
		}
		else{
			//nos creamos un objeto y metemos los datos que vienen del formulario
			$marca = new $this->Marca();

			$marca->elemento = 1;
			$marca->tipo_material = 0;
			$marca->tipo_dispositivo = $this->input->post('tipo_dispositivo2');
			$marca->nombre_marca = $this->input->post('nombre');

			if($marca->tipo_dispositivo == 0)
			{
				$this->smarty->assign("error", "Debe seleccionar un tipo de dispositivo.");
			}
			else
			{//Todo va bien
				if($this->Marca->set_marca($marca))
				{//mostramos un mensaje para dejar claro que ha sido agregado a la BD
					$this->smarty->assign("success", 'Marca <strong>'.$marca->nombre_marca.'</strong> almacenada correctamente.');
				}
				else if(!$this->Marca->set_marca($marca))
				{//Existe la marca en la BD
					$this->smarty->assign("error", 'La marca <strong>'.$marca->nombre_marca.'</strong> ya existe en la base de datos.');
				}
				else
				{//ha habido error en la BD
					$this->smarty->assign("error", "Error en la base de datos.");
				}
			}
			$this->modal_alta_marca_dispositivo();
		}
	}

	//Metodo para dar de alta una marca en el modal
//*************************************************
	public function addMarcaModalMaterial()
	{
		//validacion desde servidor
		$this->form_validation->set_rules('nombre','Nombre','required|trim|max_length[30]');
		$this->form_validation->set_rules('tipo_material2','tipo','required|trim');

		//Si el formulario no fue bien
		if(!$this->form_validation->run())
		{//Cargamos la vista
			$this->modal_alta_marca_material();
		}
		else{
			//nos creamos un objeto y metemos los datos que vienen del formulario
			$marca = new $this->Marca();

			$marca->elemento = 2;
			$marca->tipo_dispositivo = 0;
			$marca->nombre_marca = $this->input->post('nombre');
			$marca->tipo_material = $this->input->post('tipo_material2');

			if($marca->tipo_material == 0)
			{
				$this->smarty->assign("error", "Debe seleccionar un tipo de material.");
			}
			else
			{//Todo va bien
				if($this->Marca->set_marca($marca))
				{//mostramos un mensaje para dejar claro que ha sido agregado a la BD
					$this->smarty->assign("success", 'Marca <strong>'.$marca->nombre_marca.'</strong> almacenada correctamente.');
				}
				else if(!$this->Marca->set_marca($marca))
				{//Existe la marca en la BD
					$this->smarty->assign("error", 'La marca <strong>'.$marca->nombre_marca.'</strong> ya existe en la base de datos.');
				}
				else
				{//ha habido error en la BD
					$this->smarty->assign("error", "Error en la base de datos.");
				}
			}
			$this->modal_alta_marca_material();
		}
	}

	//Usada para dar de alta una marca
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
}

/* End of file marca_controller.php */
/* Location: ./application/controllers/marca_controller.php */