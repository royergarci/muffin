var numPregunta = 0;
var preguntas;
var competencias;
var orden = 1;
var submitBtn = "false";

//Variables de paginas
var numPaginaActual = 0;
var paginas;
//Variables de preguntas
var preguntas = new Array();

var preguntasJson = Array();

$(document).ready(function() {
	
	paginas = new objPaginas();
	
	
	/*var paginaNueva = new pagina(numPaginaActual++,'Pagina'+numPaginaActual);
	paginas.agregaPagina(paginaNueva);
	
	var paginaNueva = new pagina(numPaginaActual++,'Pagina'+numPaginaActual);
	paginas.agregaPagina(paginaNueva);
	
	paginas.eliminarPagina(0);
	
	var preguntaNueva = new pregunta('1','UN TEXTO','ABIERTA',1,'competencia','1');
	
	paginas.insertarPregunta(preguntaNueva,1);
	paginas.eliminarPregunta(1,1);*/
	//pintarPaginasPreguntas();
	
	$("#guardarEncuesta").click(function(){
		var idEncuesta;
		dataForm = {};
		dataFormPreguntas = {};
		//Metemos los datos de la encuesta en el dataForm
		$('#datosEncuesta').find('input[type=hidden],input[type=text],select,button,.textarea').each(function(index, value) {
			if ($(this).attr('id') != null)
		    {
		    	console.log('find '+$(this).attr('id') +' value: '+$(this).val());
		    	dataForm[$(this).attr('id')] = $(this).val();
		    }
		});
		
		//Traemos los datos de las preguntas
		$('#preguntas').find('input[type=hidden],input[type=text],select,button,.textarea').each(function(index, value) {
			if ($(this).attr('id') != null)
		    {
		    	console.log('find preguntas '+$(this).attr('id') +' value: '+$(this).val());
		    	dataFormPreguntas[$(this).attr('id')] = $(this).val();
		    }
		});
		
		$.ajax({
		  url: urlBase+'index.php/encuestas/insertaEncuestaJson/',
		  type: 'POST ç',
		  data: dataForm,
		  async: false,
		  beforeSend: function() {
		    
		  },
		  success: function(data){
		  	console.log("correcto "+data);
	      }
	      })
	      .done(function( data ) {
			 idEncuesta = data;
	  	});
		
		$.post(urlBase+'index.php/encuestas/insertarEncuestaPreguntasJsonNombrePagina',{pages:JSON.stringify(paginas), idEnc: idEncuesta}, function(result){
		  alert(result+'Se ha creado la encuesta con éxito');
		});
		
		
	});
	
	
	$('#tipoEncuesta').change(function(){
		//Debemos borrar las preguntas dadas de alta si cambia el tipo de encuesta
	});
	
	$('#agregarPagina').click(function() {
		var paginaNueva = new pagina(paginas.getNextId(),$("#pagNombre").val());
		paginas.agregaPagina(paginaNueva);
		pintarPaginasHtml();
		numPaginaActual++;
	});
	
	$('#agregarPregunta').click(function() {
		var paginaNueva = new pagina(numPaginaActual++,'Pagina'+numPaginaActual);
		paginas.agregaPagina(paginaNueva);
	});
	
	$('#altaPreguntasBtn').click(function(){
		//Revisamos si hay paginas
		if (paginas.paginasObj.length > 0)
			llenaPreguntasAjax();
		else
			alert('No existen paginas. Agregue una pagina para ingresar preguntas.');
			return;
	});
	
	$('#eliminaPaginasBtn').click(function() {
		llenaPaginasAjax();
	});
	
	$('#eliminaPaginaBtn').click(function(){
		paginas.eliminarPagina($('#pageDel').val());
		pintarPaginasHtml(); 
	});
	
	//Desactivamos el submit de los botones
	$(".btnPregunta").click(function() { return false; });
	
	//Agregamos la primer pregunta
	//agregarPregunta();
	
	// Regresamos el formulario con todas las preguntas dadas de alta
	$('#form-ajax').on('submit', function() {
	 if (submitBtn == "false"){
	   		return false;
	   	}	
		
	  var obj = $(this), // (*) references the current object/form each time
	   //url = obj.attr('action'),
	   url = urlBase+'index.php/encuestas/insertaEncuesta/',
	   method = 'post',
	   dataForm = {};
	   
	   console.log(url);
	   console.log(method);
	   
	   obj.find('input[type=hidden],input[type=text],select,button,.textarea').each(function(index, value) {
	    
	    if ($(this).attr('id') != null)
	    {
	    	console.log('find '+$(this).attr('id') +' value: '+$(this).val());
	    	dataForm[$(this).attr('id')] = $(this).val();
	    }
	  });
	
		$.get(urlBase+'index.php/encuestas/insertaEncuesta/', dataForm, function(result){
		  console.log(result+'ok');
		  alert(result);
		  window.location =  "encuestas";
		});
	
	  
	  return false; //disable refresh
 	});
	
});

