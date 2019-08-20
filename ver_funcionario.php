<?php require('menuadmin.php'); ?>
<?php
   $tra=new User();
$datos=$tra->get_tabla_id("id_persona",$_GET["id"],"persona");   
   ?>
<meta name="generator" content="WYSIWYG Web Builder 10 - http://www.wysiwygwebbuilder.com">
<link href="VISTAS.css" rel="stylesheet" type="text/css">
<link href="index.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="imprimeme">
<table align="center" cellpadding="1" cellspacing="0" id="Table1">
<tr>
<td colspan="2" style="background-color:transparent;border:1px #C0C0C0 none;text-align:center;vertical-align:top;height:18px;"><img src="imagenes/sedcam.png" width="112" height="121" alt=""/></td>
<td width="258" style="background-color:transparent;border:1px #C0C0C0 none;text-align:center;vertical-align:top;width:256px;height:18px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"><strong><u>FICHA PERSONAL</u></strong></span></div>
</td>
<td width="252" style="background-color:transparent;border:1px #C0C0C0 none;text-align:center;vertical-align:top;height:18px;"><img src="<?php echo $datos[0]["foto"];?>" width="112" height="121" alt=""/></td>
</tr>
<tr>
<td colspan="4" style="background-color:transparent;border:1px #C0C0C0 solid;text-align:left;vertical-align:top;height:22px;"><div><span style="color:#000000;font-family:Arial;font-size:16px;">&nbsp;&nbsp; <strong><u>Datos Pesonales de Funcionario:</u></strong></span></div>
</td>
</tr>
<tr>
<td colspan="2" style="background-color:transparent;border-top-width:0px;border-right-width:0px;border-bottom-width:1px;border-left-width:0px;border-top-style:none;border-right-style:none;border-bottom-style:dashed;border-left-style:none;border-top-color:#FFFFFF;border-right-color:#FFFFFF;border-bottom-color:#808080;border-left-color:#FFFFFF;text-align:center;vertical-align:top;height:19px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"><?php echo $datos[0]["ap_paterno"];?></span></div>
</td>
<td style="background-color:transparent;border-top-width:0px;border-right-width:0px;border-bottom-width:1px;border-left-width:0px;border-top-style:none;border-right-style:none;border-bottom-style:dashed;border-left-style:none;border-top-color:#FFFFFF;border-right-color:#FFFFFF;border-bottom-color:#A9A9A9;border-left-color:#FFFFFF;text-align:center;vertical-align:top;width:256px;height:19px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"><?php echo $datos[0]["ap_materno"];?></span></div>
</td>
<td style="background-color:transparent;border-top-width:0px;border-right-width:0px;border-bottom-width:1px;border-left-width:0px;border-top-style:none;border-right-style:none;border-bottom-style:dashed;border-left-style:none;border-top-color:#FFFFFF;border-right-color:#FFFFFF;border-bottom-color:#A9A9A9;border-left-color:#FFFFFF;text-align:center;vertical-align:top;height:19px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"><?php echo $datos[0]["nombres"];?></span></div>
</td>
</tr>
<tr>
<td colspan="2" style="background-color:transparent;border:1px #C0C0C0 none;text-align:center;vertical-align:top;height:26px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Apellido Paterno</strong></span></div>
</td>
<td style="background-color:transparent;border:1px #C0C0C0 none;text-align:center;vertical-align:top;width:256px;height:26px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"> <strong>Apellido Materno</strong></span></div>
</td>
<td style="background-color:transparent;border:1px #C0C0C0 none;text-align:center;vertical-align:top;height:26px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Nombres</strong></span></div>
</td>
</tr>
<tr>
<td colspan="2" style="background-color:transparent;border-top-width:0px;border-right-width:0px;border-bottom-width:1px;border-left-width:1px;border-top-style:none;border-right-style:none;border-bottom-style:dashed;border-left-style:none;border-top-color:#FFFFFF;border-right-color:#FFFFFF;border-bottom-color:#A9A9A9;border-left-color:#A9A9A9;text-align:center;vertical-align:top;height:19px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"><?php echo $datos[0]["fecha_nac"];?></span></div>
</td>
<td style="background-color:transparent;border-top-width:0px;border-right-width:0px;border-bottom-width:1px;border-left-width:0px;border-top-style:none;border-right-style:none;border-bottom-style:dashed;border-left-style:none;border-top-color:#FFFFFF;border-right-color:#FFFFFF;border-bottom-color:#A9A9A9;border-left-color:#FFFFFF;text-align:center;vertical-align:top;width:256px;height:19px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"><?php echo $datos[0]["provincia"];?></span></div>
</td>
<td style="background-color:transparent;border-top-width:0px;border-right-width:0px;border-bottom-width:1px;border-left-width:1px;border-top-style:none;border-right-style:none;border-bottom-style:dashed;border-left-style:none;border-top-color:#FFFFFF;border-right-color:#FFFFFF;border-bottom-color:#A9A9A9;border-left-color:#A9A9A9;text-align:center;vertical-align:top;height:19px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"> <?php echo $datos[0]["dpto"];?></span></div>
</td>
</tr>
<tr>
<td colspan="2" style="background-color:transparent;border:1px #C0C0C0 none;text-align:center;vertical-align:top;height:26px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Fecha Nacimiento</strong></span></div>
</td>
<td style="background-color:transparent;border:1px #C0C0C0 none;text-align:center;vertical-align:top;width:256px;height:26px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Provincia</strong></span></div>
</td>
<td style="background-color:transparent;border:1px #C0C0C0 none;text-align:center;vertical-align:top;height:26px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Departamento</strong></span></div>
</td>
</tr>
<tr>
<td colspan="2" style="background-color:transparent;border-top-width:0px;border-right-width:0px;border-bottom-width:1px;border-left-width:0px;border-top-style:none;border-right-style:none;border-bottom-style:dashed;border-left-style:none;border-top-color:#FFFFFF;border-right-color:#FFFFFF;border-bottom-color:#A9A9A9;border-left-color:#FFFFFF;text-align:center;vertical-align:top;height:19px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"> <?php echo $datos[0]["ci"];?></span></div>
</td>
<td style="background-color:transparent;border-top-width:0px;border-right-width:0px;border-bottom-width:1px;border-left-width:0px;border-top-style:none;border-right-style:none;border-bottom-style:dashed;border-left-style:none;border-top-color:#FFFFFF;border-right-color:#FFFFFF;border-bottom-color:#A9A9A9;border-left-color:#FFFFFF;text-align:center;vertical-align:top;width:256px;height:19px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"> <?php echo $datos[0]["telefono"];?></span></div>
</td>
<td style="background-color:transparent;border-top-width:0px;border-right-width:0px;border-bottom-width:1px;border-left-width:0px;border-top-style:none;border-right-style:none;border-bottom-style:dashed;border-left-style:none;border-top-color:#FFFFFF;border-right-color:#FFFFFF;border-bottom-color:#A9A9A9;border-left-color:#FFFFFF;text-align:center;vertical-align:top;height:19px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"><?php echo $datos[0]["celular"];?></span></div>
</td>
</tr>
<tr>
<td colspan="2" style="background-color:transparent;border:1px #C0C0C0 none;text-align:center;vertical-align:top;height:28px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Cedula de Indentidad</strong></span></div>
</td>
<td style="background-color:transparent;border:1px #C0C0C0 none;text-align:center;vertical-align:top;width:256px;height:28px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Nro Telefonico</strong></span></div>
</td>
<td style="background-color:transparent;border:1px #C0C0C0 none;text-align:center;vertical-align:top;height:28px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Nro Celular</strong></span></div>
</td>
</tr>
<tr>
<td colspan="2" style="background-color:transparent;border-top-width:0px;border-right-width:0px;border-bottom-width:1px;border-left-width:0px;border-top-style:none;border-right-style:none;border-bottom-style:dashed;border-left-style:none;border-top-color:#FFFFFF;border-right-color:#FFFFFF;border-bottom-color:#808080;border-left-color:#808080;text-align:center;vertical-align:top;height:18px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;">
  <?php
   $tra2=new User();
