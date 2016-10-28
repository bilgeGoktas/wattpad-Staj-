<?php
include "baglanti.php";
ini_set('display_errors', true);
$uye_id = $_SESSION['id'];
if($_FILES){
$resim_ismi = $_FILES['profilresim']['name'];
$resim_turu = $_FILES['profilresim']['type'];
$resim_boyut_orj = $_FILES['profilresim']['size'];
$resim_kaynak = $_FILES['profilresim']['tmp_name'];


if($resim_kaynak ==""){
	echo '<script>alert("Bir resim seçmelisiniz!");history.back(-1);</script>';
}elseif (($resim_turu != "image/jpeg") && ($resim_turu != "image/png") && ($resim_turu != "image/gif")) {
	echo '<script>alert("Seçtiğiniz dosya türü jpeg, png ya da gif türünde olmalıdır!");history.back(-1);</script>';
}elseif ($resim_boyut_orj> 1024* 1024) {
	echo '<script>alert("Seçtiğiniz dosya boyutu 1 mb den küçük olmalıdır!");history.back(-1);</script>';
}else{

$resim_hedef = "img/";
	$rasgele_isim = rand(1,10000);

$resim_isim_yeni = $resim_hedef.$rasgele_isim.'-'.$resim_ismi.'';

	$resim_upload = move_uploaded_file($resim_kaynak, $resim_isim_yeni);

	

	$resim_kaydet = mysqli_query($link,"update uyeler set profil_resim = '".$resim_isim_yeni."' where id = '".$uye_id."'");

	if($resim_kaydet){
		echo '<script>alert("Resim başarıyla yüklenmiştir.");window.top.location = "profil.php";</script>';
	}else{
		echo '<script>alert("Hata! Resim eklenemedi.");</script>';
	}
}
}
?>