function obtenPreguntasJson(){
	$.ajax({
	  url: urlBase+'index.php/preguntas/obtenerPreguntasPorTipoJson/'+$('#tipoEncuesta').val(),
	  dataype: 'json',
	  async: false,
	  success: function(data){
	  	 preguntas = JSON.parse(data);
	  }
	 })
	 .done(function( data ) {
	    console.log("done");
	   
	 });
}

function obtenCompetenciasJson(){
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
}

function llenaPaginasAjax(){
	$("#modalBodyEliminaPreguntas").html('');
	var paginaHtml =  '<select class="span3" id="pageDel">'+
					"<option>Seleccione una pagina</option>";
							  	 	for (i=0; i<paginas.paginasObj.length; i++){
							         	paginaHtml = paginaHtml+"<option value='"+paginas.paginasObj[i].id+"'>"+paginas.paginasObj[i].pageName+"</option>";
							         }
							         paginaHtml = paginaHtml+"</select>";
	
	$("#modalBodyEliminaPreguntas").append(paginaHtml);
}


function agregarPregunta(){
	obtenCompetenciasJson();
	obtenPreguntasJson();
	
	
	var preguntaHtml = '<div class="controls controls-row">'+
		  	 	"<p>"+
		  	 	'<select class="span6" id="pregunta_'+numPregunta+'">'+
		  	 	"<option>Seleccione un valor </option>";
	
	
	for (i=0; i<preguntas.length; i++){
		preguntaHtml = preguntaHtml + "<option value='"+preguntas[i].pre_id+"'>"+preguntas[i].pre_descripcion+"</option>";
	}
	
	preguntaHtml = preguntaHtml + "</select> <br><br>";
	
	preguntaHtml = preguntaHtml + '<label class="span1" style="text-align:right;">Orden:</label>'+
		  	 	'<input class="span1" type="text" id="order_'+numPregunta+'" value="'+numPregunta+'">'+
		  	 	'<label class="span1" style="text-align:right;">Factor:</label>'+
		  	 	'<select class="span3" id="factor_'+numPregunta+'">'+
		  	 	"<option>Seleccione un valor </option>";
	
	for (i=0; i<competencias.length; i++){
	         	preguntaHtml = preguntaHtml+"<option value='"+competencias[i].com_id+"'>"+competencias[i].com_descripcion+"</option>";
	         }
	         preguntaHtml = preguntaHtml+"</select>"+
	         "<button class='btnPregunta btn-primary span2' id='pregunta_"+numPregunta+"' onclick='agregarPregunta()' value='NO'>agregar</button>"+
	         "</p>"+
	  	 	 '</div>'+
	  	 	 '<hr>'; 
	  	 	 
	 $("#preguntas").append(preguntaHtml);
	 
	
}

function btnClickNuevaPregunta(element){
	
	submitBtn = "false";
	if ($(element).val() == "Agregar"){
			console.log('agregar dinamico');
			//Cambiamos
			$(element).attr('value','Eliminar');
			$(element).attr('class','btn btn-info btnEvaluador');
			$(element).html("Eliminar");
	
			agregarPregunta();
			return false;
		}
		if ($(element).val() == "Eliminar"){
						
			borraPregunta(element);
			return false;
		}
		return false;
}


