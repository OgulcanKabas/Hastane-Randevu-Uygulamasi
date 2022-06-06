<?php
		
try{
	$db = new PDO("mysql:host=localhost; dbname=imyo;charset=utf8","root","12345678");
	session_start();
}
catch(PDOException $hata)
{	
	echo "veri tabanı hatası";
	die();
}
?>	
	