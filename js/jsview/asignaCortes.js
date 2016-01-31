
$(document).ready(function() {
	
//	obtenJerarquiasJson();
	$("#regresar").click(function(){
		window.location = urlBase+'index.php/encuestas/preliminarEncuesta/'+idEncuesta;
	});
});
/*
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
}*/
