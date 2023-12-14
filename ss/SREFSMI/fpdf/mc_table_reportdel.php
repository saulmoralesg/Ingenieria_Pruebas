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
	$this->Cell(100,4,'UMAE Hospital de Traumatología y Ortopedia',0,2,'C');
	$this->SetXY(90,25);
	$this->Cell(100,4,'Almacén de Osteosíntesis',0,2,'C');
	//$this->Cell(100,4,'',0,1,'L');		
	if($this->ProcessingTable)
	$this->TableHeader();
}
//FuNcIoN PiE De PaG
function Footer()
{
$del=$_GET['del'];
/*$a=mysql_db_query("contratos2015","SELECT
delegaciones.del,
delegaciones.delegoumae,
delegaciones.delegadodirumae,
delegaciones.jpmdirmed,
delegaciones.pdf
FROM delegaciones_ss  WHERE
delegaciones.del =  '$del'
") or die(mysql_error());
while($f=mysql_fetch_array($a))
	{
	
		$delegado1= $f["delegadodirumae"];
		$jpm1 = $f["jpmdirmed"];
		
		$pdf = $f["pdf"];
		$delegado=$delegado1;
		$jpm=$jpm1;
		
	}
	if ($pdf == 2) {
	$uno='Director de UMAE: ';
	$dos='Director Médico:  ';
	}
	else {
	$uno='Delegado:';
	$dos='Jefe de Prestaciones Médicas:';
	}*/
	
//$uno='Delegado o Director de UMAE';
//$dos='Jefe de Prestaciones Médicas o director Médico de UMAE';
//$tres='Jefe de Conservación y Servicios Generales';
    //$this->SetY(200);
    //Arial italic 8
    $this->SetFont('Arial','',8);
    //Número de página
	$this->SetY(170);$this->SetX(20);
    $this->Cell(80,5,'Nombre de quien entrega :','1',0,'C');
    $this->Cell(40,5,'Matrícula','1',0,'C');
    $this->Cell(80,5,'Nombre de quien recibe :','1',0,'C');
    $this->Cell(40,5,'Matricula','1',1,'C');
    $this->Cell(80,15,'','1',0,'C');
    $this->Cell(40,15,'','1',0,'C');
    $this->Cell(80,15,'','1',0,'C');
    $this->Cell(40,15,'','1',1,'C');	
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