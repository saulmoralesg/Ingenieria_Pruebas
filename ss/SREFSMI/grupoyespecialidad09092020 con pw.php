<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
<meta charset="UTF-8">
<title>
Instituto Mexicano del Seguro Social
</title>
<link href="estilos/estilo.css" rel="stylesheet" type="text/css">
<script src="include/validacionesvf1.js" type="text/javascript"></script>
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
padding-top:0px;
padding-bottom:0px;
background-color:#669900;
color:#fff;
}
#customers tr.alt td 
{
color:#000;
background-color:#EAF2D3;
}
.Estilo6 {font-size: 11pt}
.highlight {color:red;}
label {
cursor:pointer;
color: black; 
background-color: transparent;
}
/*.tableFixHead { overflow-y: auto; height: 600px; }
.tableFixHead thead th { position: sticky; top: 0; }*/
/*.table {
  table-layout: fixed;
 }*/ 
</style>
</head>
<body>
<?php require_once('Connections/sectorial.php'); ?>
<?php
mysql_select_db($database_sectorial, $sectorial);
$query_gruposerv = "SELECT * FROM cat_id_sec_ss  group by gpo_serv";
$gruposerv = mysql_query($query_gruposerv, $sectorial) or die(mysql_error());
$row_gruposerv = mysql_fetch_assoc($gruposerv);
$totalRows_gruposerv = mysql_num_rows($gruposerv);
include 'conexion.php';
conectar();
include 'Encabezado.php';
?>
<?php 
foreach($_REQUEST as $k=>$v)
{$$k=($v);}
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
<td><a href=""><img src="Imagenes/guia.jpg" border="0" width="37" alt="Guía de Ayuda"/></a><br><strong><label onClick="window.location.href=''">Guía de Ayuda</label></strong></td>
<td width="80"><a href="#" onClick="document.getElementById('regresar').submit();"><img src="Imagenes/regresar.jpg" alt="atras" border="0" width="34"/></a><br><strong><label onClick="document.getElementById('regresar').submit();">Regresar</label></strong></td>
</tr>
</table>
<form name="regresar" id="regresar" method="POST" action="unidades.php">
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
<div align="center" style="background-color:#FFF; border:0; color:#000; font-size:14px; font-weight:bold"><br>
<?php echo $entidad." ".$delegoumae;?><br>
Unidad Médica: <?php echo $nom_sec;?>
<br><br>
</div>

<div id="contenido">
<div align="center" style="background-color:#FFF; border:0; color:#000; font-size:14px; font-weight:bold">
Paso 4.- Seleccionar  el Grupo de Servicio en el que se tiene Excedentes y/o Faltantes,<br>
haciendo clic izquierdo sobre el nombre del mismo.</div>
<br>
<div align="center" style="background-color:#FFF; border:0; color:#000; font-size:12px;">
<strong>Nota: </strong>En el caso de los Grupos de Servicio que no tienen Excedentes y/o Faltantes, no es necesario realizar ninguna acción.
	</div>			
<table border="0" cellspacing="0" align="center" id="customers">
<thead>
<tr>
  <td colspan="3" style="border:hidden">
  <div align="left" style="background-color:#FFF; border:0; color:#000; font-size:11px;">
<strong></strong></div>  </td>
  </tr>
<tr>
<th width="32" ><div align="center">No.</div></th>
<th ><div align="center">Grupo de Servicio</div></th>
<th ><div align="center">&iquest;Con Excedente<br>
  y/o Faltante?</div></th>
</tr>
</thead>
<tbody>    	  
<?php
$res=mysql_query("SELECT 
gpo_serv,
a.producto,
b.grupo,
excedentea,
excedenteh,
faltantea,
faltanteh
FROM
cat_id_sec_ss  a LEFT JOIN vgrupoyespecialidad_ss  b ON a.gpo_serv=b.grupo
AND
b.clp='$clp'
GROUP BY 
gpo_serv
ORDER BY
gpo_serv");

while($row=mysql_fetch_array($res))
{
	++$i;			
	$ids[$i]=($row["gpo_serv"]);
	$conr[$i]=$row["excedentea"]+$row["excedenteh"]+$row["faltantea"]+$row["faltanteh"];
?>			
	<tr onMouseOver="pintar(this,'#FFFFcc')" onMouseOut="pintar(this,'#FFFFFF')">	
    <td><div align="right"><?php echo $i;?></div></td>
    <td><div align="left"><input type="text" name="<?php echo "grupo".$i;?>" id="<?php echo "grupo".$i;?>" value="<?php echo $ids[$i];?>" style="display:none">
	<span onClick="xyz(<?php echo $i;?>,<?php echo $i;?>)"><?php echo $ids[$i];?></span>
	</div></td>            	
	<td><div align="center">		
	<?php if($conr[$i]>0) echo "<strong>SI</strong>";?></div></td>
	<?php  ?>
    </tr>	
    <?php }?>
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