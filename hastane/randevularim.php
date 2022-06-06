<html>
	<head>
		<title> Merkezi Hastane Randevu Sistemi Üye Olma Ekranı </title>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
		  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

		  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
	

	</head>
	<body>
	
	<?php
	session_start();
	include 'system/include_navbar.php';
	require 'baglanti.php';
	include 'fonksiyonlar.php';
	?>
	<div class="container">
	  <div class="row">	
	  <div class="container p-3 my-3 border">
		<center><h1>Randevularım</h1>
		<p>Bu alandan mevcut ve geçmiş randevularınızı görüntülemektesiniz..</p></center>
	  </div>	  
		<?
			if(!$_SESSION['tcno'])
				throw new Exception("Bu sayfaya erişebilmek için giriş yapmalısınız.");
		
			$acc_id = $_SESSION['login'];
		
			?>		  
	  
		<div class="alert alert-warning" role="alert">
		  Aşağıdaki tabloda mevcut tüm randevularınızı görmektesiniz.
		</div>		  
		<table class="table table-hover">
		  <thead>
			<tr>
			  <th scope="col">#</th>
			  <th scope="col">İsim</th>
			  <th scope="col">Soyisim</th>
			  <th scope="col">T.C</th>
			  <th scope="col">Tarih</th>
			  <th scope="col">Poliklinik</th>
			  <th scope="col">Durum</th>
			</tr>
		  </thead>
		  <tbody>
		  <?php 
				$query3 = $db->prepare("SELECT * FROM randevular WHERE acc_id = ? AND r_tarihi - NOW() < 0");
							$query3->execute(array($acc_id));
							while($row2 = $query3->fetch(PDO::FETCH_ASSOC))
							{
								echo ('sa');
							$query4 = $db->prepare("UPDATE  randevular SET appointment_status = ? WHERE acc_id = ? AND r_tarihi - NOW() < 0");
										$query4->execute(array(0,$acc_id));
							}
		  ?>		  
		  <?php 
			$query2 = $db->prepare("SELECT * FROM randevular WHERE acc_id = ?");
			$query2->execute(array($acc_id));
			while($row2 = $query2->fetch(PDO::FETCH_ASSOC))
			{
		  ?>		  
			<tr>
			  <th scope="row"><? echo $row2[id]; ?></th>
			  <td><? echo $row2[ad]; ?></td>
			  <td><? echo $row2[soyad]; ?></td>
			  <td><? echo $row2[tc]; ?></td>
			  <td><? echo $row2[r_tarihi]; ?></td>
			  <td><? echo polikilinik_getir($row2[appointment_unit]); ?></td>
			  <td><? if ($row2[appointment_status] == 0)
			  {
				  echo "<button type='button' class='btn btn-danger'>Randevunuz Geçmiş.</button";
			  }
			  else {
				  echo "<button type='button' class='btn btn-success'>Randevunuz aktif.</button";
			  }

				  ?></td>
			</tr>
			<?php
			}
			?>
		</table>		

	</body>
	</div>
	</div>
	
	<?php
	include 'system/include_footer.php';
	?>		
</html>