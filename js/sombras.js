var filasel;
function fila(Color, filsel, Valor){
filasel = filsel;
var theCells = filasel.getElementsByTagName('td');
var rowCellsCnt  = theCells.length;
for (var c = 0; c < rowCellsCnt; c++) {
	if (Valor==1){
		theCells[c].style.backgroundColor = Color;
	}else{
		theCells[c].style.backgroundColor = Color;
	}
}
}


