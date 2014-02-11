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

//Clase para gestionar los Proveedores que surten de material al Ayuntamiento

class Proveedor_controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('Proveedor');
	}

	public function index()
	{

	}

//Metodos para redirigirme en el menu a las distintas vistas
//***********************************************************
	public function alta_proveedor()
	{
		if($this->simple_sessions->get_value('status'))
		{
			$this->smarty->view('proveedor/alta_proveedor');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}
//////////////////////////////////////////////////////////////
	public function modificar_proveedor()
	{
		if($this->simple_sessions->get_value('status'))
		{
			//cargo un listado de todos los proveedores que posee mi tabla
			$proveedores = $this->Proveedor->obtener_todos_proveedores();
			//Los asigno a un array de smarty para pasarlos a mi vista
			$this->smarty->assign("proveedor",$proveedores);
			$this->smarty->view('proveedor/modificar_proveedor');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}
	//////////////////////////////////////////////////////////////
	public function listar_proveedor()
	{
		if($this->simple_sessions->get_value('status'))
		{
			$this->load->library('pagination');

			$config = array();

			$desde = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;

			$config['per_page'] = 10;
			$config['base_url'] = base_url('proveedor_controller/listar_proveedor');
			$config['total_rows'] = $this->Proveedor->getNumProveedores();
			$config['uri_segment'] = 3;
			$config['num_links'] = 2;
			$config['first_link'] = "&lt&lt";
			$config['last_link'] = "&gt&gt";
			//$config['display_pages'] = FALSE;

			$this->pagination->initialize($config);

			$listado_proveedores = $this->Proveedor->lista_proveedores($config['per_page'],$desde);

			$paginacion = $this->pagination->create_links();

			$this->smarty->assign('paginacion',$paginacion);
			$this->smarty->assign('listado_proveedores',$listado_proveedores);
			$this->smarty->view('proveedor/listar_proveedor');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}
	//////////////////////////////////////////////////////////////
	public function eliminar_proveedor()
	{
		if($this->simple_sessions->get_value('status'))
		{
			//cargo un listado de todos los proveedores que posee mi tabla
			$proveedores = $this->Proveedor->obtener_todos_proveedores();
			//Los asigno a un array de smarty para pasarlos a mi vista
			$this->smarty->assign("proveedor",$proveedores);
			//cargo mi vista
			$this->smarty->view('proveedor/eliminar_proveedor');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}
	//////////////////////////////////////////////////////////////
	public function visualizar_proveedor()
	{
		if($this->simple_sessions->get_value('status'))
		{
			$id = $_GET['id'];

			//obtengo informacion de la persona
			$proveedor = $this->Proveedor->obtener_proveedor($id);

			//paso el array a mi vista par mostrar los resultados
			$this->smarty->assign('proveedor',$proveedor);

			$this->smarty->view('proveedor/visualizar_proveedor');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}
	//////////////////////////////////////////////////////////////
	public function modificar_proveedor2()
	{
		if($this->simple_sessions->get_value('status'))
		{
			$id = $_GET['id'];

			//obtengo informacion de la persona
			$proveedor = $this->Proveedor->obtener_proveedor($id);

			//paso el array a mi vista par mostrar los resultados
			$this->smarty->assign('proveedor',$proveedor);

			$this->smarty->view('proveedor/modificar_proveedor2');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}
	//////////////////////////////////////////////////////////////
	public function eliminar_proveedor2()
	{
		if($this->simple_sessions->get_value('status'))
		{
			$id = $_GET['id'];

			//obtengo informacion de la persona
			$proveedor = $this->Proveedor->obtener_proveedor($id);

			//paso el array a mi vista par mostrar los resultados
			$this->smarty->assign('proveedor',$proveedor);

			$this->smarty->view('proveedor/eliminar_proveedor2');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}
//////////////////////////////////////////////////////////////
//Fin de los métodos que me permiten moverme entre las vistas

//Metodo para dar de alta un proveedor
	public function addProveedor()
	{
		//validacion desde servidor
		$this->form_validation->set_rules('nombre','Nombre','required|trim|max_length[50]');
		$this->form_validation->set_rules('email','Email','required|valid_email|trim|max_length[80]');
		$this->form_validation->set_rules('telefono_fijo','Telefono fijo','required|trim');
		$this->form_validation->set_rules('telefono_movil','Telefono movil','trim');
		$this->form_validation->set_rules('fax','Fax','trim');
		$this->form_validation->set_rules('direccion','Fax','required|trim|max_length[80]');
		$this->form_validation->set_rules('nombre_contacto','Contacto','trim|max_length[80]');
		$this->form_validation->set_rules('telefono_contacto','Telefono contacto','trim');

		//Si el formulario no fue bien
		if(!$this->form_validation->run())
		{//Cargamos la vista
			$this->alta_proveedor();
		}
		else{
			//nos creamos un objeto y metemos los datos que vienen del formulario
			$proveedor = new $this->Proveedor();

			$proveedor->nombre_proveedor            = $this->input->post('nombre');
			$proveedor->email             = $this->input->post('email');
			$proveedor->telefono_fijo     = $this->input->post('telefono_fijo');
			$proveedor->telefono_movil    = $this->input->post('telefono_movil');
			$proveedor->fax               = $this->input->post('fax');
			$proveedor->direccion         = $this->input->post('direccion');
			$proveedor->contacto   = $this->input->post('nombre_contacto');
			$proveedor->telefono_contacto = $this->input->post('telefono_contacto');

			if($this->Proveedor->set_proveedor($proveedor))
			{//mostramos un mensaje para dejar claro que ha sido agregado a la BD
				$this->smarty->assign("success", "Proveedor almacenado correctamente.");
			}
			else if(!$this->Proveedor->set_proveedor($proveedor))
			{//Existe el proveedor en la BD
				$this->smarty->assign("error", "El proveedor ya existe en la base de datos.");
			}
			else
			{//ha habido error en la BD
				$this->smarty->assign("error", "Error en la base de datos.");
			}
			$this->alta_proveedor();
		}
	}


//Metodo para modificar un proveedor
public function updateProveedor()
{
	//validacion desde servidor
	$this->form_validation->set_rules('nombre','Nombre','required|trim|max_length[50]|min_length[4]');
	$this->form_validation->set_rules('email','Email','required|valid_email|trim|max_length[80]');
	$this->form_validation->set_rules('telefono_fijo','Telefono fijo','required|trim');
	$this->form_validation->set_rules('telefono_movil','Telefono movil','trim');
	$this->form_validation->set_rules('fax','Fax','trim');
	$this->form_validation->set_rules('direccion','Fax','required|trim|max_length[80]');
	$this->form_validation->set_rules('nombre_contacto','Contacto','trim|max_length[80]');
	$this->form_validation->set_rules('telefono_contacto','Telefono contacto','trim');

	//Si el formulario no fue bien
	if(!$this->form_validation->run())
	{//Cargamos la vista
		$this->modificar_proveedor();
	}
	else
	{
		//Capturo el id de la persona a modificar
		$id = $this->input->post('combo_proveedor');

		//capturo los datos del formulario a modificar en un array
		$data = array(
			'nombre_proveedor' => $this->input->post('nombre'),
			'email' => $this->input->post('email'),
			'telefono_fijo' => $this->input->post('telefono_fijo'),
			'telefono_movil' => $this->input->post('telefono_movil'),
			'fax' => $this->input->post('fax'),
			'direccion' => $this->input->post('direccion'),
			'contacto' => $this->input->post('contacto'),
			'telefono_contacto' => $this->input->post('telefono_contacto')
		);

		if($this->Proveedor->update_proveedor($data,$id))
		{
			$this->smarty->assign('success','Proveedor modificado correctamente.');
		}
		else
		{
			$this->smarty->assign('error','El proveedor no se ha modificado.');
		}
		$this->modificar_proveedor();
	}
}

//Metodo para eliminar un proveedor
	public function deleteProveedor()
	{
		//recojo los datos del formulario
		$id_proveedor = $this->input->post('combo_proveedor');

		//compruebo si el array esta vacio
		if(empty($id_proveedor))
		{//array vacio
			//mando mensaje
			$this->smarty->assign("error", "No ha seleccionado ningún proveedor.");
		}
		else{
			//he seleccionado algun proveedor, procedemos a borrar
			$nombre_proveedor = $this->Proveedor->obtener_nombre_proveedor_por_id($id_proveedor);
			$proveedor = $this->Proveedor->unset_proveedor($id_proveedor);
			if($proveedor == 1)
			{
				$this->smarty->assign("success", 'Proveedor con nombre <strong>'.$nombre_proveedor.'</strong> eliminado correctamente.');
			}
			else
			{
				$this->smarty->assign("error", 'El proveedor <strong>'.$nombre_proveedor.'</strong> no ha sido borrado porque tiene pedidos asociados.');
			}
		}
		$this->eliminar_proveedor();
	}

	//Metodo para eliminar un proveedor(accion de botonera)
	public function deleteProveedor2()
	{
		//recojo los datos del formulario
		$id_proveedor = $_GET['id_proveedor'];

		//compruebo si el array esta vacio
		if(empty($id_proveedor))
		{//array vacio
			//mando mensaje
			$this->smarty->assign("error", "No ha seleccionado ningún proveedor.");
		}
		else{
			//he seleccionado algun proveedor, procedemos a borrar
			$nombre_proveedor = $this->Proveedor->obtener_nombre_proveedor_por_id($id_proveedor);
			$proveedor = $this->Proveedor->unset_proveedor($id_proveedor);
			if($proveedor == 1)
			{
				$this->smarty->assign("success", 'Proveedor con nombre <strong>'.$nombre_proveedor.'</strong> eliminado correctamente.');
			}
			else
			{
				$this->smarty->assign("error", 'El proveedor <strong>'.$nombre_proveedor.'</strong> no ha sido borrado porque tiene pedidos asociados.');
			}
		}
		$this->eliminar_proveedor();
	}

	public function GeneraPdfListadoProveedor()
    {
        $this->load->library('Pdf');

        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        //Para orientar la pagina en horizontal (L) o vertical (P)
        $pdf->setPageOrientation('L');
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Jose A. Moreno');
        $pdf->SetTitle('Listado PDF');
        $pdf->SetSubject('Listado de proveedores');
        $pdf->SetKeywords('PDF, proveedor, listado');

        //datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
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
        $proveedores = $this->Proveedor->listar_proveedores2();
        //preparamos y maquetamos el contenido a crear

        $num_proveedores = count($proveedores);

        $tbl = <<<EOD
        <style type=text/css>
            th{color: #000; font-weight: bold; background-color: #eee}
            td{background-color: #fff; color: #000}
        </style>
        <h2>Listado de Proveedores </h2>
        <table cellspacing="0" cellpadding="1" border="1">
            <tr>
                <th width="100"> Nombre </th>
                <th width="170"> Email </th>
                <th width="200"> Direccion </th>
                <th width="80"> Telefono fijo </th>
                <th width="80"> Telefono móvil </th>
                <th width="80"> Fax </th>
                <th width="160"> Contacto </th>
                <th width="80"> Telefono contacto </th>
            </tr>
EOD;
        //Componemos las filas con los registros de nuestra tabla
        foreach ($proveedores as $fila)
        {

            $nombre = $fila->nombre_proveedor;
            $telefono_fijo = $fila->telefono_fijo;

            if($fila->telefono_movil == 0)
            {
                $telefono_movil = NULL;
            }
            else
            {
                $telefono_movil = $fila->telefono_movil;
            }

            $email = $fila->email;

            if($fila->fax == 0)
            {
                $fax = NULL;
            }
            else
            {
                $fax = $fila->fax;
            }

            $direccion = $fila->direccion;

            if($fila->contacto == '')
            {
                $contacto = NULL;
            }
            else
            {
                $contacto = $fila->contacto;
            }

            if($fila->telefono_contacto == 0)
            {
                $telefono_contacto = NULL;
            }
            else
            {
                $telefono_contacto = $fila->telefono_contacto;
            }

            $tbl .= <<<EOD
            <tr>
                <td width="100"> $nombre </td>
                <td width="170"> $email </td>
                <td width="200"> $direccion </td>
                <td width="80"> $telefono_fijo </td>
                <td width="80"> $telefono_movil </td>
                <td width="80"> $fax </td>
                <td width="160"> $contacto </td>
                <td width="80"> $telefono_contacto </td>
            </tr>
EOD;
        }

        $tbl .= "</table>";

        //Mostramos el contenido HTML
        $pdf->writeHTML($tbl, true, false, false, false, '');

        // ---------------------------------------------------------
        // Cerrar el documento PDF y preparamos la salida
        // Este método tiene varias opciones, consulte la documentación para más información.
        $nombre_archivo = utf8_decode("proveedores.pdf");
        $pdf->Output($nombre_archivo, 'I');
    }

//Metodo que en funcion del proveedor seleccionado llama al modelo y me genera un formulario con los datos que corresponden para modificarlos
	public function combo_proveedor()
	{
		$id_proveedor = $this->input->post('elegido');
		$this->Proveedor->muestra_combo_proveedor($id_proveedor);
	}
}

/* End of file proveedor_controller.php */
/* Location: ./application/controllers/proveedor_controller.php */