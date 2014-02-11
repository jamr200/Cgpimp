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

class Ubicacion_controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('Tipo_material');
		$this->load->model('Pedido');
		$this->load->model('Marca');
		$this->load->model('Modelo');
		$this->load->model('Material');
		$this->load->model('Instancia_material');
		$this->load->model('Edificio');
		$this->load->model('Habitacion');
		$this->load->model('Mueble');
		$this->load->model('Balda');
		$this->load->model('Ubicacion');
	}

	public function index()
	{

	}

	//Metodos para redirigirme en el menu a las distintas vistas
//**************************************************************
	public function alta_edificio()
	{
		if($this->simple_sessions->get_value('status'))
		{
			$this->smarty->view('ubicacion/edificio/alta_edificio');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}
	//////////////////////////////////////////////////////////////
	public function alta_instancia_material()
	{
		if($this->simple_sessions->get_value('status'))
		{
			//obtengo el nombre de todos los elemento de la tabla y los almaceno en un array
			$tipo = $this->Tipo_material->obtener_todos_tipos();
			//paso el array a mi vista para mostrar los resultados
			$this->smarty->assign("tipo",$tipo);

			//obtengo el nombre de todos los elemento de la tabla y los almaceno en un array
			$pedido = $this->Pedido->obtener_nombre_pedido();
			//paso el array a mi vista para mostrar los resultados
			$this->smarty->assign("pedido",$pedido);

			$this->smarty->view('material/alta_instancia_material');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}
	//////////////////////////////////////////////////////////////
	public function alta_habitacion()
	{
		if($this->simple_sessions->get_value('status'))
		{
			//cargo un listado de todos los edificios que tengo registrados
			$edificio = $this->Edificio->obtener_todos_edificios();
			//Los asigno a un array de smarty para pasarlos a mi vista
			$this->smarty->assign("edificio",$edificio);

			$this->smarty->view('ubicacion/habitacion/alta_habitacion');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}
	//////////////////////////////////////////////////////////////
	public function alta_mueble()
	{
		if($this->simple_sessions->get_value('status'))
		{
			//cargo un listado de todos los edificios que tengo registrados
			$edificio = $this->Edificio->obtener_todos_edificios();
			//Los asigno a un array de smarty para pasarlos a mi vista
			$this->smarty->assign("edificio",$edificio);

			$this->smarty->view('ubicacion/mueble/alta_mueble');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}
	//////////////////////////////////////////////////////////////
	public function alta_balda()
	{
		if($this->simple_sessions->get_value('status'))
		{
			//cargo un listado de todos los edificios que tengo registrados
			$edificio = $this->Edificio->obtener_todos_edificios();
			//Los asigno a un array de smarty para pasarlos a mi vista
			$this->smarty->assign("edificio",$edificio);

			$this->smarty->view('ubicacion/balda/alta_balda');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}
	//////////////////////////////////////////////////////////////
	public function establece_ubicacion()
	{
		if($this->simple_sessions->get_value('status'))
		{
			//cargo un listado de todos los tipos de materiales que posee mi tabla
			$tipos = $this->Tipo_material->obtener_todos_tipos();
			//Los asigno a un array de smarty para pasarlos a mi vista
			$this->smarty->assign("tipo_mat",$tipos);

			//cargo un listado de todos los edificios que tengo registrados
			$edificio = $this->Edificio->obtener_todos_edificios();
			//Los asigno a un array de smarty para pasarlos a mi vista
			$this->smarty->assign("edificio",$edificio);

			$this->smarty->view('ubicacion/alta_ubicacion');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}
	///////////////////////////////////////////////////////////////
	public function encontrar_ubicacion()
	{
		if($this->simple_sessions->get_value('status'))
		{
			//cargo un listado de todos los tipos de materiales que posee mi tabla
			$tipos = $this->Tipo_material->obtener_todos_tipos();
			//Los asigno a un array de smarty para pasarlos a mi vista
			$this->smarty->assign("tipo_mat",$tipos);

			$this->smarty->view('ubicacion/encontrar_ubicacion');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}
	///////////////////////////////////////////////////////////////
	public function buscar_ubicacion()
	{
		if($this->simple_sessions->get_value('status'))
		{
			//cargo un listado de todos los edificios que tengo registrados
			$edificio = $this->Edificio->obtener_todos_edificios();
			//Los asigno a un array de smarty para pasarlos a mi vista
			$this->smarty->assign("edificio",$edificio);

			$this->smarty->view('ubicacion/busca_ubicacion');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}
	///////////////////////////////////////////////////////////////
	public function modal_alta_edificio()
	{
		$this->smarty->view('ubicacion/edificio/modal_alta_edificio');
	}
	///////////////////////////////////////////////////////////////
	public function modal_alta_habitacion()
	{
		//cargo un listado de todos los edificios que tengo registrados
		$edificio = $this->Edificio->obtener_todos_edificios();
		//Los asigno a un array de smarty para pasarlos a mi vista
		$this->smarty->assign("edificio",$edificio);

		$this->smarty->view('ubicacion/habitacion/modal_alta_habitacion');
	}
	///////////////////////////////////////////////////////////////
	public function modal_alta_mueble()
	{
		//cargo un listado de todos los edificios que tengo registrados
		$edificio = $this->Edificio->obtener_todos_edificios();
		//Los asigno a un array de smarty para pasarlos a mi vista
		$this->smarty->assign("edificio",$edificio);

		$this->smarty->view('ubicacion/mueble/modal_alta_mueble');
	}
	///////////////////////////////////////////////////////////////
	public function modal_alta_balda()
	{
		//cargo un listado de todos los edificios que tengo registrados
		$edificio = $this->Edificio->obtener_todos_edificios();
		//Los asigno a un array de smarty para pasarlos a mi vista
		$this->smarty->assign("edificio",$edificio);

		$this->smarty->view('ubicacion/balda/modal_alta_balda');
	}
	//////////////////////////////////////////////////////////////
	public function listar_ubicacion()
	{
		if($this->simple_sessions->get_value('status'))
		{
			$this->load->library('pagination');

			$config = array();

			$desde = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;

			$config['per_page'] = 10;
			$config['base_url'] = base_url('ubicacion_controller/listar_ubicaciones');
			$config['total_rows'] = $this->Ubicacion->getNumUbicaciones();
			$config['uri_segment'] = 3;
			$config['num_links'] = 2;
			$config['first_link'] = "&lt&lt";
			$config['last_link'] = "&gt&gt";
			//$config['display_pages'] = FALSE;

			$this->pagination->initialize($config);

			$listado_ubicaciones = $this->Ubicacion->lista_ubicaciones($config['per_page'],$desde);

			$paginacion = $this->pagination->create_links();

			$this->smarty->assign('listado_ubicaciones',$listado_ubicaciones);
			$this->smarty->assign('paginacion',$paginacion);

			$this->smarty->view('ubicacion/listar_ubicaciones');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}
	//////////////////////////////////////////////////////////////
	public function eliminar_ubicacion()
	{
		if($this->simple_sessions->get_value('status'))
		{
			$id = $_GET['id'];

			//obtengo informacion del pedido
			$ubicacion = $this->Ubicacion->obtener_ubicacion($id);
			//Obtengo el nombre del edificio
			$nombre_edificio = $this->Edificio->obtener_nombre_edificio_por_id($ubicacion->id_edificio);
			//Obtengo el nombre de la habitacion
			$nombre_habitacion = $this->Habitacion->obtener_nombre_habitacion_por_id($ubicacion->id_habitacion);
			//Obtengo el nombre del mueble
			$nombre_mueble = $this->Mueble->obtener_nombre_mueble_por_id($ubicacion->id_mueble);
			//Obtengo el nombre de la balda
			$nombre_balda = $this->Balda->obtener_nombre_balda_por_id($ubicacion->id_balda);
			//paso el array a mi vista para mostrar los resultados
			$this->smarty->assign("ubicacion",$ubicacion);
			$this->smarty->assign("nombre_edificio",$nombre_edificio);
			$this->smarty->assign("nombre_habitacion",$nombre_habitacion);
			$this->smarty->assign("nombre_mueble",$nombre_mueble);
			$this->smarty->assign("nombre_balda",$nombre_balda);

			$this->smarty->view('ubicacion/eliminar_ubicacion');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}
//////////////////////////////////////////////////////////////
//Fin de los métodos que me permiten moverme entre las vistas

//Metodo para dar de alta un edificio
//***********************************
	public function addEdificio()
	{
		//validacion desde servidor
		$this->form_validation->set_rules('nombre','Nombre','required|trim|max_length[25]');

		//Si el formulario no fue bien
		if(!$this->form_validation->run())
		{//Cargamos la vista
			$this->alta_edificio();
		}
		else{
			//nos creamos un objeto y metemos los datos que vienen del formulario
			$edificio = new $this->Edificio();

			$edificio->nombre_edificio = $this->input->post('nombre');

			if($this->Edificio->set_edificio($edificio))
			{//El elemento ha sido agregado
				$this->smarty->assign("success", "Edificio almacenado correctamente.");
			}
			elseif(!$this->Edificio->set_edificio($edificio))
			{//El edificio esta ya registrado
				$this->smarty->assign("error", "El edificio ya existe en la base de datos");
			}
			else
			{//error en la BD
				$this->smarty->assign("error", "Error en la base de datos");
			}
			$this->alta_edificio();
		}
	}

	public function addEdificioModal()
	{
		//validacion desde servidor
		$this->form_validation->set_rules('nombre','Nombre','required|trim|max_length[25]');

		//Si el formulario no fue bien
		if(!$this->form_validation->run())
		{//Cargamos la vista
			$this->modal_alta_edificio();
		}
		else{
			//nos creamos un objeto y metemos los datos que vienen del formulario
			$edificio = new $this->Edificio();

			$edificio->nombre_edificio = $this->input->post('nombre');

			if($this->Edificio->set_edificio($edificio))
			{//El elemento ha sido agregado
				$this->smarty->assign("success", "Edificio almacenado correctamente.");
			}
			elseif(!$this->Edificio->set_edificio($edificio))
			{//El edificio esta ya registrado
				$this->smarty->assign("error", "El edificio ya existe en la base de datos");
			}
			else
			{//error en la BD
				$this->smarty->assign("error", "Error en la base de datos");
			}
			$this->modal_alta_edificio();
		}
	}

//Metodo para dar de alta una habitacion
//**************************************
	public function addHabitacion()
	{
		//validacion desde servidor
		$this->form_validation->set_rules('edificio','Edificio','required|trim');
		$this->form_validation->set_rules('nombre','Nombre','required|trim|max_length[25]');

		//Si el formulario no fue bien
		if(!$this->form_validation->run())
		{//Cargamos la vista
			$this->alta_habitacion();
		}
		else{
			//nos creamos un objeto y metemos los datos que vienen del formulario
			$habitacion = new $this->Habitacion();

			$habitacion->edificio = $this->input->post('edificio');
			$habitacion->nombre_habitacion = $this->input->post('nombre');

			if($this->Habitacion->set_habitacion($habitacion))
			{//El elemento ha sido agregado
				$this->smarty->assign("success", "Habitacion almacenada correctamente.");
			}
			elseif(!$this->Habitacion->set_habitacion($habitacion))
			{//La habitacion esta ya registrada
				$this->smarty->assign("error", "La habitacion ya existe en la base de datos");
			}
			else
			{//error en la BD
				$this->smarty->assign("error", "Error en la base de datos");
			}
			$this->alta_habitacion();
		}
	}

	public function addHabitacionModal()
	{
		//validacion desde servidor
		$this->form_validation->set_rules('edificio2','Edificio','required|trim');
		$this->form_validation->set_rules('nombre','Nombre','required|trim|max_length[25]');

		//Si el formulario no fue bien
		if(!$this->form_validation->run())
		{//Cargamos la vista
			$this->modal_alta_habitacion();
		}
		else{
			//nos creamos un objeto y metemos los datos que vienen del formulario
			$habitacion = new $this->Habitacion();

			$habitacion->edificio = $this->input->post('edificio2');
			$habitacion->nombre_habitacion = $this->input->post('nombre');

			if($this->Habitacion->set_habitacion($habitacion))
			{//El elemento ha sido agregado
				$this->smarty->assign("success", "Habitacion almacenada correctamente.");
			}
			elseif(!$this->Habitacion->set_habitacion($habitacion))
			{//La habitacion esta ya registrada
				$this->smarty->assign("error", "La habitacion ya existe en la base de datos");
			}
			else
			{//error en la BD
				$this->smarty->assign("error", "Error en la base de datos");
			}
			$this->modal_alta_habitacion();
		}
	}

//Metodo para dar de alta un mueble
//*********************************
	public function addMueble()
	{
		//validacion desde servidor
		$this->form_validation->set_rules('edificio','Edificio','required|trim');
		$this->form_validation->set_rules('habitacion','Habitacion','required|trim');
		$this->form_validation->set_rules('nombre','Nombre','required|trim|max_length[25]');

		//Si el formulario no fue bien
		if(!$this->form_validation->run())
		{//Cargamos la vista
			$this->alta_mueble();
		}
		else{
			//nos creamos un objeto y metemos los datos que vienen del formulario
			$mueble = new $this->Mueble();

			$mueble->edificio = $this->input->post('edificio');
			$mueble->habitacion = $this->input->post('habitacion');
			$mueble->nombre_mueble = $this->input->post('nombre');

			if($this->Mueble->set_mueble($mueble))
			{//El elemento ha sido agregado
				$this->smarty->assign("success", "Mueble almacenado correctamente.");
			}
			elseif(!$this->Mueble->set_mueble($mueble))
			{//El mueble esta ya registrado
				$this->smarty->assign("error", "El mueble ya existe en la base de datos");
			}
			else
			{//error en la BD
				$this->smarty->assign("error", "Error en la base de datos");
			}
			$this->alta_mueble();
		}
	}

	public function addMuebleModal()
	{
		//validacion desde servidor
		$this->form_validation->set_rules('edificio3','Edificio','required|trim');
		$this->form_validation->set_rules('habitacion3','Habitacion','required|trim');
		$this->form_validation->set_rules('nombre','Nombre','required|trim|max_length[25]');

		//Si el formulario no fue bien
		if(!$this->form_validation->run())
		{//Cargamos la vista
			$this->modal_alta_mueble();
		}
		else{
			//nos creamos un objeto y metemos los datos que vienen del formulario
			$mueble = new $this->Mueble();

			$mueble->edificio = $this->input->post('edificio3');
			$mueble->habitacion = $this->input->post('habitacion3');
			$mueble->nombre_mueble = $this->input->post('nombre');

			if($this->Mueble->set_mueble($mueble))
			{//El elemento ha sido agregado
				$this->smarty->assign("success", "Mueble almacenado correctamente.");
			}
			elseif(!$this->Mueble->set_mueble($mueble))
			{//El mueble esta ya registrado
				$this->smarty->assign("error", "El mueble ya existe en la base de datos");
			}
			else
			{//error en la BD
				$this->smarty->assign("error", "Error en la base de datos");
			}
			$this->modal_alta_mueble();
		}
	}

//Metodo para dar de alta una balda
//*********************************
	public function addBalda()
	{
		//validacion desde servidor
		$this->form_validation->set_rules('edificio','Edificio','required|trim');
		$this->form_validation->set_rules('habitacion','Habitacion','required|trim');
		$this->form_validation->set_rules('mueble','Mueble','required|trim');
		$this->form_validation->set_rules('nombre','Nombre','required|trim|max_length[25]');

		//Si el formulario no fue bien
		if(!$this->form_validation->run())
		{//Cargamos la vista
			$this->alta_balda();
		}
		else{
			//nos creamos un objeto y metemos los datos que vienen del formulario
			$balda = new $this->Balda();

			$balda->edificio = $this->input->post('edificio');
			$balda->habitacion = $this->input->post('habitacion');
			$balda->mueble = $this->input->post('mueble');
			$balda->nombre_balda = $this->input->post('nombre');

			if($this->Balda->set_balda($balda))
			{//El elemento ha sido agregado
				$this->smarty->assign("success", "Balda almacenada correctamente.");
			}
			elseif(!$this->Balda->set_balda($balda))
			{//La balda esta ya registrado
				$this->smarty->assign("error", "La balda ya existe en la base de datos.");
			}
			else
			{//error en la BD
				$this->smarty->assign("error", "Error en la base de datos");
			}
			$this->alta_balda();
		}
	}

	public function addBaldaModal()
	{
		//validacion desde servidor
		$this->form_validation->set_rules('edificio4','Edificio','required|trim');
		$this->form_validation->set_rules('habitacion4','Habitacion','required|trim');
		$this->form_validation->set_rules('mueble4','Mueble','required|trim');
		$this->form_validation->set_rules('nombre','Nombre','required|trim|max_length[25]');

		//Si el formulario no fue bien
		if(!$this->form_validation->run())
		{//Cargamos la vista
			$this->modal_alta_balda();
		}
		else{
			//nos creamos un objeto y metemos los datos que vienen del formulario
			$balda = new $this->Balda();

			$balda->edificio = $this->input->post('edificio4');
			$balda->habitacion = $this->input->post('habitacion4');
			$balda->mueble = $this->input->post('mueble4');
			$balda->nombre_balda = $this->input->post('nombre');

			if($this->Balda->set_balda($balda))
			{//El elemento ha sido agregado
				$this->smarty->assign("success", "Balda almacenada correctamente.");
			}
			elseif(!$this->Balda->set_balda($balda))
			{//La balda esta ya registrado
				$this->smarty->assign("error", "La balda ya existe en la base de datos.");
			}
			else
			{//error en la BD
				$this->smarty->assign("error", "Error en la base de datos");
			}
			$this->modal_alta_balda();
		}
	}

	public function addUbicacion()
	{
		//validacion desde servidor
		$this->form_validation->set_rules('edificio','Edificio','required|trim');
		$this->form_validation->set_rules('habitacion','Habitacion','required|trim');
		$this->form_validation->set_rules('mueble','Mueble','required|trim');
		$this->form_validation->set_rules('balda','Balda','required|trim');
		$this->form_validation->set_rules('instancia_material','Instancia de material','required|trim');

		//Si el formulario no fue bien
		if(!$this->form_validation->run())
		{//Cargamos la vista
			$this->establece_ubicacion();
		}
		else{
			$ubicacion = new $this->Ubicacion();

			$ubicacion->id_edificio = $this->input->post('edificio');
			$ubicacion->id_habitacion = $this->input->post('habitacion');
			$ubicacion->id_mueble = $this->input->post('mueble');
			$ubicacion->id_balda = $this->input->post('balda');
			$ubicacion->id_instancia_material = $this->input->post('instancia_material');

			if($this->Ubicacion->set_ubicacion($ubicacion))
			{//Todo va bien
				$this->smarty->assign("success","Ubicacion almacenada.");
			}
			elseif(!$this->Ubicacion->set_ubicacion($ubicacion))
			{//Ya existe ese registro
				$this->smarty->assign("error","Este material ya ha sido almacenado.");
			}
			else
			{
				$this->smarty->assign("error","Error en la BD.");
			}
			$this->establece_ubicacion();
		}
	}

	//Metodo para eliminar una ubicacion
	public function deleteUbicacion()
	{
		//recojo los datos del formulario
		$id_ubicacion = $_GET['id'];

		//compruebo si el array esta vacio
		if(empty($id_ubicacion))
		{//array vacio
			//mando mensaje
			$this->smarty->assign("error", "No ha seleccionado ninguna ubicacion.");
		}
		else{
			//he seleccionado alguna ubicacion, procedemos a borrar

			if($this->Ubicacion->unset_ubicacion2($id_ubicacion))
			{
				$this->smarty->assign("success", 'Ubicacion eliminada correctamente.');
			}
			else
			{
				$this->smarty->assign("error", 'Ha ocurrido un error. La ubicacion no ha sido borrada.');
			}
		}
		$this->listar_ubicacion();
	}

	public function addUbicacionDesdeInstancia()
	{
		//validacion desde servidor
		$this->form_validation->set_rules('edificio','Edificio','required|trim');
		$this->form_validation->set_rules('habitacion','Habitacion','required|trim');
		$this->form_validation->set_rules('mueble','Mueble','required|trim');
		$this->form_validation->set_rules('balda','Balda','required|trim');

		//Si el formulario no fue bien
		if(!$this->form_validation->run())
		{//Cargamos la vista
			$this->establece_ubicacion();
		}
		else{
			$ubicacion = new $this->Ubicacion();

			$ubicacion->id_edificio = $this->input->post('edificio');
			$ubicacion->id_habitacion = $this->input->post('habitacion');
			$ubicacion->id_mueble = $this->input->post('mueble');
			$ubicacion->id_balda = $this->input->post('balda');
			$ubicacion->id_instancia_material = $this->input->post('id_instancia');

			if($this->Ubicacion->set_ubicacion($ubicacion))
			{//Todo va bien
				$this->smarty->assign("success","Ubicacion almacenada. Inserte nueva instancia.");
			}
			else if(!$this->Ubicacion->set_ubicacion($ubicacion))
			{//Ya existe ese registro
				$this->smarty->assign("error","Este material ya ha sido almacenado.");
			}
			else
			{
				$this->smarty->assign("error","Error en la BD.");
			}
			$this->alta_instancia_material();
		}
	}

	//Metodo para buscar registros en una ubicacion
	//*********************************************
	public function buscaUbicacion()
	{
		//Capturo los datos
		$edificio = $this->input->post('edificio');
		$habitacion = $this->input->post('habitacion');
		$mueble = $this->input->post('mueble');
		$balda = $this->input->post('balda');

		//Los meto en un array
		$datos = array(
			'edificio' => $edificio,
			'habitacion' => $habitacion,
			'mueble' => $mueble,
			'balda' => $balda
		);

		$this->load->library('pagination');

		$config = array();

		$desde = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;

		$config['per_page'] = 10;
		$config['base_url'] = base_url('ubicacion_controller/buscaUbicacion');
		$config['total_rows'] = $this->Ubicacion->getNumUbicaciones2($datos);
		$config['uri_segment'] = 3;
		$config['num_links'] = 2;
		$config['first_link'] = "&lt&lt";
		$config['last_link'] = "&gt&gt";
		//$config['display_pages'] = FALSE;

		$this->pagination->initialize($config);

		//Llamo a mi modelo y hago consulta
		$ubicacion = $this->Ubicacion->busca_ubicacion($datos,$config['per_page'],$desde);

		$paginacion = $this->pagination->create_links();

		$this->smarty->assign('paginacion',$paginacion);
		//devuelvo resultado y llamo a la nueva vista para que muestre resultados
		$this->smarty->assign("ubicacion", $ubicacion);
		$this->smarty->view('ubicacion/listar_busqueda_ubicaciones');
	}

	//Genera pdf al listar
	public function GeneraPdfListadoUbicacion()
    {
        $this->load->library('Pdf');

        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        //Para orientar la pagina en horizontal (L) o vertical (P)
        //$pdf->setPageOrientation(PDF_PAGE_ORIENTATION);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Jose A. Moreno');
        $pdf->SetTitle('Listado PDF');
        $pdf->SetSubject('Listado de ubicaciones');
        $pdf->SetKeywords('PDF, ubicaciones, listado');

        // datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
        //tc --> color de texto en cabecera
        $tc = array(0, 0, 0);
        //lc --> color de linea
        $lc = array(0, 0, 0);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE , PDF_HEADER_STRING, $tc, $lc);
        $pdf->setFooterData($tc, $lc);

        // datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
        //tamaño y tipo de letra en cabecera y pie de pagina
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        //relación utilizada para ajustar la conversión de los píxeles
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


        // ---------------------------------------------------------
        // establecer el modo de fuente por defecto
        $pdf->setFontSubsetting(true);

        // Establecer el tipo de letra

        //Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
        // Helvetica para reducir el tamaño del archivo.
        $pdf->SetFont('freemono', '', 8, '', true);

        // Añadir una página
        // Este método tiene varias opciones, consulta la documentación para más información.
        $pdf->AddPage();

        //fijar efecto de sombra en el texto
        //$pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

        // Establecemos el contenido para imprimir
        $ubicaciones = $this->Ubicacion->lista_ubicaciones2();
        //preparamos y maquetamos el contenido a crear

        $tbl = <<<EOD
        <style type=text/css>
            th{color: #000; font-weight: bold; background-color: #eee}
            td{background-color: #fff; color: #000}
        </style>
        <h2>Listado de ubicaciones </h2>
        <table cellspacing="0" cellpadding="1" border="1">
            <tr>
            	<th width="220"> Instancia </th>
                <th width="150"> Edificio </th>
                <th width="90"> Habitacion </th>
                <th width="90"> Mueble </th>
                <th width="90"> Balda </th>
            </tr>
EOD;
        //Componemos las filas con los registros de nuestra tabla
        foreach ($ubicaciones as $fila)
        {
        	$instancia = $fila->id.' // '.$fila->part_number.' // '.$fila->num_serie;
            $edificio = $fila->nombre_edificio;
            $habitacion = $fila->nombre_habitacion;
            $mueble = $fila->nombre_mueble;
            $balda = $fila->nombre_balda;

            $tbl .=  <<<EOD
                    <tr>
                    	<td width="220" align="left"> $instancia </td>
                        <td width="150" align="left"> $edificio </td>
                        <td width="90" align="left"> $habitacion </td>
                        <td width="90" align="left"> $mueble </td>
                        <td width="90" align="left"> $balda </td>
                    </tr>
EOD;
        }
        $tbl .= "</table>";

        //Mostramos el contenido HTML
        $pdf->writeHTML($tbl, true, false, false, false, '');

        // ---------------------------------------------------------
        // Cerrar el documento PDF y preparamos la salida
        // Este método tiene varias opciones, consulte la documentación para más información.
        $nombre_archivo = utf8_decode("ubicaciones.pdf");
        $pdf->Output($nombre_archivo, 'I');
    }

    //Genera pdf en las busquedas
    public function GeneraPdfUbicacion()
    {
    	//Capturo los datos
		$edificio = $this->input->post('edificio');
		$habitacion = $this->input->post('habitacion');
		$mueble = $this->input->post('mueble');
		$balda = $this->input->post('balda');
		$estado = $this->input->post('estado');
		$fecha_ini = $this->input->post('fecha_ini');
		$fecha_fin = $this->input->post('fecha_fin');

 		//Los meto en un array
		$datos = array(
			'edificio' => $edificio,
			'habitacion' => $habitacion,
			'mueble' => $mueble,
			'balda' => $balda
		);

        $this->load->library('Pdf');

        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        //Para orientar la pagina en horizontal (L) o vertical (P)
        //$pdf->setPageOrientation(PDF_PAGE_ORIENTATION);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Jose A. Moreno');
        $pdf->SetTitle('Listado PDF');
        $pdf->SetSubject('Listado de ubicaciones');
        $pdf->SetKeywords('PDF, ubicaciones, listado');

        // datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
        //tc --> color de texto en cabecera
        $tc = array(0, 0, 0);
        //lc --> color de linea
        $lc = array(0, 0, 0);
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE , PDF_HEADER_STRING, $tc, $lc);
        $pdf->setFooterData($tc, $lc);

        // datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
        //tamaño y tipo de letra en cabecera y pie de pagina
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        //relación utilizada para ajustar la conversión de los píxeles
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


        // ---------------------------------------------------------
        // establecer el modo de fuente por defecto
        $pdf->setFontSubsetting(true);

        // Establecer el tipo de letra

        //Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
        // Helvetica para reducir el tamaño del archivo.
        $pdf->SetFont('freemono', '', 8, '', true);

        // Añadir una página
        // Este método tiene varias opciones, consulta la documentación para más información.
        $pdf->AddPage();

        //fijar efecto de sombra en el texto
        //$pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

        // Establecemos el contenido para imprimir
        $ubicaciones = $this->Ubicacion->busca_ubicacion2($datos);
        //preparamos y maquetamos el contenido a crear

        $tbl = <<<EOD
        <style type=text/css>
            th{color: #000; font-weight: bold; background-color: #eee}
            td{background-color: #fff; color: #000}
        </style>
        <h2>Listado de ubicaciones </h2>
        <table cellspacing="0" cellpadding="1" border="1">
            <tr>
            	<th width="220"> Instancia </th>
                <th width="150"> Edificio </th>
                <th width="90"> Habitacion </th>
                <th width="90"> Mueble </th>
                <th width="90"> Balda </th>
            </tr>
EOD;
        //Componemos las filas con los registros de nuestra tabla
        foreach ($ubicaciones as $fila)
        {
        	$instancia = $fila->id.' // '.$fila->part_number.' // '.$fila->num_serie;
            $edificio = $fila->nombre_edificio;
            $habitacion = $fila->nombre_habitacion;
            $mueble = $fila->nombre_mueble;
            $balda = $fila->nombre_balda;

            $tbl .=  <<<EOD
                    <tr>
                    	<td width="220" align="left"> $instancia </td>
                        <td width="150" align="left"> $edificio </td>
                        <td width="90" align="left"> $habitacion </td>
                        <td width="90" align="left"> $mueble </td>
                        <td width="90" align="left"> $balda </td>
                    </tr>
EOD;
        }
        $tbl .= "</table>";

        //Mostramos el contenido HTML
        $pdf->writeHTML($tbl, true, false, false, false, '');

        // ---------------------------------------------------------
        // Cerrar el documento PDF y preparamos la salida
        // Este método tiene varias opciones, consulte la documentación para más información.
        $nombre_archivo = utf8_decode("ubicaciones.pdf");
        $pdf->Output($nombre_archivo, 'I');
    }
	////////////////////////////////////////////
	//Métodos para cargar los selects anidados//
	////////////////////////////////////////////
	//funcion que permite capturar el valor elegido en un select para mostrar otro select con los modelos
	public function edificio()
	{
		$id_edificio = $this->input->post('elegido');
		$this->Habitacion->muestra_habitacion($id_edificio);
	}

	//funcion que permite capturar el valor elegido en un select para mostrar otro select con los modelos
	public function habitacion()
	{
		$id_habitacion = $this->input->post('elegido');
		$this->Mueble->muestra_mueble($id_habitacion);
	}

	//funcion que permite capturar el valor elegido en un select para mostrar otro select con los modelos
	public function balda()
	{
		$id_mueble = $this->input->post('elegido');
		$this->Balda->muestra_balda($id_mueble);
	}

	/////////////////////////////////////////////////////////////
	//Métodos necesarios a la hora de dar de alta una ubicacion//
	/////////////////////////////////////////////////////////////
	public function edificio3()
	{
		$id_edificio = $this->input->post('elegido');
		$this->Habitacion->muestra_habitacion($id_edificio);
	}

	public function edificio4()
	{
		$id_edificio = $this->input->post('elegido');
		$this->Habitacion->muestra_habitacion($id_edificio);
	}

	public function habitacion4()
	{
		$id_habitacion = $this->input->post('elegido');
		$this->Mueble->muestra_mueble($id_habitacion);
	}

	////////////////////////////////////////////////////////////////////////////////
	//Otros métodos necesarios para mostrar elementos de los selects de materiales//
	////////////////////////////////////////////////////////////////////////////////

	//capturamos el id de mi tipo de material y mostramos las marcas en otro select
	public function tipo_material()
	{
		$id_tipo = $this->input->post('elegido');
		$this->Marca->muestra_marca_material($id_tipo);
	}
	//funcion que permite capturar el valor elegido en un select para mostrar otro select con los modelos
	public function marca_material()
	{
		$id_marca = $this->input->post('elegido');
		$this->Modelo->muestra_modelo($id_marca);
	}
	//funcion que permite capturar el valor elegido en un select para mostrar otro select con las instancias
	public function instancia_material()
	{
		$id_modelo = $this->input->post('elegido');
		$id_material = $this->Material->obtener_id_material($id_modelo);
		$this->Instancia_material->muestra_combo_instancia($id_material);
	}
	//Funcion que captura el valor elegido en el select para mostrar la ubicacion
	public function muestra_ubicacion()
	{
		$id_instancia = $this->input->post('elegido');
		$this->Ubicacion->muestra_ubicacion_instancia($id_instancia);
	}

	/////////////////////////////////////////////////////////////////////////////////////////////
	//Uso estos metodo para recargarme el select una vez que inserto un registro desde un modal//
	/////////////////////////////////////////////////////////////////////////////////////////////
	public function recarga_edificio()
	{
		//obtengo el nombre de todos los elemento de la tabla y los almaceno en un array
		$edificio = $this->Edificio->obtener_todos_edificios();
		//paso el array a mi vista para mostrar los resultados
		$this->smarty->assign("edificio",$edificio);

		$this->smarty->view('ubicacion/edificio/recarga_edificio');
	}
	public function recarga_habitacion()
	{
		$this->smarty->view('ubicacion/habitacion/recarga_habitacion');
	}
	public function recarga_mueble()
	{
		$this->smarty->view('ubicacion/mueble/recarga_mueble');
	}
	public function recarga_balda()
	{
		$this->smarty->view('ubicacion/balda/recarga_balda');
	}
	///////////////////////////////////////////////////////////////////////////////////////////////
}