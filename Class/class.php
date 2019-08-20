<?php
session_start();
class User
{
    private $dbh;
	private $nombre;
	private $productos;
	private $caja;
    public function __construct()
    {
        $this->dbh=new PDO('mysql:host=localhost;dbname=db_asistencia',"root",'admin');
        $this->nombre=array();
	    $this->productos=array();
		$this->caja=array();
    }
    public function set_names()
    {
        return $this->dbh->query("SET NAMES 'utf8'");    
    }	
public function loguear(){
		 $user=$_POST["user"];
		 $pass_php=sha1($_POST["pass"]);
		 $sql="select * from usuario where usuario =? and password = ?
		 ";
		 $stmt=$this->dbh->prepare($sql);
		 //echo $user."----".$pass_php;		
		 $stmt->bindParam(1, $user);
         $stmt->bindParam(2, $pass_php);
         $stmt->execute();
         //si hay un resultado en la consulta creamos las sesiones
         if ($stmt->rowCount() == 0) {
			 echo"<script type='text/javascript'>
			alert('Los datos ingresados no existen en la base de datos');
			window.location='index.php';
			</script>";
           
          }else{
			 while($fila = $stmt->fetch((PDO::FETCH_ASSOC)))
            {
				
                    $_SESSION["ses_user"]=$fila["id_persona"];
                    header("Location: home.php");
						
            }
        }}
//-----------------------------------saluda usuario----------------------------------
public function saluda_al_usuario($id_admin)
	{ self::set_names();
		$sql="select * from persona where id_persona=$id_admin";		
        foreach ($this->dbh->query($sql) as $row)
    		{
    			$this->nombre[]=$row;
    		}  
            return $this->nombre;
			$this->dbh=null;            
	}
//___________________________________GET TABLA ID ASC________________________________
public function get_tabla_asc($tabla,$id)
    {
        self::set_names();
        $sql="select * from $tabla order by $id  DESC ;";
        foreach($this->dbh->query($sql) as $row)
        {
            $this->super2[]=$row;
        }
        return $this->super2;
        $this->dbh=null;
    }
	
//***********************************GET PERMISOS***************************************
public function get_permisos()
    {
        self::set_names();
        $sql="SELECT p.id_persona as ID, p.nombres as NOMBRE , p.ap_paterno AS PATERNO, p.ap_materno AS MATERNO, p.id_unidad AS UNIDAD, v.id_persona AS ID2, v.inicio_periodo AS INICIO, v.fin_periodo AS FIN, v.detalles AS DETALLES
FROM  persona p, vacaciones v
WHERE p.id_persona = v.id_persona
AND v.detalles != 'Asistencia'
ORDER BY p.nombres;";
        foreach($this->dbh->query($sql) as $row)
        {
            $this->super2[]=$row;
        }
        return $this->super2;
        $this->dbh=null;
		
    }
//***********************************GET TABLA***************************************
public function get_tabla($tabla)
    {
		self::set_names();
        $sql="select * from $tabla ;";
        foreach($this->dbh->query($sql) as $row)
        {
            $this->super2[]=$row;
        }
        return $this->super2;
        $this->dbh=null;	
    }
	//***********************************GET TABLA CAMPAMENTO***************************************
public function get_tabla_cam($tabla)
    {
		self::set_names();
        $sql="select * from $tabla ;";
        foreach($this->dbh->query($sql) as $row)
        {
            $this->super2[]=$row;
        }
        return $this->super2;
        $this->dbh=null;	
    }
	//***********************************GET CAMPAMENTO*************************************
public function get_campamento()
    { 
	     self::set_names();
		//___________________________________
		 if(isset($_GET["s"]))
        {
                 $sql="select * from persona where id_campamento=? ";
            $stmt=$this->dbh->prepare($sql);
            if($stmt->execute( array($_GET["s"]) ) )
            {
                while($row = $stmt->fetch())
                {
                    $this->productos[]=$row;
                }
                return $this->productos;
                $this->dbh=null;
            }			
		}
		else{       
        $sql="select * from persona WHERE id_campamento >= 2;";
        foreach($this->dbh->query($sql) as $row)
        {
            $this->super2[]=$row;
        }
        return $this->super2;
        $this->dbh=null;
		}
    }
	//***********************************GET PERSONA***************************************
public function get_persona($u)
    {
		$nom=$this->saluda_al_usuario($_SESSION["ses_user"]);
        self::set_names();		
if($nom[0]["nombres"]=="admin" or $nom[0]["nombres"]=="Radio"){
   $sql="select * from persona;";
}else{	$sql="select * from persona where id_unidad= $u ;";	}
        foreach($this->dbh->query($sql) as $row)
        {
            $this->super2[]=$row;
        }
        return $this->super2;
        $this->dbh=null;
    }
//************************************GET TABLA**************************************
public function get_tabla_lim($tabla,$emp, $mos)
    {
        self::set_names();
        $sql="select * from $tabla limit $emp, $mos ;";
        foreach($this->dbh->query($sql) as $row)
        {
            $this->super2[]=$row;
        }
        return $this->super2;
        $this->dbh=null;
    }
	//************************************GET TABLA**************************************
public function get_tabla_lim_unicas($tabla,$cam,$emp, $mos)
    {
        self::set_names();
       $sql="select * from $tabla GROUP BY '$cam' limit $emp, $mos ;";
        foreach($this->dbh->query($sql) as $row)
        {
            $this->super2[]=$row;
        }
        return $this->super2;
        $this->dbh=null;
    }
//***********************************GET TABLA ID************************************
public function get_tabla_id($nom_id,$id,$tabla)
    {
        if(isset($id))
        {
            self::set_names();
            $sql="select *
             from $tabla 
            where
            $nom_id=?
             ";
			// echo $sql."--".$id;
            $stmt=$this->dbh->prepare($sql);
            if($stmt->execute( array($id))){
				 while($row = $stmt->fetch())
                {
                    $this->productos[]=$row;
                }
                return $this->productos;
                $this->dbh=null;
            }
        }else
        {
            echo"<script type='text/javascript'>
			alert('Registro Agregado');
			window.location='inicio.php';
			</script>";
        }
    }
	//***********************************GET TABLA ID************************************
public function get_tabla_id2($nom_id,$id,$tabla)
    {
        if(isset($id))
        {
            self::set_names();
            $sql="select *
             from $tabla 
            where
            $nom_id=?
             ";
			// echo $sql."--".$id;
            $stmt=$this->dbh->prepare($sql);
            if($stmt->execute( array($id))){
				 while($row = $stmt->fetch())
                {
                 $this->productos[]=$row;
                }
                return $this->productos;
                $this->dbh=null;
            }
        }else
        {
            echo"<script type='text/javascript'>
			alert('Registro Agregado');
			window.location='inicio.php';
			</script>";
        }
    }
	//***********************************GET TABLA ID************************************
public function get_tabla_id_desc($nom_id,$id,$tabla)
    {
        if(isset($id))
        {
            self::set_names();
            $sql="select *
             from $tabla 
            where
            $nom_id=? ORDER BY id_maquinas DESC
             ";
			// echo $sql."--".$id;
            $stmt=$this->dbh->prepare($sql);
            if($stmt->execute( array($id))){
				 while($row = $stmt->fetch())
                {
                    $this->productos[]=$row;
                }
                return $this->productos;
                $this->dbh=null;
            }
        }else
        {
            echo"<script type='text/javascript'>
			alert('no ha seleccionado un producto');
			window.location='inicio.php';
			</script>";
        }
    }
//***********************************ELIMINAR ID*************************************
public function delete_var($id,$primari,$tabla){
					 self::set_names();
    $sql="DELETE FROM $tabla WHERE $primari=?;";
		//echo $sql;
        $stmt=$this->dbh->prepare($sql);
	    $stmt->bindValue(1,$id,PDO::PARAM_INT);
        $stmt->execute();
        $this->dbh=null;
         header("Location:inicio.php");	
			}	
//___________________________________GET BIOMETRICO__________________________________			
public function get_biometrico($emp, $mos)
    {
        self::set_names();
        //$sql="select * from biometrico ORDER BY fecha DESC limit $emp, $mos ;";
       $sql="SELECT p.id_persona AS NRO, p.nombres AS NOMBRE, p.ap_paterno AS PATERNO, p.ap_materno AS MATERNO, p.id_unidad, b.fecha AS FECHA, b.hora AS HORA, b.observacion AS OBSERVACION, u.nombre_u AS UNIDAD
			 FROM
			 biometrico b, persona p, unidad u
			 where
 			b.nro = p.id_persona and p.id_unidad =  u.id_unidad
			ORDER BY b.fecha DESC limit $emp, $mos";
		foreach($this->dbh->query($sql) as $row)
        {
            $this->super2[]=$row;
        }
        return $this->super2;
        $this->dbh=null;
    }
//___________________________________GET BIOMETRICO__________________________________			
public function get_biometrico_user($u,$emp, $mos)
    {
        self::set_names();
        //$sql="select * from biometrico ORDER BY fecha DESC limit $emp, $mos ;";
       $sql="SELECT p.id_persona AS NRO, p.nombres AS NOMBRE, p.ap_paterno AS PATERNO, p.ap_materno AS MATERNO, p.id_unidad, b.fecha AS FECHA, b.hora AS HORA, b.observacion AS OBSERVACION, u.nombre_u AS UNIDAD
			 FROM
			 biometrico b, persona p, unidad u
			 where
 			b.nro = p.id_persona and p.id_unidad =  u.id_unidad and p.id_unidad= '$u'
			ORDER BY b.fecha DESC limit $emp, $mos";
		foreach($this->dbh->query($sql) as $row)
        {
            $this->super2[]=$row;
        }
        return $this->super2;
        $this->dbh=null;
    }

//___________________________________GET BIOMTRICO DISTIN____________________________
public function get_biometrico_dist($emp, $mos)
    {
        self::set_names();
       // $sql="select DISTINCT nombres from biometrico limit $emp, $mos;";
		$sql="SELECT p.id_persona AS NRO, p.nombres AS NOMBRE, p.ap_paterno AS PATERNO, p.ap_materno AS MATERNO, p.id_unidad, b.fecha AS FECHA, b.hora AS HORA, b.observacion AS OBSERVACION, u.nombre_u AS UNIDAD
			 FROM
			 biometrico b, persona p, unidad u
			 where
 			b.nro = p.id_persona and p.id_unidad =  u.id_unidad group by b.nombres limit $emp, $mos";
        foreach($this->dbh->query($sql) as $row)
        {
            $this->super2[]=$row;
        }
        return $this->super2;
        $this->dbh=null;
    }
	//___________________________________GET BIOMTRICO DISTIN____________________________
public function get_biometrico_dist_per($emp, $mos)
    {
        self::set_names();
       // $sql="select DISTINCT nombres from biometrico limit $emp, $mos;";
		$sql="SELECT p.id_persona, p.nombres AS NOMBRE, p.ap_paterno AS PATERNO, p.ap_materno AS MATERNO, u.nombre_u AS UNIDAD from boletas_salida b, persona p, unidad u WHERE p.id_persona=b.nro and p.id_unidad=u.id_unidad GROUP BY b.nro limit $emp, $mos";
        foreach($this->dbh->query($sql) as $row)
        {
            $this->super2[]=$row;
        }
        return $this->super2;
        $this->dbh=null;
    }
	//___________________________________GET BIOMTRICO DISTIN_USER____________________________
public function get_biometrico_dist_user($u,$emp, $mos)
    {
        self::set_names();
       // $sql="select DISTINCT nombres from biometrico limit $emp, $mos;";
		$sql="SELECT p.id_persona AS NRO, p.nombres AS NOMBRE, p.ap_paterno AS PATERNO, p.ap_materno AS MATERNO, p.id_unidad, b.fecha AS FECHA, b.hora AS HORA, b.observacion AS OBSERVACION, u.nombre_u AS UNIDAD
			 FROM
			 biometrico b, persona p, unidad u
			 where
 			b.nro = p.id_persona and p.id_unidad =  u.id_unidad and p.id_unidad= '$u' group by b.nro limit $emp, $mos";
        foreach($this->dbh->query($sql) as $row)
        {
            $this->super2[]=$row;
        }
        return $this->super2;
        $this->dbh=null;
    }
	
//_______________________________GET BIOMTRICO DISTIN BOLETAS SALIDAS____________
public function get_biometrico_dist_salidas($emp, $mos)
    {
        self::set_names();
       // $sql="select DISTINCT nombres from biometrico limit $emp, $mos;";
		$sql="select nombres, fecha, hora, dpto, nro from boletas_salida group by nombres limit $emp, $mos";
        foreach($this->dbh->query($sql) as $row)
        {
            $this->super2[]=$row;
        }
        return $this->super2;
        $this->dbh=null;
    }
//____________________________________GET BIOMETRICO DISTIN 2________________________
public function get_biometrico_dist2($emp, $mos)
    {
        self::set_names();
		$sql="SELECT p.id_persona AS NRO, p.nombres AS NOMBRE, p.ap_paterno AS PATERNO, p.ap_materno AS MATERNO, p.id_unidad, b.fecha AS FECHA, b.hora AS HORA, b.observacion AS OBSERVACION, u.nombre_u AS UNIDAD, sum(b.observacion='F3') AS FALTAS, sum(b.observacion='F1') AS ATRASO, 
		sum(b.observacion='F2') AS ATRASOS, 
		sum(b.observacion='A') AS ASISTENCIAS,
		sum(b.observacion='P') AS PERMISOS,
		 count(b.observacion) AS TOTALDIAS
		 FROM biometrico b, persona p, unidad u where b.nro = p.id_persona and p.id_unidad = u.id_unidad group by b.nro limit $emp, $mos";

        foreach($this->dbh->query($sql) as $row)
        {
            $this->super2[]=$row;
        }
        return $this->super2;
        $this->dbh=null;
    }	
	//____________________________________GET BIOMETRICO DISTIN 2 USER________________________
public function get_biometrico_dist2_user($u, $emp, $mos)
    {
        self::set_names();
		$sql="SELECT p.id_persona AS NRO, p.nombres AS NOMBRE, p.ap_paterno AS PATERNO, p.ap_materno AS MATERNO, p.id_unidad, b.fecha AS FECHA, b.hora AS HORA, b.observacion AS OBSERVACION, u.nombre_u AS UNIDAD, sum(b.observacion='F3') AS FALTAS, sum(b.observacion='F1') AS ATRASO, sum(b.observacion='F2') AS ATRASOS, 
		sum(b.observacion='A') AS ASISTENCIAS,
		sum(b.observacion='P') AS PERMISOS, 
		count(b.observacion) AS TOTALDIAS FROM biometrico b, persona p, unidad u where b.nro = p.id_persona and p.id_unidad = u.id_unidad AND p.id_unidad= '$u' group by b.nro limit $emp, $mos";

        foreach($this->dbh->query($sql) as $row)
        {
            $this->super2[]=$row;
        }
        return $this->super2;
        $this->dbh=null;
    }
//:___________________________________GET BIOMETRICO DISTIN 3________________________
public function get_biometrico_dist3()
    {
        self::set_names();
		$inicio = $_POST["inicio"];
		$fin    = $_POST["fin"];
		
       // $sql="select DISTINCT nombres from biometrico limit $emp, $mos;";
		 $sql="SELECT p.id_persona AS NRO, p.nombres AS NOMBRE, p.ap_paterno AS PATERNO, p.ap_materno AS MATERNO, p.id_unidad, b.fecha AS FECHA, b.hora AS HORA, b.observacion AS OBSERVACION, u.nombre_u AS UNIDAD, 
		 sum(b.observacion='F3') AS FALTAS, 
		 sum(b.observacion='F1') AS ATRASO, 
		 sum(b.observacion='F2') AS ATRASOS, 
		 sum(b.observacion='A') AS ASISTENCIAS,
		 sum(b.observacion='P') AS PERMISOS, 
		 count(b.observacion) AS TOTALDIAS FROM biometrico b, persona p, unidad u 
WHERE b.nro = p.id_persona and p.id_unidad = u.id_unidad AND b.fecha >= '$inicio' and b.fecha <= '$fin' group by b.nro";
        foreach($this->dbh->query($sql) as $row)
        {
            $this->super2[]=$row;
        }
        return $this->super2;
        $this->dbh=null;
    }
	//:___________________________________GET BIOMETRICO DISTIN 3________________________
public function get_biometrico_dist3_user($u)
    {
        self::set_names();
		$inicio = $_POST["inicio"];
		$fin    = $_POST["fin"];
		
       // $sql="select DISTINCT nombres from biometrico limit $emp, $mos;";
		$sql="SELECT p.id_persona AS NRO, p.nombres AS NOMBRE, p.ap_paterno AS PATERNO, p.ap_materno AS MATERNO, p.id_unidad, b.fecha AS FECHA, b.hora AS HORA, b.observacion AS OBSERVACION, u.nombre_u AS UNIDAD, sum(b.observacion='F3') AS FALTAS, sum(b.observacion='F1') AS ATRASO, 
		sum(b.observacion='F2') AS ATRASOS,
		 sum(b.observacion='A') AS ASISTENCIAS, 
		 sum(b.observacion='P') AS PERMISOS,
		count(b.observacion) AS TOTALDIAS 
		FROM biometrico b, persona p, unidad u 
WHERE b.nro = p.id_persona and p.id_unidad = u.id_unidad AND p.id_unidad= '$u' AND b.fecha >= '$inicio' and b.fecha <= '$fin' group by b.nro";
        foreach($this->dbh->query($sql) as $row)
        {
            $this->super2[]=$row;
        }
        return $this->super2;
        $this->dbh=null;
    }
	//:_______________________________GET BIOMETRICO DISTIN 3________________________
public function get_biometrico_dist3_salidas()
    {
        self::set_names();
		$inicio = $_POST["inicio"];
		$fin    = $_POST["fin"];
		
       // $sql="select DISTINCT nombres from biometrico limit $emp, $mos;";
		 $sql="SELECT *
FROM  boletas_salida
GROUP BY nro";
        foreach($this->dbh->query($sql) as $row)
        {
            $this->super2[]=$row;
        }
        return $this->super2;
        $this->dbh=null;
    }
//____________________________________GET BIOMETRICO DIST3 SALIDAS ID________________
public function get_biometrico_dist3_salidas_id($id)
    {
        self::set_names();		
		 $sql="SELECT id_boletas,nro, nombres, tipo_tramite, fecha,hora_salida, hora_retorno,fecha,
	(TIMESTAMPDIFF(MINUTE,hora_salida,hora_retorno)) AS total_horas
	 FROM boletas_salida
	  WHERE nro=$id ORDER BY nombres";

        foreach($this->dbh->query($sql) as $row)
        {
            $this->super2[]=$row;
        }
        return $this->super2;
        $this->dbh=null;
    }
	//____________________________________GET BIOMETRICO DIST3 SALIDAS ID________________
public function get_biometrico_dist3_salidas_id_2($id,$inicio,$fin)
    {
        self::set_names();	
		
	 $sql="SELECT id_boletas, nro, nombres, tipo_tramite, fecha, hora_salida, hora_retorno, fecha,
(TIMESTAMPDIFF(MINUTE,hora_salida,hora_retorno)) AS total_horas
FROM boletas_salida
WHERE
fecha >= '$inicio'
AND fecha <= '$fin' 
AND nro=$id ORDER BY nombres ASC";	

        foreach($this->dbh->query($sql) as $row)
        {
            $this->super2[]=$row;
        }
        return $this->super2;
        $this->dbh=null;
    }
//_____________________________________GET BIOMETRICO DIST4__________________________
public function get_biometrico_dist4()
    {
        self::set_names();
 
 $sql="SELECT b.nombres, b.fecha, b.dpto, (b.observacion='F3') AS FALTAS,
sum(b.observacion='F1') AS ATRASO,
sum(b.observacion='F2') AS ATRASOS,
sum(b.observacion='A') AS ASISTENCIAS,
sum(b.observacion='P') AS PERMISOS,
(b.observacion) AS TOTALDIAS
 FROM
 biometrico b, persona p
 where
 b.nro = p.id_persona 
 GROUP BY b.nombres ORDER BY b.dpto ASC ";
        foreach($this->dbh->query($sql) as $row)
        {
            $this->super2[]=$row;
        }
        return $this->super2;
        $this->dbh=null;
    }
//_____________________________________GET BIOMETRICO DIST5__________________________
public function get_biometrico_dist5($emp, $mos, $inicio, $fin)
    {
        self::set_names();
			
  $sql="SELECT  b.nro, p.nombres as nombre, p.ap_paterno, p.ap_materno, p.sexo, p.ci AS CI, p.dias_pago AS DIAS_PAGO,p.tipo_descuento AS TIPO_DESCUENTO, c.nivel AS NIVEL, c.cargo AS CARGO,
sum(b.observacion='F3') AS FALTAS,
sum(b.observacion='F1') AS ATRASO,
sum(b.observacion='F2') AS ATRASOS,
sum(b.observacion='BM') AS BAJAMEDICA,
sum(b.observacion='C') AS COMISION,
sum(b.observacion='V') AS VACIONES,
sum(b.observacion='P') AS PERMISOS,
count(b.observacion) AS TOTALDIAS
 FROM
 biometrico b, persona p, contratacion c
 where
 b.fecha >= '$inicio' and b.fecha <= '$fin' and
 p.id_persona= b.nro AND
 c.id_persona = p.id_persona
 GROUP BY b.nro  ORDER BY p.ap_paterno, p.ap_materno ASC limit $emp, $mos";


        foreach($this->dbh->query($sql) as $row)
        {
            $this->super2[]=$row;
        }
        return $this->super2;
        $this->dbh=null;
    }
	//_____________________________________GET BIOMETRICO DIST5__________________________
public function get_biometrico_dist5_user($u,$emp, $mos, $inicio, $fin)
    {
        self::set_names();
	
 $sql="SELECT  b.nro, p.nombres as nombre, p.ap_paterno, p.ap_materno, p.sexo, p.ci AS CI, p.dias_pago AS DIAS_PAGO,p.tipo_descuento AS TIPO_DESCUENTO, c.nivel AS NIVEL, c.cargo AS CARGO,
sum(b.observacion='F3') AS FALTAS,
sum(b.observacion='F1') AS ATRASO,
sum(b.observacion='F2') AS ATRASOS,
sum(b.observacion='BM') AS BAJAMEDICA,
sum(b.observacion='C') AS COMISION,
sum(b.observacion='V') AS VACIONES,
sum(b.observacion='P') AS PERMISOS,
count(b.observacion) AS TOTALDIAS
 FROM
 biometrico b, persona p, contratacion c
 where
 b.fecha >= '$inicio' and b.fecha <= '$fin' and
 p.id_persona= b.nro AND
 c.id_persona = p.id_persona
 and p.id_unidad='$u'
 GROUP BY b.nro  ORDER BY p.ap_paterno, p.ap_materno ASC limit $emp, $mos";


        foreach($this->dbh->query($sql) as $row)
        {
            $this->super2[]=$row;
        }
        return $this->super2;
        $this->dbh=null;
    }
	//_____________________________________GET BIOMETRICO DIST5__________________________
public function get_biometrico_dist6($emp, $mos, $inicio, $fin,$con)
    {
        self::set_names();
			
  $sql="SELECT  b.nro, p.nombres as nombre, p.ap_paterno, p.ap_materno, p.sexo, p.contrato, p.ci AS CI, p.dias_pago AS DIAS_PAGO,p.tipo_descuento AS TIPO_DESCUENTO, c.nivel AS NIVEL, c.cargo AS CARGO,
sum(b.observacion='F3') AS FALTAS,
sum(b.observacion='F1') AS ATRASO,
sum(b.observacion='F2') AS ATRASOS,
sum(b.observacion='BM') AS BAJAMEDICA,
sum(b.observacion='C') AS COMISION,
sum(b.observacion='V') AS VACIONES,
sum(b.observacion='P') AS PERMISOS,
count(b.observacion) AS TOTALDIAS
 FROM
 biometrico b, persona p, contratacion c
 where
 b.fecha >= '$inicio' and b.fecha <= '$fin' AND
 p.contrato = '$con' AND
 p.id_persona = b.nro AND
 c.id_persona = p.id_persona
 GROUP BY b.nro  ORDER BY p.ap_paterno, p.ap_materno ASC limit $emp, $mos";


        foreach($this->dbh->query($sql) as $row)
        {
            $this->super2[]=$row;
        }
        return $this->super2;
        $this->dbh=null;
    }
	//_____________________________________GET BIOMETRICO DIST5__________________________
public function get_biometrico_dist6_user($u,$emp, $mos, $inicio, $fin,$con)
    {
        self::set_names();
	
 $sql="SELECT  b.nro, p.nombres as nombre, p.ap_paterno, p.ap_materno, p.sexo, p.ci AS CI, p.dias_pago AS DIAS_PAGO,p.tipo_descuento AS TIPO_DESCUENTO, c.nivel AS NIVEL, c.cargo AS CARGO,
sum(b.observacion='F3') AS FALTAS,
sum(b.observacion='F1') AS ATRASO,
sum(b.observacion='F2') AS ATRASOS,
sum(b.observacion='BM') AS BAJAMEDICA,
sum(b.observacion='C') AS COMISION,
sum(b.observacion='V') AS VACIONES,
sum(b.observacion='P') AS PERMISOS,
count(b.observacion) AS TOTALDIAS
 FROM
 biometrico b, persona p, contratacion c
 where
 b.fecha >= '$inicio' and b.fecha <= '$fin' and
 p.id_persona= b.nro AND
 p.contrato='$con' AND
 c.id_persona = p.id_persona
 and p.id_unidad='$u'
 GROUP BY b.nro  ORDER BY p.ap_paterno, p.ap_materno ASC limit $emp, $mos";


        foreach($this->dbh->query($sql) as $row)
        {
            $this->super2[]=$row;
        }
        return $this->super2;
        $this->dbh=null;
    }
//_____________________________________GET BIOMETRICO ID_____________________________
public function get_biometrico_id($id)
    {
        if(isset($id))
        {
            self::set_names();
            $sql="SELECT p.id_persona AS NRO, p.nombres AS NOMBRE, p.ap_paterno AS PATERNO, p.ap_materno AS MATERNO, p.id_unidad, b.fecha AS FECHA, b.hora AS HORA, b.observacion AS OBSERVACION, u.nombre_u AS UNIDAD
			 FROM
			 biometrico b, persona p, unidad u
			 where
 			b.nro = p.id_persona and p.id_unidad =  u.id_unidad and p.id_persona =?";
            $stmt=$this->dbh->prepare($sql);
            if($stmt->execute( array($id))){
				 while($row = $stmt->fetch())
                {
                    $this->productos[]=$row;
                }
                return $this->productos;
                $this->dbh=null;
            }
        }else
        {
            echo"<script type='text/javascript'>
			alert('no ha seleccionado un producto');
			window.location='inicio.php';
			</script>";
        }
    }
//_____________________________________GET BIOMETRICO ID BUSCAR_________________________
public function get_biometrico_id_buscar($id,$inicio,$fin)
    {
        
            self::set_names();
           $sql="SELECT p.id_persona AS NRO, p.nombres AS NOMBRE, p.ap_paterno AS PATERNO, p.ap_materno AS MATERNO, p.id_unidad, b.fecha AS FECHA, b.hora AS HORA, b.observacion AS OBSERVACION, u.nombre_u AS UNIDAD
			 FROM
			 biometrico b, persona p, unidad u
			 where
			 fecha >= '$inicio' AND fecha <= '$fin' AND
 			b.nro = p.id_persona and p.id_unidad =  u.id_unidad and p.id_persona =? ORDER BY b.fecha ASC
 ";
            $stmt=$this->dbh->prepare($sql);
            if($stmt->execute( array($id))){
				 while($row = $stmt->fetch())
                {
                    $this->productos[]=$row;
                }
                return $this->productos;
                $this->dbh=null;
    }
	}
	//_____________________________________GET BIOMETRICO FECHA_________________________
public function get_biometrico_fecha($inicio,$fin)
    {
            self::set_names();
		
         $sql="select fecha from biometrico where fecha >= '$inicio' AND fecha <= '$fin' group by fecha;";
            $stmt=$this->dbh->prepare($sql);
            if($stmt->execute( array($id))){
				 while($row = $stmt->fetch())
                {
                    $this->productos[]=$row;
                }
                return $this->productos;
                $this->dbh=null;
    }
	}
	
