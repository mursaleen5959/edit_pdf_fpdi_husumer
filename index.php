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



class CustomFpdi extends Fpdi {
    protected $tplId;

    public function setTemplateId($tplId) {
        $this->tplId = $tplId;
    }

    public function AddPage($orientation = '', $size = '', $rotation = 0) {
        parent::AddPage($orientation, $size, $rotation);
        if (!empty($this->tplId)) {
            $this->useTemplate($this->tplId);
            $this->SetY(40);
        }
    }
}

// initiate FPDI
$pdf = new CustomFpdi();


// set the source file
$pdf->setSourceFile("template.pdf");

// import page 1
$tplId = $pdf->importPage(1);
// add a page
$pdf->AddPage();

// use the imported page and place it at point 10,10 with a width of 100 mm
$pdf->useTemplate($tplId);
$pdf->setTemplateId($tplId);

$pdf->SetAutoPageBreak(true,30);



$pdf->SetFont('Arial', '', 6);
$x = 25;
$y = 45;
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 25, $CellHeight = 8, $text = "friedensbewegung.de c/o hehomedia Kiebitzreihe 1 25813 Husum", $border = 0, $alignment = 'L',$fill=false);


$pdf->SetFont('Arial', '', 11);
$x = 25;
$y = 65;
$pdf->SetY($y);
$pdf->SetX($x);
$pdf->MultiCell(42,4,mb_convert_encoding("Melanie Götz Heiligenbergstraße 41 72584 Hülben", "ISO-8859-1", "UTF-8"),0,"L");


$pdf->SetFont('Arial', 'B', 11);
$x = 144;
$y = 50;
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 25, $CellHeight = 5, $text = "Datum", $border = 0, $alignment = 'L',$fill=false);
$y += 5;
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 25, $CellHeight = 5, $text = "Kunde", $border = 0, $alignment = 'L',$fill=false);
$y += 5;
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 25, $CellHeight = 5, $text = "Rechnung", $border = 0, $alignment = 'L',$fill=false);
$y += 5;
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 25, $CellHeight = 5, $text = "Seite", $border = 0, $alignment = 'L',$fill=false);

$pdf->SetFont('Arial', '', 11);
$x = $pdf->GetX();
$y = 50;
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 25, $CellHeight = 5, $text = "21.02.2023", $border = 0, $alignment = 'L',$fill=false);
$y += 5;
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 25, $CellHeight = 5, $text = "KD-0627-FB", $border = 0, $alignment = 'L',$fill=false);
$y += 5;
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 25, $CellHeight = 5, $text = "RG-0654-FB", $border = 0, $alignment = 'L',$fill=false);
$y += 5;
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 25, $CellHeight = 5, $text = "1 von 1", $border = 0, $alignment = 'L',$fill=false);


$pdf->SetFont('Arial', 'B', 16);
$x = 24.5;
$y += 35;
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 25, $CellHeight = 5, $text = "Rechnung", $border = 0, $alignment = 'L',$fill=false);
$pdf->SetFont('Arial', '', 11);
$y += 12;
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 25, $CellHeight = 5, $text = "Sehr geehrte Damen und Herren,", $border = 0, $alignment = 'L',$fill=false);
$y += 5;
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 25, $CellHeight = 5, $text = iconv('UTF-8', 'windows-1252',"für die unten aufgeführten Produkte erlauben wir uns in Rechnung zu stellen:"), $border = 0, $alignment = 'L',$fill=false);



$pdf->SetFont('Arial', 'B', 10);
$y = 125;
$x = 29.5;
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 15, $CellHeight = 5, $text = "Anzahl", $border = 0, $alignment = 'R',$fill=false);
$x = $pdf->GetX();
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 100, $CellHeight = 5, $text = "Produktbeschreibung", $border = 0, $alignment = 'L',$fill=false);
$x = $pdf->GetX();
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 23, $CellHeight = 5, $text = "Einzelpreis", $border = 0, $alignment = 'R',$fill=false);
$x = $pdf->GetX();
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 25, $CellHeight = 5, $text = "Gesamtpreis", $border = 0, $alignment = 'R',$fill=false);


