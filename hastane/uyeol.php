<html>
	<head>
		<title> Merkezi Hastane Randevu Sistemi Üye Olma Ekranı </title>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="css/styles2.css" />
	</head>
	<body>
		<div class="arkaplan">
		
			
		</div>
		<form class="kutu" action="uyeekle.php" method="POST">
			<h1> Hasta Kayıt  Ekranı </h1>
				<img src="icons/user.png" class="avatar" ><input type="text" name="ad" placeholder="Adınız" required
					oninvalid="this.setCustomValidity('Adınızı Giriniz.')" onkeyup="setCustomValidity('')">
				<input type="text" name="soyad" placeholder="Soyadınız" required
					oninvalid="this.setCustomValidity('Soyadınızı Giriniz.')" onkeyup="setCustomValidity('')">
				<input type="text" name="tckimlik" minlength="11" maxlength="11" placeholder="Tc Kimlik Numaranız" required 
					onkeypress="return event.charCode >= 48 && event.charCode <= 57"				
					oninvalid="this.setCustomValidity('TC Kimlik Numaranızı 11 haneli şekilde giriniz.')" onkeyup="setCustomValidity('')">	
				<img src="icons/key.png" class="key"> <input type="password" name="sifre" placeholder="Şifreniz" required
					oninvalid="this.setCustomValidity('Şifre Oluşturunuz.')" onkeyup="setCustomValidity('')">
				<input type="date" name="tarih" 
					min="1940-01-01" max="2050-12-31"
					required
					oninvalid="this.setCustomValidity('Doğum Tarihinizi Seçiniz.')" onkeyup="setCustomValidity('')">
				<div class="radio">
				Cinsiyet Seçiniz : <br> 
				<input type="radio" name="cinsiyet" value="1" checked="checked" >Erkek  
				<input type="radio" name="cinsiyet" value="2" > Kadın 
				</div>
				<input type="email" name="email" size="32" minlength="3" maxlength="64" placeholder="E-posta adresinizi giriniz.">				
				<input type="submit"  value="Kayıt Ol" >
            <?php if ( isset($_GET['kayitbasarili']) ): ?>
                <div class="basarili" >
                    <img src="icons/basarili.png"> </img> <b>Başarıyla kayıt oldunuz.</b>
                </div>
            <?php endif ?>	
            <?php if ( isset($_GET['tckimlikvar']) ): ?>
                <div class="basarisiz">
                   <img src="icons/basarisiz.png"> </img> <p> TC Kimlik numarası sistemde kayıtlı </p>
                </div>
            <?php endif ?>				
		</form>	
	</body>
</html>