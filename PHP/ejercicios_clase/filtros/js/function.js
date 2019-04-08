window.onload = function (){

	var items=document.getElementsByClassName("item");
	var filtros=document.getElementsByClassName("filtro");

	for(var i=0; i<filtros.length;i++){
		filtros[i].onclick = function(evento){
			//con el preventdefault evitamos el funcionamiento normal del onclick
			evento.preventDefault();
			//console.log(this.dataset.tipo);
			for(var j=0;j<items.length;j++){
				//console.log(items[j].className);
				var clasesTemporales = items[j].className.split(" ");
				//console.log(clasesTemporales);
				if(this.dataset.tipo == clasesTemporales[1]){
					clasesTemporales[2] = "visible";
				}
				else{
					clasesTemporales[2] = "";
				}
				items[j].className = clasesTemporales.join(" ");
			}
		}
	}

}