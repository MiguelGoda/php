var filasel;

function fila(filsel){
filasel = filsel;
return filasel;
}


function setPointer(Color, valorcheck){

var theRow=filasel;
/*    if (thePointerColor == '' || typeof(theRow.style) == 'undefined') {
        return false;
    }
    if (typeof(document.getElementsByTagName) != 'undefined') {
        var theCells = theRow.getElementsByTagName('td');
    }
    else if (typeof(theRow.cells) != 'undefined') {
        var theCells = theRow.cells;
    }
    else {
        return false;
    }*/
        var theCells = theRow.getElementsByTagName('td');	

//		var theCells = theRow.cells;
    var rowCellsCnt  = theCells.length;
    for (var c = 0; c < rowCellsCnt; c++) {
		if(valorcheck.checked==true){
        theCells[c].style.backgroundColor = Color;
		}else {
		theCells[c].style.backgroundColor = ''; // #d6e7ef
		}
    }
//Si todos estan seleccionados
var NChecks=0;
var Cont=0;
for(var x=0; x<document.frmlista.length; x++ ){
	if(document.frmlista.elements[x].type=="checkbox"){		
		NChecks++;		
	}
}
for(var x=0; x<document.frmlista.length; x++ ){
	if(document.frmlista.elements[x].checked){		
		Cont++;		
	}
}
//alert(Cont + " - " + (NChecks-1));
if(Cont==(NChecks-1) && !document.frmlista.allcheck.checked){
document.frmlista.allcheck.checked = true;
}else{
	document.frmlista.allcheck.checked = false;
}
return true;
}


function seleccionarTodos(Color){
var activo;
Tab = document.all.sombra;	
for(var x=0; x<document.frmlista.length; x++ ){
	if(document.frmlista.allcheck.checked && document.frmlista.elements[x].type=="checkbox"){
		document.frmlista.elements[x].checked = true;
	}else{
		document.frmlista.elements[x].checked = false;
	}		
}
for (r=0; r<Tab.rows.length; r++){
	for(c=0; c< Tab.rows[r].cells.length; c++){
		if(Tab.rows[r].cells[c].tagName!="TH"){
			if(document.frmlista.allcheck.checked){
			Tab.rows[r].cells[c].style.backgroundColor= Color;
			}else{
			Tab.rows[r].cells[c].style.backgroundColor="";
			}
		}
	}
}
}

function compCheck(){
var sw=0;
	for(var x=0; x<document.frmlista.length; x++ ){
		if (document.frmlista.elements[x].checked){
			sw=1;
		}
	}
	if(sw!=1){
		alert ("Por favor, selecciona los registros quee deseas Eliminar.");
		return (false);
	}
}

function compCheck1(){
var sw=0;
	for(var x=0; x<document.frmlista.length; x++ ){
		if (document.frmlista.elements[x].checked){
			sw=1;
		}
	}
	if(sw!=1){
		alert ("Por favor, selecciona los registros Correspondientes a esta Entidad.");
		return (false);
	}
}
  function loadtwo(page2, page3) {
     parent.leftFrame.location.href=page2;
     parent.mainFrame.location.href=page3;
}


function habilitar1(str)
{

if (document.form1.rletra1.value==0) { 

}
document.form1.rletra1.checked= true;
document.form1.nombre.disabled= false;
document.form1.rletra2.checked= false;
document.form1.fecha.value= "";
document.form1.fecha1.value= "";
document.form1.fecha.disabled= true;
document.form1.fecha1.disabled= true;
}
function habilitard1(str)
{
if (document.form1.rletra2.value==1) {
document.form1.rletra1.checked= false;
document.form1.rletra1.value==0

document.form1.fecha.value= "";
document.form1.fecha1.value= "";
document.form1.fecha.disabled= false;
document.form1.fecha1.disabled= false;
document.form1.nombre.disabled= true;
document.form1.nombre.value= "";
}
}

