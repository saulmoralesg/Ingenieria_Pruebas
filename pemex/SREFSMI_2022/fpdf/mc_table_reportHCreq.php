<?php
require('fpdf/fpdf.php');


class PDF_MC_Table extends FPDF
{
var $widths;
var $aligns;
var $ProcessingTable=false;
// FuNcIoN CaBeZeRa
function Header()
{
$delegoumae=$_GET['delegoumae'];
$fecha = date("d/m/Y h:m:s");
	//Title
    $this->Image('images/imsslogo.jpg',15,4,15);
	$this->SetFont('Arial','',9);
	$this->SetXY(40,5);
	$this->Cell(220,6,''.$fecha.'',0,0,'R');
	$this->SetFont('Arial','B',10);
	$this->SetXY(90,5);
	$this->Cell(100,4,'Instituto Mexicano del Seguro Social',0,2,'C');
	$this->SetFont('Arial','B',10);
	$this->Cell(100,4,'Centro Médico Nacional "Gral. Manuel Avila Camacho"',0,2,'C');
	$this->Cell(100,4,'UMAE Hospital de Traumatología y Ortopedia de Puebla',0,2,'C');
	$this->SetXY(90,25);
	$this->Cell(100,4,'Almacén de Osteosíntesis',1,2,'C');
	$this->SetX(20);
	/**/

/*Se consulta a la vista prog_qxView para obtener los datos detallados del paciente y de la programacion de
la cirugia.*/
$NumProv=$_GET["noProvSEND"];
$mesReq=$_GET["mesreqSEND"];




$resultHC=mysql_db_query("osteo_inventario",'SELECT
hojasconsumo_preq.mes,
Sum(hojasconsumo_preq.cant_out) AS Cant_out,
hojasconsumo_preq.Proveedor,
hojasconsumo_preq.Razon_soc,
Format(Sum(hojasconsumo_preq.GastoSIVA),2) AS GastoSIVA,
Format(Sum(hojasconsumo_preq.Imp_IVA),2) AS Imp_IVA,
Format(Sum(hojasconsumo_preq.GastoNeto),2) AS GastoNeto
FROM
hojasconsumo_preq
WHERE
hojasconsumo_preq.mes = '.$mesReq.' AND
hojasconsumo_preq.Proveedor = '.$NumProv.'
GROUP BY
hojasconsumo_preq.mes,
hojasconsumo_preq.Proveedor
'); 
$rowHC=mysql_fetch_array($resultHC); 
 
//Datos generales del inventario
$this->SetXY(60,30);
$this->SetFont('Arial','B',14);
$this->SetDrawColor(0);
$this->SetLineWidth(0.1);
$this->SetTextColor(0);
$this->SetFillColor('0R','100G','0B');
$this->Cell(160,5,'DETALLE DEL REQUERIMIENTO A PROVEEDOR',0,1,'C');
 
$this->SetFont('Arial','',10);
//$pdf->SetTextColor(255);
$this->SetX(60);
$this->SetFont('Arial','',10);
$this->Cell(80,5,'Proveedor','LRT',0,'C');
$this->Cell(35,5,'Importe Sin IVA','LRT',0,'C');
$this->Cell(35,5,'IVA (16%)','LRT',0,'C');
$this->Cell(35,5,'Importe Total','LRT',1,'C');

$this->SetTextColor(0);
 
$this->SetFont('Arial','',10);
$this->SetFillColor('200');
$this->SetY(40);
$this->SetX(60);
$this->SetFont('Arial','',10);
$this->Cell(80,5,''.$rowHC["Razon_soc"].'',1,0,'L');
$this->Cell(35,5,''.$rowHC["GastoSIVA"].'',1,0,'C');
$this->Cell(35,5,''.$rowHC["Imp_IVA"].'',1,0,'C');
$this->Cell(35,5,''.$rowHC["GastoNeto"].'',1,1,'C');

$this->Ln(5);	

$this->Cell(0,5,'DETALLE','0',1,'C');
$this->SetX(25);
$this->SetAligns(array('C','C','C','C','C','C','C','C','C'));
$this->SetWidths(array(15,30,80,20,20,20,20,21,20));
$this->Row(array('Num','Clave','Descripcion','Folio Hoja Consumo','Cant','Precio S/IVA','Importe S/IVA','Fecha de Registro','Sistema'));		
	if($this->ProcessingTable)
	$this->TableHeader();
/*Repito estas alineaciones porque al hacer cambio de hoja me justificaba de acuerdo al encabezado
los datos de la tabla*/	
$this->SetAligns(array('C','C','L','C','C','C','R','R','C'));
$this->SetWidths(array(15,30,80,20,20,20,20,21,20));

}
//Pie de Página
function Footer()
{
$folioQx=$_GET['folioSEND'];
$a=mysql_db_query("osteo_inventario","SELECT * FROM prog_qx WHERE prog_qx.Folio = '$folioQx' ") or die(mysql_error());
$f=mysql_fetch_array($a);
	/*Matriculas*/
$medCirujano=$f['mat_medcir'];
$medInstrumentista =$f['mat_medinst'];
$circulante=$f['mat_cirq'];

/*Obtengo el  nombre del cirujano*/
$b=mysql_db_query("osteo_inventario","SELECT  cat_medicos.Matricula,cat_medicos.Nombre, cat_medicos.Cargo, cat_medicos.Especialidad,
cat_medicos.Adscripcion FROM cat_medicos WHERE cat_medicos.Matricula = '$medCirujano' ") or die(mysql_error());
$g=mysql_fetch_array($b);		
$cirujanoName=$g['Nombre'];

/*Obtengo el nombre del instrumentista*/		
$c=mysql_db_query("osteo_inventario","SELECT  cat_medicos.Matricula,cat_medicos.Nombre, cat_medicos.Cargo, cat_medicos.Especialidad,
cat_medicos.Adscripcion FROM cat_medicos WHERE cat_medicos.Matricula = '$medInstrumentista' ") or die(mysql_error());
$h=mysql_fetch_array($c);		
$instrumentistaName=$h['Nombre'];
	
/*Obtengo el nombre del circulante*/	
$d=mysql_db_query("osteo_inventario","SELECT  cat_medicos.Matricula,cat_medicos.Nombre, cat_medicos.Cargo, cat_medicos.Especialidad,
cat_medicos.Adscripcion FROM cat_medicos WHERE cat_medicos.Matricula = '$circulante' ") or die(mysql_error());
$j=mysql_fetch_array($d);
$circulanteName=$j['Nombre'];
	
//$uno='Delegado o Director de UMAE';
//$dos='Jefe de Prestaciones Médicas o director Médico de UMAE';
//$tres='Jefe de Conservación y Servicios Generales';
    //$this->SetY(200);
    //Arial italic 8
    $this->SetFont('Arial','',8);
   /*1*/
	$this->SetY(170);$this->SetX(30);
    $this->Cell(50,5,'Almacenista :','1',1,'C');
	$this->SetX(30);
	$this->Cell(50,5,''.$cirujanoName.'',1,0,'C');
	$this->SetY(170);$this->SetX(80);
    $this->Cell(30,5,'Matrícula','1',1,'C');
	$this->SetX(80);
	$this->Cell(30,5,''.$medCirujano.'',1,0,'C');
	/*2*/
	$this->SetY(170);$this->SetX(110);
    $this->Cell(50,5,'Responsable :','1',1,'C');
	$this->SetX(110);
	$this->Cell(50,5,''.$instrumentistaName.'',1,0,'C');	
    $this->SetY(170);$this->SetX(160);	
    $this->Cell(30,5,'Matrícula','1',1,'C');
	$this->SetX(160);	
	$this->Cell(30,5,''.$medInstrumentista.'',1,0,'C');
	/*3*/
	$this->SetY(170);$this->SetX(190);
    $this->Cell(50,5,'Proveedor :','1',1,'C');
	$this->SetX(190);
	$this->Cell(50,5,''.$circulanteName.'',1,0,'C');	
    $this->SetY(170);$this->SetX(240);	
    $this->Cell(30,5,'R.F.C.','1',1,'C');
	$this->SetX(240);	
	$this->Cell(30,5,''.$circulante.'',1,1,'C');	
	$this->SetX(30);
    $this->Cell(80,15,'','1',0,'C');
    $this->Cell(80,15,'','1',0,'C');
    $this->Cell(80,15,'','1',1,'C');
   // $this->Cell(40,15,'','1',1,'C');	
    $this->Cell(0,10,'Página '.$this->PageNO().'/{nb}',0,0,'C');
	//$this->SetXY(20,200);
	/*$this->SetFont('Arial','B',8);
	$this->Cell(120,5,''.$uno.'',0,0,'C');$this->Cell(120,5,''.$dos.'',0,1,'C');
	$this->SetFont('Arial','',8);
	$this->Cell(120,5,''.$delegado.'',0,0,'C');$this->Cell(120,5,''.$jpm.'',0,1,'C');*/
}

//LiBrErIa

//SetWiths
function SetWidths($w)
{
	//Set the array of column widths
	$this->widths=$w;
}

function SetAligns($a)
{
	//Set the array of column alignments
	$this->aligns=$a;
}

function Row($data)
{
	//Calculate the height of the row
	$nb=0;
	for($i=0;$i<count($data);$i++)
		$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
	$h=5*$nb;
	//Issue a page break first if needed
	$this->CheckPageBreak($h);
	//Draw the cells of the row
	for($i=0;$i<count($data);$i++)
	{
		$w=$this->widths[$i];
		$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
		//Save the current position
		$x=$this->GetX();
		$y=$this->GetY();
		//Draw the border
		$this->Rect($x,$y,$w,$h);
		//Print the text
		$this->MultiCell($w,5,$data[$i],0,$a);
		//Put the position to the right of the cell
		$this->SetXY($x+$w,$y);
	}
	//Go to the next line
	$this->Ln($h);
}

function CheckPageBreak($h)
{
	//If the height h would cause an overflow, add a new page immediately
	if($this->GetY()+$h>$this->PageBreakTrigger)
		$this->AddPage($this->CurOrientation);
}

function NbLines($w,$txt)
{
	//Computes the number of lines a MultiCell of width w will take
	$cw=&$this->CurrentFont['cw'];
	if($w==0)
		$w=$this->w-$this->rMargin-$this->x;
	$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
	$s=str_replace("\r",'',$txt);
	$nb=strlen($s);
	if($nb>0 and $s[$nb-1]=="\n")
		$nb--;
	$sep=-1;
	$i=0;
	$j=0;
	$l=0;
	$nl=1;
	while($i<$nb)
	{
		$c=$s[$i];
		if($c=="\n")
		{
			$i++;
			$sep=-1;
			$j=$i;
			$l=0;
			$nl++;
			continue;
		}
		if($c==' ')
			$sep=$i;
		$l+=$cw[$c];
		if($l>$wmax)
		{
			if($sep==-1)
			{
				if($i==$j)
					$i++;
			}
			else
				$i=$sep+1;
			$sep=-1;
			$j=$i;
			$l=0;
			$nl++;
		}
		else
			$i++;
	}
	return $nl;

	
//$this->TableHeader();
}
}
?>