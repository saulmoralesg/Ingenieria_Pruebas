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
    $this->Image('imagenes/imsslogo.jpg',15,4,15);
	$this->SetFont('Arial','',9);
	$this->SetXY(40,5);
	$this->Cell(220,6,''.$fecha.'',0,0,'R');
	$this->SetFont('Arial','B',10);
	$this->SetXY(90,5);
	$this->Cell(100,4,'Instituto Mexicano del Seguro Social',0,2,'C');
	$this->SetFont('Arial','B',10);
	$this->Cell(100,4,''.$delegoumae.'',0,2,'C');
	$this->Cell(100,4,'',0,2,'C');
	$this->SetX(20); $this->Ln(3);	
	/**/
 
 
//Datos generales de la cirugia
//$this->SetXY(60,30);
$this->SetX(20);
$this->SetFont('Arial','B',14);
$this->SetDrawColor(0);
$this->SetLineWidth(0.1);
$this->SetTextColor(0);
$this->SetFillColor('0R','100G','0B');
$this->Cell(0,5,'Estudios de Laboratorio Clínico de Pruebas Especiales 2016-2019',0,1,'C');
 
$this->SetFont('Arial','',10);
$this->Cell(0,5,'CLAVES DE PRUEBA REGISTRADAS','0',1,'C');
$this->SetX(20);
$this->SetFont('Arial','B',8);
$this->SetAligns(array('C','C','C','C','C','C','C'));
$this->SetWidths(array(15,30,50,30,30,30,56));
$this->Row(array('Num','Clave','Descripcion','Máximo anual de acuerdo al fallo','Se solicita reincorporacion','Se procesaban en UMAE','Plataforma que sugiere la UMAE'));
$this->SetAligns(array('C','C','L','R','C','C','L'));	
    /**/
	//$this->Cell(100,4,'',0,1,'L');		
	if($this->ProcessingTable)
	$this->TableHeader();
}
//FuNcIoN PiE De PaG
function Footer()
{
$clpSend=$_GET["clpSEND"]; 
$a=mysql_db_query("labpresp","SELECT * FROM jefserlab WHERE jefserlab.clp = '$clpSend' ") or die(mysql_error());
$f=mysql_fetch_array($a);
	/*Matriculas*/
$matjefeserv=$f['matricula'];
$nameJefeserv =$f['jefe_ser_lb'];
/*$circulante=$f['mat_cirq'];*/

/*Obtengo el  nombre del cirujano*/
/*$b=mysql_db_query("osteo_inventario","SELECT  cat_medicos.Matricula,cat_medicos.Nombre, cat_medicos.Cargo, cat_medicos.Especialidad,
cat_medicos.Adscripcion FROM cat_medicos WHERE cat_medicos.Matricula = '$medCirujano' ") or die(mysql_error());
$g=mysql_fetch_array($b);		
$cirujanoName=$g['Nombre'];*/

/*Obtengo el nombre del instrumentista*/		
/*$c=mysql_db_query("osteo_inventario","SELECT  cat_medicos.Matricula,cat_medicos.Nombre, cat_medicos.Cargo, cat_medicos.Especialidad,
cat_medicos.Adscripcion FROM cat_medicos WHERE cat_medicos.Matricula = '$medInstrumentista' ") or die(mysql_error());
$h=mysql_fetch_array($c);		
$instrumentistaName=$h['Nombre'];*/
	
/*Obtengo el nombre del circulante*/	
/*$d=mysql_db_query("osteo_inventario","SELECT  cat_medicos.Matricula,cat_medicos.Nombre, cat_medicos.Cargo, cat_medicos.Especialidad,
cat_medicos.Adscripcion FROM cat_medicos WHERE cat_medicos.Matricula = '$circulante' ") or die(mysql_error());
$j=mysql_fetch_array($d);
$circulanteName=$j['Nombre'];*/
	
//$uno='Delegado o Director de UMAE';
//$dos='Jefe de Prestaciones Médicas o director Médico de UMAE';
//$tres='Jefe de Conservación y Servicios Generales';
    //$this->SetY(200);
    //Arial italic 8
    $this->SetFont('Arial','',8);
   /*1*/
	$this->SetY(170);$this->SetX(50);
    $this->Cell(50,5,'Elaboró (Jefe Servicio) : ','1',1,'C');
	$this->SetX(50);
	$this->Cell(50,5,''.$nameJefeserv.'',1,0,'C');
	$this->SetY(170);$this->SetX(100);
    $this->Cell(30,5,'Matrícula','1',1,'C');
	$this->SetX(100);
	$this->Cell(30,5,''.$matjefeserv.'',1,0,'C');
	/*2*/
	$this->SetY(170);$this->SetX(130);
    $this->Cell(50,5,'Autoriza (Dir. UMAE) :','1',1,'C');
	$this->SetX(130);
	$this->Cell(50,5,''.$instrumentistaName.'',1,0,'C');	
    $this->SetY(170);$this->SetX(180);	
    $this->Cell(30,5,'Matrícula','1',1,'C');
	$this->SetX(180);	
	$this->Cell(30,5,''.$medInstrumentista.'',1,0,'C');
	/*3*/
	/*$this->SetY(170);$this->SetX(190);
    $this->Cell(50,5,'Autoriza (Dir. UMAE) :','1',1,'C');
	$this->SetX(190);
	$this->Cell(50,5,''.$circulanteName.'',1,0,'C');	
    $this->SetY(170);$this->SetX(240);	
    $this->Cell(30,5,'Matrícula','1',1,'C');
	$this->SetX(240);	
	$this->Cell(30,5,''.$circulante.'',1,1,'C');	*/
	$this->SetX(50);
    $this->Cell(80,15,'','1',0,'C');
    $this->Cell(80,15,'','1',1,'C');
   /* $this->Cell(80,15,'','1',1,'C');*/
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