	//_____________________________________GET BIOMETRICO FECHA_TODOS_________________________
	public function get_biometrico_fecha_final($inicio,$fin,$emp,$mos)
    {
            self::set_names();	
           						 $sql="select id_biometrico, fecha, nro 
											from biometrico 
											where fecha >= '$inicio' 
											AND fecha <= '$fin' 
											AND estado <> 'visto'
											GROUP BY nro, fecha 
											HAVING COUNT(nro)<=3 
											ORDER BY nro ASC LIMIT $emp, $mos";
            $stmt=$this->dbh->prepare($sql);
            if($stmt->execute( array($id))){
				 while($row = $stmt->fetch())
                {
                    $this->productos[]=$row;
                }
                return $this->productos;
                $this->dbh=null;
    }	}
	//_____________________________________GET BIOMETRICO FECHA_TODOS USER_________________________
	public function get_biometrico_fecha_final_user($unidad,$inicio,$fin,$emp,$mos)
    {
            self::set_names();	
           						 $sql="select b.fecha, b.nro 
											from biometrico b, persona p
											where b.fecha >= '$inicio' 
											AND b.fecha <= '$fin'
											AND b.estado != 'visto' 
											AND p.id_unidad = '$unidad'
											AND p.id_persona = b.nro
											GROUP BY b.nro, b.fecha 
											HAVING COUNT(b.nro)<=3 
											ORDER BY b.nro ASC LIMIT $emp, $mos";
            $stmt=$this->dbh->prepare($sql);
            if($stmt->execute( array($id))){
				 while($row = $stmt->fetch())
                {
                    $this->productos[]=$row;
                }
                return $this->productos;
                $this->dbh=null;
    }	}
	//_____________________________________GET BIOMETRICO FECHA_TODOS_________________________
	public function get_biometrico_fecha_final_todo($inicio,$fin)
    {
            self::set_names();	
           						   $sql="select fecha, nro 
											from biometrico 
											where fecha >= '$inicio' 
											AND fecha <= '$fin'
											AND estado <> 'visto'
											GROUP BY nro, fecha 
											HAVING COUNT(nro)<=3 
											ORDER BY nro ASC";
            $stmt=$this->dbh->prepare($sql);
            if($stmt->execute( array($id))){
				 while($row = $stmt->fetch())
                {
                    $this->productos[]=$row;
                }
                return $this->productos;
                $this->dbh=null;
    }	}
	//_____________________________________GET BIOMETRICO FECHA_TODOS USER_________________________
	public function get_biometrico_fecha_final_todo_user($unidad,$inicio,$fin)
    {
            self::set_names();	
           						   $sql="select b.fecha, b.nro 
											from biometrico b, persona p 
											where b.fecha >= '$inicio' 
											AND b.fecha <= '$fin'
											AND b.estado <> 'visto'
											AND p.id_unidad = '$unidad'
											AND p.id_persona = b.nro
											GROUP BY b.nro, b.fecha 
											HAVING COUNT(b.nro)<=3 
											ORDER BY b.nro ASC";
            $stmt=$this->dbh->prepare($sql);
            if($stmt->execute( array($id))){
				 while($row = $stmt->fetch())
                {
                    $this->productos[]=$row;
                }
                return $this->productos;
                $this->dbh=null;
    }	}
		//_____________________________________GET BIOMETRICO REGISTROS INCOMPLETOS_________________________
public function get_biometrico_con_reg($fecha ,$nro)
    {
            self::set_names();
         $sql="select p.nombres, p.ap_paterno, p.ap_materno,b.id_biometrico, b.nro, b.fecha, count(b.nro) AS TOTAS_DIARIA
				from biometrico b, persona p 
				WHERE b.fecha='$fecha' 
				AND b.nro='$nro' 
				AND p.id_persona=b.nro
				group by b.nro";
             foreach ($this->dbh->query($sql) as $row)
    		{
    			$this->nombre[]=$row;
    		}  
            return $this->nombre;
			$this->dbh=null; 
	}
//_____________________________________GET BIOMETRICO COMPARAR FECHA_________________________
 public function get_biometrico_com($fech,$nom)
    {
            self::set_names();
            // $sql="select * from biometrico where fecha='$fech' and nombres='$nom'; ";
			  $sql="SELECT observacion AS OBSERVACION, hora AS HORA, fecha AS FECHA
 				FROM
 				biometrico
 				where
 				fecha = '$fech' and nro='$nom' order by fecha, hora asc;";			 
            $stmt=$this->dbh->prepare($sql);
            if($stmt->execute( array($id))){
				 while($row = $stmt->fetch())
                {
                    $this->productos[]=$row;
                }
                return $this->productos;
                $this->dbh=null;
    }
	}
	//_____________________________________GET BIOMETRICO COMPARAR FECHA NRO_________________________
 
//_____________________________________GET BIOMETRICO ID PERMISOS____________________	
public function get_boletas_id($id)
    {
        if(isset($id))
        {
            self::set_names();
            $sql="select * from boletas_salida where nro=?
             ";
            $stmt=$this->dbh->prepare($sql);
            if($stmt->execute( array($id))){
				 while($row = $stmt->fetch())
                {
                    $this->productos[]=$row;
                }
                return $this->productos;
                $this->dbh=null;
            }
        }else
        {
            echo"<script type='text/javascript'>
			alert('no ha seleccionado un producto');
			window.location='inicio.php';
			</script>";
        }
    }
//_____________________________________GET BIOMETRICO ID2____________________________
public function get_biometrico_id2($id,$fecha)
    {
        if(isset($id))
        {
            self::set_names();
            $sql="select * from biometrico where nombres=? and fecha=?";
            $stmt=$this->dbh->prepare($sql);
            if($stmt->execute( array($id,$fecha))){
				 while($row = $stmt->fetch())
                {
                    $this->productos[]=$row;
                }
                return $this->productos;
                $this->dbh=null;
            }
        }else
        {
            echo"<script type='text/javascript'>
			alert('no ha seleccionado un producto');
			window.location='inicio.php';
			</script>";
        }
    }
//______________________________________BUSCADOR PERSONAL____________________________	
function buscador_personal($q){	
$sql="SELECT p.id_persona AS NRO, p.nombres AS NOMBRE, p.ap_paterno AS PATERNO, p.ap_materno AS MATERNO, p.id_unidad, b.fecha AS FECHA, b.hora AS HORA, b.observacion AS OBSERVACION, u.nombre_u AS UNIDAD
			 FROM
			 biometrico b, persona p, unidad u
			 where
 			b.nro = p.id_persona and p.id_unidad =  u.id_unidad and b.nombres LIKE '%$q%' group by b.nro";

     $stmt=$this->dbh->prepare($sql);
     if($stmt->execute( array($q) ) ){
		print '
		     <tr bgcolor="#75C2F3" >
            <td align="center" valign="top" ><strong>Departamento </strong></td>
            <td align="center" valign="top" ><strong>Nombre</strong></td>
            <td align="center" valign="top" ><strong>Nro</strong></td>
               <td align="center" valign="top" ><strong>Fecha</strong></td>
            <td align="center" valign="top" ><strong>Hora</strong></td>
            <td align="center" valign="top" ><strong>Selecc</strong></td>
			  <td align="center" valign="top" ><strong>Sancion</strong></td>
          </tr>';
				$i=1;
	               while($row = $stmt->fetch()){
					   $i++; 
					   if ($i%2==0){
    echo '<tr bgcolor="#F4F7EB" >';
}else{
    echo '<tr bgcolor="#F5E68E" >';
}					  
                    $this->caja[]=$row;
					print ' <td   align="center" valign="top"><font face="serif" size="-1">'.$row['UNIDAD'].'</td>
							<td   align="center" valign="top"><font face="serif" size="-1">'.$row['NOMBRE'].' '.$row['PATERNO'].'  '.$row['MATERNO'].'</td>
							<td   align="center" valign="top"><font face="serif" size="-1">'.$row['NRO'].'</td>
							<td   align="center" valign="top"><font face="serif" size="-1">'.$row['FECHA'].' </td>
							<td  align="center"  " valign="top"><font face="serif" size="-1">'.$row['HORA'].' </td>
							<td valign="top" align="center"><a href="reportes_id.php?id='.$row['NRO'].'" title="Selec echo'.$row['nombres'].'" ><img src="images/click2.jpg" width="35" height="30" /></a></td>	
							<td valign="top" align="center"><a href="sancionar.php?id='.$row['NRO'].'" title="Selec echo'.$row['nombres'].'" ><img src="images/TIPORETEN.png" width="35" height="30" /></a></td>
										
							</tr>';
					
					                }
                return $this->caja;
                $this->dbh=null; 
            }  			
}

function buscador_personal_user($q){	
$nom=$this->saluda_al_usuario($_SESSION["ses_user"]);
 $u=$nom[0]["id_unidad"];
$sql="SELECT p.id_persona AS NRO, p.nombres AS NOMBRE, p.ap_paterno AS PATERNO, p.ap_materno AS MATERNO, p.id_unidad, b.fecha AS FECHA, b.hora AS HORA, b.observacion AS OBSERVACION, u.nombre_u AS UNIDAD
			 FROM
			 biometrico b, persona p, unidad u
			 where
			 p.id_unidad = '$u' and
 			b.nro = p.id_persona and p.id_unidad =  u.id_unidad and b.nombres LIKE '%$q%' group by b.nro";

     $stmt=$this->dbh->prepare($sql);
     if($stmt->execute( array($q) ) ){
		print '
		     <tr bgcolor="#75C2F3" >
            <td align="center" valign="top" ><strong>Departamento </strong></td>
            <td align="center" valign="top" ><strong>Nombre</strong></td>
            <td align="center" valign="top" ><strong>Nro</strong></td>
               <td align="center" valign="top" ><strong>Fecha</strong></td>
            <td align="center" valign="top" ><strong>Hora</strong></td>
            <td align="center" valign="top" ><strong>Seleccionar</strong></td>
          </tr>';
				$i=1;
	               while($row = $stmt->fetch()){
					   $i++; 
					   if ($i%2==0){
    echo '<tr bgcolor="#F4F7EB" >';
}else{
    echo '<tr bgcolor="#F5E68E" >';
}					  
                    $this->caja[]=$row;
					print ' <td   align="center" valign="top"><font face="serif" size="-1">'.$row['UNIDAD'].'</td>
							<td   align="center" valign="top"><font face="serif" size="-1">'.$row['NOMBRE'].' '.$row['PATERNO'].'  '.$row['MATERNO'].'</td>
							<td   align="center" valign="top"><font face="serif" size="-1">'.$row['NRO'].'</td>
							<td   align="center" valign="top"><font face="serif" size="-1">'.$row['FECHA'].' </td>
							<td  align="center"  " valign="top"><font face="serif" size="-1">'.$row['HORA'].' </td>
							<td valign="top" align="center"><a href="reportes_id.php?id='.$row['NRO'].'" title="Selec echo'.$row['nombres'].'" ><img src="images/click2.jpg" width="35" height="30" /></a></td>				
							</tr>';
					
					                }
                return $this->caja;
                $this->dbh=null; 
            }  			
}
//______________________________________BUSCADOR USUARIO____________________________	
function buscador_usuario($q){	
$nom=$this->saluda_al_usuario($_SESSION["ses_user"]);
$sql="select * from usuario WHERE usuario LIKE '%$q%' group by usuario";
     $stmt=$this->dbh->prepare($sql);
     if($stmt->execute( array($q) ) ){
		print '
		     <tr bgcolor="#75C2F3">
  <td colspan="9" align="center" valign="top">Listado de Usuarios</td>
  </tr>

<tr bgcolor="#75C2F3" >
<td align="center" valign="top" ><strong>Usuario</strong></td>
<td align="center" valign="top" ><strong>Password</strong></td>
<td align="center" valign="top" ><strong>Detalles</strong></td>
<td align="center" valign="top" ><strong>Eliminar</strong></td>
</tr>
			 ';
				$i=1;
	               while($row = $stmt->fetch()){
					   $i++; 
					   if ($i%2==0){
    echo '<tr bgcolor="#F4F7EB" >';
}else{
    echo '<tr bgcolor="#F5E68E" >';
}					  
                    $this->caja[]=$row;
					print ' 
<td valign="top" align="center"><a href="ver_funcionario.php?id='.$row['id_usuario'].'" title="'.$row['usuario'].'">'.$row['usuario'].'</a></td>
<td valign="top" align="center"><font face="serif" size="-1">'.$row['password'].'</font></td>
<td valign="top" align="center"><font face="serif" size="-1">'.$row['detalles'].'</font></td>
';
print ' <td valign="top" align="center">';

if($nom[0]["nombres"]=="admin"){
print '
<a href="delet_usuario.php?id='.$row['id_usuario'].'" title="Eliminar '.$row['usuario'].'" >
';
}else{	
print '
<a href="salir.php?id=listusuario.php" title="Eliminar '.$row['usuario'].'" >
';}
print '
<img src="images/cancel.png" width="25" height="25" /></a></td>
</tr >
';
					
					                }
                return $this->caja;
                $this->dbh=null; 
            }  			
}
//______________________________________BUSCADOR FUNCIONARIO_________________________	
function buscador_funcionario($q){	
$nom=$this->saluda_al_usuario($_SESSION["ses_user"]);
$sql="select * from persona WHERE nombres LIKE '%$q%' OR ap_paterno LIKE '%$q%' OR ap_materno LIKE '%$q%' group by nombres";
     $stmt=$this->dbh->prepare($sql);
     if($stmt->execute( array($q) ) ){
		print '
		     <tr bgcolor="#75C2F3">
<td align="center" valign="top" ><strong>Nombre</strong></td>
<td width="122" align="center" valign="top" ><strong>Ap Paterno</strong></td>
<td width="128" align="center" valign="top" ><strong>Ap Materno</strong></td>
<td width="230" align="center" valign="top" ><strong>Unidad</strong></td>
<td width="56" align="center" valign="top" ><strong>Familias</strong></td>
<td width="51" align="center" valign="top" ><strong>Memos</strong></td>
<td width="51" align="center" valign="top" ><strong>Horarios</strong></td>
<td width="51" align="center" valign="top" ><strong>Maquinaria</strong></td>
<td width="51" align="center" valign="top" ><strong>Correccion <BR>Asistencia</strong></td>
<td width="51" align="center" valign="top" ><strong>Eliminar<BR>Asistencia</strong></td>
</tr>
			 ';
				$i=1;
	               while($row = $stmt->fetch()){
					   $i++; 
					   if ($i%2==0){
    echo '<tr bgcolor="#F4F7EB" >';
}else{
    echo '<tr bgcolor="#F5E68E" >';
}					  
                    $this->caja[]=$row;
					print ' 
<td valign="top" align="center"><a href="ver_funcionario.php?id='.$row['id_persona'].'" title="'.$row['nombres'].'">'.$row['nombres'].'</a></td>
<td valign="top" align="center"><font face="serif" size="-1">'.$row['ap_paterno'].'</font></td>
<td align="center" valign="top"><font face="serif" size="-1">'.$row['ap_materno'].'</font></td>
<td align="center" valign="top"><font face="serif" size="-1">';
$tr=$this->get_tabla_id('id_unidad',$row['id_unidad'],'unidad');
print ''.$tr[0]["nombre_u"].'
 </font></td>';
 
 print ' <td valign="top" align="center">';
if($nom[0]["nombres"]=="admin"){
print '
<a href="add_familia.php?id='.$row['id_persona'].'" title="Eliminar '.$row['usuario'].'" >';
}else{	
print '
<a href="salir.php?id=funcionarios.php" title="Eliminar '.$row['usuario'].'" >
';
}
print '
<img src="images/familias.jpg" width="25" height="25" /></td>'
;
print ' <td valign="top" align="center">';
if($nom[0]["nombres"]=="admin"){
print '
<a href="add_memo.php?id='.$row['id_persona'].'" title="Eliminar '.$row['usuario'].'" >
';
}else{	
print '
<a href="salir.php?id=funcionarios.php" title="Eliminar '.$row['usuario'].'" >
';
}
print '
<img src="images/contratar.jpg" width="25" height="25" /></td>';

print ' <td valign="top" align="center">';
if($nom[0]["nombres"]=="admin"){
print '
<a href="add_hora.php?id='.$row['id_persona'].'" title="Eliminar '.$row['usuario'].'" >
';
}else{	
print '
<a href="salir.php?id=funcionarios.php" title="Eliminar '.$row['usuario'].'" >
';
}
print '
<img src="imagenes/reloj.jpg" width="25" height="25" /></td>';

print ' <td valign="top" align="center">';
if($nom[0]["nombres"]=="admin" or $nom[0]["nombres"]=="Radio"){
print '
<a href="add_maquinaria.php?id='.$row['id_persona'].'" title="Eliminar '.$row['usuario'].'" >
';
}else{	
print '
<a href="salir.php?id=funcionarios.php" title="Eliminar '.$row['usuario'].'" >
';
}
print '
<img src="imagenes/tractor.jpg" width="25" height="25" /></td>';

print ' <td valign="top" align="center">';
if($nom[0]["nombres"]=="admin"){
print '
<a href="add_periodo.php?id='.$row['id_persona'].'" title="Eliminar '.$row['usuario'].'" >
';
}else{	
print '
<a href="salir.php?id=funcionarios.php" title="Eliminar '.$row['usuario'].'" >
';
}
print '
<img src="imagenes/user.bmp" width="25" height="25" /></td>';

print ' <td valign="top" align="center">';
if($nom[0]["nombres"]=="admin"){
print '
<a href="eliminar_marcado.php?id='.$row['id_persona'].'" title="Eliminar '.$row['usuario'].'" >
';
}else{	
print '
<a href="salir.php?id=funcionarios.php" title="Eliminar '.$row['usuario'].'" >
';
}
print '
<img src="imagenes/eliminar.jpg" width="25" height="25" /></td>';

print '</tr>';
					
					                }
                return $this->caja;
                $this->dbh=null; 
            }  			
}
//______________________________________BUSCADOR FUNCIONARIO_________________________	
function buscador_funcionario2($q){	
$nom=$this->saluda_al_usuario($_SESSION["ses_user"]);
$sql="select * from persona WHERE nombres LIKE '%$q%' OR ap_paterno LIKE '%$q%' OR ap_materno LIKE '%$q%' group by nombres";
     $stmt=$this->dbh->prepare($sql);
     if($stmt->execute( array($q) ) ){
		print '
		     <tr bgcolor="#75C2F3">
  <td colspan="9" align="center" valign="top">Listado de Funcionarios</td>
<tr bgcolor="#75C2F3" >
<td align="center" valign="top" ><strong>Nombre</strong></td>
<td width="122" align="center" valign="top" ><strong>Apellido Paterno</strong></td>
<td width="128" align="center" valign="top" ><strong>Apellido Materno</strong></td>
<td width="230" align="center" valign="top" ><strong>Unidad</strong></td>
<td width="51" align="center" valign="top" ><strong>Pemisos</strong></td>
</tr>
			 ';
				$i=1;
	               while($row = $stmt->fetch()){
					   $i++; 
					   if ($i%2==0){
    echo '<tr bgcolor="#F4F7EB" >';
}else{
    echo '<tr bgcolor="#F5E68E" >';
}					  
                    $this->caja[]=$row;
					print ' 
<td valign="top" align="center"><a href="ver_funcionario.php?id='.$row['id_persona'].'" title="'.$row['nombres'].'">'.$row['nombres'].'</a></td>
<td valign="top" align="center"><font face="serif" size="-1">'.$row['ap_paterno'].'</font></td>
<td align="center" valign="top"><font face="serif" size="-1">'.$row['ap_materno'].'</font></td>
<td align="center" valign="top"><font face="serif" size="-1">';
$tr2=$this->get_tabla_id('id_unidad',$row['id_unidad'],'unidad');
print ''.$tr2[0]["nombre_u"].'
 </font></td>';
 
 print ' <td valign="top" align="center">';
if($nom[0]["nombres"]=="admin"){
print '
<a href="permisos_id.php?id='.$row['id_persona'].'" title="Dar permiso a'.$row['usuario'].'" >
';
}else{	
print '
<a href="salir.php?id=permisos_id.php" title="Dar permiso a '.$row['usuario'].'" >
';}
print '
<img src="imagenes/candado.jpg" width="25" height="25" /></td>

</tr>';
					
					                }
                return $this->caja;
                $this->dbh=null; 
            }  			
}
//______________________________________ADD FUNCIONARIO______________________________
public function add_funcionarios(){
			 self::set_names();
        $sql="insert into persona
		values(null,?,?,?,?,?,?,?,?,?,?,?,?,' ','1','0',' ',?,?,'2','EVENTUAL');";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["ap_paterno"],PDO::PARAM_STR);
		$stmt->bindValue(2,$_POST["ap_materno"],PDO::PARAM_STR);
		$stmt->bindValue(3,$_POST["nombre"],PDO::PARAM_STR);
		$stmt->bindValue(4,$_POST["fecha"],PDO::PARAM_STR);
	    $stmt->bindValue(5,$_POST["provincia"],PDO::PARAM_STR);
		$stmt->bindValue(6,$_POST["dpto"],PDO::PARAM_STR);
		$stmt->bindValue(7,$_POST["ci"],PDO::PARAM_STR);
	   	$stmt->bindValue(8,$_POST["cel"],PDO::PARAM_STR);
		$stmt->bindValue(9,$_POST["tel"],PDO::PARAM_STR);
	    $stmt->bindValue(10,$_POST["estado_civil"],PDO::PARAM_STR);
		$stmt->bindValue(11,$_POST["domicilio"],PDO::PARAM_STR);
		$stmt->bindValue(12,$_POST["id_unidad"],PDO::PARAM_STR);
		$stmt->bindValue(13,$_POST["SEXO"],PDO::PARAM_STR);
		$stmt->bindValue(14,$_POST["DIAS"],PDO::PARAM_STR);
        $stmt->execute();
        //_______________
		 $id= $this->dbh->lastInsertId();
		$sql2="insert into formacion_academica values (null,?,?,?);";
        $stmt2=$this->dbh->prepare($sql2);
        $stmt2->bindValue(1,$id,PDO::PARAM_STR);
		$stmt2->bindValue(2,$_POST["nive_academico"],PDO::PARAM_STR);
        $stmt2->bindValue(3,$_POST["profecion"],PDO::PARAM_STR);
      //_______________
        $sql3="insert into contratacion values (null,?,?,?,?,?,?,?,?);";
        $stmt3=$this->dbh->prepare($sql3);
        $stmt3->bindValue(1,$id,PDO::PARAM_STR);
		$stmt3->bindValue(2,$_POST["nivel"],PDO::PARAM_STR);
        $stmt3->bindValue(3,$_POST["cargo"],PDO::PARAM_STR);
        $stmt3->bindValue(4,$_POST["fecha_i"],PDO::PARAM_STR);
		$stmt3->bindValue(5,$_POST["fecha_r"],PDO::PARAM_STR);
        $stmt3->bindValue(6,$_POST["reincorporacion"],PDO::PARAM_STR);
		$stmt3->bindValue(7,$_POST["anho_ser"],PDO::PARAM_STR);
        $stmt3->bindValue(8,$_POST["retiro_mot"],PDO::PARAM_STR);
		 //_______________
       
	   $sql4="insert into requisitos values (null,?,?,?,?,?,?,?,?);";
        $stmt4=$this->dbh->prepare($sql4);
        $stmt4->bindValue(1,$id,PDO::PARAM_STR);
		$stmt4->bindValue(2,$_POST["CCTW1"],PDO::PARAM_STR);
        $stmt4->bindValue(3,$_POST["CCTW2"],PDO::PARAM_STR);
        $stmt4->bindValue(4,$_POST["CCTW3"],PDO::PARAM_STR);
		$stmt4->bindValue(5,$_POST["CCTW4"],PDO::PARAM_STR);
        $stmt4->bindValue(6,$_POST["CCTW5"],PDO::PARAM_STR);
		$stmt4->bindValue(7,$_POST["CCTW6"],PDO::PARAM_STR);
        $stmt4->bindValue(8,$_POST["CCTW7"],PDO::PARAM_STR);
        //validar la foto del logo..si viene vació se agregará uno por defecto
		echo $id.'-----------------'; 
      if($_FILES["foto"]["type"]=="image/jpeg" or $_FILES["foto"]["type"]=="image/pjpeg" or $_FILES["foto"]["type"]=="image/png" or $_FILES["foto"]["type"]=="image/git" )
        {
            //echo "se cumple";exit;
            $logo="logo_".$id.".jpg";
            //echo $logo;
			//exit;
            copy($_FILES["foto"]["tmp_name"],"img/".$_FILES["foto"]["name"]);
            //echo "images/logo/".$_FILES["foto"]["name"];exit;
            require_once("resize-class.php");
            $resizeObj = new resize("img/".$_FILES["foto"]["name"]);
            $resizeObj -> resizeImage(100, 100, 0);
            $resizeObj -> saveImage('img/'.$logo, 100);
            unlink("img/".$_FILES["foto"]["name"]);
            $foto="img/$logo";
        	 $foto;
		}else
        {
            $foto="img/no_tiene.png";
        }
        //insertar el logo
        $query="update persona set foto=? where id_persona=".$id;
        $stmt=$this->dbh->prepare($query);
        $stmt->bindValue(1,$foto,PDO::PARAM_STR);
        $stmt->execute();
		$stmt2->execute();
		$stmt3->execute();
		$stmt4->execute();
		 $query.'<br />';
		 $sql;

        //cerramos la conexion
        $this->dbh=null;
		
		//_______________
        echo"<script type='text/javascript'>
			alert('Funcionario AGREGADO correctamente');
			window.location='funcionarios.php';
			</script>";
			
						}
//______________________________________EDIT FUNCIONARIO_____________________________						
public function edit_funcionario(){
					 
					 $id = $_POST["id"];
					 $_FILES["foto"]["type"];
			  
			   if($_FILES["foto"]["type"]=="image/jpeg" or $_FILES["foto"]["type"]=="image/pjpeg" or $_FILES["foto"]["type"]=="image/png" or $_FILES["foto"]["type"]=="image/git" )
            {
               //echo "se cumple";exit;
                $logo="logo_".$id.".jpg";
                //echo $logo;exit;
                copy($_FILES["foto"]["tmp_name"],"img/".$_FILES["foto"]["name"]);
                //echo "images/logo/".$_FILES["foto"]["name"];exit;
                require_once("resize-class.php");
                $resizeObj = new resize("img/".$_FILES["foto"]["name"]);
                $resizeObj -> resizeImage(100, 100, 0);
                $resizeObj -> saveImage('img/'.$logo, 100);
                unlink("img/".$_FILES["foto"]["name"]);
                $foto="img/$logo";
            }else
            {
                $foto=$_POST["archivo"];
            }
					 ///___________
					 
		self::set_names();
         $sql="update persona set 
		 ap_paterno=?,
		 ap_materno=?, 
		 nombres=?, 
		 fecha_nac=?, 
		 provincia=?, 
		 dpto=?,
		 ci=?,
		 domicilio=?, 
		 celular=?,
		 telefono=?,
		 estado_civil=?,
		 id_unidad=?,
		 foto=?,
		 sexo=?, 
		 dias_pago=?,
		 tipo_descuento=? where id_persona=?;";

        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["ap_paterno"],PDO::PARAM_STR);
		$stmt->bindValue(2,$_POST["ap_materno"],PDO::PARAM_STR);
		$stmt->bindValue(3,$_POST["nombre"],PDO::PARAM_STR);
		$stmt->bindValue(4,$_POST["fecha"],PDO::PARAM_STR);
	    $stmt->bindValue(5,$_POST["provincia"],PDO::PARAM_STR);
		$stmt->bindValue(6,$_POST["dpto"],PDO::PARAM_STR);
		$stmt->bindValue(7,$_POST["ci"],PDO::PARAM_STR);
		$stmt->bindValue(8,$_POST["domicilio"],PDO::PARAM_STR);
	   	$stmt->bindValue(9,$_POST["cel"],PDO::PARAM_STR);
		$stmt->bindValue(10,$_POST["tel"],PDO::PARAM_STR);
	    $stmt->bindValue(11,$_POST["estado_civil"],PDO::PARAM_STR);
		$stmt->bindValue(12,$_POST["id_unidad"],PDO::PARAM_STR);
		$stmt->bindValue(13,$foto,PDO::PARAM_STR);
		$stmt->bindValue(14,$_POST["SEXO"],PDO::PARAM_STR);
		$stmt->bindValue(15,$_POST["DIAS"],PDO::PARAM_STR);
		$stmt->bindValue(16,$_POST["descuent"],PDO::PARAM_STR);
	    $stmt->bindValue(17,$_POST["id"],PDO::PARAM_INT);
		//echo $_POST["ap_paterno"].$_POST["ap_materno"].$_POST["nombre"].$_POST["fecha"].$_POST["provincia"].$_POST["dpto"];
		 echo 'ste es el id '.$id.'<br>';
		 echo $_POST["descuent"].'<br>';
		 echo $_POST["DIAS"].'<br>';
		 echo $_POST["SEXO"].'<br>';
        $stmt->execute();
        $this->dbh=null;
            echo"<script type='text/javascript'>
			alert('El se ha insertado correctamente correctamente');
			window.location='funcionarios.php';
			</script>";
				//echo "..............".$_POST["e-mail_caj"]	;	
			}
//_________________________________EDIT CONTRATO FUNCIONARIO________________________
public function edit_contrato_funcionario(){
self::set_names();
        $sql="update contratacion set nivel=?, cargo=?, fecha_ingreso=?, fecha_retiro=?, fecha_reincorporacion=?, años_servicio=?, motivo_retiro=? where id_persona=?;";
        $stmt=$this->dbh->prepare($sql);
   $stmt->bindValue(1,$_POST["nivel"],PDO::PARAM_STR);
   $stmt->bindValue(2,$_POST["cargo"],PDO::PARAM_STR);
    $stmt->bindValue(3,$_POST["fecha_i"],PDO::PARAM_STR);
   $stmt->bindValue(4,$_POST["fecha_r"],PDO::PARAM_STR);
    $stmt->bindValue(5,$_POST["reincorporacion"],PDO::PARAM_STR);
   $stmt->bindValue(6,$_POST["anho_ser"],PDO::PARAM_STR);
    $stmt->bindValue(7,$_POST["retiro_mot"],PDO::PARAM_STR);
	    $stmt->bindValue(8,$_POST["id"],PDO::PARAM_INT);
        $stmt->execute();
        $this->dbh=null;	
	
}
//_______________________________EDIT FORMACION ACADEMICA
public function edit_formacion_academica(){
self::set_names();
        $sql="update formacion_academica set nivel_academico=?, profecion_ocupacion=? where id_persona=?;";
        $stmt=$this->dbh->prepare($sql);
   $stmt->bindValue(1,$_POST["nive_academico"],PDO::PARAM_STR);
   $stmt->bindValue(2,$_POST["profecion"],PDO::PARAM_STR);

	    $stmt->bindValue(3,$_POST["id"],PDO::PARAM_INT);
        $stmt->execute();
        $this->dbh=null;	
	
}
//_______________________________EDIT FORMACION ACADEMICA
public function edit_requisitos(){
self::set_names();
        $sql="update requisitos set curriculun=?, declaracion_j=?, declaracion_imcompatibilidad=?, certificado_antecedentes=?, libreta_servicio_militar=?,
 patron_bio_elec=?, seguro_caja_salud=? where id_persona=?;";
        $stmt=$this->dbh->prepare($sql);
  $stmt->bindValue(1,$_POST["CCTW1"],PDO::PARAM_STR);
  $stmt->bindValue(2,$_POST["CCTW2"],PDO::PARAM_STR);
  $stmt->bindValue(3,$_POST["CCTW3"],PDO::PARAM_STR);
  $stmt->bindValue(4,$_POST["CCTW4"],PDO::PARAM_STR);
  $stmt->bindValue(5,$_POST["CCTW5"],PDO::PARAM_STR);
  $stmt->bindValue(6,$_POST["CCTW6"],PDO::PARAM_STR);
  $stmt->bindValue(7,$_POST["CCTW7"],PDO::PARAM_STR);
  $stmt->bindValue(8,$_POST["id"],PDO::PARAM_INT);
        $stmt->execute();
        $this->dbh=null;	
	
}
//______________________________________ADD UNIDAD___________________________________		
public function add_unidad(){
			 self::set_names();
        $sql="insert into unidad
		values
		(null,?,?);";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["nombre"],PDO::PARAM_STR);
		$stmt->bindValue(2,$_POST["descripcion"],PDO::PARAM_STR);
	
        $stmt->execute();
        $this->dbh=null;
		 $sql;
		 echo"<script type='text/javascript'>
			alert('El se ha insertado correctamente correctamente');
			window.location='listprocedencia.php';
			</script>";
			}
			//______________________________________ADD HORARIO___________________________________		
public function add_horario(){
			 self::set_names();
        $sql="insert into horarios
		values
		(null,?,?,?,?,?);";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["nombre_h"],PDO::PARAM_STR);
		$stmt->bindValue(2,$_POST["entrada1"],PDO::PARAM_STR);
		 $stmt->bindValue(3,$_POST["salida1"],PDO::PARAM_STR);
		$stmt->bindValue(4,$_POST["entrada2"],PDO::PARAM_STR);
		 $stmt->bindValue(5,$_POST["salida2"],PDO::PARAM_STR);
	
	
        $stmt->execute();
        $this->dbh=null;
		
		 echo"<script type='text/javascript'>
			alert('El se ha insertado correctamente correctamente');
			window.location='horarios.php';
			</script>";
			}
			
			
//______________________________________EDIT UNIDAD__________________________________
public function edit_unidad(){
					 self::set_names();
        $sql="update unidad set nombre_u=?, descripcion_u=? where id_unidad=?;";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["nombre"],PDO::PARAM_STR);
		$stmt->bindValue(2,$_POST["descripcion"],PDO::PARAM_STR);
	    $stmt->bindValue(3,$_POST["id"],PDO::PARAM_INT);
        $stmt->execute();
        $this->dbh=null;
          header("Location:listprocedencia.php");
		 echo $_POST["nombre_com"].$_POST["precidencia"].$_POST["detalles"].$_POST["id"];
				
			}	
			//______________________________________EDIT CAMPAMENTO__________________________________
public function edit_campamento(){
					 self::set_names();
        $sql="update campamento set nombre=?, descripcion=? where id_campamento=?;";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["nombre"],PDO::PARAM_STR);
		$stmt->bindValue(2,$_POST["descripcion"],PDO::PARAM_STR);
	    $stmt->bindValue(3,$_POST["id"],PDO::PARAM_INT);
        $stmt->execute();
        $this->dbh=null;
          header("Location:listprocedencia.php");
		 echo $_POST["nombre_com"].$_POST["precidencia"].$_POST["detalles"].$_POST["id"];
				
			}	