function objPaginas(){
	this.paginasObj = new Array();
	
	objPaginas.prototype.agregaPagina = function(paginaNueva){
		this.paginasObj.push(paginaNueva);
	};
	
	objPaginas.prototype.eliminarPagina = function(idPagina){
		var i=0;
		for (i=0; i < this.paginasObj.length; i++){
			if (idPagina == this.paginasObj[i].id){
				this.paginasObj.splice(i,1);
				console.log('Se elimino el index '+i);
				console.log('Num de paginas '+this.paginasObj.length);
			}
		}
	};
	
	objPaginas.prototype.insertarPregunta = function(preguntaNueva,idPagina){
		for (i=0; i < this.paginasObj.length; i++){
		if (idPagina == this.paginasObj[i].id){
			this.paginasObj[i].preguntas.push(preguntaNueva);
			console.log('ok inserte');
			return ;
		}
	}
	};
	
	objPaginas.prototype.eliminarPregunta = function(idPregunta,idPagina,idCompetencia){
		var flag = 0;
		for (i=0; i < this.paginasObj.length; i++){
			if (idPagina == this.paginasObj[i].id){
				for (j=0; j < this.paginasObj[i].preguntas.length; j++){
					if (idPregunta == this.paginasObj[i].preguntas[j].id && idCompetencia == this.paginasObj[i].preguntas[j].idCompetencia){
						this.paginasObj[i].preguntas.splice(j,1);
							console.log('elimine pregunta');
							flag =1;
						}
					}
				}	
		}
		if (flag == 0){
			alert('No existe la pregunta que desea eliminar idPregunta '+idPregunta+' idPagina '+ idPagina +' idCompetencia '+idCompetencia);
		}
	};
	objPaginas.prototype.count = function(){
		return this.paginasObj.length;
	};
	objPaginas.prototype.getNextId = function(){
		var i=0;
		var nextId=0;
		for (i=0; i < this.paginasObj.length; i++){
			if (nextId < this.paginasObj[i].id){
				nextId = this.paginasObj[i].id;
			}
		}
		var nn = parseInt(nextId);
		return (++nn);
	};
}

//Constructor de Pagina
function pagina(id,pageName)
{
	this.id=id;
	this.pageName=pageName;
	this.preguntas = new Array();
}


//Constructor de Pagina
function pregunta(id,texto,tipo,idCompetencia,competencia,orden)
{
	this.id=id;
	this.texto=texto;
	this.tipo=tipo;
	this.idCompetencia=idCompetencia;
	this.competencia=competencia;
	this.orden=orden;
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
	  	 preguntasJson = preguntas;
	  	 console.log("success preguntas ajax length "+preguntas.length);
	  	 
	  	 $('#modalBody').html('');
	  	 $.each( preguntas, function( i, item ) {
	  	 	//console.log(item.pre_descripcion);
	  	 	var preguntaHtml = '<div class="controls controls-row">'+
							  	 	"<p>"+
							  	 	'<h4>'+item.pre_id+' - '+item.pre_descripcion+'</h4>'+
							  	 	"<br>"+
							  	 	'<label class="span2" style="text-align:right;">Tipo: '+item.pre_tipo+'</label>'+
							  	 	'<label class="span1" style="text-align:right;">Orden:</label>'+
							  	 	'<input class="span1" type="text" id="order_'+item.pre_id+'">'+
							  	 	'<label class="span1" style="text-align:right;">Factor:</label>'+
							  	 	'<select class="span3" id="factor_'+item.pre_id+'">'+
							  	 	"<option>Seleccione una competencia </option>";
							  	 	for (i=0; i<competencias.length; i++){
							         	preguntaHtml = preguntaHtml+"<option value='"+competencias[i].com_id+"'>"+competencias[i].com_descripcion+"</option>";
							         }
							         preguntaHtml = preguntaHtml+"</select>"+
							         '<select class="span3" id="page_'+item.pre_id+'">'+
							         "<option>Seleccione una pagina</option>";
							  	 	for (i=0; i<paginas.paginasObj.length; i++){
							         	preguntaHtml = preguntaHtml+"<option value='"+paginas.paginasObj[i].id+"'>"+paginas.paginasObj[i].pageName+"</option>";
							         }
							         preguntaHtml = preguntaHtml+"</select>"+
							         "<button class='btnPregunta btn-primary span2' id='pregunta_"+item.pre_id+"_1' onclick='addQuestion(this)' value='NO'>agregar</button>"+
							         "</p>"+
						  	 	 '</div>'+
	  	 	 '<hr>';
	  	 	
	  	 	$("#modalBody").append(preguntaHtml);
      	 }); 
	  }
	 })
	  .done(function( data ) {
	    console.log("done");
	   
	  });
}

