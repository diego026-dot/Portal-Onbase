// JavaScript Document
 function cambiar (element,posicion,pregunta,consecutivo) { 
 	document.getElementById('valor'+pregunta).value=posicion; 
	document.getElementById('cc'+consecutivo).value=posicion; 
	if(posicion==5)
	{	
  		document.getElementById(element+'x').src = "../images/estrella_seleccionada.png";
		document.getElementById(element+'xx').src = "../images/estrella_seleccionada.png";
		document.getElementById(element+'xxx').src = "../images/estrella_seleccionada.png";
		document.getElementById(element+'xxxx').src = "../images/estrella_seleccionada.png";
		document.getElementById(element+'xxxxx').src = "../images/estrella_seleccionada.png";
		document.getElementById('ee'+pregunta).innerHTML = "<label>Excelente Trabajo</label>";
	}
 	if(posicion==4)
	{	
  		document.getElementById(element+'x').src = "../images/estrella_seleccionada.png";
		document.getElementById(element+'xx').src = "../images/estrella_seleccionada.png";
		document.getElementById(element+'xxx').src = "../images/estrella_seleccionada.png";
		document.getElementById(element+'xxxx').src = "../images/estrella_seleccionada.png";
		document.getElementById(element+'xxxxx').src = "../images/estrella_vacia.png";
		document.getElementById('ee'+pregunta).innerHTML = "<label>Muy Bueno</label><br><font size=2>Solo pulir detalles</font>";
	}
	if(posicion==3)
	{	
  		document.getElementById(element+'x').src = "../images/estrella_seleccionada.png";
		document.getElementById(element+'xx').src = "../images/estrella_seleccionada.png";
		document.getElementById(element+'xxx').src = "../images/estrella_seleccionada.png";
		document.getElementById(element+'xxxx').src = "../images/estrella_vacia.png";
		document.getElementById(element+'xxxxx').src = "../images/estrella_vacia.png";
		document.getElementById('ee'+pregunta).innerHTML = "<label>Bueno</label><br><font size=2>Enfocarse en puntos espec&iacute;ficos</font>";
	}
	if(posicion==2)
	{	
  		document.getElementById(element+'x').src = "../images/estrella_seleccionada.png";
		document.getElementById(element+'xx').src = "../images/estrella_seleccionada.png";
		document.getElementById(element+'xxx').src = "../images/estrella_vacia.png";
		document.getElementById(element+'xxxx').src = "../images/estrella_vacia.png";
		document.getElementById(element+'xxxxx').src = "../images/estrella_vacia.png";
		document.getElementById('ee'+pregunta).innerHTML = "<label>Regular</label><br><font size=2>Necesita mejorar</font>";
	}
	if(posicion==1)
	{	
  		document.getElementById(element+'x').src = "../images/estrella_seleccionada.png";
		document.getElementById(element+'xx').src = "../images/estrella_vacia.png";
		document.getElementById(element+'xxx').src = "../images/estrella_vacia.png";
		document.getElementById(element+'xxxx').src = "../images/estrella_vacia.png";
		document.getElementById(element+'xxxxx').src = "../images/estrella_vacia.png";
		document.getElementById('ee'+pregunta).innerHTML = "<label>Malo</label><br><font size=2>Su oportunidad de mejora es alta</font>";
	}
	
	calificacion()
 }
 
 function calificacion()
 {
	 var pp = document.getElementById('preguntas').value;
	 var pt= (pp * 5);
	 var calif=0;
	 var res=0;
	 var i=1;
	 for(i=1; i<=pp; i++)
	 {
		var v= parseInt(document.getElementById('cc'+i).value);
		res=res+v;
	 }
	 //alert(pt);
	 var rf=0;
	 rf= res / pt;
	 document.getElementById('cc').value=Math.round(rf * 100);
 }
 
  function cambiar_consulta (element,posicion,pregunta,consecutivo) { 
 	document.getElementById('valor'+pregunta).value=posicion; 
	document.getElementById('cc'+consecutivo).value=posicion; 
	if(posicion==5)
	{	
  		document.getElementById(element+'x').src = "../images/estrella_seleccionada.png";
		document.getElementById(element+'xx').src = "../images/estrella_seleccionada.png";
		document.getElementById(element+'xxx').src = "../images/estrella_seleccionada.png";
		document.getElementById(element+'xxxx').src = "../images/estrella_seleccionada.png";
		document.getElementById(element+'xxxxx').src = "../images/estrella_seleccionada.png";
		document.getElementById('ee'+pregunta).innerHTML = "<label>Excelente Trabajo</label>";
	}
 	if(posicion==4)
	{	
  		document.getElementById(element+'x').src = "../images/estrella_seleccionada.png";
		document.getElementById(element+'xx').src = "../images/estrella_seleccionada.png";
		document.getElementById(element+'xxx').src = "../images/estrella_seleccionada.png";
		document.getElementById(element+'xxxx').src = "../images/estrella_seleccionada.png";
		document.getElementById(element+'xxxxx').src = "../images/estrella_vacia.png";
		document.getElementById('ee'+pregunta).innerHTML = "<label>Muy Bueno</label><br><font size=2>Solo pulir detalles</font>";
	}
	if(posicion==3)
	{	
  		document.getElementById(element+'x').src = "../images/estrella_seleccionada.png";
		document.getElementById(element+'xx').src = "../images/estrella_seleccionada.png";
		document.getElementById(element+'xxx').src = "../images/estrella_seleccionada.png";
		document.getElementById(element+'xxxx').src = "../images/estrella_vacia.png";
		document.getElementById(element+'xxxxx').src = "../images/estrella_vacia.png";
		document.getElementById('ee'+pregunta).innerHTML = "<label>Bueno</label><br><font size=2>Enfocarse en puntos espec&iacute;ficos</font>";
	}
	if(posicion==2)
	{	
  		document.getElementById(element+'x').src = "../images/estrella_seleccionada.png";
		document.getElementById(element+'xx').src = "../images/estrella_seleccionada.png";
		document.getElementById(element+'xxx').src = "../images/estrella_vacia.png";
		document.getElementById(element+'xxxx').src = "../images/estrella_vacia.png";
		document.getElementById(element+'xxxxx').src = "../images/estrella_vacia.png";
		document.getElementById('ee'+pregunta).innerHTML = "<label>Regular</label><br><font size=2>Necesita mejorar</font>";
	}
	if(posicion==1)
	{	
  		document.getElementById(element+'x').src = "../images/estrella_seleccionada.png";
		document.getElementById(element+'xx').src = "../images/estrella_vacia.png";
		document.getElementById(element+'xxx').src = "../images/estrella_vacia.png";
		document.getElementById(element+'xxxx').src = "../images/estrella_vacia.png";
		document.getElementById(element+'xxxxx').src = "../images/estrella_vacia.png";
		document.getElementById('ee'+pregunta).innerHTML = "<label>Malo</label><br><font size=2>Su oportunidad de mejora es alta</font>";
	}
 }
 
 function limpiar_calificacion(element,posicion,pregunta,consecutivo)
 {
   	document.getElementById('valor'+pregunta).value= posicion; 
	document.getElementById('cc'+consecutivo).value= posicion; 
	document.getElementById(element+'x').src = "../images/estrella_vacia.png";
	document.getElementById(element+'xx').src = "../images/estrella_vacia.png";
	document.getElementById(element+'xxx').src = "../images/estrella_vacia.png";
	document.getElementById(element+'xxxx').src = "../images/estrella_vacia.png";
	document.getElementById(element+'xxxxx').src = "../images/estrella_vacia.png";
	document.getElementById('ee'+pregunta).innerHTML = "<label>No cumple las 5's</label><br><font size=2>Es necesario tomar acciones</font>";
	calificacion();
 }
 