//______________________________________ADD USUARIO__________________________________
public function add_usuario(){
			 self::set_names();
			 $pass=sha1($_POST["password"]);
			 echo $pass.' '.$_POST["id_persona"].' '.$_POST["usuario"].' '.$_POST["detalles"];
			 
        $sql="insert into usuario
		values
		(null,?,?,?,?);";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["id_persona"],PDO::PARAM_STR);
		$stmt->bindValue(2,$_POST["usuario"],PDO::PARAM_STR);
        $stmt->bindValue(3,$pass,PDO::PARAM_STR);
        $stmt->bindValue(4,$_POST["detalles"],PDO::PARAM_STR);
        $stmt->execute();
        $this->dbh=null;
		$sql;
		 echo"<script type='text/javascript'>
			alert('USUARIO AGREGADO CORRECTAMENTE');
			window.location='listusuario.php';
			</script>";
			}	
//::::::::::::::::::::::::::::::::::::::ADD FAMILIA::::::::::::::::::::::::::::::::::
public function add_familia(){
			 self::set_names();
        $sql="insert into familiares
		values
		(null,?,?,?,?);";
        $stmt=$this->dbh->prepare($sql);
		$stmt->bindValue(1,$_POST["id"],PDO::PARAM_STR);
        $stmt->bindValue(2,$_POST["nombre"],PDO::PARAM_STR);
		$stmt->bindValue(3,$_POST["parentesco"],PDO::PARAM_STR);
		$stmt->bindValue(4,$_POST["fecha"],PDO::PARAM_STR);
	
        $stmt->execute();
        $this->dbh=null;
		$sql;
		 echo"<script type='text/javascript'>
			alert('insertado correctamente');
			window.location='funcionarios.php';
			</script>";
			}	
