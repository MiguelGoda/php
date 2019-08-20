//********************************************
//  FUNCIONES VARIAS DE JAVASCRIPT
//  v 2.2
// OpenSource siempre y cuando no borren estas lineas
// José Medina Llontop -- josemll@hotmail.com
//*******************************************

//**** SELECCIONAR FILAS ****
/*
//Tabla que contiene los Objetos
<table border=0 cellpadding="1" class="tableborde" id="tbLista" width="530">

//Check que selecciona todas las Filas
<input name="allcheck" type="checkbox" id="allcheck" value="checkbox" title="Selecciona todos" onClick="seleccionarTodos('#D9F2FF');">

// Fila (TR) que se va a sombrear
<tr onMouseover="fila(this)" name="<?=$filas[0]?>"> 

//Check por cada Fila cuando se resive es un array $chkselect
<input name="chkselect[]" type="checkbox" id="chkselect[]" value="<?=$filas[0]?>" onclick="setPointer('#D9F2FF',this);

*/

var filasel;

function fila(filsel){
filasel = filsel;
return filasel;
}

function setPointer(Color, valorcheck){
var theRow=filasel;
var theCells = theRow.getElementsByTagName('td');	

var rowCellsCnt  = theCells.length;
for (var c = 0; c < rowCellsCnt; c++) {
	if(valorcheck.checked==true){
      	theCells[c].style.backgroundColor = Color;
	}else {
		theCells[c].style.backgroundColor = '';
	}
}
//Si todos estan seleccionados
var NChecks=0;
var Cont=0;
for(var x=0; x<document.form1.length; x++ ){
	if(document.form1.elements[x].type=="checkbox"){		
		NChecks++;		
	}
}
for(var x=0; x<document.form1.length; x++ ){
	if(document.form1.elements[x].checked){		
		Cont++;		
	}
}

if(Cont==(NChecks-1) && !document.form1.allcheck.checked){
document.form1.allcheck.checked = true;
}else{
	document.form1.allcheck.checked = false;
}
return true;
}

function seleccionarTodos(Color){
var activo;
var Nchk=0;
Tab = document.all.tbLista;	
for(var x=0; x<document.form1.length; x++ ){
	if(document.form1.allcheck.checked && document.form1.elements[x].type=="checkbox"){
		document.form1.elements[x].checked = true;
		Nchk++; //numero de checks si es mayor de 1 para que no seleccione linea vacia
	}else{
		document.form1.elements[x].checked = false;
	}		
}
for (r=0; r<Tab.rows.length; r++){
	for(c=0; c< Tab.rows[r].cells.length; c++){
		if(Tab.rows[r].cells[c].tagName!="TH"){
			if(document.form1.allcheck.checked && Nchk>1){
				Tab.rows[r].cells[c].style.backgroundColor= Color;
			}else{
				Tab.rows[r].cells[c].style.backgroundColor="";
			}
		}
	}
}
}

function compCheck(pagmensaje, pag_opener){
var sw=0; 
var allcheck=0;

	for(var x=0; x<document.form1.length; x++ ){
		if (document.form1.elements[x].checked){
			sw++;
		}
	}
	if(document.form1.allcheck.checked && sw==1){
		allcheck++;
	}

	if(sw == 0 || allcheck==1){
		alert ("No hay registros seleccionados para eliminar.");		
		return (false);
	}else{
		abrirventana(pagmensaje,'?pag_opener='+pag_opener,350,150, 'toolbar=No,menubar=No,location=No,scrollbars=no,resizable=Yes');
		return (false);
	}
}


function TipoNavegador(){
if (navigator.userAgent.indexOf("MSIE")    != -1 && 
	navigator.userAgent.indexOf("Windows") != -1 && 
	navigator.appVersion.substring(0,1) > 3){
		return true;
	}else{ 
		return false; 
	}
}

///***************************************************************



