function Buscador(){
var xmlhttp=false;
try {
xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
} catch (e) {
try {
xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
} catch (E) {
xmlhttp = false;
}
}
if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
xmlhttp = new XMLHttpRequest();
}
return xmlhttp;
}
//Tambien les dejo la funcion que se encarga de buscar en la DB:
function Buscarusuario() {
var Texto = document.getElementById('texto').value;
var Resultados = document.getElementById('buscador');
ajax = Buscador();
ajax.open("GET","buscadorUsuario.php?q="+Texto);

ajax.onreadystatechange = function() {
if (ajax.readyState == 4) {
Resultados.innerHTML = ajax.responseText;
}
}
ajax.send(null)
}

function Buscarpersonal() {
     var Texto = document.getElementById('texto').value;
     var Resultados = document.getElementById('buscador');
	
ajax = Buscador();
ajax.open("GET","buscar_personal.php?q="+Texto);			            
ajax.onreadystatechange = function() {
if (ajax.readyState == 4) {
Resultados.innerHTML = ajax.responseText;
}
}
ajax.send(null)
}
function BuscarpersonalUser() {
     var Texto = document.getElementById('texto').value;
     var Resultados = document.getElementById('buscador');
	
ajax = Buscador();
ajax.open("GET","buscar_personal_user.php?q="+Texto);			            
ajax.onreadystatechange = function() {
if (ajax.readyState == 4) {
Resultados.innerHTML = ajax.responseText;
}
}
ajax.send(null)
}

function Buscarfuncionario() {
     var Texto = document.getElementById('texto').value;
     var Resultados = document.getElementById('buscador');
	
ajax = Buscador();
ajax.open("GET","BuscarFuncionario.php?q="+Texto);			            
ajax.onreadystatechange = function() {
if (ajax.readyState == 4) {
Resultados.innerHTML = ajax.responseText;
}
}
ajax.send(null)
}

function Buscarfuncionario2() {
     var Texto = document.getElementById('texto').value;
     var Resultados = document.getElementById('buscador');
	
ajax = Buscador();
ajax.open("GET","BuscarFuncionario2.php?q="+Texto);			            
ajax.onreadystatechange = function() {
if (ajax.readyState == 4) {
Resultados.innerHTML = ajax.responseText;
}
}
ajax.send(null)
}

function BuscarFuncionarioCampamento() {
     var Texto = document.getElementById('texto').value;
     var Resultados = document.getElementById('buscador');
	
ajax = Buscador();
ajax.open("GET","BuscarFuncionarioCampamento.php?q="+Texto);			            
ajax.onreadystatechange = function() {
if (ajax.readyState == 4) {
Resultados.innerHTML = ajax.responseText;
}
}
ajax.send(null)
}