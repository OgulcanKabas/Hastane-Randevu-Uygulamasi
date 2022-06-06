<?php
	require 'baglanti.php';
	$ad = $_POST["ad"];
	$soyad = $_POST["soyad"];
	$tc = $_POST["tckimlik"];	
	$sifre = $_POST["sifre"];
	$tarih = $_POST["tarih"];	
	$cinsiyet = $_POST["cinsiyet"];	
	$email = $_POST["email"];
	
	foreach ($db->query('SELECT *FROM  uyeler',PDO::FETCH_BOTH) as $veriler)
			{	
						If ($tc == $veriler["tc"] )
						{
							$tcvar = true;
							break;
						}
			}	
	if ($tcvar  != true)
	{
		if ($cinsiyet == "1") 
			$cinsiyet = "erkek";
		else
			$cinsiyet = "kadın";
		
		$ekle = $db->query("INSERT INTO uyeler (ad,soyad,tc,cinsiyet,sifre,dogum_tarihi,e_posta) values ('$ad','$soyad','$tc','$cinsiyet','$sifre','$tarih','$email')");
		if($ekle)
		{
					header("Location:uyeol.php?kayitbasarili=1");
		}	
		else
			echo "Ekleme işlemi basarisizdir. Veri tabanında hata oluştu.";			
	}
	else
		header("Location:uyeol.php?tckimlikvar=1");
?>