$id2=$datos[0]["id_unidad"];
$datos2=$tra2->get_tabla_id("id_unidad",$id2,"unidad"); 
 echo $datos2[0]["nombre_u"];?>
</span></div>
</td>
<td style="background-color:transparent;border-top-width:0px;border-right-width:0px;border-bottom-width:1px;border-left-width:0px;border-top-style:none;border-right-style:none;border-bottom-style:dashed;border-left-style:none;border-top-color:#FFFFFF;border-right-color:#FFFFFF;border-bottom-color:#808080;border-left-color:#FFFFFF;text-align:center;vertical-align:top;width:256px;height:18px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"><?php echo $datos[0]["estado_civil"];?></span></div>
</td>
<td style="background-color:transparent;border-top-width:0px;border-right-width:0px;border-bottom-width:1px;border-left-width:0px;border-top-style:none;border-right-style:none;border-bottom-style:dashed;border-left-style:none;border-top-color:#FFFFFF;border-right-color:#FFFFFF;border-bottom-color:#808080;border-left-color:#808080;text-align:center;vertical-align:top;height:18px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"><?php echo $datos[0]["domicilio"];?></span></div>
</td>
</tr>
<tr>
<td colspan="2" style="background-color:transparent;border:1px #C0C0C0 none;text-align:center;vertical-align:top;height:36px;"><div><strong><span style="font-family: Arial; font-size: 13px; color: #000000">Unidad</span></strong></div>
</td>
<td style="background-color:transparent;border:1px #C0C0C0 none;text-align:center;vertical-align:top;width:256px;height:36px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Estado Civil</strong></span></div>
</td>
<td style="background-color:transparent;border:1px #C0C0C0 none;text-align:center;vertical-align:top;height:36px;"><div><strong><span style="font-family: Arial; font-size: 13px; color: #000000">Domicilio</span></strong></div>
</td>
</tr>
        <?php
   $tr=new User();
