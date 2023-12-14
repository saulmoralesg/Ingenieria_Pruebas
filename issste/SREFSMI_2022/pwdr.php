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
	$clp=$_POST['clp'];
	$clues=$_POST['clues'];
	$nom_sec=$_POST['nom_sec'];
	$nom_imss=$_POST['nom_imss'];
	$grupo=$_POST['grupo'];
	$opcion=$_POST['opcion'];
	$password=$_POST['pwd'];
	foreach($_REQUEST as $k=>$v)
{$$k=($v);}
  	$MM_fldUserAuthorization = "";
  	$MM_redirectLoginSuccess = "registro.php?del=$loginUsername&delegoumae=$delegoumae&clp=$clp&clues=$clues&nom_sec=$nom_sec&nom_imss=$nom_imss&grupo=$grupo&opcion=$opcion";
  	$MM_redirectLoginFailed = "pwdr.php?del=$loginUsername&delegoumae=$delegoumae&clp=$clp&clues=$clues&nom_sec=$nom_sec&nom_imss=$nom_imss&grupo=$grupo&opcion=$opcion&val=$val";
  	$MM_redirecttoReferrer = false;

	include("include/dbcommon.php");
	$conn=mysql_connect($host,$user,$pass);
	if (!$conn || !mysql_select_db($dbname,$conn)) 
	{trigger_error(mysql_error(), E_USER_ERROR);}  
  
	$LoginRS__query=sprintf("SELECT del, pwd13 FROM delegaciones_issste_2022  WHERE del=%s AND pwd13=%s",
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
		<form name="continuar" id="continuar" method="POST" action="registro.php">
		<input type="text" name="del" id="del" value="<?php echo $del; ?>" class="CampoOculto">
		<input type="text" name="delegoumae" id="delegoumae" value="<?php echo $delegoumae; ?>" class="CampoOculto" >
		<input type="text" name="clues" id="clues" value="<?php echo $clues; ?>" class="CampoOculto">
		<input type="text" name="clp" id="clp" value="<?php echo $clp; ?>" class="CampoOculto" >
		<input type="text" name="nom_sec" id="nom_sec" value="<?php echo $nom_sec; ?>" class="CampoOculto" >
		<input type="text" name="nom_imss" id="nom_imss" value="<?php echo $nom_imss; ?>" class="CampoOculto" >
		<input type="text" name="grupo" id="grupo" value="<?php echo $grupo; ?>" class="CampoOculto" >
		<input type="text" name="opcion" id="opcion" value="<?php echo $opcion; ?>" class="CampoOculto" >
    	<input type="text" name="val" id="val" value="<?php echo '1'; ?>" class="CampoOculto"/>
		</form>
		<script>
		document.getElementById('continuar').submit()
		</script>
		<?php
  	}
}
include 'Encabezado.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Instituto Mexicano del Seguro Social</title>
<link rel="stylesheet" type="text/css" href="estilos/estilo.css" media="screen" />
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
.CampoOculto
{
display:none;
}
/* table th {
    position: sticky;
    top: 0;
  }*/
