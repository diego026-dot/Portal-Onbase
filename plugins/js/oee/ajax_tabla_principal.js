
/*
* Parametros mandatorios
*/
    var seconds = 60; // el tiempo en que se refresca
	var divid = "contenido"; // el div que quieres actualizar!
	var url = "ajax_index.php?linea="+document.form.linea.value+"&area="+document.form.area.value; 
	// el archivo que ira en el div
	//alert(url);
	function refreshdiv(){

		// The XMLHttpRequest object

		var xmlHttp;
		try{
			xmlHttp=new XMLHttpRequest(); // Firefox, Opera 8.0+, Safari
		}
		catch (e){
			try{
				xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
			}
			catch (e){
				try{
					xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
				catch (e){
					alert("Tu explorador no soporta AJAX.");
					return false;
				}
			}
		}

		// Timestamp for preventing IE caching the GET request
		var timestamp = parseInt(new Date().getTime().toString().substring(0, 10));
		var nocacheurl = url;

		// The code...

		xmlHttp.onreadystatechange=function(){
			if(xmlHttp.readyState== 4 && xmlHttp.readyState != null){
				document.getElementById(divid).innerHTML=xmlHttp.responseText;
				setTimeout('refreshdiv()',seconds*1000);
			}
		}
		xmlHttp.open("GET",nocacheurl,true);
		xmlHttp.send(null);
	}

	// Empieza la funci�n de refrescar

	window.onload = function(){
		refreshdiv(); // corremos inmediatamente la funcion
	}
	
