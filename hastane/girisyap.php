<?php	

	require 'baglanti.php';
	session_start();
	if ( $_POST) {
				
			$tckimlik = $_POST['tckimlik'];
			$sifre = $_POST['sifre'];
			$sorgu = $db->query("SELECT * FROM uyeler WHERE tc = '{$tckimlik}' and sifre = '{$sifre}' " ) ->fetch(PDO::FETCH_ASSOC);
			if ( $sorgu ){
				
				
				//print_r($sorgu['id']);
				$_SESSION['login'] = $sorgu['id'];
				$_SESSION['name'] = $sorgu['ad'];
				$_SESSION['surname'] = $sorgu['soyad'];
				$_SESSION['tcno'] = $sorgu['tc'];
			
				header("Location:kullanicipanel.php");
			}
			else
			{
				header("Location:girisyap.php?basarisiz=1");
			}
			die();
	}
   ?>
<html>
	<head>
		<title> Merkezi Hastane Randevu Sistemi Giriş  Ekranı </title>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="css/styles3.css" />
	</head>
	<body>
		<div class="arkaplan2">
		</div>
		<form class="kutu"  method="POST">
			
			<h1 style="margin-top:200px; "> Hasta Giriş  Ekranı </h1>
				<img src="icons/kisi.png" style="margin-left:-218px; height:30px; width:30px; margin-top: 10px;" class="avatar" > <input type="text" name="tckimlik" minlength="11" maxlength="11" placeholder="Tc Kimlik Numaranız" required 
					onkeypress="return event.charCode >= 48 && event.charCode <= 57"				
					oninvalid="this.setCustomValidity('TC Kimlik Numaranızı Giriniz.')" onkeyup="setCustomValidity('')">	
				<img src="icons/key.png" class="key" style="margin-left:-210px;"> <input type="password" name="sifre" placeholder="Şifreniz" required
					oninvalid="this.setCustomValidity('Şifrenizi Giriniz.')" onkeyup="setCustomValidity('')">			
				<input type="submit"  value="Giriş Yap" >
            <?php if ( isset($_GET['basarisiz']) ): ?>
                <div class="basarisiz">
                   <img src="icons/basarisiz.png"> </img> <p> TC kimlik veya şifreniz yanlıştır. </p>
                </div>
            <?php endif ?>				
		</form>	
	</body>
</html>