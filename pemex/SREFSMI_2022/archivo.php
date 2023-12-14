<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Instituto Mexicano del Seguro Social</title>
<link href="include/hojadestilo.css" rel="stylesheet" type="text/css">
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
</style>
</head>
<body>
<form method="POST" name="form1" enctype="multipart/form-data" action="guardara.php">
<?php
include('encabezado.php');
include('conexion.php');
error_reporting(0);
foreach($_REQUEST as $k=>$v)
{$$k=($v); /*echo $k."=".$v."<br>";*/}
mysql_set_charset("utf8");
if(is_numeric($del))
$opcion="Entidad Federativa ";
else
$opcion=""; 

$delegoumae=mysql_query("SELECT
	a.delegoumae,
	pdf, fecsis
FROM	
cat_clues_pmx_2022  a 
LEFT JOIN pdf_pmx_2022 b ON	a.del = b.del
WHERE
a.del='$del'
LIMIT 1 ");
$row=mysql_fetch_array($delegoumae); 
?>
<div style="height:5px"></div>
<table align="center" border="1" height="70px" id="customers">
<tr>
<td width="80"><a href="del.php"><img src="Imagenes/inicio.jpg" border="0" width="32" alt="Inicio"/></a><br><strong><label onClick="window.location.href='del.php'">Inicio</label></strong></td>
<td><a href="Manual/Guia_ayuda_2021_SS.pdf"><img src="Imagenes/guia.jpg" border="0" width="37" alt="Guía de Ayuda"/></a><br><strong>Gu&iacute;a de Ayuda</strong></td>
<td width="80"><a href="del.php"><img src="Imagenes/regresar.jpg" border="0" width="34" alt="Regresar"/></a><br><strong><label onClick="window.location.href='del.php'">Regresar</label></strong></td>
</tr>
</table> 
<!--
<div style="height:5px"></div>
<table width="350" border="0" align="center">
  <tr>
    <th scope="row">
    <?php //echo '<marquee style="font-size:20px; "><strong>VERSIÓN DE PRUEBAS</strong></marquee>';?> 
    </th>
  </tr>
</table>
-->
<input name="del" type="text" id="del" value="<?php echo $del;?>" class="CampoOculto">
<input name="delegoumae" type="text" id="delegoumae" value="<?php echo $row[0];?>" class="CampoOculto">
<table  border="0" id="customers" align="center">
<tr>
  </tr>
  <tr>
    <td style="background-color:#FFF; border:0; color:#000;">
    	  <div align="center" style="background-color:#FFF; border:0; color:#000; font-size:18px; font-weight:bold"><br>
          <?php echo $opcion." ".$row[0];?><br>
          </div>
    
	  <div align="center" style="background-color:#FFF; border:0; color:#000; font-size:14px; font-weight:bold"><br>

<u>Paso 9.- Subir Reporte &ldquo;Versi&oacute;n Final&rdquo; firmado</u><br><br>
</div>
      <table width="480" border="0" align="center" id="customers2" style="border-collapse:collapse;">
        <tbody>
          <tr>
            <td colspan="2" style="border:0" height="6"></td>
            </tr>    
          <tr>
            <th colspan="2" ><div align="center">Subir pdf firmado </div></th>
          </tr>
          <tr>
            <td width="474" style="background-color:#EAF2D3; font-size:14px">
            <div align="center">             
              <p><br>
                <input type="file" name="userfile" id="upload" value="<?php echo $archivo;?>" />
                <img src="Imagenes/uploadb.gif" id="uploadb" style="display:none" width="60">
                <br>
                <br>
              </p>
              <p><?php if($row[1]!='')			  
			  {
				  ?>
                  <a href="files/<?php echo $row[1];?>"><br><img src="Imagenes/pdf.jpeg"><br>Consultar PDF subido <?php echo $row[2];?></a>		<!--esta linea se modifico 12 04 2022 -->	  
				  <?php } ?>
			  </p><br>
            </div>			
			</td>			
          </tr>
          </tbody>
        </table>		
	  <div align="left" style="color:#FF0000">Solo se aceptan archivos pdf con un peso m&aacute;ximo de 150 Megabytes.</div>
      <br>      
      </div>
</td>    
  </tr>
</table>
<table align="center">
<tr>     
<td style="background-color:#FFF; border:0; color:#000; font-size:18px" align="center">
          <input type="submit" name="Submit" id="btnsubmit" value="Guardar" onClick="return validaf();">
          <div id="etiquetaguardar" class="CampoOculto">Espere un momento, se est&aacute; guardando el archivo PDF. <br>Mientras m&aacute;s grande sea el archivo, el tiempo de espera ser&aacute; mayor.</div>
        </td>
    </tr>
</table>
</form>
	<?php 
	if($msn=='invalido')
	{
		?><script type="text/javascript">alert("FORMATO INVÁLIDO. SOLO SE ACEPTAN ARCHIVOS CON FORMATO PDF.");</script><?php 
	} 
	else if($msn=='big')
	{	
	?>
	<script type="text/javascript">alert("EL TAMAÑO MÁXIMO PERMITIDO ES DE 100MB");</script>
	<?php
	}	
?>
</body>
</html>