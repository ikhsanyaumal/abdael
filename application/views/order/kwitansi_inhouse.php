<?php 
	$this->load->library('fpdf');
	
	function Terbilang($x)
	{
	  $abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		if ($x < 12)
			return " " . $abil[$x];
		elseif ($x < 20)
			return Terbilang($x - 10) . "belas";
		elseif ($x < 100)
			return Terbilang($x / 10) . " puluh" . Terbilang($x % 10);
		elseif ($x < 200)
			return " seratus" . Terbilang($x - 100);
		elseif ($x < 1000)
			return Terbilang($x / 100) . " ratus" . Terbilang($x % 100);
		elseif ($x < 2000)
			return " seribu" . Terbilang($x - 1000);
		elseif ($x < 1000000)
			return Terbilang($x / 1000) . " ribu" . Terbilang($x % 1000);
		elseif ($x < 1000000000)
			return Terbilang($x / 1000000) . " juta" . Terbilang($x % 1000000);
		elseif ($x >= 1000000000)
			return Terbilang($x / 1000000000) . " milyar" . Terbilang($x - ((floor($x/1000000000))*1000000000));
	}

	class PDF extends FPDF
	{	
		function print_kuitansi($project,$order,$payment,$history_inhouse){

			$bulan = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

			$y = $this->getY();
			$x = $this->getX();
			$this->SetXY($x-5,$y);
			$this->Cell(195,128,' ','LTRB',0,'C',0);

			$this->SetXY($x,$y);
			$b = base_url().'images/'.$project['header'];
			$this->Image($b,11,$y+3,60,13);
			$this->Ln(2);
			$this->SetFont('times','B',15);
			$this->Cell(190,5,'ASLI',0,1,'R');

			$this->Ln(15);
			$this->SetFont('times','B',15);
			$this->Cell(200,5,$project['project_company_name'],0,1,'L');

			$this->SetFont('times','',11);
			
			$this->Cell(140,5,$project['project_company_address'],0,0,'L');
			$this->Cell(60,5,'Kwitansi No : ',0,1,'L');

			$this->Cell(140,5,'',0,0,'L');
			$this->Cell(60,5,$history_inhouse['name'],0,1,'L');

			$this->ln();
			$this->Cell(35,5,'Telah terima dari ',0,0,'L');
			$this->Cell(3,5,' : ',0,0,'C');
			$this->Cell(55,5,$order['name'],0,0,'L');
			$this->Cell(60,5,$order['address'],0,1,'L');

			$terbilang = ucwords(Terbilang($history_inhouse['kwitansi_payment']));
			$this->Cell(35,5,'Uang sejumlah ',0,0,'L');
			$this->Cell(3,5,' : ',0,0,'C');
			$this->Cell(55,5,$terbilang.'Rupiah',0,1,'L');

			$this->ln();
			$this->Cell(35,5,'Untuk pembayaran ',0,0,'L');
			$this->Cell(3,5,' : ',0,0,'C');
			$this->Cell(55,5,'Cicilan ke '.$history_inhouse['period'].' pembelian Rumah / Ruko ',0,1,'L');

			$this->Cell(35,5,'',0,0,'L');
			$this->Cell(3,5,'  ',0,0,'C');
			$this->Cell(20,5,'Blok ',0,0,'L');
			$this->Cell(3,5,' : ',0,0,'C');
			$this->Cell(20,5,$order['kavling_name'],0,1,'L');

			$this->Cell(35,5,'',0,0,'L');
			$this->Cell(3,5,'  ',0,0,'C');
			$this->Cell(20,5,'Tipe ',0,0,'L');
			$this->Cell(3,5,' : ',0,0,'C');
			$this->Cell(20,5,$order['type_name'],0,1,'L');

			$this->Cell(35,5,'',0,0,'L');
			$this->Cell(3,5,'  ',0,0,'C');
			$this->Cell(20,5,'Lokasi ',0,0,'L');
			$this->Cell(3,5,' : ',0,0,'C');
			$this->MultiCell(130,5,$project['address'],0,'L',0);

			$kwitansi_date = date_create($history_inhouse['date']);
			$this->ln();
			$this->Cell(140,5,'',0,0,'L');
			$this->Cell(60,5,'Surabaya, '.date_format($kwitansi_date,'d').'-'.$bulan[date_format($kwitansi_date,'n')-1].'-'.date_format($kwitansi_date,'Y'),0,1,'L');
			$y = $this->getY();

			$this->SetFont('times','BU',11);
			$this->ln(25);
			$this->Cell(135,5,'',0,0,'L');
			$this->Cell(50,5,strtoupper($project['manager']),0,1,'C');

			if($history_inhouse['period']=='1'){
				$this->SetFont('times','I',8);
				$this->Cell(140,5,'* bila pada waktu jatuh tempo DP 1 tidak ada pembayaran, maka transaksi ini dianggap batal dan uang ikatan menjadi hangus',0,1,'L');
			}

			$tanda_jadi = number_format($history_inhouse['kwitansi_payment'], 0, ',', '.');
			$this->SetXY($x,$y+10);
			$this->SetFont('times','IB',11);
			$this->Cell(35,20,'Sebesar','TB',0,'L');
			$this->Cell(10,20,' : Rp ','TB',0,'L');
			$this->Cell(40,20,$tanda_jadi,'TB',1,'R');
		}

		function print_kuitansi_copy($project,$order,$payment,$history_inhouse){

			$bulan = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

			$this->ln(25);
			$y = $this->getY();
			$x = $this->getX();
			$this->SetXY($x-5,$y);
			$this->Cell(195,128,' ','LTRB',0,'C',0);

			$this->SetXY($x,$y);
			$b = base_url().'images/'.$project['header'];
			$this->Image($b,11,$y+3,60,13);
			$this->Ln(2);
			$this->SetFont('times','B',15);
			$this->Cell(190,5,'COPY',0,1,'R');

			$this->Ln(15);
			$this->SetFont('times','B',15);
			$this->Cell(200,5,$project['project_company_name'],0,1,'L');

			$this->SetFont('times','',11);
			
			$this->Cell(140,5,$project['project_company_address'],0,0,'L');
			$this->Cell(60,5,'Kwitansi No : ',0,1,'L');

			$this->Cell(140,5,'',0,0,'L');
			$this->Cell(60,5,$history_inhouse['name'],0,1,'L');

			$this->ln();
			$this->Cell(35,5,'Telah terima dari ',0,0,'L');
			$this->Cell(3,5,' : ',0,0,'C');
			$this->Cell(55,5,$order['name'],0,0,'L');
			$this->Cell(60,5,$order['address'],0,1,'L');

			$terbilang = ucwords(Terbilang($history_inhouse['kwitansi_payment']));
			$this->Cell(35,5,'Uang sejumlah ',0,0,'L');
			$this->Cell(3,5,' : ',0,0,'C');
			$this->Cell(55,5,$terbilang.'Rupiah',0,1,'L');

			$this->ln();
			$this->Cell(35,5,'Untuk pembayaran ',0,0,'L');
			$this->Cell(3,5,' : ',0,0,'C');
			$this->Cell(55,5,'Cicilan ke '.$history_inhouse['period'].' pembelian Rumah / Ruko ',0,1,'L');

			$this->Cell(35,5,'',0,0,'L');
			$this->Cell(3,5,'  ',0,0,'C');
			$this->Cell(20,5,'Blok ',0,0,'L');
			$this->Cell(3,5,' : ',0,0,'C');
			$this->Cell(20,5,$order['kavling_name'],0,1,'L');

			$this->Cell(35,5,'',0,0,'L');
			$this->Cell(3,5,'  ',0,0,'C');
			$this->Cell(20,5,'Tipe ',0,0,'L');
			$this->Cell(3,5,' : ',0,0,'C');
			$this->Cell(20,5,$order['type_name'],0,1,'L');

			$this->Cell(35,5,'',0,0,'L');
			$this->Cell(3,5,'  ',0,0,'C');
			$this->Cell(20,5,'Lokasi ',0,0,'L');
			$this->Cell(3,5,' : ',0,0,'C');
			$this->MultiCell(130,5,$project['address'],0,'L',0);

			$kwitansi_date = date_create($history_inhouse['date']);
			$this->ln();
			$this->Cell(140,5,'',0,0,'L');
			$this->Cell(60,5,'Surabaya, '.date_format($kwitansi_date,'d').'-'.$bulan[date_format($kwitansi_date,'n')-1].'-'.date_format($kwitansi_date,'Y'),0,1,'L');
			$y = $this->getY();

			$this->SetFont('times','BU',11);
			$this->ln(25);
			$this->Cell(135,5,'',0,0,'L');
			$this->Cell(50,5,strtoupper($project['manager']),0,1,'C');

			if($history_inhouse['period']=='1'){
				$this->SetFont('times','I',8);
				$this->Cell(140,5,'* bila pada waktu jatuh tempo DP 1 tidak ada pembayaran, maka transaksi ini dianggap batal dan uang ikatan menjadi hangus',0,1,'L');
			}

			$tanda_jadi = number_format($history_inhouse['kwitansi_payment'], 0, ',', '.');
			$this->SetXY($x,$y+10);
			$this->SetFont('times','IB',11);
			$this->Cell(35,20,'Sebesar','TB',0,'L');
			$this->Cell(10,20,' : Rp ','TB',0,'L');
			$this->Cell(40,20,$tanda_jadi,'TB',0,'R');

			$this->SetXY($x+90,$y+10);
			$this->Cell(45,20,' ','LTRB',0,'C',0);

			$this->SetXY($x,$y+10);
			$this->SetFont('times','',10);
			$this->Cell(90,5,'','',0,'C');
			$this->Cell(45,5,'Sudah Terima Asli','',1,'C');
		}

	}

	$pdf=new PDF('P','mm',array(210,297));
	$pdf->AddPage();
	$pdf->SetLeftMargin(10);
	$pdf->SetTopMargin(10);
	foreach ($project as $project);
	foreach ($order as $order);
	foreach ($payment as $payment);
	foreach ($history_inhouse as $history_inhouse);
	
	$pdf->print_kuitansi($project,$order,$payment,$history_inhouse);
	$pdf->print_kuitansi_copy($project,$order,$payment,$history_inhouse);
	$pdf->Output();
?>
