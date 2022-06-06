<?php
session_start();

include 'baglanti.php';

function polikilinik_getir($id)
{
	include 'baglanti.php';
	$query = $db->prepare("SELECT * FROM poliklinik WHERE id = ?");
	$query->execute(array($id));
	$queryRow = $query->fetch(PDO::FETCH_ASSOC);

	if ($queryRow) {
		return $queryRow[p_ad];
	}

}