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

//Clase para gestionar las copias de seguridad

class Backup_controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
	}

	//Metodos para redirigirme en el menu a las distintas vistas
	//**************************************************************
	public function restaurando_backup()
	{
		if($this->simple_sessions->get_value('status'))
		{
			$this->smarty->view('backup/restaurar_backup');
		}
		else
		{
			$this->smarty->assign('error','Debe iniciar sesion para acceder al sistema.');
			$this->smarty->view('start/start_view');
		}
	}

	//**************************************************************
	//**************************************************************

	public function hacer_backup()
	{
		date_default_timezone_set("Europe/Madrid");
		// Carga la clase de utilidades de base de datos
		$this->load->dbutil();

		$fecha_hora = date("Ymd_His");

		$prefs = array(
            'tables'      => array(),  			// Arreglo de tablas para respaldar.
            'ignore'      => array(),           // Lista de tablas para omitir en la copia de seguridad
            'format'      => 'txt',             // gzip, zip, txt
            'filename'    => '',    			// Nombre de archivo - NECESARIO SOLO CON ARCHIVOS ZIP
            'add_drop'    => TRUE,              // Agregar o no la sentencia DROP TABLE al archivo de respaldo
            'add_insert'  => TRUE,              // Agregar o no datos de INSERT al archivo de respaldo
            'newline'     => "\n"               // Caracter de nueva línea usado en el archivo de respaldo
        );

		// Crea una copia de seguridad de toda la base de datos y la asigna a una variable
		$copia_de_seguridad =  "SET FOREIGN_KEY_CHECKS = 0;\n\n".$this->dbutil->backup($prefs); 

		// Carga el asistente de archivos y escribe el archivo en su servidor
		$this->load->helper('file');
		$this->load->library('zip');

		if ( ! write_file('./backup/backup_'.$fecha_hora.'.txt', $copia_de_seguridad))
		{
		    $this->smarty->assign('error','No se ha podido crear la copia.');
		}
		else
		{
			$ruta = './backup/backup_'.$fecha_hora.'.txt';
			//leo el archivo y lo comprimo
			$this->zip->read_file($ruta);
			$this->zip->archive('./backup/backup_'.$fecha_hora.'.zip');
			//elimino el archivo
			unlink($ruta);

		    $this->smarty->assign('success','Copia creada satisfactoriamente');
		}

		// Carga el asistente de descarga y envía el archivo a su escritorio
		//$this->load->helper('download');
		//force_download('copia_de_seguridad.zip', $copia_de_seguridad);
		$this->smarty->view('index');
	}

	public function restaura_backup()
	{
		$this->load->helper('file');
		//Añado la linea que permite olvidar que existen restricciones
		//write_file('./copias/mybackup.sql', 'SET FOREIGN_KEY_CHECKS = 0;');

		//Obtengo el nombre del fichero a descomprimir
		$nombre_archivo = $_FILES['ficheros']['name'];
		$ruta = './backup/'.$nombre_archivo[0];

		//Descomprimo el fichero
		$zip = new ZipArchive;
		if ($zip->open($ruta) === TRUE)
		{//Todo va bien y lo extraigo en el directorio ./backup
		    $zip->extractTo('./backup');
		    $zip->close();

		    //Recojo el archivo de copia y lo restauro
		    $copia_a_restaurar = str_replace('zip','txt',$ruta);
			$backup = read_file($copia_a_restaurar);

			if ( !$backup)
			{
		    	$this->smarty->assign('error','No se ha podido restaurar la copia.');
			}
			else
			{
				$sql_clean = '';
	                foreach (explode("\n", $backup) as $line){
	                    if(isset($line[0]) && $line[0] != "#"){
	                        $sql_clean .= $line."\n";
	                    }
	                }

	                //echo $sql_clean;

	                foreach (explode(";\n", $sql_clean) as $sql){
	                    $sql = trim($sql);
	                    //echo  $sql.'<br/>============<br/>';
	                    if($sql)
	                    {
	                        $this->db->query($sql);
	                    }
	                }

	            //Elimino el archivo que descomprimo
	            unlink($copia_a_restaurar);

			    $this->smarty->assign('success','Copia restaurada satisfactoriamente.');
			}
		}
		else
		{
		    $this->smarty->assign('error','No se ha podido extraer el fichero.');
		}
		$this->smarty->view('index');
	}


}

/* End of file backup_controller.php*/
/* Location: ./application/controllers/backup_controller.php */