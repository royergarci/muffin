var submitBtn = "false";
$(document).ready(function() {
	var numEvaluadores = 1;
	var jerarquias;	
	var evaluadores;
	var nuevo;
	
	obtenJerarquiasJson();
	
	$(".editarEvaluado").click(function(event){
		//alert($(this).attr('id'));
		var idButton = $(this).attr('id');
		var strVars = idButton.split("_");
		
		//El segundo valor es el id de encuesta
		//El tercero es el id del evaluado
		var url = urlBase+'index.php/encuestas/evaluadores/UPDATE/'+strVars[1]+'/'+strVars[2];
		self.location = url;

		
	});
	
	$("#btnGuardarNuevo").click(function(){
		submitBtn = "true";
		nuevo = true;
		console.log("ok puedes guardar");
	});
	
	$("#btnGuardar").click(function(){
		submitBtn = "true";
		nuevo = false;
		console.log("ok puedes guardar");
	});
	
	$("#btnActualizar").click(function(){
		submitBtn = "true";
		console.log("ok puedes actualizar");
	});
	
	$(".btnEvaluador").click(function(){
		if ($(this).val() == "Agregar"){
			console.log('agregar inicio');
			//Cambiamos
			$(this).attr('value','Eliminar');
			$(this).attr('class','btn btn-info btnEvaluador');
			$(this).attr('onclick','borraEvaluador(this)');
			$(this).html("Eliminar");
			
			agregarEvaluador();
			return false;
		}
		if ($(this).val() == "Eliminar"){
			console.log('eliminar inicio');
			
			//Obtenemos el id
			borraEvaluador($(this));
			return false;
		}
	});
	
	//Para que no haga submit el formulario
	$('#form-ajax').on('submit', function() {	
	   if (submitBtn == "false"){
	   		return false;
	   	}
	   console.log('ajax_form');
	   var obj = $(this), // (*) references the current object/form each time
	   //url = obj.attr('action'),
	   url = urlBase+'index.php/encuestas/insertaEvaluadores/',
	   method = 'post',
	   dataForm = {};
	   
	  // console.log(url);
	  // console.log(method);
	   
	   obj.find('input[type=hidden],input[type=text],select,button').each(function(index, value) {
	    
	    if ($(this).attr('id') != null)
	    {
	    	//console.log('find '+$(this).attr('id'));
	    	dataForm[$(this).attr('id')] = $(this).val();
	    }
	  });
		
		if (accion == "INSERT")
		{
			$.get(urlBase+'index.php/encuestaEvaluadores/insertaEvaluadores/', dataForm, function(result){
				console.log(result+'ok');
		    	alert('Se han guardado los registros con exito');
		    	if (nuevo){
		    		window.location = urlBase+'index.php/encuestas/evaluadores/INSERT/'+$("#idEncuesta").val();
		    	}
		    	else
		    	{
		    		window.location = urlBase+'index.php/encuestas';
		    	}
			});
		}
		else
		{

			$.ajax({
			  url: urlBase+'index.php/encuestaEvaluadores/borrarEncuestaEvaluados/'+$("#idEncuesta").val()+'/'+$("#evaluadoSelect").val(),
			  async: false,
			  beforeSend: function() {
			    
			  },
			  success: function(data){
			  	evaluadores = JSON.parse(data);
			  	console.log("success borrar");
		      }
		      })
		      .done(function( data ) {
				 console.log("done borrar");
			  });
			
			$.get(urlBase+'index.php/encuestaEvaluadores/insertaEvaluadores/', dataForm, function(result){
				console.log(result+'inserta');
		    	alert('Se han actualizado los registros con exito');
			});
		}
		return false;
	});
	
});

function btnClickEvaluadores(element){
	
	submitBtn = "false";
	console.log("btnClickEvaluadores");
	if ($(element).val() == "Agregar"){
			console.log('agregar dinamico');
			//Cambiamos
			$(element).attr('value','Eliminar');
			$(element).attr('class','btn btn-info btnEvaluador');
			$(element).html("Eliminar");
		/*	$(element).click(function(){
				btnClickEvaluadores($(this));
			});*/
			
			agregarEvaluador();
			return false;
		}
		if ($(element).val() == "Eliminar"){
			console.log('eliminar dinamico');
			//$(element).attr('value','Agregar');
			//$(element).attr('class','btn btn-primary btnEvaluador');
			//$(element).html("Agregar");
			//$(element).attr('onclick','javascript:agregarEvaluador();');
			
			borraEvaluador(element);
			return false;
		}
		return false;
}

function agregarEvaluador(){
	numEvaluadores++;
	var numFinal = pad(numEvaluadores,2);
	
	obtenEvaluadoresJson();
	var newEvaluador = '<div class="controls controls-row" id="evaluador_'+numFinal+'">'+
					   '<p>'+
					   '<label class="span1" style="text-align:right;">Evaluador:</label>'+
					   '<select id="evaluador_'+numFinal+'" name="evaluador_'+numFinal+'" class="span5">';
					   $.each( evaluadores, function( i, item ) {
						  	newEvaluador = newEvaluador + '<option value="'+item.cli_id+'">'+item.cli_nombre+' '+item.cli_apellido_paterno+' '+item.cli_apellido_materno+' - '+ item.ptr_descripcion+'</option>';
						  });
						newEvaluador = newEvaluador + '</select>'+
						'<label class="span1" style="text-align:right;">Jerarquia c/evaluado:</label>'+
						'<select id="jerarquiaSelect_'+numFinal+'" name="jerarquiaSelect_'+numFinal+'" class="span2">';
						  $.each( jerarquias, function( i, item ) {
						  	newEvaluador = newEvaluador + '<option value="'+item.jer_id+'">'+item.jer_descripcion+'</option>';
						  });
						newEvaluador = newEvaluador + '</select> '+
						'<button id="btn_'+numFinal+'" class="btn btn-primary" value="Agregar" onclick="btnClickEvaluadores(this);">Agregar</button>'+
					   '</p>'+
					   '</div>';
	
	$('#evaluadores').append(newEvaluador);
	return false;
}

function borraEvaluador(element){
	var id = $(element).attr("id").substring(4,6);
	console.log('id eliminar - '+id+ '-');
	$('#evaluador_'+id).remove();
}

function pad(n, length){
   n = n.toString();
   while(n.length < length) n = "0" + n;
   return n;
}

function obtenEvaluadoresJson(idEnc){
	$.ajax({
	  url: urlBase+'index.php/encuestaEvaluadores/obtenClientesEvaluarJson/'+$("#idEncuesta").val()+'/'+$("#idEmpresa").val(),
	  dataype: 'json',
	  async: false,
	  beforeSend: function() {
	    
	  },
	  success: function(data){
	  	evaluadores = JSON.parse(data);
	  	console.log("success evaluadores");
      }
      })
      .done(function( data ) {
		 console.log("done evaluadores");
	  });
}

function obtenJerarquiasJson(){
	$.ajax({
	  url: urlBase+'index.php/jerarquias/obtenJerarquiasJson',
	  dataype: 'json',
	  async: false,
	  beforeSend: function() {
	    
	  },
	  success: function(data){
	  	jerarquias = JSON.parse(data);
	  	console.log("success jerarquias");
      }
      })
      .done(function( data ) {
		 console.log("done jerarquias");
	  });
}
