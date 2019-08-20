
function MM_jumpMenu(targ,selObj,restore){
eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
if (restore) selObj.selectedIndex=0;
}
function imprimir(){
  var objeto=document.getElementById('imprimeme');  //obtenemos el objeto a imprimir
  var ventana=window.open('','_blank');  //abrimos una ventana vacía nueva
  ventana.document.write(objeto.innerHTML);  //imprimimos el HTML del objeto en la nueva ventana
  ventana.document.close();  //cerramos el documento
  ventana.print();  //imprimimos la ventana
  ventana.close();  //cerramos la ventana
}

function envia_categoria()
{
    var valor=document.getElementById("valor").value;
    if(valor >=1)
    {
        window.location="ventas.php?s="+valor;
    }
}
function envia_proveedor()
{
    var valor2=document.getElementById("valor2").value;
    if(valor2 >=1)
    {
        window.location="ventas.php?t="+valor2;
    }
}
function enviasuper()
{
    var valor=document.getElementById("valor").value;
    if(valor >=1)
    {
        window.location="add_asistencia_campamentos.php?s="+valor;
    }
}
function enviasuper2()
{
    var valor2=document.getElementById("valor2").value;
    if(valor2 >=1)
    {
        window.location="mercaderia.php?t="+valor2;
    }
}
function enviasuper3()
{
    var valor=document.getElementById("valor").value;
    if(valor >=1)
    {
        window.location="reporte_ventas.php?p="+valor;
    }
}

function obtiene_http_request()
{
var req = false;
try
  {
    req = new XMLHttpRequest(); /* p.e. Firefox */
  }
catch(err1)
  {
  try
    {
     req = new ActiveXObject("Msxml2.XMLHTTP");
  /* algunas versiones IE */
    }
  catch(err2)
    {
    try
      {
       req = new ActiveXObject("Microsoft.XMLHTTP");
  /* algunas versiones IE */
      }
      catch(err3)
        {
         req = false;
        }
    }
  }
return req;
}
var miPeticion = obtiene_http_request();
/********************************************/
function from_post_1(id,ide,url)
{
	//alert(document.form.pais.options[document.form.pais.selectedIndex].text);
	//alert("id="+id+"ide="+ide+"url="+url);
	
		
		//para que no guarde la página en el caché...
		var mi_aleatorio=parseInt(Math.random()*99999999);
		//creo la URL dinámica
		var vinculo=url+"?rand="+mi_aleatorio+"&id="+id;
		//alert(vinculo);
		//ponemos true para que la petición sea asincrónica
		miPeticion.open("POST",vinculo,true);
		miPeticion.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		miPeticion.send(vinculo);
		
		
		//ahora procesamos la información enviada
		miPeticion.onreadystatechange=miPeticion.onreadystatechange=function(){
               //alert("ready_State="+miPeticion.readyState);
               if (miPeticion.readyState==4)
               {
				   //alert(miPeticion.readyState);
                       //alert("status ="+miPeticion.status);
                       if (miPeticion.status==200)
                       {
                                //alert(miPeticion.status);
                               //var http=miPeticion.responseXML;
                               //alert("http="+http);
                               var http=miPeticion.responseText;
                               document.getElementById(ide).innerHTML= http;

                       }
               }
               
       }
       miPeticion.send(null);
	
}
/********************************************/
function from_post(id,id_venta,ide,url)
{
	//alert(document.form.pais.options[document.form.pais.selectedIndex].text);
	//alert("id="+id+"ide="+ide+"url="+url);
	
		
		//para que no guarde la página en el caché...
		var mi_aleatorio=parseInt(Math.random()*99999999);
		//creo la URL dinámica
		var vinculo=url+"?rand="+mi_aleatorio+"&id="+id+"&id_venta="+id_venta;
		//alert(vinculo);
		//ponemos true para que la petición sea asincrónica
		miPeticion.open("POST",vinculo,true);
		miPeticion.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		miPeticion.send(vinculo);
		
		
		//ahora procesamos la información enviada
		miPeticion.onreadystatechange=miPeticion.onreadystatechange=function(){
               //alert("ready_State="+miPeticion.readyState);
               if (miPeticion.readyState==4)
               {
				   //alert(miPeticion.readyState);
                       //alert("status ="+miPeticion.status);
                       if (miPeticion.status==200)
                       {
                                //alert(miPeticion.status);
                               //var http=miPeticion.responseXML;
                               //alert("http="+http);
                               var http=miPeticion.responseText;
                               document.getElementById(ide).innerHTML= http;

                       }
               }
               
       }
       miPeticion.send(null);
	
}
function cerrar()
{
    document.getElementById("ajax").innerHTML="";



}
