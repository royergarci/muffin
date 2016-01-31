
$(document).ready(function() {
			    $('#example').dataTable({
			    	"sDom": "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
			        "bProcessing": true,
			        "sAjaxSource": urlBase+'index.php/usuarios/datatable',
			        "sPaginationType": "full_numbers"
				});
				
		$('#btnInsertar').click(function (){
			window.location = urlBase+'index.php/usuarios/action/INSERT'
		});
		
		$("input[name='nick']").change(function (){
			revisaExisteNick($(this).val());
		});
		
});
$.extend( $.fn.dataTableExt.oStdClasses, {
	"sWrapper": "dataTables_wrapper form-inline"
});

//Funcion para pantalla de insercion y actualizacion 
//Revisa via ajax si ya existe el nick
function revisaExisteNick(valor){
	$.ajax({
	  url: urlBase+'index.php/usuarios/verificaNick/'+valor,
	  async: false,
	  beforeSend: function() {
	    
	  },
	  success: function(data){
	  	if (data == "true"){
	  		alert('El nick ya fue ocupado. Por favor escoja otro nombre de usuario');
	  		
	  		$("input[name='nick']").focus();
	  		$("input[name='nick']").val('');
	  	}
      }
      })
      .done(function( data ) {
	  });
}

function borrar(){
	var resp = confirm("¿Esta seguro que desea borrar el registro?");
	if (resp == false){
		return false;
	}
	else
	{
		return true;
	}
}

