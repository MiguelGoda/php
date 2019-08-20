//********************************************
//  FUNCIONES PARA VALIDAR FORMULARIOS
//  v 1.3
// OpenSource siempre y cuando no borren estas lineas
// José reynaldo becerra -- josereynaldo@hotmail.com
//*******************************************
/* En el onClick del boton Submit o en el onSubmit del formulario
 * onClick="return validar('nombrenegocio','Nombre del Negocio', 'T', 'email','Email', 'M');"
 * los parametros son:
 * el nombre del objeto
 * el campo que se tomará para el mensaje de advertencia
 * y el tipo de Validación que puede ser : 'T', para texto requerido
 										 : 'M', para Email
										 : 'C', para Combos
										 : 'P', para Password tiene que haber p1 y p2 ej. abajo
 */

// validar password
// onClick="return validar('usuario', 'Usuario', 'T', 'pais', 'País' 'C','password','p1','P', 'password2','p2','P');"
// En esta validación, p1 y p2 que deberia ser el nombre del campo 
// es el del textfield password y su repeticion ya no se agrega 'T'
// por que esta esta incluida en la funcion

 
// Aparte la función keynumeros() en el evento keyPress 
// para que solo puedan digitar numeros

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
	if(fono.length<6){
			alert("Por Favor, No Ingrese Menos de 7 digitos en el "+campo);
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


//en el evento onKeyPress
function keynumeros(){
if (event.keyCode < 45 || event.keyCode > 57) {
	event.returnValue = false;
}//if
}//function