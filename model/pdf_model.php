<?php 

class Pdf_model extends Model {
	
	
	public function __construct(){
		parent::__construct();
	}

	
	function stock(){
		//@session_start();
		// $sid = $_SESSION['ss'] ;
		// $st = $_SESSION['st'] ;
		// $et = $_SESSION['et'] ;
				
		$stm = $this->db->prepare("select s.bid,sid,bname,maelezo,stockin  as stockavailaable  from bidhaa  b join stock s on  b.bid = s.bid 
	where b.status= 'active' order by bname" );
	$stm->execute();
		
	//Initialize the  columns and the total
	$column_code = "";
	$column_name = "";
	$column_st = "";
	$column_q = "";
	
	
	$total = 0;

//For each row, add the field to the corresponding column
$k = 1;
while($row = $stm->fetch(PDO::FETCH_ASSOC))
{
    $code = $k;
    $name = $row['bname'];
    $st = $row['maelezo'];
	 $q = $row['stockavailaable'];
  
	  
    $column_code = $column_code.$code."\n";
    $column_name = $column_name.$name."\n";
    $column_st = $column_st.$st."\n";
	  $column_q = $column_q.$q."\n";
	  	
	$k++;

   
}


//Create a new PDF file
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(1,6,'OCHU FAMILY FARM',0,0,'L',0);
$pdf->Ln();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(1,6,'ADDRESS: K/MAITI.',0,0,'L',0);
$pdf->Ln();
$pdf->Cell(1,6,'STATE: UNGUJA, ZANZIBAR.',0,0,'L',0);
$pdf->Ln();
$pdf->Cell(1,6,'PHONE NUMBER: +255778157999',0,0,'L',0);
$pdf->Ln();
$pdf->Cell(1,6,'DATE: '. date('d/m/Y'),0,0,'L',0);
$pdf->Ln();
$pdf->Cell(1,6,'STOCK REPORT',0,0,'L',0);


//Fields Name position
$Y_Fields_Name_position = 60;
//Table position, under Fields Name
$Y_Table_Position = 66;

//First create each Field Name
//Gray color filling each Field Name box
$pdf->SetFillColor(232,232,232);
//Bold Font for Field Name
$pdf->SetFont('Arial','B',12);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(5);//SET HEADER MARGIN
$pdf->Cell(10,6,'S/N',1,0,'L',1);//SET HEADER WIDTH
$pdf->SetX(15);//SET HEADER MARGIN
$pdf->Cell(72,6,'PRODUCT NAME',1,0,'L',1);//SET HEADER WIDTH
$pdf->SetX(87);//SET HEADER MARGIN
$pdf->Cell(45,6,'DESCRIPTION',1,0,'L',1);//SET HEADER WIDTH
$pdf->SetX(132);//SET HEADER MARGIN
$pdf->Cell(47,6,'AVAILABLE STOCK',1,0,'L',1);//SET HEADER WIDTH

$pdf->Ln();

//Now show the columns
$pdf->SetFont('Arial','',12);
$pdf->SetY($Y_Table_Position);//makes both td stay in the same horizontal line
$pdf->SetX(5);//SET TD MARGIN
$pdf->MultiCell(10,6,$column_code,1);//SET TD WIDTH
$pdf->SetY($Y_Table_Position);
$pdf->SetX(15);//SET TD MARGIN
$pdf->MultiCell(72,6,$column_name,1);//SET TD WIDTH
$pdf->SetY($Y_Table_Position);
$pdf->SetX(87);//SET TD MARGIN
$pdf->MultiCell(45,6,$column_st,1,'L');//SET TD WIDTH
$pdf->SetY($Y_Table_Position);
$pdf->SetX(132);//SET TD MARGIN
$pdf->MultiCell(47,6,$column_q,1,'L');//SET TD WIDTH

//$pdf->SetX(168);
//$pdf->MultiCell(30,6,$total,1,'L');

//Create lines (boxes) for each ROW (Product)
//If you don't use the following code, you don't create the lines separating each row
$i = 0;
$pdf->SetY($Y_Table_Position);
while ($i < $k)
{
    $pdf->SetX(5);
    $pdf->MultiCell(174,6,'',1);
    $i = $i +1;
}

$pdf->Output();
		
	}
	
	
	function stockSearch(){
		@session_start();
		 $bnameSession = $_SESSION['bnameSession'] ;
		
				
		$stm = $this->db->prepare("select s.bid,sid,bname,maelezo,stockin as stockavailaable  from bidhaa  b join stock s on  b.bid = s.bid
	where bname like '%$bnameSession%' and b.status = 'active' order by bname" );
		$stm->execute();
		
	//Initialize the  columns and the total
	$column_code = "";
	$column_name = "";
	$column_st = "";
	$column_q = "";
	
	
	$total = 0;

//For each row, add the field to the corresponding column
$k = 1;
while($row = $stm->fetch(PDO::FETCH_ASSOC))
{
    $code = $k;
    $name = $row['bname'];
    $st = $row['maelezo'];
	 $q = $row['stockavailaable'];
  
	  
    $column_code = $column_code.$code."\n";
    $column_name = $column_name.$name."\n";
    $column_st = $column_st.$st."\n";
	  $column_q = $column_q.$q."\n";
	  	
	$k++;

   
}


//Create a new PDF file
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(1,6,'OCHU FAMILY FARM',0,0,'L',0);
$pdf->Ln();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(1,6,'ADDRESS: K/MAITI.',0,0,'L',0);
$pdf->Ln();
$pdf->Cell(1,6,'STATE: UNGUJA, ZANZIBAR.',0,0,'L',0);
$pdf->Ln();
$pdf->Cell(1,6,'PHONE NUMBER: +255778157999',0,0,'L',0);
$pdf->Ln();
$pdf->Cell(1,6,'DATE: '. date('d/m/Y'),0,0,'L',0);
$pdf->Ln();
$pdf->Cell(1,6,'STOCK REPORT',0,0,'L',0);


//Fields Name position
$Y_Fields_Name_position = 60;
//Table position, under Fields Name
$Y_Table_Position = 66;

//First create each Field Name
//Gray color filling each Field Name box
$pdf->SetFillColor(232,232,232);
//Bold Font for Field Name
$pdf->SetFont('Arial','B',12);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(5);//SET HEADER MARGIN
$pdf->Cell(10,6,'S/N',1,0,'L',1);//SET HEADER WIDTH
$pdf->SetX(15);//SET HEADER MARGIN
$pdf->Cell(72,6,'PRODUCT NAME',1,0,'L',1);//SET HEADER WIDTH
$pdf->SetX(87);//SET HEADER MARGIN
$pdf->Cell(45,6,'DESCRIPTION',1,0,'L',1);//SET HEADER WIDTH
$pdf->SetX(132);//SET HEADER MARGIN
$pdf->Cell(47,6,'AVAILABLE STOCK',1,0,'L',1);//SET HEADER WIDTH

$pdf->Ln();

//Now show the columns
$pdf->SetFont('Arial','',12);
$pdf->SetY($Y_Table_Position);//makes both td stay in the same horizontal line
$pdf->SetX(5);//SET TD MARGIN
$pdf->MultiCell(10,6,$column_code,1);//SET TD WIDTH
$pdf->SetY($Y_Table_Position);
$pdf->SetX(15);//SET TD MARGIN
$pdf->MultiCell(72,6,$column_name,1);//SET TD WIDTH
$pdf->SetY($Y_Table_Position);
$pdf->SetX(87);//SET TD MARGIN
$pdf->MultiCell(45,6,$column_st,1,'L');//SET TD WIDTH
$pdf->SetY($Y_Table_Position);
$pdf->SetX(132);//SET TD MARGIN
$pdf->MultiCell(47,6,$column_q,1,'L');//SET TD WIDTH

//$pdf->SetX(168);
//$pdf->MultiCell(30,6,$total,1,'L');

//Create lines (boxes) for each ROW (Product)
//If you don't use the following code, you don't create the lines separating each row
$i = 0;
$pdf->SetY($Y_Table_Position);
while ($i < $k)
{
    $pdf->SetX(5);
    $pdf->MultiCell(174,6,'',1);
    $i = $i +1;
}

$pdf->Output();
		
	}
	
	
	function product(){
				
		$stm = $this->db->prepare("select bid,bname,maelezo from bidhaa where status = 'active' order by bname" );
	$stm->execute();
		
	//Initialize the  columns and the total
	$column_code = "";
	$column_name = "";
	$column_st = "";
	$column_q = "";
	
	
	$total = 0;

//For each row, add the field to the corresponding column
$k = 1;
while($row = $stm->fetch(PDO::FETCH_ASSOC))
{
    $code = $k;
    $name = $row['bname'];
    $st = $row['maelezo'];
	
	  
    $column_code = $column_code.$code."\n";
    $column_name = $column_name.$name."\n";
    $column_st = $column_st.$st."\n";
	 
	  	
	$k++;

   
}


//Create a new PDF file
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(1,6,'OCHU FAMILY FARM',0,0,'L',0);
$pdf->Ln();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(1,6,'ADDRESS: K/MAITI.',0,0,'L',0);
$pdf->Ln();
$pdf->Cell(1,6,'STATE: UNGUJA, ZANZIBAR.',0,0,'L',0);
$pdf->Ln();
$pdf->Cell(1,6,'PHONE NUMBER: +255778157999',0,0,'L',0);
$pdf->Ln();
$pdf->Cell(1,6,'DATE: '. date('d/m/Y'),0,0,'L',0);
$pdf->Ln();
$pdf->Cell(1,6,'PRODUCT REPORT',0,0,'L',0);


//Fields Name position
$Y_Fields_Name_position = 60;
//Table position, under Fields Name
$Y_Table_Position = 66;

//First create each Field Name
//Gray color filling each Field Name box
$pdf->SetFillColor(232,232,232);
//Bold Font for Field Name
$pdf->SetFont('Arial','B',12);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(5);//SET HEADER MARGIN
$pdf->Cell(10,6,'S/N',1,0,'L',1);//SET HEADER WIDTH
$pdf->SetX(15);//SET HEADER MARGIN
$pdf->Cell(72,6,'PRODUCT NAME',1,0,'L',1);//SET HEADER WIDTH
$pdf->SetX(87);//SET HEADER MARGIN
$pdf->Cell(45,6,'DESCRIPTION',1,0,'L',1);//SET HEADER WIDTH

$pdf->Ln();

//Now show the columns
$pdf->SetFont('Arial','',12);
$pdf->SetY($Y_Table_Position);//makes both td stay in the same horizontal line
$pdf->SetX(5);//SET TD MARGIN
$pdf->MultiCell(10,6,$column_code,1);//SET TD WIDTH
$pdf->SetY($Y_Table_Position);
$pdf->SetX(15);//SET TD MARGIN
$pdf->MultiCell(72,6,$column_name,1);//SET TD WIDTH
$pdf->SetY($Y_Table_Position);
$pdf->SetX(87);//SET TD MARGIN
$pdf->MultiCell(45,6,$column_st,1,'L');//SET TD WIDTH


//$pdf->SetX(168);
//$pdf->MultiCell(30,6,$total,1,'L');

//Create lines (boxes) for each ROW (Product)
//If you don't use the following code, you don't create the lines separating each row
$i = 0;
$pdf->SetY($Y_Table_Position);
while ($i < $k)
{
    $pdf->SetX(5);
    $pdf->MultiCell(127,6,'',1);
    $i = $i +1;
}

$pdf->Output();
		
	}
	
	function productSearch(){
				@session_start();
		 $bnameSession = $_SESSION['productSearch'] ;
		$stm = $this->db->prepare("select bid,bname,maelezo from bidhaa where bname like '%$bnameSession%' and  status = 'active' order by bname" );
		$stm->execute();
		
	//Initialize the  columns and the total
	$column_code = "";
	$column_name = "";
	$column_st = "";
	$column_q = "";
	
	
	$total = 0;

//For each row, add the field to the corresponding column
$k = 1;
while($row = $stm->fetch(PDO::FETCH_ASSOC))
{
    $code = $k;
    $name = $row['bname'];
    $st = $row['maelezo'];
	
	  
    $column_code = $column_code.$code."\n";
    $column_name = $column_name.$name."\n";
    $column_st = $column_st.$st."\n";
	 
	  	
	$k++;

   
}


//Create a new PDF file
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(1,6,'OCHU FAMILY FARM',0,0,'L',0);
$pdf->Ln();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(1,6,'ADDRESS: K/MAITI.',0,0,'L',0);
$pdf->Ln();
$pdf->Cell(1,6,'STATE: UNGUJA, ZANZIBAR.',0,0,'L',0);
$pdf->Ln();
$pdf->Cell(1,6,'PHONE NUMBER: +255778157999',0,0,'L',0);
$pdf->Ln();
$pdf->Cell(1,6,'DATE: '. date('d/m/Y'),0,0,'L',0);
$pdf->Ln();
$pdf->Cell(1,6,'PRODUCT REPORT',0,0,'L',0);


//Fields Name position
$Y_Fields_Name_position = 60;
//Table position, under Fields Name
$Y_Table_Position = 66;

//First create each Field Name
//Gray color filling each Field Name box
$pdf->SetFillColor(232,232,232);
//Bold Font for Field Name
$pdf->SetFont('Arial','B',12);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(5);//SET HEADER MARGIN
$pdf->Cell(10,6,'S/N',1,0,'L',1);//SET HEADER WIDTH
$pdf->SetX(15);//SET HEADER MARGIN
$pdf->Cell(72,6,'PRODUCT NAME',1,0,'L',1);//SET HEADER WIDTH
$pdf->SetX(87);//SET HEADER MARGIN
$pdf->Cell(45,6,'DESCRIPTION',1,0,'L',1);//SET HEADER WIDTH

$pdf->Ln();

//Now show the columns
$pdf->SetFont('Arial','',12);
$pdf->SetY($Y_Table_Position);//makes both td stay in the same horizontal line
$pdf->SetX(5);//SET TD MARGIN
$pdf->MultiCell(10,6,$column_code,1);//SET TD WIDTH
$pdf->SetY($Y_Table_Position);
$pdf->SetX(15);//SET TD MARGIN
$pdf->MultiCell(72,6,$column_name,1);//SET TD WIDTH
$pdf->SetY($Y_Table_Position);
$pdf->SetX(87);//SET TD MARGIN
$pdf->MultiCell(45,6,$column_st,1,'L');//SET TD WIDTH


//$pdf->SetX(168);
//$pdf->MultiCell(30,6,$total,1,'L');

//Create lines (boxes) for each ROW (Product)
//If you don't use the following code, you don't create the lines separating each row
$i = 0;
$pdf->SetY($Y_Table_Position);
while ($i < $k)
{
    $pdf->SetX(5);
    $pdf->MultiCell(127,6,'',1);
    $i = $i +1;
}

$pdf->Output();
		
	}
	
	function stockout(){		
	$stm = $this->db->prepare("select c.fname,c.lname,curdate() as today,location,bname,maelezo,quantity from customer c join orders o on c.cid = o.cid
	join order_details od on o.oid = od.oid join bidhaa b on b.bid = od.bid where odate = curdate() and b.status = 'active'" );
	$stm->execute();
		
	//Initialize the  columns and the total
	$column_code = "";
	$column_name = "";
	$column_st = "";
	$column_q = "";
	$total = 0;

//For each row, add the field to the corresponding column
$k = 1;
while($row = $stm->fetch(PDO::FETCH_ASSOC))
{
    $code = $k;
    $name = $row['fname']." ".$row['lname']." , ".$row['location'];
    $st = $row['bname'];
    $q = $row['quantity'];
	
	  
    $column_code = $column_code.$code."\n";
    $column_name = $column_name.$name."\n";
    $column_st = $column_st.$st."\n";
    $column_q = $column_q.$q."\n";
	 
	  	
	$k++;

   
}


//Create a new PDF file
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(1,6,'OCHU FAMILY FARM',0,0,'L',0);
$pdf->Ln();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(1,6,'ADDRESS: K/MAITI.',0,0,'L',0);
$pdf->Ln();
$pdf->Cell(1,6,'STATE: UNGUJA, ZANZIBAR.',0,0,'L',0);
$pdf->Ln();
$pdf->Cell(1,6,'PHONE NUMBER: +255778157999',0,0,'L',0);
$pdf->Ln();
$pdf->Cell(1,6,'DATE: '. date('d/m/Y'),0,0,'L',0);
$pdf->Ln();
$pdf->Cell(1,6,'STOCK OUT REPORT',0,0,'L',0);


//Fields Name position
$Y_Fields_Name_position = 60;
//Table position, under Fields Name
$Y_Table_Position = 66;

//First create each Field Name
//Gray color filling each Field Name box
$pdf->SetFillColor(232,232,232);
//Bold Font for Field Name
$pdf->SetFont('Arial','B',12);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(5);//SET HEADER MARGIN
$pdf->Cell(10,6,'S/N',1,0,'L',1);//SET HEADER WIDTH
$pdf->SetX(15);//SET HEADER MARGIN
$pdf->Cell(72,6,'PRODUCT NAME',1,0,'L',1);//SET HEADER WIDTH
$pdf->SetX(87);//SET HEADER MARGIN
$pdf->Cell(60,6,'PRODUCT NAME',1,0,'L',1);//SET HEADER WIDTH
$pdf->SetX(147);//SET HEADER MARGIN
$pdf->Cell(40,6,'QUANTITY',1,0,'L',1);//SET HEADER WIDTH

$pdf->Ln();

//Now show the columns
$pdf->SetFont('Arial','',12);
$pdf->SetY($Y_Table_Position);//makes both td stay in the same horizontal line
$pdf->SetX(5);//SET TD MARGIN
$pdf->MultiCell(10,6,$column_code,1);//SET TD WIDTH
$pdf->SetY($Y_Table_Position);
$pdf->SetX(15);//SET TD MARGIN
$pdf->MultiCell(72,6,$column_name,1);//SET TD WIDTH
$pdf->SetY($Y_Table_Position);
$pdf->SetX(87);//SET TD MARGIN
$pdf->MultiCell(60,6,$column_st,1,'L');//SET TD WIDTH
$pdf->SetY($Y_Table_Position);
$pdf->SetX(147);//SET TD MARGIN
$pdf->MultiCell(40,6,$column_q,1,'L');//SET TD WIDTH


//$pdf->SetX(168);
//$pdf->MultiCell(30,6,$total,1,'L');

//Create lines (boxes) for each ROW (Product)
//If you don't use the following code, you don't create the lines separating each row
$i = 0;
$pdf->SetY($Y_Table_Position);
while ($i < $k)
{
    $pdf->SetX(5);
    $pdf->MultiCell(182,6,'',1);
    $i = $i +1;
}

$pdf->Output();
		
	}
	
	function customerSearch(){
				@session_start();
		 $bnameSession = $_SESSION['customerSession'] ;
		$stm = $this->db->prepare("select c.fname,c.lname,location,bname,maelezo,quantity from customer c join orders o on c.cid = o.cid
		join order_details od on o.oid = od.oid join bidhaa b on b.bid = od.bid where odate = curdate() and b.status = 'active' and fname like '%$bnameSession%'" );
	$stm->execute();
		
	//Initialize the  columns and the total
	$column_code = "";
	$column_name = "";
	$column_st = "";
	$column_q = "";
	
	
	$total = 0;

//For each row, add the field to the corresponding column
$k = 1;
while($row = $stm->fetch(PDO::FETCH_ASSOC))
{
    $code = $k;
    $name = $row['fname']." ".$row['lname']." , ".$row['location'];
    $st = $row['bname'];
    $q = $row['quantity'];
	
	  
    $column_code = $column_code.$code."\n";
    $column_name = $column_name.$name."\n";
    $column_st = $column_st.$st."\n";
    $column_q = $column_q.$q."\n";
	 
	  	
	$k++;

   
}


//Create a new PDF file
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(1,6,'OCHU FAMILY FARM',0,0,'L',0);
$pdf->Ln();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(1,6,'ADDRESS: K/MAITI.',0,0,'L',0);
$pdf->Ln();
$pdf->Cell(1,6,'STATE: UNGUJA, ZANZIBAR.',0,0,'L',0);
$pdf->Ln();
$pdf->Cell(1,6,'PHONE NUMBER: +255778157999',0,0,'L',0);
$pdf->Ln();
$pdf->Cell(1,6,'DATE: '. date('d/m/Y'),0,0,'L',0);
$pdf->Ln();
$pdf->Cell(1,6,'TODAY STOCK OUT REPORT',0,0,'L',0);


//Fields Name position
$Y_Fields_Name_position = 60;
//Table position, under Fields Name
$Y_Table_Position = 66;

//First create each Field Name
//Gray color filling each Field Name box
$pdf->SetFillColor(232,232,232);
//Bold Font for Field Name
$pdf->SetFont('Arial','B',12);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(5);//SET HEADER MARGIN
$pdf->Cell(10,6,'S/N',1,0,'L',1);//SET HEADER WIDTH
$pdf->SetX(15);//SET HEADER MARGIN
$pdf->Cell(72,6,'PRODUCT NAME',1,0,'L',1);//SET HEADER WIDTH
$pdf->SetX(87);//SET HEADER MARGIN
$pdf->Cell(60,6,'PRODUCT NAME',1,0,'L',1);//SET HEADER WIDTH
$pdf->SetX(147);//SET HEADER MARGIN
$pdf->Cell(40,6,'QUANTITY',1,0,'L',1);//SET HEADER WIDTH


$pdf->Ln();

//Now show the columns
$pdf->SetFont('Arial','',12);
$pdf->SetY($Y_Table_Position);//makes both td stay in the same horizontal line
$pdf->SetX(5);//SET TD MARGIN
$pdf->MultiCell(10,6,$column_code,1);//SET TD WIDTH
$pdf->SetY($Y_Table_Position);
$pdf->SetX(15);//SET TD MARGIN
$pdf->MultiCell(72,6,$column_name,1);//SET TD WIDTH
$pdf->SetY($Y_Table_Position);
$pdf->SetX(87);//SET TD MARGIN
$pdf->MultiCell(60,6,$column_st,1,'L');//SET TD WIDTH
$pdf->SetY($Y_Table_Position);
$pdf->SetX(147);//SET TD MARGIN
$pdf->MultiCell(40,6,$column_q,1,'L');//SET TD WIDTH


//$pdf->SetX(168);
//$pdf->MultiCell(30,6,$total,1,'L');

//Create lines (boxes) for each ROW (Product)
//If you don't use the following code, you don't create the lines separating each row
$i = 0;
$pdf->SetY($Y_Table_Position);
while ($i < $k)
{
    $pdf->SetX(5);
    $pdf->MultiCell(182,6,'',1);
    $i = $i +1;
}

$pdf->Output();
		
	}
	
	function bidhaaSearch(){
				@session_start();
		 $bnameSession = $_SESSION['bidhaaSession'] ;
		$stm = $this->db->prepare("select c.fname,c.lname,location,bname,maelezo,quantity from customer c join orders o on c.cid = o.cid
		join order_details od on o.oid = od.oid join bidhaa b on b.bid = od.bid where odate = curdate() and b.status = 'active' and bname like '%$bnameSession%'" );
	$stm->execute();
		$count = $stm->rowCount();
	//Initialize the  columns and the total
	$column_code = "";
	$column_name = "";
	$column_st = "";
	$column_q = "";
	
	
	$total = 0;

//For each row, add the field to the corresponding column
$k = 1;
while($row = $stm->fetch(PDO::FETCH_ASSOC))
{
    $code = $k;
    $name = $row['fname']." ".$row['lname']." , ".$row['location'];
    $st = $row['bname'];
    $q = $row['quantity'];
	
	  
    $column_code = $column_code.$code."\n";
    $column_name = $column_name.$name."\n";
    $column_st = $column_st.$st."\n";
    $column_q = $column_q.$q."\n";
	 
	  	
	$k++;

   
}


//Create a new PDF file
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(1,6,'OCHU FAMILY FARM',0,0,'L',0);
$pdf->Ln();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(1,6,'ADDRESS: K/MAITI.',0,0,'L',0);
$pdf->Ln();
$pdf->Cell(1,6,'STATE: UNGUJA, ZANZIBAR.',0,0,'L',0);
$pdf->Ln();
$pdf->Cell(1,6,'PHONE NUMBER: +255778157999',0,0,'L',0);
$pdf->Ln();
$pdf->Cell(1,6,'DATE: '. date('d/m/Y'),0,0,'L',0);
$pdf->Ln();
$pdf->Cell(1,6,'TODAY STOCK OUT REPORT',0,0,'L',0);


//Fields Name position
$Y_Fields_Name_position = 60;
//Table position, under Fields Name
$Y_Table_Position = 66;

//First create each Field Name
//Gray color filling each Field Name box
$pdf->SetFillColor(232,232,232);
//Bold Font for Field Name
$pdf->SetFont('Arial','B',12);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(5);//SET HEADER MARGIN
$pdf->Cell(10,6,'S/N',1,0,'L',1);//SET HEADER WIDTH
$pdf->SetX(15);//SET HEADER MARGIN
$pdf->Cell(72,6,'PRODUCT NAME',1,0,'L',1);//SET HEADER WIDTH
$pdf->SetX(87);//SET HEADER MARGIN
$pdf->Cell(60,6,'PRODUCT NAME',1,0,'L',1);//SET HEADER WIDTH
$pdf->SetX(147);//SET HEADER MARGIN
$pdf->Cell(40,6,'QUANTITY',1,0,'L',1);//SET HEADER WIDTH

$pdf->Ln();

//Now show the columns
$pdf->SetFont('Arial','',12);
$pdf->SetY($Y_Table_Position);//makes both td stay in the same horizontal line
$pdf->SetX(5);//SET TD MARGIN
$pdf->MultiCell(10,6,$column_code,1);//SET TD WIDTH
$pdf->SetY($Y_Table_Position);
$pdf->SetX(15);//SET TD MARGIN
$pdf->MultiCell(72,6,$column_name,1);//SET TD WIDTH
$pdf->SetY($Y_Table_Position);
$pdf->SetX(87);//SET TD MARGIN
$pdf->MultiCell(60,6,$column_st,1,'L');//SET TD WIDTH
$pdf->SetY($Y_Table_Position);
$pdf->SetX(147);//SET TD MARGIN
$pdf->MultiCell(40,6,$column_q,1,'L');//SET TD WIDTH


//$pdf->SetX(168);
//$pdf->MultiCell(30,6,$total,1,'L');

//Create lines (boxes) for each ROW (Product)
//If you don't use the following code, you don't create the lines separating each row
$i = 0;
$pdf->SetY($Y_Table_Position);
while ($i < $k)
{
    $pdf->SetX(5);
    $pdf->MultiCell(182,6,'',1);
    $i = $i +1;
}

$pdf->Output();
		
	}
	
	
	function periodicStock(){
				@session_start();
		 
		  $sd = $_SESSION['startSession'] ;
		  $ed = $_SESSION['endSession'] ;
		 $bname = $_SESSION['bnSession'] ;
		 
		
		 
		 if($bname == "0"){
		$stm = $this->db->prepare("select c.fname,c.lname,location,bname,maelezo,quantity,DATE_FORMAT(odate,'%d-%m-%Y') as odate from customer c join orders o on c.cid = o.cid
		join order_details od on o.oid = od.oid join bidhaa b on b.bid = od.bid where  b.status = 'active' and odate between '$sd' and '$ed' " );
		$stm->execute();
		$count = $stm->rowCount();
	 }elseif($bname != "0"){
	 $stm = $this->db->prepare("select c.fname,c.lname,location,bname,maelezo,quantity,DATE_FORMAT(odate,'%d-%m-%Y') as odate from customer c join orders o on c.cid = o.cid
		join order_details od on o.oid = od.oid join bidhaa b on b.bid = od.bid where  b.status = 'active' and bname like '%$bname%' " );
		$stm->execute();
		$count = $stm->rowCount();
		
		 
	 }
		
	//Initialize the  columns and the total
	$column_code = "";
	$column_name = "";
	$column_st = "";
	$column_stq = "";
	$column_q = "";
	
	
	
	$total = 0;

//For each row, add the field to the corresponding column
$k = 1;
while($row = $stm->fetch(PDO::FETCH_ASSOC))
{
    $code = $k;
    $name = $row['fname']." ".$row['lname']." , ".$row['location'];
    $st = $row['bname'];
    $stq = $row['quantity'];
    $q = $row['odate'];
	
	  
    $column_code = $column_code.$code."\n";
    $column_name = $column_name.$name."\n";
    $column_st = $column_st.$st."\n";
    $column_stq = $column_stq.$stq."\n";
    $column_q = $column_q.$q."\n";
	 
	  	
	$k++;

   
}


//Create a new PDF file
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(1,6,'OCHU FAMILY FARM',0,0,'L',0);
$pdf->Ln();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(1,6,'ADDRESS: K/MAITI.',0,0,'L',0);
$pdf->Ln();
$pdf->Cell(1,6,'STATE: UNGUJA, ZANZIBAR.',0,0,'L',0);
$pdf->Ln();
$pdf->Cell(1,6,'PHONE NUMBER: +255778157999',0,0,'L',0);
$pdf->Ln();
$pdf->Cell(1,6,'DATE: '. date('d/m/Y'),0,0,'L',0);
$pdf->Ln();
$pdf->Cell(1,6,'STOCK OUT REPORT',0,0,'L',0);


//Fields Name position
$Y_Fields_Name_position = 60;
//Table position, under Fields Name
$Y_Table_Position = 66;

//First create each Field Name
//Gray color filling each Field Name box
$pdf->SetFillColor(232,232,232);
//Bold Font for Field Name
$pdf->SetFont('Arial','B',12);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(5);//SET HEADER MARGIN
$pdf->Cell(10,6,'S/N',1,0,'L',1);//SET HEADER WIDTH
$pdf->SetX(15);//SET HEADER MARGIN
$pdf->Cell(72,6,'PRODUCT NAME',1,0,'L',1);//SET HEADER WIDTH
$pdf->SetX(87);//SET HEADER MARGIN
$pdf->Cell(45,6,'PRODUCT NAME',1,0,'L',1);//SET HEADER WIDTH
$pdf->SetX(132);//SET HEADER MARGIN
$pdf->Cell(25,6,'QUANTITY',1,0,'L',1);//SET HEADER WIDTH
$pdf->SetX(157);//SET HEADER MARGIN
$pdf->Cell(30,6,'DATE',1,0,'L',1);//SET HEADER WIDTH

$pdf->Ln();

//Now show the columns
$pdf->SetFont('Arial','',12);
$pdf->SetY($Y_Table_Position);//makes both td stay in the same horizontal line
$pdf->SetX(5);//SET TD MARGIN
$pdf->MultiCell(10,6,$column_code,1);//SET TD WIDTH
$pdf->SetY($Y_Table_Position);
$pdf->SetX(15);//SET TD MARGIN
$pdf->MultiCell(72,6,$column_name,1);//SET TD WIDTH
$pdf->SetY($Y_Table_Position);
$pdf->SetX(87);//SET TD MARGIN
$pdf->MultiCell(45,6,$column_st,1,'L');//SET TD WIDTH
$pdf->SetY($Y_Table_Position);
$pdf->SetX(132);//SET TD MARGIN
$pdf->MultiCell(25,6,$column_stq,1,'L');//SET TD WIDTH
$pdf->SetY($Y_Table_Position);
$pdf->SetX(157);//SET TD MARGIN
$pdf->MultiCell(30,6,$column_q,1,'L');//SET TD WIDTH


//$pdf->SetX(168);
//$pdf->MultiCell(30,6,$total,1,'L');

//Create lines (boxes) for each ROW (Product)
//If you don't use the following code, you don't create the lines separating each row
$i = 0;
$pdf->SetY($Y_Table_Position);
while ($i < $k)
{
    $pdf->SetX(5);
    $pdf->MultiCell(182,6,'',1);
    $i = $i +1;
}

$pdf->Output();
		
	}
	
	function stockin2(){
			$stm = $this->db->prepare("select bname,maelezo,stockin from bidhaa b join stock2 s on s.bid = b.bid where sdate =curdate() order by bname" );
	$stm->execute();
		
	//Initialize the  columns and the total
	$column_code = "";
	$column_name = "";
	$column_st = "";
	$column_q = "";
	
	
	
	$total = 0;

//For each row, add the field to the corresponding column
$k = 1;
while($row = $stm->fetch(PDO::FETCH_ASSOC))
{
    $code = $k;
    $name = $row['bname'];
    $st = $row['maelezo'];
    $q = $row['stockin'];
	
	  
    $column_code = $column_code.$code."\n";
    $column_name = $column_name.$name."\n";
    $column_st = $column_st.$st."\n";
    $column_q = $column_q.$q."\n";
	 
	  	
	$k++;

   
}


//Create a new PDF file
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(1,6,'OCHU FAMILY FARM',0,0,'L',0);
$pdf->Ln();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(1,6,'ADDRESS: K/MAITI.',0,0,'L',0);
$pdf->Ln();
$pdf->Cell(1,6,'STATE: UNGUJA, ZANZIBAR.',0,0,'L',0);
$pdf->Ln();
$pdf->Cell(1,6,'PHONE NUMBER: +255778157999',0,0,'L',0);
$pdf->Ln();
$pdf->Cell(1,6,'DATE: '. date('d/m/Y'),0,0,'L',0);
$pdf->Ln();
$pdf->Cell(1,6,'STOCK IN  REPORT',0,0,'L',0);


//Fields Name position
$Y_Fields_Name_position = 60;
//Table position, under Fields Name
$Y_Table_Position = 66;

//First create each Field Name
//Gray color filling each Field Name box
$pdf->SetFillColor(232,232,232);
//Bold Font for Field Name
$pdf->SetFont('Arial','B',12);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(5);//SET HEADER MARGIN
$pdf->Cell(10,6,'S/N',1,0,'L',1);//SET HEADER WIDTH
$pdf->SetX(15);//SET HEADER MARGIN
$pdf->Cell(72,6,'PRODUCT NAME',1,0,'L',1);//SET HEADER WIDTH
$pdf->SetX(87);//SET HEADER MARGIN
$pdf->Cell(60,6,'PRODUCT NAME',1,0,'L',1);//SET HEADER WIDTH
$pdf->SetX(147);//SET HEADER MARGIN
$pdf->Cell(40,6,'STOCK IN',1,0,'L',1);//SET HEADER WIDTH

$pdf->Ln();

//Now show the columns
$pdf->SetFont('Arial','',12);
$pdf->SetY($Y_Table_Position);//makes both td stay in the same horizontal line
$pdf->SetX(5);//SET TD MARGIN
$pdf->MultiCell(10,6,$column_code,1);//SET TD WIDTH
$pdf->SetY($Y_Table_Position);
$pdf->SetX(15);//SET TD MARGIN
$pdf->MultiCell(72,6,$column_name,1);//SET TD WIDTH
$pdf->SetY($Y_Table_Position);
$pdf->SetX(87);//SET TD MARGIN
$pdf->MultiCell(60,6,$column_st,1,'L');//SET TD WIDTH
$pdf->SetY($Y_Table_Position);
$pdf->SetX(147);//SET TD MARGIN
$pdf->MultiCell(40,6,$column_q,1,'L');//SET TD WIDTH


//$pdf->SetX(168);
//$pdf->MultiCell(30,6,$total,1,'L');

//Create lines (boxes) for each ROW (Product)
//If you don't use the following code, you don't create the lines separating each row
$i = 0;
$pdf->SetY($Y_Table_Position);
while ($i < $k)
{
    $pdf->SetX(5);
    $pdf->MultiCell(182,6,'',1);
    $i = $i +1;
}

$pdf->Output();
		
	}
	
	
	function stockinSearch(){
		
		@session_start();
		 
		  $sd1 = $_SESSION['startSession1'] ;
		  $ed1 = $_SESSION['endSession1'] ;
		 $bname1 = $_SESSION['bnSession1'] ;
		 
			if($bname1 == "0"){
		$stm = $this->db->prepare("select bname,maelezo,stockin,DATE_FORMAT(sdate,'%d-%m-%Y')as sdate from bidhaa b join stock2 s on s.bid = b.bid
		where sdate between '$sd1' and '$ed1' order by bname" );
		$stm->execute();
		$_SESSION['bnSession1'] = $bname1;
		}elseif($bname1 != "0"){
		$stm = $this->db->prepare("select bname,maelezo,stockin,DATE_FORMAT(sdate,'%d-%m-%Y')as sdate from bidhaa b join stock2 s on s.bid = b.bid
		where bname like '%$bname1%' order by bname" );
		$stm->execute();
		$_SESSION['bnSession1'] = $bname1;
			
		}
	//Initialize the  columns and the total
	$column_code = "";
	$column_name = "";
	$column_st = "";
	$column_q = "";
	
	
	
	$total = 0;

//For each row, add the field to the corresponding column
$k = 1;
while($row = $stm->fetch(PDO::FETCH_ASSOC))
{
    $code = $k;
    $name = $row['bname'];
    $st = $row['sdate'];
    $q = $row['stockin'];
	
	  
    $column_code = $column_code.$code."\n";
    $column_name = $column_name.$name."\n";
    $column_st = $column_st.$st."\n";
    $column_q = $column_q.$q."\n";
	 
	  	
	$k++;

   
}


//Create a new PDF file
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(1,6,'OCHU FAMILY FARM',0,0,'L',0);
$pdf->Ln();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(1,6,'ADDRESS: K/MAITI.',0,0,'L',0);
$pdf->Ln();
$pdf->Cell(1,6,'STATE: UNGUJA, ZANZIBAR.',0,0,'L',0);
$pdf->Ln();
$pdf->Cell(1,6,'PHONE NUMBER: +255778157999',0,0,'L',0);
$pdf->Ln();
$pdf->Cell(1,6,'DATE: '. date('d/m/Y'),0,0,'L',0);
$pdf->Ln();
$pdf->Cell(1,6,'STOCK IN  REPORT',0,0,'L',0);


//Fields Name position
$Y_Fields_Name_position = 60;
//Table position, under Fields Name
$Y_Table_Position = 66;

//First create each Field Name
//Gray color filling each Field Name box
$pdf->SetFillColor(232,232,232);
//Bold Font for Field Name
$pdf->SetFont('Arial','B',12);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(5);//SET HEADER MARGIN
$pdf->Cell(10,6,'S/N',1,0,'L',1);//SET HEADER WIDTH
$pdf->SetX(15);//SET HEADER MARGIN
$pdf->Cell(72,6,'PRODUCT NAME',1,0,'L',1);//SET HEADER WIDTH
$pdf->SetX(87);//SET HEADER MARGIN
$pdf->Cell(60,6,'DATE',1,0,'L',1);//SET HEADER WIDTH
$pdf->SetX(147);//SET HEADER MARGIN
$pdf->Cell(40,6,'STOCK IN',1,0,'L',1);//SET HEADER WIDTH

$pdf->Ln();

//Now show the columns
$pdf->SetFont('Arial','',12);
$pdf->SetY($Y_Table_Position);//makes both td stay in the same horizontal line
$pdf->SetX(5);//SET TD MARGIN
$pdf->MultiCell(10,6,$column_code,1);//SET TD WIDTH
$pdf->SetY($Y_Table_Position);
$pdf->SetX(15);//SET TD MARGIN
$pdf->MultiCell(72,6,$column_name,1);//SET TD WIDTH
$pdf->SetY($Y_Table_Position);
$pdf->SetX(87);//SET TD MARGIN
$pdf->MultiCell(60,6,$column_st,1,'L');//SET TD WIDTH
$pdf->SetY($Y_Table_Position);
$pdf->SetX(147);//SET TD MARGIN
$pdf->MultiCell(40,6,$column_q,1,'L');//SET TD WIDTH


//$pdf->SetX(168);
//$pdf->MultiCell(30,6,$total,1,'L');

//Create lines (boxes) for each ROW (Product)
//If you don't use the following code, you don't create the lines separating each row
$i = 0;
$pdf->SetY($Y_Table_Position);
while ($i < $k)
{
    $pdf->SetX(5);
    $pdf->MultiCell(182,6,'',1);
    $i = $i +1;
}

$pdf->Output();
		
	}
	
	
	
	
	
}


?>