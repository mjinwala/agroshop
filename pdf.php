<?php
require('FPDF/fpdf.php');
include("db.php");
$b_id = $_GET['user_id'];
$invoice = $_GET['invoice'];
$user = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM `buyer` WHERE `b_id` = '$b_id'"));
$payment_master = mysqli_query($con,"SELECT * FROM `payment_master` WHERE `invoice` = '$invoice'");

class PDF extends FPDF
{
	/* Page header */
	function Header()
	{
		/* Logo */
		$this->Image('img/agroshop-logo.png',25,10,160,12);
       $this->Ln(20);

	}
    function RoundedRect($x, $y, $w, $h, $r, $style = '')
    {
        $k = $this->k;
        $hp = $this->h;
        if($style=='F')
            $op='f';
        elseif($style=='FD' || $style=='DF')
            $op='B';
        else
            $op='S';
        $MyArc = 4/3 * (sqrt(2) - 1);
        $this->_out(sprintf('%.2F %.2F m',($x+$r)*$k,($hp-$y)*$k ));
        $xc = $x+$w-$r ;
        $yc = $y+$r;
        $this->_out(sprintf('%.2F %.2F l', $xc*$k,($hp-$y)*$k ));

        $this->_Arc($xc + $r*$MyArc, $yc - $r, $xc + $r, $yc - $r*$MyArc, $xc + $r, $yc);
        $xc = $x+$w-$r ;
        $yc = $y+$h-$r;
        $this->_out(sprintf('%.2F %.2F l',($x+$w)*$k,($hp-$yc)*$k));
        $this->_Arc($xc + $r, $yc + $r*$MyArc, $xc + $r*$MyArc, $yc + $r, $xc, $yc + $r);
        $xc = $x+$r ;
        $yc = $y+$h-$r;
        $this->_out(sprintf('%.2F %.2F l',$xc*$k,($hp-($y+$h))*$k));
        $this->_Arc($xc - $r*$MyArc, $yc + $r, $xc - $r, $yc + $r*$MyArc, $xc - $r, $yc);
        $xc = $x+$r ;
        $yc = $y+$r;
        $this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-$yc)*$k ));
        $this->_Arc($xc - $r, $yc - $r*$MyArc, $xc - $r*$MyArc, $yc - $r, $xc, $yc - $r);
        $this->_out($op);
    }

    function _Arc($x1, $y1, $x2, $y2, $x3, $y3)
    {
        $h = $this->h;
        $this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c ', $x1*$this->k, ($h-$y1)*$this->k,
            $x2*$this->k, ($h-$y2)*$this->k, $x3*$this->k, ($h-$y3)*$this->k));
    }
    function Footer()
    {
        // Go to 1.5 cm from bottom
        $this->SetY(-15);
        // Select Arial italic 8
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(190,-35,'Contact-Us',0,1,'C');
        $this->SetLineWidth(0.4);
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(190,55,'Email :- info@agroghop.com || Web :- www.agroghop.com || Phone :- +91 999999999',0,0,'C');
       
     
     $this->Line(20,270,190,270);  
      }

}


    