$dato2=$tr->get_tabla_id("id_persona",$_GET["id"],"contratacion");   
   ?>
<tr>
<td colspan="4" style="background-color:transparent;border:1px #C0C0C0 solid;text-align:left;vertical-align:top;height:22px;"><div><span style="color:#000000;font-family:Arial;font-size:16px;">&nbsp;&nbsp; <strong><u>Fecha de Ingreso a la Institucion:</u></strong></span></div>
</td>
</tr>
<tr>
<td colspan="2" style="background-color:transparent;border-top-width:0px;border-right-width:0px;border-bottom-width:1px;border-left-width:0px;border-top-style:none;border-right-style:none;border-bottom-style:dashed;border-left-style:dashed;border-top-color:#FFFFFF;border-right-color:#FFFFFF;border-bottom-color:#808080;border-left-color:#FFFFFF;text-align:center;vertical-align:top;height:19px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"><?php echo $dato2[0]["nivel"];?></span></div>
</td>
<td style="background-color:transparent;border-top-width:0px;border-right-width:0px;border-bottom-width:1px;border-left-width:0px;border-top-style:none;border-right-style:none;border-bottom-style:dashed;border-left-style:none;border-top-color:#FFFFFF;border-right-color:#FFFFFF;border-bottom-color:#808080;border-left-color:#FFFFFF;text-align:center;vertical-align:top;width:256px;height:19px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"><?php echo $dato2[0]["cargo"];?>:</span></div>
</td>
<td style="background-color:transparent;border-top-width:0px;border-right-width:0px;border-bottom-width:1px;border-left-width:0px;border-top-style:none;border-right-style:none;border-bottom-style:dashed;border-left-style:none;border-top-color:#FFFFFF;border-right-color:#FFFFFF;border-bottom-color:#808080;border-left-color:#FFFFFF;text-align:center;vertical-align:top;height:19px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;">
 <?php
   $tra2=new User();
