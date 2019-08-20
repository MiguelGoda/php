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
//***********************************GET TABLA ID************************************
public function get_tabla_id($nom_id,$id,$tabla)
    {
        if(isset($id))
        {
            self::set_names();
            $sql="select * from $tabla where $nom_id=?
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
	//_____________________________________GET BIOMETRICO FECHA_________________________
public function get_biometrico_fecha($inicio,$fin)
    {
            self::set_names();
        $sql="select fecha from biometrico where fecha >= '$inicio' AND fecha <= '$fin' group by fecha;";
            foreach($this->dbh->query($sql) as $row)
        {
            $this->super2[]=$row;
        }
        return $this->super2;
        $this->dbh=null;          
    }
	//_____________________________________GET BIOMETRICO COMPARAR FECHA_________________________
 public function get_biometrico_com($fech,$nom)
    {
            self::set_names();
              $sql="SELECT observacion AS OBSERVACION, hora AS HORA, fecha AS FECHA
 				FROM
 				biometrico
 				where
 				fecha = '$fech' and nro='$nom' order by hora asc;";			 
        foreach($this->dbh->query($sql) as $row)
        {
            $this->super2[]=$row;
        }
        return $this->super2;
        $this->dbh=null;
    }
}
?>

