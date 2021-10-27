<?php
$name=$_POST['name']??'';
$email=$_POST['email']??'';
$phone=$_POST['phone']??'';
$message=$_POST['message']??'';
$donation=$_POST['donation']??'';
$conn = new mysqli('localhost','root','','contact');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error); 
	} else {
		$stmt = $conn->prepare("insert into contact(name, email, phone, message,donation) values(?, ?, ?, ?,?)"); //? means values will be taken from variable
		$stmt->bind_param("ssisi", $name, $email, $phone, $message,$donation);
		$execval = $stmt->execute();
		$stmt->close();
		$conn->close();
		require ("fpdf/fpdf.php");
		$pdf = new FPDF();
		$pdf->AddPage();
		$pdf->SetFont('Times','B',24);
		$pdf->Cell(200, 10, "MAYA FOUNDATION", 0,1 ,"C");
		$pdf->SetFont('Times','B',24);
		$pdf->Cell(200, 10, "Donation Receipt", 0, 1,"C");
		$pdf->Ln();
		$pdf->SetFont('Times','B',16);
		$pdf->Cell(0,10, "Name:{$name}", 1, 0,"C");
		$pdf->Ln();
		$pdf->SetFont('Times','B',16);
		$pdf->Cell(0, 10,"E-Mail:$email", 1, 0,"C");
		$pdf->Ln();
		$pdf->SetFont('Times','B',16);
		$pdf->Cell(0, 10,"Phone Number:{$phone}", 1, 0,"C");
		$pdf->Ln();
		$pdf->SetFont('Times','B',16);
		$pdf->Cell(0, 10,"Message:{$message}", 1, 0,"C");
		$pdf->Ln();
		$pdf->SetFont('Times','B',16);
		$pdf->Cell(0, 10,"Amount:{$donation}", 1, 0,"C");
		$pdf->Ln();
		$pdf->Output();
        
    exit();
	
	
    }
?>
<?php


?>
