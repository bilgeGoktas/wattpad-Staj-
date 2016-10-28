<?php
include "baglanti.php";

if(!isset($_SESSION['id'])){
	header("Location:giris.php");
	exit();
}
if(!isset($_GET['hikaye_id'])){
	header("Location:profil.php");
	exit();
}
$uyeokuyucu_id = $_SESSION['id'];
$hikaye_id = $_GET['hikaye_id'];
$yorum = $_POST['yorum'];

if(empty($yorum)){
	echo '<script>alert("Lütfen bir metin giriniz!");history.back(-1);</script>';
	exit();
}

$sorgu_yorum = mysqli_query($link,"insert into yorumlar(yorum,yorum_hikaye_id,yorum_sahip_id) values ('".$yorum."','".$hikaye_id."','".$uyeokuyucu_id."')");
echo "Yorumunuz eklenmiştir.";

$_SESSION['id'] = $uyeokuyucu_id;

header("Location:hikaye.php?hikaye_id=".$hikaye_id);
exit();
?>