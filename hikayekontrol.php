<?php
include "baglanti.php";
ini_set('display_errors', true);
if(empty($_POST['hikaye']) || empty($_POST['hikaye_adi']) || empty($_POST['kategori']) || empty($_POST['telif']) || empty($_POST['tamammi'])){

    echo '<script>alert("Form alanlarını doldurun!");history.back(-1);</script>';
}else{
$uye_id=$_SESSION['id'];
$hikaye=$_POST['hikaye'];
$hikaye_adi=$_POST['hikaye_adi'];
$kategori=$_POST['kategori'];
$telif=$_POST['telif'];
$tamammi=$_POST['tamammi'];

if($_FILES){
$resim_ismi = $_FILES['kapakresim']['name'];
$resim_turu = $_FILES['kapakresim']['type'];
$resim_boyut_orj = $_FILES['kapakresim']['size'];
$resim_kaynak = $_FILES['kapakresim']['tmp_name'];
if($resim_kaynak ==""){
	echo '<script>alert("Bir resim seçmelisiniz!");history.back(-1);</script>';
}elseif (($resim_turu != "image/jpeg") && ($resim_turu != "image/png") && ($resim_turu != "image/gif")) {
	echo '<script>alert("Seçtiğiniz dosya türü jpeg, png ya da gif türünde olmalıdır!");history.back(-1);</script>';
}elseif ($resim_boyut_orj> 1024* 1024) {
	echo '<script>alert("Seçtiğiniz dosya boyutu 1 mb den küçük olmalıdır!");history.back(-1);</script>';
}else{
	if(!empty($hikaye)){
	$resim_hedef = "img/";
	$rasgele_isim = rand(1,10000);

	$resim_isim_yeni = $resim_hedef.$rasgele_isim.'-'.$resim_ismi.'';

	$resim_upload = move_uploaded_file($resim_kaynak, $resim_isim_yeni);

	$query=mysqli_query($link,"insert into hikayeler(hikaye_adi,hikaye_tur,hikaye_icerik,hikaye_sahip_id,telif,tamammi,hikaye_kapak) values ('".$hikaye_adi."','".$kategori."','".$hikaye."','".$uye_id."','".$telif."','".$tamammi."','".$resim_isim_yeni."')");
    echo "hikayeniz kaydedilmiştir!";
    $_SESSION['id']=$uye_id;
    $_SESSION['hikaye_icerik']=$hikaye;
    $_SESSION['hikaye_adi']=$hikaye_adi;
    $_SESSION['hikaye_tur']=$kategori;
    $_SESSION['telif']=$telif;
    $_SESSION['tamammi']=$tamammi;
    header("Location:hikayegoruntule.php");
	}else{
    	echo '<script>alert("Lütfen bir metin giriniz!");history.back(-1);</script>';
		exit();
	}
}
}
}
?>