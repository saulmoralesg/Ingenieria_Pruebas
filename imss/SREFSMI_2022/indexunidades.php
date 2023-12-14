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
	$opcion=$_POST['opcion'];
	$excedenteofaltante=$_POST['excedenteofaltante'];
    $val=$_POST['val'];
  	$password=$_POST['pwd'];
  	$MM_fldUserAuthorization = "";
	
	if($opcion=="SI")
	$php="guardar.php";
	else
	$php="guardar.php";
	
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
				
		<form name="continuar" id="continuar" method="POST" action="<?php echo $php;?>">
		<input type="text" name="del" id="del" style="display:none" value="<?php echo $loginUsername;?>" />
		<input type="text" name="delegoumae" id="delegoumae" style="display:none" value="<?php echo $delegoumae;?>">
		<input type="text" name="opcion" id="opcion" style="display:none" value="<?php echo $opcion;?>" />
		<input type="text" name="excedenteofaltante" id="excedenteofaltante" style="display:none" value="<?php echo $excedenteofaltante;?>">
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
?>

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
{
	$entidad=("OOAD ");
	$p="del ";
}
else
{
$entidad=""; 
$umae="UMAE";
$p=" de la ";
}
?>

<?php
$query=mysql_query("
SELECT
a.del,
a.delegoumae,
MAX(cerrado) AS cerrado
FROM
cat_clues a
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
    <?php //echo '<marquee style="font-size:20px; "><strong>VERSIÓN DE PRUEBAS</strong></marquee>';?> 
    </th>
  </tr>
</table>
</div>
-->
<div align="center" style="background-color:#FFF; border:0; color:#000; font-size:18px; font-weight:bold"><br>
<?php echo $entidad." ".$delegoumae;?>
</div>
<br>
<div align="center" style="background-color:#FFF; border:0; color:#000; font-size:14px; font-weight:bold">
<?php 
if($cerrado==1)
{
echo "<br><label style='color:red'>REGISTRO DE INFORMACIÓN CERRADO.</label> <br>Si requiere apertura, solicitelo a 
la Mta. Vanessa Elizabeth López González, correo electrónico vanessa.lopezg@imss.gob.mx";
}
?>
</div>

<?php
if($cerrado!=1)
{ ?>
<div align="center" style="background-color:#FFF; border:0; color:#000; font-size:14px; font-weight:bold">
  <?php echo "Paso 2.- ¿Alguna de las Unidades Médicas de la ".$entidad." ".$delegoumae." tiene Excedentes/Faltantes de algún Servicio Médico Institucional?"?>
	
<div align="center">
<?php 
$query=mysql_query("SELECT
	COUNT(DISTINCT(clp2))AS um,	
CASE
WHEN COUNT(DISTINCT(clp2))=SUM(IF(excedenteofaltante=1,1,0)) THEN 'del_coneof' 
WHEN COUNT(DISTINCT(clp2))=SUM(IF(excedenteofaltante=0,1,0)) THEN 'del_sinnecesidad'
WHEN COUNT(DISTINCT(clp2))=SUM(IF(excedenteofaltante IS NULL,1,0)) THEN 'del_sinregistro' END AS status
FROM
	cat_clues
WHERE
	del = '$del'");
$datos=mysql_fetch_array($query); $status=$datos["status"]; 

if($opcion=="")
{
if($status=='del_coneof')
$opcion="SI";
else if($status=='del_sinnecesidad')
$opcion="NO";
}

?>
<form name="self" method="POST" action="">
<input type="text" name="del" id="del" value="<?php echo $del;?>" class="CampoOculto">
<input type="text" name="delegoumae" id="delegoumae" value="<?php echo $delegoumae;?>" class="CampoOculto">
<?php
if($opcion=="SI")
{?>
<select name="opcion" id="opcion" onChange="JavaScript:this.form.submit();">
<option value="SI">SI</option>
<option value="NO">NO</option>
<option value="0">Seleccione una opción</option>
</select>
<?php }
else if($opcion=="NO")
{?>
<select name="opcion" id="opcion" onChange="JavaScript:this.form.submit();">
<option value="NO">NO</option>
<option value="SI">SI</option>
<option value="0">Seleccione una opción</option>
</select>
<?php } 
else 
{?>
<select name="opcion" id="opcion" onChange="JavaScript:this.form.submit();">
<option value="0">Seleccione una opción</option>
<option value="SI">SI</option>
<option value="NO">NO</option>
</select>
</form>
<?php } ?>
</div>
<?php } ?>

<form ACTION="<?php echo $loginFormAction; ?>" id="form1" name="form1" method="POST">
<?php
if($cerrado!=1)
{
?>
<div id="guardar" align="center">
<div id="nota2" style="background-color:#FFF; border:0; color:#000; font-size:13px; font-weight:bold; color:#FF0000">
<?php /*echo "Nota: El registro de información de la ".$entidad." ".$delegoumae." concluirá al dar clic en el botón Guardar. ";*/ 
if($opcion=="SI")
echo "Nota: para iniciar/continuar con el registro de excedentes y/o faltantes, <br>
es necesario ingresar la contraseña ".$p.$entidad.$umae." y dar clic izquierdo en el botón Acceder.";
else if($opcion=="NO")
echo "Nota: para concluir el registro es necesario ingresar la contraseña ".$p.$entidad.$umae." y dar clic izquierdo en el botón Guardar.";
?>

<?php
if($val=='1' && $pwd!="")
{
?>
<p class="navLink" style="color:#FF0000; font-size:16px"><strong>Contrase&ntilde;a Incorrecta</strong></p>
<?php } else echo "";?>

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
</div>
<br>
<?php 
if($opcion=="NO")
{?>
<input type="text" name="excedenteofaltante" id="excedenteofaltante" value="0" style="display:none">
<?php } 
else if($opcion=="SI")
{?>
<input type="text" name="excedenteofaltante" id="excedenteofaltante" value="1" style="display:none">
<?php } ?>
<!--<input type="submit" name="save" id="save" value="Guardar" onClick="return valida()">-->
</div>
<?php } // fin de if cerrado?> 

<div id="includedContent"></div>
</form>
<script>
window.onload=function()
{	
	var obj = document.getElementById("opcion");
	var respuesta = obj.options[obj.selectedIndex].value;			
	//document.getElementById("nota2").style.display='none';

	if(respuesta=="SI")	
	{
		document.getElementById("guardar").style.display='block';
		document.getElementById('pwd').focus();
	}
	else if(respuesta=="NO")	
	{
		document.getElementById("guardar").style.display='block';
		document.getElementById('pwd').focus();
	}
	else
	document.getElementById("guardar").style.display='none';		
} 
</script>

<!--	$(function(){
      $("#includedContent").load("unidades.php?del=<?php //echo $del;?>&delegoumae=<?php //echo $delegoumae;?>");
    });*/-->
</body> 
</html>