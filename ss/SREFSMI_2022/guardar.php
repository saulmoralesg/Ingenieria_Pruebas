<?php 
include("conexion.php");
//error_reporting(0);
foreach($_REQUEST as $k=>$v)
{$$k=($v);}
mysql_set_charset("utf8");
$fecsis=date("Y-m-d H:i:s");
$ipconfig=$_SERVER['REMOTE_ADDR'];
ini_set('max_execution_time',0);

$query=mysql_query("SELECT tipo, numero, localidad FROM cat_clues_ss_2022  WHERE clp='$clp'");
$datos=mysql_fetch_array($query); $tipo=$datos["tipo"]; $numero=$datos["numero"]; $localidad=$datos["localidad"];

if($cerrar==1)
{
	mysql_query("UPDATE cat_clues_ss_2022  SET cerrado='$cerrar' WHERE del='$del'");
}

else if($excedenteofaltante==0)
{
	mysql_query("UPDATE cat_clues_ss_2022  SET excedenteofaltante='$excedenteofaltante' WHERE del='$del'"); //$excedenteofaltante=0
	//para borrar todo lo que haya capturado la unidad médica
	mysql_query("INSERT INTO requerimiento_historico_ss_2022(clp, tipo, numero, localidad, clues, grupo, especialidad, producto, excedentea, excedenteh, faltantea, faltanteh, causa, fecsis, ipconfig, pacientes) 
	SELECT clp, tipo, numero, localidad, clues, grupo, especialidad, producto, excedentea, excedenteh, faltantea, faltanteh, causa, fecsis, ipconfig, pacientes FROM
requerimiento_ss_2022  WHERE del='$del'");
	mysql_query("DELETE FROM
requerimiento_ss_2022  WHERE del='$del'");
}
else if($excedenteofaltante==1)
{
	mysql_query("UPDATE cat_clues_ss_2022  SET excedenteofaltante='1' WHERE del='$del'");
	
	$exister=mysql_query("SELECT * FROM
requerimiento_ss_2022  WHERE clp='$clp' AND grupo='$grupo' AND especialidad='$especialidad'");
	if(mysql_num_rows($exister)>0)
	{
		mysql_query("INSERT INTO requerimiento_historico_ss_2022(del, delegoumae, clp, tipo, numero, localidad, clues, grupo, especialidad, producto, excedentea, excedenteh, faltantea, faltanteh, causa, fecsis, ipconfig, pacientes) 
	SELECT del, delegoumae, clp, tipo, numero, localidad, clues, grupo, especialidad, producto, excedentea, excedenteh, faltantea, faltanteh, causa, fecsis, ipconfig, pacientes FROM
requerimiento_ss_2022  WHERE clp='$clp' AND grupo='$grupo'");
		mysql_query("DELETE FROM
requerimiento_ss_2022  WHERE clp='$clp' AND grupo='$grupo' AND especialidad='$especialidad'");
	}
	
	for($i=1; $i<=$nregistros; $i++)
	{
		$producto=$_REQUEST["producto".$i];
		$excedentea=$_REQUEST["excedentea".$i];
		$excedentea=str_replace(',','',$excedentea);
		
		$excedenteh=$_REQUEST["excedenteh".$i];
		$excedenteh=str_replace(',','',$excedenteh);
		
		$faltantea=$_REQUEST["faltantea".$i];
		$faltantea=str_replace(',','',$faltantea);
		
		$faltanteh=$_REQUEST["faltanteh".$i];	
		$faltanteh=str_replace(',','',$faltanteh);	
		
		$causa=$_REQUEST["causa".$i];
		
		$pacientes=$_REQUEST["pacientes".$i];	
		$pacientes=str_replace(',','',$pacientes);	
		
		if($excedentea>0 || $excedenteh>0 || $faltantea>0 || $faltanteh>0)
		{mysql_query("INSERT INTO requerimiento_ss_2022 (del, delegoumae, clp, tipo, numero, localidad, clues, grupo, especialidad, producto, excedentea, excedenteh, faltantea, faltanteh, causa, fecsis, ipconfig, pacientes) VALUES ('$del', '$delegoumae', '$clp', '$tipo', '$numero', '$localidad', '$clues', '$grupo', '$especialidad', '$producto', '$excedentea', '$excedenteh', '$faltantea', '$faltanteh', '$causa', '$fecsis', '$ipconfig', '$pacientes')");}
	}
}
?>
<form name="form1" id="form1" action="del.php" method="POST">
</form>
<form name="form2" id="form2" action="unidades.php" method="POST">
<input type="text" id="del" name="del" value="<?php echo $del;?>" style="display:none">            
<input type="text" id="delegoumae" name="delegoumae" value="<?php echo $delegoumae;?>" style="display:none">
<input type="text" id="clp" name="clp" value="<?php echo $clp;?>" style="display:none">            
<input type="text" id="clues" name="clues" value="<?php echo $clues;?>" style="display:none">
<input type="text" name="nom_sec" id="nom_sec" value="<?php echo $nom_sec; ?>" style="display:none">
<input type="text" name="nom_imss" id="nom_imss" value="<?php echo $nom_imss; ?>" style="display:none">
<input type="text" name="opcion" id="opcion" value="SI" style="display:none">
</form>
<?php if($excedenteofaltante==0)
{?>
<script>
alert('INFORMACION REGISTRADA');
window.form1.submit();
</script> 

<?php } 
else if($excedenteofaltante==1)
{?>
<script>window.form2.submit();</script>
<?php } ?>
