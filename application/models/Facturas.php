<?php
require './vendor/autoload.php';
use Parse\ParseClient;
use Parse\ParseObject;
use Parse\ParseUser;
use Parse\ParseQuery;
ParseClient::initialize('Rip9rsS8uU8n64ovmwgx92HEGQWHIOo1Vinu1nh5', '1JXILNzsokJTjoQnfKMVp3J0TzeSXDjHBRxXr35v', 'lhKoBHSOtrUgVrB0XYW8VDGTYdGTuyKH2yPyPf5B');
defined('BASEPATH') OR exit('No direct script access allowed');
class Noticias extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->library('utilerias');
    }
    public function traerFacturas(){
            $query = new ParseQuery("facturas");
            $query->descending("fecha");
            $results = $query->find();

            return $results;
    }
    public function traerNoticiasSeccion($seccion){
            $query = new ParseQuery("noticias");
            $query->descending("fecha");
            $query->equalTo("seccion",$seccion);
            $results = $query->find();

            return $results;
    }
}
?>