<!-- http://ProgramarEnPHP.wordpress.com -->
<?php require('menuadmin.php'); ?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link href="css/styles.css" rel="stylesheet" type="text/css">

<body>
<?php
   $tra=new User();
   $tr=new User();
   $td=new User();
    $t=new User();
$datos=$tra->get_tabla_id("id_persona",$_POST["id"],"persona");   
if(isset($_POST["grabar"]) and $_POST["grabar"]=="si")
{
	//print_r($datos);
   $tra->edit_funcionario();
   $tr->edit_contrato_funcionario();
   $t->edit_formacion_academica();
   $td->edit_requisitos();
   
   exit;
}
   ?>
    <form id="form1" name="form1" method="post" action="" accept-charset="UTF-8" enctype="multipart/form-data">
      <table width="900" border="0" align="center" bgcolor="#FFFFFF">
      <tbody>
        <tr>
          <td colspan="3" style="text-align: center">&nbsp;</td>
        </tr>
        <tr>
          <td style="text-align: center"><img src="imagenes/logo_camino.png" width="112" height="121" alt=""/></td>
          <td width="309" style="text-align: center; color: #2926F3;"><strong>FICHA PERSONAL</strong></td>
          <td style="text-align: center"><img src="<?php echo $datos[0]["foto"];?>" width="112" height="121" alt=""/>
          <input type="file" name="foto" id="foto" />
          <input type="hidden" value="<?php echo $datos[0]["foto"];?>" name="archivo">
          </td>
        </tr>
        <tr>
          <td width="310" style="text-align: right">Apellido Paterno:
          <input name="ap_paterno" type="text" id="ap_paterno" required="required" value="<?php echo $datos[0]["ap_paterno"];?>">          
          </strong></td>
          <td style="text-align: right">Apellido Materno:              
          <input name="ap_materno" type="text" required="required" id="ap_materno" value="<?php echo $datos[0]["ap_materno"];?>" />          
          </strong></td>
          <td width="267" style="text-align: right">Nombre:
              <input name="nombre" type="text" required="required" id="nombre" value="<?php echo $datos[0]["nombres"];?>" />
          </strong></td>
        </tr>
       
        <tr>
          <td style="text-align: right">Fecha Nac.:              
          <input name="fecha" type="date" id="fecha" value="<?php echo $datos[0]["fecha_nac"];?>"/>          
          </td>
          <td style="text-align: right">Provincia:              
          <input name="provincia" type="text" id="provincia" value="<?php echo $datos[0]["provincia"];?>" />          
          </td>
          <td style="text-align: right">Dpto.:              
          <input name="dpto" type="text" id="dpto" value="<?php echo $datos[0]["dpto"];?>" /></td>
        </tr>
       
        <tr>
          <td style="text-align: right"> CI.:
            <input name="ci" type="text" required="required" id="ci" value="<?php echo $datos[0]["ci"];?>" />
        </td>
          <td style="text-align: right">Nro Tel:
          <input name="tel" type="text" id="tel" value="<?php echo $datos[0]["telefono"];?>" size="12" /></td>
          <td style="text-align: right">Domicilio
              <input name="domicilio" type="text" id="domicilio" value="<?php echo $datos[0]["domicilio"];?>" />
          </td>
        </tr>
       
        <tr>
          <td style="text-align: right">Unidad
            <select name="id_unidad" required>
                
                <?php $tra=new User();
   			 $sup=$tra->get_tabla("unidad");
         ?>
                <?php
        for($i=0;$i<sizeof($sup);$i++)
        {
            ?>
                <option value="<?php echo $sup[$i]["id_unidad"];?>" title="<?php echo $sup[$i]["nombre_u"];?>"><?php echo $sup[$i]["nombre_u"];?></option>
                <?php
        }
        ?>
          </select></td>
          <td style="text-align: right">Nro. Cel:
              <input name="cel" type="text" id="cel" value="<?php echo $datos[0]["celular"];?>" size="12" />
          </td>
          <td style="text-align: right">Estado Civil:
              <input name="estado_civil" type="text" id="estado_civil" value="<?php echo $datos[0]["estado_civil"];?>" /></td>
        </tr>
        <tr>
          <td colspan="3" style="text-align: left"><h4><strong>FECHA DE INGRESO A LA INSTITUCION</strong></h4></td>
        </tr>
        <?php
          $tr=new User();
