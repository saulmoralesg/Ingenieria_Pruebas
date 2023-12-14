<?php
require('fpdf.php');
class PDF_MC_Table extends FPDF
{
var $widths;
var $aligns;

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
	//yo la agregue

	if($this->tabla == "requerimientodelegoumae")
	$this->SetX(40);
	else if($this->tabla == "requerimientoxum")	
	$this->SetX(20);		
	//Draw the cells of the row
	for($i=0;$i<count($data);$i++)
	{
		$w=$this->widths[$i];
		if($i==0)
		$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'R';
		if($i>0 && $i<2)
		$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
		if($i==2)
		$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
		if($i>2)
		$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'R';		
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
	if($this->GetY()+$h>$this->PageBreakTrigger)
	$this->AddPage($this->CurOrientation);		
}

function NbLines($w,$txt)
{
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
}

function Header()
{	
	$this->Image('imagenes/issstel.jpg',50,13,52);		
	$this->SetFont('Arial','B',8);
	$this->SetXY(244,22);
	$this->SetFont('Arial','B',8);
	$this->Cell(20,6,utf8_decode("Fecha de impresión: "),0,0,'R');
	$this->SetXY(242,26);
	$this->SetFont('Arial','',8);
	$this->Cell(20,6,''.$this->fecha.'',0,0,'R');
	$this->SetXY(178,19);
	$this->SetXY(178,24);
	$this->SetFont('Arial','',8);
	$this->Cell(20,6,''.$this->fr.'',0,0,'R');
	$this->SetY(6);
	
	

	if ($this->header == 2)
	{
		if($this->salto!=1)
		{
			$this->Ln(25);
			$this->SetFont('Arial','B',11);
			$this->MultiCell(0,4,$this->opcion." ".$this->delegacion, 0, "C",0,0,0,0);
						$this->Ln(1);			
			
			$this->SetFont('Arial','B',8);
			$this->SetX(20);
			$this->SetFillColor(191,191,191);
			$this->Cell(246,5,$this->um, 1, 0, "C",true);
			$this->Ln(5);			
			
			$this->SetFont('Arial','B',8);
			$this->SetFillColor(217,217,217);
			$this->SetX(20);									
			$this->Cell(246,5,$this->txt, 1, 0, "C",true);
			$this->SetFont('Arial','B',8);
		
			$y=$this->GetY()+5;				
			$this->SetXY(20,$y);
			$this->Cell(8,10,(utf8_decode("No.")), 1, 0, "C");
			$this->SetX(28);
			$this->Cell(42,10,(utf8_decode("Grupo de Servicio")), 1, 0, "C");
			$this->SetX(70);
			if($this->txt=='Faltantes')
			{
				$this->Cell(110,10,"Producto", 1, 0, "C");
				$this->SetXY(180,$y);
				$this->MultiCell(29,5,utf8_decode("Causa\nPrincipal"), 1, "C",0,0,0,0);
				$this->SetXY(209,$y);
				$this->MultiCell(21,5,utf8_decode("Ambulatorio/\nHospitalario"), 1, "C",0,0,0,0);
				$this->SetXY(230,$y);
				$this->MultiCell(18,5,utf8_decode("Eventos\nMensuales"), 1, "C",0,0,0,0);	
				$this->SetXY(248,$y);
				$this->MultiCell(18,5,utf8_decode("Pacientes\nMensuales"), 1, "C",0,0,0,0);
			}
			else
			{
				$this->Cell(139,10,"Producto", 1, 0, "C");
				$this->SetXY(209,$y);
				$this->MultiCell(21,5,utf8_decode("Ambulatorio/\nHospitalario"), 1, "C",0,0,0,0);			
				$this->SetXY(230,$y);
				$this->MultiCell(18,5,utf8_decode("Eventos\nMensuales"), 1, "C",0,0,0,0);	
				$this->SetXY(248,$y);
				$this->MultiCell(18,5,utf8_decode("Pacientes\nMensuales"), 1, "C",0,0,0,0);
			}
		}
	}		
}

function Footer()
{
	$del=$_REQUEST['del'];	
	if($this->version=='Preliminar')
	{
		$this->SetY(-25);
		$this->SetFont('Arial','B',8);
		$this->SetX(20);
		$this->MultiCell(246,5,utf8_decode('Sin Validez Oficial.'), 0, "C",0,0,0,0);
		$this->SetX(20);
		$this->MultiCell(246,3,''.$this->uno.utf8_decode(' aún no cierra el registro de información.'), 0, "C",0,0,0,0);
		/*
				$this->SetY(-28);
		$this->SetFont('Arial','B',8);
		$this->SetX(20);
		$this->MultiCell(246,5,utf8_decode('Sin Validez Oficial.'), 0, "C",0,0,0,0);
		$this->SetX(20);
		$this->MultiCell(246,5,utf8_decode('La '.$this->uno.' aún no cierra el registro de información.'), 0, "C",0,0,0,0);
		*/
	}
	else
	{
		$this->SetXY(50,-24); //-28
		$this->SetFont('Arial','',8);
		if($del>'41')	
		$this->Cell(72,5,'Director:','1','1','C');
		else
		$this->Cell(72,5,utf8_decode('Subdelegación Médica:'),'1','1','C');
		
		$this->SetX(50);
		$this->Cell(72,5,''.$this->namedelegado.'',1,0,'L');
	
		if($del<'41')
		{
		$this->SetXY(159,-24); //-28
		$this->Cell(75,5,utf8_decode('Subdelegación Administrativa. '),'1',1,'C');
		$this->SetX(159);
		$this->Cell(75,5,''.$this->namejpm.'',1,0,'L');	
		}
		else
		{/*
		$this->SetXY(159,-24); //-28
		$this->Cell(70,5,utf8_decode('Subdelegación Administrativa.  '),'1',1,'C');
		$this->SetX(159);
		$this->Cell(70,5,''.$this->namejpm.'',1,0,'L');*/ 
		}
	}	
    $this->SetY(-15);	
	$this->SetFont('Arial','',8);	
	$this->Cell(0,3,utf8_decode("Página ").$this->PageNo().' de {nb}',0,0,'C');
}
}
?>