<?php
require('mc_tablexdel.php');
foreach($_REQUEST as $k=>$v)
{$$k=htmlentities($v);}
if(is_numeric($del))
{
	$opcion="Delegación";
	$uno="Delegación";
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
require("../conexion.php");

$query=mysql_query("SELECT del, delegoumae FROM cat_clues_ss_2022  WHERE del='$del'");
$row=mysql_fetch_array($query); $delegacion=$row["delegoumae"];

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
requerimiento_ss_2022  a LEFT JOIN cat_clues_ss_2022  b ON a.clp=b.clp2
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
requerimiento_ss_2022  a LEFT JOIN cat_clues_ss_2022  b ON a.clp=b.clp2
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
requerimiento_ss_2022  a LEFT JOIN cat_clues_ss_2022  b ON a.clp=b.clp2
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
requerimiento_ss_2022  a LEFT JOIN cat_clues_ss_2022  b ON a.clp=b.clp2
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
		
		if($excedenteofaltantes[$a]=='Excedente') $txt="Excedentes"; else $txt="Faltantes";
		$pdf->txt = $txt;	

		if($clps[$a]!=$clps[$a-1])
		{		
			$y=$pdf->GetY();
			$b=1;			
			$pdf->um=$tipos[$a]." ".$numeros[$a].", ".$localidades[$a];		
			$pdf->SetFont('Arial','B',8);
			//if($pdf->GetY()>=178) 
			//$pdf->AddPage();
				
			$totmax20=0; $totmax21=0; $totmax22=0; $totmax23=0;
			$pdf->SetX(20);
				
			if($pdf->GetY()>=168)
			{
				$pdf->salto=1;
				$pdf->AddPage();
				$pdf->Ln(18);			
			}		
					
			$pdf->Ln(5);
			$pdf->SetX(20);					
				
			$pdf->SetFillColor(191,191,191);
			
			$pdf->Cell(246,5,$tipos[$a]." ".$numeros[$a].", ".$localidades[$a], 1, 0, "C",true);
			$pdf->Ln(5);				
		}
		
		if($excedenteofaltantes[$a]!=$excedenteofaltantes[$a-1] || $clps[$a]!=$clps[$a-1])
		{
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
			$pdf->Cell(110,10,"Producto", 1, 0, "C");
			$pdf->SetXY(180,$y);
			$pdf->MultiCell(21,5,utf8_decode("Ambulatorio/\nHospitalario"), 1, "C",0,0,0,0);
			$pdf->SetXY(201,$y);
			$pdf->MultiCell(29,5,utf8_decode("Causa\nPrincipal"), 1, "C",0,0,0,0);
			$pdf->SetXY(230,$y);
			$pdf->MultiCell(18,5,utf8_decode("Cantidad\nMensual"), 1, "C",0,0,0,0);	
			$pdf->SetXY(248,$y);
			$pdf->MultiCell(18,5,utf8_decode("Pacientes\nMensuales"), 1, "C",0,0,0,0);	
		}	
		
	$pdf->SetFont('Arial','',8);
	$pdf->SetAligns(array('R','C','L','C','C','R',));
	$pdf->SetWidths(array(8,42,110,21,29,18,18));	

	$pdf->Row(array(
	$b,
	$grupos[$a],
	$productos[$a],
	$AmbulatoriouHospitalarios[$a],
	$causa[$a],
	number_format($cantidades[$a],0),

	number_format($pacientes[$a],0)
	));	
	
	if($pdf->GetY()>178) 
	$pdf->AddPage();
	
	if($clps[$a]!=$clps[$a+1] )
	{
		if($pdf->GetY()>178) 
		{
			$pdf->salto=1;
			$pdf->AddPage();
			$pdf->Ln(18);
		}		
	}	
}	
$pdf->Output();
?>