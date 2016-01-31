<? $this->load->view('includes/header2'); ?>
	<script>
		var urlBase = '<?php echo base_url();?>';
	</script>
	<script type="text/javascript" language="javascript" src="<?php echo base_url();?>js/jsview/upload.js"></script>

	</head>
	<body class="container">
		<? $this->load->view('includes/menu'); ?>	
		<div class="ajaxLoad" id="load">Cargando</div>
		<br>
		<br>
			<h3>Carga de factura</h3>
		
			
			
		<?php echo $error;?>

		<?php echo form_open_multipart('factura/do_upload');?>
		
		<input type="file" name="userfile" size="20" class="btn" />
		<br /><br />
		<input type="submit" value="upload" id="uploadFileTxt" class="btn btn-primary"/>
		</form>
			
		</div> <!-- /container -->
	<? $this->load->view('includes/footer'); ?>