//Rellena a la izquierda un string con un valor determinado

function pad(n, length){
   n = n.toString();
   while(n.length < length) n = "0" + n;
   return n;
}

function showLoading(){
	$('.ajaxLoad').show();
}

function hideLoading(){
	$('.ajaxLoad').hide();
}