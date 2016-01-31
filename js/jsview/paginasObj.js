/**
 * @author J ROGELIO GARCIA LARA
 */

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
		console.log('aqui en next');
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