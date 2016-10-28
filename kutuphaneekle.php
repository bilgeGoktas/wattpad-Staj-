<?php
include "baglanti.php";

if(!isset($_SESSION['id'])){
	header("Location:giris.php");
	exit();
}else{
	if(!isset($_SESSION['hikaye_id'])){
		header("Location:kesfet.php");
		exit();
	}
$uyeokuyucu_id = $_SESSION['id'];
$hikayeeklenen_id = $_SESSION['hikaye_id'];

//echo "üye okuyucu id : ".$uyeokuyucu_id." - eklenen hikaye id : ".$hikayeeklenen_id;
$sorgu= mysqli_query($link,"select hikaye_id from kutuphane where uye_id= '".$uyeokuyucu_id."'");
$sorgu_hikaye=mysqli_fetch_assoc($sorgu);
while($hikaye_id = $sorgu_hikaye['hikaye_id']){
	if($hikayeeklenen_id==$hikaye_id){
		echo '<script>alert("Bu hikaye kütüphanenizde mevcuttur! Ekleme yapamazsınız!");location.href="profil.php";</script>';
	}else{
	$sorgu_kutuphane = mysqli_query($link,"insert into kutuphane(uye_id,hikaye_id) values ('".$uyeokuyucu_id."','".$hikayeeklenen_id."')");
	echo "kitap kütüphanenize kaydedilmiştir.";
	$_SESSION['id']=$uyeokuyucu_id;
	header("Location:kutuphane.php");
	}
}
}
?>