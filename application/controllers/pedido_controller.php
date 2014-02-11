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

//Clase para gestionar los Pedidos realizados

class Pedido_controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('Pedido');
		$this->load->model('Dispositivo');
		$this->load->model('Material');
		$this->load->model('Marca');
		$this->load->model('Modelo');
		$this->load->model('Tipo_dispositivo');
		$this->load->model('Tipo_material');
		$this->load->model('Proveedor');
		$this->load->model('Fichero');
		$this->load->model('Instancia_dispositivo');
		$this->load->model('Instancia_material');
	}

	public function index()
	{
	}

//Metodos para redirigirme en el menu a las distintas vistas
//***********************************************************
	public function alta_pedido()
	{
		if($this->simple_sessions->get_value('status'))
		{
			//obtengo el nombre de todos los elemento de la tabla y los almaceno en un array
			$proveedor = $this->Proveedor->obtener_nombre_proveedor();
			//paso el array a mi vista para mostrar los resultados
			$this->smarty->assign("proveedor",$proveedor);

			$this->smarty->view('pedido/alta_pedido');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}
	//////////////////////////////////////////////////////////////
	public function modificar_pedido()
	{
		if($this->simple_sessions->get_value('status'))
		{
			//obtengo todos los datos de los pedidos de mi BD y los almaceno en un array
			$pedido = $this->Pedido->obtener_nombre_pedido();
			//paso el array a mi vista par mostrar los resultados
			$this->smarty->assign('pedido',$pedido);

			$this->smarty->view('pedido/modificar_pedido');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}
	//////////////////////////////////////////////////////////////
	public function almacena_ficheros()
	{
		if($this->simple_sessions->get_value('status'))
		{
			//obtengo todos los datos de los pedidos de mi BD y los almaceno en un array
			$pedido = $this->Pedido->obtener_nombre_pedido();
			//paso el array a mi vista par mostrar los resultados
			$this->smarty->assign('pedido',$pedido);

			$this->smarty->view('pedido/almacena_fichero');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}
	//////////////////////////////////////////////////////////////
	public function listar_pedido()
	{
		if($this->simple_sessions->get_value('status'))
		{
			$this->load->library('pagination');

			$config = array();

			$desde = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;

			$config['per_page'] = 10;
			$config['base_url'] = base_url('pedido_controller/listar_pedido');
			$config['total_rows'] = $this->Pedido->getNumPedidos();
			$config['uri_segment'] = 3;
			$config['num_links'] = 2;
			$config['first_link'] = "&lt&lt";
			$config['last_link'] = "&gt&gt";
			//$config['display_pages'] = FALSE;

			$this->pagination->initialize($config);

			$listado_pedidos = $this->Pedido->lista_pedidos($config['per_page'],$desde);
			//De todos los pedidos tengo que extraer las instancias de dispositivos o materiales y los ficheros

			if($listado_pedidos != 'no hay datos')
			{
				$i = 0;
				foreach ($listado_pedidos as $fila) {
					//Obtengo ficheros asociados
					$listado_ficheros = $this->Fichero->obtener_ficheros_asociados($fila->id);
					$listado_pedidos[$i]->ficheros = $listado_ficheros;

					//Obtengo instancias de dispositivo asociadas
					$inst_dispositivos = $this->Instancia_dispositivo->obtener_instancias_asociadas($fila->id);
					$j = 0;
					foreach ($inst_dispositivos as $inst) {
						$dispositivo = $this->Dispositivo->obtener_dispositivo_por_id($inst->dispositivo);
						$marca_dispositivo = $this->Marca->obtener_nombre_marca_por_id($dispositivo->marca);
						$modelo_dispositivo = $this->Modelo->obtener_nombre_modelo_por_id($dispositivo->modelo);
						$tipo_dispositivo = $this->Tipo_dispositivo->obtener_nombre_tipo_por_id($dispositivo->tipo_dispositivo);
						$inst_dispositivos[$j]->tipo_dispositivo = $tipo_dispositivo;
						$inst_dispositivos[$j]->marca = $marca_dispositivo;
						$inst_dispositivos[$j]->modelo = $modelo_dispositivo;
						$j++;
					}
					$listado_pedidos[$i]->instancias_dispositivo = $inst_dispositivos;

					//Obtengo instancias de materiales asociadas
					$inst_materiales = $this->Instancia_material->obtener_instancias_asociadas($fila->id);
					$k = 0;
					foreach ($inst_materiales as $inst) {
						$material = $this->Material->obtener_material_por_id($inst->material);
						$marca_material = $this->Marca->obtener_nombre_marca_por_id($material->marca);
						$modelo_material = $this->Modelo->obtener_nombre_modelo_por_id($material->modelo);
						$tipo_material = $this->Tipo_material->obtener_nombre_tipo_por_id($material->tipo_dispositivo);
						$inst_materiales[$k]->tipo_material = $tipo_material;
						$inst_materiales[$k]->marca = $marca_material;
						$inst_materiales[$k]->modelo = $modelo_material;
						$k++;
					}
					$listado_pedidos[$i]->instancias_material = $inst_materiales;

					$i++;
				}
			}


			$paginacion = $this->pagination->create_links();

			$this->smarty->assign('paginacion',$paginacion);
			$this->smarty->assign('listado_pedidos',$listado_pedidos);
			$this->smarty->view('pedido/listar_pedido');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}
	//////////////////////////////////////////////////////////////
	public function eliminar_pedido()
	{
		if($this->simple_sessions->get_value('status'))
		{
			//obtengo todos los datos de los pedidos de mi BD y los almaceno en un array
			$pedido = $this->Pedido->obtener_nombre_pedido();
			//paso el array a mi vista par mostrar los resultados
			$this->smarty->assign('pedido',$pedido);

			$this->smarty->view('pedido/eliminar_pedido');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}
	//////////////////////////////////////////////////////////////
	public function visualizar_pedido()
	{
		if($this->simple_sessions->get_value('status'))
		{
			$id = $_GET['id'];

			//obtengo informacion del pedido
			$pedido = $this->Pedido->obtener_pedido($id);

			//Obtengo ficheros asociados
			$listado_ficheros = $this->Fichero->obtener_ficheros_asociados($pedido->id);
			$pedido->ficheros = $listado_ficheros;

			//Obtengo instancias de dispositivo asociadas
			$inst_dispositivos = $this->Instancia_dispositivo->obtener_instancias_asociadas($pedido->id);
			$j = 0;
			foreach ($inst_dispositivos as $inst) {
				$dispositivo = $this->Dispositivo->obtener_dispositivo_por_id($inst->dispositivo);
				$marca_dispositivo = $this->Marca->obtener_nombre_marca_por_id($dispositivo->marca);
				$modelo_dispositivo = $this->Modelo->obtener_nombre_modelo_por_id($dispositivo->modelo);
				$tipo_dispositivo = $this->Tipo_dispositivo->obtener_nombre_tipo_por_id($dispositivo->tipo_dispositivo);
				$inst_dispositivos[$j]->tipo_dispositivo = $tipo_dispositivo;
				$inst_dispositivos[$j]->marca = $marca_dispositivo;
				$inst_dispositivos[$j]->modelo = $modelo_dispositivo;
				$j++;
			}
			$pedido->instancias_dispositivo = $inst_dispositivos;

			//Obtengo instancias de materiales asociadas
			$inst_materiales = $this->Instancia_material->obtener_instancias_asociadas($pedido->id);
			$k = 0;
			foreach ($inst_materiales as $inst) {
				$material = $this->Material->obtener_material_por_id($inst->material);
				$marca_material = $this->Marca->obtener_nombre_marca_por_id($material->marca);
				$modelo_material = $this->Modelo->obtener_nombre_modelo_por_id($material->modelo);
				$tipo_material = $this->Tipo_material->obtener_nombre_tipo_por_id($material->tipo_dispositivo);
				$inst_materiales[$k]->tipo_material = $tipo_material;
				$inst_materiales[$k]->marca = $marca_material;
				$inst_materiales[$k]->modelo = $modelo_material;
				$k++;
			}
			$pedido->instancias_material = $inst_materiales;

			//Obtengo el nombre del proveedor
			$nombre_proveedor = $this->Proveedor->obtener_nombre_proveedor_por_id($pedido->proveedor);

			//paso el array a mi vista par mostrar los resultados
			$this->smarty->assign('pedido',$pedido);
			$this->smarty->assign('proveedor',$nombre_proveedor);

			$this->smarty->view('pedido/visualizar_pedido');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}
	//////////////////////////////////////////////////////////////
	public function modificar_pedido2()
	{
		if($this->simple_sessions->get_value('status'))
		{
			$id = $_GET['id'];

			//obtengo informacion del pedido
			$pedido = $this->Pedido->obtener_pedido($id);

			//Convertimos el id del proveedor a su nombre para mostarlo
            $nombre_pro = $this->Proveedor->obtener_nombre_proveedor_por_id($pedido->proveedor);

            //En $proveedor meto todos los proveedores menos el obtenido de la BD
            $proveedores = $this->Proveedor->obtener_nombre_proveedores_menos_uno($pedido->proveedor);

			//paso el array a mi vista para mostrar los resultados
			$this->smarty->assign("pedido",$pedido);
			$this->smarty->assign("proveedor",$nombre_pro);
			$this->smarty->assign("proveedores",$proveedores);
			$this->smarty->view('pedido/modificar_pedido2');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}
	//////////////////////////////////////////////////////////////
	public function eliminar_pedido2()
	{
		if($this->simple_sessions->get_value('status'))
		{
			$id = $_GET['id'];

			//obtengo informacion del pedido
			$pedido = $this->Pedido->obtener_pedido($id);
			//Convertimos el id del proveedor a su nombre para mostarlo
            $nombre_pro = $this->Proveedor->obtener_nombre_proveedor_por_id($pedido->proveedor);

			//paso el array a mi vista para mostrar los resultados
			$this->smarty->assign("pedido",$pedido);
			$this->smarty->assign("proveedor",$nombre_pro);

			$this->smarty->view('pedido/eliminar_pedido2');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}
//////////////////////////////////////////////////////////////
//Fin de los métodos que me permiten moverme entre las vistas

//Metodo para dar de alta una compra
	public function addPedido()
	{
		//validacion desde servidor
		$this->form_validation->set_rules('nombre','Nombre','required|trim|max_length[30]');
		$this->form_validation->set_rules('observaciones','Observaciones','trim');
		$this->form_validation->set_rules('ficheros','Fichero','trim');
		$this->form_validation->set_rules('proveedor','Proveedor','required|trim');

		//Si el formulario no fue bien
		if(!$this->form_validation->run())
		{//Cargamos la vista
			$this->alta_pedido();
		}
		else
		{
			$nombre = $this->input->post('nombre');
			$observaciones = $this->input->post('observaciones');
			$proveedor = $this->input->post('proveedor');
			//nos creamos un objeto y metemos los datos que vienen del formulario
			$pedido = new $this->Pedido();

			$pedido->nombre_pedido = $nombre;
			$pedido->observaciones = $observaciones;
			$pedido->proveedor     = $proveedor;

			if($this->Pedido->set_pedido($pedido))
			{//Tratamos archivos y mostramos mensaje de pedido registrado
				$id_pedido = $this->Pedido->obtener_id_pedido($nombre);
				//El formulario ha recibido los parametros necesarios, tratamos fichero y pedido
				$directorio = './uploads/pedidos/'.$id_pedido.'/';
				//Compruebo que existen archivos
				if(isset($_FILES['ficheros']))
				{//Existen y por cada uno intento registrarlo en su tabla ficheros
					mkdir($directorio);
				    foreach ($_FILES['ficheros']['error'] as $key => $error)
				    {
				       if ($error == UPLOAD_ERR_OK)
				       {
				       		$nombre_archivo = $id_pedido.'.'.$_FILES["ficheros"]["name"][$key];
				       		//Muevo el archivo desde mi zona temporal a mi destino final
				            $tmp_name = $_FILES["ficheros"]["tmp_name"][$key];
				            $name = $directorio.$nombre_archivo;
				            move_uploaded_file($tmp_name,$name);

				            //Creo objeto fichero e inserto en mi bd
				            $fichero = new Fichero();
				            $fichero->nombre = $nombre_archivo;
				            $fichero->path = $name;
				            $fichero->fecha = date("Y-m-d");
				            $fichero->pedido = $id_pedido;
				            if($this->Fichero->set_archivo($fichero))
				            {
				            	//mostramos un mensaje para dejar claro que ha sido agregado a la BD
								$this->smarty->assign("success", "Pedido almacenado correctamente.");
				            }
				            else
				            {
				            	//mostramos un mensaje para dejar claro que ha sido agregado a la BD
								$this->smarty->assign("error", "El fichero ya existe en la BD.");
				            }
				       }
				       else
				       {
				       		//mostramos un mensaje para dejar claro que ha sido agregado a la BD
							$this->smarty->assign("success", "Pedido almacenado correctamente.No existen archivos asociados.");
				       }
				    }
				}
			}
			else if(!$this->Pedido->set_pedido($pedido))
			{//Existe el pedido en la BD
				$this->smarty->assign("error", "El pedido ya existe en la base de datos.");
			}
			else
			{//existe un error en la BD
				$this->smarty->assign("error", "Error en la base de datos.");
			}
			$this->alta_pedido();
		}
	}

	//Metodo para modificar un pedido
	public function updatePedido()
	{
		$this->form_validation->set_rules('nombre','Nombre','required|trim|max_length[30]|min_length[3]');
		$this->form_validation->set_rules('observaciones','Observaciones','trim');
		$this->form_validation->set_rules('proveedor','Proveedor','required|trim');
		$this->form_validation->set_rules('ficheros','Fichero','trim');

		//Si el formulario no fue bien
		if(!$this->form_validation->run())
		{//Cargamos la vista
			$this->modificar_pedido();
		}
		else
		{
			//Pasa la validacion
			//Capturo el id del pedido a modificar
			$id_pedido = $this->input->post('combo_pedido');

			//capturo los datos del formulario a modificar en un array
			$data = array(
				'nombre_pedido' => $this->input->post('nombre'),
				'observaciones' => $this->input->post('observaciones'),
				'proveedor' => $this->input->post('proveedor')
			);
			if($this->Pedido->update_pedido($data,$id_pedido))
			{//Tratamos archivos y mostramos mensaje de pedido registrado
				$this->smarty->assign('success','El pedido se ha modificado.');
			}
			else
			{
				$this->smarty->assign('error','El pedido no se ha modificado.');
			}
			$this->modificar_pedido();
		}
	}

	//Metodo para modificar un pedido
	public function updatePedido2()
	{
		$this->form_validation->set_rules('nombre','Nombre','required|trim|max_length[30]|min_length[3]');
		$this->form_validation->set_rules('observaciones','Observaciones','trim');
		$this->form_validation->set_rules('proveedor','Proveedor','required|trim');

		//Si el formulario no fue bien
		if(!$this->form_validation->run())
		{//Cargamos la vista
			$this->modificar_pedido();
		}
		else
		{
			//Pasa la validacion
			//Capturo el id del pedido a modificar
			$id_pedido = $_GET['id_pedido'];

			//capturo los datos del formulario a modificar en un array
			$data = array(
				'nombre_pedido' => $this->input->post('nombre'),
				'observaciones' => $this->input->post('observaciones'),
				'proveedor' => $this->input->post('proveedor')
			);
			if($this->Pedido->update_pedido($data,$id_pedido))
			{//Tratamos archivos y mostramos mensaje de pedido registrado
				$this->smarty->assign('success','El pedido se ha modificado.');
			}
			else
			{
				$this->smarty->assign('error','El pedido no se ha modificado.');
			}
			$this->modificar_pedido();
		}
	}

	public function almacenaFichero()
	{
		$id_pedido = $this->input->post('id_pedido');
		$nombre_pedido = $this->Pedido->obtener_nombre_pedido_por_id($id_pedido);
		//Vemos si existen archivos a insertar
		$directorio = './uploads/pedidos/'.$id_pedido.'/';

		//Compruebo que existen archivos
		if(isset($_FILES['ficheros']))
		{//Existen y por cada uno intento registrarlo en su tabla ficheros
			if(!file_exists($directorio))
			{
				mkdir($directorio);
			}
		    foreach ($_FILES['ficheros']['error'] as $key => $error)
		    {
		       if ($error == UPLOAD_ERR_OK)
		       {
		            $nombre_archivo = $id_pedido.'.'.$_FILES["ficheros"]["name"][$key];
		       		//Muevo el archivo desde mi zona temporal a mi destino final
		            $tmp_name = $_FILES["ficheros"]["tmp_name"][$key];
		            $name = $directorio.$nombre_archivo;
		            move_uploaded_file($tmp_name,$name);

		            //Creo objeto fichero e inserto en mi bd
		            $fichero = new Fichero();
		            $fichero->nombre = $nombre_archivo;
		            $fichero->path = $name;
		            $fichero->fecha = date("Y-m-d");
		            $fichero->pedido = $id_pedido;

		            if($this->Fichero->set_archivo($fichero))
		            {//Existe fichero y lo guardamos
		            	$numero_ficheros = count($_FILES);
		            	if($numero_ficheros == 1)
		            	{
		            		$this->smarty->assign('success','El fichero se ha almacenado para el pedido con nombre <strong>'.$nombre_pedido.'</strong> y con id <strong>'.$id_pedido.'</strong>.');
		            	}
		            	else
		            	{
		            		$this->smarty->assign('success',$numero_ficheros .' ficheros se han almacenado para el pedido con nombre <strong>'.$nombre_pedido.'</strong> y con id <strong>'.$id_pedido.'</strong>.');
		            	}
		            }
		            else
		            {//El fichero ya existe
		            	$this->smarty->assign('error','El fichero ya existe.');
		            }
		       }
		       else
		       {//El fichero no se almacena
		       		$this->smarty->assign('error','No ha seleccionado ningun fichero.');
		       }
		    }
		}
		$this->almacena_ficheros();
	}

	//Metodo para eliminar un pedido
	public function deletePedido()
	{
		$pedido = $this->input->post('combo_pedido');

		$p = $this->Pedido->unset_pedido($pedido);
		switch ($p)
		{
			case '0':
				$this->smarty->assign("success", "No tenia instancias asociadas.Pedido eliminado correctamente.");
				break;
			case '1':
				$this->smarty->assign("error", "No se ha podido eliminar, tenia instancias de dispositivos asociadas.");
				break;
			case '2':
				$this->smarty->assign("error", "No se ha podido eliminar, tenia instancias de materiales asociadas.");
				break;
			default:
				$this->smarty->assign("error", "No se ha podido eliminar, tenia instancias de dispositivos y materiales asociadas.");
				break;
		}

		$this->eliminar_pedido();
	}

	//Metodo para eliminar un pedido (botonera acciones)
	public function deletePedido2()
	{
		$pedido = $_GET['id_pedido'];

		$p = $this->Pedido->unset_pedido($pedido);
		switch ($p)
		{
			case '0':
				$this->smarty->assign("success", "No tenia instancias asociadas.Pedido eliminado correctamente.");
				break;
			case '1':
				$this->smarty->assign("error", "No se ha podido eliminar, tenia instancias de dispositivos asociadas.");
				break;
			case '2':
				$this->smarty->assign("error", "No se ha podido eliminar, tenia instancias de materiales asociadas.");
				break;
			default:
				$this->smarty->assign("error", "No se ha podido eliminar, tenia instancias de dispositivos y materiales asociadas.");
				break;
		}

		$this->eliminar_pedido();
	}

	public function GeneraPdfListadoPedido()
    {
        $this->load->library('Pdf');

        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        //Para orientar la pagina en horizontal (L) o vertical (P)
        //$pdf->setPageOrientation(PDF_PAGE_ORIENTATION);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Jose A. Moreno');
        $pdf->SetTitle('Listado PDF');
        $pdf->SetSubject('Listado de pedidos');
        $pdf->SetKeywords('PDF, pedidos, listado');

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
        $pedidos = $this->Pedido->lista_pedidos2();
        //preparamos y maquetamos el contenido a crear

        $num_pedidos = count($pedidos);

        $tbl = <<<EOD
        <style type=text/css>
            th{color: #000; font-weight: bold; background-color: #eee}
            td{background-color: #fff; color: #000}
        </style>
        <h2>Listado de Pedidos </h2>
        <table cellspacing="0" cellpadding="1" border="1">
            <tr>
            	<th width="30"> Id </th>
                <th width="140"> Nombre </th>
                <th width="310"> Observaciones </th>
                <th width="160"> Proveedor </th>
            </tr>
EOD;
        //Componemos las filas con los registros de nuestra tabla
        foreach ($pedidos as $fila)
        {
        	$id = $fila->id;
            $nombre = $fila->nombre_pedido;
            $observaciones = $fila->observaciones;
            $proveedor = $fila->nombre_proveedor;

            $tbl .= <<<EOD
            <tr>
            	<td width="30"> $id </td>
                <td width="140"> $nombre </td>
                <td width="310"> $observaciones </td>
                <td width="160"> $proveedor </td>
            </tr>
EOD;
        }

        $tbl .= "</table>";

        //Mostramos el contenido HTML
        $pdf->writeHTML($tbl, true, false, false, false, '');

        // ---------------------------------------------------------
        // Cerrar el documento PDF y preparamos la salida
        // Este método tiene varias opciones, consulte la documentación para más información.
        $nombre_archivo = utf8_decode("pedidos.pdf");
        $pdf->Output($nombre_archivo, 'I');
    }

//Metodo que en funcion del pedido seleccionado llama al modelo y me genera un formulario con los datos que corresponden para modificarlos
	public function combo_pedido()
	{
		$id_pedido = $this->input->post('elegido');
		$this->Pedido->muestra_combo_pedido($id_pedido);
	}

	//Metodo que en funcion del pedido seleccionado llama al modelo y me genera un listado con los datos que necesitamos(usado en almacena fichero)
	public function id_pedido()
	{
		$id_pedido = $this->input->post('elegido');
		$this->Fichero->muestra_ficheros_actuales($id_pedido);
	}

}

/* End of file compra_controller.php */
/* Location: ./application/controllers/compra_controller.php */