console.log('Ok estamos listos');

document.addEventListener("DOMContentLoaded", function(event) { 
	console.log('Ok estamos mas listos');
	var btn = document.getElementById('uploadFileTxt');

	btn.addEventListener('click',function(event){
		console.log('Click en boton');

	});
});