function addQuestion(element){
	
	if (paginas.paginasObj.length == 0){
		alert('No existen paginas para alta de preguntas');
		return;
	}
	
	
	var strElement = element.id.split('_');
	
	var id = strElement[1];
	var idPagina = $('#page_'+id).val();
	
	
	
	//Si tiene un factor en nulo se manda el mensaje
	if ($("#factor_"+id).val() == '' || $("#factor_"+id).val() == 'Seleccione un valor')
	{
		alert('Seleccione un valor en la competencia');
		return;
	}
	
	var flagExistePagina = 0;
	//Si la pregunta ya existe no se inserta
	for (i=0; i< paginas.paginasObj.length; i++){
		  if (paginas.paginasObj[i].id == idPagina){
					flagExistePagina = 1;
					console.log('encontre la pagina para insertar');
				}
			for (var j=0; j < paginas.paginasObj[i].preguntas.length;j++){
				if (paginas.paginasObj[i].preguntas[j].id == id && paginas.paginasObj[i].preguntas[j].idCompetencia == $("#factor_"+id).val()){
					alert('La pregunta ya esta dada de alta en la pagina '+paginas.paginasObj[i].pageName);
					return ;
				}
			}
	}
	
	if (flagExistePagina == 0){
		alert('No existe la pagina para insertar la pregunta '+idPagina);
		return;
	}
	
	$.each( preguntasJson, function( i, item ) {
		if (item.pre_id == id){			
			var preguntaNueva = new pregunta(item.pre_id,item.pre_descripcion,item.pre_tipo,$("#factor_"+id).val(),$("#factor_"+id+" option:selected").text(),$("#order_"+id).val());
			paginas.insertarPregunta(preguntaNueva,idPagina);
			console.log('Se ha insertado la pregunta '+item.pre_id+' '+item.pre_descripcion);
			
			pintarPaginasHtml();
		}
	});
	
}

function eliminaPregunta(element){
	var strElement = element.id.split('_');
	
	var idPregunta = strElement[1];
	var idPagina = strElement[2];
	var idCompetencia = strElement[3];
	
	alert('Se va a eliminar la pregunta '+idPregunta+ ' de la pagina '+ idPagina+ ' competencia '+idCompetencia );
	paginas.eliminarPregunta(idPregunta,idPagina,idCompetencia);
	
	pintarPaginasHtml();
}

function pintarPaginasHtml(){
	
	$('#preguntasDinamicas').html('');
	
	var htmlPaginas = '';
	for (p=0; p< paginas.paginasObj.length; p++){
		htmlPaginas += pintarPagina(paginas.paginasObj[p]);
	}

	$('#preguntasDinamicas').append(htmlPaginas);
	
}

function pintarPagina(pagina){
	  console.log('Estoy en pintar-Pagina '+pagina.id);
	  var htmlPagina = '<div class="accordion ui-sortable" id="accordion_'+pagina.id+'">'+
					   '<div class="accordion-group">'+
					   '<div class="accordion-heading">'+
					   '<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion_'+pagina.id+'" href="#pagina_'+pagina.id+'">'+pagina.pageName+'</a>'+
					   '<div id="pagina_'+pagina.id+'" class="accordion-body collapse in">'+
					   '<div class="accordion-inner">';
					   
					   for (i=0; i< pagina.preguntas.length; i++){
					   		htmlPagina += pintarPregunta(pagina.preguntas[i],pagina.id);
					   }
					        	
		htmlPagina += '</div> <!-- div de inner --> '+
					  ' </div> <!-- div de pagina -->'+
					  '</div> <!-- div de heading -->'+
				      '</div> <!-- div de group -->'+
              		  '</div>  <!-- div de acordeon -->';
        
        
        return (htmlPagina);
}

function pintarPregunta(pregunta,idPagina){
	var htmlPregunta = '<div class="pregunta">'+
					   '<div class="control control-row">'+
					   '<p>'+
					   '<h4>'+pregunta.orden+' - '+pregunta.texto+'</h4>'+
					   '<label class="span4" style="text-align:left;">Factor: '+pregunta.competencia+'</label>'+
					   '<label class="span2" style="text-align:left;">Tipo: '+pregunta.tipo+'</label>'+
					   '<button class="btnPregunta btn-primary span2" id="pregunta_'+pregunta.id+'_'+idPagina+'_'+pregunta.idCompetencia+'" onclick="eliminaPregunta(this)" value="NO">Eliminar</button>'+
					   '</p>'+
					   '</div>'+
					   '</div>'+
					   '<br>'+
					   '<br>';
	return (htmlPregunta);					        	 
}

var draggable_opts = {
            connectToSortable: ".accordion",
            helper: "clone",
            opacity: 0.75,
            revert: 'invalid',
            stop: function(event, ui) {
                //alert(ui)
            }
        };