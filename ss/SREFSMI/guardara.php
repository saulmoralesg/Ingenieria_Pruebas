


<style>
.CampoOculto {
display:none;
}
</style>
<?php
//header("Content-Type: text/html; charset=utf-8");

$del=$_REQUEST['del'];
$delegoumae=$_REQUEST['delegoumae'];
$fecsis=date("Y-m-d H:i:s");
$ipconfig=$_SERVER['REMOTE_ADDR'];
include('config.inc.php');
/*ini_set('max_execution_time',0);
ini_set('max_input_time', 0);
ini_set('memory_limit', '150M');
ini_set('post_max_size', '100M');
ini_set('upload_max_filesize', '100M');*/
ini_set('MAX_EXECUTION_TIME', '-1');
mysql_set_charset("utf8");

?>

<?php
$upl=1;
//$ext=date(U);

$FILE_EXTS = array('.pdf'); 	
$file_name = $_FILES['userfile']['name'];
$file_ext = strtolower(substr($file_name,strrpos($file_name,".")));

if($file_name == NULL && !in_array($file_ext, $FILE_EXTS))
{
$upl=0;
?>
<form name="form2" method="POST" action="archivo.php" class="CampoOculto">
<input type="text" name="del" id="del" value="<?php echo $del;?>" class="CampoOculto">
</form>
<script>
document.form2.submit();</script>
<?php
exit;
}

if(!in_array($file_ext, $FILE_EXTS))
{
$upl=0;
$msn="invalido";?>
<form name="form2" method="POST" action="archivo.php" class="CampoOculto">
<input type="text" name="del" id="del" value="<?php echo $del;?>" class="CampoOculto">
<input type="text" name="msn" id="msn" value="<?php echo $msn;?>" class="CampoOculto">
</form>
<script>document.form2.submit();</script>
<?php 
exit();
}
//if($_FILES['userfile']['size']>$A_maxsize)
if($_FILES['userfile']['size']>$A_maxsize)
{
	$upl=0;
	$msn="big";
?>
<form name="form2" method="POST" action="archivo.php" class="CampoOculto">
<input type="text" name="msn" id="msn" value="<?php echo $msn;?>" class="CampoOculto">
</form>
<?php
}
if($upl==1)
{	
	
	$uploaddir = upload_dir();
	$uploaddir=$uploaddir.substr($ext,0);
	if(!file_exists($uploaddir))
	{
		makeindex($uploaddir."log.txt");
	}
	//echo $uploadfile = $uploaddir.$_FILES['userfile']['name']; 

	$uploadfile = $uploaddir.$del.$_FILES['userfile']['name']; 
	

	
	if(move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile))
	{
	   //echo $address = getimgplace(substr($ext,0));	
	   $address = getimgplace(substr($ext,0));	
	   //echo "BBCode URL/Download: <strong>"."["."url"."]"."$address"."["."/"."url"."]"."</strong><br><br><br>\n";
	   //echo "Your IP: <font color=\"red\">".$_SERVER['REMOTE_ADDR']."</font>\n";
	   //echo "Date: ".date(r);  
	   
	}

}
include("conexion.php");
error_reporting(0);
$pdf=$del.$file_name;
$query=mysql_query("SELECT * FROM
pdf_ss  WHERE del='$del'");

if(mysql_num_rows($query)>0)
mysql_query("DELETE FROM
pdf_ss  WHERE del='$del'");
mysql_query("INSERT INTO pdf_ss  (del, delegoumae,pdf,fecsis,ipconfig) VALUES ('$del','$delegoumae','$pdf','$fecsis','$ipconfig')");


?>
<form name="form2" method="POST" action="del.php" class="CampoOculto">
<input type="text" name="msn" id="msn" value="<?php echo 1;?>" class="CampoOculto">
</form>
<script>document.form2.submit();</script><?php

//--=====> functions <=====--
function upload_dir()
{
	$dir = $_SERVER['PHP_SELF'];
	for($i=0;$i<strlen($dir);$i++)
	{
		if(substr($dir,$i,1)=="/") $slashpos=$i;
	}
	$dir = substr($dir,0,$slashpos);
	$dir = $_SERVER['DOCUMENT_fernanced'].$dir."/files/";
	return($dir);
}
function getimgplace($ext)
{
	$dir=$_SERVER['HTTP_HOST'];
	$dir="http://$dir";
	$tdir=$_SERVER['PHP_SELF'];
	for($i=0;$i<strlen($tdir);$i++)
	{
		if(substr($tdir,$i,1)=="/") $slashpos=$i;
	}
	$tdir = substr($tdir,0,$slashpos);
	//$dir=$dir.$tdir."/files/$ext".$_FILES['userfile']['name']; original
	$dir=$dir.$tdir."/files/".$_FILES['userfile']['name']; //mod
	//$dir=$dir.$tdir."/files/".$_FILES['userfile']['name'];	no funciona

	return($dir);
}
function makeindex($dfile)
{
	$h = fopen($dfile,"w");
	fwrite($h, "".$_SERVER['REMOTE_ADDR'].";  ".date(r)."GMT"  );
	fclose($h);
	return("");
}
?>