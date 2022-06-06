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
	?>
	<div class="container">
	  <div class="row">	
	  <div class="container p-3 my-3 border">
		<center><h1>Online Randevu Hizmeti</h1>
		<p>Online olarak hastenemizden randevu alabilirsiniz.</p></center>
	  </div>	  
		<?
			if(!$_SESSION['tcno'])
				throw new Exception("Bu sayfaya erişebilmek için giriş yapmalısınız.");
		
			if($_POST)
			{		
				$app_unit = $_POST["appointment_unit"];
				$tc_no = $_POST["tc_no"];
				$name = $_POST["name"];
				$surname = $_POST["surname"];
				$acc_id = $_SESSION['login'];
				$phone = $_POST["phone"];
				$mail = $_POST["mail"];
				$fuse_type_sgk = $_POST["fuse_type_sgk"];
				$fuse_type_ozel = $_POST["fuse_type_ozel"];				
				
				$fuse_type_sgk = $_POST["fuse_type_sgk"];
				$fuse_type_ozel = $_POST["fuse_type_ozel"];
				$appointment_date = $_POST["appointment_date"];
				
				
				$sql2 = $db->prepare("SELECT * FROM randevular WHERE appointment_unit = ?  AND r_tarihi = ?");
				$sql2->execute(array($app_unit,$appointment_date));
				$row2 = $sql2->fetch(PDO::FETCH_ASSOC);
				
				if($row2 > 0)
				{
					echo "		
					<div class='alert alert-danger' role='alert'>
						HATA!<br>
						Belirttiğiniz tarihte zaten bir randevu alınmış.
					</div>";
				}
				else{
					if (isset($fuse_type_sgk,$fuse_type_ozel)){
						echo "		
						<div class='alert alert-danger' role='alert'>
							HATA!<br>
							Sigorta durumlarından yalnızca birini seçebilirsin.
						</div>";					
					} else {
						$sql = $db->prepare("SELECT * FROM randevular WHERE acc_id = ? AND appointment_unit = ?  AND r_tarihi - NOW() > 0");
						$sql->execute(array($acc_id, $app_unit));
						$row = $sql->fetch(PDO::FETCH_ASSOC);
						
						if($row > 0)
						{
							echo "		
							<div class='alert alert-danger' role='alert'>
								HATA!<br>
								Zaten almış olduğunuz bir randevunuz mevcut.
							</div>";
						}
						else{
							$insertQuery = $db->prepare("INSERT INTO randevular (ad,soyad,tc,phone,e_posta,r_tarihi,acc_id,appointment_unit,fuse_type_sgk,fuse_type_ozel) VALUES(?,?,?,?,?,?,?,?,?,?)");
							$insertQuery->execute(array($name,$surname,$tc_no,$phone,$mail,$appointment_date,$acc_id,$app_unit,$fuse_type_sgk,$fuse_type_ozel));			
							if($insertQuery) {
								echo "		
								<div class='alert alert-success' role='alert'>
									BAŞARILI!<br>
									Randevu kaydınız başarıyla alınmıştır.Lütfen geç kalmayınız.
								</div>";							
							}
							else{
								echo "		
								<div class='alert alert-danger' role='alert'>
									HATA!<br>
									Randevu kaydınız oluşturulurken bir hatayla karşılaşıldı.
								</div>";						
							}
					
						}
					}								
				}	
			}
		
			?>		  
	  
		<div class="alert alert-warning" role="alert">
		  NOT!<br>
		  Adınızı ve Soyadınızı Nüfus cüzdanındaki ile aynı yazınız:örn:adı:Oğulcan  Soyadı:Kabaş
		</div>		  
	<form method="POST" class="form-horizontal">
	  <div class="form-group">
		<label>T.C Kimlik Numaranız</label>
		<input type="text" class="form-control" name="tc_no" placeholder="<?php echo $_SESSION['tcno']; ?>" value="<?php echo $_SESSION['tcno']; ?>">
	  </div>
	  <div class="form-group">
		<label>Adınız</label>
		<input type="text" class="form-control" name="name" placeholder="<?php echo $_SESSION['name']; ?>" value="<?php echo $_SESSION['name']; ?>">
	  </div>
	  <div class="form-group">
		<label>Soyadınız</label>
		<input type="text" class="form-control" name="surname" placeholder="<?php echo $_SESSION['surname']; ?>" value="<?php echo $_SESSION['surname']; ?>">
	  </div>	  
 	  <div class="form-group">
		<label>Telefon Numaranız</label>
		<input type="text" class="form-control" name="phone" placeholder="Telefon Numaranızı giriniz.">
	  </div>	
 	  <div class="form-group">
		<label>Mail Adresiniz</label>
		<input type="text" class="form-control" name="mail" placeholder="Telefon Numaranızı giriniz.">
	  </div>	 	  
	  <div class="form-group">
		<label for="exampleFormControlSelect1">Randevu Almak İstediğiniz Birimi Seçiniz.</label>
		<select class="form-control" name="appointment_unit">
		  <?php 
			$query2 = $db->prepare("SELECT * FROM poliklinik");
			$query2->execute();
			while($row2 = $query2->fetch(PDO::FETCH_ASSOC))
			{
		  ?>			
		  <option value="<? echo $row2[id]; ?>"><? echo $row2[p_ad]; ?></option>
			<? } ?>
		</select>
	  </div>
	  
	<div class="form-group">
		<label for="birthday">Randevu Almak İstediğiniz Tarih:</label>
		<input type="datetime-local" name="appointment_date">
	</div>
	
	<div class="form-group">
		<label>Sigorta Durumunuz.</label>
		<div class="form-check">
		  <input class="form-check-input" type="checkbox" value="1" name="fuse_type_sgk">
		  <label class="form-check-label" for="flexCheckDefault">
			Sgk
		  </label>
		</div>
		<div class="form-check">
		  <input class="form-check-input" type="checkbox" value="1" name="fuse type_ozel" checked>
		  <label class="form-check-label" for="flexCheckChecked">
			Özel/Diğer
		  </label>
		</div>
      </div>	
  <div class="form-group">
    <div class="col-sm-40">
      <button type="submit" class="btn btn-primary">Randevu Al</button>
    </div>
  </div>
	</form>
	</body>
	</div>
	</div>
	
	<?php
	include 'system/include_footer.php';
	?>		
</html>