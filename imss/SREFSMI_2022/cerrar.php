<?php 
require("include/dbcommon.php");
$conn=mysql_connect($host,$user,$pass);
if (!$conn || !mysql_select_db($dbname,$conn)) 
{trigger_error(mysql_error(), E_USER_ERROR);}  

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

// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}



if (isset($_POST['del'])) 
{
  
  	$loginUsername=$_POST['del'];
	$delegoumae=$_POST['delegoumae'];
    $cerrar=$_POST['cerrar'];
	$opcion=$_POST['opcion'];
    $val=$_POST['val'];
  	$password=$_POST['pwd'];
  	$MM_fldUserAuthorization = "";
  
  	$MM_redirectLoginSuccess = "archivo.php?del=$loginUsername";
  	$MM_redirectLoginFailed = "pwdu.php?del=$loginUsername&val=$val";
  	$MM_redirecttoReferrer = false;

	include("include/dbcommon.php");
	$conn=mysql_connect($host,$user,$pass);
	if (!$conn || !mysql_select_db($dbname,$conn)) 
	{trigger_error(mysql_error(), E_USER_ERROR);}  
  
	$LoginRS__query=sprintf("SELECT del, pwd13 FROM delegaciones WHERE del=%s AND pwd13=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
	$LoginRS = mysql_query($LoginRS__query) or die(mysql_error());
	$loginFoundUser = mysql_num_rows($LoginRS);
  	
	if($loginFoundUser) 
  	{	
		$loginStrGroup = "";
    	if (PHP_VERSION >= 5.1) 
		{session_regenerate_id(true);} 
		else 
		{session_regenerate_id();}
		//declare two session variables and assign them
		$_SESSION['MM_Username'] = $loginUsername;
		$_SESSION['MM_UserGroup'] = $loginStrGroup;	      
	
		if (isset($_SESSION['PrevUrl']) && false) 
		{
		  $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
		}
    
		//header("Location: " . $MM_redirectLoginSuccess );
		?>
		<form name="continuar" id="continuar" method="POST" action="guardar.php">
		<input type="text" name="del" id="del" style="display:none" value="<?php echo $loginUsername;?>" />
		<input type="text" name="delegoumae" id="delegoumae" value="<?php echo $delegoumae;?>" style="display:none">
		<input type="text" name="opcion" id="opcion" style="display:none" value="<?php echo $opcion;?>" />
		<input type="text" name="cerrar" id="cerrar" value="1" style="display:none">
		</form>
		<script>
		document.getElementById('continuar').submit()
		</script>
		<?php
  	}
	
	/*else if($val==1)
	{
		//header("Location: ". $MM_redirectLoginFailed );
		<form name="nocontinuar" id="nocontinuar" method="POST" action="pwdu.php">
		<input type="text" name="del" id="del" style="display:none" value="<?php echo $loginUsername;?>" />
		<input type="text" name="val" id="val" style="display:block" value="<?php echo $val;?>" />
		</form>

		?>
		
		<script>
		document.getElementById('nocontinuar').submit()
		</script>
	 <?php 
	 }*/
}

include 'Encabezado.php';
?>

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
</style>
</head>
<body>
<?php
require("include/dbcommon.php");
$conn=mysql_connect($host,$user,$pass);
if (!$conn || !mysql_select_db($dbname,$conn)) 
{trigger_error(mysql_error(), E_USER_ERROR);}  

foreach($_REQUEST as $k=>$v)
{$$k=$v;}
$query=mysql_query("SELECT
	COUNT(DISTINCT(clp2))AS um,	
CASE
WHEN COUNT(DISTINCT(clp2))=SUM(IF(excedenteofaltante=1,1,0)) THEN 'del_coneof' 
WHEN COUNT(DISTINCT(clp2))=SUM(IF(excedenteofaltante=0,1,0)) THEN 'del_sinnecesidad'
WHEN COUNT(DISTINCT(clp2))=SUM(IF(excedenteofaltante IS NULL,1,0)) THEN 'del_sinregistro' END AS status,
b.umconr
FROM
	cat_clues a LEFT JOIN vdelygrupo b ON a.del=b.del
WHERE
	a.del = '$del'");
$datos=mysql_fetch_array($query); $status=$datos["status"]; $um=$datos["um"]; $umconr=$datos["umconr"];

if(is_numeric($del))
{
	$entidad="OOAD";
	$opcion2="OOAD";
	$txt="Una vez que las Unidades Médicas del ".$opcion2." hayan registrado sus Excedentes y/o Faltantes, <br>se debe imprimir el reporte pdf (versión final) para su firma por los representantes del ".$opcion2.". 
<br><br>Para obtenerlo es necesario finalizar el registro.";	
}
else
{
	$entidad=""; 
	$opcion2="UMAE";
	if($um<2)
	$txt="Una vez que la ".$opcion2." haya registrado sus Excedentes y/o Faltantes, <br> debe imprimir el reporte pdf (versión final) para su firma por los representantes de la ".$opcion2.". 
<br><br>Para obtenerlo es necesario finalizar el registro.";	
	else
	$txt="Una vez que las Unidades Médicas de la ".$opcion2." hayan registrado sus Excedentes y/o Faltantes, <br>se debe imprimir el reporte pdf (versión final) para su firma por los representantes de la ".$opcion2.". 
	<br><br>Para obtenerlo es necesario finalizar el registro.";	
}
?>
<!--<form name="form1" id="form1" method="GET" action="guardar.php"> -->
<form ACTION="<?php echo $loginFormAction; ?>" id="form1" name="form1" method="POST">
<input type="text" name="del" id="del" value="<?php echo $del;?>" style="display:none">
<input type="text" name="delegoumae" id="delegoumae" value="<?php echo $delegoumae;?>" style="display:none">
<input type="text" name="cerrar" id="cerrar" value="1" style="display:none">
<div style="height:5px"></div>
<table align="center" border="1" height="70px" id="customers">
<tr>
<td width="80"><a href="del.php"><img src="Imagenes/inicio.jpg" border="0" width="32" alt="Inicio"/></a><br><strong><label onClick="window.location.href='del.php'">Inicio</label></strong></td>
<td><a href="Manual/Guia_de_Ayuda_2020V1.pdf"><img src="Imagenes/guia.jpg" border="0" width="37" alt="Guía de Ayuda"/></a><br><strong>Guía de Ayuda</strong></td>
<td width="80"><a href="del.php"><img src="Imagenes/regresar.jpg" border="0" width="34" alt="Regresar"/></a><br><strong><label onClick="window.location.href='del.php'">Regresar</label></strong></td>
</tr>
</table> 
<br>
<div align="center" style="background-color:#FFF; border:0; color:#000; font-size:14px; font-weight:bold">
<?php echo $entidad." ".$delegoumae;?>

<br><br>
<u>Paso 7.- Finalizar el registro de Excedentes y Faltantes <?php if($entidad=="") echo " de la UMAE"; else echo "del ".$entidad;?></u>

<br>
<br>
<?php echo $txt;?><br><br>
  <?php echo "<label style='color:red'>¿Desea finalizar el registro?</label>";?>
</div>
<div align="center">
<?php
/*if($opcion=="")
{
	if($status=='del_sinregistro')
	$opcion="";
	else if($status=='del_coneof')
	$opcion="SI";
	else if($status=='del_sinnecesidad')
	$opcion="NO";
}*/

if($opcion=="SI")
{?>
<select name="opcion" id="opcion" onChange="fcerrar(this)">
<option value="SI">SI</option>
<option value="NO">NO</option>
<option value="0">Seleccione una opción</option>
</select>
<?php }
else if($opcion=="NO")
{?>
<select name="opcion" id="opcion" onChange="fcerrar(this)">
<option value="NO">NO</option>
<option value="SI">SI</option>
<option value="0">Seleccione una opción</option>
</select>
<?php } 
else 
{?>
<select name="opcion" id="opcion" onChange="fcerrar(this)">
<option value="0">Seleccione una opción</option>
<option value="SI">SI</option>
<option value="NO">NO</option>
</select>
<?php } ?>
</div>
<br>
<div id="contenido">
<div align="center" style="background-color:#FFF; border:0; color:#000; font-size:12px;">
<strong>Nota: </strong>Al finalizar el registro, las Unidades Médicas no podrán realizar modificaciones.
	</div>			
</div>
<div id="guardar" align="center">
<div style="background-color:#FFF; border:0; color:#000; font-size:13px; font-weight:bold; color:#FF0000">
<?php 
if($umconr<$um)
{
	if($um>1)
	echo "Nota: Existen Unidades Médicas que no registraron Excedentes/Faltantes.<br><br>¿Está seguro de cerrar el registro de información?<br>";
	else
	echo "Nota: La UMAE no registró Excedentes/Faltantes.<br><br>¿Está seguro de cerrar el registro de información?<br>";
	
}
if($entidad=="")
echo "En caso afirmativo ingrese la contraseña de la UMAE y de clic izquierdo en el botón Guardar.";
else 
echo "En caso afirmativo ingrese la contraseña del ".$entidad." y de clic en el botón Guardar.";
?>

<?php
if($val=='1')
{
?>
<p class="navLink" style="color:#FF0000; font-size:16px"><strong>Contrase&ntilde;a Incorrecta</strong></p>
<?php } else echo "<br><br>";?>
<table width="345" border="1" id="customers">
    <tr>
      <td align="center">Ingresar contraseña:</td>
      </tr>
    <input type="text" name="val" id="val" value="<?php echo '1'; ?>" class="CampoOculto"/>
    <tr>
      <td>
        <div align="center">
          <input type="password" name="pwd" id="pwd"/>          
        </div></td>
      </tr>
    <tr>
    <td align="center">
	<!--<input type="submit" name="save" id="save" value="Guardar" onClick="return valida()">-->
	<input type="submit" name="save" id="save" value="Guardar">
	</td>
      </tr>
  </table> 
<script>

</script>
</div>
<br>


</div>
</form>
<script type="text/javascript">
window.onload=function()
{		
	<?php if($val==1) { ?>
	document.getElementById("pwd").focus();
	<?php } ?>
	var obj = document.getElementById("opcion");
	var respuesta = obj.options[obj.selectedIndex].value;			

	if(respuesta=="SI")	
	{
		document.getElementById("contenido").style.display='none';
		document.getElementById("guardar").style.display='block';
	}	
	else
	{
		document.getElementById("contenido").style.display='none';
		document.getElementById("guardar").style.display='none';
	}
}
function pintar(objeto,col)
{
	objeto.bgColor=col;
}
</script> 
</body>
</html>