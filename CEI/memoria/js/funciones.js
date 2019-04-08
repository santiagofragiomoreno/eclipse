/**
 * 
 */
window.onload = function(){
	var cartas = document.getElementsByClassName("carta");
	var tablero = document.getElementsByClassName("tablero")[0];
	var momento = 0;
	var cartas_volteadas = [0,0];
	//clusura
	for(var i=0;i<cartas.length;i++){
		//clausura para las cartes
		(function(indice){
			cartas[indice].onclick = function(){
				//console.log(indice);
				this.className = "carta";
				if(momento<1){
					cartas_volteadas[0] = indice;
					momento = 1;
				}
				else{
					//desactivamos todos los clicks del tablero
					tablero.style.pointerEvents = "none";
					setTimeout(function(){
						cartas_volteadas[1] = indice;
						//empezamos la conexion
						var conexion = new XMLHttpRequest();
						conexion.onreadystatechange = function(){
							if(this.readyState == 4 && this.status == 200){
								//console.log(this.responseText);
								for(var j=0;j<cartas_volteadas.length;j++){
									cartas[cartas_volteadas[j]].className = (this.responseText<1)?"carta volteada":"carta desaparecer";
									tablero.style.pointerEvents = "auto";
									momento = 0;
								}
								
							}
						}
						conexion.open("GET","comprobar.php?a="+cartas_volteadas[0]+"&b="+cartas_volteadas[1]);
						conexion.send();
					},500);
					
				}
			}
		})(i);
	}
	
////////////////ejemplo basico de una clausura
	//convertimos la funcion en una funcion autoejecutable
	/*
	(function suma(a,b){
		console.log(a+b);
	})(6,6);*/
	
	
}