var filasel;
var filasels;

function fila(filsel){
filasel = filsel;
return filasel;
}

function filas(Color, filsel, Valor){
filasels = filsel;
var theCells = filasels.getElementsByTagName('td');
var rowCellsCnt  = theCells.length;
for (var c = 0; c < rowCellsCnt; c++) {
	if (Valor==1){
		theCells[c].style.backgroundColor = Color;
	}else{
		theCells[c].style.backgroundColor = Color;
	}
}
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
/*if(Cont==(NChecks-1) && !document.frmlista.allcheck.checked){
document.frmlista.allcheck.checked = true;
}else{
	document.frmlista.allcheck.checked = false;
}*/
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
		alert ("Por favor, selecciona los registros quee deseas elimiar.");
		return (false);
	}
}