//**** CAMBIAR OPCIONES DE COMBOS(PAISES) ****
/*
<select name="pais" onChange="procEst();">
      <option value="0">(Selecciona un Pa&iacute;s)</option>
      <option value="Argentina">Argentina</option>
      <option value="Bolivia">Bolivia</option>
      <option value="Brasil">Brasil</option>
      <option value="Chile">Chile</option>
      <option value="Colombia">Colombia</option>
      <option value="Ecuador">Ecuador</option>
      <option value="Peru">Per&uacute;</option>
      <option value="Venezuela">Venezuela</option>
      <option value="Otro Pais">Otro Pa&iacute;s</option>
</select>

<select name="ciudad">
      <option value="0">(Primero indicar Pa&iacute;s)</option>
</select>
*/

function procEst(){
	var lista = document.form1.pais;
	i = document.form1.pais.selectedIndex;
	//if (i != 0) {
		var dropdownObjectPath = document.form1.ciudad;
		var wichDropdown = "ciudad";
		var withWhat = lista.options[lista.selectedIndex].value;

		populateOptions(wichDropdown, withWhat);
	  //}
}


function populateOptions(wichDropdown, withWhat){
	o = new Array;
	i=0;

	if (withWhat == "0"){
		o[i++]=new Option("(Primero indicar País)", "0");
	}

	if (withWhat == "Argentina"){
		o[i++]=new Option("(Selecciona Ciudad)", "0");
        o[i++]=new Option("Buenos Aires", "Buenos Aires");
        o[i++]=new Option("Catamarca", "Catamarca");
        o[i++]=new Option("Chaco", "Chaco");
        o[i++]=new Option("Chubut", "Chubut");
        o[i++]=new Option("Corrientes", "Corrientes");
        o[i++]=new Option("Córdoba", "Córdoba");
        o[i++]=new Option("Jujuy", "Jujuy");
        o[i++]=new Option("La Pampa", "La Pampa");
        o[i++]=new Option("La Rioja", "La Rioja");
        o[i++]=new Option("Mendoza", "Mendoza");
        o[i++]=new Option("Misiones", "Misiones");
        o[i++]=new Option("Neuquén", "Neuquén");
        o[i++]=new Option("Santa Cruz", "Santa Cruz");
        o[i++]=new Option("Santa Fe", "Santa Fe");
        o[i++]=new Option("Santiago del Estero", "Santiago del Estero");
        o[i++]=new Option("Tierra del Fuego", "Tierra del Fuego");
        o[i++]=new Option("Tucuman", "Tucuman");
	}
	if (withWhat == "Bolivia"){
		o[i++]=new Option("(Selecciona Ciudad)", "0");
        o[i++]=new Option("Chuquisaca", "Chuquisaca");
        o[i++]=new Option("La Paz", "La Paz");
        o[i++]=new Option("Oruro", "Oruro");
        o[i++]=new Option("Potosí", "Potosí");
        o[i++]=new Option("Tarija", "Tarija");
	}
	if (withWhat == "Brasil"){
		o[i++]=new Option("(Selecciona Ciudad)", "0");
        o[i++]=new Option("Acre", "Acre");
        o[i++]=new Option("Bahia", "Bahia");
        o[i++]=new Option("Distrito Federal", "Distrito Federal");
        o[i++]=new Option("Espírito Santo", "Espírito Santo");
        o[i++]=new Option("Mato Grosso", "Mato Grosso");
        o[i++]=new Option("Pará", "Pará");
        o[i++]=new Option("Paraíba", "Paraíba");
        o[i++]=new Option("Paraná", "Paraná");
        o[i++]=new Option("Pernambuco", "Pernambuco");
        o[i++]=new Option("Piauí", "Piauí");
        o[i++]=new Option("Rio de Janeiro", "Rio de Janeiro");
        o[i++]=new Option("Rondônia", "Rondônia");
        o[i++]=new Option("Sergipe", "Sergipe");
        o[i++]=new Option("São Paulo", "São Paulo");
        o[i++]=new Option("Tocantins", "Tocantins");
	}
	if (withWhat == "Chile"){
		o[i++]=new Option("(Selecciona Ciudad)", "0");
        o[i++]=new Option("Antofagasta", "Antofagasta");
        o[i++]=new Option("Atacama", "Atacama");
        o[i++]=new Option("Biobío", "Biobío");
        o[i++]=new Option("Coquimbo", "Coquimbo");
        o[i++]=new Option("Isla de Pascua", "Isla de Pascua");
        o[i++]=new Option("La Araucanía", "La Araucanía");
        o[i++]=new Option("Los Lagos", "Los Lagos");
        o[i++]=new Option("Maule", "Maule");
        o[i++]=new Option("Santiago", "Santiago");
        o[i++]=new Option("Tarapacá", "Tarapacá");
        o[i++]=new Option("Valparaíso", "Valparaíso");
	}
	if (withWhat == "Colombia"){
		o[i++]=new Option("(Selecciona Ciudad)", "0");
        o[i++]=new Option("Antioquia", "Antioquia");
        o[i++]=new Option("Arauca", "Arauca");
        o[i++]=new Option("Atlántico", "Atlántico");
        o[i++]=new Option("Bolívar", "Bolívar");
        o[i++]=new Option("Boyacá", "Boyacá");
        o[i++]=new Option("Caldas", "Caldas");
        o[i++]=new Option("Casanare", "Casanare");
        o[i++]=new Option("Cauca", "Cauca");
        o[i++]=new Option("Córdoba", "Córdoba");
        o[i++]=new Option("Cundinamarca", "80");
        o[i++]=new Option("Huila", "Huila");
        o[i++]=new Option("Magdalena", "Magdalena");
        o[i++]=new Option("Quindío", "Quindío");

        o[i++]=new Option("SantaFé de Bogotá", "SantaFé de Bogotá");
        o[i++]=new Option("Sucre", "Sucre");
        o[i++]=new Option("Tolima", "Tolima");
	}
	if (withWhat == "Ecuador"){
		o[i++]=new Option("(Selecciona Ciudad)", "0");
        o[i++]=new Option("Azuay", "Azuay");
        o[i++]=new Option("El Oro", "El Oro");
        o[i++]=new Option("Guayas", "Guayas");
        o[i++]=new Option("Loja", "Loja");
        o[i++]=new Option("Manabí", "Manabí");
        o[i++]=new Option("Pichincha", "Pichincha");
        o[i++]=new Option("Quito", "Quito");
	}

	if (withWhat == "Peru"){
		o[i++]=new Option("(Selecciona Ciudad)", "0");
        o[i++]=new Option("Ancash", "Ancash");
        o[i++]=new Option("Arequipa", "Arequipa");
        o[i++]=new Option("Callao", "Callao");
        o[i++]=new Option("Cusco", "Cusco");
        o[i++]=new Option("Huancavelica", "Huancavelica");
        o[i++]=new Option("Ica", "Ica");
        o[i++]=new Option("Junín", "Junín");
        o[i++]=new Option("La Libertad", "La Libertad");
        o[i++]=new Option("Lambayeque", "Lambayeque");
        o[i++]=new Option("Lima", "Lima");
        o[i++]=new Option("Loreto", "Loreto");
        o[i++]=new Option("Piura", "Piura");
        o[i++]=new Option("Puno", "Puno");
        o[i++]=new Option("Tacna", "Tacna");
	}

	if (withWhat == "Venezuela"){
		o[i++]=new Option("(Selecciona Ciudad)", "0");
        o[i++]=new Option("Aragua", "Aragua");
        o[i++]=new Option("Bolívar", "Bolívar");
        o[i++]=new Option("Carabobo", "Carabobo");
        o[i++]=new Option("Distrito Federal", "Distrito Federal");
        o[i++]=new Option("Falcón", "Falcón");
        o[i++]=new Option("Miranda", "Miranda");
        o[i++]=new Option("Monagas", "Monagas");
        o[i++]=new Option("Nueva Esparta", "Nueva Esparta");
        o[i++]=new Option("Portuguesa", "Portuguesa");
        o[i++]=new Option("Sucre", "Sucre");
        o[i++]=new Option("Táchira", "Táchira");
        o[i++]=new Option("Trujillo", "Trujillo");
        o[i++]=new Option("Vargas", "Vargas");
	}

	if (withWhat == "Estados Unidos"){
		o[i++]=new Option("(Selecciona Ciudad)", "0");
        o[i++]=new Option("Alabama", "Alabama");
        o[i++]=new Option("Alaska", "Alaska");
        o[i++]=new Option("Arizona", "Arizona");
        o[i++]=new Option("Arkansas", "Arkansas");
        o[i++]=new Option("California", "California");
        o[i++]=new Option("Colorado", "Colorado");
        o[i++]=new Option("Connecticut", "Connecticut");
        o[i++]=new Option("Delaware", "Delaware");
        o[i++]=new Option("Florida", "Florida");
        o[i++]=new Option("Georgia", "Georgia");
        o[i++]=new Option("Hawaii", "Hawaii");
        o[i++]=new Option("Idaho", "Idaho");
        o[i++]=new Option("Illinois", "Illinois");
        o[i++]=new Option("Indiana", "Indiana");
        o[i++]=new Option("Iowa", "Iowa");
        o[i++]=new Option("Kansas", "Kansas");
        o[i++]=new Option("Kentucky", "Kentucky");
        o[i++]=new Option("Louisiana", "Louisiana");
        o[i++]=new Option("Maine", "Maine");
        o[i++]=new Option("Maryland", "Maryland");
        o[i++]=new Option("Massachusetts", "Massachusetts");
        o[i++]=new Option("Michigan", "Michigan");
        o[i++]=new Option("Minnesota", "380");
        o[i++]=new Option("Mississippi", "Mississippi");
        o[i++]=new Option("Missouri", "Missouri");
        o[i++]=new Option("Montana", "Montana");
        o[i++]=new Option("Nebraska", "Nebraska");
        o[i++]=new Option("Nevada", "Nevada");
        o[i++]=new Option("New Hampshire", "New Hampshire");
        o[i++]=new Option("New Jersey", "New Jersey");
        o[i++]=new Option("New Mexico", "New Mexico");
        o[i++]=new Option("New York", "New York");
        o[i++]=new Option("North Carolina", "North Carolina");
        o[i++]=new Option("North Dakota", "North Dakota");
        o[i++]=new Option("Ohio", "Ohio");
        o[i++]=new Option("Oklahoma", "Oklahoma");
        o[i++]=new Option("Oregon", "Oregon");
        o[i++]=new Option("Pennsylvania", "Pennsylvania");
        o[i++]=new Option("Rhode Island", "Rhode Island");
        o[i++]=new Option("South Carolina", "South Carolina");
        o[i++]=new Option("South Dakota", "South Dakota");
        o[i++]=new Option("Tennessee", "Tennessee");
        o[i++]=new Option("Texas", "Texas");
        o[i++]=new Option("Utah", "Utah");
        o[i++]=new Option("Vermont", "Vermont");
        o[i++]=new Option("Virginia", "Virginia");
        o[i++]=new Option("Washington", "Washington");
        o[i++]=new Option("Washington,D.C.", "Washington,D.C.");
        o[i++]=new Option("West Virginia", "West Virginia");
        o[i++]=new Option("Wisconsin", "Wisconsin");
        o[i++]=new Option("Wyoming", "Wyoming");

	}
	
	if (withWhat == "Otro Pais"){
	  o[i++]=new Option("Otra Ciudad", "Otra Ciudad");
    }


	if (i==0){
		alert(i + " " + "Error!!!");
	}else{
		dropdownObjectPath = document.form1.ciudad;
		eval(document.form1.ciudad.length=o.length);
		largestwidth=0;
		for (i=0; i < o.length; i++){
			  eval(document.form1.ciudad.options[i]=o[i]);
			  if (o[i].text.length > largestwidth) {
			     largestwidth=o[i].text.length;
			  }
	    }
		eval(document.form1.ciudad.length=o.length);
		//eval(document.form1.ciudad.options[0].selected=true);
	}

}
function atras() { 
	window.history.back();
}
function cerrarwindow(){
	window.close();
}

