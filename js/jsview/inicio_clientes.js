$(document).ready(function() {
	$('#encuestasSelect').change(function (){
		console.log(urlBase+'index.php/clientes/indexClientes/'+$(this).val());
		window.location = urlBase+'index.php/clientes/indexClientes/'+$(this).val();
	});
	
	//Si se selecciona el checkbox lo ponemos como seleccionado
	
	$('input[type=checkbox]').click(function(){
		if ($(this).attr('value') == 'SI')
			$(this).attr('value','NO')
		else
			$(this).attr('value','SI')	
	});
	
	$('#irEvaluacion').click(function(){
		var obj = $('#evaluaciones');
		var evaluados = Array();
		var cadEvaluados = '';
		//dataForm = {};
		
	//	dataForm['idEncuesta'] = $("#encuestasSelect").val();
		//Sacamos los evaluados y verificamos que haya por lo menos uno seleccionado
		obj.find('input[type=checkbox]').each(function(index, value) {
			if ($(this).attr('value') == 'SI'){
				if (evaluados.length == 0){
					cadEvaluados = $(this).attr('name');
				}
				else{
					cadEvaluados = cadEvaluados + '_'+$(this).attr('name');
				}
				evaluados.push($(this).attr('name'));
				//dataForm['evaluado_'+$(this).attr('name')] = $(this).attr('name');
			}
	 	});
		
		if (evaluados.length == 0)
		{
			alert('Por favor seleccione una opción para evaluar');
			$('input[type="checkbox"]').focus();
		}
		else{
			window.location = urlBase+'index.php/clientes/contestarEncuestaClientePagina/'+$("#encuestasSelect").val()+'/'+cadEvaluados+'/0/1';
		/*$.get(urlBase+'index.php/clientes/contestarEncuestaCliente/', dataForm, function(result){
		  console.log(result+'ok');
		  alert(result);
		  window.location =  "encuestas";
		});*/
		}
	});
});
