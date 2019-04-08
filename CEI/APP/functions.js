/**
 * 
 */
window.onload = function(){
	var botones_votar = document.getElementsByClassName("votar");
	var votos = document.getElementsByClassName("votos");
	var directorio_base = "http://localhost/CEI/APP/";
	//comprobamos si realmente exite
	if(botones_votar.length > 0){
		for(var i=0;i < botones_votar.length;i++){
			//CLAUSURAS!!!
			(function(indice){
				botones_votar[indice].onclick = function(evento){
					//para que deje de navegas
					evento.preventDefault();
					//console.log(indice);
					//la funcion que le pasamos como parametro es la que recoge los que le 
					//digamos en el archivo que hace de "puente" hub.php
					ajax_post("POST",directorio_base+"hub.php",1,"voto="+botones_votar[indice].dataset.voto,function(respuesta){
						console.log(respuesta);
						//convertimos respuesta en un objeto
				     	respuesta = JSON.parse(respuesta);
						//si lo que nos llega de la api es un OK
						if(respuesta.resultado == 'ok'){
							var estado = (botones_votar[indice].innerHTML == "votar")?0:1;
							botones_votar[indice].innerHTML = (estado<1)?"votada":"votar";
							votos[indice].innerHTML = (estado<1)?parseInt(votos[indice].innerHTML)+1:parseInt(votos[indice].innerHTML)-1;
						}
					})
				}
			})(i);
		}
	}
	// funcion AJAX
	function ajax_post(metodo,url,header,parametros,callback){
		var conexion = new XMLHttpRequest();
		conexion.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200){
				//console.log(this.responseText);
				callback(this.responseText);
			}
		}
		//abrimos la conexion
		conexion.open(metodo,url,true);
		if(header>0){
			conexion.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		}
		conexion.send(parametros);
	}
	////////////////////// para la precarga de la imagen del perfil ///////////////////
	var input = document.getElementsByClassName("img")[0];
	var formulario_preview = document.getElementById("preview-img");
	input.onchange = function(){
		//para poder trabajar con la imagen en aja
		var datos_enviar = new FormData(formulario_preview);
		ajax_post("POST",directorio_base+"hub.php",0,datos_enviar,function(respuesta){
			console.log(respuesta);
			document.getElementsByClassName('preview')[0].src = respuesta;
		});
		
	}
}