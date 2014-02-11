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

//Clase para gestionar los Dispositivos

class Dispositivo_controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('Tipo_dispositivo');
		$this->load->model('Tipo_material');
		$this->load->model('Dispositivo');
		$this->load->model('Instancia_dispositivo');
		$this->load->model('Instancia_material');
		$this->load->model('Pedido');
		$this->load->model('Marca');
		$this->load->model('Modelo');
		$this->load->model('Secuencia_estado');
		$this->load->model('Departamento');
		$this->load->model('Elemento');
		$this->load->model('Estado');
	}

	public function index()
	{
	}

//Metodos para redirigirme en el menu a las distintas vistas
//***********************************************************
//OK
	public function alta_tipo_dispositivo()
	{
		if($this->simple_sessions->get_value('status'))
		{
			$this->smarty->view('dispositivo/alta_tipo_dispositivo');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}
//OK
	//////////////////////////////////////////////////////////////
	public function modal_alta_tipo_dispositivo()
	{
		$this->smarty->view('dispositivo/modal_alta_tipo_dispositivo');
	}
//OK
	//////////////////////////////////////////////////////////////
	public function alta_dispositivo()
	{
		if($this->simple_sessions->get_value('status'))
		{
			//obtengo el nombre de todos los tipos de dispositivo o de materiales de mi BD y los almaceno en un array
			$tipo = $this->Tipo_dispositivo->obtener_nombre_tipos();
			//paso el array a mi vista para mostrar los resultados
			$this->smarty->assign("tipo",$tipo);

			$this->smarty->view('dispositivo/alta_dispositivo');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}
	//////////////////////////////////////////////////////////////////////////////////////////
	//Uso este metodo para recargarme el select una vez que inserto un registro desde un modal
	//////////////////////////////////////////////////////////////////////////////////////////
	public function dame_tipos()
	{
		//obtengo el nombre de todos los elementos de la tabla y los almaceno en un array
		$tipo = $this->Tipo_dispositivo->obtener_nombre_tipos();
		//paso el array a mi vista para mostrar los resultados
		$this->smarty->assign("tipo",$tipo);

		$this->smarty->view('dispositivo/dame_tipos');
	}
//OK
	//////////////////////////////////////////////////////////////
	public function alta_instancia_dispositivo()
	{
		if($this->simple_sessions->get_value('status'))
		{
			//obtengo el nombre de todos los elemento de la tabla y los almaceno en un array
			$tipo = $this->Tipo_dispositivo->obtener_todos_tipos();
			//paso el array a mi vista para mostrar los resultados
			$this->smarty->assign("tipo",$tipo);

			//obtengo el nombre de todos los tipos de dispositivo o de materiales de mi BD y los almaceno en un array
			$elemento = $this->Elemento->obtener_nombre_elementos();
			//paso el array a mi vista para mostrar los resultados
			$this->smarty->assign("elementos",$elemento);

			//obtengo el nombre de todos los elemento de la tabla y los almaceno en un array
			$pedido = $this->Pedido->obtener_nombre_pedido();
			//paso el array a mi vista para mostrar los resultados
			$this->smarty->assign("pedido",$pedido);

			//obtengo el nombre de todos los elemento de la tabla y los almaceno en un array
			$d = $this->Departamento->obtener_nombre_departamentos();
			//paso el array a mi vista para mostrar los resultados
			$this->smarty->assign("departamento",$d);

			$this->smarty->view('dispositivo/alta_instancia_dispositivo');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}
	//////////////////////////////////////////////////////////////
	public function listar_dispositivo()
	{
		if($this->simple_sessions->get_value('status'))
		{
			$this->load->library('pagination');

			$config = array();

			$desde = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;

			$config['per_page'] = 10;
			$config['base_url'] = base_url('dispositivo_controller/listar_dispositivo');
			$config['total_rows'] = $this->Dispositivo->getNumDispositivos();
			$config['uri_segment'] = 3;
			$config['num_links'] = 2;
			$config['first_link'] = "&lt&lt";
			$config['last_link'] = "&gt&gt";
			//$config['display_pages'] = FALSE;

			$this->pagination->initialize($config);

			$listado_dispositivos = $this->Dispositivo->lista_dispositivos($config['per_page'],$desde);

			$paginacion = $this->pagination->create_links();

			$this->smarty->assign('listado_dispositivos',$listado_dispositivos);
			$this->smarty->assign('paginacion',$paginacion);

			$this->smarty->view('dispositivo/listar_dispositivo');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}
	//////////////////////////////////////////////////////////////
	public function buscar_instancia_dispositivo()
	{
		if($this->simple_sessions->get_value('status'))
		{
			//Dispositivo
			$tipo = $this->Tipo_dispositivo->obtener_todos_tipos();
			//paso el array a mi vista para mostrar los resultados
			$this->smarty->assign("dispositivo",$tipo);
			//Departamentos
			$d = $this->Departamento->obtener_nombre_departamentos();
			//paso el array a mi vista para mostrar los resultados
			$this->smarty->assign("departamento",$d);
			//Estados
			$estados = $this->Estado->obtener_todos_estados();
			//paso el array a mi vista para mostrar los resultados
			$this->smarty->assign("estado",$estados);

			$this->smarty->view('dispositivo/buscar_instancia_dispositivo');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}

//OK
	//////////////////////////////////////////////////////////////
	public function modificar_instancia_dispositivo()
	{
		if($this->simple_sessions->get_value('status'))
		{
			//obtengo el nombre de todos los elemento de la tabla y los almaceno en un array
			$tipo = $this->Tipo_dispositivo->obtener_todos_tipos();
			//paso el array a mi vista para mostrar los resultados
			$this->smarty->assign("tipo",$tipo);

			$this->smarty->view('dispositivo/modificar_instancia_dispositivo');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}
	//////////////////////////////////////////////////////////////
	public function modificar_instancia_dispositivo2()
	{
		if($this->simple_sessions->get_value('status'))
		{
			$id = $_GET['id'];

			//obtengo informacion de la instancia
			$instancia = $this->Instancia_dispositivo->obtener_instancia_dispositivo($id);
			//paso el array a mi vista para mostrar los resultados
			$this->smarty->assign("instancia",$instancia);

			//Convertimos el id del departamento a su nombre pra mostarlo
            $nombre_dep = $this->Departamento->obtener_nombre_departamento_por_id($instancia->departamento);

            //En $dep meto todos los departamentos menos el obtenido de la BD
            $dep = $this->Departamento->obtener_nombre_departamentos_menos_uno($instancia->departamento);

            //Convertimos el id del pedido a su nombre pra mostarlo
            $nombre_ped = $this->Pedido->obtener_nombre_pedido_por_id($instancia->pedido);

            //En $pedido meto todos los pedidos menos el obtenido de la BD
            $pedido = $this->Pedido->obtener_nombre_pedidos_menos_uno($instancia->pedido);

            //Convertimos el id del estado_actual a su nombre pra mostarlo
            $nombre_estado = $this->Estado->obtener_nombre_estado_por_id($instancia->estado_actual);

            //En $estado meto todos los estados menos el obtenido de la BD
            $estado = $this->Estado->obtener_nombre_estados_menos_uno($instancia->estado_actual);

            $this->smarty->assign('nombre_dep',$nombre_dep);
            $this->smarty->assign('dep',$dep);
            $this->smarty->assign('nombre_ped',$nombre_ped);
            $this->smarty->assign('pedido',$pedido);
            $this->smarty->assign('nombre_estado',$nombre_estado);
            $this->smarty->assign('estado',$estado);


			$this->smarty->view('dispositivo/modificar_instancia_dispositivo_2');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}

//OK
	//////////////////////////////////////////////////////////////
	public function historico_instancia_dispositivo()
	{
		if($this->simple_sessions->get_value('status'))
		{
			//obtengo el nombre de todos los elemento de la tabla y los almaceno en un array
			$tipo = $this->Tipo_dispositivo->obtener_todos_tipos();
			//paso el array a mi vista para mostrar los resultados
			$this->smarty->assign("tipo",$tipo);

			$this->smarty->view('dispositivo/historico_estado_instancia_dispositivo');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}

//OK
	//////////////////////////////////////////////////////////////
	public function historico_instancia_dispositivo2()
	{
		if($this->simple_sessions->get_value('status'))
		{
			$id = $_GET['id'];

			$historico = $this->Secuencia_estado->obtener_historico_estados_inst_dispositivo($id);

			$i = 0;
			foreach ($historico as $fila) {
                //Obtenemos el nombre del estado
                $nombre_estado = $this->Estado->obtener_nombre_estado_por_id($fila->estado);
                //Actualizo mi array
                $historico[$i]->estado = $nombre_estado;

                //Obtenemos datos de la instancia asociada
                if($fila->instancia_relacion == 0)
                {
                    $instancia_asociada = NULL;
                }
                else
                {
                    $instancia = $this->Instancia_material->obtener_instancia_material($fila->instancia_relacion);
                    $instancia_asociada = $instancia->id.' // '.$instancia->part_number.' // '.$instancia->num_serie;;
                }
                //Actualizo mi array
                $historico[$i]->instancia_relacion = $instancia_asociada;
                $i++;
			}

			$this->smarty->assign('historico',$historico);

			$this->smarty->view('dispositivo/historico_instancia_dispositivo');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}

	//////////////////////////////////////////////////////////////
	public function visualizar_instancia_dispositivo()
	{
		if($this->simple_sessions->get_value('status'))
		{
			$id = $_GET['id'];

			//obtengo informacion de la instancia
			$instancia = $this->Instancia_dispositivo->obtener_instancia_dispositivo($id);

			//Obtengo informacion del dispositivo al que pertenece mi instancia
			$dispositivo = $this->Dispositivo->obtener_dispositivo_por_id($instancia->dispositivo);
			//Obtenemos tipo, marca y modelo de la instancia
			$tipo = $this->Tipo_dispositivo->obtener_nombre_tipo_por_id($dispositivo->tipo_dispositivo);
			$marca = $this->Marca->obtener_nombre_marca_por_id($dispositivo->marca);
			$modelo = $this->Modelo->obtener_nombre_modelo_por_id($dispositivo->modelo);

			//Convertimos el id del departamento a su nombre pra mostarlo
            $nombre_dep = $this->Departamento->obtener_nombre_departamento_por_id($instancia->departamento);

            //Convertimos el id del pedido a su nombre pra mostarlo
            $nombre_ped = $this->Pedido->obtener_nombre_pedido_por_id($instancia->pedido);

            //Convertimos el id del estado_actual a su nombre pra mostarlo
            $nombre_estado = $this->Estado->obtener_nombre_estado_por_id($instancia->estado_actual);

            //paso el array a mi vista para mostrar los resultados
			$this->smarty->assign("instancia",$instancia);
			$this->smarty->assign('tipo',$tipo);
			$this->smarty->assign('marca',$marca);
			$this->smarty->assign('modelo',$modelo);
            $this->smarty->assign('nombre_dep',$nombre_dep);
            $this->smarty->assign('nombre_ped',$nombre_ped);
            $this->smarty->assign('nombre_estado',$nombre_estado);

			$this->smarty->view('dispositivo/visualizar_instancia_dispositivo');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}
//////////////////////////////////////////////////////////////
//Fin de los métodos que me permiten moverme entre las vistas


//Metodo para dar de alta un tipo de dispositivo
//***********************************************
	public function addTipoDispositivo()
	{
		//validacion desde servidor
		$this->form_validation->set_rules('nombre','Nombre','required|trim|max_length[45]');

		//Si el formulario no fue bien
		if(!$this->form_validation->run())
		{//Cargamos la vista
			$this->alta_tipo_dispositivo();
		}
		else{
			//nos creamos un objeto y metemos los datos que vienen del formulario
			$tipo = new $this->Tipo_dispositivo();

			$tipo->nombre_tipo_dispositivo = $this->input->post('nombre');

			if($this->Tipo_dispositivo->set_tipo_dispositivo($tipo))
			{//mostramos un mensaje para dejar claro que ha sido agregado a la BD
				$this->smarty->assign("success", 'Tipo de dispositivo con nombre <strong>'.$tipo->nombre_tipo_dispositivo.'</strong> almacenado correctamente.');
			}
			else if(!$this->Tipo_dispositivo->set_tipo_dispositivo($tipo))
			{//Existe el dispositivo en la BD o no se ha insertado un dispositivo
				$this->smarty->assign("error", 'El tipo de dispositivo con nombre <strong>'.$tipo->nombre_tipo_dispositivo.'</strong> ya estaba almacenado.');
			}
			else
			{//ha habido error en la BD
				$this->smarty->assign("error", "Error en la base de datos.");
			}
			$this->alta_tipo_dispositivo();
		}
	}

//Metodo para dar de alta un tipo de dispositivo en un modal
//**********************************************************
	public function addTipoDispositivoModal()
	{
		//validacion desde servidor
		$this->form_validation->set_rules('nombre','Nombre','required|trim|max_length[45]');

		//Si el formulario no fue bien
		if(!$this->form_validation->run())
		{//Cargamos la vista
			$this->modal_alta_tipo_dispositivo();
		}
		else{
			//nos creamos un objeto y metemos los datos que vienen del formulario
			$tipo = new $this->Tipo_dispositivo();

			$tipo->nombre_tipo_dispositivo = $this->input->post('nombre');

			if($tipo->nombre_tipo_dispositivo == NULL)
			{
				$this->smarty->assign("error", "Debe indicar un nombre.");
			}
			else
			{
				if($this->Tipo_dispositivo->set_tipo_dispositivo($tipo))
				{//mostramos un mensaje para dejar claro que ha sido agregado a la BD
					$this->smarty->assign("success", 'Tipo de dispositivo con nombre <strong>'.$tipo->nombre_tipo_dispositivo.'</strong> almacenado correctamente.');
				}
				else if(!$this->Tipo_dispositivo->set_tipo_dispositivo($tipo))
				{//Existe el dispositivo en la BD o no se ha insertado un dispositivo
					$this->smarty->assign("error", 'El tipo de dispositivo con nombre <strong>'.$tipo->nombre_tipo_dispositivo.'</strong> ya estaba almacenado.');
				}
				else
				{//ha habido error en la BD
					$this->smarty->assign("error", "Error en la base de datos.");
				}
			}
			$this->modal_alta_tipo_dispositivo();
		}
	}

//Metodo para dar de alta un dispositivo
//**************************************
	public function addDispositivo()
	{
		//validacion desde servidor
		$this->form_validation->set_rules('tipo_dispositivo','Tipo','required|trim');
		$this->form_validation->set_rules('marca_dispositivo','Marca','required|trim');
		$this->form_validation->set_rules('modelo_dispositivo','Modelo','required|trim');

		//Si el formulario no fue bien
		if(!$this->form_validation->run())
		{//Cargamos la vista
			$this->alta_dispositivo();
		}
		else{
			//nos creamos un objeto y metemos los datos que vienen del formulario
			$dispositivo = new $this->Dispositivo();

			$dispositivo->tipo_dispositivo = $this->input->post('tipo_dispositivo');
			$dispositivo->marca            = $this->input->post('marca_dispositivo');
			$dispositivo->modelo           = $this->input->post('modelo_dispositivo');

			//Obtengo los nombres a partir de sus id's
			$tipo = $this->Tipo_dispositivo->obtener_nombre_tipo_por_id($dispositivo->tipo_dispositivo);
			$marca = $this->Marca->obtener_nombre_marca_por_id($dispositivo->marca);
			$modelo = $this->Modelo->obtener_nombre_modelo_por_id($dispositivo->modelo);

			if($this->Dispositivo->set_dispositivo($dispositivo))
			{//mostramos un mensaje para dejar claro que ha sido agregado a la BD
				$id = $this->Dispositivo->obtener_id_ultimo_dispositivo();

				$this->smarty->assign("success", 'El tipo de dispositivo <strong>'.$tipo.'</strong> con marca: <strong>'.$marca.'</strong> // modelo: <strong>'.$modelo .'</strong> y con id: <strong>'.$id.'</strong> se ha almacenado correctamente.');
			}
			else if(!$this->Dispositivo->set_dispositivo($dispositivo))
			{//Existe el dispositivo en la BD
				$this->smarty->assign("error", 'El tipo de dispositivo <strong>'.$tipo.'</strong> con marca: <strong>'.$marca.'</strong> // modelo: <strong>'.$modelo .'</strong> ya ha sido registrado.');
			}
			else
			{//ha habido error en la BD
				$this->smarty->assign("error", "Error en la base de datos.");
			}
			$this->alta_dispositivo();
		}
	}


//Metodo para dar de alta la instancia de un dispositivo
//******************************************************
	public function addInstanciaDispositivo()
	{
		//validacion desde servidor
		$this->form_validation->set_rules('part_number','Part number','required|trim|max_length[45]');
		$this->form_validation->set_rules('num_serie','Numero de serie','required|trim|max_length[45]');
		$this->form_validation->set_rules('fecha','Fecha de compra','trim');
		$this->form_validation->set_rules('garantia','Garantia','trim');
		$this->form_validation->set_rules('marca_dispositivo','marca','required|trim');
		$this->form_validation->set_rules('modelo_dispositivo','modelo','required|trim');
		$this->form_validation->set_rules('tipo_dispositivo','tipo','required|trim');
		$this->form_validation->set_rules('pedido','Pedido','required|trim');
		$this->form_validation->set_rules('departamento','Departamento','required|trim');

		//Si el formulario no fue bien
		if(!$this->form_validation->run())
		{//Cargamos la vista
			$this->alta_instancia_dispositivo();
		}
		else{
			//capturo marca y modelo seleccionados y a partir de ahí obtengo el id de dispositivo al que corresponde.
			$marca = $this->input->post('marca_dispositivo');
			$modelo = $this->input->post('modelo_dispositivo');
			$part_number = $this->input->post('part_number');
			$num_serie = $this->input->post('num_serie');
			$fecha = $this->input->post('fecha');
			$tipo = $this->input->post('tipo_dispositivo');
			$garantia = $this->input->post('garantia');
			$pedido = $this->input->post('pedido');
			$departamento = $this->input->post('departamento');

			//Obtengo los nombres a partir de sus id's
			$nombre_tipo = $this->Tipo_dispositivo->obtener_nombre_tipo_por_id($tipo);
			$nombre_marca = $this->Marca->obtener_nombre_marca_por_id($marca);
			$nombre_modelo = $this->Modelo->obtener_nombre_modelo_por_id($modelo);

			//Obtengo el id a partir de la marca y el modelo
			$id_dispositivo = $this->Dispositivo->obtener_dispositivo($marca,$modelo);

			//nos creamos un objeto y metemos los datos que vienen del formulario
			$instancia_dispositivo = new $this->Instancia_dispositivo();

			$instancia_dispositivo->tipo               = $tipo;
			$instancia_dispositivo->dispositivo        = $id_dispositivo;
			$instancia_dispositivo->part_number        = $part_number;
			$instancia_dispositivo->num_serie          = $num_serie;
			$instancia_dispositivo->fecha_compra       = $fecha;
			$instancia_dispositivo->garantia           = $garantia;
			$instancia_dispositivo->pedido             = $pedido;
			$instancia_dispositivo->departamento       = $departamento;
			$instancia_dispositivo->instancia_material = 0;
			$instancia_dispositivo->estado_actual      = 1;

			if($this->Instancia_dispositivo->set_instancia_dispositivo($instancia_dispositivo))
			{//Como la instancia se ha modificado correctamente en secuencia estados creo un registro de secuencia
				//Obtengo el id de la ultima instancia registrada
				$id_instancia_dispositivo = $this->Instancia_dispositivo->obtener_id_ultima_instancia();

				$secuencia = new $this->Secuencia_estado();

				$secuencia->fecha                 = $fecha;
				$secuencia->instancia_material    = 0;
				$secuencia->instancia_dispositivo = $id_instancia_dispositivo;
				$secuencia->instancia_relacion    = 0;
				$secuencia->part_number           = $part_number;
				$secuencia->num_serie             = $num_serie;
				$secuencia->id_material           = 0;
				$secuencia->id_dispositivo        = $id_dispositivo;
				$secuencia->estado                = 1;

				if($this->Secuencia_estado->set_secuencia_estado_dispositivo($secuencia))
				{//Todo corrio corretamente

					//Actualizo el dispositivo(Incrementar el contador)
					$contador = $this->Dispositivo->obtener_contador_dispositivo($id_dispositivo);
					$contador = $contador + 1;
					$dispositivo = array('contador' => $contador);

					if($this->Dispositivo->update_dispositivo($dispositivo,$id_dispositivo))
					{
						//mostramos un mensaje para dejar claro que ha sido agregado a la BD
						$this->smarty->assign("success", 'Instancia con tipo de dispositivo <strong>'.$nombre_tipo.'</strong> con marca: <strong>'.$nombre_marca.'</strong> // modelo: <strong>'.$nombre_modelo .'</strong> y con id: <strong>'.$id_instancia_dispositivo.'</strong> se ha almacenado correctamente.');
					}
				}
				else
				{
					$this->smarty->assign("error","No se ha podido almacenar el registro de estado.");
				}
			}
			else if(!$this->Instancia_dispositivo->set_instancia_dispositivo($instancia_dispositivo))
			{//Existe la instancia_dispositivo en la BD o no existe dispositivo con esa marca y modelo
				if($id_dispositivo == 0)
				{
					$this->smarty->assign("error",'No existe un dispositivo de tipo <strong>'.$nombre_tipo.'</strong> con la marca <strong>'.$nombre_marca.'</strong> y modelo <strong>'.$nombre_modelo .'</strong>.');
				}
				else
				{
					$this->smarty->assign("error", "La instancia ya existe en la base de datos.");
				}
			}
			else
			{//ha habido error en la BD
				$this->smarty->assign("error", "Error en la base de datos.");
			}
			$this->alta_instancia_dispositivo();
		}
	}

//Metodo para buscar instancias de dispositivo
//********************************************
	public function buscaInstanciaDispositivo()
	{
		//Capturo los datos
		$tipo_dispositivo = $this->input->post('tipo_dispositivo');
		$marca = $this->input->post('marca_dispositivo');
		$modelo = $this->input->post('modelo_dispositivo');
		$departamento = $this->input->post('departamento');
		$estado = $this->input->post('estado');
		$fecha_ini = $this->input->post('fecha_ini');
		$fecha_fin = $this->input->post('fecha_fin');

		//Los meto en un array
		$datos = array(
			'tipo_dispositivo' => $tipo_dispositivo,
			'marca_dispositivo' => $marca,
			'modelo_dispositivo' => $modelo,
			'departamento' => $departamento,
			'estado' => $estado,
			'fecha_ini' => $fecha_ini,
			'fecha_fin' => $fecha_fin
		);

		$this->load->library('pagination');

		$config = array();

		$desde = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;

		$config['per_page'] = 10;
		$config['base_url'] = base_url('dispositivo_controller/buscaInstanciaDispositivo');
		$config['total_rows'] = $this->Instancia_dispositivo->getNumInstancias($datos);
		$config['uri_segment'] = 3;
		$config['num_links'] = 2;
		$config['first_link'] = "&lt&lt";
		$config['last_link'] = "&gt&gt";
		//$config['display_pages'] = FALSE;

		$this->pagination->initialize($config);

		//Llamo a mi modelo y hago consulta
		$instancias = $this->Instancia_dispositivo->busca_instancia_dispositivo($datos,$config['per_page'],$desde);

		$paginacion = $this->pagination->create_links();

		$this->smarty->assign('paginacion',$paginacion);
		//devuelvo resultado y llamo a la nueva vista para que muestre resultados
		$this->smarty->assign("instancias", $instancias);
		$this->smarty->view('dispositivo/listar_busqueda_instancia');
	}

	public function GeneraPdfListadoDispositivo()
    {
        $this->load->library('Pdf');

        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        //Para orientar la pagina en horizontal (L) o vertical (P)
        //$pdf->setPageOrientation(PDF_PAGE_ORIENTATION);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Jose A. Moreno');
        $pdf->SetTitle('Listado PDF');
        $pdf->SetSubject('Listado de dispositivos');
        $pdf->SetKeywords('PDF, dispositivos, listado');

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
        $dispositivos = $this->Dispositivo->lista_dispositivos2();
        //preparamos y maquetamos el contenido a crear

        $num_dispositivos = count($dispositivos);

        $tbl = <<<EOD
        <style type=text/css>
            th{color: #000; font-weight: bold; background-color: #eee}
            td{background-color: #fff; color: #000}
        </style>
        <h2>Listado de Departamentos </h2>
        <table cellspacing="0" cellpadding="1" border="1">
            <tr>
            	<th width="40"> Id </th>
                <th width="180"> Tipo </th>
                <th width="210"> Marca </th>
                <th width="210"> Modelo </th>
            </tr>
EOD;
        //Componemos las filas con los registros de nuestra tabla
        foreach ($dispositivos as $fila)
        {
        	$id = $fila->id;
            $nombre = $fila->nombre_tipo_dispositivo;
            $marca = $fila->nombre_marca;
            $modelo = $fila->nombre_modelo;

            $tbl .=  <<<EOD
                    <tr>
                    	<td width="40" align="left"> $id </td>
                        <td width="180" align="left"> $nombre </td>
                        <td width="210" align="left"> $marca </td>
                        <td width="210" align="left"> $modelo </td>
                    </tr>
EOD;
        }
        $tbl .= "</table>";

        //Mostramos el contenido HTML
        $pdf->writeHTML($tbl, true, false, false, false, '');

        // ---------------------------------------------------------
        // Cerrar el documento PDF y preparamos la salida
        // Este método tiene varias opciones, consulte la documentación para más información.
        $nombre_archivo = utf8_decode("dispositivos.pdf");
        $pdf->Output($nombre_archivo, 'I');
    }

//Metodo para generar PDF
//***********************
    public function GeneraPdfInstanciaDispositivo()
    {
		//Capturo los datos
		$tipo_dispositivo = $this->input->post('tipo_dispositivo');
		$marca = $this->input->post('marca_dispositivo');
		$modelo = $this->input->post('modelo_dispositivo');
		$departamento = $this->input->post('departamento');
		$estado = $this->input->post('estado');
		$fecha_ini = $this->input->post('fecha_ini');
		$fecha_fin = $this->input->post('fecha_fin');

 		//Los meto en un array
		$datos = array(
			'tipo_dispositivo' => $tipo_dispositivo,
			'marca_dispositivo' => $marca,
			'modelo_dispositivo' => $modelo,
			'departamento' => $departamento,
			'estado' => $estado,
			'fecha_ini' => $fecha_ini,
			'fecha_fin' => $fecha_fin
		);

		$this->load->library('Pdf');

        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        //Para orientar la pagina en horizontal (L) o vertical (P)
        $pdf->setPageOrientation('L');
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Jose A. Moreno');
        $pdf->SetTitle('Listado PDF');
        $pdf->SetSubject('Listado de instancias de dispositivos');
        $pdf->SetKeywords('PDF, instancias dispositivos, instancias, listado');

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
        $instdispositivos = $this->Instancia_dispositivo->lista_instancia_dispositivos($datos);
        //preparamos y maquetamos el contenido a crear

        $num_instdispositivos = count($instdispositivos);

        $tbl = <<<EOD
        <style type=text/css>
            th{color: #000; font-weight: bold; background-color: #eee}
            td{background-color: #fff; color: #000}
        </style>
        <h2>Listado de Instancias de Dispositivos </h2>
        <table cellspacing="0" cellpadding="1" border="1">
            <tr>
                <th width="90"> Tipo </th>
                <th width="85"> Marca </th>
                <th width="85"> Modelo </th>
                <th width="40"> Id </th>
                <th width="135"> Part number </th>
                <th width="135"> Numero de serie </th>
                <th width="80"> Fecha </th>
                <th width="60"> Garantia </th>
                <th width="170"> Departamento </th>
                <th width="75"> Estado </th>
            </tr>
EOD;
        //Componemos las filas con los registros de nuestra tabla
        foreach ($instdispositivos as $fila)
        {
            $nombre = $fila->nombre_tipo_dispositivo;
            $marca = $fila->nombre_marca;
            $modelo = $fila->nombre_modelo;
            $id_instancia = $fila->id;
            $part_number = $fila->part_number;
            $num_serie = $fila->num_serie;
            $fecha = $fila->fecha_compra;
            $garantia = $fila->garantia;
            $departamento = $fila->nombre_departamento;
            $estado = $fila->nombre_estado;

            $tbl .=  <<<EOD
                    <tr>
                        <td width="90" align="left"> $nombre </td>
                        <td width="85" align="left"> $marca </td>
                        <td width="85" align="left"> $modelo </td>
                        <td width="40" align="left"> $id_instancia </td>
                        <td width="135" align="left"> $part_number </td>
                        <td width="135" align="left"> $num_serie </td>
                        <td width="80" align="left"> $fecha </td>
                        <td width="60" align="left"> $garantia </td>
                        <td width="170" align="left"> $departamento </td>
                        <td width="75" align="left"> $estado </td>
                    </tr>
EOD;
        }
        $tbl .= "</table>";

        //Mostramos el contenido HTML
        $pdf->writeHTML($tbl, true, false, false, false, '');

        // ---------------------------------------------------------
        // Cerrar el documento PDF y preparamos la salida
        // Este método tiene varias opciones, consulte la documentación para más información.
        $nombre_archivo = utf8_decode("instancias_dispositivos.pdf");
        $pdf->Output($nombre_archivo, 'I');
    }


//Metodo para modificar la instancia de un dispositivo
//****************************************************
	public function updateInstanciaDispositivo()
	{
		//validacion desde servidor
		$this->form_validation->set_rules('part_number','Part number','required|trim|min_length[3]|max_length[45]');
		$this->form_validation->set_rules('num_serie','Numero de serie','required|trim|min_length[3]|max_length[45]');
		$this->form_validation->set_rules('fecha','Fecha de compra','trim');
		$this->form_validation->set_rules('garantia','Garantia','trim');
		$this->form_validation->set_rules('pedido','Pedido','required|trim');
		$this->form_validation->set_rules('departamento','Departamento','required|trim');
		$this->form_validation->set_rules('estado_actual','Estado','required|trim');

		//Si el formulario no fue bien
		if(!$this->form_validation->run())
		{//Cargamos la vista
			$this->modificar_instancia_dispositivo();
		}
		else{
			//Pasa la validacion
			//Capturo el id de la instancia a modificar y los datos del formulario
			$id_inst_dispositivo = $this->input->post('id_inst_dispositivo');
			$part_number = $this->input->post('part_number');
			$num_serie = $this->input->post('num_serie');
			$fecha = $this->input->post('fecha');
			$garantia = $this->input->post('garantia');
			$pedido = $this->input->post('pedido');
			$departamento = $this->input->post('departamento');
			$estado_actual = $this->input->post('estado_actual');

			//Datos a introducir en la BD
			$datos = array(
				'part_number' => $part_number,
				'num_serie' => $num_serie,
				'fecha_compra' => $fecha,
				'garantia' => $this->input->post('garantia'),
				'pedido' => $pedido,
				'departamento' => $this->input->post('departamento'),
				'estado_actual' => $estado_actual
			);

			if($this->Instancia_dispositivo->update_instancia_dispositivo($datos,$id_inst_dispositivo))
			{
				//Obtengo el id perteneciente al dispositivo de esa instancia
				$dispositivo = $this->Instancia_dispositivo->obtener_dispositivo_instancia($id_inst_dispositivo);
				//obtengo el estado del registro mas actual de la instancia
				$estado = $this->Secuencia_estado->obtener_registro_estado_dispositivo($id_inst_dispositivo);
				//obtengo la instancia con la que esta asociada
				$instancia_asociada = $this->Instancia_dispositivo->obtener_inst_material($id_inst_dispositivo);

				if($estado == $estado_actual)
				{//No ha cambiado el estado y por tanto no insertamos registro en la tabla secuencia estados
					$this->smarty->assign("advertencia", 'Instancia con id: <strong>'.$id_inst_dispositivo.'</strong> modificada.<br>No se creó registro de estado porque sigue en el mismo estado.');
				}
				else
				{//Ha cambiado el estado y por tanto agregamos registro en la tabla secuencia estados
					$secuencia = new $this->Secuencia_estado();
					$secuencia->fecha = date("Y-m-d");
					$secuencia->instancia_material = 0;
					$secuencia->instancia_dispositivo = $id_inst_dispositivo;
					$secuencia->relacion = $instancia_asociada;
					$secuencia->part_number = $part_number;
					$secuencia->num_serie = $num_serie;
					$secuencia->id_material = 0;
					$secuencia->id_dispositivo = $dispositivo;
					$secuencia->estado = $estado_actual;

					if($this->Secuencia_estado->set_secuencia_estado_dispositivo($secuencia))
					{//mostramos un mensaje para dejar claro que ha sido agregado a la BD
						$this->smarty->assign("success", 'Instancia con id: <strong>'.$id_inst_dispositivo.'</strong> modificada.');
					}
				}
			}
			else
			{
				$this->smarty->assign('error','La Instancia con id: <strong>'.$id_inst_dispositivo.'</strong> no se ha modificado.');
			}
			$this->modificar_instancia_dispositivo();
		}
	}


//metodo para rellenar un select
//capturamos el id de mi tipo de dispositivo y mostramos las marcas en otro select
	public function tipo_dispositivo()
	{
		$id_tipo = $this->input->post('elegido');
		$this->Marca->muestra_marca_dispositivo($id_tipo);
	}


//funcion que permite capturar el valor elegido en un select para mostrar otro select con los modelos
	public function marca_dispositivo()
	{
		$id_marca = $this->input->post('elegido');
		$this->Modelo->muestra_modelo($id_marca);
	}

//metodo que me muestra una tabla con las instancias de un dispositivo seleccionado
	public function tabla_instancias_dispositivos()
	{
		$id_modelo = $this->input->post('elegido');
		$id_dispositivo = $this->Dispositivo->obtener_id_dispositivo($id_modelo);
		$this->Instancia_dispositivo->muestra_tabla_instancias_dispositivos($id_dispositivo);
	}

//funcion que permite capturar el valor elegido en un select para mostrar otro select con las instancias
	public function combo_instancia()
	{
		$id_modelo = $this->input->post('elegido');
		$id_dispositivo = $this->Dispositivo->obtener_id_dispositivo($id_modelo);
		$this->Instancia_dispositivo->muestra_combo_instancia($id_dispositivo);
	}

//metodo que me muestra un formulario con la instancia de un dispositivo a modificar
	public function modifica_instancia_dispositivo()
	{
		$id_instancia = $this->input->post('elegido');

		$this->Instancia_dispositivo->muestra_modifica_instancia_dispositivo($id_instancia);
	}

//metodo que me muestra un listado de estados con la instancia de un dispositivo seleccionada
	public function muestra_historico_instancia_dispositivo()
	{
		$id_instancia = $this->input->post('elegido');

		$this->Secuencia_estado->genera_historico_inst_dispositivo($id_instancia);
	}

	//funcion que permite capturar el valor elegido en un select para mostrar otro select con las marcas asociadas a ese tipo de dispositivo
	public function tipo_dispositivo3()
	{
		$id_tipo = $this->input->post('elegido');
		$this->Marca->muestra_marca_dispositivo($id_tipo);
	}
}
/* End of file  */
/* Location: ./application/controllers/ */