//::::::::::::::::::::::::::::::::::::::ADD MEMOS::::::::::::::::::::::::::::::::::::
public function add_memo(){
			 self::set_names();
        $sql="insert into memos
		values
		(null,?,?,?,?,?);";
        $stmt=$this->dbh->prepare($sql);
		$stmt->bindValue(1,$_POST["id"],PDO::PARAM_STR);
        $stmt->bindValue(2,$_POST["nro_memo"],PDO::PARAM_STR);
        $stmt->bindValue(3,$_POST["id_tipo_memo"],PDO::PARAM_STR);
		$stmt->bindValue(4,$_POST["observaciones"],PDO::PARAM_STR);
		$stmt->bindValue(5,$_POST["fecha"],PDO::PARAM_STR);
		
	
        $stmt->execute();
        $this->dbh=null;
		$sql;
		 echo"<script type='text/javascript'>
			alert('insertado correctamente');
			window.location='funcionarios.php';
			</script>";
			}
			//::::::::::::::::::::::::::::::::::::::NUEVO TIPO MEMO::::::::::::::::::::::::::::::
	public function add_campamento(){
			 self::set_names();
        $sql="insert into campamento
		values
		(null,?,?);";
        $stmt=$this->dbh->prepare($sql);
		$stmt->bindValue(1,$_POST["nombre"],PDO::PARAM_STR);
		$stmt->bindValue(2,$_POST["descripcion"],PDO::PARAM_STR);
		
	
        $stmt->execute();
        $this->dbh=null;
		 echo"<script type='text/javascript'>
			alert('AGREDADO CORRECTAMENTE');
			window.location='javascript:window.close();';
			</script>";
			}
