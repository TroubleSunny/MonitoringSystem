<?php
require('fpdf.php');
include("connection.php");

if(isset($_GET['col']))
{
    $col = $_GET['col'];
    
}
class PDF extends FPDF {
	function Header(){
		$this->SetFont('Arial','B',15);
		
		
		$this->Cell(12);
		
		
	
		
		$this->Cell(100,10,'Research Titles',0,1);
		
		
		$this->Ln(5);
		
		$this->SetFont('Arial','B',9);
		
		$this->SetFillColor(180,180,255);
		$this->SetDrawColor(180,180,255);
		$this->Cell(15,5,'Research Classification',1,0,'',true);
		$this->Cell(21,5,'Category',1,0,'',true);
        $this->Cell(20,5,'University Research Agenda',1,0,'',true);
        $this->Cell(30,5,'Title of Research',1,0,'',true);
        
        $this->Cell(20,5,'Nature of Involvement',1,0,'',true);
        $this->Cell(20,5,'Type of Research',1,0,'',true);
       
        $this->Cell(20,5,'Type of Funding',1,0,'',true);
        $this->Cell(20,5,'Amount of Funding',1,0,'',true);
        $this->Cell(20,5,'Funding Agency',1,0,'',true);
        $this->Cell(20,5,'Actual Date Started',1,0,'',true);
        $this->Cell(20,5,'Target Date of Completion',1,0,'',true);
        $this->Cell(20,5,'Status',1,0,'',true);
        $this->Cell(26,5,'Date Completed',1,1,'',true);
		
	}
	function Footer(){
		
		$this->Cell(190,0,'','T',1,'',true);
		
		
		$this->SetY(-15);
				
		$this->SetFont('Arial','',8);
		
		
		$this->Cell(0,10,'Page '.$this->PageNo()." / {pages}",0,0,'C');
	}
}
$pdf = new PDF('P','mm','A4'); 


$pdf->AliasNbPages('{pages}');

$pdf->SetAutoPageBreak(true,15);
$pdf->AddPage('L');

$pdf->SetFont('Arial','',9);
$pdf->SetDrawColor(180,180,255);


$query=mysqli_query($con,"SELECT * FROM researchongoing WHERE SubmissionId IN (SELECT SubmissionId FROM submission WHERE UserId IN (SELECT UserId FROM user WHERE College='$col'))");
if(mysqli_num_rows($query)>0)
{
    while($data=mysqli_fetch_array($query)){
        $pdf->Cell(15,5,$data['RoClass'],'1',0);
        $pdf->Cell(21,5,$data['RoCategory'],'1',0);
        $pdf->Cell(20,5,$data['RoAgenda'],'1',0);
        $pdf->Cell(30,5,$data['RoTitle'],'1',0);
        $pdf->Cell(20,5,$data['RoInvolve'],'1',0);
        $pdf->Cell(20,5,$data['RoType'],'1',0);
        $pdf->Cell(20,5,$data['RoFundType'],'1',0);
        $pdf->Cell(20,5,$data['RoFundAmount'],'1',0);
        $pdf->Cell(20,5,$data['RoFundAgency'],'1',0);
        $pdf->Cell(20,5,$data['RoDateStart'],'1',0);
        $pdf->Cell(20,5,$data['RoDateTarget'],'1',0);
        $pdf->Cell(20,5,$data['RoStatus'],'1',0);
        $pdf->Cell(26,5,$data['RoDateCompleted'],'1',1);	
        
    }   
}






















$pdf->Output();
?>