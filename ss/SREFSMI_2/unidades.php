<html>
<head>
<meta http-equiv = "Content-Type" content = "text/html; charset=utf-8" />
<title>
Instituto Mexicano del Seguro Social
</title>
<link href="estilos/estilo.css" rel="stylesheet" type="text/css">
<script src="include/validacionesvf6.js" type="text/javascript"></script>
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
 table th {
    position: sticky;
    top: 0;
 }
/*.tableFixHead { overflow-y: auto; height: 600px; }
.tableFixHead thead th { position: sticky; top: 0; }*/
/*.table {
  table-layout: fixed;
 }*/
 
</style>
</head>
<body>
<?php 
include 'conexion.php';
include 'Encabezado.php';
foreach($_REQUEST as $k=>$v)
{$$k=($v);}
mysql_set_charset("utf8");
if(is_numeric($del))
$entidad=("Entidad Federativa ");
else
$entidad=""; 
?>
<form ACTION="<?php echo $loginFormAction; ?>" id="form1" name="form1" method="POST">
<?php
$query=mysql_query("
SELECT
a.del,
a.delegoumae,
MAX(cerrado) AS cerrado
FROM
cat_clues_ss a
WHERE
a.del='$del'
GROUP BY
a.del");
$cerrado=mysql_fetch_array($query); $cerrado=$cerrado["cerrado"];
?>
<div style="height:5px"></div>
<table align="center" border="1" height="70px" id="customers">
<tr>
<td width="80"><a href="del.php"><img src="Imagenes/inicio.jpg" border="0" width="32" alt="Inicio"/></a><br><strong><label onClick="window.location.href='del.php'">Inicio</label></strong></td>
<td><a href="Manual/Guia_de_Ayuda_2020V1.pdf"><img src="Imagenes/guia.jpg" border="0" width="37" alt="Guía de Ayuda"/></a><br><strong>Guía de Ayuda</strong></td>
<td width="80"><a href="del.php"><img src="Imagenes/regresar.jpg" border="0" width="34" alt="Regresar"/></a><br><strong><label onClick="window.location.href='del.php'">Regresar</label></strong></td>
</tr>
</table> 
<!--
<div lign="center">
<table width="350" border="0" align="center">
  <tr>
    <th scope="row">
    <?php // echo '<marquee style="font-size:20px; "><strong>VERSIÓN DE PRUEBAS</strong></marquee>';?> 
    </th>
  </tr>
</table>
</div>
-->
<div align="center" style="background-color:#FFF; border:0; color:#000; font-size:18px; font-weight:bold"><br>
<?php echo $entidad." ".$delegoumae;?>
</div>
<div align="center" style="background-color:#FFF; border:0; color:#000; font-size:14px; font-weight:bold">
<?php 
if($cerrado==1)
{
echo "<br><label style='color:red'>REGISTRO DE INFORMACIÓN CERRADO.</label> <br>Si requiere apertura, solicitelo a la Mta. Vanessa Elizabeth López González.";
}
?>
</div><br>

<div id="contenido">
<?php
if($cerrado!=1)
{
?>
<div align="center" style="background-color:#FFF; border:0; color:#000; font-size:14px; font-weight:bold">
Paso 3.- Del siguiente listado, ingresar a la unidad médica que tiene excedentes y/o faltantes, 
<br>
haciendo clic izquierdo sobre el nombre de la misma.
</div>
<br>
<div id="nota" align="center" style="background-color:#FFF; border:0; color:#000; font-size:12px;">
<strong>Nota: </strong>en el caso de las Unidades Médicas que no tienen Excedentes y/o Faltantes, no es necesario realizar ninguna acción.
</div>
<?php } ?>
<table  border="0" align="center" id="customers">
	<input type="text" id="del" name="del" value="<?php echo $del;?>" style="display:none">
	<input type="text" id="delegoumae" name="delegoumae" value="<?php echo $delegoumae;?>" style="display:none">
        <tbody>

          <tr>
            <th width="39" ><div align="center">No.</div></th>
            <th width="74" ><div align="center">CLUES</div></th>
            <th width="466" ><div align="center">Unidad M&eacute;dica</div></th>
            <th width="148"><div align="center">&iquest;Con excedentes/<br>
            faltantes? </div></th>

          </tr>
<?php 

$res=mysql_query("
SELECT
a.clp2,
a.clues,
nom_sec,
nom_imss,
a.tipo,
a.numero,
a.localidad,
CASE 
WHEN a.excedenteofaltante=1 AND b.clp IS NOT NULL THEN 1
WHEN a.excedenteofaltante=1 AND b.clp IS NULL THEN NULL 
WHEN a.excedenteofaltante=0 AND cerrado=1 THEN 0 
WHEN a.excedenteofaltante=0 AND cerrado=0 THEN NULL END AS excedenteofaltante
FROM
cat_clues_ss a LEFT JOIN requerimiento b ON a.clp2=b.clp
WHERE
a.del='$del'
GROUP BY
a.clp2
ORDER BY
a.localidad, a.tipo, CAST(a.numero AS UNSIGNED)
");


while($row=mysql_fetch_array($res))
{
	$i++;
	$clp =$row["clp2"];
    $clues= $row["clues"];
	$nom_sec= $row["nom_sec"];
	$nom_imss=$row["tipo"]." ".$row["numero"].", ".$row["localidad"];
	$excedenteofaltante=$row["excedenteofaltante"];
	if($excedenteofaltante=="")
	$semaforo='<img src="Imagenes/rojo.png" alt="" width="25" height="25">';
	else
	$semaforo='<img src="Imagenes/verde.png" alt="" width="25" height="25">';
	?>
       
          <tr onMouseOver="pintar(this,'#FFFFcc')" onMouseOut="pintar(this,'#FFFFFF')">
            <td <?php //if($i % 2 != 0) echo 'style="background-color:#EAF2D3"';?>><div align="right"><?php echo $i;?></div>
			<input type="text" id="<?php echo "clp".$i;?>" name="<?php echo "clp".$i;?>" value="<?php echo $clp;?>" style="display:none">
			<input type="text" id="<?php echo "clues".$i;?>" name="<?php echo "clues".$i;?>" value="<?php echo $clues;?>" style="display:none">
			<input type="text" id="<?php echo "nom_sec".$i;?>" name="<?php echo "nom_sec".$i;?>" value="<?php echo $nom_sec;?>" style="display:none">
			<input type="text" id="<?php echo "nom_imss".$i;?>" name="<?php echo "nom_imss".$i;?>" value="<?php echo $nom_imss;?>" style="display:none">			</td>
            <td <?php //if($i % 2 != 0) echo 'style="background-color:#EAF2D3"';?> align="left"><div align="right"><span onClick="ums(<?php echo $i;?>)"><?php echo $clues;?></span></div></td>			
            <td <?php //if($i % 2 != 0) echo 'style="background-color:#EAF2D3"';?> align="left"><div align="left"><?php if($cerrado!=1) {?><span onClick="ums(<?php echo $i;?>)"><?php echo $nom_imss;?></span><?php } else echo $nom_imss;?></div></td>
            <td <?php //if($i % 2 != 0) echo 'style="background-color:#EAF2D3"';?> align="Right"><div align="center"><strong><?php if($excedenteofaltante==1) echo "SI"; else if($excedenteofaltante==NULL) echo ""; else if($excedenteofaltante==0) echo "NO"; ?></strong></div></td>

          </tr>
        <?php }?>
	  <input type="hidden" id="refreshed" value="no">
        </tbody>
</table>
</div>
</form>
<script type="text/javascript">
window.onload=function()
{		

}
function pintar(objeto,col)
{
	objeto.bgColor=col;
}
</script> 
</body>
</html>