$id2=$datos[0]["id_horario"];
$datos2=$tra2->get_tabla_id("id_horario",$id2,"horarios"); 
 echo $datos2[0]["nom_horario"];?></span></div>
</td>
</tr>
<tr>
<td colspan="2" style="background-color:transparent;border:1px #C0C0C0 none;text-align:center;vertical-align:top;height:18px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"> <strong>Nivel</strong></span></div>
</td>
<td style="background-color:transparent;border:1px #C0C0C0 none;text-align:center;vertical-align:top;width:256px;height:18px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;">&nbsp; <strong>Cargo</strong></span></div>
</td>
<td style="background-color:transparent;border:1px #C0C0C0 none;text-align:center;vertical-align:top;height:18px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;">&nbsp; <strong>Horario</strong></span></div>
</td>
</tr>
<tr>
<td colspan="2" style="background-color:transparent;border-top-width:0px;border-right-width:0px;border-bottom-width:1px;border-left-width:0px;border-top-style:none;border-right-style:none;border-bottom-style:dashed;border-left-style:none;border-top-color:#FFFFFF;border-right-color:#FFFFFF;border-bottom-color:#808080;border-left-color:#FFFFFF;text-align:center;vertical-align:top;height:19px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;">
 <?php
echo $datos[0]["cod_maquinas"];
?>
</span></div>
</td>
<td style="background-color:transparent;border-top-width:0px;border-right-width:0px;border-bottom-width:1px;border-left-width:0px;border-top-style:none;border-right-style:none;border-bottom-style:dashed;border-left-style:none;border-top-color:#FFFFFF;border-right-color:#FFFFFF;border-bottom-color:#A9A9A9;border-left-color:#FFFFFF;text-align:center;vertical-align:top;width:256px;height:19px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"><?php echo $dato2[0]["fecha_ingreso"];?></span></div>
</td>
<td style="background-color:transparent;border-top-width:0px;border-right-width:0px;border-bottom-width:1px;border-left-width:0px;border-top-style:none;border-right-style:none;border-bottom-style:dashed;border-left-style:none;border-top-color:#FFFFFF;border-right-color:#FFFFFF;border-bottom-color:#808080;border-left-color:#808080;text-align:center;vertical-align:top;height:19px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"><?php echo $dato2[0]["fecha_retiro"];?></span></div>
</td>
</tr>
<tr>
<td colspan="2" style="background-color:transparent;border:1px #C0C0C0 none;text-align:center;vertical-align:top;height:18px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;">&nbsp;<strong>Maquinarias</strong></span></div>
</td>
<td style="background-color:transparent;border:1px #C0C0C0 none;text-align:center;vertical-align:top;width:256px;height:18px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"> <strong>Fecha Ingreso</strong></span></div>
</td>
<td style="background-color:transparent;border:1px #C0C0C0 none;text-align:center;vertical-align:top;height:18px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;">&nbsp; <strong>Fecha Retiro</strong></span></div>
</td>
</tr>
<tr>
<td colspan="2" style="background-color:transparent;border-top-width:0px;border-right-width:0px;border-bottom-width:1px;border-left-width:0px;border-top-style:none;border-right-style:none;border-bottom-style:dashed;border-left-style:none;border-top-color:#FFFFFF;border-right-color:#FFFFFF;border-bottom-color:#808080;border-left-color:#FFFFFF;text-align:center;vertical-align:top;height:19px;"><span style="color:#000000;font-family:Arial;font-size:13px;"><?php echo $dato2[0]["fecha_reincorporacion"];?></span></td>
<td style="background-color:transparent;border-top-width:0px;border-right-width:0px;border-bottom-width:1px;border-left-width:0px;border-top-style:none;border-right-style:none;border-bottom-style:dashed;border-left-style:none;border-top-color:#FFFFFF;border-right-color:#FFFFFF;border-bottom-color:#A9A9A9;border-left-color:#FFFFFF;text-align:center;vertical-align:top;width:256px;height:19px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"><?php echo $dato2[0]["a&ntilde;os_servicio"];?></span></div>
</td>
<td style="background-color:transparent;border-top-width:0px;border-right-width:0px;border-bottom-width:1px;border-left-width:0px;border-top-style:none;border-right-style:none;border-bottom-style:dashed;border-left-style:none;border-top-color:#FFFFFF;border-right-color:#FFFFFF;border-bottom-color:#A9A9A9;border-left-color:#FFFFFF;text-align:center;vertical-align:top;width:256px;height:19px;"><div><span style="background-color:transparent;border-top-width:0px;border-right-width:0px;border-bottom-width:1px;border-left-width:0px;border-top-style:none;border-right-style:none;border-bottom-style:dashed;border-left-style:none;border-top-color:#FFFFFF;border-right-color:#FFFFFF;border-bottom-color:#808080;border-left-color:#FFFFFF;text-align:center;vertical-align:top;height:19px;"><?php echo $dato2[0]["motivo_retiro"];?></span></div>
</td>
</tr>
<tr>
<td colspan="2" style="background-color:transparent;border:1px #C0C0C0 none;text-align:center;vertical-align:top;height:28px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Fecha Reincorporacion</strong></span></div>
</td>
<td colspan="1" style="background-color:transparent;border:1px #C0C0C0 none;text-align:center;vertical-align:top;height:28px;"><div><strong><span style="font-family: Arial; font-size: 13px; color: #000000">A&ntilde;os de Servicio</span></strong></div>
</td>
<td colspan="1" style="background-color:transparent;border:1px #C0C0C0 none;text-align:center;vertical-align:top;height:28px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Motivo Retiro</strong></span></div>
</td>
</tr>
              <?php
   $tr2=new User();
