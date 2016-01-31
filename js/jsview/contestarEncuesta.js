$(document).ready(function() {
	$('#tipoEncuesta').change(function(){
		alert($('#tipoEncuesta').val());
		llenaPreguntasAjax();
	});
	
	llenaPreguntasAjax();
	//Desactivamos el submit de los botones
	$(".btnPregunta").click(function() { return false; });
	
	$('#form-ajax').on('submit', function() {
	  var obj = $(this), // (*) references the current object/form each time
	   //url = obj.attr('action'),
	   url = urlBase+'index.php/encuestas/insertaEncuesta/',
	   method = 'post',
	   dataForm = {};
	   
	   console.log(url);
	   console.log(method);
	   
	   obj.find('input[type=hidden],input[type=text],select,button').each(function(index, value) {
	    
	    if ($(this).attr('id') != null)
	    {
	    	console.log('find '+$(this).attr('id'));
	    	dataForm[$(this).attr('id')] = $(this).val();
	    }
	  });
	
		$.get('http://localhost:8888/encuestas2/index.php/encuestas/insertaEncuesta/', dataForm, function(result){
		  console.log(result+'ok');
		  //alert(result);
		});
	
	  
	  return false; //disable refresh
 	});
	
});

//llena via ajax las preguntas por tipo
function llenaPreguntasAjaxJson(){
	$.getJSON( urlBase+'index.php/preguntas/obtenerPreguntasPorTipoJson/'+$('#tipoEncuesta').val(), function( data ) {
	   console.log("success llenaPreguntasAjaxJson");
	   $('#preguntas').html('');
	   $.each( data, function( i, item ) {
	         $("#preguntas").append('<div>')
	         $("#preguntas").append("<p><input type='text' value='"+item.pre_id+"' id='pregunta_id' >"+item.pre_descripcion+" <br>Tipo: "+item.pre_tipo+" Orden:<input type='text' id='idOrder'><button class='btnPregunta' id='"+item.pre_id+"' onclick='addQuestion(this)' value='agregar'></button></p>");
	         $("#preguntas").append('</div>')
      	 });
	})
	  .done(function(data) {
	   console.log("done");
	  })
	  .fail(function() {
	    console.log( "error" );
	  });	
}

function llenaPreguntasAjax(){
	var competencias;
	//Antes de obtener las preguntas debemos obtener los factores
	$.ajax({
	  url: urlBase+'index.php/competencias/obtenCompetenciasJson',
	  dataype: 'json',
	  async: false,
	  beforeSend: function() {
	    
	  },
	  success: function(data){
	  	competencias = JSON.parse(data);
	  	console.log("success competencias");
      }
      })
      .done(function( data ) {
		 console.log("done competencias");
	  });
	  
	 //Obtenemos las preguntas 
	$.ajax({
	  url: urlBase+'index.php/preguntas/obtenerPreguntasPorTipoJson/'+$('#tipoEncuesta').val(),
	  dataype: 'json',
	  async: false,
	  beforeSend: function(  ) {
	    
	  },
	  success: function(data){
	  	 var preguntas = JSON.parse(data);
	  	 console.log("success preguntas ajax length "+preguntas.length);
	  	 
	  	 $('#preguntas').html('');
	  	 $.each( preguntas, function( i, item ) {
	  	 	console.log(item.pre_descripcion);
	  	 	var preguntaHtml = '<div>'+
		  	 	"<p>"+
		  	 	item.pre_descripcion+
		  	 	"<br>Tipo: "+item.pre_tipo+
		  	 	"  Orden:<input type='text' id='order_"+item.pre_id+"'>"+
		  	 	" Factor: <select id='factor_"+item.pre_id+"'>"+
		  	 	"<option>Seleccione un valor </option>";
	  	 	for (i=0; i<competencias.length; i++){
	         	preguntaHtml = preguntaHtml+"<option value='"+competencias[i].com_id+"'>"+competencias[i].com_descripcion+"</option>";
	         }
	         preguntaHtml = preguntaHtml+"</select>"+
	         "<button class='btnPregunta' id='pregunta_"+item.pre_id+"' onclick='addQuestion(this)' value='NO'>agregar</button>"+
	         "</p>"+
	  	 	 '</div>'+
	  	 	 '<hr>';
	  	 	
	  	 	$("#preguntas").append(preguntaHtml);
      	 }); 
	  }
	 })
	  .done(function( data ) {
	    console.log("done");
	   
	  });
}

function addQuestion(element){
	if ($(element).val()=="NO"){
		$(element).html('Agregado');
		$(element).attr('value','SI');
	}
	else
	{
		$(element).html('Agregar');
		$(element).attr('value','NO');
	}
	return false;
}