$pdf->SetFont('Arial', '', 11);
$y = 131;
$x = 29.5;

foreach ($products as $key => $product_array) {
    if($y >= 210){
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 10);
        $y = 50;
        $x = 29.5;
        insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 15, $CellHeight = 5, $text = "Anzahl", $border = 0, $alignment = 'R',$fill=false);
        $x = $pdf->GetX();
        insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 100, $CellHeight = 5, $text = "Produktbeschreibung", $border = 0, $alignment = 'L',$fill=false);
        $x = $pdf->GetX();
        insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 23, $CellHeight = 5, $text = "Einzelpreis", $border = 0, $alignment = 'R',$fill=false);
        $x = $pdf->GetX();
        insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 25, $CellHeight = 5, $text = "Gesamtpreis", $border = 0, $alignment = 'R',$fill=false);
        $pdf->SetFont('Arial', '', 11);
        $y += 6;
        $x = 29.5;
    }
    insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 15, $CellHeight = 5, $text = utf8_decode($product_array[0]), $border = 0, $alignment = 'R',$fill=false);
    $x = $pdf->GetX();
    insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 100, $CellHeight = 5, $text = utf8_decode($product_array[1]), $border = 0, $alignment = 'L',$fill=false);
    $x = $pdf->GetX();
    insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 23, $CellHeight = 5, $text = iconv('UTF-8', 'windows-1252', $product_array[2]), $border = 0, $alignment = 'R',$fill=false);
    $x = $pdf->GetX();
    insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 25, $CellHeight = 5, $text = iconv('UTF-8', 'windows-1252',$product_array[3]), $border = 0, $alignment = 'R',$fill=false);
    $y += 6;
    $x = 29.5;
}

$y+=5;
$pdf->Line(120, $y, 192, $y);

$x = 120;
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 48, $CellHeight = 5, $text = "Gesamtbetrag netto", $border = 0, $alignment = 'R',$fill=false);
$x = $pdf->GetX();
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 24.5, $CellHeight = 5, $text = iconv('UTF-8', 'windows-1252',"5,97 €"), $border = 0, $alignment = 'R',$fill=false);
$y += 6;
$x = 120;
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 48, $CellHeight = 5, $text = "zzgl. 19 % Umsatzsteuer", $border = 0, $alignment = 'R',$fill=false);
$x = $pdf->GetX();
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 24.5, $CellHeight = 5, $text = iconv('UTF-8', 'windows-1252',"1,13 €"), $border = 0, $alignment = 'R',$fill=false);

$y += 6;
$pdf->Line(120, $y, 192, $y);

$pdf->SetFont('Arial', 'B', 11);

$x = 120;
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 48, $CellHeight = 5, $text = "Gesamtbetrag brutto", $border = 0, $alignment = 'R',$fill=false);
$x = $pdf->GetX();
insert_cell($pdf, $X = $x, $Y = $y, $CellWidth = 24.5, $CellHeight = 5, $text = iconv('UTF-8', 'windows-1252',"7,10 €"), $border = 0, $alignment = 'R',$fill=false);

$y += 6;
$pdf->Line(120, $y, 192, $y);
$y += 0.5;
$pdf->Line(120, $y, 192, $y);





$pdf->SetFont('Arial', '', 11);

$x = 25;
$y += 6;
$pdf->SetY($y);
$pdf->SetX($x);
$pdf->MultiCell(140,4,mb_convert_encoding("Den Gesamtbetrag haben wir bereits dankend per Überweisung erhalten. Ihre Shop-Bestellnummer zu dieser Rechnung lautet: 10063", "ISO-8859-1", "UTF-8"),0,"L");
$y = $pdf->GetY()+3;
$pdf->SetY($y);
$pdf->SetX($x);
$pdf->MultiCell(145,4,mb_convert_encoding("Bei Fragen und Anregungen stehen wir Ihnen gerne jederzeit zur Verfügung. Wir bedanken uns für Ihre Bestellung und verbleiben mit friedlichen Grüßen.", "ISO-8859-1", "UTF-8"),0,"L");

$pdf->Output();
?>