<?php
require('mc_tablexdel.php');
foreach($_REQUEST as $k=>$v)
{$$k=htmlentities($v);}
if(is_numeric($del))
{
	$opcion="OOAD";
	$uno="OOAD";
	$nam=substr($clp, -4);
	if($nam=='2110')
	$preposicion="la";	
	else if($nam=='2151')
	$preposicion="el";
}
else
{
	$opcion=""; 
	$uno="UMAE";
	
	$opcion2="UMAE";
	$preposicion='la';
}

ini_set('max_execution_time',0);
ini_set('memory_limit', '-1');

require("../include/dbcommon.php");
$conn2=mysql_connect($host2,$user2,$pass2);
if (!$conn2 || !mysql_select_db($dbname2,$conn2)) 
{trigger_error(mysql_error(), E_USER_ERROR);} 
$a=mysql_query("SELECT	catunimed13.delegado AS delegado, catunimed13.jpm AS jpm FROM catunidades.catunimed13 where catunidades.catunimed13.del = '$del' GROUP BY catunimed13.del",$conn2) or die(mysql_error());
$f=mysql_fetch_array($a);

require("../conexion.php");

$query=mysql_query("SELECT del, delegoumae FROM cat_clues WHERE del='$del'");
$row=mysql_fetch_array($query); $delegacion=$row["delegoumae"];

