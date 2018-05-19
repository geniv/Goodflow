<?php
define('FPDF_FONTPATH','./pdf/font/');
include_once "./pdf/fpdf.php";

class PDF extends FPDF
{
  function Header() //hlavicka
  {
/*
    //Select Arial bold 15
    $this->SetFont("Arial", "B", 15);
    //Move to the right
    $this->Cell(50);
    //Framed title
    $this->Cell(100, 10, utf8_decode("jméno"), 0, 0, "C");
    //Line break
    $this->Ln(20);
  */
  }

  function Footer() //paticka
  {
      //Go to 1.5 cm from bottom
      $this->SetY(-15);
      //Select Arial italic 8
      $this->SetFont("Arial", "I", 8);
      //Print centered page number
      $this->Cell(0,10,"Seite {$this->PageNo()}", 0, 0, "C");
  }
}

/*
require "./pdf/fpdf.php";

$pdf = new FPDF();

$pdf->AddPage();
$pdf->SetFont("Arial", "U", 16);

$pdf->Cell(190, 10, "Hello World!", 1, 1, "C");
//$pdf->Image("foto.php?sekce=zamestnancimini&amp;id=1", 100, 100, 128);
$pdf->Output();

//foto.php?sekce=zamestnancimini&id=1

define('FPDF_FONTPATH','./pdf/font/');
include_once "./pdf/fpdf.php";

class PDF extends FPDF
{
//Page header
  function Header()
  {
      //Logo
      $this->Image('logo_pb.png',10,8,33);
      //Arial bold 15
      $this->SetFont('Arial','B',15);
      //Move to the right
      $this->Cell(80);
      //Title
      $this->Cell(30,10,'Title vole',1,0,'C');
      //Line break
      $this->Ln(20);
  }

//Page footer
  function Footer()
  {
      //Position at 1.5 cm from bottom
      //$this->SetY(-15);
      //Arial italic 8
      //$this->SetFont('Arial','I',8);
      //Page number
      //$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
  }
}

//Instanciation of inherited class
$pdf = new PDF();
//$pdf->AliasNbPages();
//$pdf->AddPage();
$pdf->SetFont('Times','',12);

$pdf->Output();
*/

?>
