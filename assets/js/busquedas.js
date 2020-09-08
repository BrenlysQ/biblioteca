$(document).ready(function(){
	$(".buscar_libros").autocomplete({
		source: "buscar_libro.php",
		minLength: 0,
		select: function( event, ui ) {	
		}
	});

	$(".buscar_usuarios").autocomplete({
		source: "buscar_usuario.php",
		minLength: 0,
		select: function( event, ui ) {	
		}
	});		 
});