/* Instanciation of inherited class */
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$x_axis_rect = 13;// increment by 39
$y_axis_rect = 121;// increment by 10
$counter = 1;
while($payment_row = mysqli_fetch_assoc($payment_master)){
    
$pdf->SetFont('Times','',10);

$pdf->Cell(20,6,'Agroshop',0,1);
$pdf->Cell(20,6,'www.agroshop.com',0,1);
$pdf->Cell(20,6,'Agroshop@gmail.com',0,1);
$pdf->Cell(20,6,'+91-9999999999',0,1);

$pdf->Ln(25);
// Username
$pdf->SetFont('Helvetica','B',13);

$pdf->SetFillColor(184);
$pdf->RoundedRect(10,79,30,10, 1.5, 'DF');
$pdf->Cell(30,10,'Name',0,0,'C');

$pdf->SetFont('Helvetica','',13);
$pdf->SetFillColor(229);
$pdf->RoundedRect(42,79,55,10, 1.5, 'DF');
$pdf->Cell(56,10,$user['b_name'],0,1,'C');

// invoice
$pdf->SetFont('Helvetica','B',10);
$pdf->SetFillColor(185);
$pdf->RoundedRect(120,79,30,9, 1.5, 'DF');
$pdf->Cell(250,-10,'Invoice',0,1,'C');
$pdf->SetFont('Helvetica','',10);
$pdf->SetFillColor(229);
$pdf->RoundedRect(151,79,50,9, 1.5, 'DF');
$pdf->Cell(330,10,'#'.$invoice,0,1,'C');


// date
$pdf->SetFont('Helvetica','B',10);
$pdf->SetFillColor(185);
$pdf->RoundedRect(120,90,30,9, 1.5, 'DF');
$pdf->Cell(250,11,'Date',0,1,'C');

$pdf->SetFont('Helvetica','',10);
$pdf->SetFillColor(229);
$pdf->RoundedRect(151,90,50,9, 1.5, 'DF');
$pdf->Cell(335,-11,$payment_row['placed_on'],0,1,'C');

// 4 columns data
$pdf->Ln(25);
// header column
$pdf->SetFont('Helvetica','B',10);
$pdf->SetFillColor(175);
$pdf->RoundedRect(13,111.5,35,9, 1.5, 'DF');
$pdf->Cell(38,5,'#',0,0,'C');

$pdf->RoundedRect(49,111.5,35,9, 1.5, 'DF');
$pdf->Cell(37,5,'Item',0,0,'C');

$pdf->RoundedRect(85,111.5,35,9, 1.5, 'DF');
$pdf->Cell(36,5,'Quantity',0,0,'C');

$pdf->RoundedRect(121,111.5,35,9, 1.5, 'DF');
$pdf->Cell(35,5,'Price',0,0,'C');

// body column

$pdf->SetFont('Helvetica','',10);
$pdf->Ln(10);
$pdf->SetFillColor(299);
// 1st row

$order_master = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM `order_master` WHERE `invoice` = '$invoice'"));
$product_master = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM `product_master` WHERE `p_id` = '".$order_master['p_id']."'"));

$quantity = round($order_master['price'] / $product_master['price']);

$pdf->RoundedRect(13,$y_axis_rect,35,9, 0.5, 'DF');
$pdf->Cell(38,5,$counter,0,0,'C');

$pdf->RoundedRect(49,$y_axis_rect,35,9, 0.5, 'DF');
$pdf->Cell(37,5,$product_master['p_name'],0,0,'C');
 
$pdf->RoundedRect(85,$y_axis_rect,35,9, 0.5, 'DF');
$pdf->Cell(36,5,$quantity,0,0,'C');

$pdf->RoundedRect(121,$y_axis_rect,35,9, 0.5, 'DF');
$pdf->Cell(35,5,$product_master['price'] * $quantity,0,0,'C');
$pdf->Ln(10);
$y_axis_rect +=10;
$store_y_axis = $y_axis_rect ; 


// final price 

$pdf->SetFont('Helvetica','',10);
$pdf->Ln(30);
$pdf->SetFillColor(299);

$store_y_axis +=75;


$pdf->SetFont('Helvetica','B',10);
$pdf->SetFillColor(185);
$pdf->RoundedRect(120,$store_y_axis,30,9, 1.5, 'DF');
$pdf->Cell(250,95,'Total',0,1,'C');
$pdf->SetFont('Helvetica','',10);
$pdf->SetFillColor(229);
$pdf->RoundedRect(151,$store_y_axis,50,9, 1.5, 'DF');
$pdf->Cell(320,-96,'Rs.' . $payment_row['total_price'],0,1,'C');


$pdf->Ln(2);
$store_y_axis +=10;
$pdf->SetFont('Helvetica','B',10);
$pdf->SetFillColor(185);
$pdf->RoundedRect(120,$store_y_axis,30,9, 1.5, 'DF');
$pdf->Cell(250,110,'Amount Paid',0,1,'C');
$pdf->SetFont('Helvetica','',10);
$pdf->SetFillColor(229);
$pdf->RoundedRect(151,$store_y_axis,50,9, 1.5, 'DF');
$pdf->Cell(320,-109,'Rs.'.$payment_row['total_price'],0,1,'C');






}




$pdf->Output();
?>
