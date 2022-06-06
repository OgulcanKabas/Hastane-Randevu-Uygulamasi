<?php 
	require 'baglanti.php';
	
	if ( !isset($_SESSION['login'] ) ) {
		header("Location:index.html");
		die();
		
	}
	else
	{
			define('CSSPATH', 'css/'); 
			//$cssItem = 'styles4.css'; 
			$uye_id = $_SESSION['login'];
			$uye = $db->query("SELECT * FROM uyeler WHERE id = '{$uye_id}'" ) ->fetch(PDO::FETCH_ASSOC);
			$uye['ad'] = ucfirst($uye['ad']);
			$uye['soyad'] = ucfirst($uye['soyad']);
			$uye['tc'] = $uye['tc'];
	}	
			

	if ( isset($_GET['cikisyap']) ){
			unset($_SESSION['login']);
			header("Location:girisyap.php");
	}
			
         
	
?>
<!-- Latest compiled and minified CSS -->

<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">	
		  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

		  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
	

		<title> Merkezi Hastane Randevu Sistemi Giriş  Ekranı </title>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
		 <link rel="stylesheet" href="<?php echo (CSSPATH . "$cssItem"); ?>" type="text/css">
		 

	</head>
		
	<?php
	include 'system/include_navbar.php';
	?>
	 
	  
	<div class="container">
	  <div class="row">
	  
	<div class="card mb-3">
	  <img class="card-img-top" src="http://www.suhastanesi.com/Content/Images/Default/Big/su-hastanesi-slider-1-d780fc00-ac94-4b72-81c8-6d9bbee9966f.jpg" width="1200" alt="Card image cap">

	</div>
  
	  
	  <div class="container p-3 my-3 border">
		<h1>Merhaba <?php echo $uye['ad'].' ' .$uye['soyad'] ?></h1>
		<p>Hastane servis sistemimize hoşgeldin. Aşağıdaki seçenekler ile online olarak işlemlerinizi gerçekleştirebilirsiniz.</p>
	  </div>

	  
		<div class="col-sm-4">
		
		<div class="card" style="width: 18rem;">
		  <img class="card-img-top" src="icons/tarih.png" width="286" height="165" alt="Card image cap">
		  <div class="card-body">
			<center><h5 class="card-title">Randevu Merkezi</h5>
			<p class="card-text">Buradan istediğiniz tarihte randevu alabilirsiniz.</p>
			<a href="randevual.php" class="btn btn-primary">Randevu Al</a></center>
		  </div>
		</div>
		</div>
		<div class="col-sm-4">
		<div class="card" style="width: 18rem;">
		  <img class="card-img-top" src="icons/hekims.png" width="286" height="165" alt="Card image cap">
		  <div class="card-body">
			<center><h5 class="card-title">Randevularım</h5>
			<p class="card-text">Buradan mevcut tüm randevularınızı görüntüleyebilirsiniz.</p>
			<a href="randevularim.php" class="btn btn-primary">Randevularım</a></center>
		  </div>
		</div>
		</div>
		<div class="col-sm-4">
		<div class="card" style="width: 18rem;">
		  <img class="card-img-top" src="icons/randevuiptal.jpg" width="286" alt="Card image cap">
		  <div class="card-body">
			<center><h5 class="card-title">Randevu İşlem</h5>
			<p class="card-text">Buradan aktif randevularınızı iptal edebilirsiniz.</p>
			<a href="randevu_sil.php" class="btn btn-primary">Randevu İşlem</a></center>
		  </div>
		</div>
		</div>
	  </div>
	  
	<div class="card mb-3">
	  <div class="card-header">
		Özel Kabaş Hastanesi
	  </div>
	  <div class="card-body">
		<h5 class="card-title">Modern Teknolojileri Kullanıyoruz...</h5>
		<p class="card-text">Sahip olduğumuz çağdaş bakış açımız ve her gün gelişmekte olan teknolojinin sağladığı imkanlar doğrultusunda, deneyimli ve uzman kadromuzla toplumun her kesimine kaliteli sağlık hizmeti sunmak.</p>
	  </div>
	</div>		  
	  
	</div>	
	
	
	
	<?php
	include 'system/include_footer.php';
	?>	
</html>