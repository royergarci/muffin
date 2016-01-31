var submitBtn = "false";
$(document).ready(function() {
	$("#optionsRadios11").click(function(){

	});
	
	$("#optionsRadios12").click(function(){
	
	});
	$(".cortes").hide();
	
	$("#selectSubGrupo").change(function(){
		$('.cortes').hide();
		$('#'+this.value).show();
	});
	/*$('input[type=submit]').click(function(){
    	$(this).attr('disabled', 'disabled');
	});*/
});
