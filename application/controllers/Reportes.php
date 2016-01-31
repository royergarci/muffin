<?php
require './vendor/autoload.php';
use Parse\ParseClient;
use Parse\ParseObject;
use Parse\ParseUser;
use Parse\ParseQuery;

ParseClient::initialize('Rip9rsS8uU8n64ovmwgx92HEGQWHIOo1Vinu1nh5', '1JXILNzsokJTjoQnfKMVp3J0TzeSXDjHBRxXr35v', 'lhKoBHSOtrUgVrB0XYW8VDGTYdGTuyKH2yPyPf5B');

defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		//$this->load->view('welcome_message');
		$this->load->view('reportes/general', array('error' => ' ' ));
		$this->load->helper('form');
	}

	public function ventasDiaTotales($fecha){
		$query = new ParseQuery("facturas");
		$query->startsWith("fecha", $fecha);
		$results = $query->find();

		$data['facturas'] = '';

		//print_r($results[0]->folio);
		foreach ($results as $record){
			echo $record->serie.$record->folio;
		}

		$this->load->view('reportes/ventas_dia', $data);
	}
}
?>