</style>
</head>
<?php 
foreach($_REQUEST as $k=>$v)
{$$k=($v);}
if(is_numeric($del))
$entidad=("Delegación");
else
$entidad=""; 
mysql_set_charset("utf8");
include("include/dbcommon.php");
$conn=mysql_connect($host,$user,$pass);
if (!$conn || !mysql_select_db($dbname,$conn)) 
{trigger_error(mysql_error(), E_USER_ERROR);}  
?>
<body onLoad="document.form1.pwd.focus()">
<div style="height:5px"></div>
<table align="center" border="1" height="70px" id="customers">
<tr>
<td width="80"><a href="del.php"><img src="Imagenes/inicio.jpg" width="32"></a><br><strong><label onClick="window.location.href='del.php'">Inicio</label></strong></td>
<td><a href="Manual/Guia_de_Ayuda_2020V1.pdf"><img src="Imagenes/guia.jpg" border="0" width="37" alt="Guía de Ayuda"/></a><br><strong><label onClick="">Guía de Ayuda</label></strong></td>
<td width="80"><a href="#" onClick="document.getElementById('regresar').submit();"><img src="Imagenes/regresar.jpg" alt="atras" border="0" width="34"/></a><br><strong><label onClick="document.getElementById('regresar').submit();">Regresar</label></strong></td>
</tr>
</table>
<form name="regresar" id="regresar" method="POST" action="grupoyespecialidad.php">
<input type="text" name="del" id="del" value="<?php echo $del; ?>" class="CampoOculto">
<input type="text" name="delegoumae" id="delegoumae" value="<?php echo $delegoumae; ?>" class="CampoOculto" >
<input type="text" name="clues" id="clues" value="<?php echo $clues; ?>" class="CampoOculto">
<input type="text" name="clp" id="clp" value="<?php echo $clp; ?>" class="CampoOculto" >
<input type="text" name="nom_sec" id="nom_sec" value="<?php echo $nom_sec; ?>" class="CampoOculto" >
<input type="text" name="nom_imss" id="nom_imss" value="<?php echo $nom_imss; ?>" class="CampoOculto" >
<input type="text" name="opcion" id="opcion" value="<?php echo $opcion; ?>" class="CampoOculto" >
</form>
<div lign="center">
<table width="350" border="0" align="center">
  <tr>
    <th scope="row">
    <?php echo '<marquee style="font-size:20px; "><strong>VERSIÓN DE PRUEBAS</strong></marquee>';?> 
    </th>
  </tr>
</table>
</div>

<center>
<?php
$datos=mysql_query("SELECT delegoumae, tipo, numero, localidad FROM cat_clues_issste_2022  WHERE del='$del'");
$datos=mysql_fetch_array($datos);
if($val=='1')
{
?>
  <p class="navLink" style="color:#FF0000; font-size:16px"><strong>Contrase&ntilde;a Incorrecta</strong></p>
 <?php
}?>
<div align="center" style="background-color:#FFF; border:0; color:#000; font-size:14px; font-weight:bold">
<?php echo $entidad." ".$datos[0];?>
</div>
<br />
  <form ACTION="<?php echo $loginFormAction; ?>" id="form1" name="form1" method="POST">
  <div align="center" style="background-color:#FFF; border:0; color:#000; font-size:14px; font-weight:bold">Ingresar la contraseña de la <?php if($entidad=="") echo "UMAE"; else echo $entidad;?>,<br>
  posteriormente dar clic izquierdo sobre el botón Acceder</div><br />
  <table width="345" border="1" id="customers">
    <tr>
      <td align="center">Ingresar contraseña:</td>
      </tr>
	<input type="text" name="del" id="del" value="<?php echo $del; ?>" class="CampoOculto">
	<input type="text" name="delegoumae" id="delegoumae" value="<?php echo $delegoumae; ?>" class="CampoOculto" >
	<input type="text" name="clues" id="clues" value="<?php echo $clues; ?>" class="CampoOculto">
	<input type="text" name="clp" id="clp" value="<?php echo $clp; ?>" class="CampoOculto" >
	<input type="text" name="nom_sec" id="nom_sec" value="<?php echo $nom_sec; ?>" class="CampoOculto" >
	<input type="text" name="nom_imss" id="nom_imss" value="<?php echo $nom_imss; ?>" class="CampoOculto" >
	<input type="text" name="grupo" id="grupo" value="<?php echo $grupo; ?>" class="CampoOculto" >
	<input type="text" name="opcion" id="opcion" value="<?php echo $opcion; ?>" class="CampoOculto" >
    <input type="text" name="val" id="val" value="<?php echo '1'; ?>" class="CampoOculto"/>
    <tr>
      <td>
        <div align="center">
          <input type="password" name="pwd" id="pwd"/>          
        </div></td>
      </tr>
    <tr>
    <td align="center"><input type="submit" name="registrar" id="registrar" value="Acceder" /></td>
      </tr>
  </table>
  </form>
</center>
</body>
</html>