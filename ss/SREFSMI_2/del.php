<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
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
label {
cursor:pointer;
color: black; 
background-color: transparent;
}

/* table th {
    position: sticky;
    top: 0;
  }*/
</style>
</head>
<body>
<?php 
include 'conexion.php';
//include("include/dbcommon.php");
include 'Encabezado.php';
foreach($_REQUEST as $k=>$v)
{$$k=($v);}
mysql_set_charset("utf8");
?>
<div style="height:5px"></div>
<table align="center" border="1" height="70px" id="customers">
<tr>
<td><a href="Manual/Guia_de_Ayuda_2020V1.pdf"><img src="Imagenes/guia.jpg" border="0" width="37" alt="Guía de Ayuda"/></a><br><strong>Guía de Ayuda</strong></td>
</tr>
</table>
<br>
<!--
<table width="350" border="0" align="center">
  <tr>
    <th scope="row">
    <?php //echo '<marquee style="font-size:20px; "><strong>VERSIÓN DE PRUEBAS</strong></marquee>';?> 
    </th>
  </tr>
</table><br>-->
<div align="center" style="background-color:#FFF; border:0; color:#000; font-size:14px; font-weight:bold;">  
  <table width="480" border="0" id="customers"> 
    <tr>
      <td width="31" ><div align="center"><img src="Imagenes/verde.png" width="25" height="25"></div></td>
      <td width="404"><div align="left">La Entidad Federativa ha finalizado el registro de informaci&oacute;n</div></td>
    </tr>
    
    <tr>
      <td ><img src="Imagenes/rojo.png" width="25" height="25"></td>
      <td ><div align="left">La Entidad Federativa a&uacute;n no finaliza el registro de informaci&oacute;n</div></td>
    </tr>
  </table>
  <br>
    Captura del periodo 2021
</div>
<div align="center" style="background-color:#FFF; border:0; color:#000; font-size:14px; font-weight:bold">  
	<br>
Paso 1.- Seleccionar la Entidad Federativa a la que pertenece,<br>
haciendo clic izquierdo sobre el nombre del mismo.</div>
<div>
<table width="961"  border="0" align="center" id="customers">
    <form name="form1" method="POST">
        <thead>
          <tr>
            <th width="26" rowspan="2" ><div align="center">No.</div></th>
            <th rowspan="2" ><div align="center">Entidad Federativa</div></th>
            <th colspan="3"><div align="center">Unidades M&eacute;dicas </div></th>
            <th colspan="3"><div align="center">Reporte</div></th>
            <th width="81" rowspan="2"><div align="center">Sem&aacute;foro</div></th>
          </tr>
          <tr>
            <th width="59"><div align="center">Total </div></th>
            <th width="134"><div align="center">Con Excedentes/<br>
            Faltantes</div></th>
            <th width="125"><div align="center">Sin Excedentes/<br>
              Faltantes
</div></th>
            <th width="83"><div align="center">Preliminar</div></th>
            <th width="124"><div align="center">Final <br>
            (para firmas) </div></th>
            <th width="81"><div align="center">Subir<br>
            (firmado)</div></th>
          </tr>
		  </thead>