//::::::::::::::::::::::::::::::::::::::NUEVO TIPO MEMO::::::::::::::::::::::::::::::
	public function nuevo_memo(){
			 self::set_names();
        $sql="insert into tipo_memo
		values
		(null,?,?);";
        $stmt=$this->dbh->prepare($sql);
		$stmt->bindValue(1,$_POST["memo"],PDO::PARAM_STR);
		$stmt->bindValue(2,$_POST["observaciones"],PDO::PARAM_STR);
		
	
        $stmt->execute();
        $this->dbh=null;
		 echo"<script type='text/javascript'>
			alert('AGREDADO CORRECTAMENTE');
			window.location='javascript:window.close();';
			</script>";
			}
//::::::::::::::::::::::::::::::::::::::ADD VACACIONES:::::::::::::::::::::::::::::::
public function add_vacaciones(){
			 self::set_names();
        $sql="insert into vacaciones values
		(null,?,?,?,?);";
        $stmt=$this->dbh->prepare($sql);
		$stmt->bindValue(1,$_POST["id"],PDO::PARAM_STR);
        $stmt->bindValue(2,$_POST["inicio"],PDO::PARAM_STR);
		$stmt->bindValue(3,$_POST["fin"],PDO::PARAM_STR);
		$stmt->bindValue(4,$_POST["observaciones"],PDO::PARAM_STR);
		
        $stmt->execute();
        $this->dbh=null;
		$sql;
		 echo"<script type='text/javascript'>
			alert('insertado correctamente');
			window.location='excepciones_asistencia.php';
			</script>";
			}
			///______________________________
			public function add_hora(){
			 self::set_names();
        $sql="UPDATE persona SET id_horario=? WHERE id_persona=?";
        $stmt=$this->dbh->prepare($sql);
		$stmt->bindValue(1,$_POST["id_horario"],PDO::PARAM_STR);
        $stmt->bindValue(2,$_POST["id"],PDO::PARAM_STR);
			
        $stmt->execute();
        $this->dbh=null;
		$sql;
		 echo"<script type='text/javascript'>
			alert('insertado correctamente');
			window.location='funcionarios.php';
			</script>";
			}
				public function add_maquinas_(){
			 self::set_names();
        $sql="UPDATE persona SET cod_maquinas=? WHERE id_persona=?";
        $stmt=$this->dbh->prepare($sql);
		$stmt->bindValue(1,$_POST["cod_maquinas"],PDO::PARAM_STR);
        $stmt->bindValue(2,$_POST["id"],PDO::PARAM_STR);
			
        $stmt->execute();
        $this->dbh=null;
		$sql;
		 echo"<script type='text/javascript'>
			alert('insertado correctamente');
			window.location='funcionarios.php';
			</script>";
			}
			
			public function add_maquinas(){
			 self::set_names();
        $sql="insert into maquinas
		values
		(null,?,?,now());";
        $stmt=$this->dbh->prepare($sql);
		$stmt->bindValue(1,$_POST["cod"],PDO::PARAM_STR);
		$stmt->bindValue(2,$_POST["estado"],PDO::PARAM_STR);
		
	
        $stmt->execute();
        $this->dbh=null;
		 echo"<script type='text/javascript'>
			alert('AGREDADO CORRECTAMENTE');
			window.location='reporte_maquinas.php';
			</script>";
			}
			public function get_maquinas()
    {
		self::set_names();
       $sql="select id_maquinas, cod_maquinas, estado, fecha_estado from (SELECT * FROM maquinas ORDER BY id_maquinas DESC ) t GROUP BY cod_maquinas ORDER BY cod_maquinas ASC;";
        foreach($this->dbh->query($sql) as $row)
        {
            $this->super2[]=$row;
        }
        return $this->super2;
        $this->dbh=null;	
    }
	//___________________________________GET BIOMETRICO__________________________________			