function abrirventana(archivo,parametros,vwidth,vheight, propiedades){
//propiedades:  //"status=yes toolbar=no resizable=no"
var ventana=null;
window.moveTo(0,0);
window.resizeTo(screen.availWidth, screen.availHeight );
l = (screen.availWidth - vwidth)/2;
t = (screen.availHeight - vheight)/2;
//if(TipoNavegador()==false){
	ventana = window.open(archivo + parametros, "vent", "width=" + vwidth + " height=" + vheight + " left=" + l + " top=" + t + " " + propiedades);
//}else{
//ventana = window.showModalDialog(archivo + parametros, "nose", "dialogHeight: " + vheight + "px; dialogWidth: " + vwidth + "px; edge: Raised; center: Yes; help: No; resizable: No; status: No;");
//}
}
function abrirventana2(archivo,parametros,vwidth,vheight, propiedades,propiedades2){
//propiedades:  //"status=yes toolbar=no resizable=no"
var ventana=null;
window.moveTo(0,0);
window.resizeTo(screen.availWidth, screen.availHeight );
l = (screen.availWidth - vwidth)/2;
t = (screen.availHeight - vheight)/2;
//if(TipoNavegador()==false){
	ventana = window.open(archivo + parametros, "vent", "width=" + vwidth + " height=" + vheight + " left=" + l + " top=" + t + " " + propiedades + propiedades2);
//}else{
//ventana = window.showModalDialog(archivo + parametros, "nose", "dialogHeight: " + vheight + "px; dialogWidth: " + vwidth + "px; edge: Raised; center: Yes; help: No; resizable: No; status: No;");
//}
}


