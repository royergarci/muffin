<?php
date_default_timezone_set('America/Mexico_City');
require './vendor/autoload.php';
use Parse\ParseClient;
use Parse\ParseObject;
use Parse\ParseUser;
use Parse\ParseQuery;

ParseClient::initialize('Rip9rsS8uU8n64ovmwgx92HEGQWHIOo1Vinu1nh5', '1JXILNzsokJTjoQnfKMVp3J0TzeSXDjHBRxXr35v', 'lhKoBHSOtrUgVrB0XYW8VDGTYdGTuyKH2yPyPf5B');

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
	 function __construct()
    {
        // Call the Model constructor
        parent::__construct();
       // $this->load->library('utilerias');
        $this->load->helper('form');
    }
	public function index()
	{


		$this->load->view('dashboard', array('error' => ' ' ));
	}
	public function initDashboard($fechaInicio = '',$fechaFin = ''){
		//date("Y-m-d")

		if ($fechaInicio == '')
			$fechaInicio = date("Y-m-d");

		if ($fechaFin == '')
			$fechaFin = date("Y-m-d");
		//echo '1 -'. date("h:i:sa").'<br>';
		$facturas = $this->getFacturasEntreFechas($fechaInicio,$fechaFin);

		//print_r($facturas);
		//echo '11 -'. date("h:i:sa").'<br>';
		$data['totalVentas'] = $this->getTotalVentas($facturas);

		//echo '2 -'. date("h:i:sa").'<br>';
		//Obtenemos las ventas por cliente
		$data['clientes'] = $this->getTotalesClientesFacturas($facturas);

		//echo '3 -'. date("h:i:sa").'<br>';
		//Obtenemos los productos vendidos
		$facturasProductos = $this->getProductosTotales($facturas);

		//echo '4 -'. date("h:i:sa").'<br>';
		//Obtenemos los totales de productos
		$totalesProductos = $this->getTotalesProductos($facturasProductos);

		//echo '5 -'. date("h:i:sa").'<br>';
		$data['masVendido'] = $this->getProductoMasVendido($totalesProductos);

		//echo '6 -'. date("h:i:sa").'<br>';
		$data['menosVendido'] = $this->getProductoMenosVendido($totalesProductos);

		//echo '7 -'. date("h:i:sa").'<br>';
		$data['totalesProductos'] = $totalesProductos;
		
		//print_r($totalesProductos);
		$this->load->view('dashboard', $data);
	}
	public function getTotalVentas($facturas){
		$total = 0;
		foreach($facturas as $factura){
			$total += $factura->total;
		}
		return $total;
	}
	public function getTotalesClientesFacturas($facturas){
		$queryClientes = new ParseQuery("clientes");

		foreach($facturas as $factura){
			$id = $factura->cliente->getObjectId();
			if (isset($clientes[$id]['total'])){
				echo 'Viejo';
				$clientes[$id]['total'] += $factura->total;
				//$clientes[$id]['id'] = $id;
			}
			else{
				echo 'Nuevo';
				$clientes[$id]['total'] = $factura->total;
				$clientes[$id]['id'] = $id;
			}
		}

		//print_r($clientes);
		$i = 0;
		foreach ($clientes as $cliente){
			
			$queryClientes->equalTo('objectId',$cliente['id']);
			$result = $queryClientes->find();

			//$clientes[$cliente['id']]['nombre'] = $result[0]->nombre;

			$cli[$i]['id'] = $cliente['id'];
			$cli[$i]['nombre'] = $result[0]->nombre;
			$cli[$i]['total'] = $cliente['total'];
			$i++;
		}
		return $cli;
	}
	public function getFacturasEntreFechas($fechaInicio, $fechaFin){

		//Sacamos la fecha del dìa de hoy
		$dateInicio = new DateTime($fechaInicio);
		$dateFin = new DateTime($fechaFin);


		//echo date('Y-m-d\T00:00:00.000\Z');
		//echo $dateInicio->format('Y-m-d\T00:00:00.000\Z');

		$query = new ParseQuery("facturas");
		$startDate = array("__type"=>"Date","iso"=>$dateInicio->format('Y-m-d\T00:00:00.000\Z')); 
		$endDate = array("__type"=>"Date","iso"=>$dateFin->format('Y-m-d\T23:59:59.999\Z'));

		$query->greaterThanOrEqualTo("fecha2", $startDate);
		$query->lessThanOrEqualTo("fecha2", $endDate);

		$results = $query->find();

		return $results;
	}
	public function getProductosTotales($facturas){
		//$queryProd = new ParseQuery("productos");
		$queryFacProd = new ParseQuery("factura_productos");
		//$resProd = $query->find();

		$i = 0;
		foreach ($facturas as $factura) {
			$productosTotales[$i] = $this->getProductosFactura($factura,$queryFacProd);
			$i++;
		}
		return $productosTotales;
	}
	public function getProductosFactura($factura,$queryFacProd){	

		$queryFacProd->equalTo('idFactura',$factura);
		$resProdFact = $queryFacProd->find();

		$i = 0;
		foreach($resProdFact as $record){

			//Obtenemos el nombre del producto
		/*	$queryProd->equalTo('objectId',$record->idProducto->getObjectId());
			$producto = $queryProd->find();*/

			$productosFactura[$i]['facturaId'] = $record->idFactura->getObjectId();
			$productosFactura[$i]['productoId'] = $record->idProducto->getObjectId();
			$productosFactura[$i]['numPzas'] = $record->piezas;
			$productosFactura[$i]['precio'] = $record->precio;
			$productosFactura[$i]['subTotal'] = ($record->piezas * $record->precio);
			//$productosFactura[$i]['productoNombre'] = $producto[0]->descripcion;
			$i++;
		}
		return $productosFactura;
	}
	public function getTotalesProductos($facturasProductos){
		$queryProd = new ParseQuery("productos");
		foreach ($facturasProductos as $facturaProductos){
			foreach ($facturaProductos as $producto){
				if (isset($productos[$producto['productoId']])){
					$productos[$producto['productoId']]['numPiezasTotal'] += $producto['numPzas'];
					$productos[$producto['productoId']]['totalDinero'] += $producto['subTotal'];
				}
				else{
					$queryProd->equalTo('objectId',$producto['productoId']);
					$resProd = $queryProd->find();
					//echo 'En totales '.$resProd[0]->descripcion;
					//print_r($resProd);

					$productos[$producto['productoId']]['numPiezasTotal'] = $producto['numPzas'];
					$productos[$producto['productoId']]['nombre'] = $resProd[0]->descripcion;
					$productos[$producto['productoId']]['totalDinero'] = $producto['subTotal'];
					$productos[$producto['productoId']]['IdProducto'] = $producto['productoId'];
				}
			}
		}
		$i=0;
		foreach ($productos as $producto){
			$totalesProductos[$i] = $producto;
			$i++;
		}
		return $totalesProductos;
	}
	public function getProductoMasVendido($totalesProductos){

		foreach($totalesProductos as $totalP){
			if (isset($masVendido)){
				if ($totalP['numPiezasTotal'] > $masVendido['numPiezasTotal'])
					$masVendido = $totalP;
			}
			else{
				$masVendido = $totalP;
			}
		}
		return $masVendido;
	}
	public function getProductoMenosVendido($totalesProductos){
		foreach($totalesProductos as $totalP){
			if (isset($menosVendido)){
				if ($totalP['numPiezasTotal'] < $menosVendido['numPiezasTotal'])
					$menosVendido = $totalP;
			}
			else{
				$menosVendido = $totalP;
			}
		}
		return $menosVendido;
	}
	function datatable()
	{
		$query = new ParseQuery("facturas");
		$results = $query->find();

		$i=0;
		foreach ($results as $factura){
			//print_r($factura);

			$data['data'][$i]['folio'] = $factura->folio;
			$data['data'][$i]['serie'] = $factura->serie;
			$data['data'][$i]['id'] = $factura->idFactura;
			$data['data'][$i]['total'] = $factura->total;

			$i++;
		}
		echo json_encode($data);
	}
}
?>