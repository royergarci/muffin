
$(document).ready(function() {
			    $('#example').dataTable( {
			    	"sDom": "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
			        "bProcessing": true,
			        "sAjaxSource": urlBase+'index.php/cortes/datatable',
			        "sPaginationType": "full_numbers"
				});
				
		$('#btnInsertar').click(function (){
			window.location = urlBase+'index.php/cortes/action/INSERT'
		});
});
$.extend( $.fn.dataTableExt.oStdClasses, {
	"sWrapper": "dataTables_wrapper form-inline"
});


