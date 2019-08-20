<?php require('menuadmin.php'); ?>
<link href="css/styles.css" rel="stylesheet" type="text/css">
</head>

<body>
   <?php
$tra=new User();
if(isset($_POST["grabar"]) and $_POST["grabar"]=="si")
{
    $tra->add_funcionarios();
		
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
          <td rowspan="2" style="text-align: center"><img src="imagenes/logo_camino.png" width="112" height="121" alt=""/></td>
          <td width="309" height="81" style="text-align: center; color: #2926F3;"><strong>FICHA PERSONAL</strong></td>
          <td style="text-align: center">&nbsp;</td>
        </tr>
        <tr>
          <td height="37" colspan="2" style="text-align: center"><input name="foto" type="file" size="25" /></td>
        </tr>
        <tr>
          <td width="310" style="text-align: right">Apellido Paterno:
          <input name="ap_paterno" type="text" id="ap_paterno" required="required" >          
          </strong></td>
          <td style="text-align: right">Apellido Materno:              
          <input name="ap_materno" type="text" id="ap_materno" required="required" />          
          </strong></td>
          <td width="267" style="text-align: right">Nombre:
              <input name="nombre" type="text" id="nombre" required="required" />
          </strong></td>
        </tr>
       
        <tr>
          <td style="text-align: right">Fecha Nac.:              
          <input name="fecha" type="date" id="fecha" />          
          </td>
          <td style="text-align: right">Provincia:              
          <input name="provincia" type="text" id="provincia" />          
          </td>
          <td style="text-align: right">Dpto.:              
          <input name="dpto" type="text" id="dpto" /></td>
        </tr>
       
        <tr>
          <td style="text-align: right"> CI.:
            <input name="ci" type="text" id="ci" required="required" />
        </td>
          <td style="text-align: right">Nro Tel:
          <input name="tel" type="text" id="tel" size="12" /></td>
          <td style="text-align: right">Domicilio
              <input name="domicilio" type="text" id="domicilio" />
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
              <input name="cel" type="text" id="cel" size="12" />
          </td>
          <td style="text-align: right">Estado Civil:
              <input name="estado_civil" type="text" id="estado_civil" /></td>
        </tr>
        <tr>
          <td colspan="3" style="text-align: left"><h4><strong>FECHA DE INGRESO A LA INSTITUCION</strong></h4></td>
        </tr>
        <tr>
          <td style="text-align: right">Nivel:<span style="text-align: left">
            <input name="nivel" type="text"  required="required" placeholder="Nivel" />
          </span></td>
          <td style="text-align: right">Cargo:<span style="text-align: left">
            <input name="cargo" type="text" size="22"  required="required" placeholder="Cargo" />
          </span></td>
          <td style="text-align: right"><span style="text-align: left">
            Fecha Ingreso:
            <input name="fecha_i" type="date"  placeholder="2015-01-01"  value="<? echo  $fin    = date('Y-m-d'); ?>" />
          </span></td>
        </tr>
        <tr>
          <td style="text-align: right">Fecha Retiro:<span style="text-align: left">
            <input name="fecha_r" type="date" placeholder="opsional" />
          </span></td>
          <td style="text-align: right">Reincorporacion:<span style="text-align: left">
            <input name="reincorporacion" type="text" size="22" placeholder="2015-01-01" />
          </span></td>
          <td style="text-align: right">A&ntildeos servicio:<span style="text-align: left">
            <input name="anho_ser" type="text" size="18" placeholder="anhos" />
          </span></td>
        </tr>
        <tr>
          <td colspan="3" style="text-align: right">Motivo de retiro: <span style="text-align: left">
            <input name="retiro_mot" type="text" size="80" placeholder="Observacion" />
          </span></td>
        </tr>
        <tr>
          <td colspan="3" style="text-align: left"><h4><strong>EDUCACION Y FORMACION ACADEMICA:</strong></h4></td>
        </tr>
        <tr>
          <td colspan="3" style="text-align: right">Nivel Academico
          <input name="nive_academico" type="text"  required="required" id="nive_academico" placeholder="Nivel" size="80" /></td>
        </tr>
        <tr>
          <td colspan="3" style="text-align: right">Profecion u Ocupacion
          <input name="profecion" type="text"  required="required" id="profecion" placeholder="Nivel" size="75" /></td>
        </tr>
        <tr>
          <td colspan="3" style="text-align: left"><h4>REQUISITOS:</h4></td>
        </tr>
        <tr>
          <td colspan="2" style="text-align: right">CURRICULUM VITAE DOCUMENTADO
          <input type="checkbox" name="CCTW1" value="SI" /></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" style="text-align: right">DECLARACION JURARDA DE BIENES Y RENTAS
          <input type="checkbox" name="CCTW2" value="SI" /></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" style="text-align: right">DECLARACION DE IMCOMPATIBILIDAD EN LA FUNCION PUBLICA
          <input type="checkbox" name="CCTW3" value="SI" /></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" style="text-align: right">CERTIFICADO DE ANTECEDENTES PENALES REJAP
          <input type="checkbox" name="CCTW4" value="SI" /></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" style="text-align: right">LIBRETA DE SERVICIO  MILITAR
          <input type="checkbox" name="CCTW5" value="SI" /></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" style="text-align: right">PADRON BIOMETRICO ELECTORAL
          <input type="checkbox" name="CCTW6" value="SI" /></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" style="text-align: right">SEGURO CAJA DE SALUD
          <input type="checkbox" name="CCTW7" value="SI" /></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>SEXO:
            <label for="SEXO">:</label>
            <select name="SEXO" id="SEXO">
              <option value="M">Masculino</option>
              <option value="F">Femenino</option>
          </select></td>
          <td align="right">DIAS DE TRABAJO MES ACTUAL:</td>
          <td><input name="DIAS" type="text" id="DIAS" value="30" size="2" required="required" /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>
          <input type="hidden" name="grabar" value="si" />
          <input type="submit" name="button" id="button" value="Agregar Funcionarios"/>
          
          </td>
          <td>&nbsp;</td>
        </tr>
      </tbody>
    </table>
    <p>&nbsp;</p>
</form>
<?  include("footer.php"); ?>