$dato=$tr->get_tabla_id("id_persona",$_POST["id"],"contratacion"); 
        ?>
        <tr>
          <td style="text-align: right">Nivel:<span style="text-align: left">
            <input name="nivel" type="text"  required="required" placeholder="Nivel" value="<?php echo $dato[0]["nivel"];?>" />
          </span></td>
          <td style="text-align: right">Cargo:<span style="text-align: left">
            <input name="cargo" type="text" size="22"  required="required" placeholder="Cargo" value="<?php echo $dato[0]["cargo"];?>" />
          </span></td>
          <td style="text-align: right"><span style="text-align: left">
            Fecha Ingreso:
            <input name="fecha_i" type="date"  placeholder="2015-01-01" value="<?php echo $dato[0]["fecha_ingreso"];?>" />
          </span></td>
        </tr>
        <tr>
          <td style="text-align: right">Fecha Retiro:<span style="text-align: left">
            <input name="fecha_r" type="date" placeholder="opsional" value="<?php echo $dato[0]["fecha_retiro"];?>" />
          </span></td>
          <td style="text-align: right">Reincorporacion:<span style="text-align: left">
            <input name="reincorporacion" type="text" size="22" placeholder="2015-01-01" value="<?php echo $dato[0]["fecha_reincorporacion"];?>"/>
          </span></td>
          <td style="text-align: right">A&ntildeos servicio:<span style="text-align: left">
            <input name="anho_ser" type="text" size="18" placeholder="anhos" value="<?php echo $dato[0]["a?os_servicio"];?>" />
          </span></td>
        </tr>
        <tr>
          <td colspan="3" style="text-align: right">Motivo de retiro: <span style="text-align: left">
            <input name="retiro_mot" type="text" size="80" placeholder="Observacion" value="<?php echo $dato[0]["motivo_retiro"];?>" />
          </span></td>
        </tr>
        <tr>
          <td colspan="3" style="text-align: left"><h4><strong>EDUCACION Y FORMACION ACADEMICA:</strong></h4></td>
        </tr>
        <?php
         $td=new User();
$dat=$td->get_tabla_id("id_persona",$_POST["id"],"formacion_academica"); 
?>
        <tr>
          <td colspan="3" style="text-align: right">Nivel Academico
          <input name="nive_academico" type="text"  required="required" id="nive_academico" placeholder="Nivel" size="80" value="<?php echo $dat[0]["nivel_academico"];?>" /></td>
        </tr>
        <tr>
          <td colspan="3" style="text-align: right">Profecion u Ocupacion
          <input name="profecion" type="text"  required="required" id="profecion" placeholder="Nivel" size="75" value="<?php echo $dat[0]["profecion_ocupacion"];?>" /></td>
        </tr><?php echo $_POST["id"];?>
        <tr>
          <td colspan="3" style="text-align: left"><h4>REQUISITOS:</h4></td>
        </tr>
                <?php
         $ts=new User();
$da=$ts->get_tabla_id("id_persona",$_POST["id"],"requisitos"); 
?>
        <tr>
          <td colspan="2" style="text-align: right">CURRICULUM VITAE DOCUMENTADO
          <input type="checkbox" name="CCTW1" value="SI" checked="checked" /></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" style="text-align: right">DECLARACION JURARDA DE BIENES Y RENTAS
          <input type="checkbox" name="CCTW2" value="SI" checked="checked" /></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" style="text-align: right">DECLARACION DE IMCOMPATIBILIDAD EN LA FUNCION PUBLICA
          <input type="checkbox" name="CCTW3"  value="SI" checked="checked" /></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" style="text-align: right">CERTIFICADO DE ANTECEDENTES PENALES REJAP
          <input type="checkbox" name="CCTW4" value="SI" checked="checked" /></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" style="text-align: right">LIBRETA DE SERVICIO  MILITAR
          <input type="checkbox" name="CCTW5" value="SI" checked="checked"/></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" style="text-align: right">PADRON BIOMETRICO ELECTORAL
          <input type="checkbox" name="CCTW6" value="SI" checked="checked" /></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" style="text-align: right">SEGURO CAJA DE SALUD
          <input type="checkbox" name="CCTW7" value="SI" checked="checked"/>
          
          </td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>SEXO:
            <label for="SEXO">:</label>
            <select name="SEXO" id="SEXO">
              <option value="M">Masculino</option>
              <option value="F">Femenino</option>
            </select></td>
          <td align="right">DIAS DE TRABAJO MES ACTUAL
            <span style="text-align: right">
            <input name="DIAS" type="text" id="DIAS" value="<?php echo $datos[0]["dias_pago"];?>" size="2" />
            </span></td>
          <td align="right">TIPO DE DESCUENTO:<span style="text-align: right">
            <input name="descuent" type="text" id="descuent" value="<?php echo $datos[0]["tipo_descuento"];?>" size="2" />
          </span></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>
          <input type="hidden" name="id" value="<?php echo $_POST["id"]; ?>" />
          <input type="hidden" name="grabar" value="si" />
          <input type="submit" name="button" id="button" value="Editar Funcionarios"/>
          
          </td>
          <td>&nbsp;</td>
        </tr>
      </tbody>
    </table>
     </form>
<?  include("footer.php"); ?>