public function get_biometrico_campamento($camp)
    {
        self::set_names();
		$hoy=date("Y-m-d");
       $sql="SELECT p.id_persona AS NRO, p.nombres AS NOMBRE, p.ap_paterno AS PATERNO, p.ap_materno AS MATERNO, p.cod_maquinas AS MAQUINAS, m.estado AS ESTADO,m.fecha_estado AS FECHA, c.cargo AS CARGO
 FROM
 persona p, maquinas m, contratacion as c
 where p.cod_maquinas = m.cod_maquinas 
 AND p.id_persona = c.id_persona
 AND   p.cod_maquinas != '0'
 AND p.id_campamento = $camp
  AND m.fecha_estado = '$hoy'
  GROUP BY p.cod_maquinas
ORDER BY p.cod_maquinas DESC";
		foreach($this->dbh->query($sql) as $row)
        {
            $this->super2[]=$row;
        }
        return $this->super2;
        $this->dbh=null;
    }
		public function get_campamento_buscar($cam, $fecha)
    {
        self::set_names();
       $sql="SELECT p.id_persona AS NRO, p.nombres AS NOMBRE, p.ap_paterno AS PATERNO, p.ap_materno AS MATERNO, p.cod_maquinas AS MAQUINAS, m.estado AS ESTADO,m.fecha_estado AS FECHA, c.cargo AS CARGO
 FROM
 persona p, maquinas m, contratacion as c
 where p.cod_maquinas = m.cod_maquinas 
 AND p.id_persona = c.id_persona
 AND   p.cod_maquinas != '0'
 AND p.id_campamento = $cam
 AND m.fecha_estado = '$fecha'
  GROUP BY p.cod_maquinas
ORDER BY p.id_persona DESC";
		foreach($this->dbh->query($sql) as $row)
        {
            $this->super2[]=$row;
        }
        return $this->super2;
        $this->dbh=null;
    }	
