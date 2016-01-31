<? $this->load->view('includes/header2'); ?>
		<!-- ponemos la url base para pasar como parametro al script -->
<script>
	var urlBase = '<?php echo base_url();?>';
	var numEvaluadores = 1;
	var accion = '<?php echo $action; ?>';
</script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>js/jsview/evaluadores.js"></script>


</head>
	<body class="container">

	<? $this->load->view('includes/menu'); ?>	
		<br>
		<br>
			<h3>Evaluadores</h3>
			
	<?php $attributes = array('class' => 'full', 'id' => 'form-ajax','method' => 'post'); ?>
	<?php 
		echo form_open('encuestas/insertaEvaluadores',$attributes);
	?>
			<?php
                 			$class = array(
							  'id' => 'idEncuesta',
							  'name' => 'idEncuesta',
				              'class' => 'input-xxlarge',
				              'value' => $encuesta[0]->enc_id,
				              'type' => 'hidden'
				            );  
                 			echo form_input($class); 
                 		?>
            <?php
                 			$class = array(
							  'id' => 'idEmpresa',
							  'name' => 'idEmpresa',
				              'class' => 'input-xxlarge',
				              'value' => $empresa[0]->emp_id,
				              'type' => 'hidden'
				            );  
                 			echo form_input($class); 
                 		?>
			<br>
			<p><b>Empresa:</b> <?php echo $empresa[0]->emp_descripcion;?></p>
			<p><b>Cuestionario:</b> <?php echo $encuesta[0]->enc_descripcion;?></p>
			<p><b>Num. Evaluados:</b> <?php echo $numEvaluados; ?></p>
			<br>
			<div id="evaluador">
				<div class="controls controls-row">
					<p><label class="span1" style="text-align:right;"><b>Evaluado:</b></label> 
						<?php if ($action == "INSERT"){ ?>
							<select id="evaluadoSelect" name="evaluadoSelect" class="span5">
						<?php } ?>
						<?php if ($action == "UPDATE"){ ?>
							<select id="evaluadoSelect" name="evaluadoSelect" class="span5" disabled="disebled">
						<?php } ?>
						  <?php
						  if ($action == "INSERT"){
							 foreach ($evaluados as $evaluado){
								 echo '<option value="'.$evaluado['cli_id'].'">'.$evaluado['cli_nombre'].' '.$evaluado['cli_apellido_paterno'].' '.$evaluado['cli_apellido_materno'].' - '.$evaluado['ptr_descripcion'].'</option>';
							 } 
						  }
						  else if ($action == "UPDATE"){
						  	foreach($evaluados as $evaluado){
						  		//Revisamos cual es el evaluado y lo seleccionamos
						  		if ($evaluado['cli_id'] == $evaluadoEncuesta)
						  			echo '<option value="'.$evaluado['cli_id'].'" selected="selected">'.$evaluado['cli_nombre'].' '.$evaluado['cli_apellido_paterno'].' '.$evaluado['cli_apellido_materno'].' - '.$evaluado['ptr_descripcion'].'</option>';
								else 
									echo '<option value="'.$evaluado['cli_id'].'">'.$evaluado['cli_nombre'].' '.$evaluado['cli_apellido_paterno'].' '.$evaluado['cli_apellido_materno'].' - '.$evaluado['ptr_descripcion'].'</option>';	
							}
						  }
						  ?>
						</select>
					</p>
				</div>
			</div>
			<br>
			<?php if ($action == "INSERT"){?>
			<div id="evaluadores">
				<div class="controls controls-row" id="evaluador_01">
					<p>
						<label class="span1" style="text-align:right;">Evaluador:</label>  
						<select id="evaluador_01" name="evaluador_01" class="span5">
						    <?php
							 foreach ($evaluados as $evaluado){
					   		       echo '<option value="'.$evaluado['cli_id'].'">'.$evaluado['cli_nombre'].' '.$evaluado['cli_apellido_paterno'].' '.$evaluado['cli_apellido_materno'].' - '.$evaluado['ptr_descripcion'].'</option>';
							 } 
							?>
						</select>
						<label class="span1" style="text-align:right;">Jerarquia c/evaluado:</label> 
						<select id="jerarquiaSelect_01" name="jerarquiaSelect_01" class="span2">
						 <?php
							 foreach ($jerarquias as $item){
					   		       echo '<option value="'.$item['jer_id'].'">'.$item['jer_descripcion'].'</option>';
							 } 
							?>
						</select> 
						<button id="btn_01" class="btn btn-primary btnEvaluador" value="Agregar">Agregar</button>
					</p>
				</div>
			</div>
			<br>
			<br>
			<?php } ?>  
			<!-- TERMINA INSERT -->
			<!-- COMIENZA UPDATE -->
			<div id="evaluadores">
				<?php if ($action == "UPDATE"){ ?>
				<?php
				$numTotal = count($evaluadores);
				foreach ($evaluadores as $evaluador){
					 if(strlen($num)== 1)
					 	$num = '0'.$num;
					 
				?>
				<div class="controls controls-row" id="evaluador_<?php echo $num; ?>">
					<p>
						<label class="span1" style="text-align:right;">Evaluador:</label>  
						<select id="evaluador_<?php echo $num; ?>" name="evaluador_<?php echo $num; ?>" class="span5">
						    <?php
						    echo '<option value="" selected="selected">SELECCIONE UNA OPCION</option>';
							 foreach ($evaluados as $evaluado){
								if ($evaluado['cli_id'] == $evaluador['cli_id']) 	
					   		       echo '<option value="'.$evaluado['cli_id'].'" selected="selected">'.$evaluado['cli_nombre'].' '.$evaluado['cli_apellido_paterno'].' '.$evaluado['cli_apellido_materno'].' - '.$evaluado['ptr_descripcion'].'</option>';
								else 
								  echo '<option value="'.$evaluado['cli_id'].'">'.$evaluado['cli_nombre'].' '.$evaluado['cli_apellido_paterno'].' '.$evaluado['cli_apellido_materno'].' - '.$evaluado['ptr_descripcion'].'</option>';	
							 } 
							?>
						</select>
						<label class="span1" style="text-align:right;">Jerarquia c/evaluado:</label> 
						<select id="jerarquiaSelect_<?php echo $num; ?>" name="jerarquiaSelect_<?php echo $num; ?>" class="span2">
						 <?php
							 foreach ($jerarquias as $item){
							 	if ($item['jer_id'] == $evaluador['jer_id'])
					   		       echo '<option value="'.$item['jer_id'].'" selected="selected">'.$item['jer_descripcion'].'</option>';
								else
								   echo '<option value="'.$item['jer_id'].'">'.$item['jer_descripcion'].'</option>';
							 } 
							?>
						</select> 
						<?php if ($num < $numTotal){?>
							<button id="btn_<?php echo $num; ?>" class="btn btn-info btnEvaluador" value="Eliminar">Eliminar</button>
						<?php }else{ ?>
							<button id="btn_<?php echo $num; ?>" class="btn btn-primary btnEvaluador" value="Agregar">Agregar</button>
						<?php } ?>
					</p>
				</div>
				<?php 
					$num++;
				} 
				?>
			</div>
			<br>
			<br>
			<?php } ?>
			<!-- TERMINA UPDATE -->
			<p align="center">
			  <?php if ($action == "INSERT"){ ?>
				  <button type="submit" class="btn btn-primary" id="btnGuardarNuevo">Guardar y agregar nuevo</button>
				  <button type="submit" class="btn btn-primary" id="btnGuardar">Guardar</button>
			  <?php } ?>
			  <?php if ($action == "UPDATE"){ ?>
			  	  <button type="submit" class="btn btn-primary" id="btnActualizarNuevo">Actualizar y agregar nuevo</button>
				  <button type="submit" class="btn btn-primary" id="btnActualizar">Actualizar</button>
			  <?php } ?>
			  <button type="button" class="btn" id="regresar">Regresar</button>
			</p>
	</form>
	<script>
		$("#regresar").click(function(){
			window.location = '<?php echo base_url();?>index.php/encuestas/preliminarEncuesta/<?php echo $encuesta[0]->enc_id;?>';
		});
	</script>
	<? $this->load->view('includes/footer'); ?>