<?php 
$res=mysql_query("SELECT
a.del,
a.delegoumae,
COUNT(DISTINCT(clp2)) AS unidades,
CASE
WHEN SUM(IF(excedenteofaltante=1,1,0))>0 THEN 'del_conexcedenteofaltante' 
WHEN COUNT(DISTINCT(clp2))=SUM(IF(excedenteofaltante=0,1,0)) THEN 'del_sinnecesidad'
WHEN COUNT(DISTINCT(clp2))=SUM(IF(excedenteofaltante IS NULL,1,0)) THEN 'del_sinregistro' END AS status,
MAX(cerrado) AS cerrado
FROM
cat_clues_ss a
GROUP BY
a.del
ORDER BY
a.del");

while($row=mysql_fetch_array($res))
{
	++$n;
	$dels[$n]=$row["del"];
    $delegoumaes[$n]=$row["delegoumae"];
	$unidadess[$n]=$row["unidades"];
	$statuss[$n]=$row["status"];		
	$cerrados[$n]=$row["cerrado"];	
}

$conr=mysql_query("SELECT
del, 
delegoumae,
MAX(excedenteofaltante) AS excedenteofaltante
FROM
(
SELECT
del, 
delegoumae,
NULL AS excedenteofaltante
FROM
cat_clues_ss a
GROUP BY
a.del
UNION ALL
SELECT
del,
delegoumae,
COUNT(DISTINCT(clp)) AS excedenteofaltante
FROM
requerimiento_ss
GROUP BY
del
) a
GROUP BY
del
ORDER BY
del");

while($row2=mysql_fetch_array($conr))
{
	$delcondatos=$row2["del"];
	$indice = array_search($delcondatos, $dels);		
	$excedenteofaltantes[$indice]=number_format($row2["excedenteofaltante"],0);	
}

$conpdf=mysql_query("SELECT
del, 
delegoumae,
pdf
FROM
pdf_ss
GROUP BY
del
ORDER BY
del");

while($row3=mysql_fetch_array($conpdf))
{
	$delconpdf=$row3["del"];
	$indice = array_search($delconpdf, $dels);		

	$pdfs[$indice]=$row3["pdf"];	
}

//while($row=mysql_fetch_array($res))
for($i=1; $i<=$n; $i++)
{
	if($statuss[$i]=='del_sinregistro')
	{
		$rpreliminar="";
		$rfinal="";
		$semaforo='<img src="Imagenes/rojo.png" alt="" width="25" height="25">';
		$subir="";
	}	
	else if($statuss[$i]=='del_conexcedenteofaltante' || $statuss[$i]=='del_sinnecesidad')
	{
		if($cerrados[$i]==1)
		{	
			$rpreliminar="<strong>—</strong>";			
			$rfinal='<span onClick="pdf(\'Final\',\''.$statuss[$i].'\',\''.$dels[$i].'\')">Versión Final</span>';
			$semaforo='<img src="Imagenes/verde.png" alt="" width="25" height="25">';
			if($pdfs[$i]=="")
			$subir='<span onClick="subir(\'Final\',\''.$statuss[$i].'\',\''.$dels[$i].'\')">Subir</span>';
			else
			$subir='<span onClick="subir(\'Final\',\''.$statuss[$i].'\',\''.$dels[$i].'\')">Consultar/Modificar</span>';
		}
		else
		{		
			$rpreliminar='<span onClick="pdf(\'Preliminar\',\''.$statuss[$i].'\',\''.$dels[$i].'\')">Preliminar</span>'; 
			$rfinal='<span onClick="cerrar(\''.$dels[$i].'\',\''.$delegoumaes[$i].'\')">Finalizar Reporte</span>';		
			$semaforo='<img src="Imagenes/rojo.png" alt="" width="25" height="25">';			
			$subir="";
		}
	}
	
	/*else if($status=='del_conexcedenteofaltante' && $cerrado!=1)
	$reporte='<span onClick="pdf(\'Preliminar\',\''.$status.'\',\''.$del.'\')">Preliminar</span> / <span onClick="cerrar(\''.$del.'\',\''.$delegoumae.'\')">Versión Final</span>';
	else if($status=='del_conexcedenteofaltante' && $cerrado==1)
	$reporte='<span onClick="pdf(\'Final\',\''.$status.'\',\''.$del.'\')">Versión Final</span>';
	else
	$reporte='<strong>—</strong>';*/
	
	//{$reporte='<span onClick="pdf(\'Preliminar\',\''.$status.'\',\''.$del.'\')">Preliminar</span> / '.($cerrado==0) ? '<a href="cerrar.php">Versión Final</a>' : '';}
?>		<tbody>
          <tr onMouseOver="pintar(this,'#FFFFcc')" onMouseOut="pintar(this,'#FFFFFF')">
		<input type="text" id="<?php echo "del".$i;?>" name="<?php echo "del".$i;?>" value="<?php echo $dels[$i];?>" style="display:none">
		<input type="text" id="<?php echo "delegoumae".$i;?>" name="<?php echo "delegoumae".$i;?>" value="<?php echo $delegoumaes[$i];?>" style="display:none">
            <td><div align="right"><?php echo $i;?></div></td>            
            <td width="210"><div align="left"><span onClick="fdels( <?php echo $i;?>)"><?php echo $delegoumaes[$i];?></span></div></td>
            <td align="Right"><?php echo $unidadess[$i];?></td>
            <td align="Right"><?php if($statuss[$i]=='del_conexcedenteofaltante') echo $excedenteofaltantes[$i]; else if($statuss[$i]=='del_sinnecesidad') echo 0; else echo "";;?></td>
            <td align="Right"><?php if($statuss[$i]=='del_sinnecesidad') echo $unidadess[$i]; else if($statuss[$i]=='del_conexcedenteofaltante') echo $unidadess[$i]-$excedenteofaltantes[$i];?></td>
            <td align="Right" style="vertical-align:middle"><?php echo $rpreliminar;?></td>
            <td align="Right" style="vertical-align:middle"><?php echo $rfinal;?></td>
            <td style="vertical-align:middle" align="Right"><?php echo $subir;?></td>
            <td style="vertical-align:middle" align="Right"><?php echo $semaforo;?></td>
		  </tr>
        <?php }?>
        </tbody>
  </form>
</table>
</div>
<script>
<?php if($msn==1) {
	?>
alert("ARCHIVO GUARDADO");
<?php }
?>
</script>
<script language="JavaScript" type="text/javascript">
function pintar(objeto,col)
{objeto.bgColor=col;}
</script>
</body>
</html>