//******************************************BUSCAR FUNCIONARIO CAMPAMENTOS********************************************
//______________________________________BUSCADOR FUNCIONARIO_________________________	
function buscador_funcionario_campamento($q){	
$nom=$this->saluda_al_usuario($_SESSION["ses_user"]);
$sql="select p.id_persona,p.nombres, p.ap_paterno, p.ap_materno, u.nombre_u, c.nombre from persona p, unidad u, campamento c WHERE p.id_campamento=c.id_campamento AND p.id_unidad=u.id_unidad AND p.nombres LIKE '%$q%' OR p.ap_paterno LIKE '%$q%' OR p.ap_materno LIKE '%$q%' group by p.nombres";
     $stmt=$this->dbh->prepare($sql);
     if($stmt->execute( array($q) ) ){		
		    print ' 
		<tr bgcolor="#75C2F3">	
<td align="center" valign="top" ><strong>Nombre</strong></td>
<td width="90" align="center" valign="top" ><strong>Ap Paterno</strong></td>
<td width="90" align="center" valign="top" ><strong>Ap Materno</strong></td>
<td width="250" align="center" valign="top" ><strong>Unidad</strong></td>
<td width="120" align="center" valign="top" ><strong>Campamento</strong></td>
<td width="90" align="center" valign="top" ><strong>Seleccionar</strong></td>
</tr>';
				$i=1;
	               while($row = $stmt->fetch()){
					   $i++; 
					   if ($i%2==0){
    echo '<tr bgcolor="#F4F7EB" >';
}else{
    echo '<tr bgcolor="#F5E68E" >';
}					  
                    $this->caja[]=$row;
	print '			

<td valign="top" align="center">'.$row['nombres'].'</td>
<td valign="top" align="center"><font face="serif" size="-1">'.$row['ap_paterno'].'</font></td>
<td align="center" valign="top"><font face="serif" size="-1">'.$row['ap_materno'].'</font></td>
<td align="center" valign="top"><font face="serif" size="-1">'.$row['nombre_u'].'</font></td>
<td align="center" valign="top"><font face="serif" size="-1">'.$row['nombre'].'</font></td>
<td valign="top" align="center"><a href="cambiar_campamento_id.php?id='.$row['id_persona'].'" title="camiar de campamento'.$row['nombres'].'" ><img src="images/click2.jpg" width="25" height="15" /></a></td>

</tr>
	';
					                }
                return $this->caja;
                $this->dbh=null; 
            }  			
}
//______________________________________ADD SANCION___________________________________		
public function add_sancion_(){
			 self::set_names();
        $sql="insert into sanciones
		values
		(null,?,?,?,?);";
        $stmt=$this->dbh->prepare($sql);
        $stmt->bindValue(1,$_POST["tiempo"],PDO::PARAM_STR);
		$stmt->bindValue(2,$_POST["fecha"],PDO::PARAM_STR);
		$stmt->bindValue(3,$_POST["detalle"],PDO::PARAM_STR);
		$stmt->bindValue(4,$_POST["id"],PDO::PARAM_STR);
        $stmt->execute();
        $this->dbh=null;
		 $sql;
		 echo"<script type='text/javascript'>
			alert('El se ha insertado correctamente correctamente');
			window.location='reportespersonales.php';
			</script>";
			}
			public function get_horas_sancion($id,$inicio,$fin)
    {		
        self::set_names();			
		$sql="SELECT SUM(tiempo) AS tiempo 
			FROM sanciones
			WHERE
			fecha >= '$inicio'
			AND fecha <= '$fin' 
			AND id_persona =$id";	

        foreach($this->dbh->query($sql) as $row)
        {
            $this->super2[]=$row;
        }
        return $this->super2;
        $this->dbh=null;
    }
//********************************************************************************************************************
}
?>