$dato3=$tr2->get_tabla_id("id_persona",$_GET["id"],"formacion_academica");   
   ?>

<tr>
<td colspan="4" style="background-color:transparent;border:1px #C0C0C0 solid;text-align:left;vertical-align:top;height:22px;"><div><span style="color:#000000;font-family:Arial;font-size:16px;"><strong>&nbsp; <u>Educacion y Formacion Academica:</u></strong></span></div>
</td>
</tr>
<tr>
<td colspan="2" style="background-color:transparent;border:1px #C0C0C0 none;text-align:left;vertical-align:top;height:22px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"> <strong>Nivel Academico:</strong></span></div>
</td>
<td colspan="2" style="background-color:transparent;border:1px #C0C0C0 none;text-align:left;vertical-align:top;height:22px;"><div><span style="color:#000000;font-family:Arial;font-size:16px;"> </span><span style="color:#000000;font-family:Arial;font-size:13px;"> <?php echo $dato3[0]["nivel_academico"];?></span></div>
</td>
</tr>
<tr>
<td colspan="2" style="background-color:transparent;border:1px #C0C0C0 none;text-align:left;vertical-align:top;height:20px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"><strong> Profecion u Ocupacion:</strong></span></div>
</td>
<td colspan="2" style="background-color:transparent;border:1px #C0C0C0 none;text-align:left;vertical-align:top;height:20px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"> <?php echo $dato3[0]["profecion_ocupacion"];?></span></div>
</td>
</tr>
 <?php
   $tr3=new User();
$dato4=$tr3->get_tabla_id("id_persona",$_GET["id"],"requisitos");   
   ?>
<tr>
<td colspan="4" style="background-color:transparent;border:1px #C0C0C0 solid;text-align:left;vertical-align:top;height:22px;"><div><span style="color:#000000;font-family:Arial;font-size:16px;">&nbsp;&nbsp; <strong>Requisitos:</strong></span></div>
</td>
</tr>

<tr>
  <td colspan="3" style="background-color:transparent;border:1px #C0C0C0 none;text-align: right;vertical-align:top;height:22px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"> <strong>CURRICULUM VITAE DOCUMENTADO:</strong></span></div>
  </td>
  <td style="background-color:transparent;border:1px #C0C0C0 none;text-align:left;vertical-align:top;height:20px;"><span class="Estilo2"><?php echo $dato4[0]["curriculun"];?></span></td>