$nquery=mysql_query("SELECT
	a.del,
	a.delegoumae,
	COUNT(DISTINCT(a.clp)) AS um,
	COUNT(DISTINCT(b.clp)) AS umconr
FROM
	cat_clues a LEFT JOIN requerimiento b ON a.clp=b.clp
WHERE
	a.del = '$del'"); $n=mysql_fetch_array($nquery); $um=$n["um"]; $umconr=$n["umconr"];

$pdf=new PDF_MC_Table('L','mm','Letter');
date_default_timezone_set('America/Mexico_City'); 
$fecha2=time();

$pdf->fecha = date("d/m/Y H:i:s",$fecha2);
$pdf->AliasNbPages();
$pdf->del=$del;
$pdf->cuenta=$cuenta;
$pdf->prep=$preposicion.' '.utf8_encode($unidad);
$pdf->mes=$meses[$mes];
$pdf->opcion=$opcion;
$pdf->uno=$uno;
$pdf->fr=$fr;
$pdf->namedelegado =$f['delegado'];
$pdf->namejpm =$f['jpm'];
$pdf->AddPage();
$pdf->SetFont('Arial','B',11);
$pdf->SetY(32);
$pdf->SetX(20);
$pdf->MultiCell(246,4,utf8_decode("Recolección de Excedentes y Faltantes de Servicios Médicos Institucionales para el 2020"), 0, "C",0,0,0,0);
$pdf->Ln(5);
$pdf->SetX(20);
$pdf->MultiCell(246,4,utf8_decode($opcion)." ".$delegacion, 0, "C",0,0,0,0);

if($status=='del_sinnecesidad')
{	
	$pdf->SetXY(20,60);
	$pdf->MultiCell(246,4,utf8_decode('"La '.$uno.' no reporta intervenciones Excedentes/Faltantes para el año 2020"'), 0, "C",0,0,0,0);
}
else if($um>1)
{
	if($umconr>1)
	$p="reportan";
	else
	$p="reporta";
	
	$pdf->Ln(5);
	$pdf->SetX(20);
	$pdf->MultiCell(246,4,utf8_decode($umconr." de ".$um." Unidades Médicas ".$p." Excedentes y/o Faltantes"), 0, "C",0,0,0,0);
}
	
$sec=0;
$pdf->header = 2;	
$pdf->version = $version;	
$pdf->tabla="requerimientoxum";
		
$query=mysql_query("
SELECT
*
FROM
(
SELECT
	a.clp,
	b.tipo, b.numero, b.localidad,	
	grupo,
	especialidad,
	producto,
	'Excedente' AS excedenteofaltante,
	'Ambulatorio' AS AmbulatoriouHospitalario,
	excedentea AS cantidad,
	NULL AS causa,
	pacientes
	FROM
	requerimiento a LEFT JOIN cat_clues b ON a.clp=b.clp2
WHERE
	b.del = '$del' AND
	excedentea>0
GROUP BY
	a.clp, producto
UNION ALL
SELECT
	a.clp,
	b.tipo, b.numero, b.localidad,	
	grupo,
	especialidad,
	producto,
	'Excedente' AS excedenteofaltante,
	'Hospitalario' AS AmbulatoriouHospitalario,	
	excedenteh AS cantidad,
	NULL AS causa,
	pacientes
	FROM
	requerimiento a LEFT JOIN cat_clues b ON a.clp=b.clp2
WHERE
	b.del = '$del' AND
	excedenteh>0
GROUP BY
	a.clp, producto
UNION ALL
SELECT
	a.clp,
	b.tipo, b.numero, b.localidad,	
	grupo,
	especialidad,
	producto,
	'Faltante' AS excedenteofaltante,
	'Ambulatorio' AS AmbulatoriouHospitalario,	
	faltantea AS cantidad,
	causa, 
	pacientes
	FROM
	requerimiento a LEFT JOIN cat_clues b ON a.clp=b.clp2
WHERE
	b.del = '$del' AND
	faltantea>0
GROUP BY
	a.clp, producto
UNION ALL
SELECT
	a.clp,
	b.tipo, b.numero, b.localidad,	
	grupo,
	especialidad,
	producto,
	'Faltante' AS excedenteofaltante,
	'Hospitalario' AS AmbulatoriouHospitalario,	
	faltanteh AS cantidad,
	causa, 
	pacientes
	FROM
	requerimiento a LEFT JOIN cat_clues b ON a.clp=b.clp2
WHERE
	b.del = '$del' AND
	faltanteh>0
GROUP BY
	a.clp, producto
) c
ORDER BY 
/*clp, excedenteofaltante, grupo, producto, AmbulatoriouHospitalario, cantidad DESC*/
clp, excedenteofaltante DESC, cantidad DESC

");	

	$nregistros=mysql_num_rows($query);
	while($row=mysql_fetch_array($query)) 
	{	
		++$sec;
		$clps[$sec]=$row["clp"];
		$tipos[$sec]=$row["tipo"];
		$numeros[$sec]=$row["numero"];
		$localidades[$sec]=$row["localidad"];
		$excedenteofaltantes[$sec]=$row["excedenteofaltante"];
		$grupos[$sec]=$row["grupo"];
		$productos[$sec]=$row["producto"];
		$AmbulatoriouHospitalarios[$sec]=$row["AmbulatoriouHospitalario"];
		$cantidades[$sec]=$row["cantidad"];
		$causa[$sec]=$row["causa"];
		$pacientes[$sec]=$row["pacientes"];
	}
	
	for($a=1; $a<=$sec; $a++)
	{		
		++$b;
		++$consecutivo;
		
		$nc=max($nb,$pdf->NbLines($pdf->widths[2],$row["producto"]));
		
		if($excedenteofaltantes[$a]=='Excedente') $txt="Excedentes"; else $txt="Faltantes";
		$pdf->txt = $txt;	

		if($clps[$a]!=$clps[$a-1])
		{		
			$b=1;			
			$totmax20=0; $totmax21=0; $totmax22=0; $totmax23=0;
			$pdf->um=$tipos[$a]." ".$numeros[$a].", ".$localidades[$a];		
			$pdf->SetFont('Arial','B',8);
				
			$pdf->Ln(5);
			
				
			$pdf->SetFillColor(191,191,191);
			
			if($pdf->GetY()+($nc*5)>180)
			{
				$pdf->AddPage();

			}
			else
			{
				$pdf->SetX(20);		
				$pdf->Cell(246,5,$tipos[$a]." ".$numeros[$a].", ".$localidades[$a], 1, 0, "C",true);
				$pdf->Ln(5);	
				$b=1; //última
				$pdf->SetFont('Arial','B',8);
				$pdf->SetFillColor(217,217,217);
				$pdf->SetX(20);									
				$pdf->Cell(246,5,$txt, 1, 0, "C",true);
				$pdf->Ln(5);
				$pdf->SetFont('Arial','B',8);
				$y=$pdf->GetY();
				$pdf->SetX(20);
				$pdf->Cell(8,10,(utf8_decode("No.")), 1, 0, "C");
				$pdf->SetXY(28,$y);
				$pdf->Cell(42,10,(utf8_decode("Grupo de Servicio")), 1, 0, "C");
				$pdf->SetX(70);
				if($txt=='Faltantes')
				{			
					$pdf->Cell(110,10,"Producto", 1, 0, "C");
					$pdf->SetXY(180,$y);
					$pdf->MultiCell(29,5,utf8_decode("Causa\nPrincipal"), 1, "C",0,0,0,0);
					$pdf->SetXY(209,$y);
					$pdf->MultiCell(21,5,utf8_decode("Ambulatorio/\nHospitalario"), 1, "C",0,0,0,0);
					$pdf->SetXY(230,$y);
					$pdf->MultiCell(18,5,utf8_decode("Eventos\nMensuales"), 1, "C",0,0,0,0);	
					$pdf->SetXY(248,$y);
					$pdf->MultiCell(18,5,utf8_decode("Pacientes\nMensuales"), 1, "C",0,0,0,0);	
				}
				else if($txt=='Excedentes')
				{
					$pdf->Cell(139,10,"Producto", 1, 0, "C");
					$pdf->SetXY(209,$y);
					$pdf->MultiCell(21,5,utf8_decode("Ambulatorio/\nHospitalario"), 1, "C",0,0,0,0);
					$pdf->SetXY(230,$y);
					$pdf->MultiCell(18,5,utf8_decode("Eventos\nMensuales"), 1, "C",0,0,0,0);
					$pdf->SetXY(248,$y);
					$pdf->MultiCell(18,5,utf8_decode("Pacientes\nMensuales"), 1, "C",0,0,0,0);
				}			
			}

		}
		
	$pdf->SetFont('Arial','',8);
	if($txt=='Faltantes')
	{
		$pdf->SetAligns(array('R','C','L','C','C','R',));
		$pdf->SetWidths(array(8,42,110,29,21,18,18));	
		$pdf->Row(array(
		$b,
		$grupos[$a],
		$productos[$a],
		$causa[$a],
		$AmbulatoriouHospitalarios[$a],		
		number_format($cantidades[$a],0),
		number_format($pacientes[$a],0)
		));	
	}
	else if($txt=='Excedentes')
	{
		$pdf->SetAligns(array('R','C','L','C','R','R',));
		$pdf->SetWidths(array(8,42,139,21,18,18));	
		$pdf->Row(array(
		$b,
		$grupos[$a],
		$productos[$a],
		$AmbulatoriouHospitalarios[$a],		
		number_format($cantidades[$a],0),
		number_format($pacientes[$a],0)
		));	
	}
	
	
	
	if($pdf->GetY()+($nc*5)>190)
		$pdf->AddPage();
	
	
	
}	
$pdf->Output();
?>