//en el evento onKeyPress
function keynumeros(){
if (event.keyCode < 48 || event.keyCode > 57) {
	event.returnValue = false;
}//if
}//function

function keyletras(){
	if (event.keyCode >= 45 && event.keyCode <= 57) {
		//alert("Solo se pemite el Ingreso de Letras");
		event.returnValue = false;
	}
}
function validar(){
arg=validar.arguments;
for(i=0; i<arg.length; i+=3) { 
	objeto=document.getElementById(arg[i]);  //Obtenemos el objeto que era texto
	campo=arg[i+1];
	test=arg[i+2];
// ** Tipos de Validación
	if(test.indexOf('T')!=-1){
		//Validacion Vacio
		if(objeto.value==""){
			alert("Por favor, ingrese "+campo);
			objeto.focus();
			return false;
		} //if
	}//if	
	//Valida Telefono
	if(test.indexOf('F')!=-1){
//	  ruca=object.value
	  fono=document.form1.telefono.value
	if(fono.length<9){
			alert("Por Favor, No Ingrese Menos de 9 digitos en el "+campo);
			objeto.focus();
			return false;
		}
	}
	//Validar E-Mail
	if(test.indexOf('M')!=-1){
		//Validacion  de Vacio tambien
		if(objeto.value==""){
			alert("Por favor, ingrese "+campo);
			objeto.focus();
			return false;
		} //if		
		if(objeto.value.indexOf('@')<1 || objeto.value.indexOf('.')<1){
			alert("Por favor, ingrese una dirección de Correo valida");
			objeto.focus();
			return false;	
		} //if
	}//if
	
	
	
	if(test.indexOf('C')!=-1){
		//Validacion Combo
		if(objeto.value==0){
			alert("Por favor, seleccione "+campo);
			objeto.focus();
			return false;
		} //if
	}//if	
	
	
	//Validar Password y su Repitición
	if(test.indexOf('P')!=-1){
		//Validacion  de Vacio tambien
		if(objeto.value==""){
			if(campo=='p1')alert("Por favor, ingrese Password");
			if(campo=='p2')alert("Por favor, repita el Password");
			objeto.focus();
			return false;
		} //if		

		if(campo=='p1'){
			objpass1=objeto;
			pass1=objeto.value;			
		}
		if(campo=='p2'){
			objpass2=objeto;
			pass2=objeto.value;
			if(pass1!=pass2){
				objpass1.value='';
				objpass2.value='';
				objpass1.focus();
				alert("Los passwords no coinciden, repitalo correctamente.");				
				return(false);			
			}
		}		
	}


} //for
} // function