</tr>
<tr>
  <td colspan="3" style="background-color:transparent;border:1px #C0C0C0 none;text-align: right;vertical-align:top;height:22px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"> <strong>DECLARACION JURARDA DE BIENES Y RENTAS: </strong></span></div></td>
  <td style="background-color:transparent;border:1px #C0C0C0 none;text-align:left;vertical-align:top;height:20px;"><span class="Estilo2"><?php echo $dato4[0]["declaracion_j"];?></span></td>
</tr>
<tr>
  <td colspan="3" style="background-color:transparent;border:1px #C0C0C0 none;text-align: right;vertical-align:top;height:22px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"> <strong>DECLARACION DE IMCOMPATIBILIDAD EN LA FUNCION PUBLICA:</strong></span></div></td>
  <td style="background-color:transparent;border:1px #C0C0C0 none;text-align:left;vertical-align:top;height:20px;"><span class="Estilo2"><?php echo $dato4[0]["declaracion_imcompatibilidad"];?></span></td>
</tr>
<tr>
  <td colspan="3" style="background-color:transparent;border:1px #C0C0C0 none;text-align: right;vertical-align:top;height:22px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"> <strong>CERTIFICADO DE ANTECEDENTES PENALES:</strong></span></div></td>
  <td style="background-color:transparent;border:1px #C0C0C0 none;text-align:left;vertical-align:top;height:20px;"><span class="Estilo2"><?php echo $dato4[0]["certificado_antecedentes"];?></span></td>
</tr>
<tr>
  <td colspan="3" style="background-color:transparent;border:1px #C0C0C0 none;text-align: right;vertical-align:top;height:22px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"> <strong>LIBRETA DE SERVICIO MILITAR:</strong></span></div></td>
  <td style="background-color:transparent;border:1px #C0C0C0 none;text-align:left;vertical-align:top;height:20px;"><span class="Estilo2"><?php echo $dato4[0]["libreta_servicio_militar"];?></span></td>
</tr>
<tr>
  <td colspan="3" style="background-color:transparent;border:1px #C0C0C0 none;text-align: right;vertical-align:top;height:22px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"> <strong>PADRON BIOMETRICO ELECTORAL:</strong></span></div></td>
  <td style="background-color:transparent;border:1px #C0C0C0 none;text-align:left;vertical-align:top;height:20px;"><span class="Estilo2"><?php echo $dato4[0]["patron_bio_elec"];?></span></td>
</tr>
<tr>
  <td colspan="3" style="background-color:transparent;border:1px #C0C0C0 none;text-align: right;vertical-align:top;height:22px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"> <strong>SEGURO CAJA DE SALUD:</strong></span></div></td>
  <td style="background-color:transparent;border:1px #C0C0C0 none;text-align:left;vertical-align:top;height:20px;"><span class="Estilo2"><?php echo $dato4[0]["seguro_caja_salud"];?></span></td>
</tr>
<tr>
  <td height="641" colspan="4" style="background-color:transparent;border:1px #C0C0C0 solid;text-align:left;vertical-align:top;height:22px;"><div><span style="color:#000000;font-family:Arial;font-size:16px;"><strong>&nbsp; <u>Familiares:</u></strong></span></div>
  </td>
</tr>
 <?php
   $tr4=new User();
$dato5=$tr4->get_tabla_id("id_persona",$_GET["id"],"familiares");   
   ?>
<tr>
<td colspan="2" style="background-color:transparent;border:1px #C0C0C0 solid;text-align:center;vertical-align:top;height:18px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"><strong> Nombres</strong></span></div>
</td>
<td style="background-color:transparent;border:1px #C0C0C0 solid;text-align:center;vertical-align:top;width:256px;height:18px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"> <strong>Parentesco</strong> </span></div>
</td>
<td style="background-color:transparent;border:1px #C0C0C0 solid;text-align:center;vertical-align:top;height:18px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"><strong> Fecha Nacimiento</strong></span></div>
</td>
</tr>
 <?php
