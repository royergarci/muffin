
$(document).ready(function() {
			    $('#example').dataTable( {
			    	"sDom": "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
			        "bProcessing": true,
			        "sAjaxSource": urlBase+'index.php/empresas/datatable',
			        "sPaginationType": "full_numbers"
				});
				
		$('#btnInsertar').click(function (){
			window.location = urlBase+'index.php/empresas/action/INSERT'
		});
});
$.extend( $.fn.dataTableExt.oStdClasses, {
	"sWrapper": "dataTables_wrapper form-inline"
});


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