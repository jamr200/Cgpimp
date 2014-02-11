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

//Clase para gestionar los Departamentos

class Departamento_controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('Departamento');
	}

	public function index()
	{
	}

//Metodos para redirigirme en el menu a las distintas vistas
//***********************************************************
	public function alta_departamento()
	{
		if($this->simple_sessions->get_value('status'))
		{
			$this->smarty->view('departamento/alta_departamento');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}
//////////////////////////////////////////////////////////////
	public function modificar_departamento()
	{
		if($this->simple_sessions->get_value('status'))
		{
			//cargo un listado de todos los departamentos que posee mi tabla
			$departamentos = $this->Departamento->obtener_todos_departamentos();
			//Los asigno a un array de smarty para pasarlos a mi vista
			$this->smarty->assign("departamentos",$departamentos);
			$this->smarty->view('departamento/modificar_departamento');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}
	//////////////////////////////////////////////////////////////
	public function listar_departamento()
	{
		if($this->simple_sessions->get_value('status'))
		{
			$this->load->library('pagination');

			$config = array();

			$desde = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;

			$config['per_page'] = 10;
			$config['base_url'] = base_url('departamento_controller/listar_departamento');
			$config['total_rows'] = $this->Departamento->getNumDepartamentos();
			$config['uri_segment'] = 3;
			$config['num_links'] = 2;
			$config['first_link'] = "&lt&lt";
			$config['last_link'] = "&gt&gt";
			//$config['display_pages'] = FALSE;

			$this->pagination->initialize($config);

			$listado_departamento = $this->Departamento->lista_departamentos($config['per_page'],$desde);

			$paginacion = $this->pagination->create_links();

			$this->smarty->assign('paginacion',$paginacion);
			$this->smarty->assign('listado_departamentos',$listado_departamento);
			$this->smarty->view('departamento/listar_departamento');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}
	//////////////////////////////////////////////////////////////
	public function eliminar_departamento()
	{
		if($this->simple_sessions->get_value('status'))
		{
			//cargo un listado de todos los departamentos que posee mi tabla
			$departamentos = $this->Departamento->obtener_todos_departamentos();
			//Los asigno a un array de smarty para pasarlos a mi vista
			$this->smarty->assign("departamentos",$departamentos);
			//cargo mi vista
			$this->smarty->view('departamento/eliminar_departamento');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}
	//////////////////////////////////////////////////////////////
	public function eliminar_departamento2()
	{
		if($this->simple_sessions->get_value('status'))
		{
			$id = $_GET['id'];

			//obtengo informacion del pedido
			$departamento = $this->Departamento->obtener_departamento($id);

			//paso el array a mi vista para mostrar los resultados
			$this->smarty->assign("departamento",$departamento);

			$this->smarty->view('departamento/eliminar_departamento2');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}
	//////////////////////////////////////////////////////////////
	public function modificar_departamento2()
	{
		if($this->simple_sessions->get_value('status'))
		{
			$id = $_GET['id'];

			//obtengo informacion del pedido
			$departamento = $this->Departamento->obtener_departamento($id);

			//paso el array a mi vista para mostrar los resultados
			$this->smarty->assign("departamento",$departamento);

			$this->smarty->view('departamento/modificar_departamento2');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}
//////////////////////////////////////////////////////////////
//Fin de los métodos que me permiten moverme entre las vistas

//Metodo para dar de alta un departamento
	public function addDepartamento()
	{
		//validacion desde servidor
		$this->form_validation->set_rules('nombre','Nombre','required|trim|max_length[50]|min_length[4]');
		$this->form_validation->set_rules('email','Email','required|valid_email|trim|max_length[50]');
		$this->form_validation->set_rules('telefono','Telefono','required|trim');
		$this->form_validation->set_rules('fax','Fax','trim');

		//Si el formulario no fue bien
		if(!$this->form_validation->run())
		{//Cargamos la vista
			$this->alta_departamento();
		}
		else{
			//nos creamos un objeto y metemos los datos que vienen del formulario
			$departamento = new $this->Departamento();
			$departamento->nombre_departamento   = $this->input->post('nombre');
			$departamento->email    = $this->input->post('email');
			$departamento->telefono = $this->input->post('telefono');
			$departamento->fax      = $this->input->post('fax');

			if($this->Departamento->set_departamento($departamento))
			{//mostramos un mensaje para dejar claro que ha sido agregado a la BD
				$this->smarty->assign("success", "Departamento almacenado correctamente.");
			}
			else if(!$this->Departamento->set_departamento($departamento))
			{//Existe el departamento en la BD
				$this->smarty->assign("error", "El departamento ya existe en la base de datos.");
			}
			else
			{//ha habido error en la BD
				$this->smarty->assign("error", "Error en la base de datos.");
			}
			$this->alta_departamento();
		}
	}

//Metodo para modificar un departamento
	public function updateDepartamento()
	{
		//validacion desde servidor
		$this->form_validation->set_rules('nombre','Nombre','required|trim|max_length[50]|min_length[4]');
		$this->form_validation->set_rules('email','Email','required|valid_email|trim|max_length[50]');
		$this->form_validation->set_rules('telefono','Telefono','required|trim');
		$this->form_validation->set_rules('fax','Fax','trim');

		if(!$this->form_validation->run())
		{//Cargamos la vista
			$this->modificar_departamento();
		}
		else{
			//Capturo el id del departamento a modificar
			$id = $this->input->post('combo_departamento');

			//capturo los datos del formulario a modificar en un array
			$data = array(
				'nombre_departamento' => $this->input->post('nombre'),
				'email' => $this->input->post('email'),
				'telefono' => $this->input->post('telefono'),
				'fax' => $this->input->post('fax')
			);

			if($this->Departamento->update_departamento($data,$id))
			{
				$this->smarty->assign('success','Departamento modificado correctamente.');
			}
			else
			{
				$this->smarty->assign('error','El departamento no se ha modificado.');
			}
			$this->modificar_departamento();
		}
	}

//Metodo para eliminar un departamento
	public function deleteDepartamento()
	{
		//recojo los datos procedentes del formulario(departamentos que son marcados) y los almaceno en un array
		$id_departamento = $this->input->post('combo_departamento');

		//compruebo si el array esta vacio
		if(empty($id_departamento))
		{//array vacio
			//mando mensaje
			$this->smarty->assign("error", "No ha seleccionado ningún departamento.");
		}
		else{
			//he seleccionado algun campo, procedemos a borrar
			$nombre_departamento = $this->Departamento->obtener_nombre_departamento_por_id($id_departamento);
			$departamento = $this->Departamento->unset_departamento($id_departamento);

			if($departamento == 1)
			{
				$this->smarty->assign("success",  'Departamento con nombre <strong>'.$nombre_departamento.'</strong> eliminado correctamente.');
			}
			else
			{
				$this->smarty->assign("error", 'El departamento <strong>'.$nombre_departamento.'</strong> no ha sido borrado porque tiene personas asociadas.');
			}
		}
		$this->eliminar_departamento();
	}

	//Metodo para eliminar un departamento(acciones botonera)
	public function deleteDepartamento2()
	{
		//recojo los datos procedentes del formulario(departamentos que son marcados) y los almaceno en un array
		$id_departamento = $_GET['id_departamento'];

		//compruebo si el array esta vacio
		if(empty($id_departamento))
		{//array vacio
			//mando mensaje
			$this->smarty->assign("error", "No ha seleccionado ningún departamento.");
		}
		else{
			//he seleccionado algun campo, procedemos a borrar
			$nombre_departamento = $this->Departamento->obtener_nombre_departamento_por_id($id_departamento);
			$departamento = $this->Departamento->unset_departamento($id_departamento);

			if($departamento == 1)
			{
				$this->smarty->assign("success",  'Departamento con nombre <strong>'.$nombre_departamento.'</strong> eliminado correctamente.');
			}
			else
			{
				$this->smarty->assign("error", 'El departamento <strong>'.$nombre_departamento.'</strong> no ha sido borrado porque tiene personas asociadas.');
			}
		}
		$this->eliminar_departamento();
	}


	public function GeneraPdfListadoDepartamento()
    {
        $this->load->library('Pdf');

        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        //Para orientar la pagina en horizontal (L) o vertical (P)
        //$pdf->setPageOrientation(PDF_PAGE_ORIENTATION);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Jose A. Moreno');
        $pdf->SetTitle('Listado PDF');
        $pdf->SetSubject('Listado de departamentos');
        $pdf->SetKeywords('PDF, departamentos, listado');

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
        $departamentos = $this->Departamento->obtener_todos_departamentos();
        //preparamos y maquetamos el contenido a crear

        $num_departamentos = count($departamentos);

        $tbl = <<<EOD
        <style type=text/css>
            th{color: #000; font-weight: bold; background-color: #eee}
            td{background-color: #fff; color: #000}
        </style>
        <h2>Listado de Departamentos </h2>
        <table cellspacing="0" cellpadding="1" border="1">
            <tr>
                <th width="240"> Nombre </th>
                <th width="230"> Email </th>
                <th width="85"> Telefono </th>
                <th width="85"> Fax </th>
            </tr>
EOD;
        //Componemos las filas con los registros de nuestra tabla
        foreach ($departamentos as $fila)
        {
            $nombre = $fila['nombre_departamento'];
            $email = $fila['email'];
            $telefono = $fila['telefono'];
            if($fila['fax'] == 0)
            {
                $fax = NULL;
            }
            else
            {
                $fax = $fila['fax'];
            }

            $tbl .=  <<<EOD
                    <tr>
                        <td width="240" align="left"> $nombre </td>
                        <td width="230" align="left"> $email </td>
                        <td width="85" align="left"> $telefono </td>
                        <td width="85" align="left"> $fax </td>
                    </tr>
EOD;
        }
        $tbl .= "</table>";

        //Mostramos el contenido HTML
        $pdf->writeHTML($tbl, true, false, false, false, '');

        // ---------------------------------------------------------
        // Cerrar el documento PDF y preparamos la salida
        // Este método tiene varias opciones, consulte la documentación para más información.
        $nombre_archivo = utf8_decode("departamentos.pdf");
        $pdf->Output($nombre_archivo, 'I');
    }

	public function combo_departamento()
	{
		$id_departamento = $this->input->post('elegido');
		$this->Departamento->muestra_combo_departamento($id_departamento);
	}
}

/* End of file departamento_controller.php*/
/* Location: ./application/controllers/departamento_controller.php */