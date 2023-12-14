<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
<meta charset="UTF-8">
<title> 
Instituto Mexicano del Seguro Social
</title>
<link href="estilos/estilo.css" rel="stylesheet" type="text/css">
<script src="include/cajassss.js" type="text/javascript"></script>
<script type="text/javascript" src="include/fixedheadertable/jquery.min_1.7.2.js"></script>
<script type="text/javascript" src="include/fixedheadertable/jquery.fixedheadertable.min.js"></script>
<script type="text/javascript" src="include/fixedheadertable/demo.js"></script>
<link rel="stylesheet" href="include/fixedheadertable/defaultTheme.css" media="screen" />
<script src="include/validacionesvf2.js" type="text/javascript"></script>
<style>
#customers
{
font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
/*width:100%;*/
border-collapse:collapse;
}
#customers td, #customers th 
{
font-size:1 em;
border:1px solid #98bf21;
padding:1px 3px 1px 3px;
}
#customers th 
{
font-size:14px; 
text-align:left;
padding-top:4px;
padding-bottom:4px;
background-color:#669900;
color:#fff;
font: inherit;
}
#customers tr.alt td 
{
color:#000;
background-color:#EAF2D3;
}
.Estilo6 {font-size: 11pt}
span {
cursor:pointer;
color: green; 
background-color: transparent;
text-decoration:underline;
}
input.largerCheckbox
{
width: 18px;
height: 18px;
}
</style>
</head>
<body>
<?php require_once('Connections/sectorial.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_sectorial, $sectorial);
$query_gruposerv = "SELECT * FROM cat_id_sec_issste_2022  group by gpo_serv";
$gruposerv = mysql_query($query_gruposerv, $sectorial) or die(mysql_error());
$row_gruposerv = mysql_fetch_assoc($gruposerv);
$totalRows_gruposerv = mysql_num_rows($gruposerv);

include 'conexion.php';
conectar();
include 'Encabezado.php';
?>
<?php 
foreach($_REQUEST as $k=>$v)
{$$k=htmlentities($v);}
mysql_set_charset("utf8");
if(is_numeric($del))
$entidad="Delegación ";
else
$entidad=""; 
$nivel=substr($clp,8,4);
if($nivel=='2110' OR $nivel=='2153')
$articulo="La";
else
$articulo="El";
?>

<div style="height:5px"></div>
<table align="center" border="1" height="70px" id="customers">
<tr>
<td width="80"><a href="del.php"><img src="Imagenes/inicio.jpg" width="32"></a><br><strong><label onClick="window.location.href='del.php'">Inicio</label></strong></td>
<td><a href="Manual/Guia_ayuda_2021_SS.pdf"><img src="Imagenes/guia.jpg" border="0" width="37" alt="Guía de Ayuda"/></a><br><strong>Guía de Ayuda</strong></td>
<td width="80"><a href="#" onClick="document.getElementById('regresar').submit();"><img src="Imagenes/regresar.jpg" alt="atras" border="0" width="34"/></a><br><strong><label onClick="document.getElementById('regresar').submit();">Regresar</label></strong></td>
</tr>
</table>
<form name="regresar" id="regresar" method="POST" action="grupoyespecialidad.php">
<input type="text" name="del" id="del" value="<?php echo $del; ?>" class="CampoOculto">
<input type="text" name="delegoumae" id="delegoumae" value="<?php echo $delegoumae; ?>" class="CampoOculto">
<input type="text" id="opcion" name="opcion" value="<?php echo $opcion;?>" class="CampoOculto" >	
</form>

<form name="registro" id="registro" method="POST" action="guardar.php">
<input type="text" id="del" name="del" value="<?php echo $del;?>" style="display:none">
<input type="text" id="delegoumae" name="delegoumae" value="<?php echo $delegoumae;?>" style="display:none">
<input type="text" id="clp" name="clp" value="<?php echo $clp;?>" style="display:none">
<input type="text" id="clues" name="clues" value="<?php echo $clues;?>" style="display:none">
<input type="text" id="nom_sec" name="nom_sec" value="<?php echo $nom_sec;?>" style="display:none">
<input type="text" id="nom_imss" name="nom_imss" value="<?php echo $nom_imss;?>" style="display:none"> 
<div style="height:15px"></div>
<table width="350" border="0" align="center">
  <tr>
    <th scope="row">
    <?php echo '<marquee style="font-size:20px; "><strong>VERSIÓN DE PRUEBAS</strong></marquee>';?> 
    </th>
  </tr>
</table>
<div align="center" style="background-color:#FFF; border:0; color:#000; font-size:18px; font-weight:bold"><br>
<?php echo $entidad." ".$delegoumae;?><br>
Unidad Médica: <?php echo $nom_sec;?>
<br><br>
</div>



<div id="contenido">
<div align="center" style="background-color:#FFF; border:0; color:#000; font-size:14px; font-weight:bold">
Paso 4.- Seleccionar  la especialidad en la que se tiene excedentes y/o faltantes,<br>
haciendo clic izquierdo sobre el nombre de la misma.</div><br>
<div align="center" style="background-color:#FFF; border:0; color:#000; font-size:12px;">
<strong>Nota: </strong>en el caso de las especialidades que no tienen Excedentes y/o Faltantes, no es necesario realizar ninguna acción.
	</div>			
<table border="0" cellspacing="0" align="center" id="customers">
<thead>
<tr>
  <td colspan="4" style="border:hidden">
  <div align="left" style="background-color:#FFF; border:0; color:#000; font-size:11px;">
<strong></strong>
</div>
  </td>
  </tr>
<tr>

<th width="32" ><div align="center">No.</div></th>
<th ><div align="center">Grupo de Servicio</div></th>
<th ><div align="center">Especialidad Troncal </div></th>
<th ><div align="center">&iquest;Con Excedente<br>
  y/o Faltante?</div></th>
</tr>
</thead>
<tbody>    	  
<?php
$res=mysql_query("SELECT 
no_grup_clas,
gpo_serva,
gpo_serv,
esp_tron_o_serv,
a.producto,
b.grupo,
excedentea,
excedenteh,
faltantea,
faltanteh
FROM
cat_id_sec_issste_2022  a LEFT JOIN vgrupoyespecialidad_issste_2022  b ON a.gpo_serv=b.grupo AND a.esp_tron_o_serv=b.especialidad 
AND
b.clp='$clp'
GROUP BY 
gpo_serva,
gpo_serv,
esp_tron_o_serv
ORDER BY
no_grup_clas,gpo_serv,esp_tron_o_serv");

while($row=mysql_fetch_array($res))
{
++$i;			
	$idsa[$i]=$row["gpo_serva"];
	$ids[$i]=$row["gpo_serv"];
	$especialidad[$i]=$row["esp_tron_o_serv"];
	$conr[$i]=$row["excedentea"]+$row["excedenteh"]+$row["faltantea"]+$row["faltanteh"];
}
			
for($a=1; $a<=$i; $a++)
{////seccion 1
	if($idsa[$a]!=$idsa[$a+1])
	{	
		 ++$filasa;
		$ida[$filasa]=$idsa[$a];				
		$enquefilacortaa[$filasa]=$a;								
		$rowspanxfilaa[$filasa]=$enquefilacortaa[$filasa]-$enquefilacortaa[$filasa-1];
	}	
	
	///secion 2
	if($ids[$a]!=$ids[$a+1])
	{	
		 ++$filas;
		$id[$filas]=$ids[$a];				
		$enquefilacorta[$filas]=$a;								
		$rowspanxfila[$filas]=$enquefilacorta[$filas]-$enquefilacorta[$filas-1];
	}			
}
	/*	
for($a=1; $a<=$filasa; $a++)	
{		?>	
<tr>
<td onMouseOver="pintar(this,'#FFFFcc')" onMouseOut="pintar(this,'#FFFFFF')" <?php //if($i % 2 != 0) echo 'style="background-color:#EAF2D3"';?>>
		<input type="text" name="<?php echo "esp".$m;?>" id="<?php echo "esp".$m;?>" value="<?php echo $especialidad[$m];?>" style="display:none">
		<div align="left"><span onClick="xyz(<?php echo $c;?>,<?php echo $m;?>)"><?php echo $m." ".$especialidad[$m];?></span></div></td>

<?php 
	//for($c=1; $c<=$rowspanxfilaa[$c]; $c++)
//	{ ++$m;?>
		
*/


for($i=1; $i<=$filas; $i++)			
{
?>			
		
    <td <?php //if($i % 2 != 0) echo 'style="background-color:#EAF2D3"';?> rowspan="<?php echo $rowspanxfila[$i];?>"><div align="right"><?php echo $i;?></div></td>
    <td <?php //if($i % 2 != 0) echo 'style="background-color:#EAF2D3"';?> rowspan="<?php echo $rowspanxfila[$i];?>"><div align="left"><input type="text" name="<?php echo "grupo".$i;?>" id="<?php echo "grupo".$i;?>" value="<?php echo $id[$i];?>" style="display:none"><?php echo $id[$i];?></div></td>            
	<?php 
	for($b=1; $b<=$rowspanxfila[$i]; $b++)
	{ ++$d;?>
		<td onMouseOver="pintar(this,'#FFFFcc')" onMouseOut="pintar(this,'#FFFFFF')" <?php //if($i % 2 != 0) echo 'style="background-color:#EAF2D3"';?>>
		<input type="text" name="<?php echo "esp".$d;?>" id="<?php echo "esp".$d;?>" value="<?php echo $especialidad[$d];?>" style="display:none">
		<div align="left"><span onClick="xyz(<?php echo $i;?>,<?php echo $d;?>)"><?php echo $d." ".$especialidad[$d];?></span></div></td>
		<td onMouseOver="pintar(this,'#FFFFcc')" onMouseOut="pintar(this,'#FFFFFF')" <?php //if($i % 2 != 0) echo 'style="background-color:#EAF2D3"';?>><div align="center">		
		<?php if($conr[$d]>0) echo "<strong>SI</strong>";?></div></td>
		<?php  ?>
        </tr>	
       <?php }}?>
      </tbody>
</table>
</div> <!--Fin id contenido-->
</form>
</body>
<script language="JavaScript" type="text/javascript">
function pintar(objeto,col)
{objeto.bgColor=col;}
</script>
</html>
<?php
mysql_free_result($res);
?>