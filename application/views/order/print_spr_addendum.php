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
		function head($project)
		{
			// foreach ($project as $project);
			$b = base_url().'images/'.$project['header'];
			// $b = base_url().'images/1.jpg';
			$this->Image($b,13,5,100,25);
			$this->SetFont('Arial','',11);
			// Move to the right
			$this->Cell(80);
			// Line break
			$this->Ln(30);
		}
		
		//Colored table
		function tabel_ri32_color($project,$order,$payment,$period,$period_inhouse,$history_transaksi,$history_inhouse)
		{			
			$bulan = array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
			
			$this->Ln(0);
			$ruko = "";
			// if($id==1 and $blok[0]=='F'){
			// 	$ruko="( RUKO )";
			// }
			$this->SetFont('Arial','B',15);
			$this->Cell(190,5,'(ADDENDUM) SURAT PEMESANAN PEMBELIAN TANAH & BANGUNAN '.$ruko,0,1,'C');
			$this->Cell(190,0,'',1,1,'C');
			$this->SetFont('Arial','',12);

			// $this->Cell(170,10,$tgl,0,1,'C');
			$this->Cell(170,10,'',0,1,'C');
			$this->Ln(2);

			$this->SetFillColor(224,235,255);
			$this->SetTextColor(0);
			$this->SetFont('Arial','',9);
			
			//$this->SetFillColor(255,0,0);
			$this->SetTextColor(0);
			//$this->SetDrawColor(0);
			$this->SetLineWidth(.1);
			$this->SetFont('Arial','',11.5);

			$this->Cell(10,5,'Yang bertandatangan dibawah ini :',0,1,'L');						
			
			$this->Cell(50,5,'Nama ',0,0,'L');
			$this->Cell(80,5,': '.$order['name'],0,1,'L');
			$this->Cell(50,5,'Nomor KTP ',0,0,'L');
			$this->Cell(80,5,': '.$order['ktp'],0,1,'L');
			$this->Cell(50,5,'Alamat KTP ',0,0,'L');
			$this->MultiCell(140,5,': '.$order['address'],0,'FJ',0);
			$this->Cell(50,5,'Alamat Surat ',0,0,'L');
			$this->MultiCell(140,5,': '.$order['mail_address'],0,'FJ',0);
			$this->Cell(50,5,'Email ',0,0,'L');
			$this->Cell(80,5,': '.$order['email'],0,1,'L');
			$this->Cell(50,5,'Nomor Telepon ',0,0,'L');
			$this->Cell(80,5,': '.$order['phone'],0,1,'L');
			$this->Cell(50,5,'NPWP ',0,0,'L');
			$this->Cell(80,5,': '.$order['npwp'],0,1,'L');
			
			$this->Cell(10,5,'Mengajukan pemesanan untuk pembelian sebidang Tanah dan Bangunan '.$ruko.' yang terletak di kota ',0,1,'L');
			$this->Cell(10,5,$project['city'].', '.$project['address'],0,1,'L');
			$this->Cell(10,5,'dikenal dengan " '.$project['name'].' " dengan kondisi :',0,1,'L');
			$this->Ln(2);
			
			$this->Cell(10,5,'',0,0,'L');
			$this->Cell(40,5,'Blok / Kavling ',0,0,'L');
			$this->Cell(80,5,': '.$order['kavling_name'],0,1,'L');
			$this->Cell(10,5,'',0,0,'L');
			$this->Cell(40,5,'LT / LB ',0,0,'L');
			$this->Cell(80,5,': '.$order['lt'].'M2 / '.$order['lb'].'M2',0,1,'L');
			$this->Cell(10,5,'',0,0,'L');
			$this->Cell(40,5,'Type ',0,0,'L');
			$this->Cell(80,5,': '.$order['type_name'],0,1,'L');

			$date = date_create($payment['tanggal_tanda_jadi']);
			
			$day = date_format($date,"d");
			$nmonth = date_format($date,"n");
			$year =  date_format($date,"Y");
			$month = $bulan[$nmonth-1];
			$tgl = $day." ".$month." ".$year;

			$this->Cell(10,5,'Dengan ini menyatakan setuju untuk mengaddendum Surat Pemesanan Pembelian Tanah dan Bangunan ',0,1,'L');
			$this->Cell(10,5,$tgl.'. Dan untuk pemesanan tersebut di atas, maka dengan ini Pemesan menyetujui',0,1,'L');
			$this->Cell(10,5,'mengaddendum ketentuan sebagai berikut :',0,1,'L');
			// $this->Cell(10,5,$project['project_company_name'].' dengan ketentuan sebagai berikut :',0,1,'L');		
			
			$harga_rumah=number_format($payment['harga_rumah'], 0, ',', '.');
			// }
			$terbilang = ucwords(Terbilang($payment['harga_rumah']));
			if(strlen($terbilang)>77){
				$this->Cell(10,5,'1. ',0,0,'L');
				$this->Cell(40,5,'Harga pemesanan Rp ',0,0,'L');
				$this->Cell(40,5,$harga_rumah.',-',0,1,'L');
				$this->Cell(10,5,'',0,0,'L');
				$this->Cell(10,5,'Terbilang ( '.substr($terbilang,0,77),0,1,'L');
				$this->Cell(10,5,'',0,0,'L');
				$this->Cell(10,5,substr($terbilang,77).' Rupiah )',0,1,'L');
			}else{
				$this->Cell(10,5,'1. ',0,0,'L');
				$this->Cell(40,5,'Harga pemesanan Rp ',0,0,'L');
				$this->Cell(40,5,$harga_rumah.',-',0,1,'L');
				$this->Cell(10,5,'',0,0,'L');
				$this->Cell(10,5,'Terbilang ( '.$terbilang.' Rupiah )',0,1,'L');
			}		

			$this->Ln(2);
			$this->Cell(10,5,'2. ',0,0,'L');
			$tipe = $payment['payment_type'];
			if($tipe=='2'){
				$this->Cell(75,5,'Pembayaran akan dilakukan secara ( => )  ',0,0,'L');
				$this->Cell(30,5,': [   ] Tunai',0,0,'L');
				$this->Cell(30,5,'[ X ] Bertahap',0,0,'L');
				$this->Cell(30,5,'[   ] KPR',0,1,'L');
			}else if($tipe=='3'){
				$this->Cell(75,5,'Pembayaran akan dilakukan secara ( => )  ',0,0,'L');
				$this->Cell(30,5,': [   ] Tunai',0,0,'L');
				$this->Cell(30,5,'[   ] Bertahap',0,0,'L');
				$this->Cell(30,5,'[ X ] KPR',0,1,'L');
			}else{
				$this->Cell(75,5,'Pembayaran akan dilakukan secara ( => )  ',0,0,'L');
				$this->Cell(30,5,': [ X ] Tunai',0,0,'L');
				$this->Cell(30,5,'[   ] Bertahap',0,0,'L');
				$this->Cell(30,5,'[   ] KPR',0,1,'L');
			}
			
			$this->Ln(2);

			//Column titles1
			$header=array('Perincian', 'Nominal', 'Dibayar Tanggal');
			
			//Header
			$w=array(70,50,60);
			for($i=0;$i<count($header);$i++){
				$this->Cell($w[$i],5,$header[$i],1,0,'C',true);
			}
			
			if($payment['tanda_jadi'] == "0" || $payment['tanda_jadi'] == ""){
			
			}else{
				$date = date_create($payment['tanggal_tanda_jadi']);
				$start = date_format($date,"d/m/Y");

				$tanda_jadi=number_format($payment['tanda_jadi'], 0, ',', '.');
				
				$this->Ln();
				$this->Cell(70,5,'Tanda Jadi',1,0,'L');
				$this->Cell(50,5,$tanda_jadi,1,0,'R');
				$this->Cell(60,5,$start,1,1,'C');
			}
			
			foreach ($period as $period) {
				$period_payment = number_format($period['payment'], 0, ',', '.');
				$this->Cell(70,5,'Uang Muka '.$period['period'].' s/d '.$period['period_to'],1,0,'L');
				$this->Cell(50,5,$period_payment,1,0,'R');
				$tanggal = '';
				foreach ($history_transaksi as $_history_transaksi) {
					if ($_history_transaksi['period'] == $period['period'] ) {
						$date = date_create($_history_transaksi['payment_date']);
						$date = date_format($date,"d/m/Y");
						$tanggal .= $date;
					}elseif ($_history_transaksi['period'] == $period['period_to']) {
						$date = date_create($_history_transaksi['payment_date']);
						$date = date_format($date,"d/m/Y");
						$tanggal .= ' s/d '.$date;
					}
				}
				$this->Cell(60,5,$tanggal,1,1,'C');
			}

			$this->Cell(70,5,'',1,0,'L');
			$this->Cell(50,5,'',1,0,'R');
			$this->Cell(60,5,'',1,1,'C');

			if($tipe=='2'){
				foreach ($period_inhouse as $period_inhouse) {
					$period_payment = number_format($period_inhouse['payment'], 0, ',', '.');
					$this->Cell(70,5,'Cicilan '.$period_inhouse['period'].' s/d '.$period_inhouse['period_to'],1,0,'L');
					$this->Cell(50,5,$period_payment,1,0,'R');
					$tanggal_cicilan = '';
					foreach ($history_inhouse as $_history_inhouse) {
						if ($_history_inhouse['period'] == $period_inhouse['period'] ) {
							$date = date_create($_history_inhouse['payment_date']);
							$date = date_format($date,"d/m/Y");
							$tanggal_cicilan .= $date;
						}elseif ($_history_inhouse['period'] == $period_inhouse['period_to']) {
							$date = date_create($_history_inhouse['payment_date']);
							$date = date_format($date,"d/m/Y");
							$tanggal_cicilan .= ' s/d '.$date;
						}
					}
					$this->Cell(60,5,$tanggal_cicilan,1,1,'C');
				}
				$this->Cell(70,5,'',1,0,'L');
				$this->Cell(50,5,'',1,0,'R');
				$this->Cell(60,5,'',1,1,'C');
			}
			
			$this->Ln();
			$this->SetFont('Arial','',11.5);
			$this->Cell(7,5,'Demikian Surat Pemesanan Tanah dan Bangunan ini dibuat untuk digunakan sebagaimana mestinya ',0,1,'L');
			
			$this->Ln();
			$this->Cell(60,5,$project['project_company_name'],0,0,'C');
			$this->Cell(67,5,'',0,0,'C');

			$date = date_create($payment['tanggal_addendum']);
			
			$day = date_format($date,"d");
			$nmonth = date_format($date,"n");
			$year =  date_format($date,"Y");
			$month = $bulan[$nmonth-1];
			$tgl = $day." ".$month." ".$year;
			
			$this->Cell(100,5,ucfirst(strtolower($project['project_company_city'])).', '.$tgl,0,0,'L');
			
			$this->Ln();
			$this->Cell(60,5,'Marketing',0,0,'C');
			$this->Cell(60,5,'Sales',0,0,'C');
			$this->Cell(60,5,'Pemesan',0,0,'C');
						
			$this->Ln();
			$this->Ln();
			$this->Ln();
			$this->Ln();
			$this->Ln();
			$this->Ln();
			$this->Ln();
			$this->Ln();
			$this->Ln();
			$this->Ln();
			$this->Cell(60,5,'(.........................................)',0,0,'C');
			$this->Cell(60,5,'( '.$project['project_company_city'].' )',0,0,'C');
			$this->MultiCell(60,5,$order['name'],0,'C',0);
		}
	}


	$pdf=new PDF('P','mm',array(216,356));
	$pdf->AddPage();
	$pdf->SetLeftMargin(15);
	foreach ($project as $project);
	foreach ($order as $order);
	foreach ($payment as $payment);
	
	$pdf->head($project);
	$pdf->tabel_ri32_color($project,$order,$payment,$period,$period_inhouse,$history_transaksi,$history_inhouse);
	$pdf->Output();
?>
