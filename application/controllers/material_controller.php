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

//Clase para gestionar los Materiales

class Material_controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('Material');
		$this->load->model('Tipo_material');
		$this->load->model('Tipo_dispositivo');
		$this->load->model('Instancia_material');
		$this->load->model('Instancia_dispositivo');
		$this->load->model('Dispositivo_material');
		$this->load->model('Dispositivo');
		$this->load->model('Secuencia_estado');
		$this->load->model('Marca');
		$this->load->model('Modelo');
		$this->load->model('Elemento');
		$this->load->model('Pedido');
		$this->load->model('Estado');
		$this->load->model('Edificio');
		$this->load->model('Mueble');
		$this->load->model('Habitacion');
		$this->load->model('Balda');
		$this->load->model('Ubicacion');
	}

	public function index()
	{
	}

//Metodos para redirigirme en el menu a las distintas vistas
//***********************************************************
	public function alta_tipo_material()
	{
		if($this->simple_sessions->get_value('status'))
		{
			$this->smarty->view('material/alta_tipo_material');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}
	//////////////////////////////////////////////////////////////
	public function modal_alta_tipo_material()
	{
		$this->smarty->view('material/modal_alta_tipo_material');
	}
	//////////////////////////////////////////////////////////////
	public function alta_material()
	{
		if($this->simple_sessions->get_value('status'))
		{
			//obtengo el nombre de todos los elemento de la tabla y los almaceno en un array
			$tipo = $this->Tipo_material->obtener_nombre_tipos();
			//paso el array a mi vista para mostrar los resultados
			$this->smarty->assign("tipo",$tipo);

			$tipod = $this->Tipo_dispositivo->obtener_nombre_tipos();
			//paso el array a mi vista para mostrar los resultados
			$this->smarty->assign("tipo_disp",$tipod);

			//obtengo el nombre de todos los tipos de dispositivo o de materiales de mi BD y los almaceno en un array
			$elemento = $this->Elemento->obtener_nombre_elementos();
			//paso el array a mi vista para mostrar los resultados
			$this->smarty->assign("elementos",$elemento);

			$this->smarty->view('material/alta_material');
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
	public function listar_material()
	{
		if($this->simple_sessions->get_value('status'))
		{
			$this->load->library('pagination');

			$config = array();

			$desde = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;

			$config['per_page'] = 10;
			$config['base_url'] = base_url('material_controller/listar_material');
			$config['total_rows'] = $this->Material->getNumMateriales();
			$config['uri_segment'] = 3;
			$config['num_links'] = 2;
			$config['first_link'] = "&lt&lt";
			$config['last_link'] = "&gt&gt";
			//$config['display_pages'] = FALSE;

			$this->pagination->initialize($config);

			$listado_materiales = $this->Material->lista_materiales($config['per_page'],$desde);

			$paginacion = $this->pagination->create_links();

			$this->smarty->assign('listado_materiales',$listado_materiales);
			$this->smarty->assign('paginacion',$paginacion);

			$this->smarty->view('material/listar_material');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}
//////////////////////////////////////////////////////////////
	public function buscar_instancia_material()
	{
		if($this->simple_sessions->get_value('status'))
		{
			//Dispositivo
			$tipo = $this->Tipo_material->obtener_todos_tipos();
			//paso el array a mi vista para mostrar los resultados
			$this->smarty->assign("material",$tipo);
			//Estados
			$estados = $this->Estado->obtener_todos_estados();
			//paso el array a mi vista para mostrar los resultados
			$this->smarty->assign("estado",$estados);

			$this->smarty->view('material/buscar_instancia_material');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}
//////////////////////////////////////////////////////////////
	public function modificar_instancia_material()
	{
		if($this->simple_sessions->get_value('status'))
		{
			//cargo un listado de todos los tipos de materiales que posee mi tabla
			$tipos = $this->Tipo_material->obtener_todos_tipos();
			//Los asigno a un array de smarty para pasarlos a mi vista
			$this->smarty->assign("tipo",$tipos);

			$this->smarty->view('material/modificar_instancia_material');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}
//////////////////////////////////////////////////////////////
	public function desasociar_instancia_material()
	{
		if($this->simple_sessions->get_value('status'))
		{
			//cargo un listado de todos los tipos de materiales que posee mi tabla
			$tipos = $this->Tipo_material->obtener_todos_tipos();
			//Los asigno a un array de smarty para pasarlos a mi vista
			$this->smarty->assign("tipo_mat",$tipos);

			//obtengo el nombre de todos los elemento de la tabla y los almaceno en un array
			$tipos = $this->Tipo_dispositivo->obtener_todos_tipos();
			//paso el array a mi vista para mostrar los resultados
			$this->smarty->assign("tipo_disp",$tipos);

			//Estados
			$estados = $this->Estado->obtener_todos_estados();
			//paso el array a mi vista para mostrar los resultados
			$this->smarty->assign("estado",$estados);

			$this->smarty->view('material/desasociar_instancia_material');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}
//////////////////////////////////////////////////////////////
	public function asociar_instancia_material()
	{
		if($this->simple_sessions->get_value('status'))
		{
			//cargo un listado de todos los tipos de materiales que posee mi tabla
			$tipos = $this->Tipo_material->obtener_todos_tipos();
			//Los asigno a un array de smarty para pasarlos a mi vista
			$this->smarty->assign("tipo_mat",$tipos);

			//obtengo el nombre de todos los elemento de la tabla y los almaceno en un array
			$tipos = $this->Tipo_dispositivo->obtener_todos_tipos();
			//paso el array a mi vista para mostrar los resultados
			$this->smarty->assign("tipo_disp",$tipos);

			$this->smarty->view('material/asociar_instancia_material');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}
//OK
	//////////////////////////////////////////////////////////////
	public function historico_instancia_material()
	{
		if($this->simple_sessions->get_value('status'))
		{
			//obtengo el nombre de todos los elemento de la tabla y los almaceno en un array
			$tipo = $this->Tipo_material->obtener_todos_tipos();
			//paso el array a mi vista para mostrar los resultados
			$this->smarty->assign("tipo",$tipo);

			$this->smarty->view('material/historico_estado_instancia_material');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}
	//////////////////////////////////////////////////////////////
	public function alta_ubicacion()
	{
		if($this->simple_sessions->get_value('status'))
		{
			//cargo un listado de todos los edificios que tengo registrados
			$edificio = $this->Edificio->obtener_todos_edificios();
			//Los asigno a un array de smarty para pasarlos a mi vista
			$this->smarty->assign("edificio",$edificio);

			$this->smarty->view('ubicacion/alta_ubicacion_desde_instancia');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}

		//////////////////////////////////////////////////////////////
	public function modificar_instancia_material2()
	{
		if($this->simple_sessions->get_value('status'))
		{
			$id = $_GET['id'];

			//obtengo informacion de la instancia
			$instancia = $this->Instancia_material->obtener_instancia_material($id);
			//paso el array a mi vista para mostrar los resultados
			$this->smarty->assign("instancia",$instancia);

            //Convertimos el id del pedido a su nombre pra mostarlo
            $nombre_ped = $this->Pedido->obtener_nombre_pedido_por_id($instancia->pedido);

            //En $pedido meto todos los pedidos menos el obtenido de la BD
            $pedido = $this->Pedido->obtener_nombre_pedidos_menos_uno($instancia->pedido);

            //Convertimos el id del estado_actual a su nombre pra mostarlo
            $nombre_estado = $this->Estado->obtener_nombre_estado_por_id($instancia->estado_actual);

            //En $estado meto todos los estados menos el obtenido de la BD
            $estado = $this->Estado->obtener_nombre_estados_menos_uno($instancia->estado_actual);


            $this->smarty->assign('nombre_ped',$nombre_ped);
            $this->smarty->assign('pedido',$pedido);
            $this->smarty->assign('nombre_estado',$nombre_estado);
            $this->smarty->assign('estado',$estado);


			$this->smarty->view('material/modificar_instancia_material_2');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}

//OK
	//////////////////////////////////////////////////////////////
	public function historico_instancia_material2()
	{
		if($this->simple_sessions->get_value('status'))
		{
			$id = $_GET['id'];

			$historico = $this->Secuencia_estado->obtener_historico_estados_inst_material($id);

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
                    $instancia = $this->Instancia_dispositivo->obtener_instancia_dispositivo($fila->instancia_relacion);
                    $instancia_asociada = $instancia->id.' // '.$instancia->part_number.' // '.$instancia->num_serie;;
                }
                //Actualizo mi array
                $historico[$i]->instancia_relacion = $instancia_asociada;
                $i++;
			}

			$this->smarty->assign('historico',$historico);

			$this->smarty->view('material/historico_instancia_material');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}

	//////////////////////////////////////////////////////////////
	public function visualizar_instancia_material()
	{
		if($this->simple_sessions->get_value('status'))
		{
			$id = $_GET['id'];

			//obtengo informacion de la instancia
			$instancia = $this->Instancia_material->obtener_instancia_material($id);

			//Obtenemos datos de la instancia asociada
			if($instancia->instancia_dispositivo == 0)
			{
			    $instancia_asociada = NULL;
			}
			else
			{
			    $instancia_dispo = $this->Instancia_dispositivo->obtener_instancia_dispositivo($instancia->instancia_dispositivo);
			    $instancia_asociada = $instancia_dispo->id.' // '.$instancia_dispo->part_number.' // '.$instancia_dispo->num_serie;;
			}

			//Obtengo informacion del material al que pertenece mi instancia
			$material = $this->Material->obtener_material_por_id($instancia->material);
			//Obtenemos tipo, marca y modelo de la instancia
			$tipo = $this->Tipo_material->obtener_nombre_tipo_por_id($material->tipo_material);
			$marca = $this->Marca->obtener_nombre_marca_por_id($material->marca);
			$modelo = $this->Modelo->obtener_nombre_modelo_por_id($material->modelo);

            //Convertimos el id del pedido a su nombre pra mostarlo
            $nombre_ped = $this->Pedido->obtener_nombre_pedido_por_id($instancia->pedido);

            //Convertimos el id del estado_actual a su nombre pra mostarlo
            $nombre_estado = $this->Estado->obtener_nombre_estado_por_id($instancia->estado_actual);

            //paso el array a mi vista para mostrar los resultados
			$this->smarty->assign("instancia",$instancia);
			$this->smarty->assign("instancia_asociada",$instancia_asociada);
			$this->smarty->assign('tipo',$tipo);
			$this->smarty->assign('marca',$marca);
			$this->smarty->assign('modelo',$modelo);
            $this->smarty->assign('nombre_ped',$nombre_ped);
            $this->smarty->assign('nombre_estado',$nombre_estado);

			$this->smarty->view('material/visualizar_instancia_material');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}
//////////////////////////////////////////////////////////////
//Fin de los métodos que me permiten moverme entre las vistas

//////////////////////////////////////////////////////////////////////////////////////////
//Uso este metodo para recargarme el select una vez que inserto un registro desde un modal
//////////////////////////////////////////////////////////////////////////////////////////
	public function dame_tipos()
	{
		//obtengo el nombre de todos los elemento de la tabla y los almaceno en un array
		$tipo = $this->Tipo_material->obtener_nombre_tipos();
		//paso el array a mi vista para mostrar los resultados
		$this->smarty->assign("tipo_mat",$tipo);

		$this->smarty->view('material/dame_tipos');
	}

//Metodo para dar de alta un tipo de material
//*******************************************
	public function addTipoMaterial()
	{
		//validacion desde servidor
		$this->form_validation->set_rules('nombre','Nombre','required|trim|max_length[45]');

		//Si el formulario no fue bien
		if(!$this->form_validation->run())
		{//Cargamos la vista
			$this->alta_tipo_material();
		}
		else{
			//nos creamos un objeto y metemos los datos que vienen del formulario
			$tipo = new $this->Tipo_material();

			$tipo->nombre_tipo_material = $this->input->post('nombre');

			if($this->Tipo_material->set_tipo_material($tipo))
			{//mostramos un mensaje para dejar claro que ha sido agregado a la BD
				$this->smarty->assign("success", 'Tipo de material con nombre <strong>'.$tipo->nombre_tipo_material.'</strong> almacenado correctamente.');
			}
			else if(!$this->Tipo_material->set_tipo_material($tipo))
			{//Existe el material en la BD
				$this->smarty->assign("error", 'El tipo de material con nombre <strong>'.$tipo->nombre_tipo_material.'</strong> ya estaba almacenado.');
			}
			else
			{//ha habido error en la BD
				$this->smarty->assign("error", "Error en la base de datos.");
			}
			$this->alta_tipo_material();
		}
	}

	//Metodo para dar de alta un tipo de material
	//*******************************************
	public function addTipoMaterialModal()
	{
		//validacion desde servidor
		$this->form_validation->set_rules('nombre','Nombre','required|trim|max_length[45]');

		//Si el formulario no fue bien
		if(!$this->form_validation->run())
		{//Cargamos la vista
			$this->modal_alta_tipo_material();
		}
		else{
			//nos creamos un objeto y metemos los datos que vienen del formulario
			$tipo = new $this->Tipo_material();

			$tipo->nombre_tipo_material = $this->input->post('nombre');

			if($tipo->nombre_tipo_material == NULL)
			{
				$this->smarty->assign("error", "Debe indicar un nombre.");
			}
			else
			{
				if($this->Tipo_material->set_tipo_material($tipo))
			{//mostramos un mensaje para dejar claro que ha sido agregado a la BD
				$this->smarty->assign("success", 'Tipo de material con nombre <strong>'.$tipo->nombre_tipo_material.'</strong> almacenado correctamente.');
			}
			else if(!$this->Tipo_material->set_tipo_material($tipo))
			{//Existe el material en la BD
				$this->smarty->assign("error", 'El tipo de material con nombre <strong>'.$tipo->nombre_tipo_material.'</strong> ya estaba almacenado.');
			}
			else
			{//ha habido error en la BD
				$this->smarty->assign("error", "Error en la base de datos.");
			}
			}
			$this->modal_alta_tipo_material();
		}
	}

//OK
//Metodo para dar de alta un material
//***********************************
	public function addMaterial()
	{
		//validacion desde servidor
		$this->form_validation->set_rules('tipo_material','Tipo','required|trim');
		$this->form_validation->set_rules('marca_material','Marca','required|trim');
		$this->form_validation->set_rules('modelo_material','Modelo','required|trim');

		//Si el formulario no fue bien
		if(!$this->form_validation->run())
		{//Cargamos la vista
			$this->alta_material();
		}
		else{
			//obtengo un array con todas las opciones de dispositivos compatibles seleccionados (con los ID)
			$compatibles = $this->input->post('caja_dispositivo');
			//Capturamos el resto de datos
			$marca = $this->input->post('marca_material');
			$modelo = $this->input->post('modelo_material');
			$tipo = $this->input->post('tipo_material');

			//nos creamos un objeto y metemos los datos que vienen del formulario
			$material = new $this->Material();
			$material->tipo_material = $tipo;
			$material->marca         = $marca;
			$material->modelo        = $modelo;

			//Obtengo los nombres a partir de sus id's
			$nombre_tipo = $this->Tipo_material->obtener_nombre_tipo_por_id($material->tipo_material);
			$nombre_marca = $this->Marca->obtener_nombre_marca_por_id($material->marca);
			$nombre_modelo = $this->Modelo->obtener_nombre_modelo_por_id($material->modelo);

			if($this->Material->set_material($material))
			{//almacenamos en nuestra BD el material y seguidamente actualizamos nuestra tabla M:M
				//obtengo id del material y paso el id del material y un array con todos los id de los dispositivos con los que es compatible ese material
				$id_material = $this->Material->obtener_id_ultimo_material();

				if($compatibles != "")
				{
					//actualizo mi tabla M:M
					$this->Dispositivo_material->set_dispositivos_materiales($id_material, $compatibles);
				}
				//mostramos un mensaje para dejar claro que ha sido agregado a la BD
				$this->smarty->assign("success", 'El tipo de material <strong>'.$nombre_tipo.'</strong> con marca: <strong>'.$nombre_marca.'</strong> // modelo: <strong>'.$nombre_modelo .'</strong> y con id: <strong>'.$id_material.'</strong> se ha almacenado correctamente.');
			}
			else if(!$this->Material->set_material($material))
			{//Existe el material en la BD
				$this->smarty->assign("error", 'El tipo de material <strong>'.$nombre_tipo.'</strong> con marca: <strong>'.$nombre_marca.'</strong> // modelo: <strong>'.$nombre_modelo .'</strong> ya ha sido registrado.');
			}
			else
			{//ha habido error en la BD
				$this->smarty->assign("error", "Error en la base de datos.");
			}
			$this->alta_material();
		}
	}

//Metodo para dar de alta la instancia de un material
//***************************************************
	public function addInstanciaMaterial()
	{
		//validacion desde servidor
		$this->form_validation->set_rules('part_number','Part number','required|trim|max_length[45]');
		$this->form_validation->set_rules('num_serie','Numero de serie','required|trim|max_length[45]');
		$this->form_validation->set_rules('fecha','Fecha de compra','trim');
		$this->form_validation->set_rules('garantia','Garantia','trim');
		$this->form_validation->set_rules('tipo_material','tipo','required|trim');
		$this->form_validation->set_rules('marca_material','marca','required|trim');
		$this->form_validation->set_rules('modelo_material','modelo','required|trim');
		$this->form_validation->set_rules('pedido','Pedido','required|trim');


		//Si el formulario no fue bien
		if(!$this->form_validation->run())
		{//Cargamos la vista
			$this->alta_instancia_material();
		}
		else{
			//capturo marca y modelo seleccionados y a partir de ahí obtengo el id de material al que corresponde.
			$tipo = $this->input->post('tipo_material');
			$marca = $this->input->post('marca_material');
			$modelo = $this->input->post('modelo_material');
			$part_number = $this->input->post('part_number');
			$num_serie = $this->input->post('num_serie');
			$fecha = $this->input->post('fecha');
			$garantia = $this->input->post('garantia');
			$pedido = $this->input->post('pedido');

			//Obtengo los nombres a partir de sus id's
			$nombre_tipo = $this->Tipo_material->obtener_nombre_tipo_por_id($tipo);
			$nombre_marca = $this->Marca->obtener_nombre_marca_por_id($marca);
			$nombre_modelo = $this->Modelo->obtener_nombre_modelo_por_id($modelo);

			//Obtengo el id a partir de la marca y el modelo
			$id_material = $this->Material->obtener_material($marca,$modelo);

			//nos creamos un objeto y metemos los datos que vienen del formulario
			$instancia = new $this->Instancia_material();

			$instancia->material              = $id_material;
			$instancia->part_number           = $part_number;
			$instancia->num_serie             = $num_serie;
			$instancia->fecha_compra          = $fecha;
			$instancia->garantia              = $garantia;
			$instancia->pedido                = $pedido;
			$instancia->instancia_dispositivo = 0;
			$instancia->estado_actual         = 1;

			if($this->Instancia_material->set_instancia_material($instancia))
			{//Como la instancia se ha modificado correctamente en secuencia estados creo un registro de secuencia
				$id_instancia_material = $this->Instancia_material->obtener_id_ultima_instancia();

				$secuencia = new $this->Secuencia_estado();

				$secuencia->fecha                 = $fecha;
				$secuencia->instancia_material    = $id_instancia_material;
				$secuencia->instancia_dispositivo = 0;
				$secuencia->instancia_relacion    = 0;
				$secuencia->part_number           = $part_number;
				$secuencia->num_serie             = $num_serie;
				$secuencia->id_material           = $id_material;
				$secuencia->id_dispositivo        = 0;
				$secuencia->estado                = 1;

				if($this->Secuencia_estado->set_secuencia_estado_material($secuencia))
				{//Todo corrio corretamente

					//Actualizo el material(Incrementar el contador)
						$contador = $this->Material->obtener_contador_material($id_material);
						$contador = $contador + 1;
						$material = array(
							'contador' => $contador
						);
					if($this->Material->update_material($material,$id_material))
					{
						$this->smarty->assign('id_instancia',$id_instancia_material);
						$this->smarty->assign('tipo',$nombre_tipo);
						$this->smarty->assign('marca',$nombre_marca);
						$this->smarty->assign('modelo',$nombre_modelo);
						//mostramos un mensaje para dejar claro que ha sido agregado a la BD
						$this->smarty->assign("success", 'Instancia con tipo de material <strong>'.$nombre_tipo.'</strong> con marca: <strong>'.$nombre_marca.'</strong> // modelo: <strong>'.$nombre_modelo .'</strong> y con id: <strong>'.$id_instancia_material.'</strong> se ha almacenado correctamente.');
						//Aqui podemos ir a registrar la ubicacion del material
						$this->alta_ubicacion();
					}
				}
				else
				{
					$this->smarty->assign("error","No se ha podido almacenar el registro de estado.");
					$this->alta_instancia_material();
				}
			}
			else if(!$this->Instancia_material->set_instancia_material($instancia))
			{//Existe la instancia en la BD o no xiste material con esa marca y modelo
				if($id_material == 0)
				{
					$this->smarty->assign("error",'No existe un material de tipo <strong>'.$nombre_tipo.'</strong> con la marca <strong>'.$nombre_marca.'</strong> y modelo <strong>'.$nombre_modelo .'</strong>.');
					$this->alta_instancia_material();
				}
				else
				{
					$this->smarty->assign("error", "La instancia ya existe en la base de datos.");
					$this->alta_instancia_material();
				}
			}
			else
			{//ha habido error en la BD
				$this->smarty->assign("error", "Error en la base de datos.");
				$this->alta_instancia_material();
			}
		}
	}

//Metodo para generar listado de todos los materiales
//***************************************************
	public function GeneraPdfListadoMaterial()
    {
        $this->load->library('Pdf');

        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        //Para orientar la pagina en horizontal (L) o vertical (P)
        //$pdf->setPageOrientation(PDF_PAGE_ORIENTATION); 
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Jose A. Moreno');
        $pdf->SetTitle('Listado PDF');
        $pdf->SetSubject('Listado de materiales');
        $pdf->SetKeywords('PDF, materiales, listado');

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
        $materiales = $this->Material->lista_materiales2();
        //preparamos y maquetamos el contenido a crear

        $num_materiales = count($materiales);

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
        foreach ($materiales as $fila) 
        {
        	$id = $fila->id;
            $nombre = $fila->nombre_tipo_material;
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
        $nombre_archivo = utf8_decode("materiales.pdf");
        $pdf->Output($nombre_archivo, 'I');
    }

    public function GeneraPdfInstanciaMaterial()
    {
    	//Capturo los datos
		$tipo_material = $this->input->post('tipo_material');
		$marca = $this->input->post('marca_material');
		$modelo = $this->input->post('modelo_material');
		$estado = $this->input->post('estado');
		$fecha_ini = $this->input->post('fecha_ini');
		$fecha_fin = $this->input->post('fecha_fin');

		//Los meto en un array
		$datos = array(
			'tipo_material' => $tipo_material,
			'marca_material' => $marca,
			'modelo_material' => $modelo,
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
        $pdf->SetSubject('Listado de instancias de materiales');
        $pdf->SetKeywords('PDF, instancias materiales, instancias, listado');

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
        $instmateriales = $this->Instancia_material->lista_instancia_materiales($datos);
        //preparamos y maquetamos el contenido a crear

        $num_instmateriales = count($instmateriales);

        $tbl = <<<EOD
        <style type=text/css>
            th{color: #000; font-weight: bold; background-color: #eee}
            td{background-color: #fff; color: #000}
        </style>
        <h2>Listado de Instancias de Materiales </h2>
        <table cellspacing="0" cellpadding="1" border="1">
            <tr>
                <th width="130"> Tipo </th>
                <th width="120"> Marca </th>
                <th width="120"> Modelo </th>
                <th width="40"> Id </th>
                <th width="135"> Part number </th>
                <th width="135"> Numero de serie </th>
                <th width="95"> Fecha </th>
                <th width="70"> Garantia </th>
                <th width="100"> Estado </th>
            </tr>
EOD;
        //Componemos las filas con los registros de nuestra tabla
        foreach ($instmateriales as $fila)
        {
            $nombre = $fila->nombre_tipo_material;
            $marca = $fila->nombre_marca;
            $modelo = $fila->nombre_modelo;
            $id_instancia = $fila->id;
            $part_number = $fila->part_number;
            $num_serie = $fila->num_serie;
            $fecha = $fila->fecha_compra;
            $garantia = $fila->garantia;
            $estado = $fila->nombre_estado;

            $tbl .=  <<<EOD
                    <tr>
                        <td width="130" align="left"> $nombre </td>
                        <td width="120" align="left"> $marca </td>
                        <td width="120" align="left"> $modelo </td>
                        <td width="40" align="left"> $id_instancia </td>
                        <td width="135" align="left"> $part_number </td>
                        <td width="135" align="left"> $num_serie </td>
                        <td width="95" align="left"> $fecha </td>
                        <td width="70" align="left"> $garantia </td>
                        <td width="100" align="left"> $estado </td>
                    </tr>
EOD;
        }
        $tbl .= "</table>";

        //Mostramos el contenido HTML
        $pdf->writeHTML($tbl, true, false, false, false, '');

        // ---------------------------------------------------------
        // Cerrar el documento PDF y preparamos la salida
        // Este método tiene varias opciones, consulte la documentación para más información.
        $nombre_archivo = utf8_decode("instancias_materiales.pdf");
        $pdf->Output($nombre_archivo, 'I');
    }

	//Metodo para modificar la instancia de un material
	//El estado por el que pasa el material no se puede repetir
	public function updateInstanciaMaterial()
	{
		//validacion desde servidor
		$this->form_validation->set_rules('part_number','Part number','required|trim|min_length[3]|max_length[45]');
		$this->form_validation->set_rules('num_serie','Numero de serie','required|trim|min_length[3]|max_length[45]');
		$this->form_validation->set_rules('fecha','Fecha de compra','trim');
		$this->form_validation->set_rules('garantia','Garantia','trim');
		$this->form_validation->set_rules('pedido','Pedido','required|trim');
		$this->form_validation->set_rules('estado_actual','Estado','required|trim');

		//Si el formulario no fue bien
		if(!$this->form_validation->run())
		{//Cargamos la vista
			$this->modificar_instancia_material();
		}
		else{
			//Pasa la validacion
			//Capturo el id de la instancia a modificar con los demas campos
			$id_inst_material = $this->input->post('id_inst_material');
			$part_number = $this->input->post('part_number');
			$num_serie = $this->input->post('num_serie');
			$fecha = $this->input->post('fecha');
			$garantia = $this->input->post('garantia');
			$estado_actual = $this->input->post('estado_actual');
			$pedido = $this->input->post('pedido');

			//meto los datos del formulario a modificar en un array
			$datos = array(
				'part_number' => $part_number,
				'num_serie' => $num_serie,
				'fecha_compra' => $fecha,
				'garantia' => $garantia,
				'pedido' => $pedido,
				'estado_actual' => $estado_actual
			);

			if($this->Instancia_material->update_instancia_material($datos,$id_inst_material))
			{
				//Obtengo el id perteneciente al material de esa instancia
				$material = $this->Instancia_material->obtener_material_instancia($id_inst_material);
				//obtengo el estado del registro mas actual de la instancia
				$estado = $this->Secuencia_estado->obtener_registro_estado_material($id_inst_material);
				//obtengo la instancia con la que esta asociada
				$instancia_asociada = $this->Instancia_material->obtener_inst_dispositivo($id_inst_material);

				if($estado == $estado_actual)
				{//No ha cambiado el estado y por tanto no insertamos registro en la tabla secuencia estados
					$this->smarty->assign("advertencia", "Instancia modificada.No se creó registro de estado porque sigue en el mismo estado.");
				}
				else
				{//Ha cambiado el estado y por tanto agregamos registro en la tabla secuencia estados
					$secuencia = new $this->Secuencia_estado();
					$secuencia->fecha = date("Y-m-d");
					$secuencia->instancia_material = $id_inst_material;
					$secuencia->instancia_dispositivo = 0;
					$secuencia->instancia_relacion = $instancia_asociada;
					$secuencia->part_number = $part_number;
					$secuencia->num_serie = $num_serie;
					$secuencia->id_material = $material;
					$secuencia->id_dispositivo = 0;
					$secuencia->estado = $estado_actual;
					if($this->Secuencia_estado->set_secuencia_estado_material($secuencia))
					{//mostramos un mensaje para dejar claro que ha sido agregado a la BD
						$this->smarty->assign("success", 'Instancia con id: <strong>'.$id_inst_material.'</strong> modificada.');
					}
				}
			}
			else
			{
				$this->smarty->assign('error','La Instancia con id: <strong>'.$id_inst_material.'</strong> no se ha modificado.');
			}
			$this->modificar_instancia_material();
		}
	}

	//Metodo para buscar instancias de dispositivo
	//********************************************
	public function buscaInstanciaMaterial()
	{
		//Capturo los datos
		$tipo_material = $this->input->post('tipo_material');
		$marca = $this->input->post('marca_material');
		$modelo = $this->input->post('modelo_material');
		$estado = $this->input->post('estado');
		$fecha_ini = $this->input->post('fecha_ini');
		$fecha_fin = $this->input->post('fecha_fin');

		//Los meto en un array
		$datos = array(
			'tipo_material' => $tipo_material,
			'marca_material' => $marca,
			'modelo_material' => $modelo,
			'estado' => $estado,
			'fecha_ini' => $fecha_ini,
			'fecha_fin' => $fecha_fin
		);

		$this->load->library('pagination');

		$config = array();

		$desde = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;

		$config['per_page'] = 10;
		$config['base_url'] = base_url('material_controller/buscaInstanciaMaterial');
		$config['total_rows'] = $this->Instancia_material->getNumInstancias($datos);
		$config['uri_segment'] = 3;
		$config['num_links'] = 2;
		$config['first_link'] = "&lt&lt";
		$config['last_link'] = "&gt&gt";
		//$config['display_pages'] = FALSE;

		$this->pagination->initialize($config);

		//Llamo a mi modelo y hago consulta
		$instancias = $this->Instancia_material->busca_instancia_material($datos,$config['per_page'],$desde);

		$paginacion = $this->pagination->create_links();

		$this->smarty->assign('paginacion',$paginacion);
		//devuelvo resultado y llamo a la nueva vista para que muestre resultados
		$this->smarty->assign("instancias", $instancias);
		$this->smarty->view('material/listar_busqueda_instancia');
	}

	public function asocia_dispositivo_material()
	{
		//obtengo el id del material al que pertenece la instancia de material a partir de su tipo,marca y modelo.
		$tipo_mat = $this->input->post('tipo_material');
		$marca_mat = $this->input->post('marca_material');
		$modelo_mat = $this->input->post('modelo_material');
		$id_material = $this->Material->obtener_id_material2($tipo_mat,$marca_mat,$modelo_mat);
		//obtengo el id del dispositivo al que pertenece la instancia de dispositivo a partir de su tipo,marca y modelo.
		$tipo_disp = $this->input->post('tipo_dispositivo');
		$marca_disp = $this->input->post('marca_dispositivo');
		$modelo_disp = $this->input->post('modelo_dispositivo');
		$id_dispositivo = $this->Dispositivo->obtener_id_dispositivo2($tipo_disp,$marca_disp,$modelo_disp);

		//Obtengo los nombres de dispositivo a partir de sus id's
		//$nombre_tipo_dispositivo = $this->Tipo_dispositivo->obtener_nombre_tipo_por_id($tipo_disp);
		$nombre_marca_dispositivo = $this->Marca->obtener_nombre_marca_por_id($marca_disp);
		$nombre_modelo_dispositivo = $this->Modelo->obtener_nombre_modelo_por_id($modelo_disp);

		//Obtengo los nombres de material a partir de sus id's
		//$nombre_tipo_material = $this->Tipo_material->obtener_nombre_tipo_por_id($tipo_mat);
		$nombre_marca_material = $this->Marca->obtener_nombre_marca_por_id($marca_mat);
		$nombre_modelo_material = $this->Modelo->obtener_nombre_modelo_por_id($modelo_mat);

		//cuando tengo el id del material y el id del dispositivo miro si tienen relacion.
		if($this->Dispositivo_material->estan_relacionados($id_material,$id_dispositivo))
		{//Estan relacionados
			//Compruebo que el contador de alguno de esos materiales sea mayor que 0, eso corrobora que posee instancias.
			$contador_dispositivo = $this->Dispositivo->obtener_contador_dispositivo($id_dispositivo);
			$contador_material = $this->Material->obtener_contador_material($id_material);
			if( ($contador_dispositivo > 0) && ($contador_material > 0) )
			{
				//Capturo el id de la instancia de material
				$id_inst_material = $this->input->post('instancia_material');
				//Captuto el id de la instancia de dispositivo
				$id_inst_dispositivo = $this->input->post('instancia_dispositivo');

				$data_mat = array(
					'relacionado' => "si",
					'instancia_dispositivo' => $id_inst_dispositivo,
					'estado_actual' => 2
				);
				//Actualizo la instancia de material
				if($this->Instancia_material->update_instancia_material($data_mat,$id_inst_material))
				{
					$data_disp = array(
						'relacionado' => "si",
						'instancia_material' => $id_inst_material,
						'estado_actual' => 2
					);
					//Actualizo la instancia de dispositivo
					if($this->Instancia_dispositivo->update_instancia_dispositivo($data_disp,$id_inst_dispositivo))
					{//Actualizo el material(Decrementar el contador)
						$contador_material = $contador_material - 1;
						$material = array(
							'contador' => $contador_material
						);
						if($this->Material->update_material($material,$id_material))
						{//Actualizo el material(Decrementar el contador)

							$contador_dispositivo = $contador_dispositivo - 1;
							$dispositivo = array(
								'contador' => $contador_dispositivo
							);
							if($this->Dispositivo->update_dispositivo($dispositivo,$id_dispositivo))
							{
								//Creo secuencia nueva para el dispositivo y para el material
								//Obtengo num_serie y part_number
								$inst_material = $this->Instancia_material->obtener_instancia_material($id_inst_material);

								$secuencia_material = new $this->Secuencia_estado();

								$secuencia_material->fecha = date("Y-m-d");
								$secuencia_material->instancia_material = $id_inst_material;
								$secuencia_material->instancia_dispositivo = 0;
								$secuencia_material->instancia_relacion = $id_inst_dispositivo;
								$secuencia_material->part_number = $inst_material->part_number;
								$secuencia_material->num_serie = $inst_material->num_serie;
								$secuencia_material->id_material = $id_material;
								$secuencia_material->id_dispositivo = 0;
								$secuencia_material->estado = 2;

								$correcto_material = $this->Secuencia_estado->set_secuencia_estado_material($secuencia_material);
								//Obtengo num_serie y part_number
								$inst_dispositivo = $this->Instancia_dispositivo->obtener_instancia_dispositivo($id_inst_dispositivo);

								$secuencia_dispositivo = new $this->Secuencia_estado();

								$secuencia_dispositivo->fecha = date("Y-m-d");
								$secuencia_dispositivo->instancia_material = 0;
								$secuencia_dispositivo->instancia_dispositivo = $id_inst_dispositivo;
								$secuencia_dispositivo->instancia_relacion = $id_inst_material;
								$secuencia_dispositivo->part_number = $inst_dispositivo->part_number;
								$secuencia_dispositivo->num_serie = $inst_dispositivo->num_serie;
								$secuencia_dispositivo->id_material = 0;
								$secuencia_dispositivo->id_dispositivo = $id_dispositivo;
								$secuencia_dispositivo->estado = 2;

								$correcto_dispositivo = $this->Secuencia_estado->set_secuencia_estado_dispositivo($secuencia_dispositivo);
								if(($correcto_material) && ($correcto_dispositivo))
								{//Ahora elimino la ubicacion de la instancia de material
									if($this->Ubicacion->unset_ubicacion($id_inst_material))
									{
										$this->smarty->assign('success','La instancia de dispositivo con id <strong>'.$id_inst_dispositivo.'</strong> se ha asociado a la instancia de material con id <strong>'.$id_inst_material.'</strong>.');
									}
									else
									{
										$this->smarty->assign('success','La instancia de dispositivo con id <strong>'.$id_inst_dispositivo.'</strong> se ha asociado a la instancia de material con id <strong>'.$id_inst_material.'</strong>.La instancia de material no tenía una ubicacion registrada.');
									}
								}
							}
						}
					}
				}
			}
			else
			{
				$this->smarty->assign('error','El material o el dispositivo no posee instancias asociadas.');
			}
		}
		else
		{//No existe relacion
			$this->smarty->assign('error','El dispositivo con marca <strong>'.$nombre_marca_dispositivo.'</strong> y modelo <strong>'.$nombre_modelo_dispositivo.'</strong> no es compatible con el material con marca <strong>'.$nombre_marca_material.'</strong> y modelo <strong>'.$nombre_modelo_material.'</strong>.');
		}
		$this->asociar_instancia_material();
	}

	public function desasocia_dispositivo_material()
	{
		//validacion desde servidor
		$this->form_validation->set_rules('estado_nuevo','Estado','required|trim');
		//Si el formulario no fue bien
		if(!$this->form_validation->run())
		{//Cargamos la vista
			$this->desasociar_instancia_material();
		}
		else{

			//obtengo el id del material al que pertenece la instancia de material a partir de su tipo,marca y modelo.
			$tipo_mat = $this->input->post('tipo_material');
			$marca_mat = $this->input->post('marca_material');
			$modelo_mat = $this->input->post('modelo_material');
			$id_material = $this->Material->obtener_id_material2($tipo_mat,$marca_mat,$modelo_mat);
			//obtengo el id del dispositivo al que pertenece la instancia de dispositivo a partir de su tipo,marca y modelo.
			$tipo_disp = $this->input->post('tipo_dispositivo');
			$marca_disp = $this->input->post('marca_dispositivo');
			$modelo_disp = $this->input->post('modelo_dispositivo');
			$id_dispositivo = $this->Dispositivo->obtener_id_dispositivo2($tipo_disp,$marca_disp,$modelo_disp);

			//Obtengo estado del material
			$estado_material = $this->input->post('estado_nuevo');


			//Capturo el id de la instancia de material
			$id_inst_material = $this->input->post('desasocia_instancia_material');
			//Captuto el id de la instancia de dispositivo
			$id_inst_dispositivo = $this->input->post('desasocia_instancia_dispositivo');

			//Compruebo que ambas instancias estan relacionadas
			//Para ello obtengo la informacion de la instancia de material
			$instancia_material = $this->Instancia_material->obtener_instancia_material($id_inst_material);

			if($id_inst_dispositivo == $instancia_material->instancia_dispositivo)
			{//Estan relacionados y paso a hacer todo lo necesario
				//Obtengo la informacion de la instancia de dispositivo
				$instancia_dispositivo = $this->Instancia_dispositivo->obtener_instancia_dispositivo($id_inst_dispositivo);
				$data_mat = array(
					'relacionado' => "no",
					'instancia_dispositivo' => 0,
					'estado_actual' => $estado_material
				);
				//Actualizo la instancia de material
				if($this->Instancia_material->update_instancia_material($data_mat,$id_inst_material))
				{
					$data_disp = array(
						'relacionado' => "no",
						'instancia_material' => 0,
						'estado_actual' => 1
					);
					//Actualizo la instancia de dispositivo
					if($this->Instancia_dispositivo->update_instancia_dispositivo($data_disp,$id_inst_dispositivo))
					{//Actualizo el material(Incremento el contador)
						$contador_material = $this->Material->obtener_contador_material($id_material);
						$contador_material = $contador_material + 1;
						$material = array(
							'contador' => $contador_material
						);
						if($this->Material->update_material($material,$id_material))
						{//Actualizo el dispositivo(Incremento el contador)
							$contador_dispositivo = $this->Dispositivo->obtener_contador_dispositivo($id_dispositivo);
							$contador_dispositivo = $contador_dispositivo + 1;
							$dispositivo = array(
								'contador' => $contador_dispositivo
							);
							if($this->Dispositivo->update_dispositivo($dispositivo,$id_dispositivo))
							{//Creo secuencia nueva para las instancias de dispositivo y de material
								//Obtengo la instancia modificada
								$instancia_material = $this->Instancia_material->obtener_instancia_material($id_inst_material);

								//Objeto para actualizar secuencia estado de instancia dispositivo
								$secuencia_material = new $this->Secuencia_estado();

								$secuencia_material->fecha = date("Y-m-d");
								$secuencia_material->instancia_material = $id_inst_material;
								$secuencia_material->instancia_dispositivo = 0;
								$secuencia_material->instancia_relacion = 0;
								$secuencia_material->part_number = $instancia_material->part_number;
								$secuencia_material->num_serie = $instancia_material->num_serie;
								$secuencia_material->id_material = $id_material;
								$secuencia_material->id_dispositivo = 0;
								$secuencia_material->estado = $estado_material;

								$correcto_material = $this->Secuencia_estado->set_secuencia_estado_material($secuencia_material);

								//Obtengo la instancia modificada
								$instancia_dispositivo = $this->Instancia_dispositivo->obtener_instancia_dispositivo($id_inst_dispositivo);

								//Objeto para actualizar secuencia estado de instancia dispositivo
								$secuencia_dispositivo = new $this->Secuencia_estado();

								$secuencia_dispositivo->fecha = date("Y-m-d");
								$secuencia_dispositivo->instancia_material = 0;
								$secuencia_dispositivo->instancia_dispositivo = $id_inst_dispositivo;
								$secuencia_dispositivo->instancia_relacion = 0;
								$secuencia_dispositivo->part_number = $instancia_dispositivo->part_number;
								$secuencia_dispositivo->num_serie = $instancia_dispositivo->num_serie;
								$secuencia_dispositivo->id_material = 0;
								$secuencia_dispositivo->id_dispositivo = $id_dispositivo;
								$secuencia_dispositivo->estado = 1;

								$correcto_dispositivo = $this->Secuencia_estado->set_secuencia_estado_dispositivo($secuencia_dispositivo);

								//print_r($correcto_dispositivo);
								//var_dump($correcto_dispositivo);
								//Verifico que se han almacenado ambas secuencias
								if(($correcto_material) && ($correcto_dispositivo))
								{
									$this->smarty->assign('success','La instancia de dispositivo con id <strong>'.$id_inst_dispositivo.'</strong> ha dejado de estar relacionada con la instancia de material con id <strong>'.$id_inst_material.'</strong>. Debe establecer ubicacion para la instancia de material.');
								}
							}
						}
					}
				}
			}
			else
			{//No estan relacionados y por tanto mando mensaje
				if(($id_inst_material == NULL)||($id_inst_dispositivo == NULL))
				{
					$this->smarty->assign('error','Debe seleccionar una instancia de dispositivo y una instancia de material.');
				}
				else
				{
					$this->smarty->assign('error','La instancia de material con id <strong>'.$id_inst_material.'</strong> no está asociada a la instancia de dispositivo con id <strong>'.$id_inst_dispositivo.'</strong>.');
				}

			}
			$this->desasociar_instancia_material();
		}
	}


	//metodo para rellenar un select
	//capturamos el id de mi tipo de material y mostramos las marcas en otro select
	public function tipo_material()
	{
		$id_tipo = $this->input->post('elegido');
		$this->Marca->muestra_marca_material($id_tipo);
	}

	//metodo para rellenar un select
	//capturamos el id de mi tipo de dispositivo y mostramos las marcas en otro select
	public function tipo_dispositivo()
	{
		$id_tipo = $this->input->post('elegido');
		$this->Marca->muestra_marca_dispositivo($id_tipo);
	}

	//funcion que permite capturar el valor elegido en un select para mostrar otro select con los modelos
	public function marca_material()
	{
		$id_marca = $this->input->post('elegido');
		$this->Modelo->muestra_modelo($id_marca);
	}

	//funcion que permite capturar el valor elegido en un select para mostrar otro select con los modelos
	public function marca_dispositivo()
	{
		$id_marca = $this->input->post('elegido');
		$this->Modelo->muestra_modelo($id_marca);
	}

	//Para asociar material a dispositivo
	public function instancia_material()
	{
		$id_modelo = $this->input->post('elegido');
		$id_material = $this->Material->obtener_id_material($id_modelo);
		$this->Instancia_material->muestra_instancia_en_asociar($id_material);
	}
	//Para asociar material a dispositivo
	public function instancia_dispositivo()
	{
		$id_modelo = $this->input->post('elegido');
		$id_dispositivo = $this->Dispositivo->obtener_id_dispositivo($id_modelo);
		$this->Instancia_dispositivo->muestra_instancia_en_asociar($id_dispositivo);
	}

	//Para desasociar material a dispositivo
	public function desasocia_instancia_material()
	{
		$id_modelo = $this->input->post('elegido');
		$id_material = $this->Material->obtener_id_material($id_modelo);
		$this->Instancia_material->muestra_instancia_en_desasociar($id_material);
	}
	//Para desasociar material a dispositivo
	public function desasocia_instancia_dispositivo()
	{
		$id_modelo = $this->input->post('elegido');
		$id_dispositivo = $this->Dispositivo->obtener_id_dispositivo($id_modelo);
		$this->Instancia_dispositivo->muestra_instancia_en_desasociar($id_dispositivo);
	}
	//metodo que me escribe en un dual select anidado los dispositivos que pertenecen a un tipo de dispositivo
	//Usado en addMaterial
	public function combo_dispositivo()
	{

		$id_tipo = $this->input->post('elegido');
		$this->Dispositivo->muestra_combo_dispositivo($id_tipo);
	}

	//funcion que permite capturar el valor elegido en un select para mostrar otro select con las instancias
	public function combo_instancia()
	{
		$id_modelo = $this->input->post('elegido');
		$id_material = $this->Material->obtener_id_material($id_modelo);
		$this->Instancia_material->muestra_combo_instancia($id_material);
	}

	/* Parece que ya no lo uso
	//metodo que me escribe un select anidado los materiales asociados a un material
	//usado en deleteMaterial
	public function combo_a_material()
	{

		$id_tipo = $this->input->post('elegido');
		$this->Material->muestra_combo_a_material($id_tipo);
	}
*/

	//metodo que me muestra un listado de estados con la instancia de un dispositivo seleccionada
	public function muestra_historico_instancia_material()
	{
		$id_instancia = $this->input->post('elegido');

		$this->Secuencia_estado->genera_historico_inst_material($id_instancia);
	}

	//metodo que me muestra una tabla con las instancias de un material seleccionado
	public function tabla_instancias_materiales()
	{
		$id_modelo = $this->input->post('elegido');
		$id_material = $this->Material->obtener_id_material($id_modelo);
		$this->Instancia_material->muestra_tabla_instancias_materiales($id_material);
	}

	//SI LO USO
	public function combo_instancia_material()
	{
		$id_modelo = $this->input->post('elegido');
		$id_material = $this->Material->obtener_id_material($id_modelo);
		$this->Instancia_material->muestra_combo_instancia($id_material);
	}
	//SI LO USO
	public function combo_instancia_dispositivo()
	{
		$id_modelo = $this->input->post('elegido');
		$id_dispositivo = $this->Dispositivo->obtener_id_dispositivo($id_modelo);
		$this->Instancia_dispositivo->muestra_combo_instancia($id_dispositivo);
	}

	public function modifica_instancia_material()
	{
		$id_instancia = $this->input->post('elegido');
		$this->Instancia_material->muestra_modifica_instancia_material($id_instancia);
	}

	/*Actualmente no lo uso
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

	//funcion que permite capturar el valor elegido en un select para mostrar otro select con los Tipos de dispositivos o materiales
	public function elemento2()
	{
		$id_elemento = $this->input->post('elegido');
		$this->Marca->muestra_marca($id_elemento);
	}
	*/
	//funcion que permite capturar el valor elegido en un select para mostrar otro select con las marcas asociadas a ese tipo de material
	public function tipo_material3()
	{
		$id_tipo = $this->input->post('elegido');
		$this->Marca->muestra_marca_material($id_tipo);
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

/* End of file material_controller.php */
/* Location: ./application/controllers/material_controller.php */