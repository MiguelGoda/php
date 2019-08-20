<!-- http://ProgramarEnPHP.wordpress.com -->
<?php require('menuadmin.php'); ?>
<head>


<SCRIPT language=JavaScript src="js/sombreado.js"></SCRIPT>
<link href="css/styles.css" rel="stylesheet" type="text/css">
<body>
<?php
   $tra=new User();
$datos=$tra->get_tabla_id("id_persona",$_GET["id"],"persona");   
   ?>
   <form id="form1" name="form1" method="post" action="edit_funcionario.php" accept-charset="UTF-8" enctype="multipart/form-data">
    <table width="800" border="0" align="center" bgcolor="#FFFFFF">
      <tbody>
        <tr>
          <td colspan="4" style="text-align: center">&nbsp;</td>
        </tr>
        <tr>
          <td rowspan="2" style="text-align: center"><img src="imagenes/logo_camino.png" width="112" height="121" alt=""/></td>
          <td height="81" colspan="2" style="text-align: center; color: #2926F3;"><strong>FICHA PERSONAL</strong></td>
          <td rowspan="2" style="text-align: center"><img src="<?php echo $datos[0]["foto"];?>" width="112" height="121" alt=""/></td>
        </tr>
        <tr>
          <td height="37" colspan="2" style="text-align: center">&nbsp;</td> <td width="12" height="37" style="text-align: center">&nbsp;</td>
        </tr>
        <tr>
          <td width="326" style="text-align: justify"><span class="Estilo1">Apellido Paterno:</span><span class="Estilo2"> <?php echo $datos[0]["ap_paterno"];?></span>       </td>
          <td colspan="2" style="text-align: justify"><span class="Estilo1">Apellido Materno:</span> <span class="Estilo2"><?php echo $datos[0]["ap_materno"];?></span>             
          </strong></td>
          <td width="256" style="text-align: justify"><span class="Estilo1">Nombres:</span><span class="Estilo2"><?php echo $datos[0]["nombres"];?></span>
          </strong></td>
        </tr>
       
        <tr>
          <td style="text-align: justify"><span class="Estilo1">Fecha Nac.:</span> <span class="Estilo2"><?php echo $datos[0]["fecha_nac"];?></span>         
          </td>
          <td colspan="2" style="text-align: justify"><span class="Estilo1">Provincia:</span> <span class="Estilo2"><?php echo $datos[0]["provincia"];?></span>            
          </td>
          <td style="text-align: justify"><span class="Estilo1">Dpto.:</span> <span class="Estilo2"><?php echo $datos[0]["dpto"];?></span></td>
        </tr>
       
        <tr>
          <td style="text-align: justify"> <span class="Estilo1">CI.:</span> <span class="Estilo2"><?php echo $datos[0]["ci"];?></span></td>
          <td colspan="2" style="text-align: justify"><span class="Estilo1">Nro Tel:</span><span class="Estilo2"><?php echo $datos[0]["telefono"];?></span></td>
          <td style="text-align: justify"><span class="Estilo1">Domicilio
          </span><span class="Estilo2"><?php echo $datos[0]["domicilio"];?></span></td>
        </tr>
       
        <tr>
          <td style="text-align: justify"><span class="Estilo1">Unidad</span> <span class="Estilo2">
          <?php
   $tra2=new User();
$id2=$datos[0]["id_unidad"];
$datos2=$tra2->get_tabla_id("id_unidad",$id2,"unidad"); 
 echo $datos2[0]["nombre_u"];?>
          </span>
      
          </td>
          <td colspan="2" style="text-align: justify"><span class="Estilo1">Nro. Cel:</span><span class="Estilo2"><?php echo $datos[0]["celular"];?></span>
          </td>
          <td style="text-align: justify"><span class="Estilo1">Estado Civil:      </span><span class="Estilo2"><?php echo $datos[0]["estado_civil"];?></span></td>
        </tr>
        <tr>
          <td colspan="4" style="text-align: left"><h4><strong>FECHA DE INGRESO A LA INSTITUCION</strong>:</h4></td>
          
          <?php
   $tr=new User();
$dato2=$tr->get_tabla_id("id_persona",$_GET["id"],"contratacion");   
   ?>
          
          
        </tr>
        <tr>
          <td class="Estilo1" style="text-align: justify">Nivel:<span class="Estilo2"><?php echo $dato2[0]["nivel"];?></span></td>
          <td colspan="2" style="text-align: justify"><span class="Estilo1">Cargo:</span><span class="Estilo2"><?php echo $dato2[0]["cargo"];?></span></td>
          <td style="text-align: justify">
            <span class="Estilo1">Fecha Ingreso:</span> <span class="Estilo2"><?php echo $dato2[0]["fecha_ingreso"];?></span>
          </td>
        </tr>
        <tr>
          <td style="text-align: justify"><span class="Estilo1">Fecha Retiro:</span><span class="Estilo2"><?php echo $dato2[0]["fecha_retiro"];?></span></td>
          <td colspan="2" style="text-align: justify"><span class="Estilo1">Reincorporacion:</span><span class="Estilo2"><?php echo $dato2[0]["fecha_reincorporacion"];?></span></td>
          <td style="text-align: justify"><span class="Estilo1">A&ntildeos servicio:</span><span class="Estilo2"><?php echo $dato2[0]["años_servicio"];?></span></td>
        </tr>
        <tr>
          <td colspan="4" style="text-align: justify"><span class="Estilo1">Motivo de retiro:</span><span class="Estilo2"><?php echo $dato2[0]["motivo_retiro"];?></span></td>
        </tr>
        <tr>
          <td colspan="4" style="text-align: left"><h4><strong>EDUCACION Y FORMACION ACADEMICA:</strong></h4></td>
                   <?php
   $tr2=new User();
