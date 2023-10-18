<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Custom function to insert the PDF cells
define('EURO',chr(128));
function insert_cell($pdf, $X = 0, $Y = 0, $CellWidth = 0, $CellHeight = 0, $text = "", $border = 0, $alignment = 'L',$fill = false)
{
    $pdf->SetY($Y);
    $pdf->SetX($X);
    $pdf->Cell($CellWidth, $CellHeight, $text, $border, 0, $alignment,$fill);
    // $pdf->Cell($CellWidth, $CellHeight, mb_convert_encoding($text, "ISO-8859-1", "UTF-8"), $border, 0, $alignment,$fill);
    // $pdf->Cell($CellWidth, $CellHeight, iconv('UTF-8', 'windows-1252',$text), $border, 0, $alignment,$fill);
}


// DATA
$products = array(
                    array("5x","Friedensbewegung Ansteckbutton 25 mm","0,84 €","4,20 €"),
                    array("1x","Porto- und Verpackungskosten","1,77 €","1,77 €")
                );

//



require_once('vendor/autoload.php');

use setasign\Fpdi\Fpdi;

// initiate FPDI
$pdf = new Fpdi();

// add a page
$pdf->AddPage();

// set the source file
$pdf->setSourceFile("template.pdf");

// import page 1
$tplId = $pdf->importPage(1);

// use the imported page and place it at point 10,10 with a width of 100 mm
$pdf->useTemplate($tplId);

// The new content
$fontSize = '15';
$fontColor = `255,0,0`;
$left = 16;
$top = 40;
$text = 'Sample Text over overlay';

//set the font, colour and text to the page.
$pdf->SetFont("helvetica", "B", 15);
$pdf->SetTextColor($fontColor);
$pdf->Text($left,$top,$text);

//see the results
$pdf->Output();
