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

//Clase para gestionar las Personas

class Persona_controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('Persona');
		$this->load->model('Departamento');
	}

	public function index()
	{

	}

//Metodos para redirigirme en el menu a las distintas vistas
//***********************************************************
	public function alta_persona()
	{
		if($this->simple_sessions->get_value('status'))
		{
			//obtengo el nombre de todos los departamentos de mi BD y los almaceno en un array
			$departamento = new $this->Departamento();
			$d = $this->Departamento->obtener_nombre_departamentos($departamento);
			//paso el array a mi vista para mostrar los resultados
			$this->smarty->assign("departamento",$d);

			$this->smarty->view('personal/alta_persona');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}
	//////////////////////////////////////////////////////////////
	public function modificar_persona()
	{
		if($this->simple_sessions->get_value('status'))
		{
			//obtengo todos los datos de las personas de mi BD y los almaceno en un array
			$persona = new $this->Persona();
			$p = $this->Persona->obtener_personas($persona);
			//paso el array a mi vista par mostrar los resultados
			$this->smarty->assign("persona",$p);

			$this->smarty->view('personal/modificar_persona');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}
	//////////////////////////////////////////////////////////////
	public function listar_persona()
	{
		if($this->simple_sessions->get_value('status'))
		{
			$this->load->library('pagination');

			$config = array();

			$desde = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0 ;

			$config['per_page'] = 10;
			$config['base_url'] = base_url('persona_controller/listar_persona');
			$config['total_rows'] = $this->Persona->getNumPersonas();
			$config['uri_segment'] = 3;
			$config['num_links'] = 2;
			$config['first_link'] = "&lt&lt";
			$config['last_link'] = "&gt&gt";
			//$config['display_pages'] = FALSE;

			$this->pagination->initialize($config);

			$listado_personas = $this->Persona->lista_personas($config['per_page'],$desde);

			$paginacion = $this->pagination->create_links();

			$this->smarty->assign('paginacion',$paginacion);
			$this->smarty->assign('listado_personas',$listado_personas);
			$this->smarty->view('personal/listar_persona');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}
	//////////////////////////////////////////////////////////////
	public function eliminar_persona()
	{
		if($this->simple_sessions->get_value('status'))
		{
			//obtengo todos los datos de las personas de mi BD y los almaceno en un array
			$persona = new $this->Persona();
			$p = $this->Persona->obtener_personas($persona);
			//paso el array a mi vista par mostrar los resultados
			$this->smarty->assign("persona",$p);
			$this->smarty->view('personal/eliminar_persona');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}
	//////////////////////////////////////////////////////////////
	public function visualizar_persona()
	{
		if($this->simple_sessions->get_value('status'))
		{
			$id = $_GET['id'];

			//obtengo informacion de la persona
			$persona = $this->Persona->obtener_persona($id);

			//Obtengo el nombre del departamento
			$nombre_departamento = $this->Departamento->obtener_nombre_departamento_por_id($persona->departamento);

			//paso el array a mi vista par mostrar los resultados
			$this->smarty->assign('persona',$persona);
			$this->smarty->assign('departamento',$nombre_departamento);

			$this->smarty->view('personal/visualizar_persona');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}
	//////////////////////////////////////////////////////////////
	public function modificar_persona2()
	{
		if($this->simple_sessions->get_value('status'))
		{
			$id = $_GET['id'];

			//obtengo informacion de la persona
			$persona = $this->Persona->obtener_persona($id);

			//Convertimos el id del departamento a su nombre para mostarlo
			$nombre_departamento = $this->Departamento->obtener_nombre_departamento_por_id($persona->departamento);

            //En $departamentos meto todos los departamentos menos el obtenido de la BD
            $departamentos = $this->Departamento->obtener_nombre_departamentos_menos_uno($persona->departamento);

			//paso el array a mi vista para mostrar los resultados
			$this->smarty->assign("persona",$persona);
			$this->smarty->assign("departamento",$nombre_departamento);
			$this->smarty->assign("departamentos",$departamentos);
			$this->smarty->view('personal/modificar_persona2');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}
	//////////////////////////////////////////////////////////////
	public function eliminar_persona2()
	{
		if($this->simple_sessions->get_value('status'))
		{
			$id = $_GET['id'];

			//obtengo informacion de la persona
			$persona = $this->Persona->obtener_persona($id);

			//Convertimos el id del departamento a su nombre para mostarlo
			$nombre_departamento = $this->Departamento->obtener_nombre_departamento_por_id($persona->departamento);

			//paso el array a mi vista para mostrar los resultados
			$this->smarty->assign("persona",$persona);
			$this->smarty->assign("departamento",$nombre_departamento);

			$this->smarty->view('personal/eliminar_persona2');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}
//////////////////////////////////////////////////////////////
//Fin de los métodos que me permiten moverme entre las vistas

//Metodo para dar de alta una persona
	public function addPersona()
	{
		//validacion desde servidor
		$this->form_validation->set_rules('nombre','Nombre','required|trim|max_length[20]');
		$this->form_validation->set_rules('apellido1','primer apellido','required|trim|max_length[30]');
		$this->form_validation->set_rules('apellido2','segundo apellido','required|trim|max_length[30]');
		$this->form_validation->set_rules('dni','DNI','required|trim|max_length[9]');
		$this->form_validation->set_rules('email','Email','required|valid_email|trim|max_length[80]');
		$this->form_validation->set_rules('departamento','Departamento','required|trim');
		$this->form_validation->set_rules('jefe','Jefe','required|trim');

		//Si el formulario no fue bien
		if(!$this->form_validation->run())
		{//Cargamos la vista
			$this->alta_persona();
		}
		else{
			//nos creamos un objeto y metemos los datos que vienen del formulario
			$persona = new $this->Persona();

			$persona->nombre_persona       = $this->input->post('nombre');
			$persona->apellido1    = $this->input->post('apellido1');
			$persona->apellido2    = $this->input->post('apellido2');
			$persona->dni          = $this->input->post('dni');
			$persona->email        = $this->input->post('email');
			$persona->departamento = $this->input->post('departamento');
			$persona->jefe         = $this->input->post('jefe');


			if($this->Persona->set_persona($persona))
			{//mostramos un mensaje para dejar claro que ha sido agregado a la BD
				$this->smarty->assign("success", "Persona almacenada correctamente.");
			}
			else if(!$this->Persona->set_persona($persona))
			{//Existe el persona en la BD
				$this->smarty->assign("error", "La persona ya existe en la base de datos.");
			}
			else
			{//ha habido error en la BD
				$this->smarty->assign("error", "Error en la base de datos.");
			}
			$this->alta_persona();
		}
	}


//Metodo para modificar una persona
public function updatePersona()
{
	//validacion desde servidor
	$this->form_validation->set_rules('nombre','Nombre','required|trim|max_length[20]|min_lenght[3]');
	$this->form_validation->set_rules('apellido1','primer apellido','required|trim|max_length[30]|min_lenght[4]');
	$this->form_validation->set_rules('apellido2','segundo apellido','required|trim|max_length[30]|min_lenght[4]');
	$this->form_validation->set_rules('dni','DNI','required|trim|max_length[9]');
	$this->form_validation->set_rules('email','Email','required|valid_email|trim|max_length[80]');
	$this->form_validation->set_rules('departamento','Departamento','required|trim');
	$this->form_validation->set_rules('jefe','Jefe','required|trim');

	//Si el formulario no fue bien
	if(!$this->form_validation->run())
	{//Cargamos la vista
		$this->modificar_persona();
	}
	else
	{
		//Capturo el id de la persona a modificar
		$id = $this->input->post('combo_persona');

		//capturo los datos del formulario a modificar en un array
		$data = array(
			'nombre_persona' => $this->input->post('nombre'),
			'apellido1' => $this->input->post('apellido1'),
			'apellido2' => $this->input->post('apellido2'),
			'dni' => $this->input->post('dni'),
			'email' => $this->input->post('email'),
			'departamento' => $this->input->post('departamento'),
			'jefe' => $this->input->post('jefe')
		);

		if($this->Persona->update_persona($data,$id))
		{
			$this->smarty->assign('success','Persona modificada correctamente.');
		}
		else
		{
			$this->smarty->assign('error','La persona no se ha modificado.');
		}
		$this->modificar_persona();
	}
}

//Metodo para eliminar una persona
	public function deletePersona()
	{
		//recojo los datos del formulario
		$id_persona = $this->input->post('combo_persona');

		//compruebo si el array esta vacio
		if(empty($id_persona))
		{//array vacio
			//mando mensaje
			$this->smarty->assign("error", "No ha seleccionado ninguna persona.");
		}
		else{
			//he seleccionado algun persona, procedemos a borrar
			$nombre_persona = $this->Persona->obtener_nombre_persona_por_id($id_persona);
			if($this->Persona->unset_persona($id_persona))
			{
				$this->smarty->assign("success", 'Persona con nombre <strong>'.$nombre_persona.'</strong> eliminada correctamente.');
			}
			else
			{
				$this->smarty->assign("error", 'Ha ocurrido un error. La persona <strong>'.$nombre_persona.'</strong> no ha sido borrada.');
			}
		}
		$this->eliminar_persona();
	}

	//Metodo para eliminar una persona(Accion de botonera)
	public function deletePersona2()
	{
		//recojo los datos del formulario
		$id_persona = $_GET['id_persona'];

		//compruebo si el array esta vacio
		if(empty($id_persona))
		{//array vacio
			//mando mensaje
			$this->smarty->assign("error", "No ha seleccionado ninguna persona.");
		}
		else{
			//he seleccionado algun persona, procedemos a borrar
			$nombre_persona = $this->Persona->obtener_nombre_persona_por_id($id_persona);
			if($this->Persona->unset_persona($id_persona))
			{
				$this->smarty->assign("success", 'Persona con nombre <strong>'.$nombre_persona.'</strong> eliminada correctamente.');
			}
			else
			{
				$this->smarty->assign("error", 'Ha ocurrido un error. La persona <strong>'.$nombre_persona.'</strong> no ha sido borrada.');
			}
		}
		$this->eliminar_persona();
	}

	public function GeneraPdfListadoPersona()
    {
        $this->load->library('Pdf');

        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        //Para orientar la pagina en horizontal (L) o vertical (P)
        $pdf->setPageOrientation('L');
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Jose A. Moreno');
        $pdf->SetTitle('Listado PDF');
        $pdf->SetSubject('Listado de personas');
        $pdf->SetKeywords('PDF, personas, listado');

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
        $personas = $this->Persona->lista_personas2();
        //preparamos y maquetamos el contenido a crear

        $num_personas = count($personas);

        $tbl = <<<EOD
        <style type=text/css>
            th{color: #000; font-weight: bold; background-color: #eee}
            td{background-color: #fff; color: #000}
        </style>
        <h2>Listado de Personas </h2>
        <table cellspacing="0" cellpadding="1" border="1">
            <tr>
                <th width="100"> Nombre </th>
                <th width="150"> Apellido1 </th>
                <th width="150"> Apellido2 </th>
                <th width="80"> Dni </th>
                <th width="230"> Email </th>
                <th width="240"> Departamento </th>
            </tr>
EOD;
        //Componemos las filas con los registros de nuestra tabla
        foreach ($personas as $fila)
        {

            $nombre = $fila->nombre_persona;
            $apellido1 = $fila->apellido1;
            $apellido2 = $fila->apellido2;
            $dni = $fila->dni;
            $email = $fila->email;
            $departamento = $fila->nombre_departamento;

            $tbl .= <<<EOD
            <tr>
                <td width="100"> $nombre </td>
                <td width="150"> $apellido1 </td>
                <td width="150"> $apellido2 </td>
                <td width="80"> $dni </td>
                <td width="230"> $email </td>
                <td width="240"> $departamento </td>
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

//Metodo que en funcion de la persona seleccionada llama al modelo y me genera un formulario con los datos que corresponden para modificarlos
	public function combo_persona()
	{
		$id_persona = $this->input->post('elegido');
		$this->Persona->muestra_combo_persona($id_persona);
	}
}

/* End of file persona_controller.php */
/* Location: ./application/controllers/persona_controller.php */