$dato3=$tr2->get_tabla_id("id_persona",$_GET["id"],"formacion_academica");   
   ?>
        </tr>
        <tr>
          <td colspan="4" style="text-align: justify"><span class="Estilo1">Nivel Academico</span> <span class="Estilo2"><?php echo $dato3[0]["nivel_academico"];?></span></td>
        </tr>
        <tr>
          <td colspan="4" style="text-align: justify"><span class="Estilo1">Profecion u Ocupacion</span> <span class="Estilo2"><?php echo $dato3[0]["profecion_ocupacion"];?></span></td>
        </tr>
        <tr>
          <td colspan="4" style="text-align: left"><h4>REQUISITOS:</h4></td>
          
                           <?php
   $tr3=new User();
$dato4=$tr3->get_tabla_id("id_persona",$_GET["id"],"requisitos");   
   ?>
        </tr>
        <tr>
          <td colspan="3" class="Estilo1" style="text-align: right">CURRICULUM VITAE DOCUMENTADO     <span class="Estilo2"><?php echo $dato4[0]["curriculun"];?></span></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3" class="Estilo1" style="text-align: right">DECLARACION JURARDA DE BIENES Y RENTAS          <span class="Estilo2"><?php echo $dato4[0]["declaracion_j"];?></span></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3" class="Estilo1" style="text-align: right">DECLARACION DE IMCOMPATIBILIDAD EN LA FUNCION PUBLICA        <span class="Estilo2"><?php echo $dato4[0]["declaracion_imcompatibilidad"];?></span></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3" class="Estilo1" style="text-align: right">CERTIFICADO DE ANTECEDENTES PENALES          <span class="Estilo2"><?php echo $dato4[0]["certificado_antecedentes"];?></span></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3" class="Estilo1" style="text-align: right">LIBRETA DE SERVICIO  MILITAR      <span class="Estilo2"><?php echo $dato4[0]["libreta_servicio_militar"];?></span></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3" class="Estilo1" style="text-align: right">PADRON BIOMETRICO ELECTORAL    <span class="Estilo2"><?php echo $dato4[0]["patron_bio_elec"];?></span></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3" class="Estilo1" style="text-align: right">SEGURO CAJA DE SALUD        <span class="Estilo2"><?php echo $dato4[0]["seguro_caja_salud"];?></span></td>
          <td>&nbsp;</td>
        </tr>
                                 <?php
   $tr4=new User();
$dato5=$tr4->get_tabla_id("id_persona",$_GET["id"],"familiares");   
   ?>
        
        <tr>
          <td><strong>Familiares:</strong></td>
          <td colspan="2">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
          <tr class="Estilo1" >
          <td>Nombres</td>
          <td colspan="2">Parentesco</td>
          <td>Fecha nacimiento</td>
        </tr>
             <?php
for($i=0;$i<sizeof($dato5);$i++)
{
if ($i%2==0){  echo '<tr bgcolor="#F4F7EB" >';}
		else{    echo '<tr bgcolor="#F5E68E" >'; }
?>
          <td class="Estilo2"><font face="serif" size="-1"><?php echo $dato5[$i]["nombres"];?></font></td>
          <td colspan="2" class="Estilo2"><font face="serif" size="-1"><?php echo $dato5[$i]["parentesco"];?></font></td>
          <td class="Estilo2"><font face="serif" size="-1"><?php echo $datos[$i]["fecha_nac"];?></font></td>
        </tr>
        <?php
}
?>
           <tr>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>  
        
         <?php
   $tr5=new User();
$dato6=$tr5->get_tabla_id("id_persona",$_GET["id"],"memos");   
   ?>
        
        <tr>
          <td><strong>Memos:</strong></td>
          <td colspan="2">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      <tr class="Estilo1"  >
        <td colspan="1">Memo</td>
        <td colspan="1">Fecha Memo</td>
          <td colspan="2">Observacion</td>
          
        </tr>
             <?php
for($i=0;$i<sizeof($dato6);$i++)
{
if ($i%2==0){  echo '<tr bgcolor="#F4F7EB" >';}
		else{    echo '<tr bgcolor="#F5E68E" >'; }
?>
          <td colspan="1" class="Estilo2"><font face="serif" size="-1"><font face="serif" size="-1">
		         <?php
		          
   $tr7=new User();
$dato7=$tr7->get_tabla_id("id_tipo_memo",$dato6[$i]["id_tipo_memo"],"tipo_memo");   
 		  echo $dato7[0]['memo'];
		  
		   ?></font></font></td>
           <td colspan="1" class="Estilo2"><font face="serif" size="-1">
           
		  
		  <?php echo $dato6[$i]["fecha_memo"];?>
      
           </font></td>
          <td colspan="2" class="Estilo2"><font face="serif" size="-1"><?php echo $dato6[$i]["observaciones"];?></font></td>
         
        </tr>
        <?php
}
?>
        
        <tr>
          <td></td>
          <td colspan="2">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
           <tr>
          <td></td>
          <td colspan="2"></td>
          <td></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td colspan="2">
          <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>" />
           <input type="button" name="button2" id="button2" value="--Salir--"onclick = "location='funcionarios.php'" />
          <input type="submit" name="button" id="button" value="Editar Informacion"/>
          
          </td>
          <td>&nbsp;</td>
        </tr>
      </tbody>
    </table>
    <p>&nbsp;</p>
</form>
<?  include("footer.php"); ?>