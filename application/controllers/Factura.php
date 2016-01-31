<?php
require './vendor/autoload.php';
use Parse\ParseClient;
use Parse\ParseObject;
use Parse\ParseUser;
use Parse\ParseQuery;

ParseClient::initialize('Rip9rsS8uU8n64ovmwgx92HEGQWHIOo1Vinu1nh5', '1JXILNzsokJTjoQnfKMVp3J0TzeSXDjHBRxXr35v', 'lhKoBHSOtrUgVrB0XYW8VDGTYdGTuyKH2yPyPf5B');

defined('BASEPATH') OR exit('No direct script access allowed');

class Factura extends CI_Controller {

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
		$this->load->view('uploadFactura', array('error' => ' ' ));
		$this->load->helper('form');

		/*$query = ParseUser::query();
		$query->equalTo("tipo_usuario", "STAFF"); 
		$results = $query->find();

		$count = $query->count();

		for ($i = 0; $i < count($results); $i++) {
		  // This does not require a network access.
		  echo $results[$i]->nombre.'<br>';
		  
		}
		echo $count;*/

	}
	
	public function do_upload()
	{
		$config['upload_path'] = './facturas/';
		$config['allowed_types'] = '*';
		$config['max_size']	= '10000';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			$this->load->view('upload', $error);
			print_r ($error);
		}
		else
		{
			echo 'Aqui en upload';
			$data['action'] = 'Subiendo la factura';
			$this->load->view('cargandoFactura', $data);
			$data = array('upload_data' => $this->upload->data());
			
			//print_r($data['upload_data']);
			//Si el archivo es un zip o xml puro
			if ($data['upload_data']['file_type'] == 'application/xml'){

				$xmlFile = $this->leerArchivo($data['upload_data']['file_name']);
				$this->leerFactura($xmlFile);

			} 
			if ($data['upload_data']['file_type'] == 'application/zip'){
				//Unzip el archivo
				$this->unzipFile($data['upload_data']['file_name']);

				//Leemos todas las facturas del zip y las ponemos en un array
				$nameZip = $data['upload_data']['file_name'];
				$facturas = $this->leerArhivosDir($nameZip);
				
			//	print_r($facturas);

				foreach($facturas as $xmlFileName){ // iterate files
				  	if(is_file(FCPATH.'facturas/tmp/'.$xmlFileName)){
				  		
				  		$pos = strpos($xmlFileName, 'XML');

				  		if ($pos === false)
				  			echo $xmlFileName.' No es factura <br>';
				  		else{
				  			//echo 'Aqui cargando factura '.$xmlFileName.'<br>';
				    		$xmlFile = $this->leerArchivo('tmp/'.$xmlFileName);
				    		$this->leerFactura($xmlFile);
				    	}
					}
				}
			}
		}
	}
	public function leerArchivo($name){
		echo $name;
		//aqui se debe crear el proceso
		$file = fopen(FCPATH.'facturas/'.$name, "rb") or exit("Unable to open file!");
				
		$cadena = '';
		$line = 0;
				
		while(!feof($file)){
			$cadena = $cadena.fgets($file);
		}

				
		fclose($file);			
		return ($cadena);
	}
	public function unzipFile($name){

			$files = glob(FCPATH.'facturas/tmp/*'); // get all file names

			foreach($files as $file){ // iterate files
			  if(is_file($file))
			    unlink($file); // delete file
			  else
			  	rmdir($file);
			}

			
            $zip = new ZipArchive;
            $file = FCPATH.'facturas/'.$name;

            chmod($file,0777);
            if ($zip->open($file) === TRUE) {
                    $zip->extractTo(FCPATH.'facturas/tmp');
                    $zip->close();
                    echo 'zip ok <br>';
            } else {
                    echo 'failed';
            }
	}
	public function leerArhivosDir($nameZip){
			
			$facturas = array();

			$directorio = opendir(FCPATH.'facturas/tmp/'); //ruta zip facturas
			while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
			{
			    if (!is_dir($archivo))//verificamos si es o no un directorio
			    {
			        array_push($facturas, $archivo);
			    }
			}
			return ($facturas);
	}
	public function leerFactura($cadenaXml){
			$factura = array();

			$dom = new DOMDocument();
			$dom->loadXML($cadenaXml);

			$conceptoNum = 0;

			foreach ($dom->getElementsByTagNameNS('http://www.sat.gob.mx/TimbreFiscalDigital','*') as $element){
				if ($element->localName == 'TimbreFiscalDigital'){
					$factura['datos']['uuid'] = $element->getAttribute('UUID');
					$factura['datos']['fechaTimbrado'] = $element->getAttribute('FechaTimbrado');
				}
			}

			foreach ($dom->getElementsByTagNameNS('http://www.sat.gob.mx/cfd/3','*') as $element){
				//print_r $element;
				//echo 'localName '. $element->localName. ', prefix: '. $element->prefix ."<br>";

				if ($element->localName == 'Comprobante'){

					$factura['datos']['serie'] = $element->getAttribute('serie');
					$factura['datos']['folio'] = $element->getAttribute('folio');
					$factura['datos']['total'] = $element->getAttribute('total');
					$factura['datos']['fecha'] = $element->getAttribute('fecha');
					$factura['datos']['tipoComprobante'] = $element->getAttribute('tipoDeComprobante');
					$factura['datos']['moneda'] = $element->getAttribute('Moneda');
				}
				if ($element->localName == 'Emisor'){
					$factura['emisor']['rfc'] = $element->getAttribute('rfc');
					$factura['emisor']['nombre'] = $element->getAttribute('nombre');
				}
				if ($element->localName == 'Receptor'){
					$factura['receptor']['rfc'] = $element->getAttribute('rfc');
					$factura['receptor']['nombre'] = $element->getAttribute('nombre');
				}
				if ($element->localName == 'Concepto'){
					$factura['productos'][$conceptoNum]['cantidad'] = $element->getAttribute('cantidad');
					$factura['productos'][$conceptoNum]['unidad'] = $element->getAttribute('unidad');
					$factura['productos'][$conceptoNum]['noIdentificacion'] = $element->getAttribute('noIdentificacion');
					$factura['productos'][$conceptoNum]['descripcion'] = $element->getAttribute('descripcion');
					$factura['productos'][$conceptoNum]['valorUnitario'] = $element->getAttribute('valorUnitario');
					$factura['productos'][$conceptoNum]['importe'] = $element->getAttribute('importe');
					$conceptoNum++;
				}

			}

			//Revisamos si existe la factura para ya no guardarla
			$query = new ParseQuery("facturas");
			$query->equalTo("idFactura", $factura['datos']['uuid']);
			$results = $query->find();

			if (count($results) == 0){
				//$data['action'] = 'Cargando Receptor';
				//$this->load->view('cargandoFactura', $data);

				$receptor = $this->guardarReceptor($factura['receptor']);

				//$data['action'] = 'Cargando Receptor <br> CargandoFactura';
				//$this->load->view('cargandoFactura', $data);

				$facturaObj = $this->guardarFactura($factura['datos'],$receptor);

				//$data['action'] = 'Cargando Receptor <br> CargandoFactura<br> CargandoProductos';
				//$this->load->view('cargandoFactura', $data);

				$this->guardarProductos($factura['productos'],$facturaObj);

				//$data['action'] = 'Cargando Receptor <br> CargandoFactura<br> CargandoProductos<br>FacturaRegistrada';
				//$this->load->view('cargandoFactura', $data);
			}
			else{
				echo 'La factura '.$factura['datos']['uuid'].' ya esta registrada';
			}
	}
	public function guardarReceptor($receptor){
		$cliente = new ParseObject("clientes");

		//$cliente->set("objectId", $receptor['rfc']);
		$cliente->set("rfc", $receptor['rfc']);
		$cliente->set("nombre", $receptor['nombre']);

		try {
			$query = new ParseQuery("clientes");
			$query->equalTo("rfc", $receptor['rfc']);
			$results = $query->find();

			if (count($results) == 0){
		  		$cliente->save();
		  		return $cliente;
		  	}
		  	else{
		  		echo 'El cliente ya existe';
		  		return $results[0];
		  	}
		  	
		} catch (ParseException $ex) {  
			  // Execute any logic that should take place if the save fails.
			  // error is a ParseException object with an error code and message.
			  echo 'Failed to create new object, with error message: ' . $ex->getMessage();
		}
		
	}
	public function guardarFactura($factura,$cliente){

		$object = ParseObject::create("facturas");
		$objectId = $object->getObjectId();

		// Set values:
		$object->set("serie", $factura['serie']);
		$object->set("idFactura", $factura['uuid']);
		$object->set("folio", $factura['folio']);
		$object->set("cliente", $cliente);
		$object->set("total", $factura['total']);
		$object->set("fecha", $factura['fecha']);
		/*$object->set("today", new DateTime());
		$object->setArray("mylist", [1, 2, 3]);
		$object->setAssociativeArray(
		    "languageTypes", array("php" => "awesome", "ruby" => "wtf")
		);*/

		// Save:
		try {
			$object->save();
			return $object;
		}
		catch (ParseException $ex) {  
			  // Execute any logic that should take place if the save fails.
			  // error is a ParseException object with an error code and message.
			  echo 'Failed to create new object, with error message: ' . $ex->getMessage();
		}
	}
	public function guardarProductos($productos,$facturaObj){

		for ($i=0; $i < count($productos); $i++){

			//revisamos si existe el producto
			$query = new ParseQuery("productos");
			$query->equalTo("idProducto", $productos[$i]['noIdentificacion']);
			$results = $query->find();

			if (count($results) == 0){

				$producto = new ParseObject("productos");
				
				$producto->set("idProducto", $productos[$i]['noIdentificacion']);
				$producto->set("descripcion", $productos[$i]['descripcion']);
				$producto->set('unidad',$productos[$i]['unidad']);
				$producto->save();
			}
			else{
				$producto = $results[0];
			}
			  
				$facProd = new ParseObject("factura_productos");

				$facProd->set('idFactura',$facturaObj);
				$facProd->set('idProducto',$producto);

				$facProd->set('piezas',$productos[$i]['cantidad']);
				$facProd->set('precio',(float)$productos[$i]['valorUnitario']);

				try{
				  	$facProd->save();

				} catch (ParseException $ex) {  
				  // Execute any logic that should take place if the save fails.
				  // error is a ParseException object with an error code and message.
				  echo 'Failed to create new object, with error message: ' . $ex->getMessage();
				}
		}

	}
}
?>