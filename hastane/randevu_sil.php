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
		<center><h1>Randevu İşlem</h1>
		<p>Bu alandan mevcut randevularınızı iptal edebilirsiniz..</p></center>
	  </div>	  
		<?
			if(!$_SESSION['tcno'])
				throw new Exception("Bu sayfaya erişebilmek için giriş yapmalısınız.");
		
			$acc_id = $_SESSION['login'];
			
			$ran_sil = $_GET['ran_sil'];
			if ($ran_sil == "ok")
			{

				$RanSil = $db->prepare("DELETE FROM randevular WHERE id = ?");
				$RanSil->execute(array($_GET['ran_id']));
				if($RanSil) {
					echo "		
					<div class='alert alert-success' role='alert'>
						BAŞARILI!<br>
						Randevunuz başarıyla iptal edilmiştir.
					</div>";							
				}
				else{
					echo "		
					<div class='alert alert-danger' role='alert'>
						HATA!<br>
						Randevunuz iptal edilirken bir hatayla karşılaşıldı.Tekrar deneyiniz.
					</div>";						
				}				

			}
			
		
			?>		  
	  
		<div class="alert alert-warning" role="alert">
		  Aşağıdaki tabloda zamanı gelmemiş randevularınıza işlem uygulayabilmek için görmektesiniz.
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
			  <th scope="col">İşlem</th>
			</tr>
		  </thead>
		  <tbody>
		  <?php 
			$query2 = $db->prepare("SELECT * FROM randevular WHERE acc_id = ? AND r_tarihi - NOW() > 0");
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
			  <td><a href="?ran_id=<? echo  $row2[id]; ?>&ran_sil=ok" class='btn btn-danger'><i class="fa fa-trash-o"></i> Randevuyu İptal Et.</a></td>
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