for($i=0;$i<sizeof($dato5);$i++)
{
if ($i%2==0){  echo '<tr bgcolor="#F4F7EB" >';}
		else{    echo '<tr bgcolor="#F5E68E" >'; }
?>
<tr>
<td colspan="2" style="background-color:transparent;border:1px #C0C0C0 solid;text-align:center;vertical-align:top;height:18px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"> <?php echo $dato5[$i]["nombres"];?></span></div>
</td>
<td style="background-color:transparent;border:1px #C0C0C0 solid;text-align:center;vertical-align:top;width:256px;height:18px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"> <?php echo $dato5[$i]["parentesco"];?></span></div>
</td>
<td style="background-color:transparent;border:1px #C0C0C0 solid;text-align:center;vertical-align:top;height:18px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"> <?php echo $datos[$i]["fecha_nac"];?></span></div>
</td>
</tr>
        <?php
}
?>
<tr>
<td colspan="4" style="background-color:transparent;border:1px #C0C0C0 solid;text-align:left;vertical-align:top;height:18px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"><strong>&nbsp; <u>Memos:</u></strong></span></div>
</td>
</tr>
<tr>
<td width="130" style="background-color:transparent;border:1px #C0C0C0 solid;text-align:center;vertical-align:top;width:128px;height:20px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Nro. Memo</strong></span></div>
</td>
<td width="130" style="background-color:transparent;border:1px #C0C0C0 solid;text-align:center;vertical-align:top;width:128px;height:20px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Fecha</strong></span></div>
</td>
<td style="background-color:transparent;border:1px #C0C0C0 solid;text-align:center;vertical-align:top;width:256px;height:20px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Memos</strong></span></div>
</td>
<td style="background-color:transparent;border:1px #C0C0C0 solid;text-align:center;vertical-align:top;height:20px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"><strong>Observacion</strong></span></div>
</td>
</tr>
     <?php
   $tr5=new User();
$dato6=$tr5->get_tabla_id("id_persona",$_GET["id"],"memos");   
   ?>
     <?php
for($i=0;$i<sizeof($dato6);$i++)
{
if ($i%2==0){  echo '<tr bgcolor="#F4F7EB" >';}
		else{    echo '<tr bgcolor="#F5E68E" >'; }
?>
<tr>
<td style="background-color:transparent;border:1px #C0C0C0 solid;text-align:center;vertical-align:top;width:128px;height:18px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"><?php echo $dato6[$i]["nro_memo"];?></span></div>
</td>
<td style="background-color:transparent;border:1px #C0C0C0 solid;text-align:center;vertical-align:top;width:128px;height:18px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"> <?php echo $dato6[$i]["fecha_memo"];?></span></div>
</td>
<td style="background-color:transparent;border:1px #C0C0C0 solid;text-align:center;vertical-align:top;width:256px;height:18px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;">  <?php
		          
   $tr7=new User();
$dato7=$tr7->get_tabla_id("id_tipo_memo",$dato6[$i]["id_tipo_memo"],"tipo_memo");   
 		  echo $dato7[0]['memo'];
		  
		   ?></span></div>
</td>
<td style="background-color:transparent;border:1px #C0C0C0 solid;text-align:center;vertical-align:top;height:18px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"> <?php echo $dato6[$i]["observaciones"];?></span></div>
</td>
</tr>
        <?php
}
?>
</table>
</div>
<table align="center">
<tr>
<td>
  
  <input type="button" name="Volver" id="button2" value="--Salir--" onclick = "location='funcionarios.php'" />
  <input type="button" name="imprimir" value="Imprimir" onclick="imprimir();"/>
  
    <?php
if($nom[0]["nombres"]==$admin){
?>
  <form id="form1" name="form1" method="post" action="edit_funcionario.php" accept-charset="UTF-8" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>" />
  <input type="submit" name="button" id="button" value="Editar Informacion"/> 
<?php
}else{
?>	

<?php
	}
?>
   
</td>
</tr>
</table>
</form>
</body>
</html>